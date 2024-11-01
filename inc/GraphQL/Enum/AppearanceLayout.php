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
 * Class for Appearance Layout Enum.
 *
 * Used by "appearance.layout" of all elements.
 */
class AppearanceLayout extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'AppearanceLayoutEnum',
			'description' => __( 'Appearance layout of an EForm element.', 'wp-eform' ),
			'values' => [
				'VERTICAL' => [
					'value' => 'vertical',
					'description' => __( 'Label on top, control on bottom.', 'wp-eform' ),
				],
				'HORIZONTAL' => [
					'value' => 'horizontal',
					'description' => __( 'Label on left, control on right.', 'wp-eform' ),
				],
				'CENTERED' => [
					'value' => 'centered',
					'description' => __( 'Label on top center, control on bottom center.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
