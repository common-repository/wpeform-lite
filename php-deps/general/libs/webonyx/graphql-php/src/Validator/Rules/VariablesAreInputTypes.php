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
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\Printer;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Utils\TypeInfo;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class VariablesAreInputTypes extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        return [
            NodeKind::VARIABLE_DEFINITION => static function (VariableDefinitionNode $node) use ($context) : void {
                $type = TypeInfo::typeFromAST($context->getSchema(), $node->type);

                // If the variable type is not an input type, return an error.
                if (! $type || Type::isInputType($type)) {
                    return;
                }

                $variableName = $node->variable->name->value;
                $context->reportError(new Error(
                    self::nonInputTypeOnVarMessage($variableName, Printer::doPrint($node->type)),
                    [$node->type]
                ));
            },
        ];
    }

    public static function nonInputTypeOnVarMessage($variableName, $typeName)
    {
        return sprintf('Variable "$%s" cannot be non-input type "%s".', $variableName, $typeName);
    }
}
