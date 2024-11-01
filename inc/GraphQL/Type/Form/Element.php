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
 * @subpackage GraphQL\Type\Form
 */

namespace WPEForm\GraphQL\Type\Form;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\Factory\Form\Elements;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for FormElement Type.
 */
class Element extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormElementType',
			'fields' => [
				'id' => Type::nonNull( Type::id() ),
				// we don't use ENUM for element type intentionally,
				// because if some add-on registers an element type and laters the
				// add-on is removed, then it would throw error on GraphQL
				// rather have a registry of registered element types on JavaScript
				// as well, and show proper UI if the element isn't registered anymore.
				'type' => Type::nonNull( Type::string() ),
				'appearance' => Type::nonNull(
					Registry::get( 'appearance', 'type/form/element' )
				),
				'config' => [
					// this is nullable purposefully because if element doesn't exist anymore
					// or there is some issue in the element structure, we will return null
					'type' => Registry::get( 'config', 'type/form/element' ),
					'resolve' => function( $root ) {
						// extract the element type from the object
						$element_type = $root['type'] ?? null;
						// if element type is null (not set) or isn't registered anymore
						// then return null data
						if (
							$element_type === null
							|| ! Elements::has_element( $element_type )
						) {
							return null;
						}

						// create the new element config for the default root resolver
						$element_config = $root['config'] ?? [];

						return $element_config;
					},
				],
				'extras' => [
					'type' => Type::string(),
					'resolve' => function( $root ) {
						// extract extra data directly from element class
						$element_type = $root['type'] ?? null;
						// if element is not present, then always return null
						if (
							$element_type === null
							|| ! Elements::has_element( $element_type )
						) {
							return null;
						}

						// extract config
						$element_config = $root['config'] ?? [];
						$specific_config = $element_config[ $element_type ] ?? null;

						return Elements::get_element_extra_type_data( $element_type, $specific_config );
					},
				],
				'children' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
			],
		];
		parent::__construct( $config );
	}
}
