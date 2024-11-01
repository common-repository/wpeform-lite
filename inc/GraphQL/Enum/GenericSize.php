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
 * Class for Generic size Enum.
 */
class GenericSize extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'GenericSizeEnum',
			'description' => __( 'Generic size.', 'wp-eform' ),
			'values' => [
				'SMALL' => [
					'value' => 'small',
					'description' => __( 'Small Size.', 'wp-eform' ),
				],
				'DEFAULT' => [
					'value' => 'default',
					'description' => __( 'Default Size.', 'wp-eform' ),
				],
				'LARGE' => [
					'value' => 'large',
					'description' => __( 'Large Size.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
