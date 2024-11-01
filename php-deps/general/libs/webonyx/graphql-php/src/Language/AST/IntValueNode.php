<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class IntValueNode extends Node implements ValueNode
{
    /** @var string */
    public $kind = NodeKind::INT;

    /** @var string */
    public $value;
}
