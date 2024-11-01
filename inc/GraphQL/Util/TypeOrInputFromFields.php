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
 * @subpackage GraphQL\Util
 */

namespace WPEForm\GraphQL\Util;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Exception\InvalidFieldVarException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * An utility class to easily create types and/or inputs based on an array of
 * fields of scalars or an array.
 *
 * This class gurantees that for a given $name_prefix the Type or InputObjectType
 * will be created only once.
 */
class TypeOrInputFromFields {
	/**
	 * Already created types based on name.
	 *
	 * @var array
	 */
	protected static $types = [];

	/**
	 * Already created inputs based on name.
	 *
	 * @var array
	 */
	protected static $inputs = [];

	/**
	 * Create type fields from an array of FieldVars.
	 *
	 * @throws InvalidFieldVarException If a value is not array or instance of FieldVar or Type.
	 *
	 * @param FieldVar[] $arr_fields Array of FieldVar items.
	 * @param string     $name_prefix Name prefix.
	 *
	 * @return array
	 */
	public static function create_type_fields( array $arr_fields, string $name_prefix ) : array {
		$fields = [];
		foreach ( $arr_fields as $key => $value ) {
			if ( is_array( $value ) ) {
				$fields[ $key ] = self::create_type( $value, $name_prefix . ucfirst( $key ) );
			} elseif ( $value instanceof FieldVar ) {
				$fields[ $key ] = [
					'type' => $value->getType(),
					'defaultValue' => $value->getDefault(),
				];
			} elseif ( $value instanceof Type ) {
				$fields[ $key ] = $value;
			} else {
				throw new InvalidFieldVarException(
					sprintf(
						'Expecting either array, or instance of FieldVar or Type. Found %s in position %s',
						gettype( $value ),
						$key
					)
				);
			}
		}

		return $fields;
	}

	/**
	 * Create type from a set of fields and type name.
	 *
	 * @param array  $arr_fields Fields of scalars or array.
	 * @param string $name_prefix Type name prefix.
	 * @return ObjectType
	 */
	public static function create_type( array $arr_fields, string $name_prefix ) : \WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType {
		$type_name = $name_prefix . 'Type';
		if ( isset( self::$types[ $type_name ] ) ) {
			return self::$types[ $type_name ];
		}

		self::$types[ $type_name ] = new ObjectType(
			[
				'name' => $type_name,
				'fields' => self::create_type_fields( $arr_fields, $name_prefix ),
			]
		);
		return self::$types[ $type_name ];
	}

	/**
	 * Create input fields from an array of FieldVars.
	 *
	 * @throws InvalidFieldVarException If a value is not array or instance of FieldVar or Type.
	 *
	 * @param FieldVar[] $arr_fields Array of FieldVar items.
	 * @param string     $name_prefix Name prefix.
	 *
	 * @return array
	 */
	public static function create_input_fields( array $arr_fields, string $name_prefix ) : array {
		$fields = [];
		foreach ( $arr_fields as $key => $value ) {
			if ( is_array( $value ) ) {
				$fields[ $key ] = self::create_input( $value, $name_prefix . ucfirst( $key ) );
			} elseif ( $value instanceof FieldVar ) {
				$fields[ $key ] = [
					'type' => $value->getInput(),
					'defaultValue' => $value->getDefault(),
				];
			} elseif ( $value instanceof Type ) {
				$fields[ $key ] = $value;
			} else {
				throw new InvalidFieldVarException(
					sprintf(
						'Expecting either array, or instance of FieldVar or Type. Found %s in position %s',
						gettype( $value ),
						$key
					)
				);
			}
		}
		return $fields;
	}

	/**
	 * Create Input from a set of fields and Input name.
	 *
	 * @param array  $arr_fields Fields of scalars or array.
	 * @param string $name_prefix Input name prefix.
	 * @return InputObjectType
	 */
	public static function create_input( array $arr_fields, string $name_prefix ) : \WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType {
		$input_name = $name_prefix . 'Input';
		if ( isset( self::$inputs[ $input_name ] ) ) {
			return self::$inputs[ $input_name ];
		}

		self::$inputs[ $input_name ] = new InputObjectType(
			[
				'name' => $input_name,
				'fields' => self::create_input_fields( $arr_fields, $name_prefix ),
			]
		);
		return self::$inputs[ $input_name ];
	}

	/**
	 * Create type and input from a given array fields and name prefix. The return
	 * is a touple, where the first one is type and second one is input.
	 *
	 * @param array  $arr_fields Fields of scalars or array.
	 * @param string $name_prefix Type/Input name prefix.
	 * @return array{ 0: \WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType, 1: \WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType }
	 */
	public static function create_type_and_input( array $arr_fields, string $name_prefix ) : array {
		return [
			self::create_type( $arr_fields, $name_prefix ),
			self::create_input( $arr_fields, $name_prefix ),
		];
	}
}
