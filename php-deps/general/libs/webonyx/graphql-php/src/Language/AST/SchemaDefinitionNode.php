<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class SchemaDefinitionNode extends Node implements TypeSystemDefinitionNode
{
    /** @var string */
    public $kind = NodeKind::SCHEMA_DEFINITION;

    /** @var NodeList<DirectiveNode> */
    public $directives;

    /** @var NodeList<OperationTypeDefinitionNode> */
    public $operationTypes;
}
