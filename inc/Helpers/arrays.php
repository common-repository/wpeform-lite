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
 * A helper function which will return true if all elements in the
 * results array are truthy.
 *
 * @param array $results Array of results.
 * @return bool True if all elements of the array are truthy, false otherwise.
 */
function return_if_all_true_in_array( array $results ): bool {
	if ( in_array( false, $results ) ) {
		return false;
	}
	return true;
}

/**
 * Check if an array is sequential or not.
 *
 * It does not confirm that the array is associative. A sequential array is just
 * when the keys are in order, starting from 0.
 *
 * @param array $arr Input array.
 * @return boolean True if it is sequential, False otherwise.
 */
function is_sequential_array( array $arr ) : bool {
	return \array_keys( $arr ) === \range( 0, count( $arr ) - 1 );
}

/**
 * Convert array values to integers.
 *
 * @param array $input Input array.
 *
 * @return array
 */
function convert_array_values_to_int( array $input ) : array {
	return \array_map( 'intval', $input );
}

/**
 * Parses argument with respect to the provided defaults. The defaults cannot
 * be a sequential array.
 *
 * This is better than wp_parse_args because it recursively checks for all
 * variables within an array and replaces accordingly. Works very well for
 * multilevel associative array and also perfectly handles the SDA UI from
 * the library.
 *
 * Use this when saving data from $this->post
 *
 * This also rejects all variables within $args which are not present in
 * $defaults
 *
 * @param     array   $args        The original arguments array.
 * @param     array   $defaults    The default arguments array.
 * @param     boolean $merge_only  If true, then for boolean types, the
 *                                 original value will be assigned if not
 *                                 present. If false, then for boolean
 *                                 types, false would be assigned.
 *                                 For sequential numeric array, if true
 *                                 the default will be copied if original
 *                                 is empty. For false, empty array will be
 *                                 assigned in the same case.
 *
 * @return     array    Merged and sanitized array
 */
function parse_args( array $args, array $defaults, bool $merge_only = true ) : array {
	$fresh = [];
	foreach ( (array) $defaults as $d_key => $d_val ) {
		if ( \is_array( $d_val ) ) {
			// list of items are usually empty in defaults
			if ( empty( $d_val ) ) {
				$fresh[ $d_key ] = isset( $args[ $d_key ] ) ? $args[ $d_key ] : [];
			} else {
				// If sequential numeric array, then just replace
				if ( is_sequential_array( $d_val ) ) {
					$fresh[ $d_key ] = isset( $args[ $d_key ] )
						? $args[ $d_key ]
						: ( $merge_only ? $d_val : array() );
					// but the new ones can be of associative array and can have
					// some new keys into it
					if (
						isset( $d_val[0] )
						&& \is_array( $d_val[0] )
						&& ! empty( $fresh[ $d_key ] )
					) {
						foreach ( $fresh[ $d_key ] as $f_key => $f_val ) {
							$fresh[ $d_key ][ $f_key ] = parse_args(
								$f_val,
								// merge with the first default only because we are only
								// after the shape here.
								$d_val[0],
								$merge_only
							);
						}
					}
				} else {
					// Associative array, so look into it
					$new_args = isset( $args[ $d_key ] ) ? $args[ $d_key ] : array();
					$fresh[ $d_key ] = parse_args( $new_args, $d_val, $merge_only );
				}
			}
		} elseif ( \is_bool( $d_val ) ) {
				$fresh[ $d_key ] = isset( $args[ $d_key ] )
					? (bool) $args[ $d_key ]
					: ( $merge_only ? $d_val : false );
		} elseif ( $d_key === 'id' && \is_string( $d_val ) ) {
			// some special consideration for parsing Id.
			// if Id is not present, then simply create one using uniqid
			$fresh[ $d_key ] = $args[ $d_key ] ?? \uniqid();
		} elseif ( \is_int( $d_val ) ) {
			// cast it to integer
			$fresh[ $d_key ] = \intval( $args[ $d_key ] ?? $d_val );
		} elseif ( \is_float( $d_val ) ) {
			// cast it to float
			$fresh[ $d_key ] = \floatval( $args[ $d_key ] ?? $d_val );
		} elseif ( \is_string( $d_val ) ) {
			// cast it to string
			$fresh[ $d_key ] = \strval( $args[ $d_key ] ?? $d_val );
		} else {
			$fresh[ $d_key ] = $args[ $d_key ] ?? $d_val;
		}
	}
	return $fresh;
}

