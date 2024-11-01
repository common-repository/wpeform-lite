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

use WPEForm\Exception\ValidationException;

/**
 * Check if an list of items has unique Ids. It works agains elements, pools
 * etc, or for any array list, where the item of the list is an associative
 * array where the Id can be accessed with a `$key`.
 *
 * For example, the following `$lists` has unique Ids
 *
 * ```php
 * $arr_uniq = [
 *   [
 *     'id' => 'foo',
 *   ],
 *   [
 *     'id' => 'bar',
 *   ],
 * ];
 * ```
 *
 * But the following does not
 *
 * ```php
 * $arr_uniq = [
 *   [
 *     'id' => 'foo',
 *   ],
 *   [
 *     'id' => 'foo',
 *   ],
 * ];
 * ```
 *
 * @throws \LogicException If the associative array item does not have a value
 *                         for the provided `$key`.
 *
 * @param   array  $lists  Array list.
 * @param   string $key    Key for the associative array to access the Id.
 *
 * @return  bool           True if all the items in the list have unique Ids,
 *                         false otherwise.
 */
function validate_array_has_unique_ids( array $lists, string $key = 'id' ) : bool {
	// extract ids
	$ids = [];
	foreach ( $lists as $list ) {
		if ( ! isset( $list[ $key ] ) ) {
			throw new \LogicException( 'One of the array does not have provided key' );
		}
		$ids[] = $list[ $key ];
	}
	return count( $ids ) === count( array_unique( $ids ) );
}

/**
 * Validate a list of items, whose keys are `'id'`. This is mainly used to
 * validate customData of any integration class, coupons in payment general etc.
 *
 * This is a shortcut to throw a client aware exception on failed validation.
 *
 * @throws ValidationException If customData is not valid.
 *
 * @param array $lists customData list items.
 *
 * @return bool
 */
function validate_list_items_with_id_key( array $lists ) : bool {
	if ( ! validate_array_has_unique_ids( $lists, 'id' ) ) {
		throw new ValidationException( 'All items of a list must have unique Ids.' );
	}
	return true;
}

/**
 * Check if a value is an email. It uses PHP's built-in filter_var.
 * Also considers comma separated value.
 *
 * @param   string $maybe_email  Input variable.
 *
 * @return  bool          True if value is an email, false otherwise.
 */
function validate_is_email( string $maybe_email ) : bool {
	// return true if just empty
	if ( $maybe_email === '' ) {
		return true;
	}
	// split the email if needed
	$emails = \strpos( $maybe_email, ',' ) === false
		? [ $maybe_email ]
		: \explode( ',', $maybe_email );
	$is_valid = true;
	foreach ( $emails as $email ) {
		if ( ! \filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$is_valid = false;
			break;
		}
	}
	return $is_valid;
}

/**
 * Validate a possible color string.
 *
 * @param string $maybe_color The color input.
 * @return bool
 */
function validate_is_color_code( string $maybe_color ) : bool {
	// regex from https://github.com/zurb/foundation-sites/pull/10589/files#diff-37998d120faf57b3e7580109c8e306e2R562
	return ! ! \preg_match(
		'/^(#([0-9a-f]{3}|[0-9a-f]{6})|(rgb|hsl)a?\((-?\d+%?[,\s]+){2,3}\s*[\d\.]+%?\))$/i',
		$maybe_color
	);
}

/**
 * Checks if the input is an URL.
 *
 * @param string $input Input string.
 * @return bool True if is URL, false otherwise.
 */
function validate_is_url( string $input ) : bool {
	return \filter_var( $input, \FILTER_VALIDATE_URL );
}

/**
 * Validate a string value by inputs.
 *
 * @param string $input Collected value.
 * @param array  $filters Filters in validation config.
 *
 * @return string|null String, if there was some error, null otherwise.
 */
