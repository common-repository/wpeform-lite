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
 * @author Swashata Ghosh <swashata@wpquark.com>
 */

namespace WPEForm\Form\Element;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\Util\SlateJS;

use function WPEForm\Helpers\get_default_element_config_attributes;
use function WPEForm\Helpers\get_default_element_config_filters;
use function WPEForm\Helpers\get_default_element_score;
use function WPEForm\Helpers\get_element_from_array_by_id;
use function WPEForm\Helpers\get_list_of_element_options;
use function WPEForm\Helpers\get_matching_options_ids_from_metavalue;
use function WPEForm\Helpers\get_user_metavalue;
use function WPEForm\Helpers\rearrange_elements_from_source_by_id;
use function WPEForm\Helpers\validate_list_items_with_id_key;
use function WPEForm\Helpers\validate_score_with_conditions_and_items;
use function WPEForm\Helpers\validate_selected_items_with_filters;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Dropdown Element class. Dropdown Selection.
 *
 * Let user choose one or multiple items from a list.
 */
class Dropdown extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Dropdown Selection', 'wp-eform' ),
			'description' => __( 'Let user choose one or multiple items from a list.', 'wp-eform' ),
			'container' => false,
			'category' => 'choice',
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_generic_appearance_structure(): array {
		return [
			'title' => [
				'uses' => true,
				'default' => __( 'Dropdown Selection element', 'wp-eform' ),
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function config_vars() : array {
		return [
			'interface' => [
				'icon' => FieldVar::var( 'fas fa-check', Type::string() ),
				'placeholder' => FieldVar::var(
					__( 'select an option', 'wp-eform' ),
					Type::string()
				),
				'showSearch' => FieldVar::var( true, Type::boolean() ),
				'searchPlaceholder' => FieldVar::var(
					__( 'search through options', 'wp-eform' ),
					Type::string()
				),
				'emptySearchResultNotice' => FieldVar::Var(
					__( 'Could not find what you were looking for. Kindly broaden your search', 'wp-eform' ),
					Type::string()
				),
				// we won't have any pre-populating list of options here, instead we will
				// use the UI. See #43
				'options' => FieldVar::var(
					get_list_of_element_options( 4 ),
					Type::listOf(
						Type::nonNull(
							Registry::get( 'mcqOption', 'type/form/element/config' )
						)
					),
					Type::listOf(
						Type::nonNull(
							Registry::get( 'mcqOption', 'input/form/element/config' )
						)
					)
				)->setValidator( '\\WPEForm\\Helpers\\validate_list_items_with_id_key' ),
				'others' => FieldVar::var( false, Type::boolean() ),
				'othersId' => FieldVar::var( '', Type::id() ),
				'othersPlaceholder' => FieldVar::var(
					__( 'enter your choice here', 'wp-eform' ),
					Type::string()
				),
				'shuffle' => FieldVar::var( false, Type::boolean() ),
			],
			'attributes' => FieldVar::var(
				get_default_element_config_attributes(),
				Registry::get( 'attributes', 'type/form/element/config' ),
				Registry::get( 'attributes', 'input/form/element/config' )
			),
			'score' => FieldVar::var(
				get_default_element_score(),
				Registry::get( 'score', 'type/form/element/config' ),
				Registry::get( 'score', 'input/form/element/config' )
			)->setValidator(
				function( $score ) {
						return validate_list_items_with_id_key( $score['scoreConditions'] );
				}
			),
			'validation' => [
				'required' => FieldVar::var( false, Type::boolean() ),
				'selectType' => FieldVar::var(
					'multiple',
					Registry::get( 'selectType', 'enum' )
				),
				'filters' => FieldVar::var(
					get_default_element_config_filters(),
					Registry::get( 'filters', 'type/form/element/config' ),
					Registry::get( 'filters', 'input/form/element/config' )
				),
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function data_value_vars(): array {
		return [
			'selected' => FieldVar::var(
				[],
				Type::listOf( Type::nonNull( Type::id() ) )
			),
			'other' => FieldVar::var( null, Type::string() )->setNullable( true ),
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array An associative array with success => bool, and message => string
	 */
	public function get_validation_status( array $config, array $data_value ) : array {
		$validation_config = $config['validation'];

		// is invalid, if is required, yet no data
		if ( $validation_config['required'] && empty( $data_value['selected'] ) ) {
			return $this->get_validation_error(
				__( 'A value is required.', 'wp-eform' )
			);
		}

		// is invalid, if user selected other, but no other value
		if (
			$config['interface']['others'] === true
			&& \in_array( $config['interface']['othersId'], $data_value['selected'] )
			&& empty( $data_value['other'] )
			&& $validation_config['required']
		) {
			return $this->get_validation_error(
				__( 'Other value can not be empty.', 'wp-eform' )
			);
		}

		// if it is a single dropdown, then selected could have only one
		if ( $validation_config['selectType'] === 'single' ) {
			if ( \count( $data_value['selected'] ) > 1 ) {
				return $this->get_validation_error(
					__( 'Can have only one selection.', 'wp-eform' )
				);
			}
		} else {
			// validation like checkbox applies
			$min_max_error = validate_selected_items_with_filters(
				$validation_config['filters'],
				$data_value['selected']
			);

			if ( $min_max_error !== null ) {
				return $this->get_validation_error( $min_max_error );
			}
		}

		// everything checks out
		return $this->get_default_validation_status();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array                                                                                          $config Normalized configuration value.
	 * @param array{selected: array<string>, other: string}                                                  $data_value Normalized data.value.
	 * @param array{option: string, row: string, range: string, entry: string, return: string, type: string} $using An associative array of using config.
	 * @param callable|null                                                                                  $mentions_callback Callback function for mentions.
	 *
	 * @return array|string Element's value.
	 */
	protected function simple_value( array $config, array $data_value, array $using, ?callable $mentions_callback = null ) {
		$selected_values = rearrange_elements_from_source_by_id( $config['interface']['options'], $data_value['selected'] );
		$selected_labels = [];
		foreach ( $selected_values as $option_id ) {
			$option = get_element_from_array_by_id(
				$config['interface']['options'],
				$option_id
			);
			if ( ! $option ) {
				$selected_labels[] = \__( 'Unknown option', 'wp-eform' );
			} else {
				$parsed_label = SlateJS::parseEditorChildrenJSON( $option['label'] );
				if ( \is_callable( $mentions_callback ) ) {
					$parsed_label->setRenderMentions(
						$this->get_mentions_callback_for_nested_items( $mentions_callback )
					);
				}
				$selected_labels[] = $parsed_label->getText();
			}
		}

		// if expecting JSON
		if ( $using['return'] === 'json' ) {
			return [
				'selected' => $using['type'] === 'id' ? $selected_values : $selected_labels,
				'other' => \esc_html( $data_value['other'] ?? '' ),
			];
		}

		// expecting STRING
		$return = \implode(
			$using['option'],
			$using['type'] === 'id' ? $selected_values : $selected_labels
		);
		if ( ! empty( $data_value['other'] ) && $using['other'] ) {
			$return .= $using['entry'] . \esc_html( $data_value['other'] ?? '' );
		}

		return $return;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array
	 */
	public function get_data_score( array $config, array $data_value ) : array {
		// init score array
		$score_config = $config['score'];
		$score = $this->get_empty_score( $score_config );
		// calculate score based on config and data_value
		foreach ( $score_config['scoreConditions'] as $condition ) {
			$is_valid = validate_score_with_conditions_and_items(
				$condition,
				$data_value['selected'],
				$config['validation']['selectType'] === 'single'
			);

			$score = $this->update_score_with_condition(
				$score,
				$is_valid,
				$condition,
				$config['validation']['selectType'] !== 'single'
			);
		}

		return $score;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array         $config Normalized config of the element.
	 * @param array         $data_value Normalized data value of the element.
	 * @param null|callable $mentions_callback Mentions callback for SlateJS renderer.
	 * @param string        $purpose Purpose of the HTML. Could be 'email' or 'pdf'.
	 * @return string HTML output.
	 */
	protected function html_value( array $config, array $data_value, ?callable $mentions_callback, string $purpose = 'email' ): string {
		$values = $this->get_simple_value(
			$config,
			$data_value,
			[
				'return' => 'json',
				'type' => 'label',
			],
			$mentions_callback
		);

		$output = '';

		if ( empty( $values['selected'] ) ) {
			return '<p>' . __( 'No options selected.', 'wp-eform' ) . '</p>';
		}

		$output .= '<ul>';
		foreach ( $values['selected'] as $option ) {
			$output .= '<li>' . $option . '</li>';
		}
		$output .= '</ul>';

		if (
			$config['interface']['others'] === true
			&& \in_array( $config['interface']['othersId'], $data_value['selected'] )
			&& ! empty( $values['other'] )
		) {
			$output .= '<hr /><p>' . $values['other'] . '</p>';
		}

		return $output;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array|null $config Config data.
	 *
	 * @return string|null
	 */
	public function get_extra_type_data( ?array $config ): ?string {
		// we use the extra type data for dealing with meta based prefil values
		$data = [
			'metaValue' => null,
		];

		if (
			$config &&
			$config['attributes']['prefilType'] === 'meta'
		) {
			$metadata = get_user_metavalue( $config['attributes']['prefilParameter'] );
			$options = $config['interface']['options'];

			// compare against options list
			if ( \is_string( $metadata ) ) {
				$possible_meta_values = get_matching_options_ids_from_metavalue(
					$metadata,
					$options
				);
				if ( ! empty( $possible_meta_values ) ) {
					$data['metaValue'] = $possible_meta_values;
				}
			}
		}

		return \json_encode( $data );
	}
}
