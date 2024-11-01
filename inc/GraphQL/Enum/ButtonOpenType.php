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
 * Class for Button open type Enum.
 */
class ButtonOpenType extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'ButtonOpenTypeEnum',
			'description' => __( 'Button open type.', 'wp-eform' ),
			'values' => [
				'SELF' => [
					'value' => 'self',
					'description' => __( 'Open in current window/tab.', 'wp-eform' ),
				],
				'BLANK' => [
					'value' => 'blank',
					'description' => __( 'Open in new window/tab.', 'wp-eform' ),
				],
				'POPUP' => [
					'value' => 'popup',
					'description' => __( 'Open in popup window/tab.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
