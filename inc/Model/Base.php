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

use WPEForm\Exception\InvalidOperationException;
use WPEForm\Exception\InvalidPaginationException;
use WPEForm\Exception\ModelOperationException;
use WPEForm\Util\Crypt;

use function WPEForm\Helpers\normalize_db_ids_for_in;
use function WPEForm\Helpers\parse_args;
use function WPEForm\Helpers\remove_unaccepted_items;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A base class for Models.
 */
abstract class Base implements IModel {
	const DB_CREATE = 'create';
	const DB_UPDATE = 'update';
	const DB_SETSTATE = 'setstate';
	const DB_UPDATE_COLUMNS = 'updatecolumns';

	/**
	 * Model ID.
	 *
	 * @var int
	 */
	protected $id = null;

	/**
	 * Model token.
	 *
	 * @var string|null
	 */
	protected $token = null;

	/**
	 * Model data as fetched from the database.
	 *
	 * @var array
	 */
	protected $data = null;

	/**
	 * Model metadata as fetched from the database.
	 *
	 * @var array
	 */
	protected $meta = [];

	/**
	 * Cached ids data. This is created when a call to `pre_cache_ids` is called.
	 *
	 * @var array
	 */
	protected $cached_ids_data = [];

	// Pre cache Ids methods

	/**
	 * Get pre-cache ids data, given the set of ids.
	 *
	 * Child classes must override this method to implement functionality.
	 *
	 * @param array $ids Array of ids.
	 * @return array|null dictionary of id => cached_data pair. Null if not implemented.
	 */
	protected function get_pre_cache_ids_data( array $ids ) : ?array {
		return null;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Array of ids.
	 * @return void
	 */
	final public function pre_cache_ids( array $ids ) : void {
		$cached_data = $this->get_pre_cache_ids_data( $ids );
		// bail if not implemented
		if ( $cached_data === null ) {
			$this->cached_ids_data = [];
			return;
		}
		foreach ( $ids as $id ) {
			// in an array, the key becomes integer, if it is numeric
			// this is PHP behavior
			// @see https://www.php.net/manual/en/language.types.array.php
			$key = \absint( $id );
			if ( ! isset( $cached_data[ $key ] ) ) {
				$cached_data[ $key ] = null;
			}
		}
		$this->cached_ids_data = $cached_data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return void
	 */
	final public function clear_pre_cache_ids(): void {
		$this->cached_ids_data = [];
	}

	// Some DB helper methods

	/**
	 * Get serializable columns for this model. Used by serialize and unserialize
	 * methods to json_encode or json_decode data before/after storing or reding
	 * from database table.
	 *
	 * By default it returns an empty array, which means, none of the data will be
	 * serialized or unserialized. Override in child classes to implement
	 * functionality.
	 *
	 * @return array
	 */
	public static function get_serializable_columns() : array {
		return [];
	}

	/**
	 * Unserialize the data inside serializables column
	 *
	 * @param array $data The source data directly from DB.
	 * @return array Unserialized data.
	 */
	protected function unserialize( array $data ) : array {
		foreach ( static::get_serializable_columns() as $key ) {
			if ( isset( $data[ $key ] ) && ! \is_array( $data[ $key ] ) ) {
				$data[ $key ] = \json_decode( $data[ $key ], true );
			}
		}
		return $data;
	}

	/**
	 * Serialize the data inside serializables column
	 *
	 * @param array $data The source data to be stored in DB.
	 * @return array Serialized data.
	 */
	protected function serialize( array $data ) : array {
		foreach ( static::get_serializable_columns() as $key ) {
			if ( isset( $data[ $key ] ) ) {
				$data[ $key ] = \json_encode( $data[ $key ] );
			}
		}
		return $data;
	}

	/**
	 * Get allowed keys on/from database table for a purpose.
	 *
	 * @throws LogicException If not being overriden by the child and called.
	 *
	 * @param string $purpose Purpose of operation.
	 *
	 * @return array
	 */
	protected function get_allowed_db_keys( string $purpose ) : array {
		throw new LogicException( 'Override get_allowed_db_keys in class ' . \get_class( $this ) . '.' );
		return []; // phpcs:ignore Squiz.PHP.NonExecutableCode.Unreachable
	}

	/**
	 * Get allowed items to insert/update into database table from the provided
	 * data for the provided purpose. Use it inside normalize_data and other
	 * db related operations.
	 *
	 * Make sure you've overriden the base `get_allowed_db_keys` method otherwise
	 * it will throw an error.
	 *
	 * @param array  $data Raw data.
	 * @param string $purpose Purpose for this operation.
	 *
	 * @return array
	 */
	protected function get_allowed_db_items( array $data, string $purpose ) : array {
		return remove_unaccepted_items(
			$data,
			$this->get_allowed_db_keys( $purpose )
		);
	}

	// Basic CRUD operation

	/**
	 * Checks if the Model exists in the database or not.
	 *
	 * @return boolean
	 */
	public function exists() : bool {
		return null !== $this->id;
	}

	/**
	 * Get table name for this model.
	 *
	 * It is used by some base methods.
	 *
	 * @return string
	 */
	abstract protected function get_table_name();

	/**
	 * Normalize data to its proper type and add default if not present.
	 *
	 * Merge defaults to current data, thereby validating its structure.
	 * Also removes the unneeded variables.
	 *
	 * Internally it calls parse_args to do a deep comparison and merge
	 * with the defaults.
	 *
	 * @param array  $data Raw data from the database.
	 * @param string $purpose Purpose for normalization.
	 * @return array
	 */
	abstract protected function normalize_data( $data, $purpose );

	/**
	 * Get data from database by querying with Id.
	 *
	 * If you need to json_decode any data from the entry, then you should do it
	 * here.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param int|null    $id Id of the entry.
	 * @param null|string $token Token of the entry.
	 * @return array
	 */
	abstract protected function get_data_from_db( $id, $token = null );

	/**
	 * Create data on database.
	 *
	 * If you need to json_encode any data for the entry, then you should do it
	 * here.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return array [ $wpdb insert result, last insert id ]
	 */
	abstract protected function create_data_on_db( $data );

	/**
	 * Update data on database.
	 *
	 * If you need to json_encode any data for the update, then you should do it
	 * here.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	abstract protected function update_data_on_db( $data );

	/**
	 * Delete data from database.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function delete_data_on_db() {
		global $wpdb;

		// Delete the form
		return $wpdb->delete(
			$this->get_table_name(),
			[
				'id' => $this->id,
			],
			[
				'%d',
			]
		);
	}

	/**
	 * A bunch of routines to call when the main model is deleted.
	 *
	 * @param int $id Id of the model which has been deleted.
	 * @return void
	 */
	protected function cleanup_after_data_delete( $id ) {}


	/**
	 * Get trash status of the model on database.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return boolean True if trashed, false otherwise.
	 */
	public function is_trashed() : bool {
		global $wpdb;
		$table = $this->get_table_name();
		$trashed = $wpdb->get_var(
			$wpdb->prepare( "SELECT trashed FROM {$table} WHERE id = %d", $this->id ) // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
		if ( '0' === $trashed ) {
			return false;
		}
		return true;
	}

	/**
	 * Mark data as trashed on database.
	 *
	 * The base class provides the simplest and consistent implementation of
	 * setting `trashed` to 0 and 1 for untrashed and trashed data.
	 *
	 * Override this if your implementation differs.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function trash_data_on_db() {
		global $wpdb;

		// Mark the data trashed
		return $wpdb->update(
			$this->get_table_name(),
			[
				'trashed' => 1,
			],
			[
				'id' => $this->id,
			],
			[
				'%d',
			],
			[
				'%d',
			]
		);
	}

	/**
	 * Mark data as untrashed on database.
	 *
	 * The base class provides the simplest and consistent implementation of
	 * setting `trashed` to 0 and 1 for untrashed and trashed data.
	 *
	 * Override this if your implementation differs.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function untrash_data_on_db() {
		global $wpdb;

		// Mark the data trashed
		return $wpdb->update(
			$this->get_table_name(),
			[
				'trashed' => 0,
			],
			[
				'id' => $this->id,
			],
			[
				'%d',
			],
			[
				'%d',
			]
		);
	}

	/**
	 * Validate data before setting it. By default this just returns data as-is.
	 * Override in child classes for custom implementation.
	 *
	 * It is called only during create and update and after calling `normalize_data`.
	 *
	 * @param   array  $data  Data to be validated.
	 * @param   string $purpose_code Purpose code for which this method is called.
	 *
	 * @return  array         Validated data.
	 */
	protected function validate_data( $data, $purpose_code ) {
		return $data;
	}

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
	public function set_data( $id, $token = null, $data = null ) : void {
		// 1. Get data and unserialize it
		if ( null === $data ) {
			// check for pre-cache
			if (
				! empty( $this->cached_ids_data )
				&& ! \is_null( $id )
				&& \array_key_exists( (string) $id, $this->cached_ids_data )
			) {
				$data = $this->cached_ids_data[ (string) $id ];
			} else {
				$data = $this->get_data_from_db( $id, $token );
			}
		}
		if ( \is_array( $data ) ) {
			// Unserialize it
			$data = $this->unserialize( $data );
		}

		// 2. If no data found, then reset state
		if ( ! $data ) {
			$this->reset_data();
			return;
		}

		// 3. data exists so update the flag
		if ( $token === null ) {
			$this->id = (int) $id;
		} else {
			$this->id = (int) $data['id'];
		}
		$this->token = $token;

		// 4. Set the data
		$this->data = $this->normalize_data( $data, self::DB_SETSTATE );
	}

	/**
	 * Reset internal state variables during runtime.
	 *
	 * @return void
	 */
	protected function reset_data() {
		$this->id = null;
		$this->data = null;
		$this->token = null;
	}

	/**
	 * Create a Model in database and set internal state.
	 *
	 * @throws InvalidOperationException If it is called on an existing database model.
	 * @throws ModelOperationException On database error.
	 *
	 * @global \WPDB $wpdb
	 * @param array $data Model data.
	 * @return void
	 */
	public function create( $data ) : void {
		if ( $this->exists() ) {
			throw new InvalidOperationException( 'Can not create a model on existing ID. Set Id to null.' );
		}

		// Normalize the data
		$data = $this->normalize_data( $data, self::DB_CREATE );
		// Validate the data
		$data = $this->validate_data( $data, self::DB_CREATE );
		// serialize the data
		$data = $this->serialize( $data );

		// Create it in the database
		[ $inserted, $insert_id ] = $this->create_data_on_db( $data );

		if ( false === $inserted ) {
			throw new ModelOperationException( 'Could not create the model' );
		}

		// get the Id and set it
		$this->set_data( $insert_id );
	}

	/**
	 * Read Model data from database.
	 *
	 * @throws InvalidOperationException If it is not called on an existing database model.
	 *
	 * @return array
	 */
	public function read() {
		if ( ! $this->exists() ) {
			throw new InvalidOperationException( 'The model does not exist. Make sure you have provided an Id and that it is valid.' );
		}
		return $this->data;
	}

	/**
	 * Update Model data in database.
	 *
	 * @throws InvalidOperationException If it is not called on an existing database model.
	 * @throws ModelOperationException On database error.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Model Data.
	 * @return void
	 */
	public function update( $data ) : void {
		if ( ! $this->exists() ) {
			throw new InvalidOperationException( 'The model does not exist. Make sure you have provided an Id and that it is valid.' );
		}

		// normalize the data
		$data = $this->normalize_data( $data, self::DB_UPDATE );
		// validate the data
		$data = $this->validate_data( $data, self::DB_UPDATE );
		// Serialize the data it received
		$data = $this->serialize( $data );

		$updated_status = $this->update_data_on_db( $data );

		if ( false === $updated_status ) {
			throw new ModelOperationException( 'Could not update the model' );
		}

		$this->set_data( $this->id );
	}

	/**
	 * Update columns on the model without affecting others.
	 *
	 * This method doesn't do any normalization or validation. It just makes sure
	 * only allowed items are passed from data. It relies internally on
	 * `get_allowed_db_items` and passes DB_UPDATE_COLUMNS as second parameter.
	 *
	 * @throws InvalidOperationException If model doesn't exist.
	 * @throws ModelOperationException If could not update model.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data in `column => value` array format.
	 *
	 * @return void
	 */
	public function update_columns( $data ) : void {
		global $wpdb;

		if ( ! $this->exists() ) {
			throw new InvalidOperationException( 'The model does not exist. Make sure you have provided an Id and that it is valid.' );
		}

		$table_name = $this->get_table_name();

		if ( empty( $table_name ) ) {
			// throw error
			throw new InvalidOperationException( 'update_columns cannot be called if table name is empty.' );
		}

		// this doesn't do any normalization or validation at all
		$dbdata = $this->get_allowed_db_items( $data, self::DB_UPDATE_COLUMNS );

		$updated_status = $wpdb->update(
			$table_name,
			$dbdata,
			[
				'id' => $this->id,
			],
			'%s',
			'%d'
		);
		if ( false === $updated_status ) {
			throw new ModelOperationException( 'Could not update the model' );
		}

		$this->set_data( $this->id );
	}

	/**
	 * Get direct MySQL query result for complicated queries outside of default
	 * CRUD and metadata stuff.
	 *
	 * **This doesn't escape anything, so make sure you have done so yourself.**
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param string $query MySQL Query. `##TABLE##` will be replaced.
	 *
	 * @return array|null
	 */
	public function query( string $query ) : ?array {
		global $wpdb;
		// replace the table
		$query = \str_replace(
			'##TABLE##',
			$this->get_table_name(),
			$query
		);

		return $wpdb->get_results( $query, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	/**
	 * Trash the model.
	 *
	 * @throws InvalidOperationException If it is not called on an existing database model.
	 * @throws ModelOperationException On database error.
	 *
	 * @return void
	 */
	public function trash() : void {
		if ( ! $this->exists() ) {
			throw new InvalidOperationException( 'Can not trash a model if it does not exist.' );
		}

		$trashed_status = $this->trash_data_on_db();

		if ( false === $trashed_status ) {
			throw new ModelOperationException( 'Could not trash the model' );
		}
	}

	/**
	 * Untrash the model.
	 *
	 * @throws InvalidOperationException If it is not called on an existing database model.
	 * @throws ModelOperationException On database error.
	 *
	 * @return void
	 */
	public function untrash() : void {
		if ( ! $this->exists() ) {
			throw new InvalidOperationException( 'Can not untrash a model if it does not exist.' );
		}

		$trashed_status = $this->untrash_data_on_db();

		if ( false === $trashed_status ) {
			throw new ModelOperationException( 'Could not untrash the model' );
		}
	}

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
	public function delete() : void {
		if ( ! $this->exists() ) {
			throw new InvalidOperationException( 'Can not delete a model if it does not exist.' );
		}

		$id = $this->id;

		$deleted_status = $this->delete_data_on_db();

		if ( false === $deleted_status ) {
			throw new ModelOperationException( 'Could not delete the model' );
		}

		$this->reset_data();
		$this->reset_meta();
		$this->delete_all_meta_on_db( $id );
		$this->cleanup_after_data_delete( $id );
	}

	// Meta related methods

	/**
	 * Get table name for metadata relation.
	 *
	 * If this returns a string, then meta features will be live in the model.
	 * By default it returns null which turns off all the meta features.
	 *
	 * @return string
	 */
	protected function get_meta_table_name() {
		return null;
	}

	/**
	 * Delete all metadata from database.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param int $id Id of the deleted model.
	 * @return void
	 */
	protected function delete_all_meta_on_db( $id ) {
		$table = $this->get_meta_table_name();
		if ( null === $table ) {
			return;
		}
		global $wpdb;
		$wpdb->delete(
			$table,
			[
				'foreign_id' => $id,
			],
			[
				'%d',
			]
		);
	}

	/**
	 * Get metadata from the meta table in Database.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return array
	 */
	protected function get_meta_from_db() {
		// override this if your model has some other sort of meta functionality
		$table = $this->get_meta_table_name();
		if ( null === $table ) {
			return null;
		}

		if ( null === $this->id ) {
			return null;
		}

		global $wpdb;
		// query db
		return $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, meta_value FROM {$table} WHERE foreign_id = %d", $this->id ), ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	}

	/**
	 * Update metadata on the database table.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param string $key Value of `meta_key`.
	 * @param array  $values Indexed array of values.
	 * @return void
	 */
	protected function update_meta_on_db( $key, $values ) {
		$table = $this->get_meta_table_name();
		if ( null === $table ) {
			return;
		}

		global $wpdb;
		// If the value is empty, then just delete all meta
		if ( empty( $values ) ) {
			$wpdb->query( $wpdb->prepare( "DELETE FROM {$table} WHERE foreign_id = %d AND meta_key = %s", $this->id, $key ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		} else {
			// First delete all  meta entries which are not in
			// currently provided values
			$meta_values = "'" . implode( "','", esc_sql( $values ) ) . "'";
			$wpdb->query( $wpdb->prepare( "DELETE FROM {$table} WHERE foreign_id = %d AND meta_key = %s AND meta_value NOT IN ({$meta_values})", $this->id, $key ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			// Now loop over and add them
			foreach ( $values as $val ) {
				if ( ! $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$table} WHERE foreign_id = %d AND meta_key = %s AND meta_value = %s", $this->id, $key, $val ) ) ) { // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
					$wpdb->insert(
						$table, [
							'foreign_id' => $this->id,
							'meta_key' => $key,
							'meta_value' => $val,
						], [ '%d', '%s', '%s' ]
					);
				}
			}
		}
	}

	/**
	 * Reset Model metadata.
	 *
	 * This does not do anything in the database.
	 *
	 * @return void
	 */
	protected function reset_meta() {
		$this->meta = [];
	}

	/**
	 * Set the meta state by querying the table.
	 *
	 * @param array $meta Forcibly set meta without querying the database.
	 *                    Useful for setting meta right after create or update.
	 * @return void
	 */
	protected function set_meta( $meta = null ) {
		// If the model has no Id, then we can not set a meta
		if ( ! $this->exists() ) {
			$this->reset_meta();
			return;
		}

		// If not being forced to use meta from method, then get it from db
		if ( null === $meta ) {
			$meta = $this->get_meta_from_db();
		}

		// If this is still null, then return
		if ( null === $meta ) {
			$this->reset_meta();
			return;
		}

		// group by meta_key
		$grouped_meta = [];
		if ( $meta ) {
			foreach ( $meta as $single_meta ) {
				if ( isset( $grouped_meta[ $single_meta['meta_key'] ] ) ) {
					$grouped_meta[ $single_meta['meta_key'] ][] = $single_meta['meta_value'];
				} else {
					$grouped_meta[ $single_meta['meta_key'] ] = [ $single_meta['meta_value'] ];
				}
			}
		}
		$this->meta = $grouped_meta;
	}

	/**
	 * Get all metadata of the Model.
	 *
	 * @param null|string $key The meta key. If ommitted, then all metadata are
	 *                    returned.
	 * @return array Associative array of metadata if $key is null, otherwise
	 *               the specific metadata.
	 */
	public function read_meta( ?string $key = null ) : array {
		if ( ! $this->exists() ) {
			return [];
		}
		if ( null === $key ) {
			return $this->meta;
		} elseif ( is_array( $this->meta ) && isset( $this->meta[ $key ] ) ) {
			return $this->meta[ $key ];
		}
		return [];
	}

	/**
	 * Set the meta key while keeping the identical values intact.
	 *
	 * Only deletes what is not in the $values and inserts new meta.
	 *
	 * @param string $key Value of `meta_key`.
	 * @param array  $values Indexed array of values.
	 * @return void
	 */
	public function update_meta( string $key, array $values ) : void {
		if ( ! $this->exists() ) {
			return;
		}
		$this->update_meta_on_db( $key, $values );
		$this->set_meta();
	}

	// Basic Find by Id methods

	/**
	 * Find a Model by Id and set internal state for doing operations.
	 *
	 * @param int|string|null $id Model ID, corresponding to the database.
	 * @param string|null     $token Set Id by token.
	 * @return void
	 */
	public function set_id( $id, $token = null ) : void {
		// bail early if $id and $token are the same
		if ( $this->id === $id && $this->token === $token ) {
			return;
		}

		if ( $id !== null || $token !== null ) {
			$this->set_data( $id, $token );
			$this->set_meta();
		} else {
			$this->reset_data();
			$this->reset_meta();
		}
	}

	/**
	 * Get the database Id of the Model.
	 *
	 * @return int
	 */
	public function get_id() {
		return (int) $this->id;
	}

	// Collection and Cursor related methods

	/**
	 * Get whitelists of strings for orderby. It should be overridden by child
	 * class to support it. Otherwise it will always throw an error.
	 *
	 * @return array
	 */
	protected function get_orderby_whitelists(): array {
		return [ 'id' ];
	}

	/**
	 * Get Key for Cursor.
	 *
	 * It defaults to `id` which should work for most of the models. Override it
	 * if your edges returned doesn't have an `id` field.
	 *
	 * @return string
	 */
	protected function get_cursor_key_for_collection(): string {
		return 'id';
	}

	/**
	 * Get key for column used as cursor. Usually it is the same as
	 * `get_cursor_key_for_collection` for simpler queries.
	 *
	 * However, since this usually corresponds to the MySQL table column name, it
	 * could be a composite key like `f.id` in case of JOINs.
	 *
	 * @return string
	 */
	protected function get_cursor_key_for_db_query(): string {
		return 'id';
	}

	/**
	 * Get the proper value of MySQL `LIMIT` clause based on clause.
	 *
	 * @param int         $limit Limit returned from the clause.
	 * @param array|false $offset Offset returned from the clause.
	 * @return string;
	 */
	protected function get_limit_query_from_caluse( $limit, $offset ) {
		if ( false === $offset ) {
			return $limit;
		}
		return $offset[0];
	}

	/**
	 * Get limit and where clause from pagination and cursor or offset.
	 *
	 * This implements both cursor based and offset pagination (with sort).
	 *
	 * If offset pagination is created from the argument, then the last element of
	 * the return array contains a string, otherwise, it would always contain
	 * false. The return has below structure:
	 *
	 * * $limit -> Number of edges to be fetched.
	 * * $orderby -> Argument of `ORDER BY` in MySQL query.
	 * * $where_for_pagination -> Array of WHERE clauses, should be joined by ` AND `.
	 * * $offset -> It would be `false` if pagination is cursor based, otherwise it
	 *              would be an array where:
	 *    * $offset[0] -> is the argument of `LIMIT` in MySQL query.
	 *    * $offset[1] -> is the current page.
	 *
	 * @global \WPDB $wpdb
	 *
	 * @throws InvalidPaginationException If first/after or last/before has invalid edges count.
	 * @throws InvalidPaginationException If first/after or last/before has invalid edges count.
	 *
	 * @param array $pagination PageInfoType as acquired from GraphQL.
	 * @return array [ $limit, $orderby, $where_for_pagination, $offset ]
	 */
	protected function get_limit_and_clause_from_cursor( $pagination ) {
		global $wpdb;

		$cursor = $this->get_cursor_key_for_db_query();

		// Normalize pagination cursor and limit
		$pagination = parse_args(
			$pagination,
			[
				'with' => 'cursor',
				'orderby' => $cursor,
				'page' => 1,
				'first' => null,
				'last' => null,
				'after' => null,
				'before' => null,
			]
		);

		$wheres = [];

		// simple pagination algorithm with offset and order
		if ( 'offset' === $pagination['with'] ) {
			// sanitize orderby
			if ( ! \in_array( $pagination['orderby'], $this->get_orderby_whitelists() ) ) {
				throw new InvalidPaginationException( 'Invalid value given in orderby.' );
			}

			if ( null === $pagination['last'] ) {
				// with OFFSET, if user supplies first, then it means orderby DESCENDING
				$limit = (int) $pagination['first'];
				$order_by = "{$pagination['orderby']} DESC";
			} else {
				// with OFFSET, if user supplies last, then it means orderby ASCENDING
				$limit = (int) $pagination['last'];
				$order_by = "{$pagination['orderby']} ASC";
			}
			$page = (int) $pagination['page'];

			// At this point, if $limit is less than 0, then throw error
			if ( $limit < 0 ) {
				throw new InvalidPaginationException( 'first or last can not be less than 0 in pagination.' );
			}
			// Also throw error if page is less than one
			if ( $page < 1 ) {
				throw new InvalidPaginationException( 'page can not be less than 1.' );
			}

			$offset = [ ( ( $page - 1 ) * $limit ) . ',' . $limit, $page ];
			return [ $limit, $order_by, $wheres, $offset ];
		}

		// Paging algorithm at per with relay
		// {@link https://facebook.github.io/relay/graphql/connections.htm#sec-Pagination-algorithm}
		// based on set values of first and last, let's construct the
		// order_by and limit
		// Reason we do null === $pagination['last']
		// and not null !== $pagination['first'] is
		// by default $pagination['first'] has a value of 10.
		if ( null === $pagination['last'] ) {
			// case 1: Client is traversing with first/after
			$order_by = "{$cursor} DESC";
			$limit = (int) $pagination['first'];
			// Our where clause will change, if client is also asking for after
			// i.e, a cursor is present
			if ( null !== $pagination['after'] ) {
				$wheres[] = $wpdb->prepare( "{$cursor} < %d", Crypt::decode_cursor( $pagination['after'] ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			}
		} else {
			// case 2: Client is traversing with last/before
			$order_by = "{$cursor} ASC";
			$limit = (int) $pagination['last'];
			// Our where clause will change, if client is also asking for before
			// i.e, a cursor is present
			if ( null !== $pagination['before'] ) {
				$wheres[] = $wpdb->prepare( "{$cursor} > %d", Crypt::decode_cursor( $pagination['before'] ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			}
		}

		// At this point, if $limit is less than 0, then throw error
		if ( $limit < 0 ) {
			throw new InvalidPaginationException( 'first or last can not be less than 0 in pagination.' );
		}

		return [ $limit, $order_by, $wheres, false ];
	}

	/**
	 * Convert wheres condition array into WHERE clause for query.
	 *
	 * @param array  $wheres Where conditions in array.
	 * @param string $glue How to add where conditions. ' AND ' or ' OR '.
	 * @return string Either empty string or a full 'WHERE cond=val AND cond2=val2' string.
	 */
	protected function get_where_in_query( $wheres, $glue = ' AND ' ) {
		$where = '';
		if ( ! empty( $wheres ) ) {
			$where = ' WHERE ' . \implode( $glue, $wheres );
		}
		return $where;
	}

	/**
	 * Get trash where clause based on filter.
	 *
	 * @param bool $trashed Whether it is trashed or not.
	 * @return string
	 */
	protected function get_trash_clause( $trashed ) {
		if ( true === $trashed ) {
			return 'trashed = 1'; // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
		}
		return 'trashed = 0'; // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
	}

	/**
	 * Get edges information for collection.
	 *
	 * It should query the database, normalize the data, maybe json_decode columns
	 * and give all the required information.
	 *
	 * @param array $pagination Pagination Arguments.
	 * @param array $filter Filter arguments.
	 * @return array [ $edges, $edges_count, $all_edges_count, $limit ]
	 */
	abstract protected function get_edges_for_collection( $pagination, $filter );

	/**
	 * Get All categories from the database.
	 *
	 * It implements cursor based pagination according to facebook relay algorithm.
	 *
	 * @param array $pagination Pagination Arguments.
	 * @param array $filter Filter arguments.
	 * @return array Associative array with edges and pageInfo.
	 */
	public function collection( array $pagination, array $filter ) : array {
		list( $edges, $edges_count, $all_edges_count, $limit, $offset ) = $this->get_edges_for_collection( $pagination, $filter );
		$cursor_key = $this->get_cursor_key_for_collection();

		// Add cursor to the edges
		foreach ( $edges as $index => $edge ) {
			$edges[ $index ]['cursor'] = Crypt::encode_cursor( $edge[ $cursor_key ] );
		}

		// If we had offset based pagination, then we don't need to do manual
		// sorting and paginations
		if ( false !== $offset ) {
			$total_pages = \ceil( $all_edges_count / $limit );
			return [
				'edges' => $edges,
				'all_edges_count' => $all_edges_count,
				'has_previous_page' => $offset[1] > 1,
				'has_next_page' => $offset[1] < $total_pages,
				'edges_count' => $edges_count,
			];
		}

		// We need to reverse the $edges in case where $pagination is based on last
		if ( isset( $pagination['last'] ) && null !== $pagination['last'] ) {
			$edges = array_reverse( $edges );
		}

		$has_previous_page = false;
		$has_next_page = false;

		if ( $edges_count > $limit ) {
			// Reason we do null === $pagination['last']
			// and not null !== $pagination['first'] is
			// by default $pagination['first'] has a value of 10.
			if ( ! isset( $pagination['last'] ) || null === $pagination['last'] ) {
				$has_next_page = true;
			} else {
				$has_previous_page = true;
			}
		}

		return [
			'edges' => $edges,
			'all_edges_count' => $all_edges_count,
			'has_previous_page' => $has_previous_page,
			'has_next_page' => $has_next_page,
			'edges_count' => $edges_count,
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $filter Metadata filter.
	 *
	 * @return array|null
	 */
	public function metadata_collection_filters( array $filter ): ?array {
		return null;
	}

	/**
	 * A bunch of routines to call when a collection is deleted.
	 *
	 * @param array $ids Collection ids.
	 * @return void
	 */
	protected function cleanup_after_collection_delete( array $ids ) {}

	/**
	 * Get trashed column name for collection operation.
	 *
	 * @return string
	 */
	protected function get_trash_column_name_for_collection_operation() : string {
		return 'trashed';
	}

	/**
	 * Delete all metadata after a bunch of resources has been deleted.
	 *
	 * @param array $ids Ids of resources which have been deleted.
	 * @return void
	 */
	protected function delete_metadata_after_collection_delete( array $ids ) : void {
		$table = $this->get_meta_table_name();
		if ( null === $table ) {
			return;
		}
		global $wpdb;
		$in = normalize_db_ids_for_in( $ids );
		$query = "DELETE FROM {$table} WHERE foreign_id IN ({$in})";
		$wpdb->query( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Collection ids to delete.
	 * @return void
	 */
	public function delete_collection( array $ids ) : void {
		global $wpdb;
		$table = $this->get_table_name();
		$in = normalize_db_ids_for_in( $ids );
		$query = "DELETE FROM {$table} WHERE id IN ({$in})";
		$wpdb->query( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		$this->delete_metadata_after_collection_delete( $ids );
		$this->cleanup_after_collection_delete( $ids );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Collection ids to trash.
	 * @return void
	 */
	public function trash_collection( array $ids ) : void {
		global $wpdb;
		$table = $this->get_table_name();
		$in = normalize_db_ids_for_in( $ids );
		$trashed_column = $this->get_trash_column_name_for_collection_operation();
		$query = "UPDATE {$table} SET {$trashed_column} = 1 WHERE id IN ({$in})";
		$wpdb->query( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $ids Collection ids to untrash.
	 * @return void
	 */
	public function untrash_collection( array $ids ) : void {
		global $wpdb;
		$table = $this->get_table_name();
		$in = normalize_db_ids_for_in( $ids );
		$trashed_column = $this->get_trash_column_name_for_collection_operation();
		$query = "UPDATE {$table} SET {$trashed_column} = 0 WHERE id IN ({$in})";
		$wpdb->query( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}
}