/**
 * Remove unaccepted items from an associative array. It doesn't check if
 * all the items from the accepted keys are present or not. It just removes
 * items whose keys are not in accepted_keys.
 *
 * @param array $data Original data array.
 * @param array $accepted_keys List of accepted keys.
 *
 * @return array
 */
function remove_unaccepted_items( array $data, array $accepted_keys ) : array {
	$new_data = [];
	foreach ( $data as $key => $val ) {
		if ( \in_array( $key, $accepted_keys ) ) {
			$new_data[ $key ] = $val;
		}
	}
	return $new_data;
}

/**
 * Get an item from an indexed array by it's Id.
 *
 * If you have a haystack of associative array and want to lookup a particular
 * one by it's id, then use this function. It will return null if none was
 * found.
 *
 * @param array  $haystack The elements pool.
 * @param string $id The id of the element to look.
 * @param string $lookup Lookup key of the inner associative array.
 *
 * @return array|null
 */
function get_element_from_array_by_id( array $haystack, string $id, string $lookup = 'id' ) : ?array {
	foreach ( $haystack as $item ) {
		if ( $item[ $lookup ] === $id ) {
			return $item;
		}
	}
	return null;
}

/**
 * Rearrange elements of an array by comparing the order from the source. Useful
 * to rearrange selected options by original options order, instead of the one
 * taken by user.
 *
 * This also removes any item not found in the original source.
 *
 * @param array  $haystack Original source.
 * @param array  $elements Elements to rearrange.
 * @param string $lookup Lookup in original source.
 *
 * @return array Rearrange array.
 */
function rearrange_elements_from_source_by_id( array $haystack, array $elements, string $lookup = 'id' ) : array {
	$result = [];
	foreach ( $haystack as $item ) {
		if ( \in_array( $item[ $lookup ], $elements ) ) {
			$result[] = $item[ $lookup ];
		}
	}
	return $result;
}

/**
 * Extract Ids from an array of items. The haystack should be an indexed array
 * where each of the items would be another associative array with the `$lookup`
 * present in it.
 *
 * @param array  $haystack Array of items.
 * @param string $lookup Key of the inner associative array where the Id resides.
 *
 * @return array
 */
function extract_ids( array $haystack, string $lookup = 'id' ) : array {
	$extracted_data = [];
	foreach ( $haystack as $item ) {
		if ( isset( $item[ $lookup ] ) ) {
			$extracted_data[] = $item[ $lookup ];
		}
	}
	return $extracted_data;
}

/**
 * Convert a dictionary type associative array to a list of associative
 * array.
 *
 * It will insert one new field in the inner array, by `$id_key`, which will
 * copy over the key of parent array.
 *
 * @param array  $dict_items Original dictionary items.
 * @param string $id_key Name of the key where we insert the Id.
 *
 * @return array List array.
 */
function convert_dictionary_to_list( array $dict_items, string $id_key = 'id' ) : array {
	$list = [];
	foreach ( $dict_items as $dict_id => $dict ) {
		$list[] = \array_merge(
			$dict, [
				"{$id_key}" => $dict_id,
			]
		);
	}

	return $list;
}

