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
 * @subpackage Factory
 */

namespace WPEForm\Factory\Form;

use WPEForm\Exception\InvalidElementException;
use WPEForm\Exception\ValidationException;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GraphQL\Registry;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Form\Element\IElement;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * This class is responsible for providing functionality to get all Element
 * classes and dynamically attach them with a factory method.
 */
class Elements {
	/**
	 * An associative array listing all registered elements.
	 * The array key is the element name, and value is the
	 * element class implementing the \WPEForm\Element\Element
	 * interface.
	 *
	 * @var IElement[]
	 */
	protected static $registered_elements = [];

	/**
	 * Element generic configuration. Used by all elements.
	 *
	 * @var array
	 */
	protected static $element_generic_appearance = null;

	/**
	 * Get element generic configuration, which is used by all elements.
	 *
	 * This returns an once created array of FieldVars from the Base abstract class.
	 *
	 * Child classes can not override it, but it can change the default value and
	 * whether not to show up in ui with the use of `get_generic_config_structure`.
	 *
	 * This returns an once created array of FieldVars.
	 *
	 * @return FieldVar[]
	 */
	public static function get_element_generic_appearance() : array {
		if ( self::$element_generic_appearance === null ) {
			self::$element_generic_appearance = [
				// element title, would be slateJSON of singleLine RichTextEditor
				'title' => FieldVar::var(
					__( 'New Element', 'wp-eform' ),
					Type::string()
				)->setNullable( true ),
				// element description, here one can put any HTML rich snippet
				'description' => FieldVar::var( '', Type::string() )->setNullable( true ),
				// element subtitle, would be slateJSON of singleLine RichTextEditor
				'subtitle' => FieldVar::var( '', Type::string() )->setNullable( true ),
				// whether to override control appearance
				'overrideControlAppearance' => FieldVar::var( false, Type::boolean() ),
				'controlType' => FieldVar::var(
					'boxy', // material | boxy
					Registry::get( 'settingsAppearanceControlType', 'enum' )
				),
				'controlAlignment' => FieldVar::var(
					'left',
					Registry::get( 'settingsAppearanceControlAlignment', 'enum' )
				),
				'controlLayout' => FieldVar::var(
					'vertical',
					Registry::get( 'settingsAppearanceControlLayout', 'enum' )
				),
				// end overridable stuff
				// hint icon, mostly related to quiz
				'hint' => FieldVar::var( '', Type::string() )->setNullable( true ),
				'hintIcon' => FieldVar::var( 'fas fa-question', Type::string() )->setNullable( true ),
				'hintLabel' => FieldVar::var(
					__( 'Show help', 'wp-eform' ),
					Type::string()
				)->setNullable( true ),
				// text to show after submission, in answer sheet
				'answerDescription' => FieldVar::var( '', Type::string() )->setNullable( true ),
				// column size
				'columnSize' => FieldVar::var( 'full', Registry::get( 'widthPresets', 'enum' ) ),
				// basic width in percentage, but can be changed to pixel
				'basicWidth' => FieldVar::var( '100%', Type::string() ),
				// these can not be overriden, so we always expect a value, not nullable
				'widths' => FieldVar::var(
					[],
					Type::listOf( Type::nonNull( Registry::get( 'elementAppearanceWidth', 'type/form' ) ) ),
					Type::listOf( Type::nonNull( Registry::get( 'elementAppearanceWidth', 'input/form' ) ) )
				),
				'initiallyHidden' => FieldVar::var( false, Type::boolean() ),
				'className' => FieldVar::var( '', Type::string() ),
			];
		}
		return self::$element_generic_appearance;
	}

	/**
	 * Get default generic appearance value.
	 *
	 * @return array
	 */
	public static function get_element_generic_appearance_default() : array {
		return FieldVar::extract(
			self::get_element_generic_appearance(),
			'default'
		);
	}

	/**
	 * Get all registered elements.
	 *
	 * @return IElement[] Associative array of registered elements. key is the
	 *               Element name, value is the element instance implementing
	 *               \WPEForm\Form\Element\IElement interface.
	 */
	public static function get_registered_elements() : array {
		return self::$registered_elements;
	}

