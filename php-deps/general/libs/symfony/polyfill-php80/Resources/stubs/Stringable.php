<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

if (\PHP_VERSION_ID < 80000) {
    interface WPEForm_GeneralDeps_Stringable
    {
        /**
         * @return string
         */
        public function __toString();
    }
}
