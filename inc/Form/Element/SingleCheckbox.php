<?php
/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of WPEForm - WordPress Builder.
 *
 * WPEForm - WordPress Form Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * WPEForm - WordPress Form Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPEForm - WordPress Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package WPEForm
 * @subpackage Element
 * @author Swashata Ghosh <swashata@wpquark.com>
 */

namespace WPEForm\Form\Element;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\Util\Icon;

use function WPEForm\Helpers\get_default_element_config_attributes;
use function WPEForm\Helpers\get_default_element_score;
use function WPEForm\Helpers\get_user_metavalue;
use function WPEForm\Helpers\validate_score_condition_with_boolean;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * SingleCheckbox Element class. Single Checkbox.
 *
 * A single checkbox element for yes/no type questions.
 */
class SingleCheckbox extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Single Checkbox', 'wp-eform' ),
			'description' => __( 'A single checkbox element for yes/no type questions.', 'wp-eform' ),
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
				'default' => __( 'Single Checkbox element', 'wp-eform' ),
			],
			'subtitle' => [
				'uses' => false,
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
			'selected' => FieldVar::var( false, Type::boolean() ),
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
		if (
			$validation_config['required'] &&
			$data_value['selected'] === false
		) {
			return $this->get_validation_error(
				__( 'The element is required.', 'wp-eform' )
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
		$selected_label = $selected_value
			? \__( 'Yes', 'wp-eform' )
			: \__( 'No', 'wp-eform' );

		// if expecting JSON
		if ( $using['return'] === 'json' ) {
			return [
				'selected' => $using['type'] === 'id' ? $selected_value : $selected_label,
			];
		}

		// expecting STRING
		return $selected_label;
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
			$is_valid = validate_score_condition_with_boolean(
				$data_value['selected'],
				$condition['condition'],
				$condition['compareWith'] === 'true'
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
		$values = $this->simple_value(
			$config,
			$data_value,
			[
				'return' => 'json',
				'type' => 'id',
			],
			$mentions_callback
		);
		$icon = new Icon( $purpose === 'email' ? 'network' : 'path' );
		$label = $values['selected']
			? \__( 'Yes.', 'wp-eform' )
			: \__( 'No.', 'wp-eform' );
		$icon_to_print = $values['selected']
			? $icon->checkboxChecked()
			: $icon->checkboxUnchecked();

		return '<p>'
			. $icon_to_print
			. $label
			. '</p>';
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
				if ( $metadata === 'true' ) {
					$data['metaValue'] = true;
				} elseif ( $metadata === 'false' ) {
					$data['metaValue'] = false;
				}
			}
		}

		return \json_encode( $data );
	}
}
