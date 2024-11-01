<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language;

use JsonSerializable;

class SourceLocation implements JsonSerializable
{
    /** @var int */
    public $line;

    /** @var int */
    public $column;

    /**
     * @param int $line
     * @param int $col
     */
    public function __construct($line, $col)
    {
        $this->line   = $line;
        $this->column = $col;
    }

    /**
     * @return int[]
     */
    public function toArray()
    {
        return [
            'line'   => $this->line,
            'column' => $this->column,
        ];
    }

    /**
     * @return int[]
     */
    public function toSerializableArray()
    {
        return $this->toArray();
    }

    /**
     * @return int[]
     */
    public function jsonSerialize()
    {
        return $this->toSerializableArray();
    }
}
