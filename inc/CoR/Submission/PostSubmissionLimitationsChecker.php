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

use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Handler\Submission;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\Exception\SubmissionValidationException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Check for any post submission limitations the form might have. It will
 * throw a GraphQL compatible error which should be picked up by the client.
 * See render method for SubmissionValidationException for more.
 *
 * @package WPEForm\CoR\Submission
 */
class PostSubmissionLimitationsChecker extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @throws SubmissionValidationException If there is any post submission limitations.
	 */
	protected function process_entity( Submission $handler ): void {
		$post_limitations = Permissions::get_postsubmission_limitations(
			$handler->get_form_model(),
			new FormAuth(),
			$handler
		);

		if ( ! empty( $post_limitations ) ) {
			throw new SubmissionValidationException(
				SubmissionValidationException::getSlateJSON(
					$post_limitations[0]['id'],
					$post_limitations[0]['message'],
					$post_limitations[0]['mentions'],
					$post_limitations[0]['dynamicAnchors']
				)
			);
		}
	}
}
