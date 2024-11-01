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

use WPEForm\Handler\Submission;

use function WPEForm\Helpers\get_element_from_array_by_id;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Calculate conditionally hidden by parent variable pre-emptively.
 *
 * @package WPEForm\CoR\Submission
 */
class ConditionalsProcessor extends Base {
	/**
	 * {@inheritDoc}
	 */
	protected function process_entity( Submission $handler ): void {
		$this->reset_conditionally_hidden_by_parent( $handler );

		$form_data = $handler->get_form_data();

		$conditionally_hidden_by_parent = [];

		foreach ( $handler->elements()->get_raw_elements_data() as $submission_element ) {
			$element_id = $submission_element['id'];
			$form_element = get_element_from_array_by_id(
				$form_data['elements'],
				$element_id
			);

			// If form element itself is null or non-existent, then throw
			$this->throw_if_form_element_is_non_existent(
				$form_element,
				$submission_element
			);

			// Now if submission element is conditionally hidden, then add it and all
			// it's children
			if ( $submission_element['conditionallyHidden'] ) {
				$conditionally_hidden_by_parent = \array_merge(
					$conditionally_hidden_by_parent,
					$handler->elements()->recursively_extract_elements( $element_id )
				);
			}
		}

		$handler->conditionals()->set_conditionally_hidden_by_parent( $conditionally_hidden_by_parent );
	}

	/**
	 * Reset conditionally hidden by parent variable. Call this at the beginning
	 * of process elements.
	 *
	 * @param Submission $handler Entity.
	 *
	 * @return void
	 */
	protected function reset_conditionally_hidden_by_parent( Submission $handler ) {
		$handler->conditionals()->set_conditionally_hidden_by_parent( [] );
	}
}
