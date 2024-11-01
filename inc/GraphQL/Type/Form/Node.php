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
 * @subpackage GraphQL\Type\Form
 */

namespace WPEForm\GraphQL\Type\Form;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Resolver\Category;
use WPEForm\GraphQL\Resolver\User;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class for FormNodeType
 */
class Node extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormNodeType',
			'fields' => [
				'id' => Type::nonNull( Type::id() ),
				'name' => Type::nonNull( Type::string() ),
				'updated' => Type::nonNull( Type::string() ),
				'created' => Type::nonNull( Type::string() ),
				// expose element types for pre-caching etc
				'elementTypes' => Type::nonNull( Type::listOf( Type::string() ) ),
				'standaloneLink' => Type::nonNull( Type::id() ),
				'owner' => [
					'type' => Type::nonNull( Registry::get( 'user', 'type' ) ),
					'resolve' => function( $root, $args ) {
						return User::get_user_by_id( $root['ownerid'] );
					},
				],
				'submissionCount' => [
					'type' => Type::nonNull( Type::int() ),
					'resolve' => function( $root, $args ) {
						return \intval( $root['submissionCount'] );
					},
				],
				'viewCount' => [
					'type' => Type::nonNull( Type::int() ),
				],
				'categories' => [
					'type' => Type::nonNull(
						Type::listOf(
							Type::nonNull( Registry::get( 'category', 'type' ) )
						)
					),
					'resolve' => function( $root, $args ) {
						return Category::read_form_categories( $root['id'] );
					},
				],
				'styleData' => [
					'type' => Type::string(),
				],
			],
		];
		parent::__construct( $config );
	}
}
