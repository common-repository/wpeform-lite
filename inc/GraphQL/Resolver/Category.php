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
 * @subpackage GraphQL\Resolver
 */

namespace WPEForm\GraphQL\Resolver;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\Controller\Category as CategoryController;
use WPEForm\Model\Category as CategoryModel;
use WPEForm\Auth\Category as CategoryAuth;
use WPEForm\GraphQL\Registry;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\System\Init;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to provide all resolvers for category related queries and mutations.
 */
class Category implements IResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @return CategoryController
	 */
	public static function get_controller() {
		return new CategoryController(
			new CategoryModel(),
			new CategoryAuth()
		);
	}

	/**
	 * Read category by Id.
	 *
	 * @param int $id Id of the category.
	 * @return array
	 */
	public static function read_category_by_id( $id ) {
		$controller = self::get_controller();
		return $controller->read( $id );
	}

	/**
	 * Read a possibly deleted category.
	 *
	 * Use this, when we need to account for missing categories from a pre-existing
	 * list.
	 *
	 * @param string $id Id of the category.
	 * @return array
	 */
	public static function read_possibly_deleted_category_by_id( $id ) : array {
		try {
			return self::read_category_by_id( $id );
		} catch ( \Exception $e ) {
			return [
				'id' => $id,
				'title' => __( '(deleted)', 'wp-eform' ),
				'description' => '',
				'formsCount' => 0,
			];
		}
	}

	/**
	 * Get all categories of a form, which are not trashed.
	 *
	 * @param int|string $id Id of the form.
	 * @return array Array of categories. As per GraphQL Type.
	 */
	public static function read_form_categories( $id ) : array {
		global $wpdb;
		$formmeta_table = Init::$database['formmeta'];
		$category_table = Init::$database['category'];
		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$categories = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT
					cat.id id,
					cat.title title,
					cat.description description
				FROM {$category_table} cat
				WHERE
					cat.trashed != 1
				AND
					cat.id IN (SELECT meta_value FROM {$formmeta_table} WHERE meta_key = 'category' AND foreign_id = %d)
				",
				$id
			)
		);
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( ! $categories ) {
			return [];
		}
		return $categories;
	}

	/**
	 * Get all Query fields for root Query.
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			// single category
			'category' => [
				'type' => Registry::get( 'category', 'type' ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					return self::read_category_by_id( $args['id'] );
				},
			],
			// category collection
			'categories' => [
				'type' => Registry::get( 'collection', 'type/category' ),
				'args' => [
					'pagination' => [
						'type' => Registry::get( 'pagination', 'input' ),
						'defaultValue' => [
							'first' => 10,
						],
					],
					'filter' => [
						'type' => Registry::get( 'filter', 'input/category' ),
						'defaultValue' => [],
					],
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->collection( $args['pagination'], $args['filter'] );
				},
			],
		];
	}

	/**
	 * Get all Mutation fields for root Mutation.
	 *
	 * @return array
	 */
	public static function get_mutation_fields() {
		return [
			// create category
			'createCategory' => [
				'type' => Registry::get( 'category', 'type' ),
				'args' => [
					'data' => Type::nonNull( Registry::get( 'category', 'input' ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->create( $args['data'] );
				},
			],
			// update category
			'updateCategory' => [
				'type' => Registry::get( 'category', 'type' ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
					'data' => Type::nonNull( Registry::get( 'category', 'input' ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->update( $args['id'], $args['data'] );
				},
			],
			// trash category
			'trashCategory' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->trash( $args['id'] );
				},
			],
			// untrash category
			'untrashCategory' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->untrash( $args['id'] );
				},
			],
			// delete category
			'deleteCategory' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->delete( $args['id'] );
				},
			],

			// bulk actions
			'trashCategories' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'ids' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->trash_collection( $args['ids'] );
				},
			],
			'untrashCategories' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'ids' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->untrash_collection( $args['ids'] );
				},
			],
			'deleteCategories' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'ids' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->delete_collection( $args['ids'] );
				},
			],
		];
	}
}
