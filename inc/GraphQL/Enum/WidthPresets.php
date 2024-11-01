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
 * Class for Width presets Enum.
 */
class WidthPresets extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'WidthPresetsEnum',
			'description' => __( 'Width presets.', 'wp-eform' ),
			'values' => [
				'FULL' => [
					'value' => 'full',
					'description' => __( 'Full Width.', 'wp-eform' ),
				],
				'MANUAL' => [
					'value' => 'manual',
					'description' => __( 'Manual Width.', 'wp-eform' ),
				],
				'HALF' => [
					'value' => 'half',
					'description' => __( '50% Width.', 'wp-eform' ),
				],
				'ONETHIRD' => [
					'value' => 'onethird',
					'description' => __( '33.33333% Width.', 'wp-eform' ),
				],
				'TWOTHIRD' => [
					'value' => 'twothird',
					'description' => __( '66.66666% Width.', 'wp-eform' ),
				],
				'ONEFOURTH' => [
					'value' => 'onefourth',
					'description' => __( '25% Width.', 'wp-eform' ),
				],
				'THREEFOURTH' => [
					'value' => 'threefourth',
					'description' => __( '75% Width.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
