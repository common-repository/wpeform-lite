<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Error;

use LogicException;

/**
 * Note:
 * This exception should not inherit base Error exception as it is raised when there is an error somewhere in
 * user-land code
 */
class InvariantViolation extends LogicException
{
    public static function shouldNotHappen() : self
    {
        return new self('This should not have happened');
    }
}
