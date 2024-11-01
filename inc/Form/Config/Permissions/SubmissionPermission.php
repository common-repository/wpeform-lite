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
 * @subpackage Form\Config\Permissions
 */

namespace WPEForm\Form\Config\Permissions;

use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\Model\Form as FormModel;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\System\SystemEndpoint;
use WPEForm\Util\SlateJS;
use WPEForm\Handler\Submission as SubmissionHandler;

use function WPEForm\Helpers\get_timestamp_from_js_iso_8601;
use function WPEForm\Helpers\merge_non_empty_items;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for SubmissionPermission.
 */
class SubmissionPermission extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			// TOTAL LIMIT
			'limitTotal' => FieldVar::var( 0, Type::int() ),
			'totalLimitMsg' => FieldVar::var(
				__( 'Sorry the form can not be submitted any more.', 'wp-eform' ),
				Type::string()
			),
			'totalLimitNotice' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Only <mentions character="::totalRemainingSubmissions::" /> submissions left. ', 'wp-eform' ) .
						__( '<mentions character="::totalSubmissions::" /> already filled in.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// EMAIL LIMIT
			'limitPerEmail' => FieldVar::var( 0, Type::int() ),
			'emailLimitMsg' => FieldVar::var(
				__( 'Submission limit from your email has been exceeded.', 'wp-eform' ),
				Type::string()
			),
			// IP LIMIT
			'limitPerIp' => FieldVar::var( 0, Type::int() ),
			'ipLimitMsg' => FieldVar::var(
				__( 'Submission limit from this IP address has been exceeded.', 'wp-eform' ),
				Type::string()
			),
			// USER LIMIT
			'limitPerUser' => FieldVar::var( 0, Type::int() ),
			'userLimitMsg' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Your submission limit has been exceeded. You can check <a href="%PORTAL_LINK%">your portal page</a> to access previous submissions.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// COOKIE LIMIT
			'limitPerCookie' => FieldVar::var( 0, Type::int() ),
			'cookieLimitMsg' => FieldVar::var(
				__( 'You have exceeded your limit to submit this form.', 'wp-eform' ),
				Type::string()
			),
			// LOGIN LIMIT
			'limitOnLogin' => FieldVar::var(
				'none',
				Registry::get( 'formSettingsLimitOnLogin', 'enum' )
			), // none, loggedin, loggedout
			'loginLimitLoggedInMsg' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Sorry you can not submit this form. You need to be <a href="%LOGIN_LINK%">logged in</a> to be able to submit this form.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'loginLimitLoggedOutMsg' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Sorry you can not submit this form. You need to be <a href="%LOGOUT_LINK%">logged out</a> to be able to submit this form.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// INTERVAL LIMIT
			'limitOnInterval' => FieldVar::var( 0, Type::int() ),
			'intervalLimitMsg' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Slow down there. You need to wait for atleast <mentions character="::submissionWaitTime::" /> before submitting again.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// DATE LIMIT
			'startsOn' => FieldVar::var( null, Type::string() )->setNullable( true ),
			'startsOnMsg' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Sorry we are not accepting submissions till <mentions character="::submissionStartDate::" />.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'expiresOn' => FieldVar::var( null, Type::string() )->setNullable( true ),
			'expiresOnMsg' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Sorry the form has expired on <mentions character="::submissionEndDate::" />.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// NOTICE
			'noticeIfSubmitted' => FieldVar::var( false, Type::boolean() ),
			'submittedNotice' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'It looks like you have already submitted this form. You can browse it <a href="%LAST_SUBMISSION_LINK%">here</a>. You can also continue to submit the form again.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
		];
		return $config_vars;
	}

	/**
	 * Get limitation message based on total limit.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_total_limit_limitation( array $config, FormModel $model, FormAuth $auth ) : ? array {
		$form_id = $model->get_id();
		// Limit based on total limit
		if ( $config['limitTotal'] && $config['limitTotal'] > 0 ) {
			$total_count = $model::get_total_submission_count( $form_id );
			$limit_total = (int) $config['limitTotal'];
			// If total count has exceeded limit, then add it
			if ( $total_count >= $limit_total ) {
				return [
					'id' => 'totalLimitMsg',
					'message' => $config['totalLimitMsg'],
					'mentions' => \json_encode(
						[
							'::totalSubmissions::' => (string) $total_count,
							'::totalRemainingSubmissions::' => (string) ( $limit_total - $total_count ),
						]
					),
					'dynamicAnchors' => null,
				];
			}
		}
		return null;
	}

	/**
	 * Get limitation message based on ip limit.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_ip_limit_limitation( array $config, FormModel $model, FormAuth $auth ) : ? array {
		$form_id = $model->get_id();
		$ip_address = $_SERVER['REMOTE_ADDR'] ?? null;

		if (
			$ip_address
			&& $config['limitPerIp']
			&& (int) $config['limitPerIp'] > 0
		) {
			$total_count = $model::get_submission_count_by_ip( $ip_address, $form_id );
			$limit = (int) $config['limitPerIp'];
			// If total count has exceeded limit, then add it
			if ( $total_count >= $limit ) {
				return [
					'id' => 'ipLimitMsg',
					'message' => $config['ipLimitMsg'],
					'mentions' => null,
					'dynamicAnchors' => null,
				];
			}
		}

		return null;
	}

	/**
	 * Get limitation message based on user limit.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_user_limit_limitation( array $config, FormModel $model, FormAuth $auth ) : ? array {
		// User limitation doesn't work if user is not logged in
		if ( ! $auth->is_user_logged_in() ) {
			return null;
		}

		$form_id = $model->get_id();
		$limit = (int) $config['limitPerUser'];
		if ( $limit > 0 ) {
			$total_count = $model::get_submission_count_by_user(
				$auth->get_current_user_id(),
				$form_id
			);
			if ( $total_count >= $limit ) {
				return [
					'id' => 'userLimitMsg',
					'message' => $config['userLimitMsg'],
					'mentions' => null,
					'dynamicAnchors' => \json_encode(
						[
							'%PORTAL_LINK%' => SystemEndpoint::get_userportal_page_link(),
						]
					),
				];
			}
		}

		return null;
	}

	/**
	 * Get limitation message based on login status.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_login_limit_limitation( array $config, FormModel $model, FormAuth $auth ) : ? array {
		$limit = $config['limitOnLogin'];

		if ( $limit !== 'none' ) {

			// If user needs to be logged in
			if ( $limit === 'loggedin' && ! $auth->is_user_logged_in() ) {
				return [
					'id' => 'loginLimitLoggedInMsg',
					'message' => $config['loginLimitLoggedInMsg'],
					'mentions' => null,
					'dynamicAnchors' => \json_encode(
						[
							'%LOGIN_LINK%' => SystemEndpoint::get_login_link(),
						]
					),
				];
			}

			// If user needs to be logged out
			if ( $limit === 'loggedout' && $auth->is_user_logged_in() ) {
				return [
					'id' => 'loginLimitLoggedOutMsg',
					'message' => $config['loginLimitLoggedOutMsg'],
					'mentions' => null,
					'dynamicAnchors' => \json_encode(
						[
							'%LOGOUT_LINK%' => SystemEndpoint::get_logout_link(),
						]
					),
				];
			}
		}

		return null;
	}

	/**
	 * Get limitation message based on cookie status.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_cookie_limit_limitation( array $config, FormModel $model, FormAuth $auth ) : ? array {
		$limit = (int) $config['limitPerCookie'];
		$form_id = $model->get_id();

		if ( $limit > 0 ) {
			$cookie_name = $this->get_submission_count_cookie_name( $form_id );
			$total_count = isset( $_COOKIE[ $cookie_name ] )
				? \absint( $_COOKIE[ $cookie_name ] )
				: 0;
			if ( $total_count >= $limit ) {
				return [
					'id' => 'cookieLimitMsg',
					'message' => $config['cookieLimitMsg'],
					'mentions' => null,
					'dynamicAnchors' => null,
				];
			}
		}

		return null;
	}

	/**
	 * Get limitation message based on interval status.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_interval_limit_limitation( array $config, FormModel $model, FormAuth $auth ) : ? array {
		$limit = (int) $config['limitOnInterval'];
		$form_id = $model->get_id();

		if ( $limit > 0 ) {
			$sub_time_cookie_name = $this->get_last_submission_time_cookie_name( $form_id );
			$last_submitted_time = isset( $_COOKIE[ $sub_time_cookie_name ] )
				? \absint( $_COOKIE[ $sub_time_cookie_name ] )
				: 0;
			if ( $last_submitted_time ) {
				// calculate last submitted time in minutes
				$difference = ( time() - (int) $last_submitted_time ) / 60;
				$ceiled_wait_for = \ceil( $limit - $difference );
				if ( $difference < $limit ) {
					return [
						'id' => 'intervalLimitMsg',
						'message' => $config['intervalLimitMsg'],
						'mentions' => \json_encode(
							[
								'::submissionWaitTime::' => \sprintf(
									/* translators: %s is replaed by the number of minutes to wait for */
									\_n( '%s minute', '%s minutes', $ceiled_wait_for, 'wp-eform' ),
									\number_format_i18n( $ceiled_wait_for, 0 )
								),
							]
						),
						'dynamicAnchors' => null,
					];
				}
			}
		}

		return null;
	}

	/**
	 * Get limitation message based on start and end date status.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_date_limit_limitation( array $config, FormModel $model, FormAuth $auth ) : ? array {
		// We expect the start_date and end_date to be set in ISO-8601 (for JS: new Date().toISOString())
		// that's how our client script should handle. In short, take datetime input
		// in whatever timezone, but send only UTC data to the server. This is
		// handled automatically in antd-datetimepicker which sends ISO-8601 string
		// to the server. Should client implementation change, we need to keep it
		// in mind.
		$start_date = $config['startsOn'];
		$start_date_timestamp = get_timestamp_from_js_iso_8601( $start_date ?? '' );
		$end_date = $config['expiresOn'];
		$end_date_timestamp = get_timestamp_from_js_iso_8601( $end_date ?? '' );
		// We can calculate the difference with current GMT time because
		// the input has timezone in it which would be properly converted to
		// timestamp. The timestamps themselves doens't have any timezone, since
		// it is time since epoch.
		$current_time = \time();

		$mentions = \json_encode(
			[
				'::submissionStartDate::' => $start_date,
				'::submissionEndDate::' => $end_date,
			]
		);

		// Check for start date first
		if ( ! empty( $start_date ) && ! empty( $start_date_timestamp ) ) {
			if ( $current_time < $start_date_timestamp ) {
				return [
					'id' => 'startsOnMsg',
					'message' => $config['startsOnMsg'],
					'mentions' => $mentions,
					'dynamicAnchors' => null,
				];
			}
		}

		// Now check for end date
		if ( ! empty( $end_date ) && ! empty( $end_date_timestamp ) ) {
			if ( $current_time > $end_date_timestamp ) {
				return [
					'id' => 'expiresOnMsg',
					'message' => $config['expiresOnMsg'],
					'mentions' => $mentions,
					'dynamicAnchors' => null,
				];
			}
		}

		return null;
	}



	/**
	 * {@inheritDoc}
	 *
	 * @param array     $config Config for the permission class.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array Limitations.
	 */
	public function get_preemptive_limitations( array $config, FormModel $model, FormAuth $auth ): array {
		return merge_non_empty_items(
			// Total count based
			$this->get_total_limit_limitation( $config, $model, $auth ),
			// IP based
			$this->get_ip_limit_limitation( $config, $model, $auth ),
			// User Limit
			$this->get_user_limit_limitation( $config, $model, $auth ),
			// Cookie Limit
			$this->get_cookie_limit_limitation( $config, $model, $auth ),
			// Login Limit
			$this->get_login_limit_limitation( $config, $model, $auth ),
			// Interval based limit
			$this->get_interval_limit_limitation( $config, $model, $auth ),
			// Date based
			$this->get_date_limit_limitation( $config, $model, $auth )
		);
	}

	/**
	 * Get Notice if submitted.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_if_submitted_notice( array $config, FormModel $model, FormAuth $auth ) : ?array {
		$form_id = $model->get_id();
		if ( $config['noticeIfSubmitted'] === true ) {
			$token = null;
			// First prefer user based logic
			if ( $auth->is_user_logged_in() ) {
				$user_id = $auth->get_current_user_id();
				$token = $model::get_last_submission_token_of_user( $user_id, $form_id );
			} else {
				// Fallback to cookies
				$token_cookie_name = $this->get_last_submission_token_cookie_name( $form_id );
				$token = isset( $_COOKIE[ $token_cookie_name ] )
					? \sanitize_key( $_COOKIE[ $token_cookie_name ] )
					: null;
			}

			// If token is there, then it has been submitted
			if ( $token ) {
				return [
					'id' => 'noticeIfSubmitted',
					'message' => $config['submittedNotice'],
					'mentions' => null,
					'dynamicAnchors' => \json_encode(
						[
							'%LAST_SUBMISSION_LINK%' => SystemEndpoint::get_summary_page_link( $token ),
						]
					),
				];
			}
		}
		return null;
	}

	/**
	 * Get total limit based notice.
	 *
	 * @param array     $config Config.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_total_limit_notice( array $config, FormModel $model, FormAuth $auth ) : ? array {
		$form_id = $model->get_id();

		if ( $config['limitTotal'] && (int) $config['limitTotal'] > 0 ) {
			$total_count = $model::get_total_submission_count( $form_id );
			$limit_total = (int) $config['limitTotal'];
			// Show the notice if total count is less, else we would just block the submission.
			if ( $total_count > 0 && $total_count < $limit_total ) {
				// But don't show notice, if the message is empty
				$message = SlateJS::parseEditorChildrenJSON( $config['totalLimitNotice'] );
				if ( ! $message->isEditorEmpty() ) {
					return [
						'id' => 'totalLimitNotice',
						'message' => $config['totalLimitNotice'],
						'mentions' => \json_encode(
							[
								'::totalSubmissions::' => (string) $total_count,
								'::totalRemainingSubmissions::' => (string) ( $limit_total - $total_count ),
							]
						),
						'dynamicAnchors' => null,
					];
				}
			}
		}
		return null;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array     $config Permission config.
	 * @param FormModel $model Form model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array Notices.
	 */
	public function get_preemptive_notices( array $config, FormModel $model, FormAuth $auth ): array {
		return merge_non_empty_items(
			// Notice for if already submitted
			$this->get_if_submitted_notice( $config, $model, $auth ),
			// Notice based on total count
			$this->get_total_limit_notice( $config, $model, $auth )
		);
	}

	/**
	 * Get limitation message based on email limit.
	 *
	 * @param array             $config Config.
	 * @param FormModel         $model Form Model.
	 * @param FormAuth          $auth Form Auth.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 *
	 * @return array|null LimitationMessageType on success, null if not needed.
	 */
	protected function get_email_limit_limitation( array $config, FormModel $model, FormAuth $auth, SubmissionHandler $handler ) : ? array {
		$form_id = $model->get_id();

		if (
			$config['limitPerEmail']
			&& (int) $config['limitPerEmail'] > 0
			&& ! empty( $handler->primitives()->get_primitive( 'email' ) )
		) {
			$email = $handler->primitives()->get_primitive( 'email' );
			$email_submission_count = $model::get_submission_count_by_email(
				$email,
				$form_id
			);
			$email_limit = (int) $config['limitPerEmail'];
			if ( $email_submission_count >= $email_limit ) {
				return [
					'id' => 'emailLimitMsg',
					'message' => $config['emailLimitMsg'],
					'mentions' => null,
					'dynamicAnchors' => null,
				];
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array             $config Config for the permission class.
	 * @param FormModel         $model Form Model.
	 * @param FormAuth          $auth Form Auth.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 *
	 * @return array Notices array. Check GraphQL type FormLimitationMessage for shape.
	 */
	public function get_postsubmission_limitations( array $config, FormModel $model, FormAuth $auth, SubmissionHandler $handler ) : array {
		return merge_non_empty_items(
			// Email based limit
			$this->get_email_limit_limitation( $config, $model, $auth, $handler )
		);
	}

	/**
	 * Get submission count cookie name.
	 *
	 * @param int $form_id Form Id.
	 *
	 * @return string
	 */
	protected function get_submission_count_cookie_name( int $form_id ) : string {
		return 'wp-eform-submission-count-' . (string) $form_id;
	}

	/**
	 * Get last submission time cookie name.
	 *
	 * @param int $form_id Form Id.
	 *
	 * @return string
	 */
	protected function get_last_submission_time_cookie_name( int $form_id ) : string {
		return 'wp-eform-submission-last-time-' . (string) $form_id;
	}

	/**
	 * Get last submission token cookie name.
	 *
	 * @param int $form_id Form Id.
	 *
	 * @return string
	 */
	protected function get_last_submission_token_cookie_name( int $form_id ) : string {
		return 'wp-eform-submission-last-token-' . (string) $form_id;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param bool              $is_update Whether or not the side effects should be run for update.
	 * @param array             $config Config for the permission class.
	 * @param FormModel         $model Form Model.
	 * @param FormAuth          $auth Form Auth.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 *
	 * @return void
	 */
	public function run_postsave_side_effect( bool $is_update, array $config, FormModel $model, FormAuth $auth, SubmissionHandler $handler ) : void {
		$form_id = $model->get_id();
		if ( ! $is_update ) {
			// Set a cookie to track submission count from client side
			$submission_count_cookie_name = $this->get_submission_count_cookie_name( $form_id );
			$previous_submission_count = \absint( $_COOKIE[ $submission_count_cookie_name ] ?? 0 );
			// We silence the error on cookie set because it would fail on CLI
			@\setcookie( // phpcs:disable WordPress.PHP.NoSilencedErrors.Discouraged
				$submission_count_cookie_name,
				(string) ( $previous_submission_count + 1 ),
				time() + ( 365 * 24 * 60 * 60 ),
				'/'
			);

			// Set a cookie to track last submission time from client side
			$submission_time_cookie_name = $this->get_last_submission_time_cookie_name( $form_id );
			// We silence because it might fail on CLI
			@\setcookie(
				$submission_time_cookie_name,
				\time(),
				\time() + ( 365 * 24 * 60 * 60 ),
				'/'
			);

			// Set a cookie to store last submission token
			$last_submission_token_cookie_name = $this->get_last_submission_token_cookie_name( $form_id );
			// We silence because it might fail on CLI
			@\setcookie(
				$last_submission_token_cookie_name,
				$handler->get_token(),
				\time() + ( 365 * 24 * 60 * 60 ),
				'/'
			);
		}
	}
}
