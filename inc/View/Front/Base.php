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

use WPEForm\Model\Form as FormModel;
use WPEForm\System\Init;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Base class for all Front packages.
 *
 * @package WPEForm\View\Front
 */
abstract class Base {
	/**
	 * Given a form Id, get form data for standalone page and the slug. It returns
	 * a touple `[$form_data, $slug ]`.
	 *
	 * @param int $form_id Id of the form.
	 * @return array{0: array|null, 1: string} Touple of form_data and slug
	 */
	public static function get_form_data_and_slug( int $form_id ) : array {
		$form_data = FormModel::get_form_standalone_data( $form_id );
		$form_name = $form_data['name'] ?? 'deleted form';
		$slug = \sanitize_title( $form_name );
		return [ $form_data, $slug ];
	}

	/**
	 * Increase form view count by 1, only if currently logged in user is not
	 * one of the editors of the form.
	 *
	 * We do not increase form count when viewed by owners to prevent invalid
	 * data.
	 *
	 * @param int   $form_id Form Id.
	 * @param array $form_data Form data as received.
	 * @return void
	 */
	public static function increase_form_view_count( int $form_id, array $form_data ) : void {
		// get current user id
		$current_user_id = \intval( \get_current_user_id() );
		if ( $form_data['ownerid'] === $current_user_id ) {
			return;
		}
		if ( \in_array( $current_user_id, $form_data['editors'] ) ) {
			return;
		}
		FormModel::increase_form_view_count( $form_id );
	}

	/**
	 * Wrap children in shadow dom if needed. It checks the global settings and
	 * if the option is turned on, then it renders in shadow.
	 *
	 * Otherwise, it simply returns the child.
	 *
	 * @param string $children Children (HTML) to render.
	 * @return string Wrapped or unwrapped children.
	 */
	public static function wrap_in_shadow_dom_if_needed( string $children ) : string {
		$disable_rehydration = 'false';
		// wrap children in react-app slot if not present
		if ( \mb_strpos( $children, 'wpeform-root-slot__react-app' ) === false ) {
			$disable_rehydration = 'true';
			$children = '<div class="wpeform-root-slot__react-app">' . $children . '</div>';
		}
		// always wrap the children in slot
		$children = '<section class="wpeform-root-slot" data-disable-rehydration="'
			. \esc_attr( $disable_rehydration )
			. '">'
			. $children
			. '</section>';
		$settings = Init::$settings;
		$wrap_in_shadow = $settings['appearance']['renderInShadow'];
		if ( $wrap_in_shadow ) {
			return '<template shadowroot="open">' . $children . '</template>';
		}
		return $children;
	}

	/**
	 * Sandbox all assets. Basically removes everything that is not a part of
	 * wp-eform.
	 *
	 * @return void
	 */
	public static function sandbox_assets() {
		// Get all styles and scripts, then filter
		$assets = [
			'styles'  => \wp_styles(),
			'scripts' => \wp_scripts(),
		];
		$plugin_dirname = \basename( \dirname( \WP_EFORM_PLUGIN ) );
		foreach ( $assets as $type => $asset ) {
			foreach ( $asset->registered as $handle => $dep ) {
				$src = $dep->src;
				// test if the src is coming from /wp-admin/ or /wp-includes/ or /wp-eform/ or /wpeform-lite/.
				if (
					\is_string( $src ) &&
					\strpos( $src, 'wp-admin' ) === false &&
					\strpos( $src, 'wp-include' ) === false &&
					\strpos( $src, 'eform-' ) === false &&
					\strpos( $src, 'woocommerce' ) === false &&
					\strpos( $src, 'jetpack' ) === false &&
					\strpos( $src, 'debug-bar' ) === false &&
					\strpos( $src, 'fsqm-' ) === false &&
					\strpos( $src, 'wp-eform' ) === false &&
					\strpos( $src, $plugin_dirname ) === false
				) {
					if ( 'scripts' === $type ) {
						\wp_dequeue_script( $handle );
					} else {
						\wp_dequeue_style( $handle );
					}
				}
			}
		}
	}
	/**
	 * Get assets output for standalone pages.
	 *
	 * @return string
	 */
	public static function get_assets_output_for_standalone_pages() : string {
		self::sandbox_assets();
		\wp_deregister_style( 'admin-bar' );
		\wp_deregister_script( 'admin-bar' );
		// get asset output
		\ob_start();
		\WPEForm\System\Init::enqueue()->printPublicPath();
		\wp_print_styles();
		\wp_print_scripts();
		$assets_output = \ob_get_clean();
		return $assets_output;
	}

	/**
	 * Render standalone page from the generic template.
	 *
	 * @param string      $page_title Page title.
	 * @param string      $assets_output Assets output.
	 * @param string      $body Page body.
	 * @param string|null $dark_mode Whether or not to include dark mode CSS on the standalone page.
	 *                          Could be one of "OFF", "AUTO", "ALWAYS".
	 * @param bool        $include_settings_html Whether or not to include the
	 *                          Before/After HTML from settings. Defaults true.
	 * @return void
	 */
	public static function render_standalone_page( string $page_title, string $assets_output, string $body, ?string $dark_mode = 'OFF', bool $include_settings_html = true ) {
		\header( 'content-type: text/html; charset=UTF-8' );
		$settings = Init::$settings['standalonePages'];
		$before_body_html = $settings['beforeBodyHTML'];
		$after_body_html = $settings['afterBodyHTML'];
		if ( $include_settings_html === false ) {
			$before_body_html = '';
			$after_body_html = '';
		}
		$head_html = $settings['headHTML'];
		if ( $dark_mode && $dark_mode !== 'OFF' ) {
			$head_html .= <<<STYLE
<meta name="color-scheme" content="dark light" />
<style type="text/css">
:root {
	--background-color: #fff;
	--text-color: #1F2933;
}

body {
	background-color: var(--background-color);
	color: var(--text-color);
}

@media (prefers-color-scheme: dark) {
	:root {
		--background-color: #111;
		--text-color: #F5F7FA;
	}
}
</style>
STYLE;
			if ( $dark_mode === 'ALWAYS' ) {
				$head_html .= <<<STYLE
<style type="text/css">
:root {
	--background-color: #111;
	--text-color: #F5F7FA;
}
</style>
STYLE;
			}
		}
		include __DIR__ . '/templates/standalone.php';
		die();
	}

	/**
	 * Enqueue app related assets.
	 *
	 * @param bool $in_footer Whether or not we enqueue in footer.
	 * @return array Array of assets being enqueued.
	 */
	abstract public static function enqueue_assets( bool $in_footer = true ) : array;

	/**
	 * Get HTML container for printing this app.
	 *
	 * @param array $config Configuration array.
	 * @param bool  $single_page Whether or not this render is for single page.
	 * @param array $assets Assets as enqueued.
	 *
	 * @return string HTML container.
	 */
	abstract public static function get_container( array $config, bool $single_page, array $assets ) : string;

	/**
	 * Handle standalone page output.
	 *
	 * @return void
	 */
	abstract public static function handle_standalone_output() : void;
}
