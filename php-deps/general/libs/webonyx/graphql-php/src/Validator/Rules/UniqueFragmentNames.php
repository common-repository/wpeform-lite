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
use WPEForm\GeneralDeps\GraphQL\Language\AST\NameNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\Visitor;
use WPEForm\GeneralDeps\GraphQL\Language\VisitorOperation;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class UniqueFragmentNames extends ValidationRule
{
    /** @var NameNode[] */
    public $knownFragmentNames;

    public function getVisitor(ValidationContext $context)
    {
        $this->knownFragmentNames = [];

        return [
            NodeKind::OPERATION_DEFINITION => static function () : VisitorOperation {
                return Visitor::skipNode();
            },
            NodeKind::FRAGMENT_DEFINITION  => function (FragmentDefinitionNode $node) use ($context) : VisitorOperation {
                $fragmentName = $node->name->value;
                if (! isset($this->knownFragmentNames[$fragmentName])) {
                    $this->knownFragmentNames[$fragmentName] = $node->name;
                } else {
                    $context->reportError(new Error(
                        self::duplicateFragmentNameMessage($fragmentName),
                        [$this->knownFragmentNames[$fragmentName], $node->name]
                    ));
                }

                return Visitor::skipNode();
            },
        ];
    }

    public static function duplicateFragmentNameMessage($fragName)
    {
        return sprintf('There can be only one fragment named "%s".', $fragName);
    }
}
