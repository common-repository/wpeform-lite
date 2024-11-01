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
use WPEForm\GeneralDeps\GraphQL\Language\AST\OperationDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\Visitor;
use WPEForm\GeneralDeps\GraphQL\Language\VisitorOperation;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class UniqueOperationNames extends ValidationRule
{
    /** @var NameNode[] */
    public $knownOperationNames;

    public function getVisitor(ValidationContext $context)
    {
        $this->knownOperationNames = [];

        return [
            NodeKind::OPERATION_DEFINITION => function (OperationDefinitionNode $node) use ($context) : VisitorOperation {
                $operationName = $node->name;

                if ($operationName !== null) {
                    if (! isset($this->knownOperationNames[$operationName->value])) {
                        $this->knownOperationNames[$operationName->value] = $operationName;
                    } else {
                        $context->reportError(new Error(
                            self::duplicateOperationNameMessage($operationName->value),
                            [$this->knownOperationNames[$operationName->value], $operationName]
                        ));
                    }
                }

                return Visitor::skipNode();
            },
            NodeKind::FRAGMENT_DEFINITION  => static function () : VisitorOperation {
                return Visitor::skipNode();
            },
        ];
    }

    public static function duplicateOperationNameMessage($operationName)
    {
        return sprintf('There can be only one operation named "%s".', $operationName);
    }
}
