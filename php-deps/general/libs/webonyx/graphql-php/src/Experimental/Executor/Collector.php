<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Experimental\Executor;

use Generator;
use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Language\AST\BooleanValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DocumentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\EnumValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FloatValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentSpreadNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InlineFragmentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\IntValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ListValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\Node;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NullValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ObjectValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\OperationDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\SelectionSetNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\StringValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableNode;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\AbstractType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Directive;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Type\Introspection;
use WPEForm\GeneralDeps\GraphQL\Type\Schema;
use function count;
use function sprintf;

/**
 * @internal
 */
class Collector
{
    /** @var Schema */
    private $schema;

    /** @var Runtime */
    private $runtime;

    /** @var OperationDefinitionNode|null */
    public $operation = null;

    /** @var FragmentDefinitionNode[] */
    public $fragments = [];

    /** @var ObjectType|null */
    public $rootType;

    /** @var FieldNode[][] */
    private $fields;

    /** @var array<string, bool> */
    private $visitedFragments;

    public function __construct(Schema $schema, Runtime $runtime)
    {
        $this->schema  = $schema;
        $this->runtime = $runtime;
    }

    public function initialize(DocumentNode $documentNode, ?string $operationName = null)
    {
        $hasMultipleAssumedOperations = false;

        foreach ($documentNode->definitions as $definitionNode) {
            /** @var DefinitionNode|Node $definitionNode */

            if ($definitionNode instanceof OperationDefinitionNode) {
                if ($operationName === null && $this->operation !== null) {
                    $hasMultipleAssumedOperations = true;
                }
                if ($operationName === null ||
                    (isset($definitionNode->name) && $definitionNode->name->value === $operationName)
                ) {
                    $this->operation = $definitionNode;
                }
            } elseif ($definitionNode instanceof FragmentDefinitionNode) {
                $this->fragments[$definitionNode->name->value] = $definitionNode;
            }
        }

        if ($this->operation === null) {
            if ($operationName !== null) {
                $this->runtime->addError(new Error(sprintf('Unknown operation named "%s".', $operationName)));
            } else {
                $this->runtime->addError(new Error('Must provide an operation.'));
            }

            return;
        }

        if ($hasMultipleAssumedOperations) {
            $this->runtime->addError(new Error('Must provide operation name if query contains multiple operations.'));

            return;
        }

        if ($this->operation->operation === 'query') {
            $this->rootType = $this->schema->getQueryType();
        } elseif ($this->operation->operation === 'mutation') {
            $this->rootType = $this->schema->getMutationType();
        } elseif ($this->operation->operation === 'subscription') {
            $this->rootType = $this->schema->getSubscriptionType();
        } else {
            $this->runtime->addError(new Error(sprintf('Cannot initialize collector with operation type "%s".', $this->operation->operation)));
        }
    }

    /**
     * @return Generator
     */
    public function collectFields(ObjectType $runtimeType, ?SelectionSetNode $selectionSet)
    {
        $this->fields           = [];
        $this->visitedFragments = [];

        $this->doCollectFields($runtimeType, $selectionSet);

        foreach ($this->fields as $resultName => $fieldNodes) {
            $fieldNode = $fieldNodes[0];
            $fieldName = $fieldNode->name->value;

            $argumentValueMap = null;
            if (count($fieldNode->arguments) > 0) {
                foreach ($fieldNode->arguments as $argumentNode) {
                    $argumentValueMap                             = $argumentValueMap ?? [];
                    $argumentValueMap[$argumentNode->name->value] = $argumentNode->value;
                }
            }

            if ($fieldName !== Introspection::TYPE_NAME_FIELD_NAME &&
                ! ($runtimeType === $this->schema->getQueryType() && ($fieldName === Introspection::SCHEMA_FIELD_NAME || $fieldName === Introspection::TYPE_FIELD_NAME)) &&
                ! $runtimeType->hasField($fieldName)
            ) {
                // do not emit error
                continue;
            }

            yield new CoroutineContextShared($fieldNodes, $fieldName, $resultName, $argumentValueMap);
        }
    }

