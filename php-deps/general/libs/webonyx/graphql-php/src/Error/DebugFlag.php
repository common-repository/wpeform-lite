<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Error;

/**
 * Collection of flags for [error debugging](error-handling.md#debugging-tools).
 */
final class DebugFlag
{
    public const NONE                        = 0;
    public const INCLUDE_DEBUG_MESSAGE       = 1;
    public const INCLUDE_TRACE               = 2;
    public const RETHROW_INTERNAL_EXCEPTIONS = 4;
    public const RETHROW_UNSAFE_EXCEPTIONS   = 8;
}
