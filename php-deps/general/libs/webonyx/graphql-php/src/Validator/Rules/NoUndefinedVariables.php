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
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\OperationDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

/**
 * A GraphQL operation is only valid if all variables encountered, both directly
 * and via fragment spreads, are defined by that operation.
 */
class NoUndefinedVariables extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        $variableNameDefined = [];

        return [
            NodeKind::OPERATION_DEFINITION => [
                'enter' => static function () use (&$variableNameDefined) : void {
                    $variableNameDefined = [];
                },
                'leave' => static function (OperationDefinitionNode $operation) use (&$variableNameDefined, $context) : void {
                    $usages = $context->getRecursiveVariableUsages($operation);

                    foreach ($usages as $usage) {
                        $node    = $usage['node'];
                        $varName = $node->name->value;

                        if ($variableNameDefined[$varName] ?? false) {
                            continue;
                        }

                        $context->reportError(new Error(
                            self::undefinedVarMessage(
                                $varName,
                                $operation->name !== null
                                    ? $operation->name->value
                                    : null
                            ),
                            [$node, $operation]
                        ));
                    }
                },
            ],
            NodeKind::VARIABLE_DEFINITION  => static function (VariableDefinitionNode $def) use (&$variableNameDefined) : void {
                $variableNameDefined[$def->variable->name->value] = true;
            },
        ];
    }

    public static function undefinedVarMessage($varName, $opName = null)
    {
        return $opName
            ? sprintf('Variable "$%s" is not defined by operation "%s".', $varName, $opName)
            : sprintf('Variable "$%s" is not defined.', $varName);
    }
}
