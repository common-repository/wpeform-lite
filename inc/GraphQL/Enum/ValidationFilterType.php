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
 * Class for Validation filter type Enum.
 */
class ValidationFilterType extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'ValidationFilterTypeEnum',
			'description' => __( 'Validation filter type.', 'wp-eform' ),
			'values' => [
				'ALL' => [
					'value' => 'all',
					'description' => __( 'Accept all values.', 'wp-eform' ),
				],
				'PHONE' => [
					'value' => 'phone',
					'description' => __( 'Accept phone numbers.', 'wp-eform' ),
				],
				'URL' => [
					'value' => 'url',
					'description' => __( 'Accept proper URL or links.', 'wp-eform' ),
				],
				'EMAIL' => [
					'value' => 'email',
					'description' => __( 'Accept proper email address.', 'wp-eform' ),
				],
				'NUMBER' => [
					'value' => 'number',
					'description' => __( 'Accept integer or float.', 'wp-eform' ),
				],
				'INTEGER' => [
					'value' => 'integer',
					'description' => __( 'Accept integer only.', 'wp-eform' ),
				],
				'NONUMBER' => [
					'value' => 'nonumber',
					'description' => __( 'Everything except numbers.', 'wp-eform' ),
				],
				'NOLETTER' => [
					'value' => 'noletter',
					'description' => __( 'Everything except letters.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
