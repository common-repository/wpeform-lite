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
 * @package EForm
 * @subpackage Helpers
 */

namespace WPEForm\Helpers;

use DateInterval;
use DateTime;
use DateTimeZone;
use LogicException;

/**
 * Get mysql datetime format for use with PHP datelibs.
 *
 * @return string
 */
function get_mysql_datetime_format() : string {
	return 'Y-m-d H:i:s';
}

/**
 * Get mysql datetime from user input. It checks if the input is valid and
 * converts it into proper mysql datetime column string for comparison.
 *
 * @param mixed  $input User input.
 * @param string $timezone Timezone, defaults to 'utc' which should work for most cases.
 *
 * @return string|false string if the parse was successful, false otherwise.
 */
function get_mysql_datetime_from_user_input( $input, string $timezone = 'utc' ) {
	if ( \is_string( $input ) ) {
		$formatted_datetime = DateTime::createFromFormat(
			get_mysql_datetime_format(),
			$input,
			new DateTimeZone( $timezone )
		);
		if ( $formatted_datetime ) {
			return $formatted_datetime->format( get_mysql_datetime_format() );
		}
	}
	return false;
}

/**
 * Get a proper datetime string from a possible formula. In the formula `CURRENT`
 * is replaced by the current time in UTC.
 *
 * @param mixed  $input Input date/time or formula.
 * @param string $timezone Timezone, utc by default.
 * @return string|false String on success, false on failure.
 */
function parse_possible_formula_in_datetime_input( $input, string $timezone = 'utc' ) {
	$matches = [];
	$is_formula = \preg_match(
		'/\s?(current)\s?(-|\+)\s?(\d+)\s?(second|minute|hour|day)s?/i',
		\trim( (string) $input ),
		$matches
	);
	if ( $is_formula ) {
		$current_time = get_current_timestamp( $timezone );
		$operator = \trim( $matches[2] ) === '-' ? -1 : 1;
		$number = \intval( $matches[3] );
		$unit = \trim( $matches[4] );
		$unit_to_second_map = [
			'second' => 1,
			'minute' => 1 * 60,
			'hour' => 1 * 60 * 60,
			'day' => 1 * 24 * 60 * 60,
		];
		$formula_time = $current_time + ( $number * $unit_to_second_map[ $unit ] * $operator );
		$dt = new DateTime( 'now', new DateTimeZone( $timezone ) );
		$dt->setTimestamp( $formula_time );
		return $dt->format( get_mysql_datetime_format() );
	}
	return get_mysql_datetime_from_user_input( $input, $timezone );
}

/**
 * Get timestamp from a mysql db formatted datetime string.
 *
 * @param string $input Formatted datetime string.
 * @param string $timezone Timezone, defaults utc.
 * @return int|false Timestamp on success, false on failure.
 */
function get_timestamp_from_mysql_formatted_datetime( string $input, string $timezone = 'utc' ) {
	$date = DateTime::createFromFormat(
		get_mysql_datetime_format(),
		$input,
		new DateTimeZone( $timezone )
	);
	if ( $date ) {
		return $date->getTimestamp();
	}
	return false;
}

/**
 * Compare two datetime string. Both must be in mySQL compatible datetime
 * format. Returns 1 if $compare_with is greater than $compare_to, 0 if both
 * are equal, and -1 if $compare_with is less than $compare_to. If at-least one
 * of them in invalid format, then returns NULL.
 *
 * @param string $compare_with With value.
 * @param string $compare_to To value.
 * @return null|int
 */
function compare_dates( string $compare_with, string $compare_to ) : ?int {
	$with = get_timestamp_from_mysql_formatted_datetime( $compare_with );
	$to = get_timestamp_from_mysql_formatted_datetime( $compare_to );
	if ( $with === false || $to === false ) {
		return null;
	}
	if ( $with > $to ) {
		return 1;
	}
	if ( $with === $to ) {
		return 0;
	}
	return -1;
}

