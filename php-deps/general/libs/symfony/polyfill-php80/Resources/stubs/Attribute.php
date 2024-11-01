<?php

#[WPEForm_GeneralDeps_Attribute(Attribute::TARGET_CLASS)]
final class WPEForm_GeneralDeps_Attribute
{
    public const TARGET_CLASS = 1;
    public const TARGET_FUNCTION = 2;
    public const TARGET_METHOD = 4;
    public const TARGET_PROPERTY = 8;
    public const TARGET_CLASS_CONSTANT = 16;
    public const TARGET_PARAMETER = 32;
    public const TARGET_ALL = 63;
    public const IS_REPEATABLE = 64;

    /** @var int *
 * @license MIT
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */
    public $flags;

    public function __construct(int $flags = self::TARGET_ALL)
    {
        $this->flags = $flags;
    }
}
