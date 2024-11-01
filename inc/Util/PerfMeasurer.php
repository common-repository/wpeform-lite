<?php
/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
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
 * @subpackage Util
 */

namespace WPEForm\Util;

use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

// phpcs:disable WordPress.NamingConventions.ValidVariableName.InterpolatedVariableNotSnakeCase
// phpcs:disable WordPress.PHP.DevelopmentFunctions.error_log_error_log

/**
 * A static class to help measure performance time throughout different
 * lifecycles of the program. This is static, so that it can be used anywhere.
 *
 * @package WPEForm\Util
 */
class PerfMeasurer {
	/**
	 * Start time.
	 *
	 * @var null|float
	 */
	protected static $startTime = null;

	/**
	 * Last log time.
	 *
	 * @var null|float
	 */
	protected static $lastTime = null;

	/**
	 * Start the timer from when you'd like to measure performance time.
	 *
	 * @return void
	 */
	public static function startTimer() {
		self::$startTime = \microtime( true );
	}

	/**
	 * Log the time since last log and optionally since beginning.
	 *
	 * @param string $event Event name for logging.
	 * @param bool   $sinceBeginning whether to log time since beginning. Defaults false.
	 * @return void
	 * @throws LogicException If the timer hasn't been started yet.
	 */
	public static function log( string $event, bool $sinceBeginning = false ) {
		if ( self::$startTime === null ) {
			throw new LogicException( 'Must start timer by calling PerfMeasurer::startTimer before logging.' );
		}
		$timeNow = \microtime( true );
		$timeStart = self::$startTime;
		if ( self::$lastTime ) {
			$timeStart = self::$lastTime;
		}
		$timeElapsed = $timeNow - $timeStart;
		$perfTime = \round( $timeElapsed * 1000, 2 );
		\error_log( "{$event}::SinceLast {$perfTime}ms" );

		if ( $sinceBeginning ) {
			$begTime = \round( ( $timeNow - self::$startTime ) * 1000, 2 );
			\error_log( "{$event}::SinceBeginning {$begTime}ms" );
		}
		self::$lastTime = $timeNow;
	}
}
