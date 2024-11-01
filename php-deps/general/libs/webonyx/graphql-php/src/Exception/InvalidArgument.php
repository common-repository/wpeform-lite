<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Exception;

use InvalidArgumentException;
use function gettype;
use function sprintf;

final class InvalidArgument extends InvalidArgumentException
{
    /**
     * @param mixed $argument
     */
    public static function fromExpectedTypeAndArgument(string $expectedType, $argument) : self
    {
        return new self(sprintf('Expected type "%s", got "%s"', $expectedType, gettype($argument)));
    }
}
