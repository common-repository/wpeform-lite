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

use Exception;
use WPEForm\GraphQL\Resolver\User;

/**
 * Get default update log entry.
 *
 * Useful for parsing.
 * ```php
 * $new_entry = [
 *      'i' => '0', // user id
 *      'n' => \__( 'deleted', 'wp-eform' ), // user name
 *      'd' => \current_time( 'mysql', true ), // datetime
 *  ]
 * ```
 *
 * @return array
 */
function get_default_update_log_entry() : array {
	return [
		'i' => 0,
		'd' => '2021-05-01 12:00:00',
	];
}

/**
 * Parse an update log.
 *
 * @param string|mixed $update_log Update log entry, stringified by json.
 * @return null|array Null if invalid record, array if valid.
 */
function parse_update_log( $update_log ) : ?array {
	$default = get_default_update_log_entry();
	$needed_keys = \array_keys( $default );
	if ( ! \is_string( $update_log ) ) {
		return null;
	}
	try {
		$log = \json_decode( $update_log, true );
		if ( $log && \is_array( $log ) ) {
			// make sure all array key exists
			$is_valid = true;
			foreach ( $needed_keys as $key ) {
				if ( ! \array_key_exists( $key, $log ) ) {
					$is_valid = false;
				}
			}
			if ( $is_valid ) {
				$log = parse_args(
					$log,
					get_default_update_log_entry()
				);
				return $log;
			}
		}
	} catch ( Exception $e ) {
		// do nothing
	}
	return null;
}

/**
 * Sort update logs by date in descending order.
 *
 * @param array $update_logs Update log entries.
 * @return array Sorted logs.
 */
function sort_update_logs( array $update_logs ) : array {
	// sort the update logs
	\usort(
		$update_logs,
		function( $a, $b ) {
			$t1 = get_timestamp_from_mysql_formatted_datetime( $a['d'] );
			$t2 = get_timestamp_from_mysql_formatted_datetime( $b['d'] );
			// if it is not possible to compare, then keep side by side
			if ( $t1 === false && $t2 === false ) {
				return 0;
			}
			// else push the non deterministic down
			if ( $t1 === false ) {
				return 1;
			}
			if ( $t2 === false ) {
				return -1;
			}
			return $t2 - $t1;
		}
	);

	return $update_logs;
}

/**
 * Parse and sort update logs by date in descending order.
 *
 * @param array $logs Entry of json_encoded logs.
 * @return array Sorted logs.
 */
function parse_and_sort_update_logs( array $logs ) : array {
	// parse the update logs
	$update_logs = [];
	foreach ( $logs as $log ) {
		$record = parse_update_log( $log );
		if ( $record ) {
			$update_logs[] = $record;
		}
	}

	return sort_update_logs( $update_logs );
}

/**
 * Encode update logs for storage in database.
 *
 * @param array $update_logs Fully featured update logs.
 * @return array Encoded, storage friendly update logs.
 */
function encode_update_logs( array $update_logs ) : array {
	$encoded_logs = [];
	foreach ( $update_logs as $log ) {
		$encoded_logs[] = \json_encode( $log );
	}
	return $encoded_logs;
}

/**
 * Convert DB stored update logs to match the GraphQL Type.
 *
 * @param array $db_logs DB stored logs.
 * @return array GraphQL Type compatible output.
 */
function convert_db_update_logs_to_graphql( array $db_logs ) : array {
	$update_logs = [];
	$parsed_logs = parse_and_sort_update_logs( $db_logs );
	foreach ( $parsed_logs as $log ) {
		// this is already sorted and parsed, so just match the array
		// keys with Type
		$user = User::get_user_by_id( (int) $log['i'] );
		$update_logs[] = [
			'userId' => $log['i'],
			'userName' => $user['username'],
			'updateDate' => $log['d'],
		];
	}
	return $update_logs;
}
