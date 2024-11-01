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
 * @subpackage Admin
 */

namespace WPEForm\View\Admin;

use WPEForm\System\Init;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Base abstract class for all Admin side View
 */
abstract class Base {
	/**
	 * The hook where add_menu_page family added a page.
	 * Used mainly to fire additional actions on the same
	 * page.
	 *
	 * @var string
	 */
	protected $pagehook = null;

	/**
	 * Return the pagehook for external use.
	 *
	 * Make sure to call it after `admin_menu` action otherwise it will
	 * always return null.
	 *
	 * @return mixed(string|null)
	 */
	final public function get_pagehook() {
		return $this->pagehook;
	}

	/**
	 * Set pagehook. It should be called within
	 * register_admin_menu
	 *
	 * @param string $pagehook The pagehook returned by `add_admin_page` class
	 *                         of functions.
	 * @return void
	 */
	final protected function set_pagehook( $pagehook ) {
		$this->pagehook = $pagehook;
	}

	/**
	 * Remove all external styles and scripts coming from other plugins
	 * which may cause compatibility issue, especially with React.
	 *
	 * You can override it for even fine tuning.
	 *
	 * @param string $hook Current page hook.
	 * @return void
	 */
	public function sandbox_assets( $hook ) {
		// Don't do anything if hook is not pointing to current page
		if ( $this->get_pagehook() !== $hook ) {
			return;
		}
		// disable emoji script because it causes trouble with our react app
		\remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		\remove_action( 'admin_print_styles', 'print_emoji_styles' );

		// Get all styles and scripts, then filter
		$assets = [
			'styles'  => \wp_styles(),
			'scripts' => \wp_scripts(),
		];
		$settings = Init::$settings;
		if ( $settings['system']['sandboxAdminPage'] ) {
			$plugin_dirname = \basename( \dirname( \WP_EFORM_PLUGIN ) );
			foreach ( $assets as $type => $asset ) {
				foreach ( $asset->registered as $handle => $dep ) {
					$src = $dep->src;
					// test if the src is coming from /wp-admin/ or /wp-includes/ or /wp-fsqm-pro/.
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
						\strpos( $src, 'wpeform' ) === false &&
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

		// a little hack so that WordPress forms doesn't mess up our styling
		\wp_deregister_style( 'forms' );
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		\wp_register_style( 'forms', false );
	}

	/**
	 * Create an instance of the class
	 */
	public function __construct() {
		// Register this Admin class with WordPress API.
		\add_action( 'admin_menu', [ $this, 'register_admin_menu' ], 10 );
		\add_action( 'admin_menu', [ $this, 'post_admin_menu' ], 99 );
		// Add our own assets
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ], 10, 1 );
		// Create sandbox within the admin page
		\add_action( 'admin_enqueue_scripts', [ $this, 'sandbox_assets' ], 99, 1 );
	}

	/**
	 * Print the page header. Use this to simply print out a boilerplate
	 * admin section.
	 *
	 * @param string           $title Page title.
	 * @param mixed bool|array $new_action Additional actions to show alongside
	 *                                     title.
	 * @return void
	 */
	protected function page_head( $title, $new_action = false ) {
		$page_id = \esc_attr( $this->pagehook );
		echo "<div class='wrap' id='{$page_id}_widgets'>" . // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'<h1 class="wp-heading-inline">' .
				'' . \esc_html__( 'WPEForm', 'wp-eform' ) . ' / ' . \esc_html( $title ) .
			'</h1>' .
			( false === $new_action ?
				'' :
				"<a class='page-title-action' href='{$new_action['url']}'>{$new_action['label']}</a>" // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			) .
			'<hr class="wp-header-end">';
	}

	/**
	 * Print the page footer. Use this when page_head has been called.
	 *
	 * @return void
	 */
	protected function page_foot() {
		echo '</div>';
	}

	/**
	 * Enqueue assets safely within this page only.
	 *
	 * Call wp_enqueue_script and wp_enqueue_style family of functions.
	 *
	 * @return void
	 */
	public function register_enqueues() {}

	/**
	 * Callback function to get fired during `admin_menu` hook.
	 * This should call some WordPress API to create an admin page.
	 *
	 * Also set the pagehook by calling `set_pagehook` internally, otherwise
	 * enqueues won't work.
	 *
	 * @return void
	 */
	abstract public function register_admin_menu();

	/**
	 * Callback function to get fired during `load-{$this->pagehook}`.
	 *
	 * Override to do something useful here.
	 *
	 * @return void
	 */
	public function register_on_load() {}

	/**
	 * Callback function that is fired with WordPress
	 * `load-{$this->pagehook}` hook.
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	final public function load() {
		// Sandbox assets
		// We need to call it again, for footer enqueued
		// or late registered assets
		$this->sandbox_assets( $this->get_pagehook() );
		// Execute customs
		$this->register_on_load();
	}

	/**
	 * Enqueue freemius assets.
	 *
	 * @param bool $common Whether or not to include common CSS.
	 * @param bool $plugin Whether or not to include Pricing page CSS.
	 * @return void
	 */
	protected function enqueue_freemius( bool $common, bool $plugin ) {
		$enqueue = Init::enqueue();
		if ( $common ) {
			// Enqueue common freemius CSS
			$enqueue->enqueue(
				'common',
				'freemiusCommon',
				[
					'js' => true,
					'css' => true,
					'js_dep' => [],
					'css_dep' => [],
					'in_footer' => false,
					'media' => 'all',
				]
			);
		}

		if ( $plugin ) {
			$enqueue->enqueue(
				'common',
				'freemiusPlugin',
				[
					'js' => true,
					'css' => true,
					'js_dep' => [],
					'css_dep' => [],
					'in_footer' => false,
					'media' => 'all',
				]
			);
		}
	}

	/**
	 * Callback function for enqueue on the page
	 *
	 * @codeCoverageIgnore
	 *
	 * @param string $hook Current pagehook.
	 * @return void
	 */
	final public function enqueue( $hook ) {
		// If not for current page, then only include conditionally freemius assets
		if ( $this->get_pagehook() !== $hook ) {
			// but knowingly add freemius if on freemius pricing page
			$freemius_pricing_page_hook = \get_plugin_page_hookname(
				'wpeform-pricing',
				'wpeform'
			);
			if ( $hook === $freemius_pricing_page_hook ) {
				$this->enqueue_freemius( true, true );
			} else {
				$this->enqueue_freemius( true, false );
			}
			return;
		}
		// Register custom assets
		// Enqueue common freemius CSS
		$this->enqueue_freemius( true, true );
		$this->register_enqueues();
	}

	/**
	 * Fires on admin_menu
	 */
	protected function admin_menu_hook() {}

	/**
	 * A function that is called later at `admin_menu` hook.
	 * It registers the `load` with the current pagehook.
	 * So it is important you set pagehook by calling `set_pagehook` at
	 * `admin_menu`.
	 *
	 * @return void
	 */
	final public function post_admin_menu() {
		if ( null !== $this->pagehook ) {
			add_action( "load-{$this->pagehook}", [ $this, 'load' ] );
		}
		$this->admin_menu_hook();
	}

	/**
	 * Get a WordPress UI Formatted Notice.
	 *
	 * @param string  $msg Notice message.
	 * @param string  $type Notice type, error, success, warning, info.
	 * @param boolean $is_dismissible Whether this is dismissible.
	 * @return string Notice message to print.
	 */
	public function get_notice( $msg, $type = 'error', $is_dismissible = false ) {
		$classes = [ 'notice', 'notice-' . $type ];
		if ( $is_dismissible ) {
			$classes[] = 'is-dismissible';
		}
		$notice = '<div class="' . implode( ' ', $classes ) . '">';
		$notice .= '<p>' . $msg . '</p>';
		$notice .= '</div>';
		return $notice;
	}
}
