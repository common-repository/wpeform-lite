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
use WPEForm\GeneralDeps\GraphQL\Language\AST\NameNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\Visitor;
use WPEForm\GeneralDeps\GraphQL\Language\VisitorOperation;
use WPEForm\GeneralDeps\GraphQL\Validator\ASTValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\SDLValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class UniqueArgumentNames extends ValidationRule
{
    /** @var NameNode[] */
    public $knownArgNames;

    public function getSDLVisitor(SDLValidationContext $context)
    {
        return $this->getASTVisitor($context);
    }

    public function getVisitor(ValidationContext $context)
    {
        return $this->getASTVisitor($context);
    }

    public function getASTVisitor(ASTValidationContext $context)
    {
        $this->knownArgNames = [];

        return [
            NodeKind::FIELD     => function () : void {
                $this->knownArgNames = [];
            },
            NodeKind::DIRECTIVE => function () : void {
                $this->knownArgNames = [];
            },
            NodeKind::ARGUMENT  => function (ArgumentNode $node) use ($context) : VisitorOperation {
                $argName = $node->name->value;
                if ($this->knownArgNames[$argName] ?? false) {
                    $context->reportError(new Error(
                        self::duplicateArgMessage($argName),
                        [$this->knownArgNames[$argName], $node->name]
                    ));
                } else {
                    $this->knownArgNames[$argName] = $node->name;
                }

                return Visitor::skipNode();
            },
        ];
    }

    public static function duplicateArgMessage($argName)
    {
        return sprintf('There can be only one argument named "%s".', $argName);
    }
}
