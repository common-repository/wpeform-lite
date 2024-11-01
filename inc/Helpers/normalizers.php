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
 * Normalize a list of Ids. Use it to sanitize Id lists like Element children
 * or reference to a list of Ids, basically any array of Ids (string or int).
 *
 * It removes any items from the array which are not `string` or `int` and
 * discards the key of the array.
 *
 * @param   array $list  Original list of Ids. If not an array, then an empty
 *                       array is returned.
 *
 * @return  array        Normalized List of Ids.
 */
function normalize_id_list( $list ) : array {
	if ( ! is_array( $list ) ) {
		return [];
	}
	// we don't use array_filter because we need to have the indexes continuous
	$normalized_list = [];
	foreach ( $list as $id ) {
		if ( is_string( $id ) || is_int( $id ) ) {
			$normalized_list[] = $id;
		}
	}
	return $normalized_list;
}

/**
 * Normalizes a list of ids with `absint` for use directly in database
 * `IN ({$in})` queries.
 *
 * @param array $ids List of possible ids.
 * @return string
 */
function normalize_db_ids_for_in( array $ids ) : string {
	$normalized_ids = \array_map( 'absint', $ids );
	$in = \join( ',', $normalized_ids );
	return $in;
}
