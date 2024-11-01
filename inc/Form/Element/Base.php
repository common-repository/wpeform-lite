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

use WPEForm\Exception\ValidationException;
use WPEForm\GraphQL\Util\FieldVar;

use function WPEForm\Helpers\get_element_from_array_by_id;
use function WPEForm\Helpers\parse_args;
use WPEForm\Factory\Form\Elements;
use WPEForm\Util\SlateJS;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Abstract Element class that everything else should override
 *
 * It has getters and setters which helps in quickly adding config and data
 */
abstract class Base implements IElement {
	/**
	 * One time created array of FieldVars for Config. Used internally.
	 *
	 * @var array
	 */
	protected $config_vars = null;

	/**
	 * One time created array of FieldVars for data['value']. Used internally.
	 *
	 * @var array
	 */
	protected $data_value_vars = null;

	/**
	 * Generic config vars which is used across all child classes.
	 *
	 * @var array
	 */
	protected $generic_config_vars = null;

	/**
	 * Get list of only accepted children types for this element. Works only
	 * for containers. If returned an empty array, then all types of children are
	 * accepted.
	 *
	 * @return array
	 */
	public function get_accepted_children_types() : array {
		return [];
	}

	/**
	 * Get list of unaccepted children types for this element. Works only for
	 * containers. If returned an empty array, then no types are unacceptable.
	 *
	 * @return array
	 */
	public function get_unaccepted_children_types() : array {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws ValidationException If one element in one of the following
	 * conditions.
	 * 1. children doesn't exist.
	 * 2. Children type is not in accepted list.
	 * 3. Children type is in unaccepted list.
	 *
	 * @param string $id ID of the Element.
	 * @param array  $children Children of this element.
	 * @param array  $elements All other elements in the form. Use it to look up
	 *                         information of other elements.
	 *
	 * @return void
	 */
	public function validate_children( string $id, array $children, array $elements ): void {
		// get accepted and unaccepted children types for this
		// both can also be present, first system will check for accepted and
		// will check for unaccepted.
		$accepted_children_types = $this->get_accepted_children_types();
		$unaccepted_children_types = $this->get_unaccepted_children_types();
		// check that all children actually exists, otherwise throw error
		foreach ( $children as $element_id ) {
			$element = get_element_from_array_by_id( $elements, $element_id );
			if ( $element === null ) {
				throw new ValidationException( "Element {$element_id} does not exist." );
			}
			// check for accepted and unaccepted types
			$type = $element['type'];
			if (
				! empty( $accepted_children_types )
				&& ! \in_array( $type, $accepted_children_types )
			) {
				throw new ValidationException( "Element {$id} can not accept child {$element_id} which is of type {$type}." );
			}
			if (
				! empty( $unaccepted_children_types )
				&& \in_array( $type, $unaccepted_children_types )
			) {
				throw new ValidationException( "Element {$id} can not accept child {$element_id} which is of type {$type}." );
			}
		}
	}

	/**
	 * {@inheritDoc}
	 *
	 * The default is an empty array `[]`, which means all of the items from
	 * appearance are required.
	 *
	 * @return array
	 */
	public function get_generic_appearance_structure() : array {
		return [];
	}

	/**
	 * Get configuration variable with co-located default value, type and input.
	 *
	 * This is used internally to generated GraphQL Type and Input on the fly.
	 *
	 * @return array
	 */
	abstract protected function config_vars() : array;

	/**
	 * {@inheritDoc}
	 *
	 * @throws \LogicException If FieldVar isn't an array.
	 * @return array
	 */
	final public function get_config_vars() : array {
		if ( null === $this->config_vars ) {
			$this->config_vars = $this->config_vars();
		}
		if ( ! is_array( $this->config_vars ) ) {
			throw new \LogicException( 'Config Vars has to be an array of FieldVars. Check config_vars implementation.' );
		}
		return $this->config_vars;
	}

	/**
	 * {@inheritDoc}
	 */
	final public function get_default_config() : array {
		return FieldVar::extract(
			$this->get_config_vars(),
			'default'
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	final public function get_default_appearance() : array {
		$appearance_structure = $this->get_generic_appearance_structure();
		// get the default one from factory
		$appearance = Elements::get_element_generic_appearance_default();
		$default_appearance = [];
		foreach ( $appearance as $key => $value ) {
			// if the key is in the structure, then make it explicit
			if ( isset( $appearance_structure[ $key ] ) ) {
				if ( $appearance_structure[ $key ]['uses'] ) {
					// the element explicitly uses it, so either extract the value if present
					// or use the value from the factory
					$default_appearance[ $key ] = $appearance_structure[ $key ]['default'] ?? $value;
				} else {
					// the element doesn't use it, so null it out
					$default_appearance[ $key ] = null;
				}
			} else {
				// we implicitly make use of the key
				$default_appearance[ $key ] = $value;
			}
		}
		// but cannot override columnSize, widths and initiallyHidden
		$default_appearance['columnSize'] = $default_appearance['columnSize']
			?? $appearance['columnSize'];
		$default_appearance['widths'] = $appearance['widths'];
		$default_appearance['initiallyHidden'] = $appearance['initiallyHidden'];
		return $default_appearance;
	}

	/**
	 * Get data variable with co-located default value, type and input.
	 *
	 * This is used internally to generated GraphQL Type and Input on the fly.
	 *
	 * @return array
	 */
	abstract protected function data_value_vars() : array;

	/**
	 * Get cached version of data value vars. It creates the data value var only
	 * once and stores the result in the protected property.
	 *
	 * @throws \LogicException If FieldVar isn't an array.
	 * @return array
	 */
	final public function get_data_value_vars() : array {
		if ( null === $this->data_value_vars ) {
			$this->data_value_vars = $this->data_value_vars();
		}

		if ( ! is_array( $this->data_value_vars ) ) {
			throw new \LogicException( 'FieldVar has to be an array. Check data_value_vars implementation.' );
		}

		return $this->data_value_vars;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	final public function get_default_data_value() : array {
		return FieldVar::extract(
			$this->get_data_value_vars(),
			'default'
		);
	}

	/**
	 * A helper function get individual score associative array.
	 *
	 * @return array
	 */
	protected function get_score_template() : array {
		return [
			'has' => false,
			'obtained' => 0,
			'outof' => 0,
		];
	}

	/**
	 * Get empty score array with all "Not Needed" value.
	 *
	 * This makes sure that for given scoreConditions, we actually have all of
	 * the scoreIds in the resulting array.
	 *
	 * @param array $score_config As stored in element config.
	 *
	 * @return array
	 */
	protected function get_empty_score( array $score_config ) : array {
		$score = [];
		// calculate score based on config and data_value
		foreach ( $score_config['scoreConditions'] as $score_condition ) {
			$score_id = $score_condition['scoreId'];
			$score[ $score_id ] = $this->get_score_template();
		}

		return $score;
	}

	/**
	 * A helper function to get the default data score.
	 *
	 * @return array
	 */
	protected function get_default_data_score() : array {
		return [
			'default-score' => $this->get_score_template(),
		];
	}

	/**
	 * A helper function to get default validation status.
	 *
	 * @return array
	 */
	final public function get_default_validation_status() : array {
		return [
			'success' => true,
			'message' => '',
		];
	}

	/**
	 * Get validation error array with provided message.
	 *
	 * @param string $msg Validation error message.
	 *
	 * @return array
	 */
	final protected function get_validation_error( string $msg ) : array {
		$status = $this->get_default_validation_status();
		$status['success'] = false;
		$status['message'] = $msg;
		return $status;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param null|array $config Config from user-input or db.
	 *
	 * @return array
	 */
	public function get_normalized_config( ?array $config ) : array {
		// If this is null, then just return the default
		if ( $config === null ) {
			return $this->get_default_config();
		}
		return parse_args(
			$config,
			$this->get_default_config(),
			true
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array|null $data_value Stored/User input data.value.
	 *
	 * @return array
	 */
	public function get_normalized_data_value( ?array $data_value ) : array {
		if ( $data_value === null ) {
			return $this->get_default_data_value();
		}
		return parse_args(
			$data_value,
			$this->get_default_data_value(),
			true
		);
	}

	/**
	 * Get normalized appearance value for this element.
	 *
	 * @param null|array $appearance Possible appearance.
	 * @return array Noramlized appearance.
	 */
	public function get_normalized_appearance( ?array $appearance ) : array {
		if ( $appearance === null ) {
			return $this->get_default_appearance();
		}

		return parse_args(
			$appearance,
			$this->get_default_appearance(),
			true
		);
	}

	/**
	 * Update score dictionary with the new condition which has been calculated.
	 *
	 * This automatically checkx for `$condition['operation']` so don't do that on
	 * your end.
	 *
	 * @param array $score Original score dictionary.
	 * @param bool  $is_valid Whether condition has been evaluated valid or not.
	 * @param array $condition Condition as stored in Element config.
	 * @param bool  $add_to_outof Whether to add outof value to calculate max or have just the max one.
	 *
	 * @return array
	 */
	protected function update_score_with_condition( array $score, bool $is_valid, array $condition, bool $add_to_outof = true ) : array {
		// make sure score has
		$id = $condition['scoreId'];

		$score[ $id ]['has'] = true;
		// if score operation is add, then add to the outof
		if ( $condition['scoreOperation'] === 'add' ) {
			if ( $add_to_outof ) {
				$score[ $id ]['outof'] += $condition['scoreValue'];
			} else {
				$score[ $id ]['outof'] = \max( $score[ $id ]['outof'], $condition['scoreValue'] );
			}
		}

		// if operation is isnot, then flip
		if ( $condition['operation'] === 'isnot' ) {
			$is_valid = ! $is_valid;
		}

		// now if condition is valid, then actually do the scoreOperation
		if ( $is_valid ) {
			if ( $condition['scoreOperation'] === 'add' ) {
				$score[ $id ]['obtained'] += $condition['scoreValue'];
			} else {
				$score[ $id ]['obtained'] -= $condition['scoreValue'];
			}
		}

		return $score;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array|null $config Element config as stored in config.
	 *
	 * @return string|null
	 */
	public function get_extra_type_data( ?array $config ) : ?string {
		return null;
	}

	/**
	 * Normalize the `$using` parameter of `get_simple_value` function.
	 *
	 * @param array{option: string, row: string, range: string, entry: string, return: string, type: string, other: bool} $using As passed to the caller.
	 * @return array Normalized value.
	 */
	protected function normalize_simple_value_using( array $using ) : array {
		return parse_args(
			$using,
			[
				'option' => ', ',
				'row' => ' | ',
				'range' => '-',
				'entry' => '; ',
				'rowLabel' => ': ',
				'return' => 'string', // or 'json'
				'type' => 'label', // or 'id'
				'other' => false,
			]
		);
	}

	/**
	 * Get normalized and stringified value, for direct use with other tools
	 * like, CSV generation, printing etc.
	 *
	 * The first element passed, must be `$form_element['config']` and not the
	 * `$form_element` itself.
	 * The second argument passed, must be `$submission_data['value']` and not
	 * `$submission_data` itself.
	 *
	 * @param array                                                                                                       $config Normalized configuration value.
	 * @param array                                                                                                       $data_value Normalized data.value.
	 * @param array{option: string, row: string, range: string, entry: string, return: string, type: string, other: bool} $using An associative array of using config.
	 * @param callable|null                                                                                               $mentions_callback Callback function for mentions.
	 *
	 * @return array|string Element's value.
	 */
	public function get_simple_value( array $config, array $data_value, array $using, ?callable $mentions_callback = null ) {
		$using = $this->normalize_simple_value_using( $using );
		$data_value = $this->get_normalized_data_value( $data_value );
		$config = $this->get_normalized_config( $config );
		return $this->simple_value( $config, $data_value, $using, $mentions_callback );
	}

	/**
	 * Get normalized and stringified value, for direct use with other tools
	 * like, CSV generation, printing etc.
	 *
	 * All child classes should implement this. The base class makes sure, the
	 * config, data_value and using are normalized.
	 *
	 * @param array                                                                                                       $config Normalized configuration value.
	 * @param array                                                                                                       $data_value Normalized data.value.
	 * @param array{option: string, row: string, range: string, entry: string, return: string, type: string, other: bool} $using An associative array of using config.
	 * @param callable|null                                                                                               $mentions_callback Callback function for mentions.
	 *
	 * @return array|string Element's value.
	 */
	protected function simple_value( array $config, array $data_value, array $using, ?callable $mentions_callback = null ) {
		return '';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array         $appearance Appearance data of the element.
	 * @param array         $config Normalized config of the element.
	 * @param array         $data_value Normalized data value of the element.
	 * @param null|callable $mentions_callabck Mentions callback for SlateJS renderer.
	 * @param string        $purpose Purpose of the HTML. Could be 'email' or 'pdf'.
	 * @return string HTML output.
	 */
	public function get_html_value( array $appearance, array $config, array $data_value, ?callable $mentions_callabck, string $purpose = 'email' ): string {
		$appearance = $this->get_normalized_appearance( $appearance );
		$data_value = $this->get_normalized_data_value( $data_value );
		$config = $this->get_normalized_config( $config );

		$value_output = $this->html_value(
			$config,
			$data_value,
			$mentions_callabck,
			$purpose
		);

		if ( empty( $value_output ) ) {
			return '';
		}

		$title = SlateJS::parseEditorChildrenJSON(
			$appearance['title'] ?? \__( 'Anonymous Question', 'wp-eform' )
		)
			->setRenderMentions( $mentions_callabck )
			->getHTML( 'singleline' );
		$subtitle = SlateJS::parseEditorChildrenJSON(
			$appearance['subtitle'] ?? ''
		)
			->setRenderMentions( $mentions_callabck )
			->getHTML( 'singleline' );

		$answer_description = SlateJS::parseEditorChildrenJSON(
			$appearance['answerDescription'] ?? ''
		)
			->setRenderMentions( $mentions_callabck )
			->getHTML();

		$output = '<h3 class="answer-title">' . $title . '</h3>';

		if ( ! empty( $subtitle ) ) {
			$output .= '<h5 class="answer-subtitle">' . $subtitle . '</h5>';
		}

		// $output .= '<table class="answer" border="0" cellspacing="0" cellpadding="0" role="presentation">'
		// . '<tbody><tr><td>' . $value_output . '</td></tr></tbody></table>';
		$output .= '<div class="answer">'
		. $value_output . '</div>';

		if ( ! empty( $answer_description ) ) {
			$output .= '<table class="hint" border="0" cellspacing="0" cellpadding="0" role="presentation">'
				. '<tr><td>' . $answer_description . '</td></tr></table>';
			// $output .= '<table class="hint" border="0" cellspacing="0" cellpadding="0" role="presentation">'
			// . '<tr><td>' . $answer_description . '</td></tr></table>';
		}

		return $output;
	}

	/**
	 * Get just the value, without worrying about title, subtitle, description
	 * and answer description.
	 *
	 * Child class should override it. If not, then get_email_html_value would
	 * return empty string.
	 *
	 * @override
	 *
	 * @param array         $config Normalized config of the element.
	 * @param array         $data_value Normalized data value of the element.
	 * @param null|callable $mentions_callback Mentions callback for SlateJS renderer.
	 * @param string        $purpose Purpose of the HTML. Could be 'email' or 'pdf'.
	 * @return string HTML output.
	 */
	protected function html_value( array $config, array $data_value, ?callable $mentions_callback, string $purpose = 'email' ) : string {
		return '';
	}

	/**
	 * Given a mentions callback, get another callback which would handle nested
	 * mentions. Basically to avoid circular dependency and thereby infinite loop
	 * for the nested callback, it would simply bypass all mentions within a
	 * mention.
	 *
	 * @param callable $callback The original mentions callback.
	 * @return callable A curried callback with the feature.
	 */
	public function get_mentions_callback_for_nested_items( callable $callback ) : callable {
		return function( $id ) use ( $callback ) {
			return \call_user_func( $callback, $id, true );
		};
	}
}
