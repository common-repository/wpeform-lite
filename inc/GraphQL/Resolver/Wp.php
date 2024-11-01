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

use WPEForm\Exception\InsufficientPermissionException;
use WPEForm\GraphQL\Registry;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WP_Post;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A resolver class for all WordPress resources.
 *
 * Only admins can usually view these.
 *
 * @package WPEForm\GraphQL\Resolver
 */
class Wp implements IResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'pages' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'page', 'type' ) )
					)
				),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					// bail if current user cannot perform this
					if ( ! \current_user_can( \WPEForm\Auth\SiteSettings::MANAGE ) ) {
						throw new InsufficientPermissionException( 'Current user cannot view the resource.' );
					}
					$pages = \get_pages(
						[
							'depth' => 0,
							'child_of' => 0,
						]
					);
					$resolved_pages = [];
					foreach ( $pages as $page ) {
						/** @var WP_Post $page */
						$resolved_pages[] = [
							'id' => $page->ID,
							'title' => $page->post_title,
						];
					}
					return $resolved_pages;
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
