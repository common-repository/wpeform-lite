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

use WPEForm\Exception\AuthException;
use WPEForm\Model\IModel;
use function WPEForm\Helpers\convert_array_values_to_int;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Authentication abstraction for the Form.
 *
 * Provides methods for checking if the user is capable of doing
 * something within the form.
 */
class Form extends Base {
	const ADMIN = 'wpeform_manage_others_forms';
	const MANAGE = 'wpeform_manage_forms';

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_administrator_caps(): array {
		return [
			self::ADMIN,
			self::MANAGE,
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_editor_caps(): array {
		return [
			self::MANAGE,
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_author_caps(): array {
		return [];
	}

	/**
	 * Check if user can create a form.
	 *
	 * @param int $user_id The user ID.
	 * @return bool true if can create, false otherwise.
	 */
	public function can_user_create( int $user_id ) : bool {
		if ( \user_can( $user_id, self::MANAGE ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Check if user is owner or in the editor group of a form.
	 *
	 * @throws AuthException If model is empty.
	 *
	 * @param int    $user_id Id of WordPress user.
	 * @param IModel $model Form model.
	 * @param bool   $owner_only If true, then don't check if user in editor group.
	 *
	 * @return bool
	 */
	protected function is_user_owner_or_in_editor_group( int $user_id, IModel $model, bool $owner_only = false ) : bool {
		// If model has no data
		if ( ! $model->exists() ) {
			throw new AuthException( 'Authentication can not be performed on non existing model.' );
		}
		$form_data = $model->read();

		// If user is owner
		if (
			\is_array( $form_data )
			&& isset( $form_data['ownerid'] )
			&& $form_data['ownerid'] === $user_id
		) {
			return true;
		}

		// user is not owner, but if this is called to check for owner only, then
		// bail here
		if ( $owner_only ) {
			return false;
		}

		// Check for the editor group
		$editor_group = convert_array_values_to_int( $model->read_meta( 'editor' ) );
		// if in the editor group
		if ( \in_array( $user_id, $editor_group ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Check if provided user can edit the form.
	 *
	 * It will pass, if the user is the owner of the form, or within the
	 * `editor` group.
	 *
	 * @throws AuthException When model doesn't exist.
	 *
	 * @param int    $user_id The user ID (from Database).
	 * @param IModel $model Form Model.
	 * @return bool True if user can edit, False if can not.
	 */
	public function can_user_edit( int $user_id, IModel $model ) : bool {
		// If user can edit_others_forms, then always yes
		if ( \user_can( $user_id, self::ADMIN ) ) {
			return true;
		}
		// If user does not have capability, then NO
		if ( ! \user_can( $user_id, self::MANAGE ) ) {
			return false;
		}
		// user can edit, if user is the owner of the form or in the editor group
		return $this->is_user_owner_or_in_editor_group( $user_id, $model, false );
	}

	/**
	 * Check if a user can view a form.
	 *
	 * @param int    $user_id Id of the WordPress user.
	 * @param IModel $model Form model.
	 * @return bool True if can, false otherwise.
	 */
	public function can_user_read( int $user_id, IModel $model ) : bool {
		// form is a public facing API, so anyone can query a form, given the Id
		// but not all form data are exposed to the public. This is handled by
		// `can_user_read_sensitive_info` and the controller.
		return true;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param IModel $model Model of the form.
	 *
	 * @return bool
	 */
	public function can_current_user_read( IModel $model ): bool {
		// same reason as `can_user_read`.
		return true;
	}

	/**
	 * Check if a user can view sensitive info from a form.
	 *
	 * @param int    $user_id Id of the WordPress user.
	 * @param IModel $model Form model.
	 * @return bool True if can, false otherwise.
	 */
	public function can_user_read_sensitive_info( int $user_id, IModel $model ) : bool {
		// if user can manage other's form, then it is always true
		if ( \user_can( $user_id, self::ADMIN ) ) {
			return true;
		}

		// Now if user can not really create a form, then there is no point of
		// checking further
		if ( ! \user_can( $user_id, self::MANAGE ) ) {
			return false;
		}

		// otherwise, user needs to be the owner of the form or within the editor
		// group.
		return $this->is_user_owner_or_in_editor_group( $user_id, $model, false );
	}

	/**
	 * Check if provided user can delete the given form.
	 *
	 * Only user with `eform_manage_others_forms` or with `eform_manage_forms` and
	 * being the owner of the form can delete and no one else. So it means
	 * editors can not delete a form.
	 *
	 * @throws AuthException When model doesn't exist.
	 *
	 * @param int    $user_id The user id.
	 * @param IModel $model The form model.
	 * @return bool true if can delete, false otherwise.
	 */
	public function can_user_delete( int $user_id, IModel $model ) : bool {
		// If user can edit_others_forms, then always yes
		if ( \user_can( $user_id, self::ADMIN ) ) {
			return true;
		}
		// If user does not have capability, then NO
		if ( ! \user_can( $user_id, self::MANAGE ) ) {
			return false;
		}

		// Now check only if user is owner of the form. A form's editors can not
		// delete the form.
		return $this->is_user_owner_or_in_editor_group( $user_id, $model, true );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id Id of WordPress user.
	 *
	 * @return bool
	 */
	public function can_user_view_trashed( int $user_id ): bool {
		return \user_can( $user_id, self::MANAGE );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id ID of WordPress user.
	 *
	 * @return bool
	 */
	public function can_user_manage_others_models( int $user_id ): bool {
		return \user_can( $user_id, self::ADMIN );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id WordPress user Id.
	 *
	 * @return bool
	 */
	public function can_user_read_collection( int $user_id ) : bool {
		return \user_can( $user_id, self::MANAGE );
	}
}
