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
 * @subpackage Factory
 */

namespace WPEForm\Factory;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A factory class for getting roles.
 */
class Role {
	/**
	 * Auth classes registered to the factory.
	 *
	 * @var array
	 */
	protected static $registered_auths = [
		'\\WPEForm\\Auth\\Dashboard',
		'\\WPEForm\\Auth\\Category',
		'\\WPEForm\\Auth\\Form',
		'\\WPEForm\\Auth\\Submission',
		'\\WPEForm\\Auth\\SiteSettings',
	];

	/**
	 * Get capabilities for WordPress built-in roles.
	 *
	 * @return array
	 */
	public static function get_caps_for_builtins() : array {
		$administrator = [];
		$editor = [];
		$author = [];
		$contributor = [];
		$subscriber = [];

		foreach ( self::$registered_auths as $auth_class ) {
			$auth = new $auth_class();
			$administrator = array_merge( $administrator, $auth->get_administrator_caps() );
			$editor = array_merge( $editor, $auth->get_editor_caps() );
			$author = array_merge( $author, $auth->get_author_caps() );
			$contributor = array_merge( $contributor, $auth->get_contributor_caps() );
			$subscriber = array_merge( $subscriber, $auth->get_subscriber_caps() );
		}

		return [
			'administrator' => array_unique( $administrator ),
			'editor' => array_unique( $editor ),
			'author' => array_unique( $author ),
			'contributor' => array_unique( $contributor ),
			'subscriber' => array_unique( $subscriber ),
		];
	}

	/**
	 * Get whether current user can do the capability for all built-in
	 * capabilities.
	 *
	 * @return array Array of capability and current_user_can pair.
	 */
	public static function get_can_user_caps_for_builtins() : array {
		$builtin_caps = self::get_caps_for_builtins();
		$current_user_cans = [];
		foreach ( $builtin_caps as $role => $caps ) {
			foreach ( $caps as $cap ) {
				if ( ! isset( $current_user_cans[ $cap ] ) ) {
					$current_user_cans[ $cap ] = \current_user_can( $cap );
				}
			}
		}
		return $current_user_cans;
	}
}
