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
use WPEForm\Controller\Form as FormController;
use WPEForm\Model\Form as FormModel;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\GraphQL\Registry;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

use function WPEForm\Helpers\is_wpeform_app_mode;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to provide static methods for all form related resolvers.
 */
class Form implements IResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @return FormController
	 */
	public static function get_controller() {
		return new FormController(
			new FormModel(),
			new FormAuth()
		);
	}

	/**
	 * Get all query fields for root query.
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'form' => [
				'type' => Type::nonNull( Registry::get( 'form', 'type' ) ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
					'increaseViewCount' => Type::boolean(),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					$result = $controller->read( $args['id'] );
					if (
						isset( $args['increaseViewCount'] )
						&& $args['increaseViewCount'] === true
						&& is_wpeform_app_mode()
					) {
						FormModel::increase_form_view_count( \intval( $args['id'] ) );
					}
					return $result;
				},
			],
			'forms' => [
				'type' => Registry::get( 'collection', 'type/form' ),
				'args' => [
					'pagination' => [
						'type' => Registry::get( 'pagination', 'input' ),
						'defaultValue' => [
							'first' => 10,
						],
					],
					'filter' => [
						'type' => Registry::get( 'filter', 'input/form' ),
						'defaultValue' => [],
					],
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->collection( $args['pagination'], $args['filter'] );
				},
			],
			'exportForm' => [
				'type' => Type::nonNull( Type::string() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->export( $args['id'] );
				},
			],
			'formMeta' => [
				'type' => Registry::get( 'formMeta', 'type' ),
				'args' => [
					'resourceView' => [
						'type' => Registry::get( 'resourceViewMode', 'enum' ),
						'defaultValue' => 'all',
					],
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->get_metadata( $info, $args );
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
			'createForm' => [
				'type' => Registry::get( 'form', 'type' ),
				'args' => [
					'data' => Type::nonNull( Registry::get( 'form', 'input' ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->create( $args['data'] );
				},
			],
			'updateForm' => [
				'type' => Registry::get( 'form', 'type' ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
					'data' => Type::nonNull( Registry::get( 'form', 'input' ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->update( $args['id'], $args['data'] );
				},
			],
			'importForm' => [
				'type' => Type::nonNull( Type::id() ),
				'args' => [
					'data' => Type::nonNull( Type::string() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->import( $args['data'] );
				},
			],
			'duplicateForm' => [
				'type' => Type::nonNull( Type::id() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->duplicate( $args['id'] );
				},
			],
			'trashForm' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->trash( $args['id'] );
				},
			],
			'untrashForm' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->untrash( $args['id'] );
				},
			],
			'deleteForm' => [
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
			'trashForms' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'ids' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->trash_collection( $args['ids'] );
				},
			],
			'untrashForms' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'ids' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->untrash_collection( $args['ids'] );
				},
			],
			'deleteForms' => [
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
