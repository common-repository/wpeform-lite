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
 * @package WPEForm
 * @subpackage GraphQL\Resolver
 */

namespace WPEForm\GraphQL\Resolver;

use WPEForm\Exception\AuthException;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\System\SystemEndpoint;

use function WPEForm\Helpers\is_wpeform_app_mode;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to provide resolver for all HeadlessGlobals related queries.
 *
 * @package WPEForm\GraphQL\Resolver
 */
class HeadlessGlobals implements IResolver {
	/**
	 * Get all query fields for root query.
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'headlessGlobals' => [
				'type' => Type::nonNull(
					Registry::get( 'headlessGlobals', 'type' )
				),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					if ( ! is_wpeform_app_mode() ) {
						throw new AuthException( 'Insufficient permission' );
					}
					$data = SystemEndpoint::get_wpeformgraphqlapp_data( true );
					return $data;
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
		return [];
	}
}
