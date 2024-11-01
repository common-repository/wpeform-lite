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
 * @subpackage Factory\Form\Config
 */

namespace WPEForm\Factory\Form\Config;

use WPEForm\Exception\InvalidConfigException;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\Form\Config\IConfig;
use LogicException;

use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A base class for all factories related to Form Configs.
 * Namely, Config, Styles, Integrations, Payments, Permissions.
 */
abstract class Base {
	/**
	 * An associative array listing all registered form config. The array key
	 * is the config name and the value is the class implementing needed interface.
	 *
	 * @var IConfig[]
	 */
	protected static $registered_configs = [];

	/**
	 * Get all registered configs.
	 *
	 * @return array Associative array of registered configs. Key is the config
	 *               name, value is the config class implementing
	 *               \WPEForm\Form\Config\IConfig interface.
	 */
	public static function get_registered_configs() : array {
		return static::$registered_configs;
	}

	/**
	 * Get the names of registered config.
	 *
	 * @return string[] Indexed array of registered config' name.
	 */
	public static function get_registered_configs_names() : array {
		return \array_keys( static::$registered_configs );
	}

	/**
	 * Get an array of instances for all registered configs.
	 *
	 * @return IConfig[]
	 */
	public static function get_registered_configs_instances() : array {
		return \array_values( static::$registered_configs );
	}

	/**
	 * Check if a config exists in the register.
	 *
	 * @param string $name Config Name.
	 * @return boolean
	 */
	public static function has_config( string $name ) : bool {
		return \array_key_exists( $name, static::$registered_configs );
	}

	/**
	 * Throw exception if config is not found in the register.
	 *
	 * @throws InvalidConfigException If the config is not found.
	 *
	 * @param   string $name  Name of the config.
	 *
	 * @return  void
	 */
	public static function throw_if_config_not_found( string $name ) : void {
		if ( ! static::has_config( $name ) ) {
			throw new InvalidConfigException(
				\sprintf( 'The config %s does not exist in the register.', $name )
			);
		}
	}

	/**
	 * Throw if config instance is improper. Any config class must implement the
	 * IConfig interface.
	 *
	 * @throws InvalidConfigException If class is not found or is improper.
	 *
	 * @param IConfig $instance Config class fully qualified name.
	 * @return void
	 */
	public static function throw_if_config_instance_is_improper( $instance ) : void {
		if ( ! \is_object( $instance ) ) {
			throw new InvalidConfigException(
				sprintf(
					'Config expects an instance of a class, but %s was given.',
					\gettype( $instance )
				)
			);
		}
		// check if this implements config interface
		if ( ! \in_array(
			'WPEForm\\Form\\Config\\IConfig',
			\class_implements( $instance )
		) ) {
			throw new InvalidConfigException(
				\sprintf(
					'The config class %s does not implement \\WPEForm\\Form\\Config\\IConfig.',
					\get_class( $instance )
				)
			);
		}
	}

	/**
	 * Register a form config with EForm. The config class should implement
	 * \WPEForm\Form\Config\IConfig interface.
	 *
	 * @throws InvalidConfigException When config already exists or class does
	 *                                  not exist or doesn't implement IConfig
	 *                                  interface.
	 *
	 * @param   string  $name   Config name.
	 * @param   IConfig $instance  Config class instance.
	 *
	 * @return  void
	 */
	public static function register_config( string $name, $instance ) : void {
		// Check if config already exists
		if ( static::has_config( $name ) ) {
			throw new InvalidConfigException(
				\sprintf( 'The config %s is already registered. Use another name.', $name )
			);
		}

		// Throw if config class is improper
		static::throw_if_config_instance_is_improper( $instance );

		// all done, now register
		static::$registered_configs[ $name ] = $instance;
	}

	/**
	 * Deregister a config from the register. Use this to replace built-in
	 * config with perhaps an enhanced one, while keeping the data and config.
	 *
	 * It is a good practice to always check if the config exists with
	 * `has_config`.
	 *
	 * @param   string $name  Name of the config.
	 *
	 * @return  void
	 */
	public static function deregister_config( string $name ) {
		static::throw_if_config_not_found( $name );
		unset( static::$registered_configs[ $name ] );
	}

	/**
	 * Get config class instance.
	 *
	 * @param   string $name  Name of the config.
	 *
	 * @return  IConfig         Config class instance.
	 */
	public static function get_config_instance( string $name ) : IConfig {
		static::throw_if_config_not_found( $name );
		return static::$registered_configs[ $name ];
	}

