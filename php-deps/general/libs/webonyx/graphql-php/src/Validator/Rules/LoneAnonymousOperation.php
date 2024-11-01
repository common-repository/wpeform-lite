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
use WPEForm\GeneralDeps\GraphQL\Language\AST\DocumentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\Node;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\OperationDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function count;

/**
 * Lone anonymous operation
 *
 * A GraphQL document is only valid if when it contains an anonymous operation
 * (the query short-hand) that it contains only that one operation definition.
 */
class LoneAnonymousOperation extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        $operationCount = 0;

        return [
            NodeKind::DOCUMENT             => static function (DocumentNode $node) use (&$operationCount) : void {
                $tmp = Utils::filter(
                    $node->definitions,
                    static function (Node $definition) : bool {
                        return $definition instanceof OperationDefinitionNode;
                    }
                );

                $operationCount = count($tmp);
            },
            NodeKind::OPERATION_DEFINITION => static function (OperationDefinitionNode $node) use (
                &$operationCount,
                $context
            ) : void {
                if ($node->name !== null || $operationCount <= 1) {
                    return;
                }

                $context->reportError(
                    new Error(self::anonOperationNotAloneMessage(), [$node])
                );
            },
        ];
    }

    public static function anonOperationNotAloneMessage()
    {
        return 'This anonymous operation must be the only defined operation.';
    }
}
