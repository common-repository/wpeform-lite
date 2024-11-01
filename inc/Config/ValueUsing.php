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
 * @subpackage Config
 */

namespace WPEForm\Config;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A configuration class for defining ValueUsing of Elements.
 *
 * @package WPEForm\Config
 */
class ValueUsing {
	/**
	 * The delimiter.
	 *
	 * @var Delimiter
	 */
	protected $delimiter;

	/**
	 * Type of value. label or id.
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Return type. string or json
	 *
	 * @var string
	 */
	protected $return;


}
