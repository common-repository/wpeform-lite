<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class ListTypeNode extends Node implements TypeNode
{
    /** @var string */
    public $kind = NodeKind::LIST_TYPE;

    /** @var NamedTypeNode|ListTypeNode|NonNullTypeNode */
    public $type;
}
