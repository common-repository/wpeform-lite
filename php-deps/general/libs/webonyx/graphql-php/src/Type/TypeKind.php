<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Type;

class TypeKind
{
    const SCALAR       = 'SCALAR';
    const OBJECT       = 'OBJECT';
    const INTERFACE    = 'INTERFACE';
    const UNION        = 'UNION';
    const ENUM         = 'ENUM';
    const INPUT_OBJECT = 'INPUT_OBJECT';
    const LIST         = 'LIST';
    const NON_NULL     = 'NON_NULL';
}
