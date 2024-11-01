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
 * Authentication and roles for EForm admin dashboard access.
 */
class Dashboard extends Base {
	const ADMIN = 'wpeform_administrate_dashboard';
	const MANAGE = 'wpeform_manage_dashboard';

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_administrator_caps(): array {
		return [
			self::MANAGE,
			self::ADMIN,
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
	 * @return  array
	 */
	public function get_author_caps(): array {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	public function get_contributor_caps(): array {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	public function get_subscriber_caps(): array {
		return [];
	}

	/**
	 * Check if user can create a dashboard.
	 *
	 * @param int $user_id ID of WordPress user.
	 * @return bool
	 */
	public function can_user_create( int $user_id ) : bool {
		return \user_can( $user_id, self::ADMIN );
	}

	/**
	 * Check if user can edit a dashboard.
	 *
	 * @param int    $user_id ID of WordPress user.
	 * @param IModel $model Dashboard model.
	 * @return bool
	 */
	public function can_user_edit( int $user_id, IModel $model ) : bool {
		return \user_can( $user_id, self::ADMIN );
	}

	/**
	 * Check if user can read a dashboard.
	 *
	 * @param int    $user_id ID of WordPress user.
	 * @param IModel $model Dashboard model.
	 * @return bool
	 */
	public function can_user_read( int $user_id, IModel $model ) : bool {
		return \user_can( $user_id, self::MANAGE );
	}

	/**
	 * Check if user can read sensitive info from a dashboard.
	 *
	 * @param int    $user_id ID of WordPress user.
	 * @param IModel $model Dashboard model.
	 * @return bool
	 */
	public function can_user_read_sensitive_info( int $user_id, IModel $model ) : bool {
		return \user_can( $user_id, self::ADMIN );
	}

	/**
	 * Check if user can delete a dashboard.
	 *
	 * This is hard-coded to false because dashboard data are read-only with
	 * filters.
	 *
	 * @param int    $user_id ID of WordPress user.
	 * @param IModel $model Dashboard model.
	 * @return bool
	 */
	public function can_user_delete( int $user_id, IModel $model ) : bool {
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
		return false;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id ID of WordPress user.
	 *
	 * @return bool
	 */
	public function can_user_manage_others_models( int $user_id ): bool {
		return false;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id WordPress user Id.
	 *
	 * @return bool
	 */
	public function can_user_read_collection( int $user_id ) : bool {
		return user_can( $user_id, self::MANAGE );
	}
}
