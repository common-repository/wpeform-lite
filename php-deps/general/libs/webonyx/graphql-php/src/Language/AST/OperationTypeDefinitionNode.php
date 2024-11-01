<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class OperationTypeDefinitionNode extends Node
{
    /** @var string */
    public $kind = NodeKind::OPERATION_TYPE_DEFINITION;

    /**
     * One of 'query' | 'mutation' | 'subscription'
     *
     * @var string
     */
    public $operation;

    /** @var NamedTypeNode */
    public $type;
}
