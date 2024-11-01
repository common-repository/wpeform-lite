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
 * @subpackage GraphQL\Type
 */

namespace WPEForm\GraphQL\Input\Form;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to represent conditionals Input.
 */
class Conditional extends InputObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'ConditionalInput',
			'fields' => [
				'id' => Type::nonNull( Type::id() ),
				'events' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'event', 'input/form/conditional' ) )
					)
				),
				'consequences' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'consequence', 'input/form/conditional' ) )
					)
				),
			],
		];
		parent::__construct( $config );
	}
}