/**
 * Convert a list to dictionary for easy lookup.
 *
 * Given an input of
 *
 * ```php
 * $arr = [
 *   [
 *     'id' => 'id-1',
 *     'key' => 'val1',
 *   ],
 *   [
 *     'id' => 'id-2',
 *     'key' => 'val2',
 *   ],
 * ];
 * ```
 *
 * This will give the following output
 *
 * ```php
 * $output = [
 *   'id-1' => [
 *     'id' => 'id-1',
 *     'key' => 'val1',
 *   ],
 *   'id-2' => [
 *     'id' => 'id-2',
 *     'key' => 'val2',
 *   ],
 * ];
 * ```
 *
 * @param array  $list Original list (sequential array).
 * @param string $id_key Key of ID lookup.
 *
 * @return array
 */
function convert_list_to_dictionary( array $list, string $id_key = 'id' ) : array {
	$dictionary = [];
	foreach ( $list as $item ) {
		$dictionary[ $item[ $id_key ] ] = $item;
	}

	return $dictionary;
}

/**
 * Merge non empty items into a resulting sequential array. Kind of like
 * JavaScript's array.map(Boolean). But it relies on PHP's `empty` to determine
 * whether or not include the item. So anything `empty`, like `''`, `[]`, `false`
 * will not be included.
 *
 * @param array ...$array_items Items, variable arguments.
 *
 * @return array
 */
function merge_non_empty_items( ...$array_items ) : array {
	$result = [];
	foreach ( $array_items as $arr ) {
		if ( ! empty( $arr ) ) {
			$result[] = $arr;
		}
	}
	return $result;
}

/**
 * Checks that every item in an array passes the validator. Equivalent of
 * JavaScript's Array.prototype.every.
 *
 * @param array    $array Array to check.
 * @param callable $validator Validator callback function.
 * @return bool True if all items in the array passes, false otherwise.
 */
function every_item_in_array( array $array, callable $validator ) {
	foreach ( $array as $item ) {
		if ( ! $validator( $item ) ) {
			return false;
		}
	}
	return true;
}

/**
 * Checks that some items in an array passes the validator. Equivalent of
 * JavaScript's Array.prototype.some.
 *
 * @param array    $array Array to check.
 * @param callable $validator Validator callback function.
 * @return bool True if at-least one item in the array passes, false otherwise.
 */
function some_items_in_array( array $array, callable $validator ) {
	foreach ( $array as $item ) {
		if ( $validator( $item ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Find the index of an item in an array by the filter function. This works
 * like JavaScript array.prototype.findIndex.
 *
 * @param array    $input Input array.
 * @param callable $filter Filter function. Gets the item and index as arguments.
 * @return null|int Index on success, null on failure.
 */
function find_index_in_array( array $input, callable $filter ) : ?int {
	foreach ( $input as $key => $val ) {
		$output = $filter( $val, $key );
		if ( $output === true ) {
			return $key;
		}
	}
	return \null;
}

/**
 * Find the item of an item in an array by the filter function. This works
 * like JavaScript array.prototype.find.
 *
 * @param array    $input Input array.
 * @param callable $filter Filter function. Gets the item and index as arguments.
 * @return null|mixed Item on success, null on failure.
 */
function find_item_in_array( array $input, callable $filter ) {
	foreach ( $input as $key => $val ) {
		$output = $filter( $val, $key );
		if ( $output === true ) {
			return $val;
		}
	}
	return \null;
}

/**
 * Combine wpackio assets into a single asset manifest.
 *
 * @param array ...$assetss Array of asset arrays.
 * @return array Combined assets array.
 */
function combine_wpackio_assets( ...$assetss ) : array {
	$combined_assets = [
		'js' => [],
		'css' => [],
	];
	foreach ( $assetss as $assets ) {
		$combined_assets['js'] = \array_merge(
			$combined_assets['js'],
			$assets['js'] ?? []
		);
		$combined_assets['css'] = \array_merge(
			$combined_assets['css'],
			$assets['css'] ?? []
		);
	}
	return $combined_assets;
}
