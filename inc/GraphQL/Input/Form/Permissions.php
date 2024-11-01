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
 * @subpackage GraphQL\Input\Form
 */

namespace WPEForm\GraphQL\Input\Form;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GraphQL\Util\TypeOrInputFromFields;
use WPEForm\Factory\Form\Config\Permissions as PermissionsConfig;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for FormPermissionsInput.
 */
class Permissions extends InputObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormPermissionsInput',
			'fields' => TypeOrInputFromFields::create_input_fields(
				PermissionsConfig::get_registered_configs_field_vars(),
				'FormPermissions'
			),
		];
		parent::__construct( $config );
	}
}
