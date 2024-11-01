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
 * @subpackage Controller
 */

namespace WPEForm\Controller;

use WPEForm\Exception\ResourceDoesNotExistException;
use WPEForm\Exception\InsufficientPermissionException;
use WPEForm\Exception\InvalidCrudOperationException;
use WPEForm\Exception\InvalidOperationException;
use WPEForm\Exception\ValidationException;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * An abstract class for all controllers.
 *
 * It provides all methods for basic CRUD and a few helpers.
 */
abstract class Base {
	/**
	 * Model class instance.
	 *
	 * @var \WPEForm\Model\IModel
	 */
	protected $model;

	/**
	 * Auth class instance
	 *
	 * @var \WPEForm\Auth\IAuth
	 */
	protected $auth;

	/**
	 * Create an instance.
	 *
	 * @param \WPEForm\Model\IModel $model Model class instance.
	 * @param \WPEForm\Auth\IAuth   $auth Base class instance.
	 */
	public function __construct( \WPEForm\Model\IModel $model, \WPEForm\Auth\IAuth $auth ) {
		$this->model = $model;
		$this->auth = $auth;
	}

	/**
	 * Get GraphQL compatible data from model for a single resource.
	 *
	 * @return array
	 */
	abstract protected function get_data_from_model();

	/**
	 * Get metadata needed by client-side system for this controller.
	 *
	 * Override in child-classes to implement functionality.
	 *
	 * @param ResolveInfo|null $resolveInfo Resolve Info from graphql-php.
	 * @param array|null       $args Arguments passed to the Query.
	 *
	 * @return array
	 */
	protected function metadata( ?ResolveInfo $resolveInfo = null, $args = [] ) : array {
		return [];
	}

	/**
	 * Get metadata needed by client-side system for this controller/model.
	 *
	 * @throws InsufficientPermissionException If current user can not create a resource and thereby do not need the meta query.
	 *
	 * @param ResolveInfo|null $resolveInfo Resolve Info from graphql-php.
	 * @param array|null       $args Arguments passed to the Query.
	 *
	 * @return array
	 */
	public function get_metadata( ?ResolveInfo $resolveInfo = null, $args = [] ) : array {
		return $this->metadata( $resolveInfo, $args );
	}

