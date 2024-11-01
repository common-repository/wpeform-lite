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
use WPEForm\GeneralDeps\GraphQL\Language\AST\ArgumentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DirectiveNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\Node;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function array_map;
use function count;
use function sprintf;

/**
 * Known argument names
 *
 * A GraphQL field is only valid if all supplied arguments are defined by
 * that field.
 */
class KnownArgumentNames extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        $knownArgumentNamesOnDirectives = new KnownArgumentNamesOnDirectives();

        return $knownArgumentNamesOnDirectives->getVisitor($context) + [
            NodeKind::ARGUMENT => static function (ArgumentNode $node) use ($context) : void {
                $argDef = $context->getArgument();
                if ($argDef !== null) {
                    return;
                }

                $fieldDef   = $context->getFieldDef();
                $parentType = $context->getParentType();
                if ($fieldDef === null || ! ($parentType instanceof Type)) {
                    return;
                }

                $context->reportError(new Error(
                    self::unknownArgMessage(
                        $node->name->value,
                        $fieldDef->name,
                        $parentType->name,
                        Utils::suggestionList(
                            $node->name->value,
                            array_map(
                                static function ($arg) : string {
                                    return $arg->name;
                                },
                                $fieldDef->args
                            )
                        )
                    ),
                    [$node]
                ));

                return;
            },
        ];
    }

    /**
     * @param string[] $suggestedArgs
     */
    public static function unknownArgMessage($argName, $fieldName, $typeName, array $suggestedArgs)
    {
        $message = sprintf('Unknown argument "%s" on field "%s" of type "%s".', $argName, $fieldName, $typeName);
        if (isset($suggestedArgs[0])) {
            $message .= sprintf(' Did you mean %s?', Utils::quotedOrList($suggestedArgs));
        }

        return $message;
    }
}
