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
use WPEForm\GraphQL\Registry;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Controller\Submission as SubmissionController;
use WPEForm\Auth\Submission as SubmissionAuth;
use WPEForm\Model\Submission as SubmissionModel;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to provide all resolvers for submission related queries and mutations.
 */
class Submission implements IResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @return SubmissionController
	 */
	public static function get_controller() {
		return new SubmissionController(
			new SubmissionModel(),
			new SubmissionAuth()
		);
	}

	/**
	 * Get possible id and token from arguments as a touple.
	 *
	 * @param array $args Arguments from user input.
	 *
	 * @return array
	 */
	protected static function get_possible_id_and_token( $args ) : array {
		$id = $args['id'] ?? null;
		$token = $args['token'] ?? null;
		return [ $id, $token ];
	}

	/**
	 * Get all Query fields for root Query.
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			// single submission
			'submission' => [
				'type' => Registry::get( 'submission', 'type' ),
				'args' => [
					// query by ID or token.
					// id takes into account the auth level of user
					// whereas with token, anyone can query if it matches
					'id' => Type::id(),
					'token' => Type::id(),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					[ $id, $token ] = self::get_possible_id_and_token( $args );
					return $controller->read( $id, $token );
				},
			],
			// collection
			'submissions' => [
				'type' => Registry::get( 'collection', 'type/submission' ),
				'args' => [
					'pagination' => [
						'type' => Registry::get( 'pagination', 'input' ),
						'defaultValue' => [
							'first' => 10,
						],
					],
					'filter' => [
						'type' => Registry::get( 'filter', 'input/submission' ),
						'defaultValue' => [],
					],
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->collection( $args['pagination'], $args['filter'] );
				},
			],
			// meta
			'submissionMeta' => [
				'type' => Registry::get( 'submissionMeta', 'type' ),
				'args' => [
					'resourceView' => [
						'type' => Registry::get( 'resourceViewMode', 'enum' ),
						'defaultValue' => 'all',
					],
					'asAdmin' => [
						'type' => Type::boolean(),
						'defaultValue' => true,
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
			// create submission
			'createSubmission' => [
				'type' => Registry::get( 'submission', 'type' ),
				'args' => [
					'data' => Type::nonNull( Registry::get( 'submission', 'input' ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->create( $args['data'] );
				},
			],
			// update submission
			'updateSubmission' => [
				'type' => Registry::get( 'submission', 'type' ),
				'args' => [
					// query by ID or token.
					// id takes into account the auth level of user
					// whereas with token, anyone can query if it matches
					'id' => Type::id(),
					'token' => Type::id(),
					'data' => Type::nonNull( Registry::get( 'submission', 'input' ) ),
					'remarks' => Type::string(),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					[ $id, $token ] = self::get_possible_id_and_token( $args );
					return $controller->update(
						$id,
						$args,
						$token
					);
				},
			],
			// trash submission only for admins
			'trashSubmission' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->trash( $args['id'] );
				},
			],
			'untrashSubmission' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'id' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->untrash( $args['id'] );
				},
			],
			'deleteSubmission' => [
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
			'trashSubmissions' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'ids' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->trash_collection( $args['ids'] );
				},
			],
			'untrashSubmissions' => [
				'type' => Type::nonNull( Type::boolean() ),
				'args' => [
					'ids' => Type::nonNull( Type::listOf( Type::nonNull( Type::id() ) ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->untrash_collection( $args['ids'] );
				},
			],
			'deleteSubmissions' => [
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