function validate_string_with_filters( string $input, array $filters ) : ?string {
	// error checks should work inline with filter type
	// and (minString, maxString) or (minNum, maxNum) combination
	// so first, let's check for individual type which would cause error due to
	// invalid value, not the min or max
	// if filter type is all, then there shouldn't be any error coming
	// if working with phone
	if ( $filters['type'] === 'phone' ) {
		// should only contain valid phone numebrs
		if ( ! \preg_match( '/^(\+)?[0-9\-\s]+$/i', $input ) ) {
			return __( 'Should be a valid phone number.', 'wp-eform' );
		}
		// might still need (minString, maxString)
	}

	// if working with URL
	if ( $filters['type'] === 'url' ) {
		if ( ! \filter_var( $input, \FILTER_VALIDATE_URL ) ) {
			return __( 'Should be a valid URL.', 'wp-eform' );
		}
	}

	// if working with email
	if ( $filters['type'] === 'email' ) {
		if ( ! \is_email( $input ) ) {
			return __( 'Should be a valid email.', 'wp-eform' );
		}
	}

	// if working with number
	if ( $filters['type'] === 'number' ) {
		// could be integer or float, also negative
		if ( ! \preg_match( '/^(\-)?([0-9]*)?(\.)?([0-9]*)?$/', $input ) ) {
			return __( 'Should be a valid number.', 'wp-eform' );
		}
	}

	// if working with integer
	if ( $filters['type'] === 'integer' ) {
		// could be positive or negative integer
		if ( ! \preg_match( '/^(\-)?([0-9]+)$/', $input ) ) {
			return __( 'Should be a valid integer.', 'wp-eform' );
		}
	}

	// if working with no number
	if ( $filters['type'] === 'nonumber' ) {
		if ( \preg_match( '/([0-9]+)/i', $input ) ) {
			return __( 'Should not include numbers.', 'wp-eform' );
		}
	}

	// if working with noletter
	if ( $filters['type'] === 'noletter' ) {
		if ( \preg_match( '/([a-zA-Z]+)/', $input ) ) {
			return __( 'Should not include letters.', 'wp-eform' );
		}
	}

	// check for minString and maxString
	// but not in case of numbers
	if ( ! \in_array(
		$filters['type'],
		[ 'number', 'integer' ]
	) ) {
		$min_string = $filters['minString'];
		$max_string = $filters['maxString'];
		if (
			$min_string !== null
			&& $min_string !== 0
			&& \mb_strlen( $input ) < $min_string
		) {
			return \sprintf(
				/* translators: %d is string length */
				__( 'A minimum of %d string length is required.', 'wp-eform' ),
				$min_string
			);
		}
		if (
			$max_string !== null
			&& $max_string !== 0
			&& \mb_strlen( $input ) > $max_string
		) {
			return \sprintf(
				/* translators: %d is string length */
				__( 'A maximum of %d string length is allowed.', 'wp-eform' ),
				$max_string
			);
		}
	} else {
		// check for maxNum and minNum
		$min_num = (float) $filters['minNum'];
		$max_num = (float) $filters['maxNum'];
		$value = (float) $input;

		if (
			$filters['minNum'] !== ''
			&& $filters['minNum'] !== null
			&& $min_num !== null
			&& $value < $min_num
		) {
			return \sprintf(
				/* translators: %d is minimum value */
				__( 'A minimum value of %d is required.', 'wp-eform' ),
				$min_num
			);
		}

		if (
			$filters['maxNum'] !== ''
			&& $filters['maxNum'] !== null
			&& $max_num !== null
			&& $value > $max_num
		) {
			return \sprintf(
				/* translators: %d is maximum value */
				__( 'A maximum value of %d is allowed.', 'wp-eform' ),
				$max_num
			);
		}
	}

	// everything checks out
	return null;
}

/**
 * Validate score condition with boolean input and compare parameter.
 *
 * @param bool   $input Input from user.
 * @param string $condition Condition from EventComparison enum.
 * @param bool   $compare_with Compare with value.
 * @return bool
 */
function validate_score_condition_with_boolean( bool $input, string $condition, bool $compare_with ) : bool {
	$is_valid = false;

	switch ( $condition ) {
		case 'et':
			if ( $input === $compare_with ) {
				$is_valid = true;
			}
	}

	return $is_valid;
}

/**
 * Validate Score condition (from enum EventComparison) with respect to a float
 * value.
 *
 * Returns true if satisfies condition, false otherwise.
 *
 * @param float  $input User input data.
 * @param string $condition Condition from EventComparison enum.
 * @param float  $compare_with Compare with value.
 * @return bool
 */
function validate_score_condition_with_float( float $input, string $condition, float $compare_with ) : bool {
	$is_valid = false;

	// check the condition and based on that determine whether it is valid
	// for our data or not
	switch ( $condition ) {
		case 'et':
			// would be valid if
			// input equals compare with
			if ( $input === $compare_with ) {
				$is_valid = true;
			}
			break;
		case 'gt':
			if ( $input > $compare_with ) {
				$is_valid = true;
			}
			break;
		case 'lt':
			if ( $input < $compare_with ) {
				$is_valid = true;
			}
			break;
	}

	return $is_valid;
}

/**
 * Get score condition with datetime comparison.
 *
 * @param string $input User input.
 * @param string $condition Condition.
 * @param string $compare_with Compare with value.
 * @return bool
 */
function validate_score_condition_with_datetime( string $input, string $condition, string $compare_with ) : bool {
	$is_valid = false;

	$input_date = get_mysql_datetime_from_user_input( $input );
	// check for possible formula in $compare_with
	$comparison_date = parse_possible_formula_in_datetime_input( $compare_with );
	if ( ! $input_date || ! $comparison_date ) {
		return false;
	}

	$comparison = compare_dates( $input_date, $comparison_date );
	// if invalid, then bail
	if ( $comparison === null ) {
		return false;
	}
	// check the condition and based on that determine whether it is valid
	// for our data or not
	switch ( $condition ) {
		case 'et':
			// would be valid if
			// input equals compare with
			if ( $comparison === 0 ) {
				$is_valid = true;
			}
			break;
		case 'gt':
			if ( $comparison === 1 ) {
				$is_valid = true;
			}
			break;
		case 'lt':
			if ( $comparison === -1 ) {
				$is_valid = true;
			}
			break;
	}

	return $is_valid;
}