/**
 * Get current timestamp.
 *
 * @return int|false Timestamp on success, false on failure.
 */
function get_current_timestamp() {
	$date = new DateTime( 'now', new DateTimeZone( 'utc' ) );
	if ( $date ) {
		return $date->getTimestamp();
	}
	return false;
}

/**
 * Safely parse any arbritary value in mysql formatted datetime.
 *
 * @param mixed $value Input value.
 * @return int|false Timestamp, or false on failure.
 */
function parse_value_into_timestamp( $value ) {
	return get_timestamp_from_mysql_formatted_datetime(
		\is_string( $value ) ? $value : '',
		'utc'
	);
}

/**
 * Get minimum datetime from the list of input.
 *
 * @param string[] ...$datetimes datetime to compare. Must be in mysql datetime format.
 * @return int|false Timestamp of minimum datetime, false on failure.
 */
function get_minimum_datetime( ...$datetimes ) {
	$compare_datetimes = \array_map(
		'\\WPEForm\\Helpers\\parse_value_into_timestamp',
		$datetimes
	);
	$min = \min( $compare_datetimes );
	return $min;
}

/**
 * Get maximum datetime from the list of input.
 *
 * @param string[] ...$datetimes datetime to compare. Must be in mysql datetime format.
 * @return int|false Timestamp of maximum datetime, false on failure.
 */
function get_maximum_datetime( ...$datetimes ) {
	$compare_datetimes = \array_map(
		'\\WPEForm\\Helpers\\parse_value_into_timestamp',
		$datetimes
	);
	$max = \max( $compare_datetimes );
	return $max;
}

/**
 * Split two dates into even number of parts in whole days. If the day difference
 * between the two dates is less than given parts, then only upto the day
 * difference is split.
 *
 * @param int $least Least date timestamp.
 * @param int $greatest Greatest date timestamp.
 * @param int $parts Parts to split into. Default 10.
 * @return array array of record of `start_date` and `end_date` formatted in mysql datetimeformat.
 *
 * @throws LogicException If least is greater than greatest.
 */
function split_datetime_into_ranges( int $least, int $greatest, int $parts = 10 ) {
	// sanity check
	if ( $least > $greatest ) {
		throw new LogicException( 'Invalid least date and greatest date passed.' );
	}

	if ( $parts < 1 ) {
		throw new LogicException( 'Invalid value of parts passed.' );
	}

	// convert least and greatest to the start and end of the same day
	$least_date = get_timestamp_from_mysql_formatted_datetime(
		\gmdate( 'Y-m-d', $least ) . ' 00:00:00'
	);
	$greatest_date = get_timestamp_from_mysql_formatted_datetime(
		\gmdate( 'Y-m-d', $greatest ) . ' 23:59:59'
	);

	$date_diff = $greatest_date - $least_date; // in seconds
	$day_diff = \ceil( $date_diff / \DAY_IN_SECONDS );

	$intervals = [];

	// we don't want a range to be less than a day, so we check if we can
	// accomodate the parts. If we cannot, then simply fallback to the difference
	// in days.
	$max_parts = $day_diff < $parts ? $day_diff : $parts;

	// interval increase should be in multiple of DAY_IN_SECONDS
	$interval_increase = \ceil( $date_diff / $max_parts );
	$interval_increase = \ceil( $interval_increase / \DAY_IN_SECONDS ) * \DAY_IN_SECONDS;

	// calculate the interval
	for ( $i = 0; $i < $max_parts; $i++ ) {
		$start_date = $least_date + $interval_increase * $i;
		$end_date = $start_date + $interval_increase - 1;
		if ( $end_date > $greatest_date ) {
			$end_date = $greatest_date;
		}

		$intervals[] = [
			'start_date' => \gmdate( get_mysql_datetime_format(), $start_date ),
			'end_date' => \gmdate( get_mysql_datetime_format(), $end_date ),
		];
	}

	return $intervals;
}

