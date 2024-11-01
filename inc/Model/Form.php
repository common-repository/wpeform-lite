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
 */

namespace WPEForm\Model;

use WPEForm\GeneralDeps\Antalaron\Component\CircularReferenceDetect\CircularReferenceDetect;
use WPEForm\System\Init;
use WPEForm\Factory\Form\Elements;
use WPEForm\Exception\ValidationException;

use function WPEForm\Helpers\convert_list_to_dictionary;
use function WPEForm\Helpers\parse_args;
use function WPEForm\Helpers\normalize_id_list;
use function WPEForm\Helpers\validate_array_has_unique_ids;
use function WPEForm\Helpers\format_element_position_exception;
use function WPEForm\Helpers\normalize_db_ids_for_in;

use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\Factory\Form\Config\Integrations;
use WPEForm\Factory\Form\Config\Payments;
use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Factory\Form\Config\Settings;
use WPEForm\Factory\Form\Config\Styles;
use WPEForm\Exception\ModelOperationException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Form Model. Abstracts all database operations related to form.
 *
 * @package EForm
 * @subpackage Model
 */
class Form extends Base {
	/**
	 * Different \WPEForm\Form\Config types stored in DB.
	 *
	 * They hold a special normalize and validation technique and is stored here
	 * for quick reference.
	 *
	 * @var array
	 */
	protected $configs = [
		'integrations',
		'payments',
		'permissions',
		'settings',
		'styles',
	];

	/**
	 * General db columns which should always be present in normalized data.
	 *
	 * @var array
	 */
	protected $general_columns = [
		'name',
		'structures',
		'elements',
		'pools',
		'conditionals',
		'skeleton',
	];

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function get_serializable_columns(): array {
		return [
			'integrations',
			'payments',
			'permissions',
			'settings',
			'styles',
			'structures',
			'elements',
			'pools',
			'conditionals',
			'skeleton',
		];
	}

