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
use WPEForm\GeneralDeps\GraphQL\Language\AST\NameNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class UniqueVariableNames extends ValidationRule
{
    /** @var NameNode[] */
    public $knownVariableNames;

    public function getVisitor(ValidationContext $context)
    {
        $this->knownVariableNames = [];

        return [
            NodeKind::OPERATION_DEFINITION => function () : void {
                $this->knownVariableNames = [];
            },
            NodeKind::VARIABLE_DEFINITION  => function (VariableDefinitionNode $node) use ($context) : void {
                $variableName = $node->variable->name->value;
                if (! isset($this->knownVariableNames[$variableName])) {
                    $this->knownVariableNames[$variableName] = $node->variable->name;
                } else {
                    $context->reportError(new Error(
                        self::duplicateVariableMessage($variableName),
                        [$this->knownVariableNames[$variableName], $node->variable->name]
                    ));
                }
            },
        ];
    }

    public static function duplicateVariableMessage($variableName)
    {
        return sprintf('There can be only one variable named "%s".', $variableName);
    }
}
