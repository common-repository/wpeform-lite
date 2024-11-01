<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Validator\Rules;

use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InlineFragmentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\Printer;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Utils\TypeInfo;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class FragmentsOnCompositeTypes extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        return [
            NodeKind::INLINE_FRAGMENT     => static function (InlineFragmentNode $node) use ($context) : void {
                if (! $node->typeCondition) {
                    return;
                }

                $type = TypeInfo::typeFromAST($context->getSchema(), $node->typeCondition);
                if (! $type || Type::isCompositeType($type)) {
                    return;
                }

                $context->reportError(new Error(
                    static::inlineFragmentOnNonCompositeErrorMessage($type),
                    [$node->typeCondition]
                ));
            },
            NodeKind::FRAGMENT_DEFINITION => static function (FragmentDefinitionNode $node) use ($context) : void {
                $type = TypeInfo::typeFromAST($context->getSchema(), $node->typeCondition);

                if (! $type || Type::isCompositeType($type)) {
                    return;
                }

                $context->reportError(new Error(
                    static::fragmentOnNonCompositeErrorMessage(
                        $node->name->value,
                        Printer::doPrint($node->typeCondition)
                    ),
                    [$node->typeCondition]
                ));
            },
        ];
    }

    public static function inlineFragmentOnNonCompositeErrorMessage($type)
    {
        return sprintf('Fragment cannot condition on non composite type "%s".', $type);
    }

    public static function fragmentOnNonCompositeErrorMessage($fragName, $type)
    {
        return sprintf('Fragment "%s" cannot condition on non composite type "%s".', $fragName, $type);
    }
}
