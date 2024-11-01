<?php
/**
 * Copyright (C) 2018-Current Swashata Ghosh <swashata@wpquark.com>
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
use WPEForm\GraphQL\Resolver\User;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\GraphQL\Resolver\Form as FormResolver;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for SubmissionType
 */
class Submission extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'SubmissionType',
			'fields' => [
				'id' => Type::nonNull( Type::id() ),
				'form' => [
					'type' => Type::nonNull( Registry::get( 'form', 'type' ) ),
					'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
						$controller = FormResolver::get_controller();
						return $controller->read( $root['formId'] );
					},
				],
				'fName' => Type::string(), // Null because could be
				'lName' => Type::string(), // Null because could be
				'email' => Type::string(), // Null because could be
				'phone' => Type::string(), // Null because could be
				'elements' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'element', 'type/submission' ) )
					)
				),
				'ip' => Type::string(), // Null because it is sensitive
				'score' => Type::float(), // Null because could be null (score not needed)
				'maxScore' => Type::float(), // Null because could be null (score not needed)
				'scoreData' => Type::listOf( // Null because could be (score not needed)
					Type::nonNull( Registry::get( 'score', 'type/submission/element' ) )
				),
				'urlTrack' => Type::string(), // Null because it is sensitive and could not be there
				'created' => Type::nonNull( Type::string() ),
				'lastUpdated' => Type::string(), // Null because could be null
				'adminRemarks' => Type::nonNull( Type::string() ),
				'user' => [
					'type' => Registry::get( 'user', 'type' ),
					'resolve' => function( $root, $args ) {
						if ( $root['userId'] === null ) {
							return null;
						}
						return User::get_user_by_id( $root['userId'] );
					},
				], // Null because could be guest
				'canUserEdit' => Type::nonNull( Type::boolean() ),
				'referer' => Type::string(), // Null because sensitive and could be null
				'paid' => Type::boolean(), // Null because could be null if not needed
				'time' => Type::int(), // Null because could be not recorded
				'token' => Type::nonNull( Type::string() ),
				'submissionLink' => Type::string(), // Null because could not be there, this is the link to the submission
				'downloadLink' => Type::string(), // Null because could not be there, this is the link to the submission
				'printLink' => Type::string(), // Null because could not be there, this is the link to the submission
				'paymentData' => Type::string(), // Null because handled by payment classes
			],
		];
		parent::__construct( $config );
	}
}
