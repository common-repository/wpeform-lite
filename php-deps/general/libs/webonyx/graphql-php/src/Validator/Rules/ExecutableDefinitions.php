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
use WPEForm\GeneralDeps\GraphQL\Language\AST\ExecutableDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\TypeSystemDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\Visitor;
use WPEForm\GeneralDeps\GraphQL\Language\VisitorOperation;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

/**
 * Executable definitions
 *
 * A GraphQL document is only valid for execution if all definitions are either
 * operation or fragment definitions.
 */
class ExecutableDefinitions extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        return [
            NodeKind::DOCUMENT => static function (DocumentNode $node) use ($context) : VisitorOperation {
                /** @var ExecutableDefinitionNode|TypeSystemDefinitionNode $definition */
                foreach ($node->definitions as $definition) {
                    if ($definition instanceof ExecutableDefinitionNode) {
                        continue;
                    }

                    $context->reportError(new Error(
                        self::nonExecutableDefinitionMessage($definition->name->value),
                        [$definition->name]
                    ));
                }

                return Visitor::skipNode();
            },
        ];
    }

    public static function nonExecutableDefinitionMessage($defName)
    {
        return sprintf('The "%s" definition is not executable.', $defName);
    }
}
