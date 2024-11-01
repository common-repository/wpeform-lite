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
 * Authentication abstraction for the Form.
 *
 * Provides methods for checking if the user is capable of doing
 * something within the form.
 */
class SiteSettings extends Base {
	const MANAGE = 'wpeform_manage_site_settings';
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_administrator_caps(): array {
		return [
			self::MANAGE,
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_editor_caps(): array {
		return [];
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
	 * {@inheritDoc}
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
	 * {@inheritDoc}
	 *
	 * @param int    $user_id The user ID (from Database).
	 * @param IModel $model Form Model.
	 * @return bool True if user can edit, False if can not.
	 */
	public function can_user_edit( int $user_id, IModel $model ) : bool {
		return \user_can( $user_id, self::MANAGE );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int    $user_id Id of the WordPress user.
	 * @param IModel $model Form model.
	 * @return bool True if can, false otherwise.
	 */
	public function can_user_read( int $user_id, IModel $model ) : bool {
		return \user_can( $user_id, self::MANAGE );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int    $user_id The user id.
	 * @param IModel $model The form model.
	 * @return bool true if can delete, false otherwise.
	 */
	public function can_user_delete( int $user_id, IModel $model ) : bool {
		// one cannot delete site settings
		return false;
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
		return \user_can( $user_id, self::MANAGE );
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

	/**
	 * {@inheritDoc}
	 *
	 * @param int    $user_id WordPress User Id.
	 * @param IModel $model Model.
	 * @return bool
	 */
	public function can_user_read_sensitive_info( int $user_id, IModel $model ): bool {
		return \user_can( $user_id, self::MANAGE );
	}
}
