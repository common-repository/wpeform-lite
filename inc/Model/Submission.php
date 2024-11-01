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
 * @subpackage Model
 */

namespace WPEForm\Model;

use WPEForm\Factory\Form\Elements;
use WPEForm\System\Init;

use function WPEForm\Helpers\convert_list_to_dictionary;
use function WPEForm\Helpers\get_mysql_datetime_from_user_input;
use function WPEForm\Helpers\normalize_db_ids_for_in;
use function WPEForm\Helpers\parse_args;
use function WPEForm\Helpers\uuid4;
use WPEForm\Handler\Submission as SubmissionHandler;
use LogicException;
use WPEForm\States\Submission\Score;

use const ARRAY_A;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Submission Model. Abstracts all database operations. This doesn't do any
 * score calculation, payment, user input validation and other integration.
 * All those should be managed by the controller.
 */
class Submission extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function get_serializable_columns(): array {
		return [
			'elements',
			'scoreData',
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param string $purpose Purpose code.
	 *
	 * @return array
	 */
	protected function get_allowed_db_keys( string $purpose ): array {
		$allowed_keys = [
			// 'formId',
			'fName',
			'lName',
			'email',
			'phone',
			'elements',
			'ip',
			'score',
			'maxScore',
			'scoreData',
			'urlTrack',
			// 'created',
			// 'lastUpdated',
			// 'adminRemarks',
			// 'userId',
			// 'referer',
			// 'paid',
			'time',
			// 'token',
		];
		if ( self::DB_SETSTATE === $purpose ) {
			// if seting state then all keys are allowed
			$allowed_keys = \array_merge(
				$allowed_keys,
				[
					'formId',
					'created',
					'lastUpdated',
					'adminRemarks',
					'userId',
					'referer',
					'paid',
					'token',
				]
			);
		} elseif ( self::DB_CREATE === $purpose ) {
			// if creating, then controller would pass in created, lastUpdated as null
			// userId, referer and token (generated)
			$allowed_keys = \array_merge(
				$allowed_keys,
				[
					'formId',
					'created',
					'lastUpdated',
					'userId',
					'referer',
					'paid',
					'token',
				]
			);
		} elseif ( self::DB_UPDATE === $purpose ) {
			// if updating, then we should not change formId, created, userId, referer and
			// token, just lastUpdated should be passed by controller
			$allowed_keys = \array_merge(
				$allowed_keys,
				[
					'lastUpdated',
					'adminRemarks',
				]
			);
		} elseif ( self::DB_UPDATE_COLUMNS === $purpose ) {
			return [
				'fName',
				'lName',
				'email',
				'phone',
				'score',
				'maxScore',
				'adminRemarks',
				'paid',
			];
		}
		return $allowed_keys;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_table_name() {
		return Init::$database['submission'];
	}

	/**
	 * Normalize elements of a submission. It takes into consideration all active
	 * elements and normalizes the data (including value, scores, conditionallyHidden, id)
	 * properly for the GraphQL Resolver.
	 *
	 * @param array $elements Elements of a submission.
	 * @return array Normalized elements.
	 */
	protected function normalize_elements( array $elements ) : array {
		$normalized_elements = [];
		$empty_score = Score::get_empty_score_data(
			\WPEForm\Form\Config\Settings\Score::PRIMARY_SCORE_ID
		);
		foreach ( $elements as $element ) {
			$new_element = [
				'id' => $element['id'] ?? 'unknown-' . uuid4(),
				'value' => Elements::get_element_data_value_array_structure(),
				'conditionallyHidden' => $element['conditionallyHidden'] ?? false,
				'scores' => [],
			];
			// normalize score data
			foreach ( $element['scores'] as  $score ) {
				$new_element['scores'][] = parse_args( $score, $empty_score );
			}
			// normalize value data
			foreach ( $element['value'] as $elm_type => $elm_value ) {
				if (
					Elements::has_element( $elm_type )
					&& ! Elements::is_element_data_value_vars_empty( $elm_type )
					&& ! \is_null( $elm_value )
				) {
					$new_element['value'][ $elm_type ] = parse_args(
						\is_array( $elm_value ) ? $elm_value : [],
						Elements::get_element_default_data_value( $elm_type )
					);
				}
			}
			$normalized_elements[] = $new_element;
		}
		return $normalized_elements;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array  $data Raw data from the database.
	 * @param string $purpose Purpose for normalization.
	 * @return array
	 */
	protected function normalize_data( $data, $purpose ) {
		$dbdata = $this->get_allowed_db_items( $data, $purpose );

		// normalize elements
		if ( isset( $dbdata['elements'] ) ) {
			$dbdata['elements'] = $this->normalize_elements( $dbdata['elements'] );
		} else {
			$dbdata['elements'] = [];
		}

		return $dbdata;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param   array  $data          Data to be validated.
	 * @param   string $purpose_code  Purpose code for calling this function.
	 *
	 * @return  array                 Validated data.
	 */
	protected function validate_data( $data, $purpose_code ) {
		// we don't need to validate elements because it should be done by handler
		// inside the controller.
		return $data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Array of Ids.
	 * @return array|null
	 */
	protected function get_pre_cache_ids_data( array $ids ): ?array {
		global $wpdb;
		$table = $this->get_table_name();

		$in = normalize_db_ids_for_in( $ids );

		$query =
			"SELECT
				*
			FROM {$table}
			WHERE id IN ({$in})";

		$results = $wpdb->get_results( $query, \ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

		if ( ! $results || empty( $results ) ) {
			return [];
		}

		return convert_list_to_dictionary( $results, 'id' );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param int|null    $id Id of the entry.
	 * @param null|string $token Token of the entry.
	 * @return array
	 */
	protected function get_data_from_db( $id, $token = null ) {
		global $wpdb;
		$table = $this->get_table_name();

		// Query the database
		if ( $token === null ) {
			$data = $wpdb->get_row(
				$wpdb->prepare( "SELECT * FROM {$table} WHERE id = %d", $id ), // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				ARRAY_A
			);
		} else {
			$data = $wpdb->get_row(
				$wpdb->prepare( "SELECT * FROM {$table} WHERE token = %s", $token ), // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				ARRAY_A
			);
		}

		// return it
		return $data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return array [ $wpdb insert result, last insert id ]
	 */
	protected function create_data_on_db( $data ) {
		global $wpdb;
		// we accept a specific set of data on create
		$dbdata = $this->get_allowed_db_items( $data, self::DB_CREATE );

		// add to database
		$table = $this->get_table_name();
		$inserted = $wpdb->insert(
			$table,
			$dbdata,
			'%s'
		);
		return [ $inserted, $wpdb->insert_id ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function update_data_on_db( $data ) {
		global $wpdb;

		// we only accept the following data during update
		$dbdata = $this->get_allowed_db_items( $data, self::DB_UPDATE );

		// call update on $wpdb
		return $wpdb->update(
			$this->get_table_name(),
			$dbdata,
			[
				'id' => $this->id,
			],
			'%s',
			'%d'
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int $id Id of the model which has been deleted.
	 * @return void
	 */
	protected function cleanup_after_data_delete( $id ) {
		/** @var \WPDB $wpdb */
		global $wpdb;
		// Delete payments
		$wpdb->delete(
			Init::$database['payment'],
			[
				'submissionId' => $id,
			],
			[
				'%d',
			]
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Collection ids.
	 * @return void
	 */
	protected function cleanup_after_collection_delete( array $ids ) {
		global $wpdb;
		$in = normalize_db_ids_for_in( $ids );

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		// delete all payments related to the submissionId
		$payment_table = Init::$database['payment'];
		$payment_delete_query = "DELETE FROM {$payment_table} WHERE submissionId IN ({$in})";
		$wpdb->query( $payment_delete_query );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param bool $trashed Whether it is trashed or not.
	 * @return string
	 */
	protected function get_trash_clause( $trashed ) {
		if ( true === $trashed ) {
			return 's.trashed = 1';
		}
		return 's.trashed = 0';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	protected function get_orderby_whitelists(): array {
		return [
			'id',
			'formId',
			'fName',
			'lName',
			'email',
			'phone',
			'score',
			'maxScore',
			'percentageScore',
			'created',
			'lastUpdated',
			'paid',
			'time',
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_cursor_key_for_db_query(): string {
		return 's.id';
	}

	/**
	 * Normalize variable types of submissions columns. It just converts strings
	 * to integers for a few columns.
	 *
	 * @param array|null $submissions Submissions as received from database.
	 *
	 * @return array|null
	 */
	protected function normalize_all_edges_columns( $submissions ) {
		if ( ! \is_array( $submissions ) ) {
			return $submissions;
		}
		foreach ( $submissions as $key => $submission ) {
			// there is no need to unserialize/normalize because controller will handle it
			$submissions[ $key ]['id'] = (int) $submission['id'];
			$submissions[ $key ]['formId'] = (int) $submission['formId'];
			$submissions[ $key ]['userId'] = (int) $submission['userId'];
		}
		return $submissions;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $pagination Pagination Arguments.
	 * @param array $filter Filter arguments.
	 * @return array [ $edges, $edges_count, $all_edges_count, $limit ]
	 */
	protected function get_edges_for_collection( $pagination, $filter ) {
		global $wpdb;

		// Normalize filters
		$filter = parse_args(
			$filter,
			// @see inc/GraphQL/Input/Submission/Filter
			[
				'search' => '',
				'category' => 0,
				'asAdmin' => false,
				'formOwner' => 0,
				'submissionOwner' => 0,
				'formId' => 0,
				'startDate' => '',
				'endDate' => '',
				'resourceView' => 'all',
			]
		);

		// Tables
		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];
		$meta_table = Init::$database['formmeta'];

		// filters
		$search = $filter['search'];
		$category = $filter['category'];
		$as_admin = $filter['asAdmin'];
		$resource_view = $filter['resourceView'];
		$form_owner = $filter['formOwner'];
		$submission_owner = $filter['submissionOwner'];
		$form_id = $filter['formId'];
		$start_date = $filter['startDate'];
		$end_date = $filter['endDate'];

		// fix mutually exclusive cases
		// if querying as admin and has form_id (which the controller would verify)
		// then make resource_view all
		if ( $as_admin && $form_id !== 0 ) {
			$resource_view = 'all';
		}

		// possible wheres
		list( $limit, $order_by, $wheres, $offset ) = $this->get_limit_and_clause_from_cursor( $pagination );

		// reference for querying all edges count with where clauses
		$all_edges_wheres = [];

		// add filters if present
		// Add the search query if present
		if ( '' !== $search ) {
			$escaped_search = '%' . $wpdb->esc_like( $search ) . '%';
			$all_edges_wheres[] = $wheres[] = $wpdb->prepare(
				'(s.fName LIKE %s OR s.lName LIKE %s OR s.email LIKE %s OR s.phone LIKE %s OR s.ip LIKE %s OR s.adminRemarks LIKE %s)',
				$escaped_search,
				$escaped_search,
				$escaped_search,
				$escaped_search,
				$escaped_search,
				$escaped_search
			); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
		}

		// We can filter by either category or formId, both cannot be used and
		// give preference to formId
		if ( 0 !== $form_id ) {
			$all_edges_wheres[] = $wheres[] = $wpdb->prepare(
				'f.id = %d',
				$form_id
			);
		} elseif ( 0 !== $category ) {
			// Add the category if present
			$all_edges_wheres[] = $wheres[] =
				$wpdb->prepare(
					"f.id IN (SELECT foreign_id FROM `{$meta_table}` WHERE meta_key = 'category' AND meta_value = %d )", // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found,WordPress.DB.PreparedSQL.InterpolatedNotPrepared
					$category
				);
		}

		// add startDate if needed
		if ( $start_date ) {
			$formatted_start_date = get_mysql_datetime_from_user_input( $start_date );
			if ( $formatted_start_date ) {
				$all_edges_wheres[] = $wheres[] =
					$wpdb->prepare(
						's.created >= %s',
						$formatted_start_date
					);
			}
		}
		// add endDate if needed
		if ( $end_date ) {
			$formatted_end_date = get_mysql_datetime_from_user_input( $end_date );
			if ( $formatted_end_date ) {
				$all_edges_wheres[] = $wheres[] =
					$wpdb->prepare(
						's.created <= %s',
						$formatted_end_date
					);
			}
		}

		if ( $as_admin ) {
			// Add formOwner/shared if present
			// If shared is true, then model expects that $filter['formOwner'] should also
			// represent currently logged in user, with whom forms are shared. Make sure
			// controller implements this (and it does).
			if ( $resource_view === 'shared' ) {
				$all_edges_wheres[] = $wheres[] =
					$wpdb->prepare(
						"f.id IN (SELECT foreign_id FROM {$meta_table} WHERE meta_key = 'editor' AND meta_value = %d)", // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found,WordPress.DB.PreparedSQL.InterpolatedNotPrepared
						$form_owner
					);
			} elseif ( 0 !== $form_owner ) {
				// For everything else, the form_owner is set appropriately by controller
				$all_edges_wheres[] = $wheres[] =
					$wpdb->prepare( 'f.ownerid = %d', $form_owner ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found,WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			}

			// add trashed
			$all_edges_wheres[] = $wheres[] = $this->get_trash_clause( $resource_view === 'trashed' ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found

			// add userId if present
			if ( $submission_owner !== 0 ) {
				$all_edges_wheres[] = $wheres[] =
					$wpdb->prepare( 's.userId = %d', $submission_owner );
			}
		} else {
			// add userId, expected controller has passed right one
			$all_edges_wheres[] = $wheres[] =
				$wpdb->prepare( 's.userId = %d', $submission_owner );

			// add trashed, but hard-coded to false
			$all_edges_wheres[] = $wheres[] = $this->get_trash_clause( false ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
		}

		// Finally the form shouldn't be trashed
		$all_edges_wheres[] = $wheres[] = 'f.trashed = 0';

		// construct the where
		$where = $this->get_where_in_query( $wheres );
		$all_edges_where = $this->get_where_in_query( $all_edges_wheres );

		// Initiate the query
		$join_query = "{$submission_table} s LEFT JOIN {$form_table} f ON f.id = s.formId";

		// The order of fields in the query is same as `inc/GraphQL/Type/Submission/Node`
		// while this is not really required, but do maintain for ease of readability.
		// Fields which are missing are programmatic and would be added by the controller
		// It also queries all the fields required for the Form Model
		$query =
			"SELECT
				s.id id,
				s.formId formId,
				f.name formName,
				s.fName fName,
				s.lName lName,
				s.email email,
				s.phone phone,
				s.elements elements,
				s.ip ip,
				s.score score,
				s.maxScore maxScore,
				s.scoreData scoreData,
				(s.score / s.maxScore * 100) as percentageScore,
				s.urlTrack urlTrack,
				s.created created,
				s.lastUpdated lastUpdated,
				s.adminRemarks adminRemarks,
				s.userId userId,
				s.referer referer,
				s.paid paid,
				s.time time,
				s.token token,
				s.trashed trashed,
				f.integrations formIntegrations,
				f.payments formPayments,
				f.permissions formPermissions,
				f.settings formSettings,
				f.styles formStyles,
				f.structures formStructures,
				f.elements formElements,
				f.pools formPools,
				f.conditionals formConditionals,
				f.updated formUpdated,
				f.created formCreated,
				f.ownerid formOwnerid,
				f.trashed formTrashed
				FROM {$join_query}
				{$where}
				ORDER BY {$order_by}
				LIMIT {$this->get_limit_query_from_caluse( $limit, $offset )}";

		// Query and get edges
		$edges = $wpdb->get_results( $query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		// Cast needed fields
		$edges = $this->normalize_all_edges_columns( $edges );

		// Get counts
		$edges_count = $wpdb->get_var( "SELECT COUNT(s.id) FROM {$join_query}{$where}" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$all_edges_count = $wpdb->get_var( "SELECT COUNT(s.id) total FROM {$join_query}{$all_edges_where}" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		// Return
		return [ $edges, $edges_count, $all_edges_count, $limit, $offset ];
	}

	/**
	 * Get metadata categories.
	 *
	 * @param array $filter Filters.
	 * @return array|null categories data.
	 */
	protected function get_metadata_categories( array $filter ) : ?array {
		global $wpdb;

		$category_table = Init::$database['category'];
		$form_table = Init::$database['form'];
		$form_meta_table = Init::$database['formmeta'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			c.title `title`,
			c.id `id`,
			COUNT(m.meta_value) `total`
		FROM `wp_wpq_eform_formmeta` m
		LEFT JOIN `wp_wpq_eform_category` c
			ON m.meta_value = c.id
		LEFT JOIN `wp_wpq_eform_submission` s
			ON m.foreign_id = s.formId
		WHERE
			m.meta_key = 'category'
			AND m.foreign_id IN
				(SELECT id FROM `wp_wpq_eform_form` WHERE ownerid = 1)
			GROUP BY m.meta_value;
		*/

		$categories_query =
			"SELECT
				c.title title,
				c.id id,
				COUNT(m.meta_value) `total`
			FROM {$form_meta_table} m
			LEFT JOIN {$category_table} c
				ON m.meta_value = c.id
			LEFT JOIN {$submission_table} s
				ON m.foreign_id = s.formId
			WHERE m.meta_key = 'category'
		";

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( $filter['view_mode'] === 'owned' ) {
			$categories_query .= $wpdb->prepare(
				"AND m.foreign_id IN
					(SELECT id FROM {$form_table} WHERE ownerid = %d AND trashed = 0)
				AND s.trashed = 0
				",
				$filter['current_user_id']
			);
		} elseif ( $filter['view_mode'] === 'shared' ) {
			$categories_query .= $wpdb->prepare(
				" AND m.foreign_id IN
					(
						SELECT foreign_id FROM {$form_meta_table}
						WHERE meta_key = 'editor'
						AND meta_value = %d
					)
				AND m.foreign_id NOT IN
					(SELECT id FROM {$form_table} WHERE trashed = 1)
				AND s.trashed = 0
				",
				$filter['current_user_id']
			);
		} elseif ( $filter['view_mode'] === 'trashed' ) {
			if ( $filter['can_manage_other_models'] ) {
				$categories_query .= " AND m.foreign_id IN
					(SELECT id FROM {$form_table} WHERE trashed = 0)
				AND s.trashed = 1
				";
			} else {
				$categories_query .= $wpdb->prepare(
					" AND m.foreign_id IN
						(SELECT id FROM {$form_table} WHERE ownerid = %d AND trashed = 0)
					AND s.trashed = 1
					",
					$filter['current_user_id']
				);
			}
		} else {
			$categories_query .= "AND m.foreign_id NOT IN
				(SELECT id FROM {$form_table} WHERE trashed = 1)
			AND s.trashed = 0
			";
		}

		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$categories_query .= ' GROUP BY m.meta_value';

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$categories = $wpdb->get_results( $categories_query, ARRAY_A );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
		return $categories;
	}

	/**
	 * Get metadata categories.
	 *
	 * @param array $filter Filters.
	 * @return array|null categories data.
	 */
	protected function get_metadata_categories_for_submission_owner( array $filter ) : ?array {
		global $wpdb;

		$category_table = Init::$database['category'];
		$form_table = Init::$database['form'];
		$form_meta_table = Init::$database['formmeta'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			c.title `title`,
			c.id `id`,
			COUNT(m.meta_value) `total`
		FROM `wp_wpq_eform_submission` s
		LEFT JOIN `wp_wpq_eform_form` f
			ON f.id = s.formId
		LEFT JOIN `wp_wpq_eform_formmeta` m
			ON m.`foreign_id` = s.formId
		LEFT JOIN `wp_wpq_eform_category` c
			ON m.meta_value = c.id
		WHERE
			m.meta_key = 'category'
		AND
			s.userId = 1
		AND
			s.trashed = 0
		AND
			f.trashed = 0
		GROUP BY m.meta_value
		ORDER BY c.id DESC;
		*/

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$categories_query = $wpdb->prepare(
			"SELECT
				c.title title,
				c.id id,
				COUNT(m.meta_value) `total`
			FROM {$submission_table} s
			LEFT JOIN {$form_table} f
				ON f.id = s.formId
			LEFT JOIN {$form_meta_table} m
				ON m.foreign_id = s.formId
			LEFT JOIN {$category_table} c
				ON m.meta_value = c.id
			WHERE m.meta_key = 'category'
			AND
				s.userId = %d
			AND
				s.trashed = 0
			AND
				f.trashed = 0
			",
			$filter['current_user_id']
		);

		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$categories_query .= ' GROUP BY m.meta_value ORDER BY c.id DESC';

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$categories = $wpdb->get_results( $categories_query, ARRAY_A );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
		return $categories;
	}

	/**
	 * Get metadata owners.
	 *
	 * @param array $filter Filters.
	 * @return array|null owners data.
	 */
	protected function get_metadata_owners( array $filter ): ?array {
		global $wpdb;

		$form_table = Init::$database['form'];
		$user_table = $wpdb->users;
		$form_meta_table = Init::$database['formmeta'];
		$submission_table = Init::$database['submission'];

		$owners_query = "SELECT
			s.userId id,
			u.display_name username,
			COUNT(s.userId) `total`
		FROM {$submission_table} s
		LEFT JOIN {$user_table} u
			ON s.userId = u.id
		LEFT JOIN {$form_table} f
			ON f.id = s.formId
		WHERE
			f.trashed = 0
		AND
			s.userId != 0
		";

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( $filter['view_mode'] === 'owned' ) {
			$owners_query .= $wpdb->prepare(
				'AND f.ownerid = %d
				AND s.trashed = 0
				',
				$filter['current_user_id']
			);
		} elseif ( $filter['view_mode'] === 'shared' ) {
			$owners_query .= $wpdb->prepare(
				"AND s.formId IN
					(
						SELECT foreign_id FROM {$form_meta_table}
						WHERE meta_key = 'editor'
						AND meta_value = %d
					)
				AND
					s.trashed = 0
				",
				$filter['current_user_id']
			);
		} elseif ( $filter['view_mode'] === 'trashed' ) {
			if ( $filter['can_manage_other_models'] ) {
				$owners_query .=
					' AND
						s.trashed = 1
					';
			} else {
				$owners_query .= $wpdb->prepare(
					' AND
						f.ownerid = %d
					AND
						s.trashed = 1
					',
					$filter['current_user_id']
				);
			}
		} else {
			$owners_query .= ' AND s.trashed = 0';
		}
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		$owners_query .= ' GROUP BY s.userId';

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$owners = $wpdb->get_results( $owners_query, ARRAY_A );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared

		return $owners;
	}

	/**
	 * Get metadata forms.
	 *
	 * @param array $filter Filters.
	 * @return array|null forms data.
	 */
	protected function get_metadata_forms( array $filter ): ?array {
		global $wpdb;

		$form_table = Init::$database['form'];
		$form_meta_table = Init::$database['formmeta'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			f.id formId,
			f.name formName,
			COUNT(s.id) total
		FROM wp_wpq_eform_submission s
		LEFT JOIN wp_wpq_eform_form f
			ON s.formId = f.id
		WHERE
			f.trashed = 0
		AND
			s.trashed = 0
		AND f.id IN
			(SELECT foreign_id FROM wp_wpq_eform_formmeta WHERE meta_key = 'editor' AND meta_value = 2)
		GROUP BY f.id;
		*/

		$forms_query = "SELECT
			f.id formId,
			f.name formName,
			COUNT(s.id) total
		FROM {$submission_table} s
		LEFT JOIN {$form_table} f
			ON s.formId = f.id
		WHERE
			f.trashed = 0
		";

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( $filter['view_mode'] === 'owned' ) {
			$forms_query .= $wpdb->prepare(
				'AND f.ownerid = %d AND s.trashed = 0',
				$filter['current_user_id']
			);
		} elseif ( $filter['view_mode'] === 'shared' ) {
			$forms_query .= $wpdb->prepare(
				"AND f.id IN
					(
						SELECT foreign_id FROM {$form_meta_table}
						WHERE meta_key = 'editor'
						AND meta_value = %d
					)
				AND
					s.trashed = 0
				",
				$filter['current_user_id']
			);
		} elseif ( $filter['view_mode'] === 'trashed' ) {
			if ( $filter['can_manage_other_models'] ) {
				$forms_query .= ' AND s.trashed = 1';
			} else {
				$forms_query .= $wpdb->prepare(
					' AND
						f.ownerid = %d
					AND
						s.trashed = 1
					',
					$filter['current_user_id']
				);
			}
		} else {
			$forms_query .= ' AND s.trashed = 0';
		}
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		$forms_query .= ' GROUP BY f.id ORDER BY f.id DESC';

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$forms = $wpdb->get_results( $forms_query, ARRAY_A );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
		return $forms;
	}

	/**
	 * Get metadata forms for current user as submission owner.
	 *
	 * @param array $filter Filters.
	 * @return array|null forms data.
	 */
	protected function get_metadata_forms_for_submission_owner( array $filter ): ?array {
		global $wpdb;

		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			f.id formId,
			f.name formName,
			COUNT(s.id) total
		FROM wp_wpq_eform_submission s
		LEFT JOIN wp_wpq_eform_form f
			ON s.formId = f.id
		WHERE
			f.trashed = 0
		AND
			s.trashed = 0
		AND
			s.userId = 1
		GROUP BY f.id;
		*/

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$forms_query = $wpdb->prepare(
			"SELECT
				f.id formId,
				f.name formName,
				COUNT(s.id) total
			FROM {$submission_table} s
			LEFT JOIN {$form_table} f
				ON s.formId = f.id
			WHERE
				f.trashed = 0
			AND
				s.trashed = 0
			AND
				s.userId = %d
			",
			$filter['current_user_id']
		);
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		$forms_query .= ' GROUP BY f.id ORDER BY f.id DESC';

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$forms = $wpdb->get_results( $forms_query, ARRAY_A );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
		return $forms;
	}

	/**
	 * Get metadata form owners.
	 *
	 * @param array $filter Filters.
	 * @return array|null form owners data.
	 *
	 * @throws LogicException If view_mode is set to 'owned'.
	 */
	protected function get_metadata_form_owners( array $filter ): ?array {
		global $wpdb;

		$form_table = Init::$database['form'];
		$user_table = $wpdb->users;
		$form_meta_table = Init::$database['formmeta'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			f.ownerid id,
			u.display_name username,
			COUNT(f.ownerid) total
		FROM wp_wpq_eform_submission s
		LEFT JOIN wp_wpq_eform_form f
			ON s.formId = f.id
		LEFT JOIN wp_users u
			ON u.id = f.ownerid
		WHERE
			f.trashed = 0
		AND
			s.trashed = 0
		GROUP BY f.ownerid;
		*/

		$owners_query = "SELECT
			f.ownerid id,
			u.display_name username,
			COUNT(f.ownerid) total
		FROM {$submission_table} s
		LEFT JOIN {$form_table} f
			ON s.formId = f.id
		LEFT JOIN {$user_table} u
			ON u.id = f.ownerid
		WHERE
			f.trashed = 0
		AND
			f.ownerid != 0
		";

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( $filter['view_mode'] === 'owned' ) {
			throw new LogicException( 'Form owners cannot be calculated in owned view mode.' );
		} elseif ( $filter['view_mode'] === 'shared' ) {
			$owners_query .= $wpdb->prepare(
				"AND f.id IN
					(
						SELECT foreign_id FROM {$form_meta_table}
						WHERE meta_key = 'editor'
						AND meta_value = %d
					)
				AND
					s.trashed = 0
				",
				$filter['current_user_id']
			);
		} elseif ( $filter['view_mode'] === 'trashed' ) {
			if ( $filter['can_manage_other_models'] ) {
				$owners_query .= ' AND s.trashed = 1';
			} else {
				throw new LogicException( 'Form owners cannot be calculated in trashed view mode.' );
			}
		} else {
			$owners_query .= ' AND s.trashed = 0';
		}
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		$owners_query .= ' GROUP BY f.ownerid ORDER BY total DESC';

		// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$owners = $wpdb->get_results( $owners_query, ARRAY_A );
		// phpcs:enable WordPress.DB.PreparedSQL.NotPrepared

		return $owners;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $filter Metadata filter.
	 *
	 * @return array|null
	 */
	public function metadata_collection_filters( array $filter ): ?array {
		$owners = null;
		$categories = null;
		$forms = null;
		$form_owners = null;

		if ( $filter['as_admin'] ) {
			// resolve categories if needed
			if ( $filter['resolve_categories'] ) {
				$categories = $this->get_metadata_categories( $filter );
			}

			if ( $filter['resolve_owners'] ) {
				$owners = $this->get_metadata_owners( $filter );
			}

			if ( $filter['resolve_forms'] ) {
				$forms = $this->get_metadata_forms( $filter );
			}

			if ( $filter['resolve_form_owners'] ) {
				$form_owners = $this->get_metadata_form_owners( $filter );
			}
		} else {
			if ( $filter['resolve_forms'] ) {
				$forms = $this->get_metadata_forms_for_submission_owner( $filter );
			}
			if ( $filter['resolve_categories'] ) {
				$categories = $this->get_metadata_categories_for_submission_owner( $filter );
			}
		}

		return [
			'owners' => $owners,
			'categories' => $categories,
			'forms' => $forms,
			'form_owners' => $form_owners,
		];
	}

	/**
	 * Get userportal related data for a given user.
	 *
	 * @param int $user_id User Id.
	 * @return array Portal related data.
	 */
	public static function get_user_portal_data( int $user_id ) : array {
		global $wpdb;
		$submission_table = Init::$database['submission'];
		$form_table = Init::$database['form'];

		/*
		SELECT
			count(s.id) submissionsCount,
			AVG(s.score / s.maxScore * 100) averageScore
		FROM
			`wp_wpq_eform_submission` s
			LEFT JOIN `wp_wpq_eform_form` f ON s.formId = f.id
		WHERE
			s.trashed = 0
			AND f.trashed = 0
			AND s.userId = 1;
		*/
		$query = "SELECT
			count(s.id) submissionsCount,
			AVG(s.score / s.maxScore * 100) averageScore
		FROM
			{$submission_table} s
			LEFT JOIN {$form_table} f ON s.formId = f.id
		WHERE
			s.trashed = 0
			AND f.trashed = 0
			AND s.userId = %d
		";

		$result = $wpdb->get_row(
			$wpdb->prepare( $query, $user_id ), // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
			ARRAY_A
		);

		if ( \is_array( $result ) ) {
			return $result;
		}
		return [];
	}

	/**
	 * Get token from id. Useful in tests.
	 *
	 * @param int $id Submission Id.
	 * @return null|string Token if found, null otherwise.
	 */
	public static function get_token_from_id( int $id ) : ?string {
		$table = Init::$database['submission'];
		global $wpdb;
		return $wpdb->get_var(
			$wpdb->prepare( "SELECT token FROM {$table} WHERE id = %d", $id ) // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}
}
