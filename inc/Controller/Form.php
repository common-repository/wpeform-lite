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
use WPEForm\Exception\ResourceDoesNotExistException;
use WPEForm\Exception\ValidationException;
use WPEForm\Factory\Form\Config\Integrations;

use function WPEForm\Helpers\parse_args;
use function WPEForm\Helpers\convert_array_values_to_int;
use function WPEForm\Helpers\encode_update_logs;
use function WPEForm\Helpers\get_current_timestamp;
use function WPEForm\Helpers\get_timestamp_from_mysql_formatted_datetime;
use function WPEForm\Helpers\parse_and_sort_update_logs;

use WPEForm\Factory\Form\Config\Payments;
use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Factory\Form\Config\Settings;
use WPEForm\Factory\Form\Config\Styles;
use WPEForm\Form\Config\Payments\IPayments;
use WPEForm\Factory\Form\Elements;
use WPEForm\Form\Config\Settings\ISettings;
use WPEForm\Model\Form as ModelForm;
use WPEForm\System\Endpoints;
use Exception;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

/**
 * Form Builder Controller for all CRUD operation.
 *
 * It gets data from the model, definitions from the Factory and link them all
 * together to pass down to the viewer.
 *
 * In practice, this is written to compliment the GraphQL classes.
 */
class Form extends Base {
	const UPDATE_LOGS_METAKEY = 'update_logs';
	const EDITOR_METAKEY = 'editor';
	const CATEGORY_METAKEY = 'category';

	/**
	 * Get editors meta data for this form.
	 *
	 * A shorthand method for calling `$this->model->read_meta('editor')`.
	 *
	 * It should be used to get editors, because it performs some actions
	 * needed.
	 *
	 * @return array Indexed array of editors.
	 */
	protected function read_editors() : array {
		return \array_map(
			'intval',
			$this->model->read_meta( self::EDITOR_METAKEY )
		);
	}

	/**
	 * Set editor meta data for this form.
	 *
	 * A shorthand method for calling `$this->model->update_meta('editor', $editors)`.
	 *
	 * It should be used to set editors, because it performs some needed
	 * actions.
	 *
	 * @param array $editors indexed array of editors.
	 * @return void
	 */
	protected function update_editors( $editors ) {
		$editor_ids = convert_array_values_to_int( $editors );
		$this->model->update_meta( self::EDITOR_METAKEY, $editor_ids );
	}

	/**
	 * Set category meta data for this form.
	 *
	 * A shorthand method for calling `$this->model->update_meta('category', $categories)`.
	 *
	 * It should be used to set categories, because it performs some needed
	 * actions.
	 *
	 * @param array $categories indexed array of categories.
	 * @return void
	 */
	protected function update_categories( $categories ) {
		// We expect all categories to be integers
		$cat_ids = convert_array_values_to_int( $categories );
		// set it
		$this->model->update_meta( self::CATEGORY_METAKEY, $cat_ids );
	}

	/**
	 * Update update logs of a form.
	 *
	 * @return void
	 */
	protected function update_update_logs() {
		$current_time = \current_time( 'mysql', true );
		$current_user_id = $this->auth->get_current_user_id();
		$new_entry = [
			'i' => $current_user_id,
			'd' => $current_time,
		];

		$existing = $this->read_update_logs();
		$update_logs = parse_and_sort_update_logs( $existing );
		$needs_adding_new_entry = true;

		// get the last_one
		$count = \count( $update_logs );
		if ( $count > 0 ) {
			// If there is a last one, then see if we need to override it
			$last_record = $update_logs[ $count - 1 ];

			if ( $last_record['i'] === $current_user_id ) {
				// the same user has edited last time, so check to see if we should
				// update the record. For that, we compare date.
				$last_record_ts = get_timestamp_from_mysql_formatted_datetime( $last_record['d'] );
				$current_ts = get_current_timestamp();
				if (
					$last_record_ts !== false
					&& $current_ts !== false
					&& ( $current_ts - $last_record_ts ) < 24 * \HOUR_IN_SECONDS
				) {
					// within 24hrs window, so
					// just update the last record date to the current one
					$last_record['d'] = $current_time;
					$update_logs[ $count - 1 ] = $last_record;
					$needs_adding_new_entry = false;
				}
			}
		}

		// the checks have failed, so add the new entry to update log
		if ( $needs_adding_new_entry ) {
			$update_logs[] = $new_entry;
		}

		$this->model->update_meta(
			self::UPDATE_LOGS_METAKEY,
			encode_update_logs( $update_logs )
		);
	}