    private function doCollectFields(ObjectType $runtimeType, ?SelectionSetNode $selectionSet)
    {
        if ($selectionSet === null) {
            return;
        }

        foreach ($selectionSet->selections as $selection) {
            /** @var FieldNode|FragmentSpreadNode|InlineFragmentNode $selection */
            if (count($selection->directives) > 0) {
                foreach ($selection->directives as $directiveNode) {
                    if ($directiveNode->name->value === Directive::SKIP_NAME) {
                        /** @var VariableNode|NullValueNode|IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|EnumValueNode|ListValueNode|ObjectValueNode|null $condition */
                        $condition = null;
                        foreach ($directiveNode->arguments as $argumentNode) {
                            if ($argumentNode->name->value === Directive::IF_ARGUMENT_NAME) {
                                $condition = $argumentNode->value;
                                break;
                            }
                        }

                        if ($condition === null) {
                            $this->runtime->addError(new Error(
                                sprintf('@%s directive is missing "%s" argument.', Directive::SKIP_NAME, Directive::IF_ARGUMENT_NAME),
                                $selection
                            ));
                        } else {
                            if ($this->runtime->evaluate($condition, Type::boolean()) === true) {
                                continue 2; // !!! advances outer loop
                            }
                        }
                    } elseif ($directiveNode->name->value === Directive::INCLUDE_NAME) {
                        /** @var VariableNode|NullValueNode|IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|EnumValueNode|ListValueNode|ObjectValueNode|null $condition */
                        $condition = null;
                        foreach ($directiveNode->arguments as $argumentNode) {
                            if ($argumentNode->name->value === Directive::IF_ARGUMENT_NAME) {
                                $condition = $argumentNode->value;
                                break;
                            }
                        }

                        if ($condition === null) {
                            $this->runtime->addError(new Error(
                                sprintf('@%s directive is missing "%s" argument.', Directive::INCLUDE_NAME, Directive::IF_ARGUMENT_NAME),
                                $selection
                            ));
                        } else {
                            if ($this->runtime->evaluate($condition, Type::boolean()) !== true) {
                                continue 2; // !!! advances outer loop
                            }
                        }
                    }
                }
            }

            if ($selection instanceof FieldNode) {
                $resultName = $selection->alias === null ? $selection->name->value : $selection->alias->value;

                if (! isset($this->fields[$resultName])) {
                    $this->fields[$resultName] = [];
                }

                $this->fields[$resultName][] = $selection;
            } elseif ($selection instanceof FragmentSpreadNode) {
                $fragmentName = $selection->name->value;

                if (isset($this->visitedFragments[$fragmentName])) {
                    continue;
                }

                if (! isset($this->fragments[$fragmentName])) {
                    $this->runtime->addError(new Error(
                        sprintf('Fragment "%s" does not exist.', $fragmentName),
                        $selection
                    ));
                    continue;
                }

                $this->visitedFragments[$fragmentName] = true;

                $fragmentDefinition = $this->fragments[$fragmentName];
                $conditionTypeName  = $fragmentDefinition->typeCondition->name->value;

                if (! $this->schema->hasType($conditionTypeName)) {
                    $this->runtime->addError(new Error(
                        sprintf('Cannot spread fragment "%s", type "%s" does not exist.', $fragmentName, $conditionTypeName),
                        $selection
                    ));
                    continue;
                }

                $conditionType = $this->schema->getType($conditionTypeName);

                if ($conditionType instanceof ObjectType) {
                    if ($runtimeType->name !== $conditionType->name) {
                        continue;
                    }
                } elseif ($conditionType instanceof AbstractType) {
                    if (! $this->schema->isSubType($conditionType, $runtimeType)) {
                        continue;
                    }
                }

                $this->doCollectFields($runtimeType, $fragmentDefinition->selectionSet);
            } elseif ($selection instanceof InlineFragmentNode) {
                if ($selection->typeCondition !== null) {
                    $conditionTypeName = $selection->typeCondition->name->value;

                    if (! $this->schema->hasType($conditionTypeName)) {
                        $this->runtime->addError(new Error(
                            sprintf('Cannot spread inline fragment, type "%s" does not exist.', $conditionTypeName),
                            $selection
                        ));
                        continue;
                    }

                    $conditionType = $this->schema->getType($conditionTypeName);

                    if ($conditionType instanceof ObjectType) {
                        if ($runtimeType->name !== $conditionType->name) {
                            continue;
                        }
                    } elseif ($conditionType instanceof AbstractType) {
                        if (! $this->schema->isSubType($conditionType, $runtimeType)) {
                            continue;
                        }
                    }
                }

                $this->doCollectFields($runtimeType, $selection->selectionSet);
            }
        }
    }
}
