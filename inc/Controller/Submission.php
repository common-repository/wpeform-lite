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

use WPEForm\Exception\InsufficientPermissionException;
use WPEForm\Handler\Submission as SubmissionHandler;
use WPEForm\Util\Crypt;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\Model\Form as FormModel;
use WPEForm\Model\Submission as SubmissionModel;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\CoR\Submission\ConditionalsProcessor;
use WPEForm\CoR\Submission\ElementsProcessor;
use WPEForm\CoR\Submission\IntegrationsRunner;
use WPEForm\CoR\Submission\PermissionsPresaveMutationsRunner;
use WPEForm\CoR\Submission\PermissionsSideEffectsRunner;
use WPEForm\CoR\Submission\PostSubmissionLimitationsChecker;
use WPEForm\CoR\Submission\PreemptiveLimitationsProcessor;
use WPEForm\CoR\Submission\SettingsMutationsRunner;
use WPEForm\CoR\Submission\SettingsPreprocessor;
use WPEForm\CoR\Submission\SettingsSideEffectsRunner;
use WPEForm\Exception\ResourceDoesNotExistException;

use function WPEForm\Helpers\parse_args;
use function WPEForm\Helpers\validate_is_url;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Submission controller class.
 */
class Submission extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	protected function get_data_from_model() {
		$return_data = $this->model->read();

		// arrange for the handler
		$handler = SubmissionHandler::get_instance_from_models(
			$this->model,
			$this->auth,
			false,
			false
		);

		$normalized_data = [
			'id' => $this->model->get_id(),
			'formId' => $return_data['formId'],
			'fName' => $return_data['fName'],
			'lName' => $return_data['lName'],
			'email' => $return_data['email'],
			'phone' => $return_data['phone'],
			'elements' => $return_data['elements'],
			'ip' => $return_data['ip'], // sensitive
			'score' => $return_data['score'],
			'maxScore' => $return_data['maxScore'],
			'scoreData' => $return_data['scoreData'],
			'urlTrack' => $return_data['urlTrack'], // sensitive
			'created' => $return_data['created'],
			'lastUpdated' => $return_data['lastUpdated'],
			'adminRemarks' => $return_data['adminRemarks'],
			'userId' => $return_data['userId'],
			'canUserEdit' => $handler->get_can_user_edit(),
			'referer' => $return_data['referer'], // sensitive
			'paid' => $handler->get_paid_for_graphql(),
			'time' => $return_data['time'],
			'token' => $return_data['token'],
			'submissionLink' => $handler->get_submission_link(),

		];
		// remove sensitive data if needed
		if (
			! $this->auth->can_current_user_read_sensitive_info( $this->model )
		) {
			$normalized_data['ip'] = null;
			$normalized_data['urlTrack'] = null;
			$normalized_data['referer'] = null;
			$normalized_data['downloadLink'] = $handler->get_submission_download_link( false );
			$normalized_data['printLink'] = $handler->get_submission_print_link( false );
		} else {
			$normalized_data['downloadLink'] = $handler->get_submission_download_link( true );
			$normalized_data['printLink'] = $handler->get_submission_print_link( true );
		}

