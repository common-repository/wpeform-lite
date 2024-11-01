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

use WPEForm\Exception\ValidationException;
use WPEForm\System\Init;

use function WPEForm\Helpers\convert_list_to_dictionary;
use function WPEForm\Helpers\normalize_db_ids_for_in;
use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Model for managing all payments related data on database.
 */
class Payment extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_table_name() {
		return Init::$database['payment'];
	}

	/**
	 * {@inheritDoc}
	 *
	 * Throws exception if
	 * 1. Value of Type is not 0 and 1.
	 * 2. Value of subsInterval is not in [0, 1, 2, 3, 4].
	 * 3. Value of status is not in [0, 1, 2, 3, 4].
	 *
	 * @throws ValidationException If one of the conditions above are met.
	 *
	 * @param   array  $data  Data to be validated.
	 * @param   string $purpose_code Purpose code for which this method is called.
	 *
	 * @return  array         Validated data.
	 */
	public function validate_data( $data, $purpose_code ) {
		$allowed_types = [ 0, 1 ];
		$allowed_intervals = [ 0, 1, 2, 3, 4 ];
		$allowed_status = [ 0, 1, 2, 3, 4 ];
		$data['type'] = \intval( $data['type'] );
		$data['subsInterval'] = \intval( $data['subsInterval'] );
		$data['status'] = \intval( $data['status'] );
		if ( ! \in_array( $data['type'], $allowed_types, true ) ) {
			throw new ValidationException( "Invalid type, expected one of 0, 1, found {$data['type']}." );
		}
		if ( ! \in_array( $data['subsInterval'], $allowed_intervals, true ) ) {
			throw new ValidationException( "Invalid subsInterval, expected one of 0, 1, 2, 3, 4 found {$data['subsInterval']}." );
		}
		if ( ! \in_array( $data['status'], $allowed_status, true ) ) {
			throw new ValidationException( "Invalid status, expected one of 0, 1, 2, 3, 4 found {$data['status']}." );
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
			'txn' => null,
			'formId' => 0,
			'submissionId' => 0,
			'orderId' => '',
			'amount' => 0,
			'mode' => 'offline',
			'status' => 0,
			'meta' => '',
			'currency' => 'USD',
			'date' => \current_time( 'mysql', true ),
			'type' => 0,
			'subsPlan' => '',
			'subsInterval' => 0,
			'subsFrequency' => 0,
		];

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
		$table = $this->get_table_name();

		$in = normalize_db_ids_for_in( $ids );

		$query =
			"SELECT
				p.id id,
				p.txn txn,
				p.formId formId,
				p.submissionId submissionId,
				p.orderId orderId,
				p.amount amount,
				p.mode mode,
				p.status status,
				p.meta meta,
				p.currency currency,
				p.date date,
				p.type type,
				p.subsPlan subsPlan,
				p.subsInterval subsInterval,
				p.subsFrequency subsFrequency
			FROM {$table} p
			WHERE p.id IN ({$in})
			GROUP BY p.id";

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

		$query =
			"SELECT
				p.id id,
				p.txn txn,
				p.formId formId,
				p.submissionId submissionId,
				p.orderId orderId,
				p.amount amount,
				p.mode mode,
				p.status status,
				p.meta meta,
				p.currency currency,
				p.date date,
				p.type type,
				p.subsPlan subsPlan,
				p.subsInterval subsInterval,
				p.subsFrequency subsFrequency
			FROM {$table} p
			WHERE p.id = %d";

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
		$table = $this->get_table_name();
		$inserted = $wpdb->insert(
			$table,
			$this->get_allowed_db_items( $data, self::DB_CREATE ),
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
		return $wpdb->update(
			$this->get_table_name(),
			$this->get_allowed_db_items( $data, self::DB_UPDATE ),
			[
				'id' => $this->id,
			],
			'%s',
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
		$table = $this->get_table_name();

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
	 * @param int $id Id of the category.
	 * @return void
	 */
	protected function cleanup_after_data_delete( $id ) {
		// TODO: Set paid flag to 2 on original submission
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Collection ids.
	 * @return void
	 */
	protected function cleanup_after_collection_delete( array $ids ) {
		// TODO: Set paid flag to 2 on original submission
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	protected function get_orderby_whitelists(): array {
		return [ 'id', 'formId', 'amount', 'mode', 'status', 'date', 'type' ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_cursor_key_for_db_query(): string {
		return 'p.id';
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
		list( $limit, $order_by, $wheres, $offset ) = $this->get_limit_and_clause_from_cursor( $pagination );
		// TODO: Implement payments collection
		return [
			[],
			0,
			0,
			$limit,
			$offset,
		];
	}
}
