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
 * @subpackage Element
 */

namespace WPEForm\Form\Element;

use WPEForm\GraphQL\Util\FieldVar;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * EForm element interface.
 * All EForm element classes should implement this because the whole
 * system depends on specific methods and static methods. You can only
 * register Element classes which implements this method.
 *
 * In reality, you should only extend the WPEForm\Element\Base class as
 * it already implements this interface.
 */
interface IElement {
	/**
	 * Get the definition of the Element.
	 *
	 * @return array{title: string, description: string, container: bool, category: string} An array with 'title', 'description', 'container',
	 *  'category'. category can be 'choice', 'input', 'design', or 'security'.
	 */
	public function get_definition() : array;

	/**
	 * Get list of only accepted children types for this element. Works only
	 * for containers. If returned an empty array, then all types of children are
	 * accepted.
	 *
	 * @return array
	 */
	public function get_accepted_children_types() : array;

	/**
	 * Get list of unaccepted children types for this element. Works only for
	 * containers. If returned an empty array, then no types are unacceptable.
	 *
	 * @return array
	 */
	public function get_unaccepted_children_types() : array;

	/**
	 * Validate children if this element is of a type container.
	 *
	 * This is called in the Model, only if Element definition says this one
	 * is a container.
	 *
	 * @param string $id ID of the Element.
	 * @param array  $children Children of this element.
	 * @param array  $elements All other elements in the form. Use it to look up
	 *                         information of other elements.
	 *
	 * @return void
	 */
	public function validate_children( string $id, array $children, array $elements ) : void;

	/**
	 * Get generic appearance configuration structure for this element.
	 *
	 * This lets all child classes to define it's own default and which generic
	 * appearance configs it uses.
	 *
	 * Return should be like
	 *
	 * ```php
	 * [
	 *   'title' => [
	 *     'uses' => true,
	 *     'default' => 'Some super-awesome element',
	 *   ],
	 * ]
	 * ```
	 *
	 * Anything which aren't returned, will be considered as `'uses' => true`.
	 *
	 * @return array
	 */
	public function get_generic_appearance_structure() : array;

	/**
	 * Get config vars of this element. It should create the array of FieldVars
	 * only once and cache it in the instance.
	 *
	 * @return FieldVar[]
	 */
	public function get_config_vars() : array;

	/**
	 * Get the default configuration object for this element.
	 * This can be any associative array.
	 *
	 * @return array Associative array with configuration
	 */
	public function get_default_config() : array;

	/**
	 * Get default appearance value for this element.
	 *
	 * @return array
	 */
	public function get_default_appearance() : array;

	/**
	 * Get cached version of data value vars. It creates the data value var only
	 * once and stores the result in the protected static property.
	 *
	 * @return FieldVar[]
	 */
	public function get_data_value_vars() : array;

	/**
	 * Get default data object for this element.
	 * This can be any associative array. Usually it has a 'value', 'score'
	 * and 'meta' key, but it is upto you to implement.
	 *
	 * Also, don't bother about returning score. It will be overriden by
	 * set_data anyway, in default implementation (with Base abstract class).
	 *
	 * @return array Associative array with data
	 */
	public function get_default_data_value() : array;

	/**
	 * Normalize elements' config variable. This is useful when updating
	 * element config in API.
	 *
	 * @param null|array $config Stored/User Input configuration value.
	 *
	 * @return array Associative array of Element Config.
	 */
	public function get_normalized_config( ?array $config ) : array;

	/**
	 * Normalize elements' data value variable. This is useful when updating
	 * element config in API.
	 *
	 * @param null|array $data_value Stored/User input data.value.
	 *
	 * @return array Associative array of Element's data.value.
	 */
	public function get_normalized_data_value( ?array $data_value ) : array;

	/**
	 * Get the validation status of the Element considering its config and data.
	 * Use this for server-side cross validation.
	 *
	 * The first element passed, must be `$form_element['config'][$type]` and not the
	 * `$form_element` itself.
	 * The second argument passed, must be `$submission_data['value'][$type]` and not
	 * `$submission_data` itself.
	 *
	 * Make sure to override this, because this just returns an empty array now.
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array An associative array with success => bool, and message => string
	 */
	public function get_validation_status( array $config, array $data_value ) : array;

	/**
	 * Get normalized and stringified value, for direct use with other tools
	 * like, CSV generation, printing etc.
	 *
	 * The first element passed, must be `$form_element['config'][$type]` and not the
	 * `$form_element` itself.
	 * The second argument passed, must be `$submission_data['value'][$type]` and not
	 * `$submission_data` itself.
	 *
	 * @param array                                                                                          $config Normalized configuration value.
	 * @param array                                                                                          $data_value Normalized data.value.
	 * @param array{option: string, row: string, range: string, entry: string, return: string, type: string} $using An associative array of using config.
	 * @param callable|null                                                                                  $mentions_callback Callback function for mentions.
	 *
	 * @return array|string Element's value.
	 */
	public function get_simple_value( array $config, array $data_value, array $using, ?callable $mentions_callback = null );

	/**
	 * Get HTML output for email.
	 *
	 * The first element passed, must be `$form_element['config'][$type]` and not the
	 * `$form_element` itself.
	 * The second argument passed, must be `$submission_data['value'][$type]` and not
	 * `$submission_data` itself.
	 *
	 * @param array         $appearance Appearance data of the element.
	 * @param array         $config Normalized config of the element.
	 * @param array         $data_value Normalized data value of the element.
	 * @param null|callable $mentions_callabck Mentions callback for SlateJS renderer.
	 * @param string        $purpose Purpose of the HTML. Could be 'email' or 'pdf'.
	 * @return string HTML output.
	 */
	public function get_html_value( array $appearance, array $config, array $data_value, ?callable $mentions_callabck, string $purpose = 'email' ) : string;

	/**
	 * Calculate and Get score obtained and maximum score
	 * for this element, given its config and submission.
	 *
	 * Make sure to override this, because this just returns an empty array now.
	 *
	 * The first element passed, must be `$form_element['config'][$type]` and not the
	 * `$form_element` itself.
	 * The second argument passed, must be `$submission_data['value'][$type]` and not
	 * `$submission_data` itself.
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array  Associative array where
	 *   `key` == ID of the score.
	 *   `value` == Associative array with `has`, `obtained` and `outof`.
	 *
	 * ```php
	 * [
	 *   'default-score' => [
	 *     'has' => false,
	 *     'obtained' => 0,
	 *     'outof' => 0,
	 *   ],
	 * ];
	 * ```
	 */
	public function get_data_score( array $config, array $data_value ) : array;

	/**
	 * Get extra data in GraphQL Type when fetching a form. These are some useful
	 * metadata passed directly to client for some handling. Some security
	 * elements make use of it.
	 *
	 * @param array|null $config Element config as stored in config.
	 *
	 * @return string|null
	 */
	public function get_extra_type_data( ?array $config ) : ?string;
}
