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
 * @subpackage Type
 */

namespace WPEForm\GraphQL;

use WPEForm\Exception\InvalidGraphQLRegistryException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Registry for our EForm GraphQL types, inputs etc.
 */
class Registry {

	/**
	 * All registry instances.
	 *
	 * @var array
	 */
	private static $instances = [];

	/**
	 * A dynamic binding to the types class for instantiating the types only
	 * once.
	 *
	 * @throws InvalidGraphQLRegistryException If the corresponding type is not found.
	 *
	 * @param string $name Name of the class.
	 * @param string $type Type of the class as present in namespace.
	 *                     One of `input`, `type`, `enum` and `interface`.
	 *
	 * @return \WPEForm\GeneralDeps\GraphQL\Type\Definition\Type A type from registry.
	 */
	public static function get( $name, $type ) : \WPEForm\GeneralDeps\GraphQL\Type\Definition\Type {
		// for the lookup, we need everything lowercased
		$name_lookup = \strtolower( $name );
		$type_lookup = \strtolower( $type );

		// if it is already instantiated, then just return it
		if ( isset( self::$instances[ $name_lookup ][ $type_lookup ] ) ) {
			return self::$instances[ $name_lookup ][ $type_lookup ];
		}

		$namespace = array_map(
			function( $str ) {
					return ucfirst( $str );
			}, (array) explode( '/', $type )
		);
		$namespace = implode( '\\', $namespace );

		// try to create a new instance of the class is found
		$classname = 'WPEForm\\GraphQL\\' . $namespace . '\\' . ucfirst( $name );

		// if class not exists, then throw an error
		if ( ! \class_exists( $classname ) ) {
			throw new InvalidGraphQLRegistryException( "Class {$classname} for name {$name} and type {$type} does not exist." );
		}

		self::$instances[ $name_lookup ][ $type_lookup ] = new $classname();
		return self::$instances[ $name_lookup ][ $type_lookup ];
	}
}
