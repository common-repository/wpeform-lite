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

use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\FieldVar;

use function WPEForm\Helpers\get_default_buttons_buttons;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Buttons Element class. Button Elements.
 *
 * Button elements to navigate, open a new link etc.
 */
class Buttons extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Button Elements', 'wp-eform' ),
			'description' => __( 'Button elements to navigate, open a new link etc.', 'wp-eform' ),
			'container' => false,
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
				'default' => __( 'Buttons element', 'wp-eform' ),
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function config_vars() : array {
		return [
			'interface' => [
				'alignment' => FieldVar::var(
					'center',
					Registry::get( 'alignment', 'enum' )
				),
				'size' => FieldVar::var(
					'small',
					Registry::get( 'genericSize', 'enum' )
				),
				// use `core/collections/buttonStyle
				'style' => FieldVar::var( '3d', Type::string() ),
				// if has rounded corner
				'rounded' => FieldVar::var( false, Type::boolean() ),
				// mono-colored or primary-colored
				'colored' => FieldVar::var( false, Type::boolean() ),
			],
			'attributes' => [
				'open' => FieldVar::var(
					'blank',
					Registry::get( 'buttonOpenType', 'enum' )
				),
				'popupHeight' => FieldVar::var( 600, Type::int() ),
				'popupWidth' => FieldVar::var( 600, Type::int() ),
			],
			'buttons' => FieldVar::var(
				get_default_buttons_buttons(),
				Type::listOf(
					Type::nonNull(
						Registry::get( 'button', 'type/form/element/config' )
					)
				),
				Type::listOf(
					Type::nonNull(
						Registry::get( 'button', 'input/form/element/config' )
					)
				),
				get_default_buttons_buttons( 'enum' )
			)->setValidator(
				'\\WPEForm\\Helpers\\validate_list_items_with_id_key'
			),
		];
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
	 * @return array
	 */
	public function get_data_score( array $config, array $data_value ) : array {
		return $this->get_default_data_score();
	}
}
