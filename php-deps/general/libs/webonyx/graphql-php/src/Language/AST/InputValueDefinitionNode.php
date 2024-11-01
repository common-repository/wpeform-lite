<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class InputValueDefinitionNode extends Node
{
    /** @var string */
    public $kind = NodeKind::INPUT_VALUE_DEFINITION;

    /** @var NameNode */
    public $name;

    /** @var NamedTypeNode|ListTypeNode|NonNullTypeNode */
    public $type;

    /** @var VariableNode|NullValueNode|IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|EnumValueNode|ListValueNode|ObjectValueNode|null */
    public $defaultValue;

    /** @var NodeList<DirectiveNode> */
    public $directives;

    /** @var StringValueNode|null */
    public $description;
}