		return $normalized_data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws InsufficientPermissionException If user can not manage collection.
	 *
	 * @param ResolveInfo|null $resolveInfo Resolve Info from graphql-php.
	 * @param array|null       $args Arguments passed to the Query.
	 *
	 * @return array
	 */
	protected function metadata( ?ResolveInfo $resolveInfo = null, $args = [] ): array {
		$metadata = [
			'categories' => [],
			'owners' => [],
			'forms' => [],
			'formOwners' => [],
		];

		$resolve_fields = $resolveInfo->getFieldSelection( 1 );
		// determine whether to resolve categories and owners
		$resolve_categories = \array_key_exists( 'categories', $resolve_fields );
		$resolve_owners = \array_key_exists( 'owners', $resolve_fields );
		$resolve_forms = \array_key_exists( 'forms', $resolve_fields );
		$resolve_form_owners = \array_key_exists( 'formOwners', $resolve_fields );

		$model_filters = [];

		// if not querying as administrator, then just list the forms the current user
		// has submissions under
		if ( ! $args['asAdmin'] ) {
			if ( ! $this->auth->is_user_logged_in() ) {
				throw new InsufficientPermissionException( 'User must be logged in for the query.' );
			}
			if ( $args['resourceView'] !== 'owned' ) {
				throw new InsufficientPermissionException( 'User can only query for owned resources.' );
			}
			$model_filters = [
				'as_admin' => false,
				'resolve_owners' => false,
				'resolve_categories' => $resolve_categories,
				'resolve_forms' => $resolve_forms,
				'resolve_form_owners' => false,
				'view_mode' => 'owned',
				'current_user_id' => $this->auth->get_current_user_id(),
				'can_manage_other_models' => false,
			];
		} else {
			// user is querying as administrator, so do the needful.
			// we would list all available categories, userIds
			// if user can not access collection as admin, then throw
			if ( ! $this->auth->can_current_user_manage_collection() ) {
				throw new InsufficientPermissionException( 'Current user can not read submission metadata.' );
			}

			$can_manage_others_models = $this->auth->can_current_user_manage_others_models();

			// resolve the view mode
			$view_mode = 'owned';
			if (
				$can_manage_others_models
				&& $args['resourceView'] === 'all'
			) {
				$view_mode = 'all';
			} elseif ( $args['resourceView'] === 'shared' ) {
				$view_mode = 'shared';
			} elseif ( $args['resourceView'] === 'trashed' ) {
				$view_mode = 'trashed';
			}

			// resolve form owners safety checks
			if ( $view_mode === 'owned' ) {
				$resolve_form_owners = false;
			}
			if ( $view_mode === 'trashed' && ! $can_manage_others_models ) {
				$resolve_form_owners = false;
			}

			$model_filters = [
				'as_admin' => true,
				// unlike Form controller, these are submission owners, so all kinds of
				// views would have them.
				'resolve_owners' => $resolve_owners,
				'resolve_categories' => $resolve_categories,
				'resolve_forms' => $resolve_forms,
				'resolve_form_owners' => $resolve_form_owners,
				'view_mode' => $view_mode,
				'current_user_id' => $this->auth->get_current_user_id(),
				'can_manage_other_models' => $can_manage_others_models,
			];
		}

		if ( $resolve_categories || $resolve_owners || $resolve_forms || $resolve_form_owners ) {
			$model_collection_filters = $this->model->metadata_collection_filters(
				$model_filters
			);

			$categories = $model_collection_filters['categories'];
			$owners = $model_collection_filters['owners'];
			$forms = $model_collection_filters['forms'];
			$form_owners = $model_collection_filters['form_owners'];

			if ( $resolve_categories ) {
				$metadata['categories'] = \is_array( $categories ) ? $categories : [];
			}
			if ( $resolve_owners ) {
				$metadata['owners'] = \is_array( $owners ) ? $owners : [];
			}
			if ( $resolve_forms ) {
				$metadata['forms'] = \is_array( $forms ) ? $forms : [];
			}
			if ( $resolve_form_owners ) {
				$metadata['formOwners'] = \is_array( $form_owners ) ? $form_owners : [];
			}
		}

		return $metadata;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $data Data from user input.
	 *
	 * @return array
	 */
	public function create( $data ) {
		// create a handler
		$handler = new SubmissionHandler(
			$data['formId'],
			$data['elements'],
			false,
			$this->auth,
			null,
			false,
			false
		);

		// Create and set a new token
		$handler->set_token( Crypt::create_token( 16 ) );

		// Set other values
		$referer = $data['referer'] ?? '';
		if ( ! validate_is_url( $referer ) ) {
			$referer = '';
		}
		$handler->set_referer( $referer );

		$handler->clock()->set_date( \current_time( 'mysql', true ) );
		$handler->clock()->set_time( $data['time'] ?? 0 );

		$pre_processors = new SettingsPreprocessor();

		$pre_processors
			->link_with( new PreemptiveLimitationsProcessor() )
			->link_with( new ConditionalsProcessor() )
			->link_with( new ElementsProcessor() )
			->link_with( new SettingsMutationsRunner() )
			->link_with( new PermissionsPresaveMutationsRunner() )
			// Check post submission limitations
			// It is done after settings mutation because it may depend on primitive
			// or elements values.
			->link_with( new PostSubmissionLimitationsChecker() );

		// Run processors chain.
		$pre_processors->process( $handler );

		// process payment intent
		// we need to do it before saving data because get_paid depends on it
		// $handler->process_payment_intent();

		// extract db data we need to store
		$dbdata = [
			'formId' => $data['formId'],
			'fName' => $handler->primitives()->get_primitive( 'fName' ),
			'lName' => $handler->primitives()->get_primitive( 'lName' ),
			'email' => $handler->primitives()->get_primitive( 'email' ),
			'phone' => $handler->primitives()->get_primitive( 'phone' ),
			'elements' => $handler->elements()->get_processed_elements(),
			'ip' => $handler->primitives()->get_primitive( 'ip' ),
			'score' => $handler->score()->get_score_obtained(),
			'maxScore' => $handler->score()->get_max_score(),
			'scoreData' => $handler->score()->get_score_data(),
			'urlTrack' => $data['urlTrack'] ?? '',
			'created' => $handler->clock()->get_date(),
			'lastUpdated' => null,
			'userId' => $handler->primitives()->get_primitive( 'userId' ),
			'referer' => $handler->get_referer(),
			'paid' => $handler->get_paid(),
			'time' => $handler->clock()->get_time(),
			'token' => $handler->get_token(),
		];

		// store it in db
		$return = parent::create( $dbdata );

		// set the submission id
		$handler->set_submission_id( (string) $return['id'] );

		$post_processor = new SettingsSideEffectsRunner();

		$post_processor
			->link_with( new IntegrationsRunner() )
			->link_with( new PermissionsSideEffectsRunner() );

		$post_processor->process( $handler );

		// if this submission is being made by the form owner
		// then increase the form view count to maintain consistency
		$form_owner_id = (int) $handler->get_form_model()->read()['ownerid'];
		$form_editor_ids = $handler->get_form_model()->read_meta( \WPEForm\Controller\Form::EDITOR_METAKEY );
		$form_editor_ids = \array_map( 'intval', $form_editor_ids );
		$current_user_id = (int) \get_current_user_id();

		if (
			$form_owner_id === $current_user_id
			|| \in_array( $current_user_id, $form_editor_ids )
		) {
			FormModel::increase_form_view_count( $data['formId'] );
		}

		return $handler->append_data_to_model(
			$return,
			false
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int         $id Id of resource.
	 * @param array       $args Resource data to update.
	 * @param string|null $token Token of the resource. Passed to the model.
	 * @return array
	 *
	 * @throws InsufficientPermissionException If user update and cannot update submission.
	 * @throws ResourceDoesNotExistException If formId from data doesn't match the one from old submission.
	 */
	public function update( $id, $args, $token = null ) {
		$data = $args['data'];

		// first cross-reference formId
		$this->model->set_id( $id, $token );
		$old_submission_data = $this->model->read();

		// get formId from old data
		$form_id_from_submission = \absint( $old_submission_data['formId'] ?? 0 );
		$current_form_id_from_data = \absint( $data['formId'] );

		if (
			$form_id_from_submission === 0
			|| $form_id_from_submission !== $current_form_id_from_data
		) {
			throw new ResourceDoesNotExistException( 'Given resource is invalid.' );
		}

		$is_admin_update = $token === null;

		// create a handler
		// this automatically checks if the form exists or not
		$handler = new SubmissionHandler(
			$data['formId'],
			$data['elements'],
			false,
			$this->auth,
			null,
			true,
			$is_admin_update
		);

		// pre-emptively set values in handler
		$handler->set_token( $old_submission_data['token'] );
		$handler->clock()->set_time( $data['time'] ?? 0 );
		$handler->set_submission_id( (string) $this->model->get_id() );

		// Set other values
		$handler->set_referer( $old_submission_data['referer'] );
		$handler->clock()->set_date( $old_submission_data['created'] );

		// set remarks, only if in admin mode
		$remarks = $args['remarks'] ?? null;
		if ( $is_admin_update ) {
			$handler->set_admin_remarks( $remarks ?? '' );
		} else {
			if ( ! \is_null( $remarks ) ) {
				throw new InsufficientPermissionException( 'Current operation cannot have remarks.' );
			}
		}

		// Run preprocessors chain.
		$pre_processor = new SettingsPreprocessor();

		$pre_processor
			->link_with( new ConditionalsProcessor() )
			->link_with( new ElementsProcessor() )
			->link_with( new SettingsMutationsRunner() )
			->link_with( new PermissionsPresaveMutationsRunner() );

		$pre_processor->process( $handler );

		// Run preprocessors
		// $handler->run_settings_preprocessors( true, $is_admin_update );

		// process elements
		// $handler->process_elements();
		// no need to run payments in updation
		// but do run mutations from settings registry
		// $handler->run_settings_mutations( true, $is_admin_update );

		// Run pre save permissions mutations
		// $handler->run_permissions_presave_mutations( true );

		// Now if token is not null, then assume this is user update
		// In which case, we ask the handler if user can update this
		if ( ! $is_admin_update && ! $handler->get_can_user_edit() ) {
			throw new InsufficientPermissionException( 'The resource cannot be updated.' );
		}

		// extract db data we need to store
		$dbdata = [
			'fName' => $handler->primitives()->get_primitive( 'fName' ),
			'lName' => $handler->primitives()->get_primitive( 'lName' ),
			'email' => $handler->primitives()->get_primitive( 'email' ),
			'phone' => $handler->primitives()->get_primitive( 'phone' ),
			'elements' => $handler->elements()->get_processed_elements(),
			'ip' => $handler->primitives()->get_primitive( 'ip' ),
			'score' => $handler->score()->get_score_obtained(),
			'maxScore' => $handler->score()->get_max_score(),
			'scoreData' => $handler->score()->get_score_data(),
			'urlTrack' => $data['urlTrack'] ?? '',
			'lastUpdated' => \current_time( 'mysql', true ),
			// add the time
			'time' => $handler->clock()->get_time() + $old_submission_data['time'],
		];

		if ( $is_admin_update ) {
			$dbdata['adminRemarks'] = $remarks;
		}

		// update it in db
		$return = parent::update( $id, $dbdata, $token );

		// Run post processing chain.
		$post_processor = new SettingsSideEffectsRunner();

		$post_processor
			->link_with( new IntegrationsRunner() )
			->link_with( new PermissionsSideEffectsRunner() );

		$post_processor->process( $handler );

		// process settings
		// $handler->run_settings_side_effects( true, $is_admin_update );
		// $handler->run_integrations( true );

		// process permissions side effects
		// $handler->run_permissions_side_effects( true );

		// return data
		return $handler->append_data_to_model(
			$return,
			true
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws InsufficientPermissionException If user tries to filter by trashed and cannot delete.
	 * @throws ResourceDoesNotExistException If filter by formId and form doesn't exist.
	 *
	 * @param null|array $filter Filter arguments.
	 * @return array
	 */
	protected function verify_filters_with_auth( ?array $filter ) : array {
		// calling this because, it essentially converts a null value to an array
		$filter = parent::verify_filters_with_auth( $filter );

		// For now collections will only accept authenticated requests
		// TODO: Remove this when !$as_admin is processed
		if ( ! $this->auth->is_user_logged_in() ) {
			throw new InsufficientPermissionException( 'You must be logged in for this query.' );
		}

		// make sure we have proper asAdmin parameter
		$as_admin = $filter['asAdmin'] ?? false;
		$current_user = $this->auth->get_current_user_id();
		$resource_view = $filter['resourceView'] ?? 'all';
		$filter['resourceView'] = $resource_view;

		// restrict filters if user is not doing things as admin
		if ( ! $as_admin ) {
			// TODO: Make anonymous requests possible with a server-generated auth token
			// set submissionOwner and remove owner, trashed and shared
			// Throw if submissionOwner is set and is not current user
			if ( isset( $filter['submissionOwner'] ) && $filter['submissionOwner'] !== $current_user ) {
				throw new InsufficientPermissionException( 'Current user cannot filter by submission owner.' );
			}
			$filter['submissionOwner'] = $current_user;
			// but still throw if request has passed in something unusual
			if ( isset( $filter['formOwner'] ) ) {
				throw new InsufficientPermissionException( 'Current request cannot filter by form owner.' );
			}

			// If not viewing owned resources, then bail
			if ( $resource_view !== 'owned' ) {
				throw new InsufficientPermissionException( 'Current request can only filter by owned resources.' );
			}

			// set those to falsy, because model won't check for anything
			$filter['asAdmin'] = false;
			$filter['resourceView'] = 'owned';
			$filter['formOwner'] = 0;
			// user may or maynot want to filter by a particular form, so we leave
			// formId as-is
		} else {
			// since doing as admin, only users who can create forms, can list submission
			$form_auth = new FormAuth();
			if ( ! $form_auth->can_current_user_create() ) {
				throw new InsufficientPermissionException( 'Current user can not read the resource.' );
			}

			$can_manage_others_models = $this->auth->can_current_user_manage_others_models();
			// user is asking collection with admin priviledges
			// so check the priviledges
			// CHECK FOR formOwner
			if (
				isset( $filter['formOwner'] )
			) {
				// If formOwner is not current user, and current user cannot manage
				// other forms, then throw error
				if (
					\intval( $filter['formOwner'] ) !== $current_user
					&& ! $can_manage_others_models
				) {
					throw new InsufficientPermissionException( 'Current user can not filter by owner.' );
				}
				// else either formOwner is set to current user, or current user can
				// manage others models, so we are cool
			} else {
				// formOwner not set, if user can manage others models, then leave
				// as-is, else set formOwner to the current user
				if ( ! $can_manage_others_models ) {
					$filter['formOwner'] = $current_user;
				}
			}

			// Finally override formOwner if resource_view is to owned or shared
			// if shared or owned is set, then model expects to get shared with or owned by
			// $filter['formOwner'], in which case, override the $filter['formOwner']
			if ( $resource_view === 'owned' || $resource_view === 'shared' ) {
				$filter['formOwner'] = $current_user;
			}

			// CHECK FOR trashed
			// If we have a filter/trashed set
			if ( $resource_view === 'trashed' ) {
				// but current user can not view trashed
				if ( ! $this->auth->can_current_user_view_trashed() ) {
					throw new InsufficientPermissionException( 'Current user can not filter by trashed.' );
				}
				// no need to set $filter['formOwner'] at this point, because without manage_others_models
				// it is already set.
			}
		}

		// CHECK FOR formId both as_admin and without
		if ( isset( $filter['formId'] ) ) {
			$form_model = new FormModel();
			$form_model->set_id( $filter['formId'] );
			// first check if the form actually exists
			if ( ! $form_model->exists() ) {
				throw new ResourceDoesNotExistException( 'The form cannot be found.' );
			}

			// If querying for a specific form in admin mode, then user must have
			// authentication to read sensitive info from that form.
			if ( $as_admin ) {
				$form_auth = new FormAuth();
				if ( ! $form_auth->can_current_user_read_sensitive_info( $form_model ) ) {
					throw new InsufficientPermissionException( 'Current user cannot filter by this form as an administrator.' );
				}
				// at this point, null out the formOwner
				$filter['formOwner'] = null;
			}
		}
		return $filter;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $node Raw node as retrieved from database.
	 * @param array $pagination Pagination arguments.
	 * @param array $filter Filter arguments.
	 *
	 * @return array
	 */
	protected function normalize_collection_node( $node, $pagination, $filter ) {
		$form_model_data = [
			'id' => $node['formId'],
			'name' => $node['formName'],
			'integrations' => $node['formIntegrations'],
			'payments' => $node['formPayments'],
			'permissions' => $node['formPermissions'],
			'settings' => $node['formSettings'],
			'styles' => $node['formStyles'],
			'structures' => $node['formStructures'],
			'elements' => $node['formElements'],
			'pools' => $node['formPools'],
			'conditionals' => $node['formConditionals'],
			'updated' => $node['formUpdated'],
			'created' => $node['formCreated'],
			'ownerid' => $node['formOwnerid'],
			'trashed' => $node['formTrashed'],
		];
		$form_model = new FormModel();
		$form_model->set_data( $node['formId'], null, $form_model_data );

		$submission_model = new SubmissionModel();
		$submission_model_data = [
			'id' => $node['id'],
			'formId' => $node['formId'],
			'fName' => $node['fName'],
			'lName' => $node['lName'],
			'email' => $node['email'],
			'phone' => $node['phone'],
			'elements' => $node['elements'],
			'ip' => $node['ip'],
			'score' => $node['score'],
			'maxScore' => $node['maxScore'],
			'scoreData' => $node['scoreData'],
			'urlTrack' => $node['urlTrack'],
			'created' => $node['created'],
			'lastUpdated' => $node['lastUpdated'],
			'adminRemarks' => $node['adminRemarks'],
			'userId' => $node['userId'],
			'referer' => $node['referer'],
			'paid' => $node['paid'],
			'time' => $node['time'],
			'token' => $node['token'],
		];
		$submission_model->set_data( $node['id'], null, $submission_model_data );

		$handler = SubmissionHandler::get_instance_from_models(
			$submission_model,
			$this->auth,
			false,
			false,
			$form_model
		);

		$normalized_node = parse_args(
			$node,
			[
				'id' => null,
				'formId' => null,
				'formName' => __( 'Deleted', 'wp-eform' ),
				'fName' => null,
				'lName' => null,
				'email' => null,
				'phone' => null,
				'elements' => [],
				'ip' => null,
				'score' => null,
				'maxScore' => null,
				'percentageScore' => null,
				'scoreData' => null,
				'urlTrack' => null,
				'created' => '',
				'lastUpdated' => null,
				'adminRemarks' => null,
				'userId' => null,
				'referer' => null,
				'paid' => null,
				'time' => null,
				'token' => '',
				'submissionLink' => '',
				'paymentData' => null,
				'canUserEdit' => false,
			]
		);
		$normalized_node['elements'] = $handler->elements()->get_processed_elements();
		$normalized_node['scoreData'] = $handler->score()->get_score_data();
		// add submissionLink
		$normalized_node['submissionLink'] = $handler->get_submission_link();
		$normalized_node['downloadLink'] = $handler->get_submission_download_link(
			$filter['asAdmin']
		);
		$normalized_node['printLink'] = $handler->get_submission_print_link(
			$filter['asAdmin']
		);
		// add can update
		$normalized_node['canUserEdit'] = $handler->get_can_user_edit();

		return $normalized_node;
	}
}
