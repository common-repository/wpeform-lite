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
use function WPEForm\Helpers\get_default_element_score;
use function __;
use function WPEForm\Helpers\format_number;
use function WPEForm\Helpers\get_user_metavalue;
use function WPEForm\Helpers\validate_score_condition_with_float;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Slider Element class. Slider Element.
 *
 * Accept a numeric value between a range.
 */
class Slider extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Slider', 'wp-eform' ),
			'description' => __( 'Accept a numeric value between a range.', 'wp-eform' ),
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
				'default' => __( 'Slider element', 'wp-eform' ),
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
				'min' => FieldVar::var( 0.0, Type::float() ),
				'max' => FieldVar::var( 10.0, Type::float() ),
				'step' => FieldVar::var( 1.0, Type::float() ),
				'precision' => FieldVar::var( 2, Type::int() ),
				'showMarks' => FieldVar::var( true, Type::boolean() ),
				'customMarks' => FieldVar::var(
					[],
					Type::listOf(
						Type::nonNull( Registry::get( 'sliderMark', 'type/form/element/config' ) )
					),
					Type::listOf(
						Type::nonNull( Registry::get( 'sliderMark', 'input/form/element/config' ) )
					)
				),
				'showFreeInput' => FieldVar::var( false, Type::boolean() ),
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
			),
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
				0.0,
				Type::float()
			),
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
		$selected_value = $data_value['selected'];
		$min_value = $config['interface']['min'];
		$max_value = $config['interface']['max'];
		if ( $selected_value < $min_value ) {
			return $this->get_validation_error(
				__( 'Entered value is lower than minimum.', 'wp-eform' )
			);
		}
		if ( $selected_value > $max_value ) {
			return $this->get_validation_error(
				__( 'Entered value is greater than maximum.', 'wp-eform' )
			);
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
		$selected_value = $data_value['selected'];

		// if expecting JSON
		if ( $using['return'] === 'json' ) {
			return [
				'selected' => $selected_value,
			];
		}

		// expecting STRING
		// we don't do format_number because we want the numbers to be parsable
		return (string) $selected_value;
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
			// figure out whether score condition is valid or not
			$is_valid = validate_score_condition_with_float(
				\floatval( $data_value['selected'] ),
				$condition['condition'],
				\floatval( $condition['compareWith'] )
			);
			// add it to the score
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
		$value = $data_value['selected'] ?? 0;
		return format_number( $value, $config['interface']['precision'] );
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
			$metadata = get_user_metavalue(
				$config['attributes']['prefilParameter']
			);
			if ( \is_string( $metadata ) ) {
				$data['metaValue'] = \floatval( $metadata );
			}
		}

		return \json_encode( $data );
	}
}
