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
use function WPEForm\Helpers\get_default_element_score;
use function WPEForm\Helpers\get_element_from_array_by_id;
use function WPEForm\Helpers\get_list_of_element_options;
use function WPEForm\Helpers\get_user_metavalue;
use function WPEForm\Helpers\validate_list_items_with_id_key;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Radio Element class. Single Option.
 *
 * Select one option from a list of options. Input radio control.
 */
class Radio extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Single Option', 'wp-eform' ),
			'description' => __( 'Select one option from a list of options. Input radio control.', 'wp-eform' ),
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
				'default' => __( 'Single Option element', 'wp-eform' ),
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
				'icon' => FieldVar::var( 'fas fa-circle', Type::string() ),
				'columns' => FieldVar::var( 'one', Registry::get( 'optionColumn', 'enum' ) ),
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
			'score' => FieldVar::var(
				get_default_element_score(),
				Registry::get( 'score', 'type/form/element/config' ),
				Registry::get( 'score', 'input/form/element/config' )
			)->setValidator(
				function( $score ) {
						return validate_list_items_with_id_key( $score['scoreConditions'] );
				}
			),
			'attributes' => FieldVar::var(
				get_default_element_config_attributes(),
				Registry::get( 'attributes', 'type/form/element/config' ),
				Registry::get( 'attributes', 'input/form/element/config' )
			),
			'validation' => [
				'required' => FieldVar::var( false, Type::boolean() ),
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
				null,
				Type::id()
			)->setNullable( true ),
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

		// is invalid, if is required yet no data
		if (
			$validation_config['required']
			&&
				( $data_value['selected'] === null || $data_value['selected'] === '' )
		) {
			return $this->get_validation_error(
				__( 'A value is required.', 'wp-eform' )
			);
		}

		// is invalid, if user selected other, but no other value
		if (
			$config['interface']['others'] === true
			&& $data_value['selected'] === $config['interface']['othersId']
			&& empty( $data_value['other'] )
			&& $validation_config['required']
		) {
			return $this->get_validation_error(
				__( 'Other value can not be empty.', 'wp-eform' )
			);
		}

		// everything checks out
		return $this->get_default_validation_status();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array                                                                                          $config Normalized configuration value.
	 * @param array{selected: string, other: string}                                                         $data_value Normalized data.value.
	 * @param array{option: string, row: string, range: string, entry: string, return: string, type: string} $using An associative array of using config.
	 * @param callable|null                                                                                  $mentions_callback Callback function for mentions.
	 *
	 * @return array|string Element's value.
	 */
	protected function simple_value( array $config, array $data_value, array $using, ?callable $mentions_callback = null ) {
		$selected_value = $data_value['selected'];
		// convert null to empty string
		if ( ! $selected_value ) {
			$selected_value = '';
		}
		$option = get_element_from_array_by_id(
			$config['interface']['options'],
			$selected_value
		);
		if ( ! $option ) {
			$selected_label = $selected_value === ''
				? ''
				: \__( 'Unknown option', 'wp-eform' );
		} else {
			$parsed_label = SlateJS::parseEditorChildrenJSON( $option['label'] );
			if ( \is_callable( $mentions_callback ) ) {
				$parsed_label->setRenderMentions(
					$this->get_mentions_callback_for_nested_items( $mentions_callback )
				);
			}
			$selected_label = $parsed_label->getText();
		}

		// if expecting JSON
		if ( $using['return'] === 'json' ) {
			return [
				'selected' => $using['type'] === 'id' ? $selected_value : $selected_label,
				'other' => \esc_html( $data_value['other'] ?? '' ),
			];
		}

		// expecting STRING
		$return = $using['type'] === 'id' ? $selected_value : $selected_label;
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
	 * @return array  Associative array with 'has', 'obtained' and 'outof',
	 *                each holding numeric value.
	 */
	public function get_data_score( array $config, array $data_value ) : array {
		// init score array
		$score_config = $config['score'];
		$score = $this->get_empty_score( $score_config );
		// calculate score based on config and data_value
		foreach ( $score_config['scoreConditions'] as $condition ) {
			$is_valid = false;
			$compare_with = $condition['compareWith'];

			// check the condition and based on that determine whether it is valid
			// for our data or not
			switch ( $condition['condition'] ) {
				case 'et':
					// would be valid if compare_with is the selected one
					if ( $compare_with === $data_value['selected'] ) {
						$is_valid = true;
					}
					break;
					// no other cases, because that's what the UI would suggest
			}

			$score = $this->update_score_with_condition(
				$score,
				$is_valid,
				$condition,
				false
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
		$output .= '<li>' . $values['selected'] . '</li>';
		$output .= '</ul>';

		if (
			$config['interface']['others'] === true
			&& $data_value['selected'] === $config['interface']['othersId']
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
			// compare against options list
			if ( \is_string( $metadata ) ) {
				$compare_values = \mb_strtolower( $metadata );
				foreach ( $config['interface']['options'] as $op ) {
					$op_value = SlateJS::parseEditorChildrenJSON( $op['label'] )->getText(
						'singleline',
						null,
						false
					);
					if ( $compare_values === \mb_strtolower( $op_value ) ) {
						$data['metaValue'] = $op['id'];
					}
				}
			}
		}

		return \json_encode( $data );
	}
}
