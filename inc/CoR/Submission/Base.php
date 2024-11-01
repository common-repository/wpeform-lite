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

use WPEForm\CoR\AbstractMiddleware;
use WPEForm\Exception\SubmissionValidationException;
use WPEForm\Factory\Form\Elements;
use WPEForm\Handler\Submission;
use WPEForm\Util\SlateJS;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Base class for all Submission CoR processors.
 *
 * @package WPEForm\CoR\Submission
 */
abstract class Base extends AbstractMiddleware {
	/**
	 * @var Base
	 */
	protected $next;

	/**
	 * Process the entity with the current CoR instance and pass it to the next one.
	 *
	 * @param Submission $handler Entity.
	 *
	 * @return void
	 */
	public function process( Submission $handler ): void {
		$this->process_entity( $handler );

		if ( ! $this->next ) {
			return;
		}

		$this->next->process( $handler );
	}

	/**
	 * Process the entity for the current CoR instance only.
	 *
	 * @param Submission $handler Entity instance.
	 *
	 * @return void
	 */
	abstract protected function process_entity( Submission $handler): void;

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
	protected function throw_if_form_element_is_non_existent( ?array $form_element, array $submission_element ) {
		if ( $form_element === null
			|| ! Elements::has_element( $form_element['type'] )
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
}
