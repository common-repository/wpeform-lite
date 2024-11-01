<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Utils;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\InterfaceType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;

/**
 * A way to track interface implementations.
 *
 * Distinguishes between implementations by ObjectTypes and InterfaceTypes.
 */
class InterfaceImplementations
{
    /** @var array<int, ObjectType> */
    private $objects;

    /** @var array<int, InterfaceType> */
    private $interfaces;

    /**
     * @param array<int, ObjectType>    $objects
     * @param array<int, InterfaceType> $interfaces
     */
    public function __construct(array $objects, array $interfaces)
    {
        $this->objects    = $objects;
        $this->interfaces = $interfaces;
    }

    /**
     * @return array<int, ObjectType>
     */
    public function objects() : array
    {
        return $this->objects;
    }

    /**
     * @return array<int, InterfaceType>
     */
    public function interfaces() : array
    {
        return $this->interfaces;
    }
}
