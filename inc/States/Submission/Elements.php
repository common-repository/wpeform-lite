<?php
/**
 * Copyright (C) 2022 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of WPEForm - WordPress Form Builder.
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
 * along with WPEForm - WordPress Form Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package WPEForm
 * @subpackage States\Submission
 */

namespace WPEForm\States\Submission;

use LogicException;
use WPEForm\Exception\SubmissionValidationException;
use WPEForm\Factory\Form\Elements as FormElements;
use WPEForm\Handler\Submission;
use WPEForm\Util\SlateJS;

use function WPEForm\Helpers\convert_list_to_dictionary;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Element related state and modifiers for the Submission Handler.
 *
 * @package WPEForm\States\Submission
 */
class Elements extends Base {
	/**
	 * Submission element data for this submission handler from the user input.
	 * This is not supposed to be processed.
	 *
	 * @var array
	 */
	private $raw_elements_data = null;

	/**
	 * Submission element data for this handler which is processed by the class.
	 *
	 * @var array
	 */
	private $processed_elements_data = null;

	/**
	 * Processed elements dictionary calculated from processed_elements_data.
	 *
	 * @var array
	 */
	private $processed_elements_dictionary = [];

	/**
	 * Elements dictionary as used from Form Model.
	 *
	 * @var array
	 */
	private $elements_config_dictionary = [];

	/**
	 * Create an element state instance.
	 *
	 * @param Submission $handler The submission handler.
	 * @param array      $elements_data Submission element data as found from user input
	 *                                  or database.
	 * @param bool       $processed     Whether the element data is processed or not.
	 * @return void
	 */
	public function __construct( Submission $handler, array $elements_data, bool $processed ) {
		parent::__construct( $handler );

		if ( ! $processed ) {
			$this->raw_elements_data = $elements_data;
		} else {
			$this->processed_elements_data = $elements_data;
			$this->processed_elements_dictionary = convert_list_to_dictionary(
				$elements_data
			);
		}

		// set the elements_config_dictionary
		$this->elements_config_dictionary = convert_list_to_dictionary(
			$this->submission_handler->get_form_model()->read()['elements']
		);
	}

	/**
	 * Processed elements dictionary calculated from processed_elements_data.
	 *
	 * @var array
	 */
	public function get_processed_elements_dictionary() : array {
		return $this->processed_elements_dictionary;
	}

	/**
	 * Element configuration by element ID.
	 *
	 * @return array
	 */
	public function get_elements_config_dictionary() : array {
		return $this->elements_config_dictionary;
	}

	/**
	 * Get element simple value by element Id.
	 *
	 * @param string $element_id The Id of the element.
	 * @param bool   $nested Whether this is nested. In that case, skip futher mentions render.
	 * @return string Simple Value.
	 */
	public function get_element_simple_value( string $element_id, bool $nested = false ) : string {
		// Now we might have an Element, so we need to extract value
		$element_data = $this->elements_config_dictionary[ $element_id ] ?? null;

		// If no element data found, then bail
		if ( ! $element_data ) {
			return '';
		}

		// get the submission data
		$element_submission_data =
			$this->processed_elements_dictionary[ $element_id ] ?? null;

		// If no element submission data, then bail
		if ( ! $element_submission_data ) {
			return '';
		}

		// if conditionally hidden, then bail
		if ( $element_submission_data['conditionallyHidden'] ) {
			return '';
		}

		$element_type = $element_data['type'];
		if ( ! FormElements::has_element( $element_type ) ) {
			// bail
			return '';
		}

		$element_instance = FormElements::get_element_instance( $element_type );

		return $element_instance->get_simple_value(
			$element_data['config'][ $element_type ],
			$element_submission_data['value'][ $element_type ],
			[
				'type' => 'label',
				'return' => 'string',
			],
			$nested ? null : $this->submission_handler->slate()->get_slatejs_mentions_callback()
		);
	}

	/**
	 * Get active structures of a form, given the form data and submission data.
	 *
	 * @return array Array of structures.
	 */
	public function get_active_structures() : array {
		$this->throw_if_elements_not_processed();

		$form_data = $this->submission_handler->get_form_model()->read();
		$structures = $form_data['structures'];

		return $structures;
	}

	/**
	 * Extract active elements from the form model and submission data for the
	 * given stricture id.
	 *
	 * @param string $structure_id Id of the stricture.
	 *
	 * @return array Array of elements, in original order.
	 */
	public function get_active_submission_elements_per_structure( string $structure_id ) : array {
		$this->throw_if_elements_not_processed();

		$elements = [];
		$form_data = $this->submission_handler->get_form_model()->read();
		$structures = $form_data['structures'];

		if ( empty( $structures ) ) {
			return $elements;
		}

		// Now get the structure
		$structure = null;
		foreach ( $structures as $st ) {
			if ( $st['id'] === $structure_id ) {
				$structure = $st;
				break;
			}
		}

		if ( empty( $structure ) ) {
			return $elements;
		}

		$children = $structure['children'];
		if ( empty( $children ) ) {
			return $elements;
		}

		foreach ( $children as $element_id ) {
			$active_submission_elements =
				$this->recursively_extract_active_submission_elements( $element_id );
			// we need to check this because it will fail in PHP 7.1 and 7.2
			if ( \count( $active_submission_elements ) ) {
				\array_push(
					$elements,
					...$active_submission_elements
				);
			}
		}

		return $elements;
	}

	/**
	 * Get processed elements data from the handler.
	 *
	 * @throws LogicException If data hasn't been processed yet.
	 *
	 * @return array
	 */
	public function get_processed_elements() : array {
		$this->throw_if_elements_not_processed();

		return $this->processed_elements_data;
	}

