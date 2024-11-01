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
 * Class for Heading size Enum.
 */
class HeadingSize extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'HeadingSizeEnum',
			'description' => __( 'Heading size.', 'wp-eform' ),
			'values' => [
				'SIZE1' => [
					'value' => 'size1',
					'description' => __( 'Size 1.', 'wp-eform' ),
				],
				'SIZE2' => [
					'value' => 'size2',
					'description' => __( 'Size 2.', 'wp-eform' ),
				],
				'SIZE3' => [
					'value' => 'size3',
					'description' => __( 'Size 3.', 'wp-eform' ),
				],
				'SIZE4' => [
					'value' => 'size4',
					'description' => __( 'Size 4.', 'wp-eform' ),
				],
				'SIZE5' => [
					'value' => 'size5',
					'description' => __( 'Size 5.', 'wp-eform' ),
				],
				'SIZE6' => [
					'value' => 'size6',
					'description' => __( 'Size 6.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
