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
 * @subpackage Form\Config
 */

namespace WPEForm\Form\Config;

use WPEForm\GraphQL\Util\FieldVar;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * The base class of Form Settings. All form settings class should extend this
 * otherwise the Factory will throw an error. It implements IConfig and
 * abstracts away a few methods.
 */
abstract class Base implements IConfig {
	/**
	 * Member variable to hold once instantiated config vars.
	 *
	 * @var null|array
	 */
	protected $config_vars = null;

	/**
	 * Member variable to hold once instantiated query fields.
	 *
	 * @var null|array
	 */
	protected $query_fields = null;

	/**
	 *  Member variable to hold once instantiated mutation fields.
	 *
	 * @var null|array
	 */
	protected $mutation_fields = null;

	/**
	 * Member variable to hold once instantiated data vars.
	 *
	 * @var array
	 */
	protected $data_vars = null;

	/**
	 * Create and get a new array of FieldVars which describes the GraphQL types
	 * and inputs for this.
	 *
	 * @return array
	 */
	abstract protected function config_vars() : array;

	/**
	 * A helper method to create and store config variables once in the class
	 * member variable and use it everytime it is called.
	 *
	 * @throws \LogicException If configVars isn't an array.
	 *
	 * @return array
	 */
	final public function get_config_vars() : array {
		if ( null === $this->config_vars ) {
			$this->config_vars = $this->config_vars();
		}
		if ( ! is_array( $this->config_vars ) ) {
			throw new \LogicException( 'Config Vars has to be array. Please check get_config_vars implementation.' );
		}
		return $this->config_vars;
	}

	/**
	 * Create and get query fields for this config.
	 * Return null, if this doesn't create any query fields.
	 *
	 * Override in child class if this provides any query fields.
	 *
	 * @return array|null
	 */
	protected function query_fields() : ?array {
		return null;
	}

	/**
	 * Get a cached copy of query field for this integration.
	 *
	 * @return array|null
	 */
	final public function get_query_fields() : ?array {
		if ( $this->query_fields === null ) {
			$this->query_fields = $this->query_fields();
		}
		return $this->query_fields;
	}

	/**
	 * Create and get mutation fields for this config.
	 * Return null, if this doesn't create any mutation fields.
	 *
	 * Override in child class to provide mutation fields.
	 *
	 * @return array|null
	 */
	protected function mutation_fields(): ?array {
		return null;
	}

	/**
	 * Get cached copy of mutation fields for this integration.
	 *
	 * @return array|null
	 */
	final public function get_mutation_fields() : ?array {
		if ( $this->mutation_fields === null ) {
			$this->mutation_fields = $this->mutation_fields();
		}
		return $this->mutation_fields;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Original config.
	 * @return array Normalized config.
	 */
	public function normalize_on_export( array $config ) : array {
		return $config;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Original config from import.
	 * @return array Normalized config.
	 */
	public function normalize_on_import( array $config ) : array {
		return $config;
	}

	/**
	 * Get default config value from config vars.
	 *
	 * @return array Default config value.
	 */
	final public function get_default_config_value() : array {
		$config_vars = $this->get_config_vars();
		$default = FieldVar::extract( $config_vars, 'default' );
		return $default;
	}
}
