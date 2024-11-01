<?php
/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of WPEForm - WordPress Form Builder.
 *
 * WPEForm - WordPress Form Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * WPEForm - WordPress Form Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPEForm - WordPress Form Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package EForm
 * @subpackage Util
 */

namespace WPEForm\Util;

use Exception;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * An icon class for easily accessing icons in the assets directory.
 *
 * @package WPEForm\Util
 *
 * @method string checkboxChecked()
 * @method string checkboxUnchecked()
 * @method string radioChecked()
 * @method string radioUnchecked()
 */
class Icon {
	/**
	 * Icons cache as found in icons directory.
	 *
	 * @var array
	 */
	protected $icons = [];

	/**
	 * URL type. Could be either 'network' or 'path'.
	 *
	 * @var string
	 */
	protected $url_type = 'network';

	/**
	 * Create an instance.
	 *
	 * @param string $url_type Could be either 'network' or 'path'.
	 */
	public function __construct( string $url_type ) {
		$this->icons = [
			'checkboxChecked' => [
				'path' => 'static/icons/CheckboxChecked.png',
				'alt' => \__( 'Checked', 'wp-eform' ),
			],
			'checkboxUnchecked' => [
				'path' => 'static/icons/CheckboxUnchecked.png',
				'alt' => \__( 'Unchecked', 'wp-eform' ),
			],
			'radioChecked' => [
				'path' => 'static/icons/RadioChecked.png',
				'alt' => \__( 'Checked', 'wp-eform' ),
			],
			'radioUnchecked' => [
				'path' => 'static/icons/RadioUnchecked.png',
				'alt' => \__( 'Unchecked', 'wp-eform' ),
			],
		];
		$this->url_type = $url_type;
	}

	/**
	 * Magic getter.
	 *
	 * @param mixed $name Name of the icon.
	 * @param mixed $arguments Arguments passed to the caller.
	 * @return string Network or Path URL depending on settings.
	 *
	 * @throws Exception If given icon is not found.
	 */
	public function __call( $name, $arguments ) {
		if ( isset( $this->icons[ $name ] ) ) {
			$icon = $this->icons[ $name ];
			$relative_path = $icon['path'];
			if ( $this->url_type === 'network' ) {
				$url = \plugins_url(
					'/' . $relative_path,
					\WP_EFORM_PLUGIN
				);
			} else {
				$url = 'data:image/png;base64,'
					// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
					. \base64_encode( \file_get_contents( \WP_EFORM_ABSPATH . $relative_path ) );
			}
			return '<img src="' . \esc_attr( $url ) . '"'
				. ' alt="' . \esc_attr( $icon['alt'] ) . '"'
				. ' height="32" width="32"'
				. ' style="height: 1.25em; width: 1.25em; margin: 0 0.25em; vertical-align: bottom; display: inline-block;"'
				. ' />';
		}

		throw new Exception( "Given icon {$name} not found." );
	}
}
