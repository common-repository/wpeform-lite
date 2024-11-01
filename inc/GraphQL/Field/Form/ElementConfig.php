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

namespace WPEForm\GraphQL\Field\Form;

use WPEForm\GraphQL\Field\Base;
use WPEForm\Factory\Form\Elements;
use WPEForm\GraphQL\Util\TypeOrInputFromFields;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to dynamically generate Element Config fields
 */
class ElementConfig extends Base {
	/**
	 * Static variable to hold single instance of Element Type.
	 *
	 * @var array
	 */
	protected static $type_fields = null;

	/**
	 * Static variable to hold single instance of Element InputType.
	 *
	 * @var array
	 */
	protected static $input_fields = null;

	/**
	 * {@inheritDoc}
	 *
	 * @return array Array of Scalar Types.
	 */
	public static function common_fields() {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array Array of Scalar Types.
	 */
	public static function type_fields() {
		$elements = Elements::get_registered_elements_names();
		$fields = [];
		foreach ( $elements as $element ) {
			$config_vars = Elements::get_element_config_vars( $element );
			// if config is empty, like in row, column, group
			// we don't add it to the type, its redundant
			if ( ! empty( $config_vars ) ) {
				$fields[ $element ] = TypeOrInputFromFields::create_type(
					$config_vars,
					'FormElement' . ucfirst( $element ) . 'Config'
				);
			}
		}
		return $fields;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array Array of Scalar Types.
	 */
	public static function input_fields() {
		$elements = Elements::get_registered_elements_names();
		$fields = [];
		foreach ( $elements as $element ) {
			$config_vars = Elements::get_element_config_vars( $element );
			if ( ! empty( $config_vars ) ) {
				$fields[ $element ] = TypeOrInputFromFields::create_input(
					$config_vars,
					'FormElement' . ucfirst( $element ) . 'Config'
				);
			}
		}
		return $fields;
	}
}
