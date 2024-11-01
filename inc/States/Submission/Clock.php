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
 * @subpackage States\Submission
 */

namespace WPEForm\States\Submission;

use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Clock (date, time needed and timer) related states for a submission handler.
 *
 * @package WPEForm\States\Submission
 */
class Clock extends Base {
	/**
	 * Date value.
	 *
	 * @var string|null
	 */
	private $date = null;

	/**
	 * Submission time value.
	 *
	 * @var int
	 */
	private $time = 0;

	/**
	 * Whether or not the submission was made with a timer.
	 *
	 * @var bool
	 */
	private $timer = false;

	/**
	 * Get the date.
	 *
	 * @throws LogicException If date has not already been set.
	 *
	 * @return string
	 */
	public function get_date() : string {
		if ( ! $this->date ) {
			throw new LogicException( 'Date is not set.' );
		}
		return $this->date;
	}

	/**
	 * Set the date.
	 *
	 * @throws LogicException If the date is already set.
	 *
	 * @param string $date The date.
	 *
	 * @return void
	 */
	public function set_date( string $date ) {
		if ( $this->date ) {
			throw new LogicException( 'Date is already set.' );
		}
		$this->date = $date;
	}

	/**
	 * Set submission time.
	 *
	 * @param int|null $time The recorded time.
	 * @return void
	 */
	public function set_time( int $time ) : void {
		// convert to absolute integer
		$time = \absint( $time );
		$this->time = $time;
	}

	/**
	 * Get submission time.
	 *
	 * @return null|int Submission time.
	 */
	public function get_time() : int {
		return $this->time;
	}

	/**
	 * Set the timer ON or OFF.
	 *
	 * @param bool $timer Timer, ON if passed true.
	 * @return void
	 */
	public function set_timer( bool $timer ) : void {
		$this->timer = $timer;
	}

	/**
	 * Get the timer. True if it is ON, False other otherwise.
	 *
	 * @return bool
	 */
	public function get_timer() : bool {
		return $this->timer;
	}
}
