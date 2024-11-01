<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Validator\Rules;

use ArrayObject;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentSpreadNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InlineFragmentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\SelectionSetNode;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\HasFieldsType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Type\Introspection;
use WPEForm\GeneralDeps\GraphQL\Utils\TypeInfo;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use InvalidArgumentException;
use function class_alias;
use function sprintf;

abstract class QuerySecurityRule extends ValidationRule
{
    public const DISABLED = 0;

    /** @var FragmentDefinitionNode[] */
    private $fragments = [];

    /**
     * check if equal to 0 no check is done. Must be greater or equal to 0.
     *
     * @param string $name
     * @param int    $value
     */
    protected function checkIfGreaterOrEqualToZero($name, $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException(sprintf('$%s argument must be greater or equal to 0.', $name));
        }
    }

    protected function getFragment(FragmentSpreadNode $fragmentSpread)
    {
        $spreadName = $fragmentSpread->name->value;
        $fragments  = $this->getFragments();

        return $fragments[$spreadName] ?? null;
    }

    /**
     * @return FragmentDefinitionNode[]
     */
    protected function getFragments()
    {
        return $this->fragments;
    }

    /**
     * @param callable[] $validators
     *
     * @return callable[]
     */
    protected function invokeIfNeeded(ValidationContext $context, array $validators)
    {
        // is disabled?
        if (! $this->isEnabled()) {
            return [];
        }

        $this->gatherFragmentDefinition($context);

        return $validators;
    }

    abstract protected function isEnabled();

    protected function gatherFragmentDefinition(ValidationContext $context)
    {
        // Gather all the fragment definition.
        // Importantly this does not include inline fragments.
        $definitions = $context->getDocument()->definitions;
        foreach ($definitions as $node) {
            if (! ($node instanceof FragmentDefinitionNode)) {
                continue;
            }

            $this->fragments[$node->name->value] = $node;
        }
    }

    /**
     * Given a selectionSet, adds all of the fields in that selection to
     * the passed in map of fields, and returns it at the end.
     *
     * Note: This is not the same as execution's collectFields because at static
     * time we do not know what object type will be used, so we unconditionally
     * spread in all fragments.
     *
     * @see \WPEForm\GeneralDeps\GraphQL\Validator\Rules\OverlappingFieldsCanBeMerged
     *
     * @param Type|null $parentType
     *
     * @return ArrayObject
     */
    protected function collectFieldASTsAndDefs(
        ValidationContext $context,
        $parentType,
        SelectionSetNode $selectionSet,
        ?ArrayObject $visitedFragmentNames = null,
        ?ArrayObject $astAndDefs = null
    ) {
        $_visitedFragmentNames = $visitedFragmentNames ?? new ArrayObject();
        $_astAndDefs           = $astAndDefs ?? new ArrayObject();

        foreach ($selectionSet->selections as $selection) {
            switch (true) {
                case $selection instanceof FieldNode:
                    $fieldName = $selection->name->value;
                    $fieldDef  = null;
                    if ($parentType instanceof HasFieldsType || $parentType instanceof InputObjectType) {
                        $schemaMetaFieldDef   = Introspection::schemaMetaFieldDef();
                        $typeMetaFieldDef     = Introspection::typeMetaFieldDef();
                        $typeNameMetaFieldDef = Introspection::typeNameMetaFieldDef();

                        if ($fieldName === $schemaMetaFieldDef->name && $context->getSchema()->getQueryType() === $parentType) {
                            $fieldDef = $schemaMetaFieldDef;
                        } elseif ($fieldName === $typeMetaFieldDef->name && $context->getSchema()->getQueryType() === $parentType) {
                            $fieldDef = $typeMetaFieldDef;
                        } elseif ($fieldName === $typeNameMetaFieldDef->name) {
                            $fieldDef = $typeNameMetaFieldDef;
                        } elseif ($parentType->hasField($fieldName)) {
                            $fieldDef = $parentType->getField($fieldName);
                        }
                    }
                    $responseName = $this->getFieldName($selection);
                    if (! isset($_astAndDefs[$responseName])) {
                        $_astAndDefs[$responseName] = new ArrayObject();
                    }
                    // create field context
                    $_astAndDefs[$responseName][] = [$selection, $fieldDef];
                    break;
                case $selection instanceof InlineFragmentNode:
                    $_astAndDefs = $this->collectFieldASTsAndDefs(
                        $context,
                        TypeInfo::typeFromAST($context->getSchema(), $selection->typeCondition),
                        $selection->selectionSet,
                        $_visitedFragmentNames,
                        $_astAndDefs
                    );
                    break;
                case $selection instanceof FragmentSpreadNode:
                    $fragName = $selection->name->value;

                    if (! ($_visitedFragmentNames[$fragName] ?? false)) {
                        $_visitedFragmentNames[$fragName] = true;
                        $fragment                         = $context->getFragment($fragName);

                        if ($fragment) {
                            $_astAndDefs = $this->collectFieldASTsAndDefs(
                                $context,
                                TypeInfo::typeFromAST($context->getSchema(), $fragment->typeCondition),
                                $fragment->selectionSet,
                                $_visitedFragmentNames,
                                $_astAndDefs
                            );
                        }
                    }
                    break;
            }
        }

        return $_astAndDefs;
    }

    protected function getFieldName(FieldNode $node)
    {
        $fieldName = $node->name->value;

        return $node->alias ? $node->alias->value : $fieldName;
    }
}

class_alias(QuerySecurityRule::class, 'WPEForm\GeneralDeps\GraphQL\Validator\Rules\AbstractQuerySecurity');
