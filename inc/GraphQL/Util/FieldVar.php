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

use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Exception\ValidationException;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\EnumType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ListOfType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\NonNull;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use LogicException;

// phpcs:disable WordPress.NamingConventions.ValidVariableName.NotSnakeCase

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A helper class to conveniently create configuration variables with co-locating
 * default value, GraphQL input and type.
 */
class FieldVar {
	/**
	 * The default value.
	 *
	 * @var mixed(string|bool|int|float)
	 */
	protected $default;

	/**
	 * The default value with Enum Name.
	 *
	 * @var mixed(string|bool|int|float|object)
	 */
	protected $defaultWithEnumName;

	/**
	 * GraphQL Scalar Type for `Type`.
	 *
	 * @var Type
	 */
	protected $type = null;

	/**
	 * GraphQL Scalar Type for `Input`.
	 *
	 * @var Type
	 */
	protected $input = null;

	/**
	 * Flag to set if the config var is nullable.
	 *
	 * @var bool
	 */
	protected $nullable = false;

	/**
	 * A validator callback function
	 *
	 * @var callable|null
	 */
	protected $validator = null;

	/**
	 * Set default value of the config var.
	 *
	 * @param mixed $default Default value.
	 * @return FieldVar
	 */
	public function setDefault( $default ) : FieldVar {
		$this->default = $default;
		return $this;
	}

	/**
	 * Set default with enum name value. Useful only for lists.
	 *
	 * @param mixed $defaultWithEnumName Value to set.
	 *
	 * @return FieldVar
	 */
	public function setDefaultWithEnumName( $defaultWithEnumName ) : FieldVar {
		$this->defaultWithEnumName = $defaultWithEnumName;
		return $this;
	}

	/**
	 * Set type of this config variable.
	 *
	 * @param Type $type GraphQL scalar type.
	 * @return FieldVar
	 *
	 * @throws LogicException If type is directly nonNull.
	 */
	public function setType( Type $type ) : FieldVar {
		if ( $type instanceof NonNull ) {
			throw new LogicException( 'Do not set nonNull on field vars.' );
		}
		$this->type = $type;
		return $this;
	}

	/**
	 * Set input type of this config variable.
	 *
	 * @param Type $input GraphQL input type.
	 * @return FieldVar
	 *
	 * @throws LogicException If input is directly nonNull.
	 */
	public function setInput( Type $input ) : FieldVar {
		if ( $input instanceof NonNull ) {
			throw new LogicException( 'Do not set nonNull on field vars.' );
		}
		$this->input = $input;
		return $this;
	}

	/**
	 * Set input and type of this config variable, when both are the same.
	 *
	 * @param Type $type GraphQL scalar type for `Type` and `Input`.
	 * @return FieldVar
	 */
	public function setTypeAndInput( Type $type ) : FieldVar {
		$this->type = $type;
		$this->input = $type;
		return $this;
	}

	/**
	 * Set input and type nullable. By default, the variable is not nullable,
	 * so any type you set, is passed through `Type::nonNull`, explicitly call
	 * this method with `true` as parameter to avoid this.
	 *
	 * @param bool $nullable Whether or not the variable is nullable.
	 * @return FieldVar
	 */
	public function setNullable( bool $nullable ) : FieldVar {
		$this->nullable = $nullable;
		return $this;
	}

	/**
	 * Get type of the config variable.
	 *
	 * @throws \LogicException If called before setting type.
	 *
	 * @return Type
	 */
	public function getType() : Type {
		if ( null === $this->type ) {
			throw new \LogicException( 'getType called before setType or type is null' );
		}
		if ( $this->nullable ) {
			return $this->type;
		}
		return Type::nonNull( $this->type );
	}

