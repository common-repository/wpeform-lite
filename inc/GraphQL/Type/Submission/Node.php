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
 * @subpackage GraphQL\Type\Submission
 */

namespace WPEForm\GraphQL\Type\Submission;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Resolver\User;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class for SubmissionNodeType
 */
class Node extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'SubmissionNodeType',
			'fields' => [
				'id' => Type::nonNull( Type::id() ),
				'formId' => Type::nonNull( Type::id() ),
				'formName' => Type::nonNull( Type::string() ),
				'fName' => Type::string(),
				'lName' => Type::string(),
				'email' => Type::string(),
				'phone' => Type::string(),
				'elements' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'element', 'type/submission' ) )
					)
				),
				'ip' => Type::string(),
				'score' => Type::float(),
				'maxScore' => Type::float(),
				'percentageScore' => Type::float(),
				'scoreData' => Type::listOf( // Null because could be (score not needed)
					Type::nonNull( Registry::get( 'score', 'type/submission/element' ) )
				),
				'urlTrack' => Type::string(),
				'created' => Type::nonNull( Type::string() ),
				'lastUpdated' => Type::string(),
				'adminRemarks' => Type::string(),
				'user' => [
					'type' => Registry::get( 'user', 'type' ),
					'resolve' => function( $root, $args ) {
						if ( ! isset( $root['userId'] ) ) {
							return null;
						}
						return User::get_user_by_id( $root['userId'] );
					},
				],
				'referer' => Type::string(),
				'paid' => Type::boolean(),
				'time' => Type::int(),
				'token' => Type::nonNull( Type::string() ),
				'submissionLink' => Type::string(), // Null because could not be there, this is the link to the submission
				'downloadLink' => Type::string(), // Null because could not be there, this is the link to the submission
				'printLink' => Type::string(), // Null because could not be there, this is the link to the submission
				'paymentData' => Type::string(), // Null because handled by payment classes
				'canUserEdit' => Type::nonNull( Type::boolean() ),
			],
		];
		parent::__construct( $config );
	}
}