	/**
	 * Get allowed keys on/from database table for a purpose.
	 *
	 * @param string $purpose Purpose of operation.
	 *
	 * @return array
	 */
	protected function get_allowed_db_keys( string $purpose ) : array {
		$allowed_keys = \array_merge(
			$this->general_columns,
			$this->configs
		);
		if ( self::DB_SETSTATE === $purpose ) {
			$allowed_keys = \array_merge( $allowed_keys, [ 'created', 'updated', 'ownerid' ] );
		} elseif ( self::DB_CREATE === $purpose ) {
			$allowed_keys = \array_merge( $allowed_keys, [ 'ownerid', 'created' ] );
		} elseif ( self::DB_UPDATE === $purpose ) {
			$allowed_keys = \array_merge( $allowed_keys, [ 'updated' ] );
		}

		return $allowed_keys;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_table_name() {
		return Init::$database['form'];
	}

	/**
	 * Get default value of a config. Valid configs for Form model are
	 * integrations, payments, permissions, settings and styles.
	 *
	 * @throws ModelOperationException If `$config` is not one of above.
	 *
	 * @param string $config One of the above config.
	 *
	 * @return array
	 */
	protected function get_default_config_value( string $config ) : array {
		if ( $config === 'integrations' ) {
			return Integrations::get_registered_configs_field_default_values();
		} elseif ( $config === 'payments' ) {
			return Payments::get_registered_configs_field_default_values();
		} elseif ( $config === 'permissions' ) {
			return Permissions::get_registered_configs_field_default_values();
		} elseif ( $config === 'settings' ) {
			return Settings::get_registered_configs_field_default_values();
		} elseif ( $config === 'styles' ) {
			return Styles::get_registered_configs_field_default_values();
		} else {
			throw new ModelOperationException( "Configs can be one of integrations, payments, permissions, settings or styles. {$config} is not a valid config." );
		}
	}

	/**
	 * Get built-in pool for storing all uncategorized pool elements.
	 * This can not ever be deleted.
	 *
	 * @return  array
	 */
	protected function get_built_in_pool() : array {
		return [
			'id' => 'built-in-uncategorized',
			'name' => __( 'Uncategorized', 'wp-eform' ),
			'children' => [],
		];
	}

	/**
	 * Get default pool variable.
	 *
	 * It is built-in uncategorized pool with no elements
	 *
	 * @return array
	 */
	protected function get_default_pools() : array {
		return [
			$this->get_built_in_pool(),
		];
	}

	/**
	 * Get default value for structure configuration.
	 *
	 * A page is an object inside `structure`.
	 *
	 * It should match the GraphQL Schema.
	 *
	 * @return array
	 */
	public static function get_default_structure_config() {
		return [
			'title' => __( 'A Form page', 'wp-eform' ),
			'subtitle' => null,
			'icon' => null,
			'timer' => null,
			'initiallyHidden' => false,
		];
	}

	/**
	 * Normalize different config variable of data.
	 *
	 * @param array  $config_value Config value from user input.
	 * @param string $config Config name.
	 * @return array
	 */
	protected function normalize_config( array $config_value, string $config ) : array {
		$normalize_config = [];
		$default_config_value = $this->get_default_config_value( $config );

		foreach ( $default_config_value as $key => $value ) {
			$normalize_config[ $key ] = isset( $config_value[ $key ] )
				? parse_args( $config_value[ $key ], $value, true )
				: $value;
		}
		return $normalize_config;
	}

	/**
	 * Normalize children of a structure or element.
	 *
	 * Children is basically an array of Ids (strings).
	 *
	 * @param array $children Possible children.
	 * @return array Normalized children.
	 */
	protected function normalize_children( $children ) : array {
		return normalize_id_list( $children );
	}

	/**
	 * Normalize generic appearance of an element.
	 *
	 * @param array $appearance User input of appearance.
	 * @return array Normalized appearance.
	 */
	protected function normalize_generic_appearance( array $appearance ) : array {
		$default_appearance = Elements::get_element_generic_appearance_default();
		$normalized_appearance = [];
		// in case there is a null value, we simply replace with the one from
		// default. Now if default also has null value, then it stays and it is now
		// upto the validator, to not throw in such cases.
		foreach ( $default_appearance as $key => $value ) {
			$normalized_appearance[ $key ] = $appearance[ $key ] ?? $value;
		}

		// forcibly normalize two things which are required on all elements
		// forcibly normalize 'widths'
		$widths = $appearance['widths'] ?? [];
		$normalized_appearance['widths'] = [];
		foreach ( $widths as $width ) {
			$normalized_appearance['widths'][] = parse_args(
				$width,
				[
					'id' => 'id',
					'containerMinWidth' => 200,
					'elementWidth' => '100%',
				],
				true
			);
		}
		// forcibly normalize initiallyHidden
		$normalized_appearance['initiallyHidden'] = $appearance['initiallyHidden'] ?? false;

		return $normalized_appearance;
	}

	/**
	 * Normalize a single element. It gracefully merges the default element
	 * config to the existing one, so that an element config can be updated
	 * anytime we want. Then it converts all children items to `absint`.
	 *
	 * @param array $element A valid element associative array, with the
	 *                       following structure.
	 * ```php
	 * [
	 *     "id": <int> => 0,
	 *     "type": <string> => 'Checkbox',
	 *     "config": <array> => [],
	 *     "children": <array> => [Id],
	 * ]
	 * ```.
	 * @return array Normalized element.
	 */
	protected function normalize_element( $element ) : array {
		$normalized_element = $element;
		// force convert id and type to string
		// tip: `??` is called null coalescing operator, returning the first if exists, else the second
		$normalized_element['id'] = (string) ( $normalized_element['id'] ?? \uniqid() );
		$normalized_element['type'] = (string) ( $normalized_element['type'] ?? 'unknown' );

		// Normalize element config
		// Make sure we start with the default
		$normalized_element['config'] = Elements::get_element_config_array_structure();
		$element_type = $normalized_element['type'];
		$actual_element_config = $element['config'][ $element['type'] ] ?? null;

		// Now, if this element is registered and has the proper config set, then
		// override it with a parsed value.
		$normalized_element['config'][ $element['type'] ] = Elements::has_element( $element_type )
				? Elements::get_normalized_element_config(
					$element_type,
					$actual_element_config
				)
				// we don't need to change the config if element isn't registered anymore
				// because graphql resolver will simply not pick it, returning an empty
				// config, which our front-end UI will pick up and show appropriate message.
				: $actual_element_config;

		// Normalize element children, which should be just an array of Ids
		$normalized_element['children'] = isset( $element['children'] )
			? $this->normalize_children( $element['children'] )
			: [];

		// Normalize generic appearance
		$normalized_element['appearance'] = isset( $normalized_element['appearance'] )
			? $this->normalize_generic_appearance( $normalized_element['appearance'] )
			: Elements::get_element_generic_appearance_default();

		return $normalized_element;
	}

	/**
	 * Normalize Form Elements array.
	 *
	 * @param   array $elements  Array of elements (indexed array).
	 *
	 * @return  array            Normalized elements.
	 */
	protected function normalize_elements( array $elements ) : array {
		$normalized_elements = [];
		foreach ( $elements as $element ) {
			$normalized_elements[] = $this->normalize_element( $element );
		}

		return $normalized_elements;
	}

	/**
	 * Normalize the structure so that it always stays up-to-date
	 * with the defaults and the GraphQL schema.
	 *
	 * @param array $structures Array of structure within form data.
	 * @return array Normalized structure.
	 */
	protected function normalize_structures( $structures ) {
		$new_structures = [];
		foreach ( $structures as $key => $page ) {
			// Normalize config
			$page['config'] = parse_args( $page['config'], self::get_default_structure_config() );
			// Normalize child elements
			$page['children'] = isset( $page['children'] )
				? $this->normalize_children( $page['children'] )
				: [];
			$new_structures[ $key ] = $page;
		}
		return $new_structures;
	}

	/**
	 * Normalize pool data.
	 *
	 * @param mixed $pools Possible pool data.
	 * @return array Normalized pool data.
	 */
	protected function normalize_pools( $pools ) : array {
		if ( ! is_array( $pools ) ) {
			return $this->get_default_pools();
		}
		$normalized_pools = [];
		// Always make sure it has the default pool
		$built_in_pool = $this->get_built_in_pool();
		$has_built_in_pool = false;
		foreach ( $pools as $p ) {
			// If Id is not set or if it is empty, then process it
			if ( ! isset( $p['id'] ) || empty( $p['id'] ) ) {
				continue;
			}

			// copy over old element to new children
			if ( isset( $p['elements'] ) ) {
				if ( ! isset( $p['children'] ) ) {
					$p['children'] = [];
				}
				$p['children'] = $p['children'] + $p['elements'];
			}

			// Check if it is the built-in
			if ( $p['id'] === $built_in_pool['id'] ) {
				$has_built_in_pool = true;
			}

			// append the defaults
			// here old elements will be removed anyway
			$normalized_pool = parse_args(
				$p,
				[
					'id' => '',
					'name' => '',
					'children' => [],
				],
				true
			);
			// normalize the elements, which are children
			$normalized_pool['children'] = $this->normalize_children( $normalized_pool['children'] );
			$normalized_pools[] = $normalized_pool;
		}

		// Check if built-in pool was there, otherwise append it
		if ( ! $has_built_in_pool ) {
			// append it to the beginning of the array
			array_unshift( $normalized_pools, $built_in_pool );
		}

		return $normalized_pools;
	}

	/**
	 * Get default consequence for a conditional.
	 *
	 * @return array
	 */
	public static function get_default_conditional_consequence() : array {
		return [
			'id' => '123',
			'action' => 'show_fields',
			'fieldsToShow' => [],
			'fieldsToHide' => [],
			'pagesToShow' => [],
			'pagesToHide' => [],
			'fieldToSet' => null,
			'value' => null,
		];
	}

	/**
	 * Normalize conditionals list with all valid fields.
	 *
	 * @param array $conditionals Conditionals list.
	 * @return array
	 */
	protected function normlize_conditionals( array $conditionals ) : array {
		$normalized_conditionals = [];
		$sample_conditional = [
			'id' => '123',
			'events' => [],
			'consequences' => [],
		];

		foreach ( $conditionals as $conditional ) {
			$normalized_conditional = parse_args(
				$conditional,
				$sample_conditional,
				true
			);

			$normalized_conditional['events'] = [];
			foreach ( $conditional['events'] as $event ) {
				$normalized_conditional['events'][] = parse_args(
					$event, [
						'id' => '123',
						'fieldid' => '123',
						'has' => 'value',
						'operation' => 'is',
						'operator' => 'et',
						'value' => '',
						'relation' => 'and',
					]
				);
			}

			$normalized_conditional['consequences'] = [];
			foreach ( $conditional['consequences'] as $consequence ) {
				$normalized_conditional['consequences'][] = parse_args(
					$consequence, self::get_default_conditional_consequence()
				);
			}

			$normalized_conditionals[] = $normalized_conditional;
		}

		return $normalized_conditionals;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array  $data Raw data from the database.
	 * @param string $purpose Purpose for normalization.
	 * @return array
	 */
	protected function normalize_data( $data, $purpose ) {
		$new_data = $this->get_allowed_db_items( $data, $purpose );

		// Update integrations, payments, permissions, settings and styles
		foreach ( $this->configs as $config ) {
			if ( isset( $new_data[ $config ] ) ) {
				$new_data[ $config ] = $this->normalize_config( $new_data[ $config ], $config );
			} else {
				$new_data[ $config ] = $this->get_default_config_value( $config );
			}
		}

		// Update structure
		if ( isset( $new_data['structures'] ) ) {
			$new_data['structures'] = $this->normalize_structures( $new_data['structures'] );
		} else {
			$new_data['structures'] = []; // empty structure
		}
		// Update elements
		if ( isset( $new_data['elements'] ) ) {
			$new_data['elements'] = $this->normalize_elements( $new_data['elements'] );
		} else {
			$new_data['elements'] = [];
		}
		// update pool
		if ( isset( $new_data['pools'] ) ) {
			$new_data['pools'] = $this->normalize_pools( $new_data['pools'] );
		} else {
			$new_data['pools'] = $this->get_default_pools();
		}

		// update conditionals
		if ( isset( $new_data['conditionals'] ) ) {
			$new_data['conditionals'] = $this->normlize_conditionals( $new_data['conditionals'] );
		} else {
			$new_data['conditionals'] = []; // just an empty conditionals
		}

		// update skeleton
		if ( isset( $new_data['skeleton'] ) ) {
			$new_data['skeleton'] = parse_args(
				$new_data['skeleton'],
				self::get_default_form_skeleton()
			);
		}

		// Update ownerid
		// we don't forcibly set an owner Id because, during update
		// we don't want any owner id in the normalized data.
		// this fixes the irky bug where after updating a form, the ownerId will
		// change to 0.
		if ( isset( $new_data['ownerid'] ) ) {
			$new_data['ownerid'] = (int) $new_data['ownerid'];
		}

		return $new_data;
	}

	/**
	 * Validate element position in a complete form. This function will just throw
	 * exception with client aware validation message.
	 *
	 * 1. Checks if an element is a child of itself.
	 * 2. Checks if an element is positioned multiple times over structure, pool or another element.
	 * 3. Checks if an element is not positioned anywhere at all.
	 *
	 * @throws ValidationException If one of the condition above it met.
	 *
	 * @param   array $data  Complete form data. With pool, structure and elements.
	 *
	 * @return  void
	 */
	protected function validate_elements_position( array $data ) {
		// variable for element position index across pool, structure and element
		$elements_position_index = [];
		// variable for detecting circular dependencies on element
		$element_nodes = [];

		// first create the position index or dictionary
		foreach ( $data['elements'] as $element ) {
			if ( ! isset( $elements_position_index[ $element['id'] ] ) ) {
				$elements_position_index[ $element['id'] ] = [];
			}
			$element_nodes[ $element['id'] ] = $element['children'];
		}

		// Now loop through structure, pool and elements children to add to the index
		foreach ( $data['pools'] as $pool ) {
			foreach ( $pool['children'] as $pool_element_id ) {
				// if pool_element_id is not present, then throw
				if ( ! isset( $elements_position_index[ $pool_element_id ] ) ) {
					throw new ValidationException(
						"Invalid element::{$pool_element_id} in pool::{$pool['id']}."
					);
				}

				$elements_position_index[ $pool_element_id ][] = [
					'type' => 'pool',
					'id' => $pool['id'],
				];
			}
		}

		foreach ( $data['structures'] as $structure ) {
			foreach ( $structure['children'] as $structure_element_id ) {
				// if structure_element_id is not present, then throw
				if ( ! isset( $elements_position_index[ $structure_element_id ] ) ) {
					throw new ValidationException(
						"Invalid element::{$structure_element_id} in structure::{$structure['id']}."
					);
				}

				$elements_position_index[ $structure_element_id ][] = [
					'type' => 'structure',
					'id' => $structure['id'],
				];
			}
		}

		foreach ( $data['elements'] as $element ) {
			foreach ( $element['children'] as $element_element_id ) {
				// if element_element_id is not present, then throw
				if ( ! isset( $elements_position_index[ $element_element_id ] ) ) {
					throw new ValidationException(
						"Invalid element::{$element_element_id} in element::{$element['id']}."
					);
				}

				$elements_position_index[ $element_element_id ][] = [
					'type' => 'element',
					'id' => $element['id'],
				];
			}
		}

		// Now check and throw exception
		foreach ( $elements_position_index as $elm_id => $element_position_index ) {
			$elem_position_count = \count( $element_position_index );
			if ( $elem_position_count > 1 ) {
				throw new ValidationException(
					'An element can only appear once in a structure, pool or another element. ' .
					format_element_position_exception( $elm_id, $element_position_index )
				);
			} elseif ( 0 === $elem_position_count ) {
				throw new ValidationException(
					'Element::' . $elm_id . ' is not positioned anywhere and can not be left orphaned.'
				);
			}
		}

		// Now check for circular dependency and throw exception
		$circular_detector = new CircularReferenceDetect();
		$has_circular_ref = $circular_detector->hasCircularReference( $element_nodes );
		if ( $has_circular_ref ) {
			throw new ValidationException(
				'Elements have circular dependency. Check the following elements: '
				. implode( '->', $has_circular_ref )
				. '.'
			);
		}
	}

	/**
	 * Validate conditionals of a form model.
	 *
	 * 1. Every conditionals should have unique Id.
	 * 2. Every events inside a conditional should have an unique Id.
	 * 3. Every consequences inside a conditional should have an unique Id.
	 *
	 * @throws ValidationException If one of the above is in violation.
	 *
	 * @param array $conditionals Conditionals in form model.
	 * @return void
	 */
	protected function validate_conditionals( array $conditionals ) : void {
		// check if all items in conditionals have unique Id
		if ( ! validate_array_has_unique_ids( $conditionals, 'id' ) ) {
			throw new ValidationException( 'Ids for all conditional items must be unique.' );
		}

		// now loop over every conditional and make sure the events and consequences
		// have unique Ids in their scope.
		foreach ( $conditionals as $conditional ) {
			if ( ! validate_array_has_unique_ids( $conditional['events'], 'id' ) ) {
				throw new ValidationException( 'Ids for all events inside a conditional item must be unique.' );
			}

			if ( ! validate_array_has_unique_ids( $conditional['consequences'], 'id' ) ) {
				throw new ValidationException( 'Ids for all consequences inside a conditional item must be unique.' );
			}
		}
	}

	/**
	 * Validate generic appearance value on Elements.
	 *
	 * @throws ValidationException If null value was passed to a required field.
	 *
	 * @param string $type Type of the element.
	 * @param array  $appearance Appearance (normalized).
	 * @return void
	 */
	protected function validate_generic_appearance( string $type, array $appearance ) : void {
		// GraphQL takes care of non null, so we check for validity
		// check if all fields used by the element does not have null value
		$appearance_defaults = Elements::get_element_generic_appearance_default();
		if ( Elements::has_element( $type ) ) {
			$element_appearance_structure = Elements::get_element_generic_appearance_structure( $type );
			// we can safely assume that appearance has all the keys
			// because normalizer would have pushed non-existings anyway
			foreach ( $appearance as $key => $value ) {
				// throw an error if required by the element,
				// yet null value was passed. We don't need typecheck, because of GraphQL
				if (
					// element class is explicitly telling that it uses, yet value is null
					(
						isset( $element_appearance_structure[ $key ] )
						&& \is_array( $element_appearance_structure[ $key ] )
						&& isset( $element_appearance_structure[ $key ]['uses'] )
						&& $element_appearance_structure[ $key ]['uses']
						&& $value === null
					)
					||
					// element isn't explicit, so we assume that it uses
					(
						! isset( $element_appearance_structure[ $key ] )
						&& $value === null
						// but not if the default value is null too
						&& $appearance_defaults[ $key ] !== null
					)
				) {
					throw new ValidationException( "Appearance {$key} is required by element {$type}, yet null was given." );
				}
			}
		}

		// there is no need to check for widths and initiallyHidden because it
		// would be fixed by the normalizer anyway.
		// so directly check the valid Ids in widths
		if ( ! validate_array_has_unique_ids( $appearance['widths'], 'id' ) ) {
			throw new ValidationException( 'All ids inside element appearance widths should be unique.' );
		}
	}

	/**
	 * Get fieldvars from a config. Config can be one of integrations, payments,
	 * permissions, settings or styles.
	 *
	 * @throws ModelOperationException If `$config` is not one of above.
	 *
	 * @param string $config Type of config as mentioned above.
	 *
	 * @return array
	 */
	protected function get_config_field_vars( string $config ) : array {
		if ( $config === 'integrations' ) {
			return Integrations::get_registered_configs_field_vars();
		} elseif ( $config === 'payments' ) {
			return Payments::get_registered_configs_field_vars();
		} elseif ( $config === 'permissions' ) {
			return Permissions::get_registered_configs_field_vars();
		} elseif ( $config === 'settings' ) {
			return Settings::get_registered_configs_field_vars();
		} elseif ( $config === 'styles' ) {
			return Styles::get_registered_configs_field_vars();
		} else {
			throw new ModelOperationException( "Configs can be one of integrations, payments, permissions, settings or styles. {$config} is not a valid config." );
		}
	}

	/**
	 * {@inheritDoc}
	 *
	 * Will throw exception for the following conditions
	 *
	 * 1. Not all pools have unique Ids.
	 * 2. Not all elements have unique Ids.
	 * 3. Elements can not appear in more than one structure/element/pool.
	 * 4. No elements are orphaned.
	 * 5. Call fieldVar based validation on a few settings elements.
	 * 6. Conditionals are proper.
	 *
	 * @throws ValidationException If one of the above conditions are met.
	 *
	 * @param   array  $data          Data to be validated.
	 * @param   string $purpose_code  Purpose code for calling this function.
	 *
	 * @return  array                 Validated data.
	 */
	protected function validate_data( $data, $purpose_code ) {
		// Make sure the structure doesn't have identical Ids
		if ( ! validate_array_has_unique_ids( $data['structures'], 'id' ) ) {
			throw new ValidationException( 'Ids for all structure items must be unique.' );
		}

		// Make sure the pool doesn't have identical Ids
		if ( ! validate_array_has_unique_ids( $data['pools'], 'id' ) ) {
			throw new ValidationException( 'Ids for all pool items must be unique.' );
		}

		// Make sure the elements doesn't have identical Ids
		if ( ! validate_array_has_unique_ids( $data['elements'], 'id' ) ) {
			throw new ValidationException( 'Ids for all elements items must be unique.' );
		}

		// Make sure one element can not appear in more than one structure, element children
		// or pool elements
		$this->validate_elements_position( $data );

		// Call fieldvar validation on configs
		foreach ( $this->configs as $config ) {
			FieldVar::recursivelyValidate(
				$this->get_config_field_vars( $config ),
				$data[ $config ],
				$config
			);
		}

		// Call fieldVar validation on Element Config
		// validate children
		// and also validate generic appearance
		foreach ( $data['elements'] as $element ) {
			// could be element came from an add-on and no longer active
			if ( Elements::has_element( $element['type'] ) ) {
				// verify field vars
				if (
					// could be some lost config due to any reason!
					isset( $element['config'][ $element['type'] ] )
					// the value could be null?
					&& \is_array( $element['config'][ $element['type'] ] )
				) {
					FieldVar::recursivelyValidate(
						Elements::get_element_config_vars( $element['type'] ),
						$element['config'][ $element['type'] ],
						"Element::{$element['id']}->config"
					);
				}
				// verify children, the following function will check for definition
				// as well as call individual validate_children
				Elements::validate_element_children(
					$element['id'],
					$element['type'],
					$element['children'],
					$data['elements']
				);
			}

			$this->validate_generic_appearance( $element['type'], $element['appearance'] );
		}

		// Make sure conditionals are proper
		$this->validate_conditionals( $data['conditionals'] );

		// No error so return the data
		return $data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Array of Ids.
	 * @return array|null
	 */
	protected function get_pre_cache_ids_data( array $ids ): ?array {
		global $wpdb;
		$table = $this->get_table_name();

		$in = normalize_db_ids_for_in( $ids );

		$query =
			"SELECT
				*
			FROM {$table}
			WHERE id IN ({$in})";

		$results = $wpdb->get_results( $query, \ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

		if ( ! $results || empty( $results ) ) {
			return [];
		}

		return convert_list_to_dictionary( $results, 'id' );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param int|null    $id Id of the entry.
	 * @param null|string $token Token of the entry.
	 * @return array
	 */
	protected function get_data_from_db( $id, $token = null ) {
		global $wpdb;
		$table = $this->get_table_name();
		// Query the database
		$data = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id = %d", $id ), \ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		// return it
		return $data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return array [ $wpdb insert result, last insert id ]
	 */
	protected function create_data_on_db( $data ) {
		global $wpdb;

		// we accept a specific set of data on create
		$dbdata = $this->get_allowed_db_items( $data, self::DB_CREATE );

		// add to database
		$table = $this->get_table_name();
		$inserted = $wpdb->insert(
			$table,
			$dbdata,
			'%s'
		);
		return [ $inserted, $wpdb->insert_id ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function update_data_on_db( $data ) {
		global $wpdb;

		// we only accept the following data during update
		$dbdata = $this->get_allowed_db_items( $data, self::DB_UPDATE );

		// call update on $wpdb
		return $wpdb->update(
			$this->get_table_name(),
			$dbdata,
			[
				'id' => $this->id,
			],
			'%s',
			'%d'
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $id Id of the model which has been deleted.
	 * @return void
	 */
	protected function cleanup_after_data_delete( $id ) {
		/** @var \WPDB $wpdb */
		global $wpdb;
		// Delete submission
		$wpdb->delete(
			Init::$database['submission'],
			[
				'formId' => $id,
			],
			[
				'%d',
			]
		);
		// Delete payments
		$wpdb->delete(
			Init::$database['payment'],
			[
				'formId' => $id,
			],
			[
				'%d',
			]
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Collection ids.
	 * @return void
	 */
	protected function cleanup_after_collection_delete( array $ids ) {
		global $wpdb;
		$in = normalize_db_ids_for_in( $ids );

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		// delete all submissions related to the formIds
		$submission_table = Init::$database['submission'];
		$submission_delete_query = "DELETE FROM {$submission_table} WHERE formId IN ({$in})";
		$wpdb->query( $submission_delete_query );

		// delete all payments related to the formIds
		$payment_table = Init::$database['payment'];
		$payment_delete_query = "DELETE FROM {$payment_table} WHERE formId IN ({$in})";
		$wpdb->query( $payment_delete_query );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
	}

	/**
	 * Get table name for metadata relation.
	 *
	 * @return string
	 */
	protected function get_meta_table_name() {
		return Init::$database['formmeta'];
	}

	/**
	 * Normalize variable types of forms columns.
	 *
	 * It typically converts string to integers for needed columns.
	 *
	 * @param array $forms Indexed array of associated array of forms.
	 * @return array Normalized array of forms.
	 */
	protected function normalize_all_edges_columns( $forms ) {
		if ( ! \is_array( $forms ) ) {
			return $forms;
		}
		foreach ( $forms as $key => $form ) {
			// cast id, total_subs and ownerid
			$forms[ $key ]['id'] = (int) $forms[ $key ]['id'];
			$forms[ $key ]['ownerid'] = (int) $forms[ $key ]['ownerid'];
			$forms[ $key ]['submissionCount'] = (int) $forms[ $key ]['submissionCount'];
		}
		return $forms;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param bool $trashed Whether it is trashed or not.
	 * @return string
	 */
	protected function get_trash_clause( $trashed ) {
		if ( true === $trashed ) {
			return 'f.trashed = 1';
		}
		return 'f.trashed = 0';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	protected function get_orderby_whitelists(): array {
		return [
			'id',
			'name',
			'updated',
			'created',
			'ownerid',
			'submissionCount',
			'viewCount',
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_cursor_key_for_db_query(): string {
		return 'f.id';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $pagination Pagination Arguments.
	 * @param array $filter Filter arguments.
	 * @return array [ $edges, $edges_count, $all_edges_count, $limit ]
	 */
	protected function get_edges_for_collection( $pagination, $filter ) {
		global $wpdb;

		// Normalize filters
		$filter = parse_args(
			$filter,
			[
				'search' => '',
				'category' => 0,
				'owner' => 0,
				'resourceView' => 'all',
				'mergeShared' => false,
			]
		);

		// Tables
		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];
		$meta_table = Init::$database['formmeta'];

		$search = $filter['search'];
		$category = $filter['category'];
		$owner = $filter['owner'];
		$resource_view = $filter['resourceView'];
		$merge_shared = $filter['mergeShared'];

		// possible wheres
		list( $limit, $order_by, $wheres, $offset ) = $this->get_limit_and_clause_from_cursor( $pagination );
		$all_edges_wheres = [];

		// add filters if present
		// Add the search query if present
		if ( '' !== $search ) {
			$all_edges_wheres[] = $wheres[] = $wpdb->prepare(
				'f.name LIKE %s',
				'%' . $wpdb->esc_like( $search ) . '%'
			); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
		}
		// Add the category if present
		if ( 0 !== $category ) {
			$all_edges_wheres[] = $wheres[] = $wpdb->prepare( "f.id IN (SELECT foreign_id FROM `{$meta_table}` WHERE meta_key = 'category' AND meta_value = %d )", $category ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found,WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		}
		// Add owner/shared if present
		// If shared is true, then model expects that $filter['owner'] should also
		// represent currently logged in user, with whom forms are shared. Make sure
		// controller implements this (and it does).
		if ( $resource_view === 'shared' ) {
			if ( $merge_shared && 0 !== $owner ) {
				$all_edges_wheres[] = $wheres[] =
					$wpdb->prepare(
						"(f.id IN (SELECT foreign_id FROM {$meta_table} WHERE meta_key = 'editor' AND meta_value = %d) OR f.ownerid = %d)", // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found,WordPress.DB.PreparedSQL.InterpolatedNotPrepared
						$owner,
						$owner
					);
			} else {
				$all_edges_wheres[] = $wheres[] =
					$wpdb->prepare(
						"f.id IN (SELECT foreign_id FROM {$meta_table} WHERE meta_key = 'editor' AND meta_value = %d)", // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found,WordPress.DB.PreparedSQL.InterpolatedNotPrepared
						$owner
					);
			}
		} elseif ( 0 !== $owner ) {
			// For everything else, the form_owner is set appropriately by controller
			$all_edges_wheres[] = $wheres[] =
				$wpdb->prepare( 'f.ownerid = %d', $owner ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found,WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		}

		// add trashed
		$all_edges_wheres[] = $wheres[] = $this->get_trash_clause( $resource_view === 'trashed' ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found

		// construct the where
		$where = $this->get_where_in_query( $wheres );
		$all_edges_where = $this->get_where_in_query( $all_edges_wheres );

		// Initiate the query
		$query = "SELECT
				f.id id,
				f.name name,
				f.updated updated,
				f.created created,
				f.ownerid ownerid,
				f.viewCount viewCount,
				f.elements elements,
				COUNT(d.id) submissionCount,
				f.styles styles,
				f.structures structures
			FROM {$form_table} f
			LEFT JOIN {$submission_table} d
			ON
				f.id = d.formId
			{$where}
			AND (d.trashed IS NULL OR d.trashed = 0)
			GROUP BY f.id
			ORDER BY {$order_by}
			LIMIT {$this->get_limit_query_from_caluse( $limit, $offset )}";

		// Query and get edges
		$edges = $wpdb->get_results( $query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		// Cast needed fields
		$edges = $this->normalize_all_edges_columns( $edges );

		// Get counts
		$edges_count = $wpdb->get_var( "SELECT COUNT(f.id) FROM {$form_table} f{$where}" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$all_edges_count = $wpdb->get_var( "SELECT COUNT(f.id) total FROM {$form_table} f{$all_edges_where}" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		// Return
		return [ $edges, $edges_count, $all_edges_count, $limit, $offset ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $filter Metadata filter.
	 *
	 * @return array|null
	 */
	public function metadata_collection_filters( array $filter ): ?array {
		global $wpdb;

		$owners = null;
		$categories = null;

		$category_table = Init::$database['category'];
		$form_table = Init::$database['form'];
		$user_table = $wpdb->users;

		$filter = parse_args(
			$filter, [
				'resolve_owners' => false,
				'resolve_categories' => false,
				'view_mode' => 'owned',
				'current_user_id' => 0,
				'can_manage_other_models' => false,
			]
		);

		// resolve categories if needed
		if ( $filter['resolve_categories'] ) {
			/*
			SELECT
				c.title `title`,
				c.id `id`,
				COUNT(m.meta_value) `total`
			FROM `wp_wpq_eform_formmeta` m
			LEFT JOIN `wp_wpq_eform_category` c
			ON m.meta_value = c.id
			WHERE
				m.meta_key = 'category'
				AND m.foreign_id IN
					(SELECT id FROM `wp_wpq_eform_form` WHERE ownerid = 1)
			GROUP BY m.meta_value;
			*/

			$categories_query =
				"SELECT
					c.title title,
					m.meta_value id,
					COUNT(m.meta_value) total
				FROM {$this->get_meta_table_name()} m
				LEFT JOIN {$category_table} c
				ON m.meta_value = c.id
				WHERE m.meta_key = 'category'";

			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			// get all assigned categories and owners
			if ( $filter['view_mode'] === 'owned' ) {
				// requesting for owned only, that is relevant to provided userId
				$categories_query .= $wpdb->prepare(
					" AND m.foreign_id IN
						(SELECT id FROM {$form_table} WHERE ownerid = %d AND trashed = 0)
					",
					$filter['current_user_id']
				);
			} elseif ( $filter['view_mode'] === 'shared' ) {
				$categories_query .= $wpdb->prepare(
					" AND m.foreign_id IN
						(
							SELECT foreign_id FROM {$this->get_meta_table_name()}
							WHERE meta_key = 'editor'
							AND meta_value = %d
						)
					AND m.foreign_id NOT IN
						(SELECT id FROM {$form_table} WHERE trashed = 1)
					",
					$filter['current_user_id']
				);
			} elseif ( $filter['view_mode'] === 'trashed' ) {
				if ( $filter['can_manage_other_models'] ) {
					$categories_query .=
						" AND m.foreign_id IN
							(SELECT id FROM {$form_table} WHERE trashed = 1)
						";
				} else {
					$categories_query .= $wpdb->prepare(
						" AND m.foreign_id IN
							(SELECT id FROM {$form_table} WHERE ownerid = %d AND trashed = 1)
						",
						$filter['current_user_id']
					);
				}
			} else {
				$categories_query .= "AND m.foreign_id NOT IN
					(SELECT id FROM {$form_table} WHERE trashed = 1)
				";
			}
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared

			$categories_query .= ' GROUP BY m.meta_value';

			// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
			$categories = $wpdb->get_results( $categories_query, ARRAY_A );
			// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
		}

		// resolve owners if needed
		if ( $filter['resolve_owners'] ) {
			/*
			Requesting for all
			SELECT
				f.ownerid `id`,
				u.display_name `username`,
				COUNT(f.ownerid) total
			FROM `wp_wpq_eform_form` f
			LEFT JOIN `wp_users` u
			ON f.ownerid = u.id
			GROUP BY f.ownerid;
			*/
			// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$query = "SELECT
					f.ownerid id,
					u.display_name username,
					COUNT(f.ownerid) total
				FROM {$form_table} f
				LEFT JOIN {$user_table} u
				ON f.ownerid = u.id
				";

			if ( $filter['view_mode'] === 'trashed' ) {
				$query .= ' WHERE f.trashed = 1';
			} elseif ( $filter['view_mode'] === 'shared' ) {
				$query .= $wpdb->prepare(
					" WHERE f.id IN
						(
							SELECT foreign_id FROM {$this->get_meta_table_name()}
							WHERE
								meta_key = 'editor'
							AND
								meta_value = %d
						)
						AND f.trashed = 0
					",
					$filter['current_user_id']
				);
			} else {
				$query .= ' WHERE f.trashed = 0';
			}

			$query .= ' GROUP BY f.ownerid';
			$owners = $wpdb->get_results(
				$query,
				ARRAY_A
			);
			// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		}

		return [
			'categories' => $categories,
			'owners' => $owners,
		];
	}

	/**
	 * Get name of a form by Id.
	 *
	 * @param int $id Id of the form.
	 * @return string Name of the form.
	 */
	public static function get_form_name( int $id ) {
		global $wpdb;
		$form_table = Init::$database['form'];
		return $wpdb->get_var(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare( "SELECT name FROM {$form_table} WHERE id = %d", $id )
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}

	/**
	 * Get default form skeletons. These should be passed to the form during
	 * creation or update.
	 *
	 * @return array
	 */
	public static function get_default_form_skeleton() : array {
		return [
			'formPreviewSkeleton' => '',
			'formEditSkeleton' => '',
			'formSummarySkeleton' => '',
		];
	}

	/**
	 * Get form ThemeStyle data by parsing the database stored JSON and converting
	 * as necessary.
	 *
	 * @param array $data Data as received from database.
	 * @return array [ $theme_style, $panels, $controls ]
	 */
	public static function get_form_theme_style_data( array $data ) : array {
		// Make the same ThemeStyle object as
		// ./src/components/ThemedContainer/useFormTheme.ts::ThemeStyle
		$form_styles = \json_decode( $data['styles'], true );
		$theme_style = [
			'scheme' => $form_styles['theme']['scheme'] ?? 'teal',
			'darkMode' => \strtoupper( $form_styles['theme']['darkMode'] ?? 'off' ),
			'baseFont' => $form_styles['typography']['baseFont'] ?? null,
			'boldHeading' => $form_styles['typography']['headFontBold'] ?? null,
			'italicHeading' => $form_styles['typography']['headFontItalic'] ?? null,
			'headFamily' => $form_styles['typography']['headFamily'] ?? null,
			'headFamilyCustom' => $form_styles['typography']['headFamilyCustom'] ?? null,
			'bodyFamily' => $form_styles['typography']['bodyFamily'] ?? null,
			'bodyFamilyCustom' => $form_styles['typography']['bodyFamilyCustom'] ?? null,
			'customPrimaryColor' => $form_styles['theme']['customColorPrimary'] ?? null,
			'customSecondaryColor' => $form_styles['theme']['customColorSecondary'] ?? null,
			'customBackgroundColor' => $form_styles['theme']['customColorBg'] ?? null,
			'customTextColor' => $form_styles['theme']['customColorText'] ?? null,
			'css' => $form_styles['theme']['css'] ?? null,
			'maxWidth' => $form_styles['appearance']['maxWidth'] ?? '100%',
			'containerLayout' => \strtoupper( $form_styles['appearance']['containerLayout'] ?? 'FLUID' ),
		];
		$form_structutes = \json_decode( $data['structures'], true );
		$controls = isset( $form_structutes[0] )
			? count( $form_structutes[0]['children'] )
			: 1;
		$panels = \count( $form_structutes );
		if ( ! $panels ) {
			$panels = 1;
		}

		return [ $theme_style, $panels, $controls ];
	}

	/**
	 * Get data for standalone output related functions.
	 *
	 * @param int $id Form Id.
	 * @return array|null Name and other data if form is found, null otherwise.
	 */
	public static function get_form_standalone_data( int $id ) {
		global $wpdb;
		$form_table = Init::$database['form'];
		$meta_table = Init::$database['formmeta'];
		$data = $wpdb->get_row(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare( "SELECT name, styles, structures, skeleton, ownerid FROM {$form_table} WHERE id = %d AND trashed = 0", $id ),
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			\ARRAY_A
		);
		if ( ! $data ) {
			return null;
		}
		$form_name = $data['name'];
		$skeletons = \json_decode( $data['skeleton'] ?? '', true );
		$default_skeletons = self::get_default_form_skeleton();

		if ( ! $skeletons ) {
			$skeletons = $default_skeletons;
		} else {
			$skeletons = parse_args( $skeletons, $default_skeletons );
		}

		[ $theme_style, $panels, $controls ] = self::get_form_theme_style_data( $data );

		$editors = $wpdb->get_col(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT meta_value FROM {$meta_table} WHERE meta_key='editor' AND foreign_id=%d",
				$id
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);

		return [
			'name' => $form_name,
			'theme_style' => $theme_style,
			'panels' => $panels,
			'controls' => $controls,
			'skeleton' => $skeletons,
			'ownerid' => \intval( $data['ownerid'] ),
			'editors' => \array_map( 'intval', $editors ?? [] ),
		];
	}

	// HELPER METHODS

	/**
	 * Get Token of last submission of a user for a form. If none found, then
	 * it will return null.
	 *
	 * @param int $user_id User Id.
	 * @param int $form_id Form Id.
	 *
	 * @return string|null Token on success, Null on failure.
	 */
	public static function get_last_submission_token_of_user( int $user_id, int $form_id ) : ?string {
		global $wpdb;
		$submission_table = Init::$database['submission'];

		return $wpdb->get_var(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT token FROM
					`{$submission_table}` s
					WHERE
						s.formId = %d
					AND
						s.userId = %d
					AND
						s.trashed = 0
					ORDER BY id DESC LIMIT 1", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$form_id,
				$user_id
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}

	/**
	 * Get total submission count of a form.
	 *
	 * @param int $form_id Form Id.
	 *
	 * @return int Total count.
	 */
	public static function get_total_submission_count( int $form_id ) : int {
		global $wpdb;
		$submission_table = Init::$database['submission'];

		$count = $wpdb->get_var(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT COUNT(id) FROM
				`{$submission_table}` s
				WHERE
					s.formId = %d
				AND
					s.trashed = 0", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$form_id
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);

		if ( $count ) {
			return (int) $count;
		}

		return 0;
	}

	/**
	 * Get total submission count of a form by User Id.
	 *
	 * @param int $user_id User Id.
	 * @param int $form_id Form Id.
	 *
	 * @return int Total count.
	 */
	public static function get_submission_count_by_user( int $user_id, int $form_id ) : int {
		global $wpdb;
		$submission_table = Init::$database['submission'];

		$count = $wpdb->get_var(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT COUNT(id) FROM
				`{$submission_table}` s
				WHERE
					s.formId = %d
				AND
					s.userId = %d
				AND
					s.trashed = 0", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$form_id,
				$user_id
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);

		if ( $count ) {
			return (int) $count;
		}

		return 0;
	}

	/**
	 * Get total submission count of a form by email.
	 *
	 * @param string $email Email address.
	 * @param int    $form_id Form Id.
	 *
	 * @return int Total count.
	 */
	public static function get_submission_count_by_email( string $email, int $form_id ) : int {
		global $wpdb;
		$table_name = Init::$database['submission'];

		$count = $wpdb->get_var(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT COUNT(id) FROM `{$table_name}`
				WHERE
					formId = %d
				AND
					email = %s
				AND
					trashed = 0", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$form_id,
				$email
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);

		if ( $count ) {
			return (int) $count;
		}

		return 0;
	}

	/**
	 * Get total submission count of a form by IP address.
	 *
	 * @param string $ip IP address.
	 * @param int    $form_id Form Id.
	 *
	 * @return int Total count.
	 */
	public static function get_submission_count_by_ip( string $ip, int $form_id ) : int {
		global $wpdb;
		$table_name = Init::$database['submission'];

		$count = $wpdb->get_var(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT COUNT(id) FROM `{$table_name}`
				WHERE
					formId = %d
				AND
					ip = %s
				AND
					trashed = 0
				", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$form_id,
				$ip
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);

		if ( $count ) {
			return (int) $count;
		}

		return 0;
	}

	/**
	 * Increase form view count by 1.
	 *
	 * @param int $form_id Form Id.
	 * @return void
	 */
	public static function increase_form_view_count( int $form_id ) : void {
		$table = Init::$database['form'];
		global $wpdb;

		$wpdb->query(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"UPDATE {$table} SET viewCount = viewCount + 1 WHERE id = %d",
				$form_id
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}

	/**
	 * Get form view count of a form.
	 *
	 * @param int $form_id Form id.
	 * @return int View count.
	 */
	public static function get_form_view_count( int $form_id ) {
		$table = Init::$database['form'];
		global $wpdb;

		return \intval(
			$wpdb->get_var(
				// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$wpdb->prepare(
					"SELECT viewCount FROM {$table} WHERE id = %d",
					$form_id
				)
				// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			)
		);
	}
}
