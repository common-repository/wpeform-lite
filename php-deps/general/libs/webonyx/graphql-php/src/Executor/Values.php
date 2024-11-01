<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Executor;

use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ArgumentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\BooleanValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DirectiveNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\EnumValueDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\EnumValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FloatValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentSpreadNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InlineFragmentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\IntValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ListValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\Node;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeList;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NullValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ObjectValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\StringValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableNode;
use WPEForm\GeneralDeps\GraphQL\Language\Printer;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Directive;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\EnumType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\FieldDefinition;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ListOfType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\NonNull;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ScalarType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Type\Schema;
use WPEForm\GeneralDeps\GraphQL\Utils\AST;
use WPEForm\GeneralDeps\GraphQL\Utils\TypeInfo;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use WPEForm\GeneralDeps\GraphQL\Utils\Value;
use stdClass;
use Throwable;
use function array_key_exists;
use function array_map;
use function count;
use function sprintf;

class Values
{
    /**
     * Prepares an object map of variables of the correct type based on the provided
     * variable definitions and arbitrary input. If the input cannot be coerced
     * to match the variable definitions, a Error will be thrown.
     *
     * @param VariableDefinitionNode[] $varDefNodes
     * @param mixed[]                  $inputs
     *
     * @return mixed[]
     */
    public static function getVariableValues(Schema $schema, $varDefNodes, array $inputs)
    {
        $errors        = [];
        $coercedValues = [];
        foreach ($varDefNodes as $varDefNode) {
            $varName = $varDefNode->variable->name->value;
            /** @var InputType|Type $varType */
            $varType = TypeInfo::typeFromAST($schema, $varDefNode->type);

            if (! Type::isInputType($varType)) {
                // Must use input types for variables. This should be caught during
                // validation, however is checked again here for safety.
                $errors[] = new Error(
                    sprintf(
                        'Variable "$%s" expected value of type "%s" which cannot be used as an input type.',
                        $varName,
                        Printer::doPrint($varDefNode->type)
                    ),
                    [$varDefNode->type]
                );
            } else {
                $hasValue = array_key_exists($varName, $inputs);
                $value    = $hasValue ? $inputs[$varName] : Utils::undefined();

                if (! $hasValue && ($varDefNode->defaultValue !== null)) {
                    // If no value was provided to a variable with a default value,
                    // use the default value.
                    $coercedValues[$varName] = AST::valueFromAST($varDefNode->defaultValue, $varType);
                } elseif ((! $hasValue || $value === null) && ($varType instanceof NonNull)) {
                    // If no value or a nullish value was provided to a variable with a
                    // non-null type (required), produce an error.
                    $errors[] = new Error(
                        sprintf(
                            $hasValue
                                ? 'Variable "$%s" of non-null type "%s" must not be null.'
                                : 'Variable "$%s" of required type "%s" was not provided.',
                            $varName,
                            Utils::printSafe($varType)
                        ),
                        [$varDefNode]
                    );
                } elseif ($hasValue) {
                    if ($value === null) {
                        // If the explicit value `null` was provided, an entry in the coerced
                        // values must exist as the value `null`.
                        $coercedValues[$varName] = null;
                    } else {
                        // Otherwise, a non-null value was provided, coerce it to the expected
                        // type or report an error if coercion fails.
                        $coerced = Value::coerceValue($value, $varType, $varDefNode);
                        /** @var Error[] $coercionErrors */
                        $coercionErrors = $coerced['errors'];
                        if (count($coercionErrors ?? []) > 0) {
                            $messagePrelude = sprintf(
                                'Variable "$%s" got invalid value %s; ',
                                $varName,
                                Utils::printSafeJson($value)
                            );

                            foreach ($coercionErrors as $error) {
                                $errors[] = new Error(
                                    $messagePrelude . $error->getMessage(),
                                    $error->getNodes(),
                                    $error->getSource(),
                                    $error->getPositions(),
                                    $error->getPath(),
                                    $error->getPrevious(),
                                    $error->getExtensions()
                                );
                            }
                        } else {
                            $coercedValues[$varName] = $coerced['value'];
                        }
                    }
                }
            }
        }

        if (count($errors) > 0) {
            return [$errors, null];
        }

        return [null, $coercedValues];
    }

    /**
     * Prepares an object map of argument values given a directive definition
     * and a AST node which may contain directives. Optionally also accepts a map
     * of variable values.
     *
     * If the directive does not exist on the node, returns undefined.
     *
     * @param FragmentSpreadNode|FieldNode|InlineFragmentNode|EnumValueDefinitionNode|FieldDefinitionNode $node
     * @param mixed[]|null                                                                                $variableValues
     *
     * @return mixed[]|null
     */
    public static function getDirectiveValues(Directive $directiveDef, $node, $variableValues = null)
    {
        if (isset($node->directives) && $node->directives instanceof NodeList) {
            $directiveNode = Utils::find(
                $node->directives,
                static function (DirectiveNode $directive) use ($directiveDef) : bool {
                    return $directive->name->value === $directiveDef->name;
                }
            );

            if ($directiveNode !== null) {
                return self::getArgumentValues($directiveDef, $directiveNode, $variableValues);
            }
        }

        return null;
    }

