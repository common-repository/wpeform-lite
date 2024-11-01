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
 * @subpackage Controller
 */

namespace WPEForm\Controller;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * SiteSettings Controller.
 *
 * @package WPEForm\Controller
 */
class SiteSettings extends Base {
	/**
	 * Get GraphQL compatible data from model for settings.
	 *
	 * @return array
	 */
	protected function get_data_from_model() {
		return $this->model->read();
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
		return [];
	}
}
