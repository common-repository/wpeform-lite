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
 * Class for Settings appearance control layout Enum.
 */
class SettingsAppearanceControlLayout extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'SettingsAppearanceControlLayoutEnum',
			'description' => __( 'Settings appearance control layout.', 'wp-eform' ),
			'values' => [
				'VERTICAL' => [
					'value' => 'vertical',
					'description' => __( 'Vertically align labels and controls.', 'wp-eform' ),
				],
				'HORIZONTAL' => [
					'value' => 'horizontal',
					'description' => __( 'Horizontally align labels and controls.', 'wp-eform' ),
				],
				'INLINE' => [
					'value' => 'inline',
					'description' => __( 'Put labels inline of controls.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}