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
 * Class for Form Settings Limit On Login Enum.
 */
class FormSettingsLimitOnLogin extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormSettingsLimitOnLoginEnum',
			'description' => __( 'Form settings limit on login values.', 'wp-eform' ),
			'values' => [
				'NONE' => [
					'value' => 'none',
					'description' => __( 'No limitation based on logged in status.', 'wp-eform' ),
				],
				'LOGGED_IN' => [
					'value' => 'loggedin',
					'description' => __( 'Allow only logged in users.', 'wp-eform' ),
				],
				'LOGGED_OUT' => [
					'value' => 'loggedout',
					'description' => __( 'Allow only logged out users.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}