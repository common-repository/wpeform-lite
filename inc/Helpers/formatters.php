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
 * @subpackage Helpers
 */

namespace WPEForm\Helpers;

/**
 * Format element position exception message. This loops through all position
 * indexes and joins them for a useful error message.
 *
 * @param   string|int $element_id              Element Id.
 * @param   array      $element_position_index  Element position index with type and id.
 *
 * @return  string
 */
function format_element_position_exception( $element_id, array $element_position_index ) : string {
	$str = 'Element::' . $element_id . ' is positioned in ';
	$pos_strs = [];
	foreach ( $element_position_index as $ei ) {
		$pos_strs[] = $ei['type'] . ' with id::' . $ei['id'];
	}
	return $str . \implode( ' and ', $pos_strs ) . '.';
}

/**
 * Format datetime based on Site settings.
 *
 * @param int  $timestamp The timestamp.
 * @param bool $gmt_offset Whether to include system GMT offset.
 * @param bool $spanned_time Whether to wrap the time inside a span. Mainly for style purpose.
 *
 * @return string Formatted datetime.
 */
function format_datetime( int $timestamp, bool $gmt_offset = true, bool $spanned_time = false ) {
	$offset = $gmt_offset
		? \floatval( \get_option( 'gmt_offset' ) ) * HOUR_IN_SECONDS
		: 0;

	return \date_i18n(
		\get_option( 'date_format' )
		. ' '
		. ( $spanned_time ? '\<\s\p\a\n\>' . \_x( '\a\t ', 'wpeform-datetime-separator', 'wp-eform' ) : '' )
		. \get_option( 'time_format' )
		. ( $spanned_time ? '\<\/\s\p\a\n\>' : '' ),
		$timestamp + $offset
	);
}

/**
 * Format number to a fixed decimal point.
 *
 * @param mixed $num Number to format.
 * @param int   $decimals Decimal point.
 * @return string Formatted number.
 */
function format_number( $num, int $decimals ) {
	return \number_format_i18n( $num, $decimals );
}

/**
 * Get a formatted string with hours, minutes and seconds from seconds.
 *
 * @param int $time Time in seconds.
 * @return string Formatted output.
 */
function format_time_from_seconds( int $time ) {
	$hours = \floor( $time / 3600 );
	$remaining = $time % 3600;
	$minutes = \floor( $remaining / 60 );
	$seconds = $remaining % 60;
	if ( $hours > 0 ) {
		return \sprintf(
			/* translators: %1$s is hours, %2$s is minutes, %3$s is seconds */
			\_x( '%1$s, %2$s, %3$s', 'format-time-from-seconds', 'wp-eform' ),
			\sprintf(
				/* translators: %d is replaced by hours */
				\_n( '%d hour', '%d hours', $hours, 'wp-eform' ),
				$hours
			),
			\sprintf(
				/* translators: %d is replaced by minutes */
				\_n( '%d minute', '%d minutes', $minutes, 'wp-eform' ),
				$minutes
			),
			\sprintf(
				/* translators: %d is replaced by seconds */
				\_n( '%d second', '%d seconds', $seconds, 'wp-eform' ),
				$seconds
			)
		);
	} elseif ( $minutes > 0 ) {
		return \sprintf(
			/* translators:%1$s is minutes, %2$s is seconds */
			\_x( '%1$s, %2$s', 'format-time-from-seconds', 'wp-eform' ),
			\sprintf(
				/* translators: %d is replaced by minutes */
				\_n( '%d minute', '%d minutes', $minutes, 'wp-eform' ),
				$minutes
			),
			\sprintf(
				/* translators: %d is replaced by seconds */
				\_n( '%d second', '%d seconds', $seconds, 'wp-eform' ),
				$seconds
			)
		);
	} else {
		return \sprintf(
			/* translators: %d is replaced by seconds */
			\_n( '%d second', '%d seconds', $seconds, 'wp-eform' ),
			$seconds
		);
	}
}

/**
 * Check if a string starts with another string.
 *
 * @param string $needle Starts with value.
 * @param string $haystack String to check.
 * @return bool
 */
function string_starts_with( string $needle, string $haystack ) : bool {
	return \mb_substr( $haystack, 0, \mb_strlen( $needle ) ) === $needle;
}

/**
 * Check if a string ends with another string.
 *
 * @param string $needle Ends with value.
 * @param string $haystack String to check.
 * @return bool
 */
function string_ends_with( string $needle, string $haystack ) : bool {
	$needle_count = \mb_strlen( $needle );
	$haystack_count = \mb_strlen( $haystack );
	if ( $needle_count > $haystack_count ) {
		return false;
	}

	return \mb_substr( $haystack, $haystack_count - $needle_count, $needle_count ) === $needle;
}

/**
 * Break a long string, with the given character.
 *
 * @param string $input Input string to break.
 * @param int    $length Length of the string after which to break parts.
 * @param string $break Break character, defaults to a newline.
 * @return string Broken string.
 */
function break_strings_with( string $input, int $length = 40, string $break = "\n" ) : string {
	$strlen = \mb_strlen( $input );
	if ( $strlen <= $length ) {
		return $input;
	}

	// else we divide the string up
	$divisions = \ceil( $strlen / $length );

	$parts = [];
	for ( $i = 0; $i < $divisions; $i++ ) {
		$parts[] = \mb_substr( $input, $i * $length, $length );
	}

	return \implode( $break, $parts );
}

/**
 * Shortens a number and attaches K, M, B, etc. accordingly.
 *
 * @link https://stackoverflow.com/a/35329932/2754557
 *
 * @param float      $number Number to format.
 * @param int        $precision Decimal precision, defaults to 2.
 * @param array|null $divisors Custom divisor. Check the implementation.
 * @return string Shortened and human readable number.
 */
function shorten_number( float $number, int $precision = 2, ?array $divisors = null ) {

	// Setup default $divisors if not provided
	if ( ! isset( $divisors ) ) {
			$divisors = [
				pow( 1000, 0 ) => '', // 1000^0 == 1
				pow( 1000, 1 ) => 'K', // Thousand
				pow( 1000, 2 ) => 'M', // Million
				pow( 1000, 3 ) => 'B', // Billion
				pow( 1000, 4 ) => 'T', // Trillion
				pow( 1000, 5 ) => 'Qa', // Quadrillion
				pow( 1000, 6 ) => 'Qi', // Quintillion
			];
	}

	// Loop through each $divisor and find the
	// lowest amount that matches
	foreach ( $divisors as $divisor => $shorthand ) {
		if ( abs( $number ) < ( $divisor * 1000 ) ) {
				// We found a match!
				break;
		}
	}

	// We found our match, or there were no matches.
	// Either way, use the last defined value for $divisor.
	return number_format( $number / $divisor, $precision ) . $shorthand;
}

/**
 * Get full name from possible first name and last name.
 *
 * @param null|string $f_name First name.
 * @param null|string $l_name Last name.
 * @return string Full name.
 */
function get_full_name( ?string $f_name, ?string $l_name ) : string {
	$name_parts = [];
	if ( $f_name ) {
		$name_parts[] = $f_name;
	}
	if ( $l_name ) {
		$name_parts[] = $l_name;
	}
	if ( empty( $name_parts ) ) {
		return \__( 'Anonymous', 'wp-eform' );
	}
	return \implode( ' ', $name_parts );
}
