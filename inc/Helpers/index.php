<?php
/**
 * Copyright (C) 2018 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of eForm - WordPress Builder.
 *
 * eForm - WordPress Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * eForm - WordPress Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with eForm - WordPress Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package EForm
 * @subpackage Helpers
 */

namespace WPEForm\Helpers;

// auto-load files if function not already defined

/**
 * Autoload everything, if at-least one of the function isn't defined.
 */
if ( ! function_exists( '\\WPEForm\\Helpers\\parse_args' ) ) {
	require_once __DIR__ . '/arrays.php';
	require_once __DIR__ . '/datatypes.php';
	require_once __DIR__ . '/datetime.php';
	require_once __DIR__ . '/normalizers.php';
	require_once __DIR__ . '/validators.php';
	require_once __DIR__ . '/formatters.php';
	require_once __DIR__ . '/element.php';
	require_once __DIR__ . '/wp.php';
}