	/**
	 * Get category metadata for this form.
	 *
	 * A shorthand method for calling `$this->model->read_meta('category')`.
	 *
	 * It should be used to get categories, because it performs some actions
	 * needed.
	 *
	 * @return array Array of categories. Empty array if not category is found.
	 */
	protected function read_categories() {
		$categories = $this->model->read_meta( self::CATEGORY_METAKEY );
		return convert_array_values_to_int( $categories );
	}

	/**
	 * Read update_log metadata of a form.
	 *
	 * @return array Empty if no update log.
	 */
	protected function read_update_logs() {
		$update_log = $this->model->read_meta( self::UPDATE_LOGS_METAKEY );
		// just return the data because Form Resolver expects it this way
		return $update_log;
	}

	/**
	 * Get GraphQL compatible data from model for a single form.
	 *
	 * @return array
	 */
	protected function get_data_from_model() {
		$return_data = $this->model->read();
		$return_data['editors'] = $this->read_editors();
		$return_data['categories'] = $this->read_categories();
		$return_data['updateLogs'] = $this->read_update_logs();
		$return_data['id'] = $this->model->get_id();

		// implement auth based filters
		// if current user can not read sensitive information, then null out
		// settings, integrations, editors, owner, created, updated, categories
		if (
			! $this->auth->get_auth_bypass()
			&& ! $this->auth->can_current_user_read_sensitive_info( $this->model )
		) {
			$return_data['integrations'] = null;
			$return_data['editors'] = [];
			$return_data['ownerid'] = null;
			$return_data['created'] = null;
			$return_data['updated'] = null;
			$return_data['categories'] = [];
			$return_data['updateLogs'] = [];

			// call user facing method of ISettings to prevent leaking sensitive info
			$settings_configs = Settings::get_registered_configs();
			/** @var ISettings $settings_instance */
			foreach ( $settings_configs as $settings_name => $settings_instance ) {
				if ( ! $settings_instance->is_user_facing() ) {
					$return_data['settings'][ $settings_name ] = null;
				}
			}
		}

		// call resolvers of Payments to not leak sensitive info
		$payments_configs = Payments::get_registered_configs_names();
		$payments = $return_data['payments'];
		$return_data['payments'] = [];

		// this also removes an currently unregistered payments data
		// possibly from deactivated add-ons etc. Although we actually don't need
		// it coz, GraphQL type will not resolve it anyways, so treat it as a note.
		// We also don't need to explicitly do something for general, because it is
		// already implemented as an IPayments class.
		foreach ( $payments_configs as $payment_key ) {
			$return_data['payments'][ $payment_key ] =
				Payments::get_resolved_config_value(
					$payment_key,
					$payments[ $payment_key ],
					$this->auth,
					$this->model
				);
		}

		// Add notices and limitations
		$return_data['notices'] = Permissions::get_preemptive_notices(
			$this->model,
			$this->auth
		);
		$return_data['limitations'] = Permissions::get_preemptive_limitations(
			$this->model,
			$this->auth
		);

		return $return_data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param ResolveInfo|null $resolveInfo Resolve Info from graphql-php.
	 * @param array|null       $args Arguments passed to the Query.
	 *
	 * @throws InsufficientPermissionException If accessing paymentGateways,
	 *         categories or owners and user cannot create.
	 *
	 * @return array
	 */
	protected function metadata( ?ResolveInfo $resolveInfo = null, $args = [] ) : array {
		$metadata = [];
		// resolve only the metadata needed
		// because the model action is kinda heavy on db
		$resolve_fields = $resolveInfo->getFieldSelection( 1 );

		if ( \array_key_exists( 'paymentGateways', $resolve_fields ) ) {
			if ( ! $this->auth->can_current_user_create() ) {
				throw new InsufficientPermissionException(
					'Current user can not access paymentGateways meta query.'
				);
			}
			// get all payment gateways from the factory
			$paymentGateways = [];
			foreach ( Payments::get_registered_configs() as $payment_id => $pobj ) {
				/** @var IPayments $pobj */
				if ( $pobj->is_gateway() ) {
					$paymentGateways[] = [
						'id' => $payment_id,
						'label' => $pobj->gateway_label(),
						'supportsSubscription' => $pobj->supports_subscription(),
					];
				}
			}
			$metadata['paymentGateways'] = $paymentGateways;
		}

		if ( \array_key_exists( 'elements', $resolve_fields ) ) {
			// get all elements from the factory
			$elements = Elements::get_all_registered_elements_data();
			$metadata['elements'] = $elements;
		}

		$resolve_owners = \array_key_exists( 'owners', $resolve_fields );
		$resolve_categories = \array_key_exists( 'categories', $resolve_fields );
		$categories = [];
		$owners = null;

		$can_manage_other_models = $this->auth->can_current_user_manage_others_models();

		// figure out the mode
		$view_mode = 'owned';
		if (
			$can_manage_other_models
			&& $args['resourceView'] === 'all'
		) {
			$view_mode = 'all';
		} elseif ( $args['resourceView'] === 'shared' ) {
			$view_mode = 'shared';
		} elseif ( $args['resourceView'] === 'trashed' ) {
			$view_mode = 'trashed';
		}

		// resolve owners safety checks
		if ( $view_mode === 'owned' ) {
			$resolve_owners = false;
		}
		if ( $view_mode === 'trashed' && ! $can_manage_other_models ) {
			$resolve_owners = false;
		}

		if ( $resolve_categories || $resolve_owners ) {
			if ( ! $this->auth->can_current_user_create() ) {
				throw new InsufficientPermissionException(
					'Current user can not access owners and categories meta query.'
				);
			}

			$model_collection_filters = $this->model->metadata_collection_filters(
				[
					'resolve_owners' => $resolve_owners,
					'resolve_categories' => $resolve_categories,
					'view_mode' => $view_mode,
					'current_user_id' => $this->auth->get_current_user_id(),
					'can_manage_other_models' => $can_manage_other_models,
				]
			);
			$categories = $model_collection_filters['categories'];
			$owners = $model_collection_filters['owners'];
			if ( ! \is_array( $categories ) ) {
				$categories = [];
			}
		}

		if ( $resolve_categories ) {
			$metadata['categories'] = $categories;
		}
		if ( $resolve_owners ) {
			$metadata['owners'] = $owners;
		}

		return $metadata;
	}

	/**
	 * Create a form.
	 *
	 * @throws InsufficientPermissionException If user does not have sufficient permission.
	 *
	 * @param array $data Form data.
	 * @return array Newly created form data.
	 */
	public function create( $data ) {
		// Add additional stuff to data
		$data['ownerid'] = $this->auth->is_user_logged_in()
			? $this->auth->get_current_user_id()
			: null;
		$data['skeleton'] = $data['skeleton'] ?? [
			'formPreviewSkeleton' => '',
			'formEditSkeleton' => '',
			'formSummarySkeleton' => '',
		];
		$data['created'] = \current_time( 'mysql', true );
		parent::create( $data );

		// set meta
		$this->update_categories( $data['categories'] );
		$this->update_editors( $data['editors'] );

		return $this->get_data_from_model();
	}

	/**
	 * Instruct the Model to update the data.
	 *
	 * Also check for capabilities and if passes then only do things.
	 * Otherwise throws InsufficientPermissionException Error.
	 *
	 * @throws InsufficientPermissionException If current user can not perform this action.
	 * @throws ResourceDoesNotExistException If the form doesn't exist.
	 *
	 * @param int         $id Id of form.
	 * @param array       $data Associative array of new data.
	 * @param string|null $token Token of the resource. Passed to the model.
	 * @return array Form data from the model.
	 */
	public function update( $id, $data, $token = null ) {
		// Add additional stuff to data
		$data['updated'] = \current_time( 'mysql', true );
		$data['skeleton'] = $data['skeleton'] ?? [
			'formPreviewSkeleton' => '',
			'formEditSkeleton' => '',
			'formSummarySkeleton' => '',
		];
		parent::update( $id, $data, $token );

		// save meta to model
		$this->update_categories( $data['categories'] );
		$this->update_editors( $data['editors'] );
		$this->update_update_logs();
		return $this->get_data_from_model();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws InsufficientPermissionException If user tries to filter by trashed and cannot delete.
	 *
	 * @param null|array $filter Filter arguments.
	 * @return array
	 */
	protected function verify_filters_with_auth( ?array $filter ) : array {
		// calling this because, it essentially converts a null value to an array
		$filter = parent::verify_filters_with_auth( $filter );

		// If owner is set and current user can not view others form
		$current_user = $this->auth->get_current_user_id();
		$resource_view = $filter['resourceView'] ?? 'all';
		$filter['resourceView'] = $resource_view;

		if (
			isset( $filter['owner'] )
			&& \intval( $filter['owner'] ) !== $current_user
			&& ! $this->auth->can_current_user_manage_others_models()
		) {
			throw new InsufficientPermissionException( 'Current user can not filter by owner.' );
		}

		// If user can not manage others' forms, then always set the owner
		if ( ! $this->auth->can_current_user_manage_others_models() ) {
			$filter['owner'] = $current_user;
		}

		// Finally override formOwner if resource_view is to owned or shared
		// if shared or owned is set, then model expects to get shared with or owned by
		// $filter['formOwner'], in which case, override the $filter['formOwner']
		if ( $resource_view === 'owned' || $resource_view === 'shared' ) {
			$filter['owner'] = $current_user;
		}

		// If we have a filter/trashed set
		if ( $resource_view === 'trashed' ) {
			// but current user can not view trashed
			if ( ! $this->auth->can_current_user_view_trashed() ) {
				throw new InsufficientPermissionException( 'Current user can not filter by trashed.' );
			}
			// no need to set $filter['owner'] at this point, because without manage_others_models
			// it is already set.
		}

		return $filter;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $data Model data.
	 * @return array Normalized data.
	 */
	protected function normalize_export( array $data ) : array {
		// first, specifically select which data we want to export
		// at this stage, we expect normalized data from model
		$export_data = [
			// general stuff
			'name' => $data['name'],
			'structures' => $data['structures'],
			'elements' => $data['elements'],
			'pools' => $data['pools'],
			'conditionals' => $data['conditionals'],
			'skeleton' => $data['skeleton'],
			// configs
			'integrations' => Integrations::normalize_on_export( $data['integrations'] ),
			'payments' => Payments::normalize_on_export( $data['payments'] ),
			'permissions' => Permissions::normalize_on_export( $data['permissions'] ),
			'settings' => Settings::normalize_on_export( $data['settings'] ),
			'styles' => Styles::normalize_on_export( $data['styles'] ),
		];

		// remove all skeleton data to preserve space
		$export_data['skeleton'] = [];
		foreach ( $data['skeleton'] as $key => $val ) {
			$export_data['skeleton'][ $key ] = '';
		}

		return $export_data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $data User input data.
	 * @return array Normalized data.
	 *
	 * @throws ValidationException If data has is invalid.
	 */
	protected function normalize_import( array $data ) : array {
		// first validate the data
		$validators = [
			// general stuff
			'name' => 'is_string',
			'structures' => 'is_array',
			'elements' => 'is_array',
			'pools' => 'is_array',
			'conditionals' => 'is_array',
			// configs
			'integrations' => 'is_array',
			'payments' => 'is_array',
			'permissions' => 'is_array',
			'settings' => 'is_array',
			'styles' => 'is_array',
		];
		foreach ( $validators as $key => $validator ) {
			if ( ! isset( $data[ $key ] ) || ! \call_user_func( $validator, $data[ $key ] ) ) {
				throw new ValidationException( "Invalid data {$key} passed to form import." );
			}
		}
		// Normalize configs
		$data['integrations'] = Integrations::normalize_on_import( $data['integrations'] );
		$data['payments'] = Payments::normalize_on_import( $data['payments'] );
		$data['permissions'] = Permissions::normalize_on_import( $data['permissions'] );
		$data['settings'] = Settings::normalize_on_import( $data['settings'] );
		$data['styles'] = Styles::normalize_on_import( $data['styles'] );

		// normalize skeleton
		$data['skeleton'] = \is_array( $data['skeleton'] )
			? $data['skeleton']
			: ModelForm::get_default_form_skeleton();

		// Add other things the create function is expecting
		$data['categories'] = [];
		$data['editors'] = [];

		return $data;
	}

	/**
	 * Normalize duplicate data.
	 *
	 * @param array $data User input data.
	 * @return array Normalized data.
	 * @throws InvalidOperationException Child class must override, else it will throw this error.
	 */
	protected function normalize_duplicate( array $data ) : array {
		// Normalization process is same as import
		// we basically change some sane defaults
		// Normalize configs
		$data['integrations'] = Integrations::normalize_on_import( $data['integrations'] );
		$data['payments'] = Payments::normalize_on_import( $data['payments'] );
		$data['permissions'] = Permissions::normalize_on_import( $data['permissions'] );
		$data['settings'] = Settings::normalize_on_import( $data['settings'] );
		$data['styles'] = Styles::normalize_on_import( $data['styles'] );

		// Add other things the create function is expecting
		$data['categories'] = $this->read_categories();
		$data['editors'] = $this->read_editors();

		return $data;
	}

	/**
	 * Normalize a single node of edges used in GraphQL.
	 *
	 * @param array $node Raw node as retrieved from database.
	 * @param array $pagination Pagination arguments.
	 * @param array $filter Filter arguments.
	 * @return array
	 */
	protected function normalize_collection_node( $node, $pagination, $filter ) {
		$element_types = [];
		try {
			$form_elements = \json_decode( $node['elements'], true );
			if ( \is_array( $form_elements ) ) {
				foreach ( $form_elements as $element ) {
					if (
						! \in_array( $element['type'], $element_types )
						&& Elements::has_element( $element['type'] )
					) {
						$element_types[] = $element['type'];
					}
				}
			}
			// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
		} catch ( Exception $e ) {
			// do nothing
		}
		$node['elementTypes'] = $element_types;
		$node['standaloneLink'] = Endpoints::get_endpoint_url(
			'/form/' . \sanitize_title( $node['name'] ) . '/' . (string) $node['id'] . '/'
		);

		// add style data for skeleton generation
		[ $theme_style, $panels, $controls ] = ModelForm::get_form_theme_style_data( $node );
		$node['styleData'] = \json_encode(
			[
				'themeStyle' => $theme_style,
				'panels' => $panels,
				'controls' => $controls,
			]
		);

		return parse_args(
			$node,
			[
				'id' => null,
				'name' => '',
				'updated' => '',
				'created' => '',
				'ownerid' => null,
				'submissionCount' => 0,
				'viewCount' => 0,
				'elementTypes' => [],
				'standaloneLink' => '',
				'styleData' => '',
			]
		);
	}
}
