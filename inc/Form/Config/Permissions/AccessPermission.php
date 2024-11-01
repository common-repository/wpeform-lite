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

use DateTime;
use DateTimeZone;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\Model\Form as FormModel;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Handler\Submission as SubmissionHandler;

use function WPEForm\Helpers\get_current_timestamp;
use function WPEForm\Helpers\get_timestamp_from_mysql_formatted_datetime;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for AccessPermission.
 */
class AccessPermission extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			'canEdit' => FieldVar::var( false, Type::boolean() ),
			'editTime' => FieldVar::var( 0, Type::int() ),
			'restrictEditOnExpiration' => FieldVar::var( true, Type::boolean() ),
		];
		return $config_vars;
	}

	/**
	 * Run pre-save mutations on handler. It is used to check whether the save
	 * can be performed by the controller.
	 *
	 * @param bool              $is_update Whether or not the side effects should be run for update.
	 * @param array             $config Config for the permission class.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 * @return void
	 */
	public function run_presave_mutations( bool $is_update, array $config, SubmissionHandler $handler ) : void {
		if ( ! $config['canEdit'] ) {
			$handler->set_can_user_edit( false );
		} else {
			if ( ! $config['restrictEditOnExpiration'] ) {
				$handler->set_can_user_edit( true );
			} else {
				$restrict_minutes = \absint( $config['editTime'] );
				if ( $restrict_minutes === 0 ) {
					$handler->set_can_user_edit( true );
				} else {
					// $current_time = \current_time( 'mysql', true );
					// $time_elapsed = ( \strtotime( $current_time ) - \strtotime( $handler->get_date() ) ) / \MINUTE_IN_SECONDS;
					$submission_time = get_timestamp_from_mysql_formatted_datetime(
						$handler->clock()->get_date()
					);
					$current_time = get_current_timestamp();
					// failsafe submission time
					if ( $submission_time !== false && $current_time !== false ) {
						$time_elapsed = ( $current_time - $submission_time ) / \MINUTE_IN_SECONDS;
						if ( $time_elapsed > $restrict_minutes ) {
							$handler->set_can_user_edit( false );
						} else {
							$handler->set_can_user_edit( true );
						}
					}
				}
			}
		}
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
		return [];
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
		return [];
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
		return [];
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
	public function run_postsave_side_effect( bool $is_update, array $config, FormModel $model, FormAuth $auth, SubmissionHandler $handler ) : void {}
}
