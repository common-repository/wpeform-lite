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

use function WPEForm\Helpers\get_element_from_array_by_id;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Conditionals related state for a submission handler.
 *
 * @package WPEForm\States\Submission
 */
class Conditionals extends Base {
	/**
	 * A variable to hold children of all conditionally hidden parents. We use
	 * this to bypass and reset values of all children of elements which are
	 * conditionally hidden.
	 *
	 * @var array
	 */
	private $conditionally_hidden_by_parent = [];

	/**
	 * Set conditionally hidden by parent data.
	 *
	 * @param array $data Data.
	 *
	 * @return void
	 */
	public function set_conditionally_hidden_by_parent( array $data ) {
		$this->conditionally_hidden_by_parent = $data;
	}

	/**
	 * Calculate conditionally hidden by parent variable pre-emptively.
	 *
	 * @param array $form_data Form data as read from model.
	 *
	 * @return void
	 */
	public function calculate_conditionally_hidden_by_parent( array $form_data ) {
		$this->set_conditionally_hidden_by_parent( [] );

		foreach ( $this->submission_handler->elements()->get_raw_elements_data() as $submission_element ) {
			$element_id = $submission_element['id'];
			$form_element = get_element_from_array_by_id(
				$form_data['elements'],
				$element_id
			);

			// If form element itself is null or non-existent, then throw
			$this->submission_handler->elements()->throw_if_form_element_is_non_existent(
				$form_element,
				$submission_element
			);

			// Now if submission element is conditionally hidden, then add it and all
			// it's children
			if ( $submission_element['conditionallyHidden'] ) {
				$this->conditionally_hidden_by_parent = \array_merge(
					$this->conditionally_hidden_by_parent,
					$this->submission_handler->elements()->recursively_extract_elements( $element_id )
				);
			}
		}
	}

	/**
	 * Check whether an element is conditionally hidden by parent. It assumes
	 * that the conditionally_hidden_by_parent has been calculated.
	 *
	 * @param string $element_id Element Id.
	 *
	 * @return bool
	 */
	public function is_element_conditionally_hidden_by_parent( string $element_id ) : bool {
		return \in_array( $element_id, $this->conditionally_hidden_by_parent, true );
	}
}
