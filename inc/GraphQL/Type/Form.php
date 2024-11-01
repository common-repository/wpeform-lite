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

namespace WPEForm\GraphQL\Type;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

use WPEForm\GraphQL\Registry;
use WPEForm\GraphQl\Resolver\Category;
use WPEForm\GraphQL\Resolver\User;

use function WPEForm\Helpers\convert_db_update_logs_to_graphql;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * GraphQL Type for Form.
 */
class Form extends ObjectType {
	/**
	 * Create an instance of Query.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormType',
			'fields' => [
				'id' => Type::nonNull( Type::id() ),
				'name' => Type::nonNull( Type::string() ),
				'integrations' => Registry::get( 'integrations', 'type/form' ),
				'payments' => Registry::get( 'payments', 'type/form' ),
				'permissions' => Registry::get( 'permissions', 'type/form' ),
				'settings' => Registry::get( 'settings', 'type/form' ),
				'styles' => Registry::get( 'styles', 'type/form' ),
				'structures' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'structure', 'type/form' ) )
					)
				),
				'elements' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'element', 'type/form' ) )
					)
				),
				'pools' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'pool', 'type/form' ) )
					)
				),
				'conditionals' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'conditional', 'type/form' ) )
					)
				),
				'updated' => Type::string(),
				'created' => Type::string(),
				// Owner::Computed field
				'owner' => [
					'type' => Registry::get( 'user', 'type' ),
					'resolve' => function( $root, $args ) {
						// in case if the ownerId is null, then don't resolve
						if ( $root['ownerid'] === null ) {
							return null;
						}
						return User::get_user_by_id( $root['ownerid'] );
					},
				],
				// Meta
				'categories' => [
					'type' => Type::nonNull(
						Type::listOf(
							Type::nonNull( Registry::get( 'category', 'type' ) )
						)
					),
					'resolve' => function( $root, $args ) {
						$category_ids = $root['categories'];
						$categories = [];
						foreach ( $category_ids as $id ) {
							// In case the category is deleted from the database
							// but it lingers in the meta-table, then we need a
							// safe-guard. Although per application logic, it should
							// never happen.
							$categories[] = Category::read_possibly_deleted_category_by_id( $id );
						}
						return $categories;
					},
				],
				'editors' => [
					'type' => Type::nonNull(
						Type::listOf(
							Type::nonNull( Registry::get( 'user', 'type' ) )
						)
					),
					'resolve' => function( $root, $args ) {
						$editors = [];
						foreach ( $root['editors'] as $uid ) {
							$editors[] = User::get_user_by_id( $uid );
						}
						return $editors;
					},
				],
				'updateLogs' => [
					'type' => Type::nonNull(
						Type::listOf(
							Type::nonNull( Registry::get( 'updateLog', 'type' ) )
						)
					),
					'resolve' => function( $root, $args ) {
						return convert_db_update_logs_to_graphql( $root['updateLogs'] );
					},
				],
				// Pre emptive Permissions
				'notices' => [
					'type' => Type::nonNull(
						Type::listOf(
							Type::nonNull( Registry::get( 'limitationMessage', 'type/form' ) )
						)
					),
				],
				'limitations' => [
					'type' => Type::nonNull(
						Type::listOf(
							Type::nonNull( Registry::get( 'limitationMessage', 'type/form' ) )
						)
					),
				],
			],
		];
		parent::__construct( $config );
	}
}
