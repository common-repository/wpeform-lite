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

use WPEForm\Util\SlateJS;
use Exception;

/**
 * Get one single option config value for MCQ elements.
 *
 * It is directly compatible with `FormElementConfigMcqOptionType` GraphQL Type.
 *
 * @param int         $position Position of the option, used to create the label.
 * @param string|null $id ID of the option. If null, one is generated automatically.
 *
 * @return array
 */
function get_random_element_option_value( int $position, ?string $id = null ) : array {
	return [
		'id' => $id ?? uuid4(),
		/* translators: %d is replaced by position */
		'label' => sprintf( __( 'Option %d', 'wp-eform' ), $position ),
		'answerDescription' => null,
		'num' => null,
	];
}

/**
 * Get a list of options for elements config.
 *
 * It generates the list only once, no matter how many times it has been
 * called. The reason is, for some weird reason, PHPUnit seems to loose track
 * of instances in Elements factory. So this function is getting called multiple
 * times for the same element, which shouldn't happen. Maybe it is a PCOV thing,
 * I am not sure at this point. But this works now™️.
 *
 * @param int $num Total number of items in list.
 *
 * @return array
 */
function get_list_of_element_options( int $num = 4 ) : array {
	static $options = [];
	if ( empty( $options ) ) {
		for ( $i = 0; $i < $num; $i++ ) {
			\array_push( $options, get_random_element_option_value( $i + 1 ) );
		}
	}
	return $options;
}

/**
 * Generate UUID v4 compatible string.
 *
 * @return string
 */
function uuid4() : string {
	$data = \random_bytes( 16 );

	$data[6] = \chr( \ord( $data[6] ) & 0x0f | 0x40 ); // set version to 0100
	$data[8] = \chr( \ord( $data[8] ) & 0x3f | 0x80 ); // set bits 6-7 to 10

	return vsprintf( '%s%s-%s-%s-%s-%s%s%s', \str_split( \bin2hex( $data ), 4 ) );
}

/**
 * Get default value of element attributes configuration.
 *
 * Maps directly with `FormElementConfigAttributesType` and
 * `FormElementConfigAttributesInput` GraphQL Type and Input.
 *
 * @param string $default_value Default value, default ''.
 * @return array
 */
function get_default_element_config_attributes( string $default_value = '' ) : array {
	return [
		'prefilType' => 'none',
		'prefilParameter' => '',
		'readonly' => false,
		'defaultValue' => $default_value,
	];
}

/**
 * Get default value for element validation filters configuration.
 *
 * Maps directly with `FormElementConfigFiltersType` and
 * `FormElementConfigFiltersInput` GraphQL Type and Input.
 *
 * @return array
 */
function get_default_element_config_filters() : array {
	return [
		'type' => 'all',
		'minNum' => null,
		'maxNum' => null,
		'minString' => null,
		'maxString' => null,
		'minItems' => null,
		'maxItems' => null,
	];
}

/**
 * Get default value for element validation masks configuration.
 *
 * Maps directly with `FormElementConfigMasksType` and
 * `FormElementConfigMasksInput` GraphQL Type and Input.
 *
 * @return array
 */
function get_default_element_config_masks() : array {
	return [
		'maskType' => 'none',
		'maskPreset' => null,
		'maskString' => null,
		'maskRegExps' => [],
		'placeholder' => '_',
		'alwaysShowMask' => false,
	];
}

/**
 * Get default value form score lists.
 *
 * Maps directly with list of `FormScoreItemType` and `FormScoreItemInput`
 * GraphQL Type and Input.
 *
 * @return array
 */
function get_default_settings_scorelists() : array {
	return [
		[
			'id' => 'default-score',
			'name' => __( 'Primary Score', 'wp-eform' ),
			'color' => '#6002ee',
			'outcomeName' => __( 'Quiz Performance', 'wp-eform' ),
			'outcomeDescription' => __( 'The higher the score the better the result.', 'wp-eform' ),
		],
	];
}

