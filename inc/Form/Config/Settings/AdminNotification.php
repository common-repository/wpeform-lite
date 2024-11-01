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
 * @subpackage Form\Config\Settings
 */

namespace WPEForm\Form\Config\Settings;

use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Handler\Submission as SubmissionHandler;
use WPEForm\System\SystemEndpoint;
use WPEForm\Util\SlateJS;

use function WPEForm\Helpers\get_current_wp_user_email;
use function WPEForm\Helpers\get_default_no_reply_email;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for AdminNotification.
 */
class AdminNotification extends Base {
	/**
	 * Send admin email if everything checks out.
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 *
	 * @return void
	 */
	private function send_admin_email( SubmissionHandler $submission_handler, array $config, bool $is_update ): void {
		$admin_email = $config['toEmail'];

		// bail early if admin email is invalid
		if ( empty( $admin_email ) ) {
			return;
		}

		$mailer = $submission_handler->mailer()->get_admin_email_mailer( $is_update );

		if ( $config['replyToUser'] ) {
			$user_email = $submission_handler->primitives()->get_primitive( 'email' );

			// if it is valid, then set
			if ( $user_email && \is_email( $user_email ) ) {
				$mailer->reply_to( $user_email );
			}
		}

		$mailer
			->from( $config['fromName'] . ' <' . $config['fromEmail'] . '>' )
			->to( $admin_email )
			->mail();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_side_effect( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ): void {
		// send admin email
		if ( ! $admin_update ) {
			$this->send_admin_email( $submission_handler, $config, $is_update );
		}
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_mutation( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ): void {
		// set admin email config
		if ( $is_update ) {
			$subject = $config['updateSubject'];
			$message = $config['updateMessage'];
		} else {
			$subject = $config['subject'];
			$message = $config['message'];
		}

		$form_data = $submission_handler->get_form_model()->read();
		$style_id = $form_data['styles']['theme']['scheme'];

		$submission_handler->mailer()->set_admin_email_config(
			[
				'header' => $config['header'],
				'subject' => $subject,
				'message' => $message,
				'showSubmission' => $config['showSubmission'],
				'viewOnline' => true,
				'viewOnlineText' => \__( 'Administrate Submission', 'wp-eform' ),
				'footer' => $config['footer'],
				'style_id' => $style_id,
			]
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$subject = SlateJS::parseHTML(
			'<p>' .
				'[<mentions character="::formName::"></mentions>] ' .
				__( 'New Form Submission Notification', 'wp-eform' ) .
			'</p>'
		);
		$message = SlateJS::parseHTML(
			'<p>' .
				__( 'A new submission has been made. You can visit it at <a href="%ADMIN_SUBMISSION_LINK%">this link</a>.', 'wp-eform' ) .
			'</p>' .
			'<p>' .
				__( 'Yours truly, WP EForm Plugin.', 'wp-eform' ) .
			'</p>'
		);
		$updateSubject = SlateJS::parseHTML(
			'<p>' .
				'[<mentions character="::formName::"></mentions>] ' .
				__( 'Form Update Notification', 'wp-eform' ) .
			'</p>'
		);
		$updateMessage = SlateJS::parseHTML(
			'<p>' .
				__( 'An existing submission has been updated. You can visit it at <a href="%ADMIN_SUBMISSION_LINK%">this link</a>.', 'wp-eform' ) .
			'</p>' .
			'<p>' .
				__( 'Yours truly, WP EForm Plugin.', 'wp-eform' ) .
			'</p>'
		);
		$footer = SlateJS::parseHTML(
			'<p>' .
				__( 'This is an autogenerated email. You are receiving this email because you are a manager of a form.', 'wp-eform' ) .
			'</p>' .
			'<p>' .
				/* translators: Dont replace %FORM_ADMIN_LINK% it is handled by the system */
				__( 'If you do not wish to receive emails, kindly visit the <a href="%FORM_ADMIN_LINK%">administrator page</a> and modify your notification preferences.', 'wp-eform' ) .
			'<p>' .
				\sprintf(
					/* translators: %1$s is the site name */
					__( '&copy; %1$s. This is not a marketing email.', 'wp-eform' ),
					\get_bloginfo( 'name' )
				) .
			'</p>'
		);

		$config_vars = [
			'toEmail' => FieldVar::var(
				get_current_wp_user_email( '' ),
				Type::string()
			)
				->setNullable( true )
				->setValidator( '\\WPEForm\\Helpers\\validate_is_email' ),
			'subject' => FieldVar::var(
				$subject->getEditorChildrenJSON(),
				Type::string()
			),
			'message' => FieldVar::var(
				$message->getEditorChildrenJSON(),
				Type::string()
			),
			'updateSubject' => FieldVar::var(
				$updateSubject->getEditorChildrenJSON(),
				Type::string()
			),
			'updateMessage' => FieldVar::var(
				$updateMessage->getEditorChildrenJSON(),
				Type::string()
			),
			'fromName' => FieldVar::var(
				'WP EForm',
				Type::string()
			),
			'fromEmail' => FieldVar::var(
				get_default_no_reply_email(),
				Type::string()
			)
				->setNullable( true )
				->setValidator( '\\WPEForm\\Helpers\\validate_is_email' ),
			'header' => FieldVar::var(
				'',
				Type::string()
			),
			'replyToUser' => FieldVar::var(
				false,
				Type::boolean()
			),
			'showSubmission' => FieldVar::var(
				true,
				Type::boolean()
			),
			'footer' => FieldVar::var(
				$footer->getEditorChildrenJSON(),
				Type::string()
			),
		];
		return $config_vars;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Original config.
	 * @return array Normalized config.
	 */
	public function normalize_on_export( array $config ) : array {
		$config['toEmail'] = '';
		$config['fromEmail'] = '';
		return $config;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Original config from import.
	 * @return array Normalized config.
	 */
	public function normalize_on_import( array $config ) : array {
		$default = $this->get_default_config_value();
		$config['toEmail'] = get_current_wp_user_email();
		$config['fromEmail'] = $default['fromEmail'];
		return $config;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function is_user_facing() : bool {
		return false;
	}
}