/**
 * Convert timestamp to mysql string.
 *
 * @param int $timestamp Timestamp.
 * @return string MySQL friendly datetime string.
 */
function convert_timestamp_to_mysql_string( int $timestamp ) : string {
	return \gmdate(
		get_mysql_datetime_format(),
		$timestamp
	);
}

/**
 * Get blanks (non present data points) for submissions interval stat with
 * a certain type.
 *
 * @param string $last_period Last period.
 * @param string $current_period Current period.
 * @param string $type Type of interval.
 * @return array Empty if no blanks needed.
 */
function get_submissions_interval_blanks( string $last_period, string $current_period, string $type ) : array {
	$blanks = [];

	if ( $type === 'day' ) {
		$last_date = DateTime::createFromFormat(
			'Y-m-d',
			$last_period,
			new DateTimeZone( 'utc' )
		);
		$current_date = DateTime::createFromFormat(
			'Y-m-d',
			$current_period,
			new DateTimeZone( 'utc' )
		);
		if ( $last_date && $current_date ) {
			$diff = $current_date->diff( $last_date );
			if ( $diff && $diff->days > 1 ) {
				for ( $i = 0; $i < $diff->days - 1; $i++ ) {
					$blanks[] = [
						'submissionCount' => 0,
						'period' => $last_date->add( new DateInterval( 'P1D' ) )->format( 'Y-m-d' ),
					];
				}
			}
		}
	} elseif ( $type === 'month' ) {
		// get last date
		$last_date = DateTime::createFromFormat(
			'Ymd',
			$last_period . '01',
			new DateTimeZone( 'utc' )
		);
		$current_date = DateTime::createFromFormat(
			'Ymd',
			$current_period . '01',
			new DateTimeZone( 'utc' )
		);
		if ( $last_date && $current_date ) {
			$diff = $current_date->diff( $last_date );
			$month_diff = $diff ? ( $diff->y * 12 + $diff->m ) : 0;
			if ( $month_diff > 1 ) {
				for ( $i = 0; $i < $month_diff - 1; $i++ ) {
					$blanks[] = [
						'submissionCount' => 0,
						'period' => $last_date->add( new DateInterval( 'P1M' ) )->format( 'Ym' ),
					];
				}
			}
		}
	} else {
		$current_year = intval( \substr( $current_period, 0, 4 ) );
		$current_week = intval( \substr( $current_period, 4 ) );
		$previous_year = intval( \substr( $last_period, 0, 4 ) );
		$previous_week = intval( \substr( $last_period, 4 ) );
		$last_date = new DateTime();
		$last_date->setISODate( $previous_year, $previous_week );
		$current_date = new DateTime();
		$current_date->setISODate( $current_year, $current_week );
		$diff = $current_date->diff( $last_date );
		if ( $diff && $diff->days > 7 ) {
			$week_diff = \floor( $diff->days / 7 );
			for ( $i = 0; $i < $week_diff - 1; $i++ ) {
				$blanks[] = [
					'submissionCount' => 0,
					'period' => $last_date->add( new DateInterval( 'P7D' ) )->format( 'YW' ),
				];
			}
		}
	}
	return $blanks;
}

/**
 * Get a DateTime format for JS ISO-8601 string.
 *
 * @return string
 */
function get_datetime_format_for_js_iso8601() : string {
	return 'Y-m-d\TH:i:s.u\Z';
}

/**
 * Get timestamp from a JavaScript ISO 8601 datetime format.
 *
 * @link https://stackoverflow.com/questions/14849446/php-parse-date-in-iso-format
 * @param string $input Date string input.
 * @return null|int NULL on failure, timestamp on success.
 */
function get_timestamp_from_js_iso_8601( string $input ) : ?int {
	$dt = DateTime::createFromFormat(
		get_datetime_format_for_js_iso8601(),
		$input
	);
	if ( ! $dt ) {
		return null;
	}
	return $dt->getTimestamp();
}