	/**
	 * Get the names of Registered elements.
	 *
	 * @return string[] Indexed array of registered elements' names.
	 */
	public static function get_registered_elements_names() : array {
		return \array_keys( self::$registered_elements );
	}

	/**
	 * Get data of all elements. We use this in our client library (Reactjs) to
	 * populate the UI, through a GraphQL query.
	 *
	 * Because GraphQL expects config in a strict type, we use the same structure
	 * as the Form.Element.Config type, i.e, have keys corresponding to all
	 * registered elements and have the value null. Then override the key corresponding
	 * to the element and replace to the actual default value.
	 *
	 * @return array An associative array of elements with
	 *               `name`, `defaultConfig`, `defaultAppearance` and `definition`.
	 */
	public static function get_all_registered_elements_data() : array {
		$elements = [];
		foreach ( self::get_registered_elements_names() as $name ) {
			// get the instance
			$elm_instance = self::get_element_instance( $name );

			// create the meta
			$elements[] = [
				'type' => $name,
				'definition' => self::get_element_definition( $name ),
				'defaultConfig' => self::get_element_config_array_structure_with_default( $name ),
				'defaultDataValue' => self::get_element_data_value_structure_with_default( $name ),
				'defaultAppearance' => $elm_instance->get_default_appearance(),
				'acceptedChildren' => $elm_instance->get_accepted_children_types(),
				'unacceptedChildren' => $elm_instance->get_unaccepted_children_types(),
			];
		}
		return $elements;
	}

	/**
	 * Check if an element exists in the register.
	 *
	 * @param string $name Element name.
	 * @return boolean true if the element exists, false otherwise.
	 */
	public static function has_element( string $name ) : bool {
		return \array_key_exists( $name, self::$registered_elements );
	}

	/**
	 * A helper method to throw an exception if element is not found in the
	 * register.
	 *
	 * @throws InvalidElementException If the element is not found.
	 *
	 * @param string $name Name of the element.
	 * @return void
	 */
	public static function throw_if_element_not_found( string $name ) : void {
		if ( ! self::has_element( $name ) ) {
			throw new InvalidElementException(
				sprintf( 'The element %s does not exist in the register.', $name )
			);
		}
	}

	/**
	 * Throw an exception if the class (which is supposedly an element class)
	 * instance is improper, i.e, either it is not an instance or it does not
	 * implements `IElement`.
	 *
	 * @throws InvalidElementException When element not an instance or does not
	 *                                 implement \WPEForm\ELement\Element.
	 *
	 * @param mixed $instance The element instance.
	 * @return void
	 */
	public static function throw_if_element_instance_is_improper( $instance ) : void {
		if ( ! \is_object( $instance ) ) {
			throw new InvalidElementException(
				sprintf(
					'Element expects an instance of a class, but %s was given.',
					\gettype( $instance )
				)
			);
		}
		// Check if this implements the Element interface
		if ( ! \in_array( 'WPEForm\\Form\\Element\\IElement', \class_implements( $instance ) ) ) {
			throw new InvalidElementException(
				sprintf(
					'The element %s does not implement \\WPEForm\\Form\\Element\\IElement class.',
					\get_class( $instance )
				)
			);
		}
	}

	/**
	 * Register a new element with EForm. The element class should implement
	 * \WPEForm\Element\Element interface.
	 *
	 * @param string   $name Element name.
	 * @param IElement $instance Element instance.
	 * @return void
	 *
	 * @throws InvalidElementException When element already exists or does not
	 *                                 implement \WPEForm\ELement\Element.
	 */
	public static function register_element( string $name, $instance ) : void {
		// Check if name already exists
		if ( self::has_element( $name ) ) {
			throw new InvalidElementException( "The element {$name} is already registered. Use another name." );
		}

		self::throw_if_element_instance_is_improper( $instance );

		self::$registered_elements[ $name ] = $instance;
	}

	/**
	 * De-register an element from EForm. Use this to replace built-in
	 * elements with perhaps an enhanced one, while keeping the data and
	 * config. It is upto you to make sure the default ones work too,
	 * otherwise, upon uninstalling your plugin, things will break for the user.
	 *
	 * If you just want to change the view, then use EForm JS API to change
	 * the React component instead.
	 *
	 * It is a good practice to always check if the element exists with
	 * `has_element`.
	 *
	 * @param string $name Element name.
	 * @return void
	 *
	 * @throws InvalidElementException If the element doesn't already exist.
	 */
	public static function deregister_element( string $name ) : void {
		self::throw_if_element_not_found( $name );
		unset( self::$registered_elements[ $name ] );
	}

