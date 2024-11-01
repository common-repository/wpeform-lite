<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL;

use WPEForm\GeneralDeps\GraphQL\Executor\Promise\Adapter\SyncPromise;

class Deferred extends SyncPromise
{
    /**
     * @param callable() : mixed $executor
     */
    public static function create(callable $executor) : self
    {
        return new self($executor);
    }

    /**
     * @param callable() : mixed $executor
     */
    public function __construct(callable $executor)
    {
        parent::__construct($executor);
    }
}
