<?php
/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of WPEForm - WordPress Form Builder.
 *
 * WPEForm - WordPress Form Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * WPEForm - WordPress Form Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPEForm - WordPress Form Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package EForm
 * @subpackage GraphQL\Resolver
 */

namespace WPEForm\GraphQL\Resolver;

use WPEForm\GraphQL\Registry;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A resolver class for dashboard related stats.
 *
 * @package WPEForm\GraphQL\Resolver
 */
class Dashboard implements IResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'cumulativeFormsStat' => [
				'type' => Type::nonNull(
					Registry::get( 'cumulativeFormsStat', 'type' )
				),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					return \WPEForm\Controller\Dashboard::get_cumulative_stats();
				},
			],
			'performingFormsStat' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'performingFormStat', 'type' ) )
					)
				),
				'args' => [
					'formCount' => Type::nonNull( Type::int() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					return \WPEForm\Controller\Dashboard::get_performing_forms_stats(
						$args['formCount']
					);
				},
			],
			'submissionStat' => [
				'type' => Type::nonNull(
					Registry::get( 'submissionStat', 'type' )
				),
				'args' => [
					'since' => Type::nonNull( Type::int() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					return \WPEForm\Controller\Dashboard::get_submission_stat(
						$args['since']
					);
				},
			],
			'submissionsIntervalStat' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'submissionIntervalStat', 'type' ) )
					)
				),
				'args' => [
					'type' => Type::nonNull( Registry::get( 'submissionStatInterval', 'enum' ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					return \WPEForm\Controller\Dashboard::get_submissions_interval_stat(
						$args['type']
					);
				},
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function get_mutation_fields() {
		return [];
	}
}
