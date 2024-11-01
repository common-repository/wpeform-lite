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

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Model interface as expected by the controllers.
 */
interface IModel {
	/**
	 * Checks if the Model exists in the database or not.
	 *
	 * @return bool
	 */
	public function exists() : bool;

	/**
	 * Get trash status of the model on database.
	 *
	 * @return bool True if trashed, false otherwise.
	 */
	public function is_trashed() : bool;

	/**
	 * Create a Model in database and set internal state.
	 *
	 * @param mixed $data Model data.
	 * @return int Id of Model for success.
	 */
	public function create( $data ) : void;

	/**
	 * Read Model data from database.
	 *
	 * @return mixed
	 */
	public function read();

	/**
	 * Update Model data in database.
	 *
	 * @param mixed $data Model Data.
	 * @return void
	 */
	public function update( $data ) : void;

	/**
	 * Update columns on the model without affecting others.
	 *
	 * @param array $data Data in `column => value` array format.
	 *
	 * @return void
	 */
	public function update_columns( $data ) : void;

	/**
	 * Get direct MySQL query result for complicated queries outside of default
	 * CRUD and metadata stuff.
	 *
	 * @param string $query MySQL Query. `##TABLE##` will be replaced.
	 *
	 * @return array|null
	 */
	public function query( string $query ) : ?array;

	/**
	 * Trash the model.
	 *
	 * @return void
	 */
	public function trash() : void;

	/**
	 * Untrash the model.
	 *
	 * @throws InvalidOperationException If it is not called on an existing database model.
	 * @throws ModelOperationException On database error.
	 *
	 * @return void
	 */
	public function untrash() : void;

	/**
	 * Delete the model.
	 *
	 * @throws InvalidOperationException If it is not called on an existing database model.
	 * @throws ModelOperationException On database error.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return void
	 */
	public function delete() : void;

	/**
	 * Get all metadata of the Model.
	 *
	 * @param null|string $key The meta key. If ommitted, then all metadata are
	 *                    returned.
	 * @return array Associative array of metadata if $key is null, otherwise
	 *               the specific metadata.
	 */
	public function read_meta( ?string $key = null ) : array;

	/**
	 * Set the meta key while keeping the identical values intact.
	 *
	 * Only deletes what is not in the $values and inserts new meta.
	 *
	 * @param string $key Value of `meta_key`.
	 * @param array  $values Indexed array of values.
	 * @return void
	 */
	public function update_meta( string $key, array $values ) : void;

	/**
	 * Pre-cache ids for subsequent set_id calls. This method, if implemented
	 * would bypass the need to query the database any further.
	 *
	 * This works only with ids, and not tokens at this moment.
	 *
	 * @param array $ids Array of ids.
	 * @return void
	 */
	public function pre_cache_ids( array $ids ) : void;

	/**
	 * Clear pre-cache ids.
	 *
	 * @return void
	 */
	public function clear_pre_cache_ids() : void;

	/**
	 * Find a Model by Id and set internal state for doing operations.
	 *
	 * @param int|string|null $id Model ID, corresponding to the database.
	 * @param string|null     $token Set Id by token.
	 * @return void
	 */
	public function set_id( $id, $token = null ) : void;

	/**
	 * Get the database Id of the Model.
	 *
	 * @return int|string
	 */
	public function get_id();

	/**
	 * Set the data state by querying the table.
	 *
	 * @param int|null    $id   Id of the entry.
	 * @param null|string $token Token of the entry. Pass this when querying with
	 *                           token instead of Id.
	 * @param array       $data Forcibly set data without querying the database.
	 *                    Useful for setting state right after create or update.
	 * @return void
	 */
	public function set_data( $id, $token = null, $data = null ) : void;

	/**
	 * Get All categories from the database.
	 *
	 * It implements cursor based pagination according to facebook relay algorithm.
	 *
	 * @param array $pagination Pagination Arguments.
	 * @param array $filter Filter arguments.
	 * @return array Associative array with edges and pageInfo.
	 */
	public function collection( array $pagination, array $filter ) : array;

	/**
	 * Get additional metadata for various operations of the model, especially
	 * filtering through collection.
	 *
	 * @param array $filter Metadata filters.
	 *
	 * @return array|null
	 */
	public function metadata_collection_filters( array $filter ) : ?array;

	/**
	 * Delete a collection.
	 *
	 * @param array $ids Collection ids to delete.
	 * @return void
	 */
	public function delete_collection( array $ids ) : void;

	/**
	 * Trash a collection.
	 *
	 * @param array $ids Collection ids to trash.
	 * @return void
	 */
	public function trash_collection( array $ids ) : void;

	/**
	 * Untrash a collection.
	 *
	 * @param array $ids Collection ids to untrash.
	 * @return void
	 */
	public function untrash_collection( array $ids ) : void;
}
