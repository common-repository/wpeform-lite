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
use WPEForm\Model\Form as FormModel;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Authentication abstraction for the Submission.
 *
 * Some of the parts depends on the Form Auth to realize whether current user
 * is the owner or not.
 *
 * This Auth should be used when querying a Submission by Id. If querying a
 * submission by token, then auth should be handled by the controller directly
 * because it probably means, user is not logged in, rather the token is used
 * as a secret, in which case, all access are granted, except of sensitive info.
 */
class Submission extends Base {
	/**
	 * Form auth instance for reference.
	 *
	 * @var Form
	 */
	protected $form_auth;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->form_auth = new Form();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_administrator_caps(): array {
		return [];
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
	 * @param int $user_id WordPress user Id.
	 *
	 * @return bool
	 */
	public function can_user_create( int $user_id ) : bool {
		// all users can create, regardless if logged in
		return true;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function can_current_user_create(): bool {
		// all users can create, regardless if logged in
		return true;
	}

	/**
	 * Get Form Auth and Model in a tuple.
	 *
	 * The return is
	 *
	 * ```php
	 * [ IAuth $form_auth, IModel $form_model ]
	 * ```
	 *
	 * @param IModel $submission_model Submission Model.
	 *
	 * @return (IAuth, IModel)
	 */
	protected function get_form_auth_and_model( IModel $submission_model ) : array {
		$form_model = new FormModel();
		$form_id = $submission_model->read()['formId'];
		$form_model->set_id( $form_id );
		return [ $this->form_auth, $form_model ];
	}

	/**
	 * Check if user is the submission owner as stored in database.
	 *
	 * @param int    $user_id WordPress user id.
	 * @param IModel $model Submission Model.
	 *
	 * @return bool
	 */
	protected function is_user_submission_owner( int $user_id, IModel $model ) : bool {
		$submission_data = $model->read();
		if ( (int) $submission_data['userId'] === $user_id ) {
			return true;
		}
		return false;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int    $user_id WordPress user Id.
	 * @param IModel $model Submission Model.
	 *
	 * @return bool
	 */
	public function can_user_edit( int $user_id, IModel $model ) : bool {
		// return true if auth is bypassed.
		if ( $this->get_auth_bypass() ) {
			return true;
		}

		// in case of edit, submission owner also has to edit by token, which
		// will bypass this anyway.

		// Now only authenticated users can edit, like creator of form or the one
		// with editor access.
		/** @var IAuth $form_auth */
		/** @var IModel $form_model */
		[ $form_auth, $form_model ] = $this->get_form_auth_and_model(
			$model
		);
		return $form_auth->can_user_edit( $user_id, $form_model );
	}

	/**
	 * Can current user read the model. It implements token based bypass logic.
	 *
	 * @param IModel $model Model.
	 * @return bool
	 */
	public function can_current_user_edit( IModel $model ): bool {
		if ( $this->get_auth_bypass() ) {
			return true;
		}
		return parent::can_current_user_edit( $model );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int    $user_id WordPress User Id.
	 * @param IModel $model Submission Model.
	 *
	 * @return bool
	 */
	public function can_user_read( int $user_id, IModel $model ) : bool {
		// return true if auth is bypassed.
		if ( $this->get_auth_bypass() ) {
			return true;
		}
		// check to see if $user_id is the one in model
		if ( $this->is_user_submission_owner( $user_id, $model ) ) {
			return true;
		}

		// user can read if
		// 1. Is owner/editor of the parent form
		/** @var IAuth $form_auth */
		/** @var IModel $form_model */
		[ $form_auth, $form_model ] = $this->get_form_auth_and_model(
			$model
		);
		return $form_auth->can_user_edit( $user_id, $form_model );
	}

	/**
	 * Can current user read the model. It implements token based bypass logic.
	 *
	 * @param IModel $model Model.
	 * @return bool
	 */
	public function can_current_user_read( IModel $model ): bool {
		if ( $this->get_auth_bypass() ) {
			return true;
		}
		return parent::can_current_user_read( $model );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int    $user_id WordPress User Id.
	 * @param IModel $model Submission Model.
	 *
	 * @return bool
	 */
	public function can_user_read_sensitive_info( int $user_id, IModel $model ) : bool {
		// user can read sensitive info if
		// 1. Is owner/editor of the parent form, i.e form_auth can read sensitive info
		/** @var IAuth $form_auth */
		/** @var IModel $form_model */
		[ $form_auth, $form_model ] = $this->get_form_auth_and_model(
			$model
		);
		return $form_auth->can_user_read_sensitive_info( $user_id, $form_model );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int    $user_id WordPress User Id.
	 * @param IModel $model Submission Model.
	 *
	 * @return bool
	 */
	public function can_user_delete( int $user_id, IModel $model ): bool {
		// user can delete if
		// 1. Is owner/editor of the parent form
		// At this moment, we don't allow submission owner to delete with token.
		/** @var IAuth $form_auth */
		/** @var IModel $form_model */
		[ $form_auth, $form_model ] = $this->get_form_auth_and_model(
			$model
		);
		return $form_auth->can_user_delete( $user_id, $form_model );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id Id of WordPress user.
	 *
	 * @return bool
	 */
	public function can_user_view_trashed( int $user_id ): bool {
		return $this->form_auth->can_user_view_trashed( $user_id );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id ID of WordPress user.
	 *
	 * @return bool
	 */
	public function can_user_manage_others_models( int $user_id ): bool {
		return $this->form_auth->can_user_manage_others_models( $user_id );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id WordPress user Id.
	 *
	 * @return bool
	 */
	public function can_user_read_collection( int $user_id ) : bool {
		// all users can read collection
		// it is upto the controller to properly filter what they can read
		return true;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $user_id WordPress User Id.
	 *
	 * @return bool
	 */
	public function can_user_manage_collection( int $user_id ): bool {
		// delegate the permission to Form Auth
		// this is so because only users who can create forms
		// are form administrator, so can manage submissions as well.
		return $this->form_auth->can_user_manage_collection( $user_id );
	}
}
