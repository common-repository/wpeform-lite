<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class ObjectTypeExtensionNode extends Node implements TypeExtensionNode
{
    /** @var string */
    public $kind = NodeKind::OBJECT_TYPE_EXTENSION;

    /** @var NameNode */
    public $name;

    /** @var NodeList<NamedTypeNode> */
    public $interfaces;

    /** @var NodeList<DirectiveNode> */
    public $directives;

    /** @var NodeList<FieldDefinitionNode> */
    public $fields;
}