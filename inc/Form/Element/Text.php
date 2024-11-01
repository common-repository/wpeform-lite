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

use function WPEForm\Helpers\get_default_element_config_attributes;
use function WPEForm\Helpers\get_default_element_config_filters;
use function WPEForm\Helpers\get_default_element_config_masks;
use function WPEForm\Helpers\get_default_element_score;
use function WPEForm\Helpers\get_user_metavalue;
use function WPEForm\Helpers\validate_list_items_with_id_key;
use function WPEForm\Helpers\validate_score_condition_with_string;
use function WPEForm\Helpers\validate_string_with_filters;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Text Element class. Single Line Input.
 *
 * Gather one line input from users.
 */
class Text extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Single Line Input', 'wp-eform' ),
			'description' => __( 'Gather one line input from users.', 'wp-eform' ),
			'container' => false,
			'category' => 'input',
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
				'default' => __( 'Single Line Input element', 'wp-eform' ),
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
				'icon' => FieldVar::var( 'fas fa-pen-nib', Type::string() ),
				'placeholder' => FieldVar::var(
					__( 'write your answer here', 'wp-eform' ),
					Type::string()
				),
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
				'filters' => FieldVar::var(
					get_default_element_config_filters(),
					Registry::get( 'filters', 'type/form/element/config' ),
					Registry::get( 'filters', 'input/form/element/config' )
				),
				'masks' => FieldVar::var(
					get_default_element_config_masks(),
					Registry::get( 'masks', 'type/form/element/config' ),
					Registry::get( 'masks', 'input/form/element/config' )
				)->setValidator(
					function( $masks ) {
						return validate_list_items_with_id_key( $masks['maskRegExps'] );
					}
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
			'input' => FieldVar::var( '', Type::string() ),
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

		// is invalid if it is required, yet empty data
		if ( $validation_config['required'] && empty( $data_value['input'] ) ) {
			return $this->get_validation_error(
				__( 'A value is required.', 'wp-eform' )
			);
		}

		// If empty and not required, then no need to process
		if (
			! $validation_config['required']
			&& empty( $data_value['input'] )
		) {
			return $this->get_default_validation_status();
		}

		// is invalid if doesn't match with the filters
		// but do this, only if masks aren't activated
		if ( $validation_config['masks']['maskType'] === 'none' ) {
			$filter_validation = validate_string_with_filters(
				$data_value['input'],
				$validation_config['filters']
			);
			if ( $filter_validation !== null ) {
				return $this->get_validation_error( $filter_validation );
			}
		}

		// we don't explicitly check for masks, it is handled solely on the client-side
		// so at this point, everything should checkout
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
		$value = \esc_html( $data_value['input'] );
		if ( $using['return'] === 'string' ) {
			return $value;
		}
		return [
			'input' => $value,
		];
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
			$is_valid = validate_score_condition_with_string(
				$data_value['input'],
				$condition['condition'],
				$condition['compareWith']
			);

			$score = $this->update_score_with_condition(
				$score,
				$is_valid,
				$condition
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
		return '<div class="para">' . $this->get_simple_value(
			$config,
			$data_value,
			[
				'return' => 'string',
				'type' => 'label',
			],
			$mentions_callback
		) . '</div>';
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
			$metavalue = get_user_metavalue( $config['attributes']['prefilParameter'] );
			if ( ! empty( $metavalue ) ) {
				$data['metaValue'] = $metavalue;
			}
		}

		return \json_encode( $data );
	}
}
