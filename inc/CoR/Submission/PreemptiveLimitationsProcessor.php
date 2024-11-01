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

use WPEForm\Auth\Form as FormAuth;
use WPEForm\Exception\SubmissionValidationException;
use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Handler\Submission;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Check for any pre-emptive limitations the form might have. It simply throws a GraphQL compatible error to be shown to the user.
 *
 * @package WPEForm\CoR\Submission
 */
class PreemptiveLimitationsProcessor extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @throws SubmissionValidationException
	 */
	protected function process_entity( Submission $handler ): void {
		// Check for pre-emptive limitations
		$pre_emptive_limitations = Permissions::get_preemptive_limitations(
			$handler->get_form_model(),
			new FormAuth()
		);

		if ( ! empty( $pre_emptive_limitations ) ) {
			throw new SubmissionValidationException(
				SubmissionValidationException::getSlateJSON(
					$pre_emptive_limitations[0]['id'],
					$pre_emptive_limitations[0]['message'],
					$pre_emptive_limitations[0]['mentions'],
					$pre_emptive_limitations[0]['dynamicAnchors']
				)
			);
		}
	}
}
