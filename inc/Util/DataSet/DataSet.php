<?php
/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of WPEForm - WordPress Form Builder.
 *
 * WPEForm - WordPress Form Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * WPEForm - WordPress Form Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPEForm - WordPress Form Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package WPEForm
 * @subpackage Util\DataSet
 */

namespace WPEForm\Util\DataSet;

use WPEForm\Exception\ValidationException;

use function WPEForm\Helpers\find_item_in_array;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * The DataSet controller class.
 *
 * It has methods to query and resolve datasets from GraphQL.
 *
 * @package WPEForm\Util\DataSet
 */
class DataSet {
	/**
	 * Whitelisted datasets.
	 *
	 * @var array
	 */
	protected $whitelisted_datasets = [];

	/**
	 * Create an instance.
	 */
	public function __construct() {
		$this->whitelisted_datasets = \apply_filters(
			'wpeform_datasets_whitelist',
			[
				'country' => \WP_EFORM_ABSPATH . 'inc/Util/DataSet/country/data.json',
			]
		);
	}

	/**
	 * Read a data set. It Can return a full dataset or filter by Id.
	 *
	 * The extras in the dataset is automatically json_encoded.
	 *
	 * @param string $dataset The dataset. It sanitizes to prevent attack.
	 * @param string $id Id of the data to filter. If null, then an array of dataset is returned.
	 *
	 * @return array Either whole collection of dataset or just a single one.
	 *
	 * @throws ValidationException If invalid dataset is passed.
	 */
	public function read( string $dataset, ?string $id = null ) : ?array {
		if ( ! isset( $this->whitelisted_datasets[ $dataset ] ) ) {
			throw new ValidationException( 'Invalid dataset name passed.' );
		}
		$data = $this->whitelisted_datasets[ $dataset ];
		if ( \is_string( $data ) ) {
			$data = \json_decode( \file_get_contents( $data ), true );
		} elseif ( \is_callable( $data ) ) {
			$data = $data();
		}

		if ( $id === null ) {
			return (array) $data;
		}

		$item = find_item_in_array(
			$data,
			function( $data_item ) use ( $id ) {
				return $data_item['id'] === $id;
			}
		);
		return $item;
	}
}
