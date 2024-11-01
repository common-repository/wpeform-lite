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
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\OperationDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\Visitor;
use WPEForm\GeneralDeps\GraphQL\Language\VisitorOperation;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class NoUnusedFragments extends ValidationRule
{
    /** @var OperationDefinitionNode[] */
    public $operationDefs;

    /** @var FragmentDefinitionNode[] */
    public $fragmentDefs;

    public function getVisitor(ValidationContext $context)
    {
        $this->operationDefs = [];
        $this->fragmentDefs  = [];

        return [
            NodeKind::OPERATION_DEFINITION => function ($node) : VisitorOperation {
                $this->operationDefs[] = $node;

                return Visitor::skipNode();
            },
            NodeKind::FRAGMENT_DEFINITION  => function (FragmentDefinitionNode $def) : VisitorOperation {
                $this->fragmentDefs[] = $def;

                return Visitor::skipNode();
            },
            NodeKind::DOCUMENT             => [
                'leave' => function () use ($context) : void {
                    $fragmentNameUsed = [];

                    foreach ($this->operationDefs as $operation) {
                        foreach ($context->getRecursivelyReferencedFragments($operation) as $fragment) {
                            $fragmentNameUsed[$fragment->name->value] = true;
                        }
                    }

                    foreach ($this->fragmentDefs as $fragmentDef) {
                        $fragName = $fragmentDef->name->value;
                        if ($fragmentNameUsed[$fragName] ?? false) {
                            continue;
                        }

                        $context->reportError(new Error(
                            self::unusedFragMessage($fragName),
                            [$fragmentDef]
                        ));
                    }
                },
            ],
        ];
    }

    public static function unusedFragMessage($fragName)
    {
        return sprintf('Fragment "%s" is never used.', $fragName);
    }
}