	/**
	 * Get type of the config variable.
	 *
	 * @throws \LogicException If called before setting type.
	 *
	 * @return Type
	 */
	public function getInput() : Type {
		if ( null === $this->input ) {
			throw new \LogicException( 'getInput called before setInput or input is null' );
		}
		if ( $this->nullable ) {
			return $this->input;
		}
		return Type::nonNull( $this->input );
	}

	/**
	 * Get default value of the config variable.
	 *
	 * @throws \LogicException If given default doesn't exist in given enum type.
	 *
	 * @return mixed
	 */
	public function getDefault() {
		return $this->default;
	}

	/**
	 * Get ENUM name by value.
	 *
	 * @throws \LogicException If given value could not be found.
	 *
	 * @param EnumType $type EnumType instance.
	 * @param string   $value Value as stored.
	 *
	 * @return string Enum Name.
	 */
	protected function getEnumNameByValue( EnumType $type, $value ): string {
		$enum_values = $type->getValues();
		foreach ( $enum_values as $enum_value ) {
			if ( $enum_value->value === $value ) {
				return $enum_value->name;
			}
		}
		throw new \LogicException( 'Given default does not exist in the given enum.' );
	}

	/**
	 * Recursively get default value with ENUM Name.
	 *
	 * This checks for ObjectType and if found, then loops over it and recursively
	 * calls itself, until only scalar types are found. In case of EnumType it
	 * extracts EnumName from the the provided default.
	 *
	 * @param Type  $type GraphQL Type.
	 * @param mixed $default Default values.
	 *
	 * @return array
	 */
	protected function recursivelyGetDefaultWithEnumName( $type, $default ) {
		if ( $type instanceof ObjectType ) {
			if ( empty( $default ) ) {
				return $default;
			}
			$fields = $type->getFields();
			$return_value = [];
			foreach ( $fields as $field ) {
				$field_type = $field->getType();
				// get wrapped type from possibly NonNull
				if ( $field_type instanceof NonNull ) {
					$field_type = $field_type->getWrappedType( true );
				}
				$return_value[ $field->name ] =
					$this->recursivelyGetDefaultWithEnumName(
						$field_type,
						$default[ $field->name ]
					);
			}
			return $return_value;
		} elseif ( $type instanceof EnumType ) {
			return $this->getEnumNameByValue( $type, $default );
		}
		return $default;
	}

	/**
	 * Get default value with converted enum names.
	 *
	 * This is useful, because the library internally stores
	 * EnumValueDefinition->value, where-as it expects EnumValueDefinition->name
	 * as input.
	 *
	 * @throws \LogicException If Given default does not exist in the given enum.
	 *
	 * @return mixed
	 */
	public function getDefaultWithEnumName() {
		if ( $this->defaultWithEnumName ) {
			return $this->defaultWithEnumName;
		}

		// if this is directly an EnumType, then just get it and return
		if ( $this->type instanceof EnumType ) {
			return $this->getEnumNameByValue( $this->type, $this->default );
		} elseif ( $this->type instanceof ObjectType ) {
			// if this is a compound type, then loop over all fields recursively
			// and return stuff
			return $this->recursivelyGetDefaultWithEnumName( $this->type, $this->default );
		}
		// else just return the default
		return $this->default;
	}

	/**
	 * Set validator for the field var.
	 *
	 * @param   callable $validator  Validator function.
	 *
	 * @return  FieldVar
	 */
	public function setValidator( callable $validator ) : FieldVar {
		$this->validator = $validator;
		return $this;
	}

	/**
	 * Validate a value against the validator.
	 *
	 * If the validator is not set then it always returns true. If a validator is
	 * set and if the value is null while the FieldVar is nullable, then the
	 * validator function is never called and it returns true.
	 *
	 * @param   mixed $value  The value to validate against.
	 *
	 * @return  bool          True if valid or no validator is set, false if not
	 *                        valid.
	 */
	public function isValid( $value ) : bool {
		// return true if no validator is set
		if ( null === $this->validator ) {
			return true;
		}
		// If this is nullable and the value is null, then return true
		if ( $this->nullable && $value === null ) {
			return true;
		}
		return ! ! \call_user_func( $this->validator, $value );
	}

