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

use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Field\Base;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Fields for Element -> Config -> Validation -> Masks.
 */
class ElementConfigMasks extends Base {
	/**
	 * Static variable to hold single instance of Type.
	 *
	 * @var array
	 */
	protected static $type_fields = null;

	/**
	 * Static variable to hold single instance of InputType.
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
		return [
			// some items are nullable, because depending on maskType different items
			// could become null
			'maskType' => Registry::get( 'maskType', 'enum' ),
			'maskPreset' => [
				'type' => Type::string(),
				'description' => __( 'Predefined mask.', 'wp-eform' ),
			],
			'maskString' => [
				'type' => Type::string(),
				'description' => __( 'Mask from user input.', 'wp-eform' ),
			],
			'placeholder' => Type::nonNull( Type::string() ),
			'alwaysShowMask' => Type::nonNull( Type::boolean() ),
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function type_fields() {
		return [
			'maskRegExps' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull(
							Registry::get( 'maskRegExp', 'type/form/element/config' )
						)
					)
				),
				'description' => __( 'List of regular expressions in sequence.', 'wp-eform' ),
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function input_fields() {
		return [
			'maskRegExps' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull(
							Registry::get( 'maskRegExp', 'input/form/element/config' )
						)
					)
				),
				'description' => __( 'List of regular expressions in sequence.', 'wp-eform' ),
			],
		];
	}
}
