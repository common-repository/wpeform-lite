<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class FieldDefinitionNode extends Node
{
    /** @var string */
    public $kind = NodeKind::FIELD_DEFINITION;

    /** @var NameNode */
    public $name;

    /** @var NodeList<InputValueDefinitionNode> */
    public $arguments;

    /** @var NamedTypeNode|ListTypeNode|NonNullTypeNode */
    public $type;

    /** @var NodeList<DirectiveNode> */
    public $directives;

    /** @var StringValueNode|null */
    public $description;
}