/**
 * Safely check whether a string contains another string.
 *
 * @param string $haystack Haystack to search within.
 * @param string $needle Needle to search for.
 * @return bool
 */
function validate_string_contains( string $haystack, string $needle ) : bool {
	if ( $needle === '' ) {
		return true;
	}
	if ( $haystack === '' ) {
		return false;
	}
	return \mb_strpos( $haystack, $needle ) !== false;
}

/**
 * Validate Score condition (from enum EventComparison) with respect to a string
 * value.
 *
 * Returns true if satisfies condition, false otherwise.
 *
 * @param string $input User input data.
 * @param string $condition Condition from EventComparison enum.
 * @param string $compare_with Compare with value.
 *
 * @return bool
 */
function validate_score_condition_with_string( string $input, string $condition, string $compare_with ) : bool {
	$is_valid = false;

	// lowercase both input and compare_with
	$input = \mb_strtolower( $input );
	$compare_with = \mb_strtolower( $compare_with );

	// check the condition and based on that determine whether it is valid
	// for our data or not
	switch ( $condition ) {
		case 'et':
			// would be valid if
			// input equals compare with
			if ( $input === $compare_with ) {
				$is_valid = true;
			}
			break;
		case 'ct':
			// would be valid if we can find compare_value in input
			$is_valid = validate_string_contains( $input, $compare_with );
			break;
		case 'gt':
			if ( \floatval( $input ) > \floatval( $compare_with ) ) {
				$is_valid = true;
			}
			break;
		case 'lt':
			if ( \floatval( $input ) < \floatval( $compare_with ) ) {
				$is_valid = true;
			}
			break;
		case 'sw':
			if (
				\preg_match(
					'/^' . \preg_quote( $compare_with, '/' ) . '/im',
					$input
				)
			) {
				$is_valid = true;
			}
			break;
		case 'ew':
			if (
				\preg_match(
					'/' . \preg_quote( $compare_with, '/' ) . '$/im',
					$input
				)
			) {
				$is_valid = true;
			}
			break;
	}

	return $is_valid;
}

/**
 * Validate selected items with respect to filters. Works for checkboxes and
 * dropdowns and any similar items.
 *
 * @param array $filters Filters as stored in Config. Should correspond to
 *                       GraphQL filters Type.
 * @param array $selected Selected items in array.
 *
 * @return string|null Error message if needed, null if all okay.
 */
function validate_selected_items_with_filters( array $filters, array $selected ) : ?string {
	// is invalid if selected length is less than minItems
	$min_items = $filters['minItems'];
	if (
		$min_items !== 0
		&& $min_items !== null
		&& count( $selected ) < $min_items
	) {
		return sprintf(
			/* translators: %d is number of checboxes. */
			\_n(
				'A minimum of %d item is required',
				'A minimum of %d items are required.',
				$min_items,
				'wp-eform'
			),
			$min_items
		);
	}

	// is invalid if selected length is greater than maxItems
	$max_items = $filters['maxItems'];
	if (
		$max_items !== 0
		&& $max_items !== null
		&& count( $selected ) > $max_items
	) {
		return sprintf(
			/* translators: %d is number of checboxes. */
			\_n(
				'A maximum of %d item is allowed',
				'A maximum of %d items are allowed.',
				$max_items,
				'wp-eform'
			),
			$max_items
		);
	}

	return null;
}

/**
 * Validate Score condition with selected items. Useful for checkboxes and
 * dropdowns and such.
 *
 * @param array $condition Score condition, matching GraphQL Score.
 * @param array $selected List of selected items.
 * @param bool  $is_single Whether or not comparison should be done with a single item.
 *
 * @return bool True if condition validates, false otherwise.
 */
function validate_score_with_conditions_and_items( array $condition, array $selected, bool $is_single = false ) : bool {
	$is_valid = false;
	$compare_with = ! empty( $condition['compareWith'] )
		? \explode( ',', $condition['compareWith'] )
		: [];
	if ( $is_single ) {
		$compare_with = empty( $compare_with ) ? [] : [ $compare_with[0] ];
	}

	$all_selected_in_compare_with = every_item_in_array(
		$compare_with, function( $val ) use ( $selected ) {
			return \in_array( $val, $selected );
		}
	);

	// check the condition and based on that determine whether it is valid
	// for our data or not
	switch ( $condition['condition'] ) {
		case 'et':
			// would be valid if
			// 1. selected has only one value and
			// 2. we can find compare_value in selected
			if (
				count( $selected ) === \count( $compare_with )
				&& $all_selected_in_compare_with
			) {
				$is_valid = true;
			}
			break;
		case 'ct':
			// would be valid if we can find compare_value in selected
			if ( $all_selected_in_compare_with ) {
				$is_valid = true;
			}
			break;
			// no other cases, because that's what the UI would suggest
	}

	return $is_valid;
}

/**
 * Check whether a filename has some funny characters which could lead to
 * exploits. Always use this to determine validity of userinput filenames.
 *
 * @param string $filename Input filename.
 * @return bool true if it is exploitable, false if not.
 */
function validate_is_exploitable_filename( string $filename ) : bool {
	return ! \preg_match( '/^[\w\- ]+$/', $filename );
}
