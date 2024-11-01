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

use WPEForm\Model\IModel;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * This is a collectice interface for all configs to implement.
 *
 * We collectively call, settings, appearance, payments and integrations as
 * Config. They share similar data structure and perform similar actions. Execption
 * being a payments and integrations where post-save hooks are called. But as
 * far as GraphQL is concerned, they all provide a collection of FieldVars to
 * set things up.
 *
 * In order to set the FieldVar[] we need to have some specific methods, which
 * this interface defines.
 */
interface IConfig {
	/**
	 * Get a cached copy of query field for this config.
	 *
	 * @return array|null
	 */
	public function get_query_fields() : ?array;

	/**
	 * Get cached copy of mutation fields for this config.
	 *
	 * @return array|null
	 */
	public function get_mutation_fields() : ?array;

	/**
	 * Get configuration variables for this config. It should be an array of
	 * FieldVars, otherwise it will throw an error.
	 *
	 * Implement this on all child classes.
	 *
	 * @return array
	 */
	public function get_config_vars() : array;

	/**
	 * Normalize config variables on export. At this stage, override and
	 * remove sensitive information from export data.
	 *
	 * @param array $config Original config.
	 * @return array Normalized config.
	 */
	public function normalize_on_export( array $config ) : array;

	/**
	 * Normalize config variables on import. At this stage, give default values
	 * to removed information if needed.
	 *
	 * @param array $config Original config from import.
	 * @return array Normalized config.
	 */
	public function normalize_on_import( array $config ) : array;
}