	/**
	 * Get an element instance with provided config and data.
	 *
	 * @throws InvalidElementException If the element doesn't already exist.
	 *
	 * @param string $name Element name in register.
	 *
	 * @return IElement Element instance.
	 */
	public static function get_element_instance( string $name ) : IElement {
		self::throw_if_element_not_found( $name );
		return new self::$registered_elements[ $name ]();
	}

	/**
	 * Get element definition.
	 *
	 * @param string $name Element name in register.
	 * @return array Associative array of element definition.
	 *
	 * @throws InvalidElementException If the element doesn't already exist.
	 */
	public static function get_element_definition( string $name ) : array {
		$elm_instance = self::get_element_instance( $name );
		return $elm_instance->get_definition();
	}

	/**
	 * Get generic appearance structure of an Element.
	 *
	 * @param string $name Name of the element.
	 * @return array Generic appearance structure.
	 */
	public static function get_element_generic_appearance_structure( string $name ) : array {
		$elm_instance = self::get_element_instance( $name );
		return $elm_instance->get_generic_appearance_structure();
	}

	/**
	 * Get configuration variables of an Element.
	 *
	 * @param   string $name  Name of the element.
	 *
	 * @return  array         Configuration variable as registered by the element.
	 */
	public static function get_element_config_vars( string $name ) : array {
		$elm_instance = self::get_element_instance( $name );
		return $elm_instance->get_config_vars();
	}

	/**
	 * Check whether Config Vars of an element is empty. This is used to determine
	 * whether an element should even go in the structure.
	 *
	 * @param string $name Name of the registered element.
	 *
	 * @return bool
	 */
	public static function is_element_config_vars_empty( string $name ) : bool {
		$elm_instance = self::get_element_instance( $name );
		return empty( $elm_instance->get_config_vars() );
	}

	/**
	 * Check whether Data Value Vars of an element is empty. This is used to determine
	 * whether an element should even go in the structure.
	 *
	 * @param string $name Name of the registered element.
	 *
	 * @return bool
	 */
	public static function is_element_data_value_vars_empty( string $name ) : bool {
		$elm_instance = self::get_element_instance( $name );
		return empty( $elm_instance->get_data_value_vars() );
	}

	/**
	 * Get default array structure of element config, considering all registering
	 * elements.
	 *
	 * This is how we bypass the GraphQL input limitation of Unions. Instead of
	 * trying (and then failing miserably) to create an Union config which would
	 * work for all elements, we simply create an associative array of config like
	 * ```php
	 * $config = [
	 *     'checkbox' => null,
	 *     'radio' => null,
	 *     'dropdown' => null,
	 * ];
	 * ```
	 * where the keys actually are the key of registered elements. For a particular
	 * element, only the key which represents its type is populated, rest remains
	 * null. This part is done in the model.
	 *
	 * @return  array
	 */
	public static function get_element_config_array_structure() : array {
		$elm_config = [];
		$elm_names = self::get_registered_elements_names();
		foreach ( $elm_names as $key ) {
			if ( ! self::is_element_config_vars_empty( $key ) ) {
				$elm_config[ $key ] = null;
			}
		}
		return $elm_config;
	}

	/**
	 * Get element default configuration variable.
	 *
	 * @param string $name Element name in register.
	 * @return array Associative array of default configuration variable.
	 *
	 * @throws InvalidElementException If the element doesn't exist.
	 */
	public static function get_element_default_config( string $name ) : array {
		$elm_instance = self::get_element_instance( $name );
		return $elm_instance->get_default_config();
	}

	/**
	 * Get element default configuration with the proper structure. This is what
	 * GraphQL Mutation would expect and GraphQL Query would give.
	 *
	 * @param string $name Name of the element.
	 *
	 * @return array
	 */
	public static function get_element_config_array_structure_with_default( string $name ): array {
		$default_config = self::get_element_config_array_structure();
		$default_config[ $name ] = self::get_element_default_config( $name );
		return $default_config;
	}

