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
 * @package EForm
 * @subpackage Model
 */

namespace WPEForm\Model;

use WPEForm\GraphQL\Field\SiteSettings as SiteSettingsField;
use WPEForm\System\Install;

use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * SiteSettings Model. It works with WP Options instead of datatable.
 *
 * @package WPEForm\Model
 */
class SiteSettings extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	public function get_table_name() {
		return '';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array  $data Raw data from the database.
	 * @param string $purpose Purpose for normalization.
	 * @return array
	 */
	protected function normalize_data( $data, $purpose ) {
		$default = SiteSettingsField::get_default_site_settings();
		$default['userPortalSkeleton'] = '';
		$default['summaryGeneralSSR'] = '';
		return parse_args( $data, $default );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param   array  $data  Data to be validated.
	 * @param   string $purpose_code Purpose code for which this method is called.
	 *
	 * @return  array         Validated data.
	 */
	protected function validate_data( $data, $purpose_code ) {
		if ( empty( $data['system']['summaryPage'] ) ) {
			$data['system']['summaryPage'] = '0';
		}
		if ( empty( $data['system']['portalPage'] ) ) {
			$data['system']['portalPage'] = '0';
		}

		return $data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param int|null    $id Id of the entry.
	 * @param null|string $token Token of the entry.
	 * @return array
	 */
	protected function get_data_from_db( $id, $token = null ) {
		return \get_option( Install::SETTINGS_OPTION_NAME );
	}

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
	protected function create_data_on_db( $data ) {
		return [ null, null ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $data Data to create on db.
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function update_data_on_db( $data ) {
		\update_option( Install::SETTINGS_OPTION_NAME, $data );
		return 1;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $pagination Pagination Arguments.
	 * @param array $filter Filter arguments.
	 * @return array [ $edges, $edges_count, $all_edges_count, $limit ]
	 */
	protected function get_edges_for_collection( $pagination, $filter ) {
		return [ [], 0, 0, 0 ];
	}

	/**
	 * Whether or not site settings exists. Always returns true.
	 *
	 * @return bool
	 */
	public function exists(): bool {
		return true;
	}

	/**
	 * Whether or not site settings is trashed. Always returns false.
	 *
	 * @return bool
	 */
	public function is_trashed(): bool {
		return false;
	}
}
