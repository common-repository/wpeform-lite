<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class VariableDefinitionNode extends Node implements DefinitionNode
{
    /** @var string */
    public $kind = NodeKind::VARIABLE_DEFINITION;

    /** @var VariableNode */
    public $variable;

    /** @var NamedTypeNode|ListTypeNode|NonNullTypeNode */
    public $type;

    /** @var VariableNode|NullValueNode|IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|EnumValueNode|ListValueNode|ObjectValueNode|null */
    public $defaultValue;

    /** @var NodeList<DirectiveNode> */
    public $directives;
}