	/**
	 * Get default array structure of element submission's data.value, considering
	 * all registering elements.
	 *
	 * This is how we bypass the GraphQL input limitation of Unions. Instead of
	 * trying (and then failing miserably) to create an Union config which would
	 * work for all elements, we simply create an associative array of config like
	 * ```php
	 * $submission.data.value = [
	 *    'checkbox' => null,
	 *    'radio' => null,
	 *    'dropdown' => null,
	 * ];
	 * ```
	 * where the keys actually are the key of registered elements. For a particular
	 * element, only the key which represents its type is populated, rest remains
	 * null. This part is done in the model.
	 *
	 * @return array
	 */
	public static function get_element_data_value_array_structure() : array {
		$elm_data_value = [];
		$elm_names = self::get_registered_elements_names();
		foreach ( $elm_names as $key ) {
			if ( ! self::is_element_data_value_vars_empty( $key ) ) {
				$elm_data_value[ $key ] = null;
			}
		}
		return $elm_data_value;
	}

	/**
	 * Get data value variables of an Element.
	 *
	 * @param   string $name  Name of the Element.
	 *
	 * @return  array         Data Value variable as registered by the Element.
	 */
	public static function get_element_data_vars( string $name ) : array {
		$elm_instance = self::get_element_instance( $name );
		return $elm_instance->get_data_value_vars();
	}

	/**
	 * Get element default data value variable.
	 *
	 * @param string $name Element name in register.
	 * @return array Associative array of default data variable.
	 *
	 * @throws InvalidElementException If the element doesn't exist.
	 */
	public static function get_element_default_data_value( string $name ) : array {
		$elm_instance = self::get_element_instance( $name );
		return $elm_instance->get_default_data_value();
	}

	/**
	 * Get an element's data.value structure with proper default stored in that
	 * element's key. This is how a GraphQL Input expects the data to be of and
	 * how GraphQL Type would give back the submission data.
	 *
	 * @param string $name Name of the lement.
	 *
	 * @return array
	 *
	 * @throws InvalidElementException If the element doesn't exist.
	 */
	public static function get_element_data_value_structure_with_default( string $name ) : array {
		self::throw_if_element_not_found( $name );
		$structure = self::get_element_data_value_array_structure();
		if ( ! self::is_element_data_value_vars_empty( $name ) ) {
			$data_value = self::get_element_default_data_value( $name );
			$structure[ $name ] = $data_value;
		}
		return $structure;
	}

	/**
	 * Get normalized config of an element config.
	 *
	 * @param string     $name Name of the element.
	 * @param array|null $config User input or stored element config.
	 *
	 * @return array
	 */
	public static function get_normalized_element_config( string $name, ?array $config ) : array {
		$elm_instance = self::get_element_instance( $name );
		return $elm_instance->get_normalized_config( $config );
	}

	/**
	 * Validate element children against its definition and instance.
	 *
	 * It checks if element is of type container, and if not and it still holds
	 * children, then it throws error.
	 *
	 * Also it calls validate_children, which might throw an error if decided by
	 * the element instance.
	 *
	 * @throws ValidationException If Element is not container, yet children is
	 *                             not empty.
	 *
	 * @param string $id Id of the element to be validated.
	 * @param string $name Name of the element.
	 * @param array  $children Children array of the Element.
	 * @param array  $elements All elements in the form.
	 *
	 * @return void
	 */
	public static function validate_element_children( string $id, string $name, array $children, array $elements ) : void {
		$elm_instance = self::get_element_instance( $name );
		$definition = self::get_element_definition( $name );
		// if element is not a container and it has children, then throw
		if ( $definition['container'] === false && ! empty( $children ) ) {
			throw new ValidationException( "Element {$name} can not have children in it." );
		}
		// call validate children
		$elm_instance->validate_children( $id, $children, $elements );
	}

	/**
	 * Get extra type data for the element.
	 *
	 * @param string     $name Name of the Element.
	 * @param array|null $config Config of the Element, as described by element
	 *                           class.
	 *
	 * @return string|null Element data as retrieved from instance.
	 */
	public static function get_element_extra_type_data( string $name, ?array $config ) : ?string {
		$elm = self::get_element_instance( $name );
		return $elm->get_extra_type_data( $config );
	}
}