	/**
	 * Get Config FieldVars from a config class. Use this to create default values,
	 * GraphQL Types, Inputs etc.
	 *
	 * @param   string $name  Name of the config.
	 *
	 * @return  \WPEForm\GraphQL\Util\FieldVar[] Array of config variables for the config.
	 */
	public static function get_config_field_vars( string $name ) : array {
		$config_instance = static::get_config_instance( $name );
		return $config_instance->get_config_vars();
	}

	/**
	 * Get field vars for all registered config, in an associative array.
	 *
	 * The key of the array is the name of the registered config, reflecting
	 * the database structure.
	 *
	 * @return  array  Config vars (FieldVar) of all registered config.
	 */
	public static function get_registered_configs_field_vars() : array {
		$config_vars = [];
		$config_names = static::get_registered_configs_names();
		foreach ( $config_names as $config_name ) {
			$config_vars[ $config_name ] = static::get_config_field_vars( $config_name );
		}
		return $config_vars;
	}

	/**
	 * Get default value of fields of a particular config.
	 *
	 * @param   string $name  Name of the config.
	 * @param   bool   $enum_name Whether to extract enum name or value. Defaults false.
	 *
	 * @return  array          Default value as extracted from the Config Var.
	 */
	public static function get_config_field_default_value( string $name, bool $enum_name = false ) : array {
		$config_var = static::get_config_field_vars( $name );
		return FieldVar::extract( $config_var, $enum_name ? 'defaultWithEnumName' : 'default' );
	}

	/**
	 * Get default value for all registered config fields, in an associative array.
	 *
	 * The key of the array is the name of the registered config, reflecting
	 * the database structure.
	 *
	 * @param bool $enum_name Whether to extract enum name or value. Defaults false.
	 *
	 * @return  array  Default value for all registered config.
	 */
	public static function get_registered_configs_field_default_values( bool $enum_name = false ) : array {
		$default_config = [];
		$config_names = static::get_registered_configs_names();
		foreach ( $config_names as $config_name ) {
			$default_config[ $config_name ] = static::get_config_field_default_value( $config_name, $enum_name );
		}
		return $default_config;
	}

	/**
	 * Get accumulated query fields from all integrations classes.
	 *
	 * @return array
	 */
	public static function get_registered_configs_graphql_query_fields() : array {
		$instances = self::get_registered_configs_instances();
		$queries = [];
		foreach ( $instances as $instance ) {
			$query = $instance->get_query_fields();
			if ( $query !== null ) {
				$queries = \array_merge( $queries, $query );
			}
		}

		return $queries;
	}

	/**
	 * Get accumulated mutation fields from all integrations classes.
	 *
	 * @return array
	 */
	public static function get_registered_configs_graphql_mutation_fields() : array {
		$instances = self::get_registered_configs_instances();
		$mutations = [];
		foreach ( $instances as $instance ) {
			$mutation = $instance->get_mutation_fields();
			if ( $mutation !== null ) {
				$mutations = \array_merge( $mutations, $mutation );
			}
		}

		return $mutations;
	}

	/**
	 * Normalize all config variables of the registry for an export.
	 *
	 * @param array $configs Configs as stored in db and normalized by the Model.
	 * @return array Normalized config.
	 */
	public static function normalize_on_export( array $configs ) : array {
		$normalized_configs = [];
		$registered_configs = self::get_registered_configs_names();
		foreach ( $registered_configs as $key ) {
			$instance = self::get_config_instance( $key );
			$normalized_configs[ $key ] = $instance->normalize_on_export(
				$configs[ $key ]
					?? self::get_config_field_default_value( $key )
			);
		}
		return $normalized_configs;
	}

	/**
	 * Normalize all config variables of the registry for an import.
	 * It does not assume the export code to have normalized values as it does
	 * so itself.
	 *
	 * @param array $configs Configs as gotten from export code.
	 * @return array Normalized configs.
	 */
	public static function normalize_on_import( array $configs ) : array {
		$normalized_configs = [];
		$registered_configs = self::get_registered_configs_names();
		foreach ( $registered_configs as $key ) {
			$instance = self::get_config_instance( $key );
			$default_config = self::get_config_field_default_value( $key );
			$current_config = isset( $configs[ $key ] )
				? parse_args( $configs[ $key ], $default_config )
				: $default_config;
			$normalized_config = $instance->normalize_on_import( $current_config );
			$normalized_configs[ $key ] = $normalized_config;
		}
		return $normalized_configs;
	}
}
