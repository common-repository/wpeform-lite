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
 * @subpackage GraphQL\Input
 */

namespace WPEForm\GraphQL\Input;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Input type for Form related mutations.
 */
class Form extends InputObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$skeleton_input_type = new InputObjectType(
			[
				'name' => 'FormSkeletonInput',
				'fields' => [
					'formPreviewSkeleton' => Type::nonNull( Type::string() ),
					'formEditSkeleton' => Type::nonNull( Type::string() ),
					'formSummarySkeleton' => Type::nonNull( Type::string() ),
				],
			]
		);
		$config = [
			'name' => 'FormInput',
			'fields' => [
				'name' => Type::nonNull( Type::string() ),
				'integrations' => Registry::get( 'integrations', 'input/form' ),
				'payments' => Registry::get( 'payments', 'input/form' ),
				'permissions' => Registry::get( 'permissions', 'input/form' ),
				'settings' => Registry::get( 'settings', 'input/form' ),
				'styles' => Registry::get( 'styles', 'input/form' ),
				'structures' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'structure', 'input/form' ) )
					)
				),
				'elements' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'element', 'input/form' ) )
					)
				),
				'pools' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'pool', 'input/form' ) )
					)
				),
				'conditionals' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'conditional', 'input/form' ) )
					)
				),
				'categories' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Type::id() )
					)
				),
				'editors' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Type::id() )
					)
				),
				'skeleton' => $skeleton_input_type,
			],
		];
		parent::__construct( $config );
	}
}
