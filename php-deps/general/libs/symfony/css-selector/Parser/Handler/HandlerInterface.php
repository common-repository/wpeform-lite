<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace WPEForm\GeneralDeps\Symfony\Component\CssSelector\Parser\Handler;

use WPEForm\GeneralDeps\Symfony\Component\CssSelector\Parser\Reader;
use WPEForm\GeneralDeps\Symfony\Component\CssSelector\Parser\TokenStream;

/**
 * CSS selector handler interface.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
interface HandlerInterface
{
    public function handle(Reader $reader, TokenStream $stream): bool;
}