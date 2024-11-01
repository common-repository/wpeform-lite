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
 * @subpackage CoR\Submission
 */

namespace WPEForm\CoR\Submission;

use WPEForm\States\Submission\Score;
use WPEForm\Exception\SubmissionValidationException;
use WPEForm\Factory\Form\Elements;
use WPEForm\Handler\Submission;
use WPEForm\Util\SlateJS;

use function WPEForm\Helpers\convert_dictionary_to_list;
use function WPEForm\Helpers\extract_ids;
use function WPEForm\Helpers\get_element_from_array_by_id;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Process elements of a submission taking into consideration the form itself.
 *
 * @package WPEForm\CoR\Submission
 */
class ElementsProcessor extends Base {

	/**
	 * {@inheritDoc}
	 *
	 * @throws SubmissionValidationException If element is invalid or validation logic fails.
	 */
	protected function process_entity( Submission $handler ): void {
		$handler->score()->reset_score();

		$form_data = $handler->get_form_data();

		$handler->conditionals()->calculate_conditionally_hidden_by_parent( $form_data );

		// get all scores from config
		$all_scores = $form_data['settings']['score']['scoreLists'];

		// primary score Id is fixed
		$primary_score_id = \WPEForm\Form\Config\Settings\Score::PRIMARY_SCORE_ID;

		$has_score = false;
		$score_obtained = 0;
		$max_score = 0;
		$scores_data = [];

		if ( ! empty( $all_scores ) ) {
			// we assume that primary score id is in the list, but if it is not,
			// then the check later on, doesn't add to any thing.
			foreach ( $all_scores as $score_dt ) {
				$scores_data[ $score_dt['id'] ] = Score::get_empty_score_data(
					$score_dt['id']
				);
			}
		}

		$processed_elements = [];
		$active_elements = $handler->elements()->get_flattened_elements( $form_data );

		// 1. Loop through all elements and
		foreach ( $handler->elements()->get_raw_elements_data() as $submission_element ) {
			// 1.a Get the corresponding form element
			$form_element = get_element_from_array_by_id(
				$form_data['elements'],
				$submission_element['id']
			);
			// 1.b Check if element is valid and present in the form
			$handler->elements()->throw_if_form_element_is_non_existent(
				$form_element,
				$submission_element
			);

			// check if the element id is in active set of elements
			// now some element from active set could be absent because it
			// could be conditionally hidden, but an element in submission can not
			// be outside active elements
			if ( ! \in_array( $submission_element['id'], $active_elements ) ) {
				throw new SubmissionValidationException(
					SubmissionValidationException::getSlateJSON(
						'nonActiveElement',
						SlateJS::parseHTML(
							'<p>' .
								sprintf(
									/* translators: %1$s is element Id, handled client-side */
									__( 'Element <mentions character="%1$s"></mentions> is not active.', 'wp-eform' ),
									$submission_element['id']
								) .
							'</p>'
						)->getEditorChildrenJSON(),
						null,
						null
					)
				);
			}

			// initialize what the processed element would like
			$processed_element = [
				'id' => $submission_element['id'],
				// Processed value will be the union dictionary of all registered
				// element, but only this element's type would hold the actual data
				'value' => Elements::get_element_data_value_structure_with_default(
					$form_element['type']
				),
				// initiate with empty scores data
				'scores' => [],
				'conditionallyHidden' => $submission_element['conditionallyHidden'],
			];

			// check if the element is conditionally hidden. If so, then don't do
			// validation, reset score and value,
			if (
				$submission_element['conditionallyHidden']
				|| $handler->conditionals()->is_element_conditionally_hidden_by_parent( $submission_element['id'] )
			) {
				$processed_elements[] = $processed_element;
				// bail from this element
				continue;
			}

			// If the submission element doesn't really need to have a value
			if ( ! \in_array(
				$form_element['type'],
				\array_keys( $processed_element['value'] )
			) ) {
				// Then jut store the empty value and proceed
				$processed_elements[] = $processed_element;
				continue;
			}

			// extract the Element Config and Submission Value
			// we have to extract them from the unified interface because the Element
			// class does not expect it with the following structure
			// $config = [
			// 'checkbox' => [...],
			// 'radio' => [...],
			// ];
			// etc. It expects the config and submission value directly as per with
			// config_vars and data_value_vars. How we have actually got it from
			// GraphQL and/or Model, is irrelevant to the Element class.
			$element_config = $form_element['config'][ $form_element['type'] ];
			$submission_value = $submission_element['value'][ $form_element['type'] ] ?? null;

			// if submission value is null, then it's an error, because element is
			// not conditionally hidden
			if ( $submission_value === null ) {
				throw new SubmissionValidationException(
					SubmissionValidationException::getSlateJSON(
						'nullSubmissionValue',
						SlateJS::parseHTML(
							'<p>' .
								sprintf(
									/* translators: %1$s is element Id, handled client-side */
									__( 'Value cannot be null for element <mentions character="%1$s"></mentions>.', 'wp-eform' ),
									$submission_element['id']
								) .
							'</p>'
						)->getEditorChildrenJSON(),
						null,
						null
					)
				);
			}

			// get an element instance for further dealings
			$element = Elements::get_element_instance( $form_element['type'] );

			// Normalize the submission value
			$submission_value = $element->get_normalized_data_value( $submission_value );

			// 1.c Check with element class for validation
			$validation_status = $element->get_validation_status(
				$element_config,
				$submission_value
			);
			if ( ! $validation_status['success'] ) {
				// if we have timer on, then we just ditch the value of invalid elements
				// and move on
				if ( $handler->clock()->get_timer() ) {
					$processed_elements[] = $processed_element;
					continue;
				}
				throw new SubmissionValidationException(
					SubmissionValidationException::getSlateJSON(
						'invalidSubmissionValue',
						SlateJS::parseHTML(
							'<p>' .
								sprintf(
									/* translators: %1$s is element Id, handled client-side */
									__( 'Invalid value for element <mentions character="%1$s"></mentions>.', 'wp-eform' ),
									$submission_element['id']
								) .
							'</p>' .
							'<p>' .
								$validation_status['message'] .
							'</p>'
						)->getEditorChildrenJSON(),
						null,
						null
					)
				);
			}

			// Form element okay and validated, now calculate score and proceed
			// with normalization and storage.
			// we need to pass the exact config and data the Element expects
			// although we store it in the form $config['type'], we can not pass it
			// that way, because get_data_score expects it like this
			$element_score_data = $element->get_data_score(
				$element_config,
				$submission_value
			);

			// add and get to the score, if primary score Id is present
			if (
				$primary_score_id !== null
				&& isset( $element_score_data[ $primary_score_id ] )
				&& isset( $scores_data[ $primary_score_id ] )
			) {
				$primary_score = $element_score_data[ $primary_score_id ];
				if ( $primary_score['has'] ) {
					$has_score = true;
					$score_obtained += $primary_score['obtained'];
					$max_score += $primary_score['outof'];
				}
			}

			// Add it to the cumulative score
			foreach ( $element_score_data as $score_id => $score_val ) {
				if ( isset( $scores_data[ $score_id ] ) && $score_val['has'] ) {
					$scores_data[ $score_id ]['has'] = true;
					$scores_data[ $score_id ]['obtained'] += $score_val['obtained'];
					$scores_data[ $score_id ]['outof'] += $score_val['outof'];
				}
			}

			// add the already normalized value to the processed element
			$processed_element['value'][ $form_element['type'] ] = $submission_value;

			// we have to transform the dictionary type of $score_data to indexed
			// array
			$processed_element['scores'] = convert_dictionary_to_list(
				$element_score_data,
				'scoreId'
			);

			$processed_elements[] = $processed_element;
		}

		// Now check if some required element isn't present in the query
		// extract all of the ids from processed elements
		$processed_ids = extract_ids( $processed_elements );

		// now loop over all possible elements we have already extracted
		// and make sure that, if this is in the processed ids
		foreach ( $active_elements as $active_element_id ) {
			if ( ! \in_array( $active_element_id, $processed_ids ) ) {
				throw new SubmissionValidationException(
					SubmissionValidationException::getSlateJSON(
						'elementNotFound',
						SlateJS::parseHTML(
							'<p>' .
								sprintf(
									/* translators: %1$s is element Id, handled client-side */
									__( 'Element <mentions character="%1$s"></mentions> is not found in data.', 'wp-eform' ),
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

		// All set, now override the internal data.
		$handler->score()->set_score(
			$has_score,
			$score_obtained,
			$max_score,
			$scores_data
		);

		$handler->elements()->set_processed_elements( $processed_elements );
	}
}
