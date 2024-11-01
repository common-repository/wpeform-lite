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
 * Class for Heading tag Enum.
 */
class HeadingTag extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'HeadingTagEnum',
			'description' => __( 'Heading tag.', 'wp-eform' ),
			'values' => [
				'H1' => [
					'value' => 'h1',
					'description' => __( 'HTML h1 tag.', 'wp-eform' ),
				],
				'H2' => [
					'value' => 'h2',
					'description' => __( 'HTML h2 tag.', 'wp-eform' ),
				],
				'H3' => [
					'value' => 'h3',
					'description' => __( 'HTML h3 tag.', 'wp-eform' ),
				],
				'H4' => [
					'value' => 'h4',
					'description' => __( 'HTML h4 tag.', 'wp-eform' ),
				],
				'H5' => [
					'value' => 'h5',
					'description' => __( 'HTML h5 tag.', 'wp-eform' ),
				],
				'H6' => [
					'value' => 'h6',
					'description' => __( 'HTML h6 tag.', 'wp-eform' ),
				],
				'P' => [
					'value' => 'p',
					'description' => __( 'HTML p tag.', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
