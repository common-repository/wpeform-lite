<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class FieldNode extends Node implements SelectionNode
{
    /** @var string */
    public $kind = NodeKind::FIELD;

    /** @var NameNode */
    public $name;

    /** @var NameNode|null */
    public $alias;

    /** @var NodeList<ArgumentNode> */
    public $arguments;

    /** @var NodeList<DirectiveNode> */
    public $directives;

    /** @var SelectionSetNode|null */
    public $selectionSet;
}
