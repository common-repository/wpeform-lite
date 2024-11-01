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
use WPEForm\Util\SlateJS;

use function WPEForm\Helpers\get_current_wp_user_email;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for UserNotification.
 */
class UserNotification extends Base {

	/**
	 * Send user email if everything checks out.
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	private function send_user_email( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ): void {
		$user_email = $submission_handler->primitives()->get_primitive( 'email' );
		// bail early if user email is invalid
		if ( ! $user_email || ! \is_email( $user_email ) ) {
			return;
		}
		// if fromEmail is empty, then don't send
		if ( empty( $config['fromEmail'] ) ) {
			return;
		}

		$mailer = $submission_handler->mailer()->get_user_email_mailer( $is_update, $admin_update );

		$mailer
			->from( $config['fromName'] . ' <' . $config['fromEmail'] . '>' )
			->reply_to( $config['fromEmail'] )
			->to( $user_email )
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
		$this->send_user_email(
			$submission_handler,
			$config,
			$is_update,
			$admin_update
		);
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
		// set user email config
		if ( $is_update ) {
			if ( $admin_update ) {
				$subject = $config['adminUpdateSubject'];
				$message = $config['adminUpdateMessage'];
			} else {
				$subject = $config['updateSubject'];
				$message = $config['updateMessage'];
			}
		} else {
			$subject = $config['subject'];
			$message = $config['message'];
		}

		$form_data = $submission_handler->get_form_model()->read();
		$style_id = $form_data['styles']['theme']['scheme'];

		$submission_handler->mailer()->set_user_email_config(
			[
				'header' => $config['header'],
				'subject' => $subject,
				'message' => $message,
				'showSubmission' => $config['showSubmission'],
				'viewOnline' => $config['viewOnline'],
				'viewOnlineText' => $config['viewOnlineText'],
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
		$config_vars = [
			'subject' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Hey <mentions character="::fName::"></mentions> ', 'wp-eform' ) .
						__( 'we have got your answers', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'message' => FieldVar::var(
				SlateJS::parseHTML(
					'<h2>' .
						__( 'Hey <mentions character="::fName::"></mentions>,', 'wp-eform' ) .
					'</h2>' .
					'<p>' .
						__( 'Thank you <mentions character="::name::"></mentions> for the submission.', 'wp-eform' ) .
						__( '  We have received your answers, which you can see online by clicking the link below.', 'wp-eform' ) .
						__( ' For your convenience we have also included the submission data we have recorded in this email.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'updateSubject' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Hey <mentions character="::fName::"></mentions> ', 'wp-eform' ) .
						__( 'your submission has been updated', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'updateMessage' => FieldVar::var(
				SlateJS::parseHTML(
					'<h2>' .
						__( 'Hey <mentions character="::fName::"></mentions>,', 'wp-eform' ) .
					'</h2>' .
					'<p>' .
						__( 'Thank you <mentions character="::name::"></mentions> for the submission.', 'wp-eform' ) .
						__( '  We have updated the record according to your changes. You can view it online following the link below.', 'wp-eform' ) .
						__( ' For your convenience we have also included the submission data we have updated in this email.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'adminUpdateSubject' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Hey <mentions character="::fName::"></mentions> ', 'wp-eform' ) .
						__( 'an admin has updated your submission', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'adminUpdateMessage' => FieldVar::var(
				SlateJS::parseHTML(
					'<h2>' .
						__( 'Hey <mentions character="::fName::"></mentions>,', 'wp-eform' ) .
					'</h2>' .
					'<p>' .
						__( 'Our staff has updated your submission. The following remarks were added.', 'wp-eform' ) .
					'</p>' .
					'<p>' .
						__( '<mentions character="::adminRemarks::"></mentions>', 'wp-eform' ) .
					'</p>' .
					'<p>' .
						__( 'You can view it online following the link below.', 'wp-eform' ) .
						__( ' For your convenience we have also included the submission data we have updated in this email.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'fromName' => FieldVar::var( \get_bloginfo( 'name' ), Type::string() ),
			'fromEmail' => FieldVar::var(
				get_current_wp_user_email( '' ),
				Type::string()
			)
				->setNullable( true )
				->setValidator( '\\WPEForm\\Helpers\\validate_is_email' ),
			'header' => FieldVar::var( '', Type::string() ),
			'showSubmission' => FieldVar::var( true, Type::boolean() ),
			'viewOnline' => FieldVar::var( true, Type::boolean() ),
			'viewOnlineText' => FieldVar::var(
				__( 'View Online', 'wp-eform' ),
				Type::string()
			),
			'footer' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
					__( 'You are receiving this email because you have submitted a form.', 'wp-eform' ) .
					'</p>' .
					'<p>' .
						\sprintf(
							/* translators: %1$s is the site name */
							__( '&copy; %1$s. This is not a marketing email.', 'wp-eform' ),
							\get_bloginfo( 'name' )
						) .
					'</p>'
				)->getEditorChildrenJSON(),
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
		$config['fromName'] = '';
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
		$config['fromName'] = $default['fromName'];
		$config['fromEmail'] = get_current_wp_user_email();
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
