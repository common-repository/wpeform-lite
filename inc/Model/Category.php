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

use WPEForm\System\Init;

use function WPEForm\Helpers\convert_list_to_dictionary;
use function WPEForm\Helpers\normalize_db_ids_for_in;
use function WPEForm\Helpers\parse_args;
use WPEForm\Exception\ValidationException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A Model class for managing Form Category related DB operations.
 */
class Category extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_table_name() {
		return Init::$database['category'];
	}

	/**
	 * {@inheritDoc}
	 *
	 * Throws exception if
	 * 1. Category title is empty.
	 *
	 * @throws ValidationException If one of the conditions above are met.
	 *
	 * @param   array  $data  Data to be validated.
	 * @param   string $purpose_code Purpose code for which this method is called.
	 *
	 * @return  array         Validated data.
	 */
	public function validate_data( $data, $purpose_code ) {
		// Throw exception if data title is empty
		if ( '' === $data['title'] ) {
			throw new ValidationException( 'Category Title can not be empty.' );
		}
		return $data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array  $data Raw data from the database.
	 * @param string $purpose Purpose for normalization.
	 * @return array
	 */
	protected function normalize_data( $data, $purpose ) {
		// Create the default
		$default = [
			'title' => '',
			'description' => '',
		];

		if ( $purpose !== self::DB_CREATE ) {
			$default['formsCount'] = 0;
		}

		// Add defaults
		$data = parse_args( $data, $default );

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
		$table = Init::$database['category'];
		$formmeta_table = Init::$database['formmeta'];

		$in = normalize_db_ids_for_in( $ids );

		$query =
			"SELECT
				c.title title,
				c.description description,
				c.id id,
				COUNT(m.id) formsCount
			FROM {$table} c
			LEFT JOIN {$formmeta_table} m
			ON
				c.id = m.meta_value AND m.meta_key = 'category'
			WHERE c.id IN ({$in})
			GROUP BY c.id";

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
		$table = Init::$database['category'];
		$formmeta_table = Init::$database['formmeta'];

		$query =
			"SELECT
				c.title title,
				c.description description,
				c.id id,
				COUNT(m.id) formsCount
			FROM {$table} c
			LEFT JOIN {$formmeta_table} m
			ON
				c.id = m.meta_value AND m.meta_key = 'category'
			WHERE c.id = %d
			GROUP BY c.id";

		return $wpdb->get_row(
			$wpdb->prepare( $query, $id ), // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
			ARRAY_A
		);
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
		// Insert in database
		$table = Init::$database['category'];
		$inserted = $wpdb->insert( $table, $data, '%s' );
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
		return $wpdb->update(
			Init::$database['category'],
			[
				'title' => $data['title'],
				'description' => $data['description'],
			],
			[
				'id' => $this->id,
			],
			[
				'%s',
				'%s',
			],
			[
				'%d',
			]
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function delete_data_on_db() {
		global $wpdb;
		$table = Init::$database['category'];

		// Delete the category
		return $wpdb->delete(
			$table,
			[
				'id' => $this->id,
			],
			[
				'%d',
			]
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param int $id Id of the category.
	 * @return void
	 */
	protected function cleanup_after_data_delete( $id ) {
		// cleanup category from form metatable
		global $wpdb;
		$wpdb->delete(
			Init::$database['formmeta'],
			[
				'meta_key' => 'category',
				'meta_value' => $id,
			],
			[
				'%s',
				'%s',
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
		$table = Init::$database['formmeta'];
		$in = normalize_db_ids_for_in( $ids );
		$query = "DELETE FROM {$table} WHERE meta_key = 'category' AND meta_value IN ({$in})";
		$wpdb->query( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	protected function get_orderby_whitelists(): array {
		return [ 'id', 'title', 'formsCount' ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_cursor_key_for_db_query(): string {
		return 'c.id';
	}

	/**
	 * Get edges information for collection.
	 *
	 * It should query the database, normalize the data, maybe json_decode columns
	 * and give all the required information.
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
			[
				'trashed' => false,
				'search' => null,
			]
		);

		$table = Init::$database['category'];
		$formmeta_table = Init::$database['formmeta'];

		// possible wheres
		list( $limit, $order_by, $wheres, $offset ) = $this->get_limit_and_clause_from_cursor( $pagination );
		$all_edges_wheres = [];

		// add search if present
		if ( null !== $filter['search'] ) {
			// make sure we put in quotes otherwise it will be vulnerable
			$all_edges_wheres[] = $wheres[] = $wpdb->prepare(
				'title LIKE %s',
				'%' . $wpdb->esc_like( $filter['search'] ) . '%'
			); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
		}

		// add trashed
		$all_edges_wheres[] = $wheres[] = $this->get_trash_clause( $filter['trashed'] ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found

		// construct the where
		$where = $this->get_where_in_query( $wheres );
		$all_edges_where = $this->get_where_in_query( $all_edges_wheres );

		// construct the query
		$query =
			"SELECT
				c.title title,
				c.description description,
				c.id id,
				COUNT(m.id) formsCount
			FROM {$table} c
			LEFT JOIN {$formmeta_table} m
			ON
				c.id = m.meta_value AND m.meta_key = 'category'
			{$where}
			GROUP BY c.id
			ORDER BY {$order_by}
			LIMIT {$this->get_limit_query_from_caluse( $limit, $offset )}";

		$edges = $wpdb->get_results( $query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

		$edges_count = $wpdb->get_var( "SELECT COUNT(c.id) FROM {$table} c {$where}" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$all_edges_count = $wpdb->get_var( "SELECT COUNT(c.id) FROM {$table} c {$all_edges_where}" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		return [ $edges, $edges_count, $all_edges_count, $limit, $offset ];
	}
}