	/**
	 * A shortcut method to create a config var with default, type and input.
	 * If input is null, then the same $type is used for both Type and Input.
	 *
	 * @param mixed $default Default Value.
	 * @param Type  $type GraphQL Type for Type.
	 * @param Type  $input GraphQL type for Input (Optional). If omitted, then
	 *                     `$type` is used instead.
	 * @param mixed $defaultWithEnumName Set the default value with enum name
	 *                                   directly. Useful only for lists.
	 * @return FieldVar
	 *
	 * @throws LogicException If NonNull type/input is passed directly.
	 */
	public static function var( $default, Type $type, Type $input = null, $defaultWithEnumName = null ) : FieldVar {
		if ( $type instanceof NonNull || $input instanceof NonNull ) {
			throw new LogicException( 'Do not set nonNull on field vars.' );
		}
		$var = new FieldVar();
		$var->setDefault( $default );
		$var->setDefaultWithEnumName( $defaultWithEnumName );
		if ( null !== $input ) {
			return $var->setType( $type )->setInput( $input );
		}
		return $var->setTypeAndInput( $type );
	}

	/**
	 * Extract data from fieldVars. The returned data has the same array structure
	 * as the original fieldVar array.
	 *
	 * It also checks for variable sanity while looping through it.
	 *
	 * @throws \LogicException If `$type` is not one of 'type', 'input', 'default'
	 *                         or 'defaultWithEnumName'.
	 *
	 * @param array  $vars Config vars as defined in the element class.
	 * @param string $type Type of data to extract, could be 'type', 'input',
	 *                     'default' or 'defaultWithEnumName'.
	 * @return array
	 */
	public static function extract( array $vars, string $type ) : array {
		$extracts = [];
		foreach ( $vars as $key => $var ) {
			if ( ! is_array( $var ) && ! $var instanceof FieldVar ) {
				throw new \LogicException( 'The value of a config var has to be an instance of FieldVar or an array.' );
			}
			if ( is_array( $var ) ) {
				$extracts[ $key ] = self::extract( $var, $type );
			} else {
				if ( 'type' === $type ) {
					$extracts[ $key ] = $var->getType();
				} elseif ( 'input' === $type ) {
					$extracts[ $key ] = $var->getInput();
				} elseif ( 'default' === $type ) {
					$extracts[ $key ] = $var->getDefault();
				} elseif ( 'defaultWithEnumName' === $type ) {
					$extracts[ $key ] = $var->getDefaultWithEnumName();
				} else {
					throw new \LogicException( '$type can be one of type, input or default, but `' . $type . '` was given.' );
				}
			}
		}
		return $extracts;
	}

	/**
	 * Recursively validate an array of fieldVars or another array of fieldVars or
	 * so on.
	 *
	 * @throws ValidationException If `validate` returns false.
	 *
	 * @param   array  $field_vars  Array of fieldVars.
	 * @param   array  $data        Array of data with the same index and $field_vars.
	 * @param   string $key_prefix  Key prefix to start the ValidationException throw with.
	 *
	 * @return  void
	 */
	public static function recursivelyValidate( array $field_vars, array $data, string $key_prefix ) {
		foreach ( $field_vars as $field_key => $field_var ) {
			if ( $field_var instanceof FieldVar && isset( $data[ $field_key ] ) ) {
				if ( ! $field_var->isValid( $data[ $field_key ] ) ) {
					throw new ValidationException( "Value is invalid for {$key_prefix}->{$field_key}." );
				}
			} elseif (
				\is_array( $field_var )
				&& isset( $data[ $field_key ] )
				&& \is_array( $data[ $field_key ] )
			) {
				self::recursivelyValidate( $field_var, $data[ $field_key ], "{$key_prefix}->{$field_key}" );
			}
		}
	}
}
