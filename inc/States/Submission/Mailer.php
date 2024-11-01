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

use WPEForm\System\SystemEndpoint;
use WPEForm\Util\Mailer as MailerUtil;
use WPEForm\Util\Style;

use function WPEForm\Helpers\break_strings_with;
use function WPEForm\Helpers\format_datetime;
use function WPEForm\Helpers\format_time_from_seconds;
use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A helper class to create a Mailer for Submission.
 */
class Mailer extends Base {
	/**
	 * User email config. Depending on this, we handle the output of
	 * `get_user_email`. One of the settings class must override this on
	 * first pass.
	 *
	 * @var array
	 */
	private $user_email_config = [
		'header' => '',
		'subject' => '',
		'message' => '',
		'showSubmission' => true,
		'viewOnline' => true,
		'viewOnlineText' => 'View Online',
		'footer' => 'You are receiving this email because you have submitted a form.',
		'style_id' => 'vividblue',
	];

	/**
	 * Configuration for administrator email. Depending on this, we handle the
	 * output of `get_admin_email_mailer`. One of the settings class must override
	 * this on run_mutation.
	 *
	 * @var (string|true)[]
	 */
	private $admin_email_config = [
		'header' => '',
		'subject' => '',
		'message' => '',
		'showSubmission' => true,
		'footer' => 'You are receiving this email because you have submitted a form.',
		'style_id' => 'vividblue',
	];


	/**
	 * Configure user email variables. Should be called during `run_mutation` and
	 * not after.
	 *
	 * @param array $config User email config.
	 * @return void
	 */
	public function set_user_email_config( array $config ) : void {
		$this->user_email_config = parse_args(
			$config,
			$this->user_email_config
		);
	}

	/**
	 * Get user email configuration.
	 *
	 * @return array
	 */
	public function get_user_email_config() : array {
		return $this->user_email_config;
	}

	/**
	 * Configure admin email variables. Should be called during `run_mutation`.
	 *
	 * @param array $config Admin user email config.
	 * @return void
	 */
	public function set_admin_email_config( array $config ) : void {
		$this->admin_email_config = parse_args(
			$config,
			$this->admin_email_config
		);
	}

	/**
	 * Get admin email configuration.
	 *
	 * @return array
	 */
	public function get_admin_email_config(): array {
		return $this->admin_email_config;
	}

	/**
	 * Get Mailer instance for sending out or dealing with User Notification
	 * Email.
	 *
	 * @param bool $is_update Whether or not for the update.
	 * @param bool $admin_update       Whether or not this is an admin update.
	 *
	 * @return Mailer Mailer instance with configured values.
	 */
	public function get_user_email_mailer( bool $is_update, bool $admin_update ) : MailerUtil {
		$form_data = $this->submission_handler->get_form_model()->read();
		$user_email_config = $this->get_user_email_config();
		$slatejs_builder = $this->submission_handler->slate();

		// get all slatejs related stuff
		$header = $slatejs_builder->get_slatejs_html( $user_email_config['header'] );
		$footer = $slatejs_builder->get_slatejs_html( $user_email_config['footer'] );
		$subject = $slatejs_builder->get_slatejs_text( $user_email_config['subject'] );
		$message = $slatejs_builder->get_slatejs_html( $user_email_config['message'] );

		// other stuff
		$style = new Style( $user_email_config['style_id'] );
		$referer = $this->submission_handler->get_referer();
		$submission_link = $this->submission_handler->get_submission_link();

		// attributes
		$attrs = $this->get_email_attributes();

		// create mailer and set data
		$mailer = new MailerUtil();
		$mailer
			->set_style( $style )
			->body( $message )
			->heading( \esc_html( $form_data['name'] ), $referer )
			->subject( $subject )
			->header( $header )
			->footer( $footer )
			->email_url(
				SystemEndpoint::get_user_email_link( $this->submission_handler->get_token(), $is_update, $admin_update )
			)
			->attrs(
				$attrs
			);

		if ( $user_email_config['viewOnline'] ) {
			$mailer->cta(
				$user_email_config['viewOnlineText'],
				$submission_link
			);
		}

		// get preview HTML is needed
		if ( $user_email_config['showSubmission'] ) {
			$mailer->data( $this->submission_handler->html()->get_submission_preview_html( 'email' ) );
		}

		return $mailer;
	}

