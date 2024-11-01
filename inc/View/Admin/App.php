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

use WPEForm\Factory\Role;
use WPEForm\System\Endpoints;
use WPEForm\System\Init;
use WPEForm\System\SystemEndpoint;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Dashboard class for EForm
 *
 * @codeCoverageIgnore
 */
class App extends Base {
	/**
	 * Menu Slug
	 *
	 * @var string
	 */
	const MENU_SLUG = 'wpeform';

	/**
	 * {@inheritDoc}
	 *
	 * @return void
	 */
	public function register_admin_menu() {
		$this->set_pagehook(
			add_menu_page(
				__( 'WPEForm - WordPress Form Builder', 'wp-eform' ),
				__( 'WPEForm', 'wp-eform' ),
				\WPEForm\Auth\Dashboard::MANAGE,
				self::MENU_SLUG,
				[ $this, 'page' ],
				'dashicons-wpeformlogo',
				25
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	protected function admin_menu_hook() {
		global $submenu;

		// don't add client side routing when freemius is being activated.
		$fs = \wpeform_fs();
		if ( $fs->is_activation_mode() ) {
			return;
		}

		$link_prefix = 'admin.php?page=' . self::MENU_SLUG . '#/';
		$link_suffix = '';
		$settings = Init::$settings;
		if ( $settings['system']['preferStandaloneAdmin'] ) {
			$link_prefix = SystemEndpoint::get_standalone_admin_link();
			$link_suffix = '/';
		}

		// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited
		// Dashboard
		$submenu[ self::MENU_SLUG ][] = [
			__( 'Dashboard', 'wp-eform' ),
			\WPEForm\Auth\Dashboard::MANAGE,
			$link_prefix . 'dashboard' . $link_suffix,
		];
		if ( \current_user_can( \WPEForm\Auth\Form::MANAGE ) ) {
			$submenu[ self::MENU_SLUG ][] = [
				__( 'Forms', 'wp-eform' ),
				\WPEForm\Auth\Form::MANAGE,
				$link_prefix . 'forms' . $link_suffix,
			];
			$submenu[ self::MENU_SLUG ][] = [
				__( 'Submissions', 'wp-eform' ),
				\WPEForm\Auth\Form::MANAGE,
				$link_prefix . 'submissions' . $link_suffix,
			];
		}
		if ( \current_user_can( \WPEForm\Auth\Category::VIEW ) ) {
			$submenu[ self::MENU_SLUG ][] = [
				__( 'Category', 'wp-eform' ),
				\WPEForm\Auth\Category::VIEW,
				$link_prefix . 'category' . $link_suffix,
			];
		}
		if ( \current_user_can( \WPEForm\Auth\SiteSettings::MANAGE ) ) {
			$submenu[ self::MENU_SLUG ][] = [
				__( 'Settings', 'wp-eform' ),
				\WPEForm\Auth\Form::MANAGE,
				$link_prefix . 'settings' . $link_suffix,
			];
		}

		if ( $settings['system']['preferStandaloneAdmin'] ) {
			$submenu[ self::MENU_SLUG ][] = [
				__( 'WordPress Admin', 'wp-eform' ),
				\WPEForm\Auth\Dashboard::MANAGE,
				'admin.php?page=' . self::MENU_SLUG . '#/dashboard',
			];
		} else {
			$submenu[ self::MENU_SLUG ][] = [
				__( 'Standalone App', 'wp-eform' ),
				\WPEForm\Auth\Dashboard::MANAGE,
				SystemEndpoint::get_standalone_admin_link(),
			];
		}
		// phpcs:enable WordPress.WP.GlobalVariablesOverride.Prohibited
	}

	/**
	 * Print the dashboard page
	 *
	 * @return void
	 */
	public function page() {
		// Set entry point for our react app
		echo '<div id="wpeform-app" class="wpeform-app"></div>';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return void
	 */
	public function register_enqueues() {
		SystemEndpoint::enqueue_admin_page_assets( false );
	}
}
