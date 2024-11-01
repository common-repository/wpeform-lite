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
use function WPEForm\Helpers\parse_args;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A controller class for Form Category.
 *
 * The methods reflects the ones in our GraphQL Server.
 */
class Category extends Base {
	/**
	 * Get GraphQL compatible data from model for a single category.
	 *
	 * @return array
	 */
	protected function get_data_from_model() {
		$data = $this->model->read();

		return [
			'id' => $this->model->get_id(),
			'title' => $data['title'],
			'description' => $data['description'],
			'formsCount' => $data['formsCount'],
		];
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
		$filter = parent::verify_filters_with_auth( $filter );
		// If we have a filter/trashed set
		if ( isset( $filter['trashed'] ) && true === $filter['trashed'] ) {
			if ( ! $this->auth->can_current_user_view_trashed() ) {
				throw new InsufficientPermissionException( 'Current user can not filter by trashed' );
			}
		}

		return $filter;
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
		return parse_args(
			$node,
			[
				'id' => null,
				'title' => '',
				'description' => '',
				'formsCount' => 0,
			]
		);
	}
}