	/**
	 * Get Mailer instance for sending out or dealing with Admin Notification
	 * Email.
	 *
	 * @param bool $is_update Whether or not for the update.
	 *
	 * @return Mailer Mailer instance with configured values.
	 */
	public function get_admin_email_mailer( bool $is_update ) : MailerUtil {
		$form_data = $this->submission_handler->get_form_model()->read();
		$admin_email_config = $this->get_admin_email_config();
		$slatejs_builder = $this->submission_handler->slate();

		// get all slatejs related stuff
		$header = $slatejs_builder->get_slatejs_html( $admin_email_config['header'], true );
		$footer = $slatejs_builder->get_slatejs_html( $admin_email_config['footer'], true );
		$subject = $slatejs_builder->get_slatejs_text( $admin_email_config['subject'], true );
		$message = $slatejs_builder->get_slatejs_html( $admin_email_config['message'], true );

		// other stuff
		$style = new Style( $admin_email_config['style_id'] );
		$referer = $this->submission_handler->get_referer();
		$submission_admin_link = SystemEndpoint::get_submission_admin_link(
			(string) $this->submission_handler->get_submission_id()
		);

		// attributes
		$attrs = $this->get_email_attributes();

		// create mailer and set data
		$mailer = new MailerUtil();
		$mailer
			->set_style( $style )
			->body( $message )
			->heading( \esc_html( $form_data['name'] ), $referer )
			->subject( $subject )
			->header( $header )
			->footer( $footer )
			->email_url(
				SystemEndpoint::get_admin_email_link( $this->submission_handler->get_token(), $is_update )
			)
			->attrs(
				$attrs
			)->cta(
				\__( 'View Submission', 'wp-eform' ),
				$submission_admin_link
			);

		// get preview HTML is needed
		if ( $admin_email_config['showSubmission'] ) {
			$mailer->data( $this->submission_handler->html()->get_submission_preview_html( 'email' ) );
		}

		return $mailer;
	}

	/**
	 * Get email attributes.
	 *
	 * @param bool $remarks Whether or not to include remarks. Default false.
	 * @return array Array of attributes, to be passed directly to Mailer.
	 * @throws LogicException If token is not set.
	 */
	public function get_email_attributes( $remarks = false ) : array {
		$submission_link = $this->submission_handler->get_submission_link();
		$form = $this->submission_handler->get_form_model();

		$attrs = [
			[
				'label' => \__( 'Form', 'wp-eform' ),
				'value' => \esc_html( $form->read()['name'] ),
			],
			[
				'label' => \__( 'Submission Id', 'wp-eform' ),
				'value' => '<code>' . $this->submission_handler->get_token() . '</code>',
			],
			[
				'label' => \__( 'Submission Date', 'wp-eform' ),
				// 2020-12-21 07:15:29
				'value' => format_datetime( \strtotime( $this->submission_handler->clock()->get_date() ) ),
			],
			[
				'label' => \__( 'Record', 'wp-eform' ),
				'value' => '<a class="url" href="' . \esc_attr( $submission_link )
					. '" target="_blank">'
					. break_strings_with( $submission_link, 37 )
					. '</a>',
			],
		];

		if ( $remarks ) {
			$admin_remarks = $this->submission_handler->get_admin_remarks();
			if ( ! empty( $admin_remarks ) ) {
				$attrs[] = [
					'label' => \__( 'Remarks', 'wp-eform' ),
					'value' => \esc_html( $admin_remarks ),
				];
			}
		}

		$score_metadata = $this->submission_handler->score()->get_primaryscore_metadata();

		if ( $score_metadata ) {
			\array_splice(
				$attrs,
				2,
				0,
				[
					[
						'label' => $score_metadata['label'],
						'value' => $score_metadata['obtained'] .
							\_x( ' / ', 'score separator', 'wp-eform' ) .
							$score_metadata['outof'],
					],
				]
			);
		}

		// If time is recorded
		$time = $this->submission_handler->clock()->get_time();
		if ( $time ) {
			$attrs[] = [
				'label' => \__( 'Duration', 'wp-eform' ),
				'value' => format_time_from_seconds( $time ),
			];
		}

		return $attrs;
	}
}
