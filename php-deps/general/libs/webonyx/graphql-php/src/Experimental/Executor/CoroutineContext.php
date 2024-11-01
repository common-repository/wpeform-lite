<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Experimental\Executor;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;

/**
 * @internal
 */
class CoroutineContext
{
    /** @var CoroutineContextShared */
    public $shared;

    /** @var ObjectType */
    public $type;

    /** @var mixed */
    public $value;

    /** @var object */
    public $result;

    /** @var string[] */
    public $path;

    /** @var ResolveInfo */
    public $resolveInfo;

    /** @var string[]|null */
    public $nullFence;

    /**
     * @param mixed         $value
     * @param object        $result
     * @param string[]      $path
     * @param string[]|null $nullFence
     */
    public function __construct(
        CoroutineContextShared $shared,
        ObjectType $type,
        $value,
        $result,
        array $path,
        ?array $nullFence = null
    ) {
        $this->shared    = $shared;
        $this->type      = $type;
        $this->value     = $value;
        $this->result    = $result;
        $this->path      = $path;
        $this->nullFence = $nullFence;
    }
}