	/**
	 * Create a resource in Database.
	 *
	 * Maps to `createResource` mutation.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the resource could not be created.
	 *
	 * @param array $data Resource data.
	 * @return array
	 */
	public function create( $data ) {
		$this->model->set_id( null );
		// Check if user is able to perform this
		if ( ! $this->auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user can not create the resource.' );
		}
		$this->model->create( $data );
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource could not be created.' );
		}
		return $this->get_data_from_model();
	}

	/**
	 * Get a single resource.
	 *
	 * Maps to `resource(id: ID!)` query.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the resource doesn't exist or is trashed.
	 *
	 * @param int         $id Id of resource.
	 * @param string|null $token Token of the resource. Passed to the model.
	 * @return array
	 */
	public function read( $id, $token = null ) {
		// bypass all authentication if querying by token
		if ( $token !== null ) {
			$this->auth->set_auth_bypass( true );
		}
		// Check if user is able to perform this
		$this->model->set_id( $id, $token );
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource requested does not exist.' );
		}
		if ( ! $this->auth->can_current_user_read( $this->model ) ) {
			throw new InsufficientPermissionException( 'Current user can not read the resource.' );
		}
		if ( $this->model->is_trashed() ) {
			throw new ResourceDoesNotExistException( 'The resource requested is trashed.' );
		}
		// reset auth bypass
		$this->auth->set_auth_bypass( false );

		return $this->get_data_from_model();
	}


	/**
	 * Normalize export data. Use this to remove sensitive data from the model.
	 *
	 * @param array $data Model data.
	 * @return array Normalized data.
	 * @throws InvalidOperationException Child class must override, else it will throw this error.
	 */
	protected function normalize_export( array $data ) : array {
		$classname = \get_class( $this );
		throw new InvalidOperationException( "Class {$classname} does not override normalize_export function." );
		return $data; // phpcs:ignore Squiz.PHP.NonExecutableCode.Unreachable
	}

	/**
	 * Export data functionality. To use this feature, child class must override
	 * `normalize_export` function.
	 *
	 * @param int  $id Id of the model to export.
	 * @param bool $bypass_auth Whether or not to bypass auth. Default `false`.
	 * @return array Exported data.
	 *
	 * @throws ResourceDoesNotExistException If resource does not exist.
	 * @throws InsufficientPermissionException If current user does not have sufficient permission.
	 */
	public function export( $id, bool $bypass_auth = false ) : string {
		// Check if user is able to perform this
		$this->model->set_id( $id );
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource requested does not exist.' );
		}
		// bypass auth if needed
		if ( $bypass_auth ) {
			$this->auth->set_auth_bypass( true );
		}
		if ( ! $bypass_auth && ! $this->auth->can_current_user_read_sensitive_info( $this->model ) ) {
			throw new InsufficientPermissionException( 'Current user can not read the resource.' );
		}
		if ( $this->model->is_trashed() ) {
			throw new ResourceDoesNotExistException( 'The resource requested is trashed.' );
		}

		$data = $this->normalize_export(
			$this->get_data_from_model()
		);
		$data = \json_encode( $data );
		// reset auth bypass
		$this->auth->set_auth_bypass( false );
		return $data;
	}

	/**
	 * Normalize import data.
	 *
	 * @param array $data User input data.
	 * @return array Normalized data.
	 * @throws InvalidOperationException Child class must override, else it will throw this error.
	 */
	protected function normalize_import( array $data ) : array {
		$classname = \get_class( $this );
		throw new InvalidOperationException( "Class {$classname} does not override normalize_import function." );
		return $data; // phpcs:ignore Squiz.PHP.NonExecutableCode.Unreachable
	}

	/**
	 * Import data from user stored string.
	 *
	 * @param string $data String export code as given by user.
	 * @return int Resource Id if successful.
	 * @throws InsufficientPermissionException If current user cannot create the resource.
	 * @throws ValidationException If data is invalid.
	 */
	public function import( string $data ) : int {
		if ( ! $this->auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user can not create the resource.' );
		}

		// deserialize the data
		if ( ! \is_string( $data ) ) {
			throw new ValidationException( 'Invalid data passed for import.' );
		}
		$data = \json_decode( $data, true );
		if ( \json_last_error() !== \JSON_ERROR_NONE ) {
			throw new ValidationException( 'Invalid data passed for import.' );
		}

		if ( ! \is_array( $data ) ) {
			throw new ValidationException( 'Invalid data passed for import.' );
		}

		$data = $this->normalize_import( $data );
		$this->create( $data );

		return $this->model->get_id();
	}

	/**
	 * Get proper model data from a template data. This normalizes the template
	 * data and returns the normalized data with a fake id and token.
	 *
	 * @param string $data Template data.
	 * @return array Model data.
	 * @throws ValidationException If data is invalid.
	 */
	public function get_template_data( string $data ) : array {
		// deserialize the data
		if ( ! \is_string( $data ) ) {
			throw new ValidationException( 'Invalid data passed for preview template.' );
		}
		$data = \json_decode( $data, true );
		if ( \json_last_error() !== \JSON_ERROR_NONE ) {
			throw new ValidationException( 'Invalid data passed for preview template.' );
		}

		$data = $this->normalize_import( $data );
		$data['id'] = 'non-existing';
		$this->model->set_data( null, 'non-existing', $data );
		$graphql_data = $this->get_data_from_model();
		$graphql_data['id'] = 'non-existing';
		return $graphql_data;
	}

	/**
	 * Normalize duplicate data.
	 *
	 * @param array $data User input data.
	 * @return array Normalized data.
	 * @throws InvalidOperationException Child class must override, else it will throw this error.
	 */
	protected function normalize_duplicate( array $data ) : array {
		$classname = \get_class( $this );
		throw new InvalidOperationException( "Class {$classname} does not override normalize_duplicate function." );
		return $data; // phpcs:ignore Squiz.PHP.NonExecutableCode.Unreachable
	}

	/**
	 * Duplicate a mode.
	 *
	 * @param mixed $id Id of the model to duplicate.
	 * @return int Id of the duplciated model.
	 *
	 * @throws InsufficientPermissionException If current user cannot create a model or cannot read existing model.
	 * @throws ResourceDoesNotExistException If model does not exist.
	 */
	public function duplicate( $id ) : int {
		if ( ! $this->auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user can not create the resource.' );
		}
		$this->model->set_id( $id );
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource requested does not exist.' );
		}
		if ( ! $this->auth->can_current_user_read_sensitive_info( $this->model ) ) {
			throw new InsufficientPermissionException( 'Current user can not read the resource.' );
		}
		$data = $this->normalize_duplicate(
			$this->model->read()
		);
		$this->create( $data );

		return $this->model->get_id();
	}

	/**
	 * Update a resource in Database.
	 *
	 * Maps to `updateResource` mutation.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the resource doesn't exist.
	 * @throws InvalidCrudOperationException If the resource is trashed.
	 *
	 * @param int         $id Id of resource.
	 * @param array       $data Resource data to update.
	 * @param string|null $token Token of the resource. Passed to the model.
	 * @return array
	 */
	public function update( $id, $data, $token = null ) {
		// bypass all authentication if querying by token
		if ( $token !== null ) {
			$this->auth->set_auth_bypass( true );
		}

		// Check if user is able to perform this
		$this->model->set_id( $id, $token );
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource requested does not exist.' );
		}
		if ( ! $this->auth->can_current_user_edit( $this->model ) ) {
			throw new InsufficientPermissionException( 'Current user can not edit the resource.' );
		}
		if ( $this->model->is_trashed() ) {
			throw new InvalidCrudOperationException( 'The resource requested is trashed.' );
		}

		$this->model->update( $data );

		// reset all auth bypass
		$this->auth->set_auth_bypass( false );
		return $this->get_data_from_model();
	}

	/**
	 * Check to see if a model can be deleted by current user.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the model doesn't exist.
	 * @throws InvalidCrudOperationException If the model isn't trashed.
	 */
	protected function can_delete() {
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource requested does not exist.' );
		}
		// Check if user is able to perform this
		if ( ! $this->auth->can_current_user_delete( $this->model ) ) {
			throw new InsufficientPermissionException( 'Current user can not delete the resource.' );
		}
		if ( ! $this->model->is_trashed() ) {
			throw new InvalidCrudOperationException( 'The resource needs to be trashed first.' );
		}
	}

	/**
	 * Delete a model in Database.
	 *
	 * @param int $id Model Id.
	 * @return bool
	 */
	public function delete( $id ) {
		$this->model->set_id( $id );
		$this->can_delete();

		$this->model->delete();

		return true;
	}

	/**
	 * Check to see if a model can be trashed by the current user.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the model doesn't exist.
	 * @throws InvalidCrudOperationException If the model is already trashed.
	 */
	protected function can_trash() {
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource requested does not exist.' );
		}
		// Check if user is able to perform this
		if ( ! $this->auth->can_current_user_delete( $this->model ) ) {
			throw new InsufficientPermissionException( 'Current user can not trash the resource.' );
		}
		if ( $this->model->is_trashed() ) {
			throw new InvalidCrudOperationException( 'The resource is already trashed.' );
		}
	}

	/**
	 * Trash a model in Database.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the model doesn't exist.
	 * @throws InvalidCrudOperationException If the model is already trashed.
	 *
	 * @param int $id Model Id.
	 * @return bool
	 */
	public function trash( $id ) {
		$this->model->set_id( $id );
		$this->can_trash();

		$this->model->trash();

		return true;
	}

	/**
	 * Check to see if a model can be trashed by the current user.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the model doesn't exist.
	 * @throws InvalidCrudOperationException If the model is not trashed.
	 */
	protected function can_untrash() {
		if ( ! $this->model->exists() ) {
			throw new ResourceDoesNotExistException( 'The resource requested does not exist.' );
		}
		// Check if user is able to perform this
		if ( ! $this->auth->can_current_user_delete( $this->model ) ) {
			throw new InsufficientPermissionException( 'Current user can not untrash the resource.' );
		}
		if ( ! $this->model->is_trashed() ) {
			throw new InvalidCrudOperationException( 'The resource is not trashed.' );
		}
	}
	/**
	 * Untrash a model in Database.
	 *
	 * @param int $id Model Id.
	 * @return true
	 */
	public function untrash( $id ) {
		$this->model->set_id( $id );
		$this->can_untrash();

		$this->model->untrash();

		return true;
	}

	/**
	 * Normalize a single node of edges used in GraphQL.
	 *
	 * @param array $node Raw node as retrieved from database.
	 * @param array $pagination Pagination arguments.
	 * @param array $filter Filter arguments.
	 * @return array
	 */
	abstract protected function normalize_collection_node( $node, $pagination, $filter );

	/**
	 * Verify filter values on collection with the auth.
	 *
	 * By default it does nothing. But should your filters be restricted to a
	 * certain auth-level you need to override it and throw Exception.
	 *
	 * Also under certain circumstances, you might want to change the filter. For
	 * example, if a user is viewing trashed collection, but can not untrash others'
	 * resources, restrict it to his/her own collection.
	 *
	 * @param null|array $filter Filter arguments.
	 * @return array
	 */
	protected function verify_filters_with_auth( ?array $filter ) : array {
		if ( ! \is_array( $filter ) ) {
			$filter = [];
		}
		return $filter;
	}

	/**
	 * Verify collection operation amount. It would throw if the number
	 * exceeds permissible amount.
	 *
	 * @param int $number Number of collection operation.
	 * @return void
	 * @throws InvalidCrudOperationException If number exceeds amount.
	 */
	protected function verify_collection_operation_amount( int $number ) : void {
		// set a hard limit of 150 in collection operation
		if ( $number > 150 ) {
			throw new InvalidCrudOperationException( 'Too many items in current operation.' );
		}
	}

	/**
	 * Get multiple model with pagination.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 *
	 * @param array $pagination Pagination arguments.
	 * @param array $filter Filter arguments.
	 *
	 * @return array
	 */
	public function collection( $pagination, $filter ) {
		$this->model->set_id( null );
		// Check if user is able to perform this
		if ( ! $this->auth->can_current_user_read_collection() ) {
			throw new InsufficientPermissionException( 'Current user can not read the resource.' );
		}
		$filter = $this->verify_filters_with_auth( $filter );

		$collection_from_model = $this->model->collection( $pagination, $filter );

		// Init collection data
		$collection = [];

		// Add totalcount
		$collection['totalCount'] = $collection_from_model['all_edges_count'];
		$collection['pageInfo'] = [
			'hasNextPage' => $collection_from_model['has_next_page'],
			'hasPreviousPage' => $collection_from_model['has_previous_page'],
			'endCursor' => null,
			'startCursor' => null,
		];

		// If there are any edges, then normalize them with cursor information
		if ( ! empty( $collection_from_model['edges'] ) ) {
			$collection['edges'] = [];
			foreach ( $collection_from_model['edges'] as $node ) {
				$collection['edges'][] = [
					'node' => $this->normalize_collection_node( $node, $pagination, $filter ),
					'cursor' => $node['cursor'],
				];
			}
			$collection['pageInfo']['endCursor'] = $collection['edges'][ \count( $collection['edges'] ) - 1 ]['cursor'];
			$collection['pageInfo']['startCursor'] = $collection['edges'][0]['cursor'];
		} else {
			$collection['edges'] = [];
		}

		return $collection;
	}

	/**
	 * Trash multiple models.
	 *
	 * This is an abstraction over single methods. We implement this and not
	 * with a collection model method, because each model needs to have sanity
	 * and auth check individually. If even one of them throws an error, then
	 * mark the whole operation invalid.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ValidationException If list of ids is empty.
	 *
	 * @param array $ids Ids of models.
	 * @return boolean True on all success, false on any failure.
	 */
	public function trash_collection( array $ids ): bool {
		// throw if user can not perform this action at all
		if ( ! $this->auth->can_current_user_manage_collection() ) {
			throw new InsufficientPermissionException( 'Current user can not trash collection.' );
		}
		// if ids is an empty array, then throw too
		if ( empty( $ids ) ) {
			throw new ValidationException( 'Ids can not be empty.' );
		}
		// throw if exceeds operation number
		$this->verify_collection_operation_amount( \count( $ids ) );
		$this->model->pre_cache_ids( $ids );
		// first loop over and perform checks for every model
		foreach ( $ids as $id ) {
			$this->model->set_id( $id );
			$this->can_trash();
		}

		// we are here, so no exceptions were thrown
		$this->model->clear_pre_cache_ids();
		$this->model->trash_collection( $ids );

		return true;
	}

	/**
	 * Untrash multiple models
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ValidationException If list of ids is empty.
	 *
	 * @param array $ids Ids of models.
	 * @return boolean True on all success, false on any failure.
	 */
	public function untrash_collection( array $ids ): bool {
		// throw if user can not perform this action at all
		if ( ! $this->auth->can_current_user_manage_collection() ) {
			throw new InsufficientPermissionException( 'Current user can not untrash collection.' );
		}
		// if ids is an empty array, then throw too
		if ( empty( $ids ) ) {
			throw new ValidationException( 'Ids can not be empty.' );
		}
		// throw if exceeds operation number
		$this->verify_collection_operation_amount( \count( $ids ) );
		$this->model->pre_cache_ids( $ids );
		// first loop over and perform checks
		foreach ( $ids as $id ) {
			$this->model->set_id( $id );
			$this->can_untrash();
		}

		// we are here, so no exceptions were thrown
		$this->model->clear_pre_cache_ids();
		$this->model->untrash_collection( $ids );
		return true;
	}

	/**
	 * Delete a collection of models.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ValidationException If list of ids is empty.
	 *
	 * @param array $ids Ids of models.
	 * @return boolean True on all success, false on any failure.
	 */
	public function delete_collection( array $ids ): bool {
		// throw if user can not perform this action at all
		if ( ! $this->auth->can_current_user_manage_collection() ) {
			throw new InsufficientPermissionException( 'Current user can not delete collection.' );
		}
		// if ids is an empty array, then throw too
		if ( empty( $ids ) ) {
			throw new ValidationException( 'Ids can not be empty.' );
		}
		// throw if exceeds operation number
		$this->verify_collection_operation_amount( \count( $ids ) );
		$this->model->pre_cache_ids( $ids );
		// first loop over and perform checks
		foreach ( $ids as $id ) {
			$this->model->set_id( $id );
			$this->can_delete();
		}

		// we are here, so no exceptions were thrown
		$this->model->clear_pre_cache_ids();
		$this->model->delete_collection( $ids );
		return true;
	}
}
