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
 * @subpackage Helpers\Submission
 */

namespace WPEForm\States\Submission;

use WPEForm\Handler\Submission;
use WPEForm\Util\Pdf as PdfUtil;
use WPEForm\Util\Style;

use function WPEForm\Helpers\break_strings_with;
use function WPEForm\Helpers\format_datetime;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A helper class for the SubmissionHandler to deal with PDF.
 */
class Pdf {
	/**
	 * @var Submission
	 */
	private $submission_handler;

	/**
	 * Create a PDF builder instance.
	 *
	 * @param Submission $submission_handler The submission handler.
	 */
	public function __construct( Submission $submission_handler ) {
		$this->submission_handler = $submission_handler;
	}

	/**
	 * Get a safe PDF name.
	 *
	 * @return string
	 */
	public function get_pdf_name() : string {
		$date = \gmdate( 'y-m-d', \strtotime( $this->submission_handler->clock()->get_date() ) );

		return 'submission-'
			. $date
			. '-'
			. \mb_strimwidth( $this->submission_handler->get_token(), 0, 8 )
			. '.pdf';
	}

	/**
	 * Get a PDF instance to render the summary of the submission.
	 *
	 * @param bool $is_admin Whether or not the request is made by an admin.
	 * @return Pdf
	 */
	public function get_summary_pdf( bool $is_admin ) : PdfUtil {
		$style = new Style( $this->submission_handler->mailer()->get_user_email_config()['style_id'] );

		$submission_link = $this->submission_handler->get_submission_link();

		// attributes
		$attrs = $this->submission_handler->mailer()->get_email_attributes( true );

		$form_data = $this->submission_handler->get_form_model()->read();
		$title = $form_data['name'] . '<span> / ' . \get_bloginfo( 'name' ) . '</span>';

		$time_zone = \wp_timezone()->getName();

		$pdf = new PdfUtil();
		$pdf
			->set_style( $style )
			->page_title( $form_data['name'] )
			->title( $title )
			->body( $this->submission_handler->html()->get_submission_preview_html( 'pdf' ) )
			->footer(
				\sprintf(
					/* translators: %1$s is time, %2$s is submission link */
					\__( 'generated on %1$s from<br />%2$s', 'wp-eform' ),
					format_datetime( \time(), true )
						. (
								! empty( $time_zone )
									? ' (' . $time_zone . ')'
									: ''
							),
					'<a href="' . \esc_attr( $submission_link ) . '">'
						. break_strings_with( $submission_link, 58 )
						. '</a>'
				)
			)
			->attrs( $attrs );

		return $pdf;
	}
}
