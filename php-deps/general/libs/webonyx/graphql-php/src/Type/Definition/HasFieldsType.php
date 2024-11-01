<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Type\Definition;

use WPEForm\GeneralDeps\GraphQL\Error\InvariantViolation;

interface HasFieldsType
{
    /**
     * @throws InvariantViolation
     */
    public function getField(string $name) : FieldDefinition;

    public function hasField(string $name) : bool;

    public function findField(string $name) : ?FieldDefinition;

    /**
     * @return array<string, FieldDefinition>
     *
     * @throws InvariantViolation
     */
    public function getFields() : array;

    /**
     * @return array<int, string>
     *
     * @throws InvariantViolation
     */
    public function getFieldNames() : array;
}