    /**
     * Prepares an object map of argument values given a list of argument
     * definitions and list of argument AST nodes.
     *
     * @param FieldDefinition|Directive $def
     * @param FieldNode|DirectiveNode   $node
     * @param mixed[]                   $variableValues
     *
     * @return mixed[]
     *
     * @throws Error
     */
    public static function getArgumentValues($def, $node, $variableValues = null)
    {
        if (count($def->args) === 0) {
            return [];
        }

        $argumentNodes    = $node->arguments;
        $argumentValueMap = [];
        foreach ($argumentNodes as $argumentNode) {
            $argumentValueMap[$argumentNode->name->value] = $argumentNode->value;
        }

        return static::getArgumentValuesForMap($def, $argumentValueMap, $variableValues, $node);
    }

    /**
     * @param FieldDefinition|Directive $fieldDefinition
     * @param ArgumentNode[]            $argumentValueMap
     * @param mixed[]                   $variableValues
     * @param Node|null                 $referenceNode
     *
     * @return mixed[]
     *
     * @throws Error
     */
    public static function getArgumentValuesForMap($fieldDefinition, $argumentValueMap, $variableValues = null, $referenceNode = null)
    {
        $argumentDefinitions = $fieldDefinition->args;
        $coercedValues       = [];

        foreach ($argumentDefinitions as $argumentDefinition) {
            $name              = $argumentDefinition->name;
            $argType           = $argumentDefinition->getType();
            $argumentValueNode = $argumentValueMap[$name] ?? null;

            if ($argumentValueNode instanceof VariableNode) {
                $variableName = $argumentValueNode->name->value;
                $hasValue     = array_key_exists($variableName, $variableValues ?? []);
                $isNull       = $hasValue ? $variableValues[$variableName] === null : false;
            } else {
                $hasValue = $argumentValueNode !== null;
                $isNull   = $argumentValueNode instanceof NullValueNode;
            }

            if (! $hasValue && $argumentDefinition->defaultValueExists()) {
                // If no argument was provided where the definition has a default value,
                // use the default value.
                $coercedValues[$name] = $argumentDefinition->defaultValue;
            } elseif ((! $hasValue || $isNull) && ($argType instanceof NonNull)) {
                // If no argument or a null value was provided to an argument with a
                // non-null type (required), produce a field error.
                if ($isNull) {
                    throw new Error(
                        'Argument "' . $name . '" of non-null type ' .
                        '"' . Utils::printSafe($argType) . '" must not be null.',
                        $referenceNode
                    );
                }

                if ($argumentValueNode instanceof VariableNode) {
                    $variableName = $argumentValueNode->name->value;
                    throw new Error(
                        'Argument "' . $name . '" of required type "' . Utils::printSafe($argType) . '" was ' .
                        'provided the variable "$' . $variableName . '" which was not provided ' .
                        'a runtime value.',
                        [$argumentValueNode]
                    );
                }

                throw new Error(
                    'Argument "' . $name . '" of required type ' .
                    '"' . Utils::printSafe($argType) . '" was not provided.',
                    $referenceNode
                );
            } elseif ($hasValue) {
                if ($argumentValueNode instanceof NullValueNode) {
                  // If the explicit value `null` was provided, an entry in the coerced
                  // values must exist as the value `null`.
                    $coercedValues[$name] = null;
                } elseif ($argumentValueNode instanceof VariableNode) {
                    $variableName = $argumentValueNode->name->value;
                    Utils::invariant($variableValues !== null, 'Must exist for hasValue to be true.');
                  // Note: This does no further checking that this variable is correct.
                  // This assumes that this query has been validated and the variable
                  // usage here is of the correct type.
                    $coercedValues[$name] = $variableValues[$variableName] ?? null;
                } else {
                    $valueNode    = $argumentValueNode;
                    $coercedValue = AST::valueFromAST($valueNode, $argType, $variableValues);
                    if (Utils::isInvalid($coercedValue)) {
                      // Note: ValuesOfCorrectType validation should catch this before
                      // execution. This is a runtime check to ensure execution does not
                      // continue with an invalid argument value.
                        throw new Error(
                            'Argument "' . $name . '" has invalid value ' . Printer::doPrint($valueNode) . '.',
                            [$argumentValueNode]
                        );
                    }
                    $coercedValues[$name] = $coercedValue;
                }
            }
        }

        return $coercedValues;
    }

    /**
     * @deprecated as of 8.0 (Moved to \GraphQL\Utils\AST::valueFromAST)
     *
     * @param VariableNode|NullValueNode|IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|EnumValueNode|ListValueNode|ObjectValueNode $valueNode
     * @param ScalarType|EnumType|InputObjectType|ListOfType|NonNull                                                                              $type
     * @param mixed[]|null                                                                                                                        $variables
     *
     * @return mixed[]|stdClass|null
     *
     * @codeCoverageIgnore
     */
    public static function valueFromAST(ValueNode $valueNode, InputType $type, ?array $variables = null)
    {
        return AST::valueFromAST($valueNode, $type, $variables);
    }

    /**
     * @deprecated as of 0.12 (Use coerceValue() directly for richer information)
     *
     * @param mixed[]                                                $value
     * @param ScalarType|EnumType|InputObjectType|ListOfType|NonNull $type
     *
     * @return string[]
     *
     * @codeCoverageIgnore
     */
    public static function isValidPHPValue($value, InputType $type)
    {
        $errors = Value::coerceValue($value, $type)['errors'];

        return $errors
            ? array_map(
                static function (Throwable $error) : string {
                    return $error->getMessage();
                },
                $errors
            )
            : [];
    }
}
