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
 * Class for Form settings background origin and clip Enum.
 */
class FormSettingsBackgroundOriginAndClip extends EnumType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormSettingsBackgroundOriginAndClipEnum',
			'description' => __( 'Form settings background origin.', 'wp-eform' ),
			'values' => [
				'PADDING_BOX' => [
					'value' => 'padding-box',
					'description' => __( 'Padding box (upper left).', 'wp-eform' ),
				],
				'BORDER_BOX' => [
					'value' => 'border-box',
					'description' => __( 'Border box (upper left of border).', 'wp-eform' ),
				],
				'CONTENT_BOX' => [
					'value' => 'content-box',
					'description' => __( 'Content box (upper left of content).', 'wp-eform' ),
				],
			],
		];
		parent::__construct( $config );
	}
}
