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
 * @subpackage Auth
 */

namespace WPEForm\Auth;

use WPEForm\Model\IModel;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * An interface for all Auth classes. These classes should implement WordPress
 * caps and also implement logic for the authentication.
 */
interface IAuth {
	/**
	 * Set authentication bypass. If this is set to true, then depending on the
	 * class, some methods won't check with underlying user and capabilities.
	 *
	 * It is the task of the child class to implement the logic with auth bypass.
	 *
	 * @param bool $bypassed Whether or not bypassed is set.
	 *
	 * @return void
	 */
	public function set_auth_bypass( bool $bypassed ) : void;

	/**
	 * Get current status of authentication bypass.
	 *
	 * @return bool
	 */
	public function get_auth_bypass() : bool;

	/**
	 * Check if the user is logged in.
	 *
	 * @return bool true if user is logged in, false otherwise.
	 */
	public function is_user_logged_in() : bool;

	/**
	 * Get currently logged in user's Id.
	 *
	 * @return integer
	 */
	public function get_current_user_id(): int;

	/**
	 * Get capabilities for administrator.
	 *
	 * @return array
	 */
	public function get_administrator_caps() : array;

	/**
	 * Get capabilities for editor.
	 *
	 * @return array
	 */
	public function get_editor_caps() : array;

	/**
	 * Get capabilities for author.
	 *
	 * @return array
	 */
	public function get_author_caps() : array;

	/**
	 * Get capabilities for contributor.
	 *
	 * @return array
	 */
	public function get_contributor_caps() : array;

	/**
	 * Get capabilities for subscriber.
	 *
	 * @return array
	 */
	public function get_subscriber_caps() : array;

	/**
	 * Get capabilities for WordPress built-in roles.
	 *
	 * @return array Associative array with administrator, editor, author
	 *               contributor and subscriber.
	 */
	public function get_caps_for_builtin_roles() : array;

	/**
	 * Check if user can create a model.
	 *
	 * @param int $user_id ID of WordPress user.
	 * @return bool
	 */
	public function can_user_create( int $user_id ) : bool;

	/**
	 * Check if currently logged in user can create a model.
	 *
	 * @return bool
	 */
	public function can_current_user_create(): bool;

	/**
	 * Check if user can edit a model.
	 *
	 * @param int    $user_id ID of WordPress user.
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_user_edit( int $user_id, IModel $model ): bool;

	/**
	 * Check if currently logged in user can edit a model.
	 *
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_current_user_edit( IModel $model ) : bool;

	/**
	 * Check if user can read a model.
	 *
	 * @param int    $user_id ID of WordPress user.
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_user_read( int $user_id, IModel $model ) : bool;

	/**
	 * Check if currently logged in user can read a model.
	 *
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_current_user_read( IModel $model ) : bool;

	/**
	 * Check if user can read sensitive information from a model.
	 *
	 * @param int    $user_id WordPress user Id.
	 * @param IModel $model Data model.
	 *
	 * @return bool
	 */
	public function can_user_read_sensitive_info( int $user_id, IModel $model ) : bool;

	/**
	 * Check if current user can read sensitive information from a model.
	 *
	 * @param IModel $model Data model.
	 *
	 * @return bool
	 */
	public function can_current_user_read_sensitive_info( IModel $model ) : bool;

	/**
	 * Check if user can delete a model.
	 *
	 * @param int    $user_id ID of WordPress user.
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_user_delete( int $user_id, IModel $model ) : bool;

	/**
	 * Check if currently logged in user can delete a model.
	 *
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_current_user_delete( IModel $model ) : bool;

	/**
	 * Check if user can view trashed items.
	 *
	 * This doesn't say that user can manage others resources. For that use
	 * `can_user_delete_others_models`.
	 *
	 * @param int $user_id ID of WordPress user.
	 *
	 * @return bool
	 */
	public function can_user_view_trashed( int $user_id ) : bool;

	/**
	 * Check if current user can view trashed items.
	 *
	 * This doesn't say that user can manage others resources. For that use
	 * `can_user_delete_others_models`.
	 *
	 * @return bool
	 */
	public function can_current_user_view_trashed() : bool;

	/**
	 * Check if user can manage (edit, delete) others' models.
	 *
	 * This should depend directly on a capability and not on the model itself.
	 *
	 * @param int $user_id ID of WordPress user.
	 *
	 * @return bool
	 */
	public function can_user_manage_others_models( int $user_id ) : bool;

	/**
	 * Check if current user can manage (edit, delete) others' models.
	 *
	 * This should depend directly on a capability and not on the model itself.
	 *
	 * @return bool
	 */
	public function can_current_user_manage_others_models() : bool;

	/**
	 * Check if a user can read collection or not.
	 *
	 * @param int $user_id WordPress user Id.
	 *
	 * @return bool
	 */
	public function can_user_read_collection( int $user_id ) : bool;

	/**
	 * Check if currently logged in user can read collection or not.
	 *
	 * @return bool
	 */
	public function can_current_user_read_collection() : bool;

	/**
	 * Checks whether a user can perform bulk actions. This doesn't check
	 * whether user is able to perform that action on any specific model. It is
	 * upto the controller to make sure it does that.
	 *
	 * @param int $user_id WordPress user Id.
	 *
	 * @return bool
	 */
	public function can_user_manage_collection( int $user_id ) : bool;

	/**
	 * Checks whether current user can perform bulk actions. This doesn't check
	 * whether user is able to perform that action on any specific model. It is
	 * upto the controller to make sure it does that.
	 *
	 * @return bool
	 */
	public function can_current_user_manage_collection() : bool;
}
