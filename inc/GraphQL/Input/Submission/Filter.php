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
 * @subpackage GraphQL\Input\Submission
 */

namespace WPEForm\GraphQL\Input\Submission;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for SubmissionFilterInputType
 */
class Filter extends InputObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'SubmissionFilterInput',
			'fields' => [
				'search' => Type::string(),
				// Form category
				'category' => Type::id(),
				// whether requesting collection as Form Administrator
				'asAdmin' => [
					'type' => Type::nonNull( Type::boolean() ),
					'defaultValue' => false,
				],
				// Form owner, works only if asAdmin set to true
				'formOwner' => Type::id(),
				// Submission owner, for filtering submissions by WP user
				'submissionOwner' => Type::id(),
				// Form Id, for filtering submissions by a particular form
				'formId' => Type::id(),
				'startDate' => [
					'type' => Type::string(),
					'description' => \__( 'Submissions before (inclusive)', 'wp-eform' ),
					'defaultValue' => null,
				],
				'endDate' => [
					'type' => Type::string(),
					'description' => \__( 'Submissions before (inclusive)', 'wp-eform' ),
					'defaultValue' => null,
				],
				// resouce view mode, whether all, owned, shared or trashed
				// when viewing shared, one can only view forms which are shared
				// with the user. This should be another template in the front-end app
				// works only if asAdmin is set to true.
				'resourceView' => [
					'type' => Registry::get( 'resourceViewMode', 'enum' ),
					'defaultValue' => 'all',
				],
			],
		];
		parent::__construct( $config );
	}
}
