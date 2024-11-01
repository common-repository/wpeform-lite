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
 * @subpackage GraphQL\Field
 */

namespace WPEForm\GraphQL\Field;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * An abstract class for all parent Field classes.
 *
 * It forces some implementation details so that we don't make any mistakes.
 */
abstract class Base {
	/**
	 * Static variable to hold single instance of Type.
	 *
	 * @var array
	 */
	private static $type_fields = null;

	/**
	 * Static variable to hold single instance of InputType.
	 *
	 * @var array
	 */
	private static $input_fields = null;

	/**
	 * Get Type fields for Page Config.
	 *
	 * @return array
	 */
	public static function get_type_fields() {
		if ( null !== static::$type_fields ) {
			return static::$type_fields;
		}

		// Create the type once
		$fields = array_merge(
			static::common_fields(),
			static::type_fields()
		);

		// store it
		static::$type_fields = $fields;

		return static::$type_fields;
	}

	/**
	 * Get Input fields for Page Config.
	 *
	 * @return array
	 */
	public static function get_input_fields() {
		if ( null !== static::$input_fields ) {
			return static::$input_fields;
		}

		$fields = array_merge(
			static::common_fields(),
			static::input_fields()
		);

		// store it
		static::$input_fields = $fields;

		return static::$input_fields;
	}

	/**
	 * Get common fields for both input and type.
	 *
	 * @return array Array of Scalar Types.
	 */
	abstract public static function common_fields();

	/**
	 * Fields specific to Types.
	 *
	 * @return array Array of scalar types.
	 */
	public static function type_fields() {
		return [];
	}

	/**
	 * Fields specific to Input.
	 *
	 * @return array Array of scalar inputs.
	 */
	public static function input_fields() {
		return [];
	}
}
