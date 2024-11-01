<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Type\Definition;

use WPEForm\GeneralDeps\GraphQL\Type\Schema;
use function is_callable;

class ListOfType extends Type implements WrappingType, OutputType, NullableType, InputType
{
    /** @var callable():Type|Type */
    public $ofType;

    /**
     * @param callable():Type|Type $type
     */
    public function __construct($type)
    {
        $this->ofType = is_callable($type) ? $type : Type::assertType($type);
    }

    public function toString() : string
    {
        return '[' . $this->getOfType()->toString() . ']';
    }

    public function getOfType()
    {
        return Schema::resolveType($this->ofType);
    }

    public function getWrappedType(bool $recurse = false) : Type
    {
        $type = $this->getOfType();

        return $recurse && $type instanceof WrappingType
            ? $type->getWrappedType($recurse)
            : $type;
    }
}
