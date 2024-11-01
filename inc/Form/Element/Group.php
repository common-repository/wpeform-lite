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
 * @subpackage Element
 * @author Swashata Ghosh <swashata@wpquark.com>
 */

namespace WPEForm\Form\Element;

use function \__;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Group Element class. Question Group.
 *
 * Group multiple questions together.
 */
class Group extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Question Group', 'wp-eform' ),
			'description' => __( 'Group multiple questions together.', 'wp-eform' ),
			'container' => true,
			'category' => 'design',
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_generic_appearance_structure(): array {
		return [
			'title' => [
				'uses' => true,
				'default' => __( 'Question Group element', 'wp-eform' ),
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function config_vars() : array {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function data_value_vars(): array {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_unaccepted_children_types(): array {
		// just that we don't accept row/column directly here
		return [ 'row', 'column', 'group' ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array An associative array with success => bool, and message => string
	 */
	public function get_validation_status( array $config, array $data_value ) : array {
		return $this->get_default_validation_status();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array  Associative array with 'has', 'obtained' and 'outof',
	 *                each holding numeric value.
	 */
	public function get_data_score( array $config, array $data_value ) : array {
		return $this->get_default_data_score();
	}
}
