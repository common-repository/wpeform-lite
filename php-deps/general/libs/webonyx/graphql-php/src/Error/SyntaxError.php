<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Error;

use WPEForm\GeneralDeps\GraphQL\Language\Source;
use function sprintf;

class SyntaxError extends Error
{
    /**
     * @param int    $position
     * @param string $description
     */
    public function __construct(Source $source, $position, $description)
    {
        parent::__construct(
            sprintf('Syntax Error: %s', $description),
            null,
            $source,
            [$position]
        );
    }
}
