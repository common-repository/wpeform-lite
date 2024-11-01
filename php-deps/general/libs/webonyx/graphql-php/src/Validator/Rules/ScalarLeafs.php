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
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class ScalarLeafs extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        return [
            NodeKind::FIELD => static function (FieldNode $node) use ($context) : void {
                $type = $context->getType();
                if (! $type) {
                    return;
                }

                if (Type::isLeafType(Type::getNamedType($type))) {
                    if ($node->selectionSet) {
                        $context->reportError(new Error(
                            self::noSubselectionAllowedMessage($node->name->value, $type),
                            [$node->selectionSet]
                        ));
                    }
                } elseif (! $node->selectionSet) {
                    $context->reportError(new Error(
                        self::requiredSubselectionMessage($node->name->value, $type),
                        [$node]
                    ));
                }
            },
        ];
    }

    public static function noSubselectionAllowedMessage($field, $type)
    {
        return sprintf('Field "%s" of type "%s" must not have a sub selection.', $field, $type);
    }

    public static function requiredSubselectionMessage($field, $type)
    {
        return sprintf('Field "%s" of type "%s" must have a sub selection.', $field, $type);
    }
}
