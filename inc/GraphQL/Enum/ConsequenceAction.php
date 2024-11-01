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
 * @subpackage GraphQL\Enum
 */

namespace WPEForm\GraphQL\Enum;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\EnumType;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for consequence.
 */
class ConsequenceAction extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'ConsequenceActionEnum',
			'description' => __( 'Possible action in conditional logic consequence.', 'wp-eform' ),
			'values' => [
				'SHOW_FIELDS' => [
					'value' => 'show_fields',
					'description' => __( 'Show fields.', 'wp-eform' ),
				],
				'HIDE_FIELDS' => [
					'value' => 'hide_fields',
					'description' => __( 'Hide fields.', 'wp-eform' ),
				],
				'SET_VALUE_OF' => [
					'value' => 'set_value_of',
					'description' => __( 'Set value of a field.', 'wp-eform' ),
				],
				'SHOW_PAGES' => [
					'value' => 'show_pages',
					'description' => \__( 'Show pages', 'wp-eform' ),
				],
				'HIDE_PAGES' => [
					'value' => 'hide_pages',
					'description' => \__( 'Hide pages', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
