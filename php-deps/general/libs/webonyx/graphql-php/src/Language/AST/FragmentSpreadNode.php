<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class FragmentSpreadNode extends Node implements SelectionNode
{
    /** @var string */
    public $kind = NodeKind::FRAGMENT_SPREAD;

    /** @var NameNode */
    public $name;

    /** @var NodeList<DirectiveNode> */
    public $directives;
}