	/**
	 * Set processed elements. This method makes it possibles to config hooks to
	 * mutate data before it is being saved in the database. No checks are
	 * performed in the handler level. However, the controller will pass it to
	 * the model and the model will normalize and validate the data before saving.
	 * So make sure not to mess up with the data structure.
	 *
	 * @param array $elements Processed elements data.
	 *
	 * @return void
	 */
	public function set_processed_elements( array $elements ) : void {
		$this->processed_elements_data = $elements;
		$this->processed_elements_dictionary = convert_list_to_dictionary(
			$elements
		);
	}

	/**
	 * Get Raw elements data, as received from ctor.
	 *
	 * @return array
	 */
	public function get_raw_elements_data(): array {
		return $this->raw_elements_data;
	}

	/**
	 * Recursively extract elements from a single element by looping over it's
	 * children. It also adds the parent element to the list.
	 *
	 * It doesn't ignore any types of elements, including design, because they
	 * can also have conditionallyHidden state.
	 *
	 * @param string $element_id Id of the current element.
	 *
	 * @return array
	 */
	public function recursively_extract_elements( string $element_id ) : array {
		$all_elements = [];
		// if the element is a design element, then don't add it to the list
		$active_element = $this->elements_config_dictionary[ $element_id ];

		// bail early, if this element is not present in the registry anymore
		if ( ! FormElements::has_element( $active_element['type'] ) ) {
			return $all_elements;
		}
		$all_elements[] = $element_id;

		// now loop over children, if present and add them too
		if ( ! empty( $active_element['children'] ) ) {
			foreach ( $active_element['children'] as $child_element_id ) {
				$all_elements = \array_merge(
					$all_elements,
					$this->recursively_extract_elements( $child_element_id )
				);
			}
		}

		return $all_elements;
	}

	/**
	 * Get flattened active elements from form data. It starts with structure
	 * where elements are initiated and loops over all structure and all elements
	 * to get all set of active elements.
	 *
	 * It doesn't ignore any types of elements, including design, because they
	 * can also have conditionallyHidden state.
	 *
	 * @param array $form_data Form Data.
	 *
	 * @return array
	 */
	public function get_flattened_elements( array $form_data ) : array {
		$structures = $form_data['structures'];

		$flattened_elements = [];

		// foreach elements in structure, get the active elements
		foreach ( $structures as $structure ) {
			foreach ( $structure['children'] as $element_id ) {
				$flattened_elements = \array_merge(
					$flattened_elements,
					$this->recursively_extract_elements(
						$element_id
					)
				);
			}
		}

		return $flattened_elements;
	}

	// #region GateKeepers

	/**
	 * Throw a logic exception if elements data isn't processed yet.
	 *
	 * @throws LogicException If data hasn't been processed yet.
	 *
	 * @return void
	 */
	public function throw_if_elements_not_processed() : void {
		if ( $this->processed_elements_data === null ) {
			throw new LogicException(
				'Elements are not processed yet, please call process_elements.'
			);
		}
	}

	/**
	 * Throw a SubmissionValidationException if form element is null or the type
	 * isn't registered.
	 *
	 * @param array|null $form_element The form element.
	 * @param array      $submission_element The submission element accompanied.
	 *
	 * @throws SubmissionValidationException If form element is null or non-existent.
	 * @return void
	 */
	public function throw_if_form_element_is_non_existent( ?array $form_element, array $submission_element ) {
		if ( $form_element === null
			|| ! FormElements::has_element( $form_element['type'] )
		) {
			throw new SubmissionValidationException(
				SubmissionValidationException::getSlateJSON(
					'nonExistentElement',
					SlateJS::parseHTML(
						'<p>' .
							sprintf(
								/* translators: %1$s is element Id, handled client-side */
								__( 'Element <mentions character="%1$s"></mentions> is non existent.', 'wp-eform' ),
								$submission_element['id']
							) .
						'</p>'
					)->getEditorChildrenJSON(),
					null,
					null
				)
			);
		}
	}

	// #endregion

	// #region Helpers

	/**
	 * Recursively extract elements, if
	 * 1. Element is not conditionally hidden.
	 * 2. Element is not a design/security element.
	 *
	 * @param string $element_id Element Id to extract.
	 * @return array List of elements, in order.
	 */
	private function recursively_extract_active_submission_elements( string $element_id ) : array {
		$elements = [];

		// get config and submission from lookup
		$element_config = $this->elements_config_dictionary[ $element_id ] ?? null;
		$element_submission = $this->processed_elements_dictionary[ $element_id ] ?? null;

		// if element is not active, then bail
		if ( ! $element_config || ! $element_submission ) {
			return $elements;
		}

		// if element is conditionally hidden, then bail (also all child)
		if ( $element_submission['conditionallyHidden'] === true ) {
			return $elements;
		}

		// check the element type
		$element_type = $element_config['type'];
		if ( ! FormElements::has_element( $element_type ) ) {
			return $elements;
		}

		$element_instance = FormElements::get_element_instance( $element_type );

		// Now add this element, if it is of type choice or input
		if (
			\in_array(
				$element_instance->get_definition()['category'],
				[ 'choice', 'input' ]
			)
		) {
			$elements[] = $element_id;
		}

		// Now if the element has children, then process them too
		if (
			isset( $element_config['children'] ) &&
			! empty( $element_config['children'] )
		) {
			foreach ( $element_config['children'] as $child_element_id ) {
				$active_submission_elements =
					$this->recursively_extract_active_submission_elements( $child_element_id );
				// we need to check this because it will fail in PHP 7.1 and 7.2
				if ( \count( $active_submission_elements ) ) {
					\array_push(
						$elements,
						...$active_submission_elements
					);
				}
			}
		}

		return $elements;
	}

	// #endregion
}
