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

use WPEForm\Exception\InvalidOperationException;
use WPEForm\Model\IModel;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Authentication class for different data controllers.
 *
 * Provides methods for checking if the user is capable of doing something for
 * the controller/model.
 *
 * Integrates with WordPress' user system.
 */
abstract class Base implements IAuth {
	/**
	 * A flag to set authentication bypass.
	 *
	 * @var bool
	 */
	protected $bypassed = false;

	/**
	 * {@inheritDoc}
	 *
	 * @param bool $bypassed Whether or not auth is bypassed.
	 *
	 * @return void
	 */
	public function set_auth_bypass( bool $bypassed ) : void {
		$this->bypassed = $bypassed;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function get_auth_bypass() : bool {
		return $this->bypassed;
	}

	/**
	 * Check if the user is logged in.
	 *
	 * @return bool true if user is logged in, false otherwise.
	 */
	public function is_user_logged_in() : bool {
		return \is_user_logged_in();
	}

	/**
	 * Get currently logged in user's Id.
	 *
	 * @throws InvalidOperationException If user isn't already logged in.
	 *
	 * @return integer
	 */
	public function get_current_user_id(): int {
		if ( ! $this->is_user_logged_in() ) {
			throw new InvalidOperationException( 'Can not get Id if user is not logged in.' );
		}
		return (int) \get_current_user_id();
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
	 * @return array
	 */
	public function get_contributor_caps(): array {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_subscriber_caps(): array {
		return [];
	}

	/**
	 * Get capabilities for WordPress built-in roles.
	 *
	 * @return array Associative array with administrator, editor, author
	 *               contributor and subscriber.
	 */
	public function get_caps_for_builtin_roles() : array {
		return [
			'administrator' => $this->get_administrator_caps(),
			'editor' => $this->get_editor_caps(),
			'author' => $this->get_author_caps(),
			'contributor' => $this->get_contributor_caps(),
			'subscriber' => $this->get_subscriber_caps(),
		];
	}

	/**
	 * Check if currently logged in user can create a model.
	 *
	 * @return bool
	 */
	public function can_current_user_create() : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_create( $this->get_current_user_id() );
	}

	/**
	 * Check if currently logged in user can edit a model.
	 *
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_current_user_edit( IModel $model ) : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_edit( $this->get_current_user_id(), $model );
	}

	/**
	 * Check if currently logged in user can read a model.
	 *
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_current_user_read( IModel $model ) : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_read( $this->get_current_user_id(), $model );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_current_user_read_sensitive_info( IModel $model ) : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}

		return $this->can_user_read_sensitive_info(
			$this->get_current_user_id(),
			$model
		);
	}

	/**
	 * Check if currently logged in user can delete a model.
	 *
	 * @param IModel $model Data model.
	 * @return bool
	 */
	public function can_current_user_delete( IModel $model ) : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_delete( $this->get_current_user_id(), $model );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function can_current_user_view_trashed() : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_view_trashed( $this->get_current_user_id() );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function can_current_user_manage_others_models(): bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_manage_others_models( $this->get_current_user_id() );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function can_current_user_read_collection() : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_read_collection(
			$this->get_current_user_id()
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id WordPress user Id.
	 *
	 * @return bool
	 */
	public function can_user_manage_collection( int $user_id ): bool {
		// the logic is that if a user can create, then the same user can also
		// manage collection if his/her own creations.
		// once again, it is upto the controller to make sure every model/collection
		// is actually owned by the user or user has the capability.
		return $this->can_user_create( $user_id );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function can_current_user_manage_collection() : bool {
		if ( ! $this->is_user_logged_in() ) {
			return false;
		}
		return $this->can_user_manage_collection(
			$this->get_current_user_id()
		);
	}
}
