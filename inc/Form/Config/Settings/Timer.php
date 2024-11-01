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

use WPEForm\GraphQL\Registry;
use WPEForm\Util\SlateJS;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for Timer.
 */
class Timer extends Base {
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
	public function run_preprocessor( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ) : void {
		if ( $config['submitTimer'] !== 'none' ) {
			$submission_handler->clock()->set_timer( true );
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
	public function run_side_effect( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ): void {
		// no side effect
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
		// reset stopwatch if settings says so
		// the client is set to always send along recorded time
		if ( ! $config['recordSubmissionTime'] ) {
			$submission_handler->clock()->set_time( 0 );
		}
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$timer_message = SlateJS::parseHTML(
			'<p>' .
				\__( 'left before you run out of time.', 'wp-eform' ) .
			'</p>'
		);
		$config_vars = [
			// submission timer
			'submitTimer' => FieldVar::var(
				'none',
				Registry::get( 'submitTimer', 'enum' )
			),
			'showTimer' => FieldVar::var(
				true,
				Type::boolean()
			),
			'timeLimit' => FieldVar::var(
				120,
				Type::float()
			)->setNullable( true ), // could be nullable
			'timerMessage' => FieldVar::var(
				$timer_message->getEditorChildrenJSON(),
				Type::string()
			),
			// submission stopwatch
			'recordSubmissionTime' => FieldVar::var(
				true,
				Type::boolean()
			),
			'showStopwatch' => FieldVar::var(
				false,
				Type::boolean()
			),
		];
		return $config_vars;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function is_user_facing() : bool {
		return true;
	}
}