/**
 * Get default value for form element score config.
 *
 * Maps directly with `FormElementConfigScoreType` and
 * `FormElementConfigScoreInput` GraphQL Type and Input.
 *
 * @return array
 */
function get_default_element_score() : array {
	return [
		'scoreConditions' => [],
	];
}

/**
 * Get a sample button for buttons Element.
 *
 * @param string      $label Label of the button.
 * @param string      $link Link of the button.
 * @param string      $icon Icon of the button.
 * @param string|null $iconPosition Position of icon. Either 'before' or 'after'.
 * @param string|null $id ID of the button.
 *
 * @return array
 */
function get_default_buttons_button(
	string $label,
	string $link,
	string $icon = '',
	?string $iconPosition = 'before',
	?string $id = null
) : array {
	return [
		'id' => $id ?? uuid4(),
		'icon' => $icon,
		'iconPosition' => $iconPosition,
		'label' => $label,
		'link' => $link,
	];
}

/**
 * Get default set of buttons.
 *
 * @param string $type Type of value, could be 'default' or 'enum'.
 *
 * @return array
 */
function get_default_buttons_buttons( $type = 'default' ) : array {
	static $buttons = [];
	if ( empty( $buttons[ $type ] ) ) {
		// add previous button
		$buttons[ $type ][] = get_default_buttons_button(
			__( 'Previous', 'wp-eform' ),
			'#wpeform-prev',
			'fas fa-chevron-left',
			$type === 'default' ? 'before' : 'BEFORE'
		);
		// add save button
		$buttons[ $type ][] = get_default_buttons_button(
			__( 'Submit', 'wp-eform' ),
			'#wpeform-submit',
			'fas fa-save',
			$type === 'default' ? 'before' : 'BEFORE'
		);
		// add next button
		$buttons[ $type ][] = get_default_buttons_button(
			__( 'Next', 'wp-eform' ),
			'#wpeform-next',
			'fas fa-chevron-right',
			$type === 'default' ? 'after' : 'AFTER'
		);
	}

	return $buttons[ $type ];
}

/**
 * Get matching options ids from metavalue. Useful for getting values for
 * checkbox, dropdown etc.
 *
 * @param string $metadata The metadata as retrieved from WP system.
 * @param array  $options Options list. Must be of type MCQOption[].
 * @return array Array of matched option ids, empty array if no matches found.
 */
function get_matching_options_ids_from_metavalue( string $metadata, array $options ) : array {
	$compare_values = \explode(
		"\n",
		\str_replace(
			"\r\n",
			"\n",
			\mb_strtolower( $metadata )
		)
	);
	$possible_meta_values = [];
	if ( ! empty( $compare_values ) ) {
		foreach ( $options as $op ) {
			try {
				$op_value = SlateJS::parseEditorChildrenJSON( $op['label'] )->getText(
					'singleline',
					null,
					false
				);
				if ( \in_array( \mb_strtolower( $op_value ), $compare_values ) ) {
					$possible_meta_values[] = $op['id'];
				}
			} catch ( Exception $e ) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
				// do nothing
			}
		}
	}

	return $possible_meta_values;
}

/**
 * Get default value for custom items in rating element.
 * It matches with FormElementRatingItem GraphQL Type.
 *
 * @return array
 */
function get_custom_rating_items_list() : array {
	return [
		[
			'itemId' => '1',
			'icon' => 'fas fa-thermometer-empty',
		],
		[
			'itemId' => '2',
			'icon' => 'fas fa-thermometer-quarter',
		],
		[
			'itemId' => '3',
			'icon' => 'fas fa-thermometer-half',
		],
		[
			'itemId' => '4',
			'icon' => 'fas fa-thermometer-three-quarters',
		],
		[
			'itemId' => '5',
			'icon' => 'fas fa-thermometer-full',
		],
	];
}
