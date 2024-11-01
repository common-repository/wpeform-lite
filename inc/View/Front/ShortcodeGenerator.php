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
 * @subpackage View\Front
 */

namespace WPEForm\View\Front;

use WPEForm\System\Init;
use WPEForm\System\SystemEndpoint;

use function WPEForm\Helpers\combine_wpackio_assets;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * View class for generating the ShortcodeGenerator app for TinyMCE.
 *
 * @package WPEForm\View\Front
 */
class ShortcodeGenerator extends Base {
	/**
	 * Enqueue assets for a ShortcodeGenerator.
	 *
	 * @param bool $in_footer Whether or not we enqueue in footer.
	 * @return array Array of assets being enqueued.
	 */
	public static function enqueue_assets( bool $in_footer = true ) : array {
		$enqueue = \WPEForm\System\Init::enqueue();
		$assets = $enqueue->enqueue(
			'editor', 'shortcodeGenerator', [
				'js' => true,
				'css' => true,
				'js_dep' => [],
				'css_dep' => [],
				'in_footer' => $in_footer,
				'media' => 'all',
			]
		);
		$handle = $enqueue->getPrimaryJsHandle( $assets );
		SystemEndpoint::append_wpeformgraphqlapp_to_handle(
			$handle
		);
		$fontawesome_assets = Init::enqueue_fontawesome();
		return combine_wpackio_assets( $assets, $fontawesome_assets );
	}

	/**
	 * Get a ShortcodeGenerator Container where the script would render the react app.
	 *
	 * @param array $config Configuration array.
	 * @param bool  $single_page Whether or not this render is for single page.
	 * @param array $assets Assets as enqueued.
	 *
	 * @return string The HTML of the container.
	 */
	public static function get_container( array $config, bool $single_page, array $assets ) : string {
		$enqueue = \WPEForm\System\Init::enqueue();
		$css_handles = $enqueue->getCssHandles( $assets );

		$container = '<div'
			. ' class="wp-eform-shortcodegenerator-holder"'
			. ' data-single-page="' . ( $single_page ? 'true' : 'false' ) . '"'
			. ' data-css-handles="' . \esc_attr( \json_encode( $css_handles ) ) . '" '
			. '>'
			. '</div>';

		return $container;
	}

	/**
	 * Output needed HTML for previewing or editing a ShortcodeGenerator from front-end of the app.
	 *
	 * @return void
	 */
	public static function handle_standalone_output() : void {
		// first configure the enqueue
		$assets = self::enqueue_assets( false );
		$assets_output = self::get_assets_output_for_standalone_pages();

		// get the body
		$body = self::get_container(
			[],
			true,
			$assets
		);

		// render
		self::render_standalone_page(
			\__( 'Generate Shortcode', 'wp-eform' ),
			$assets_output,
			$body,
			'OFF',
			false
		);
	}
}
