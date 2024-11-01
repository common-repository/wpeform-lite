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

use WPEForm\Model\SiteSettings as SiteSettingsModel;
use WPEForm\Controller\SiteSettings as SiteSettingsController;
use WPEForm\Auth\SiteSettings as SiteSettingsAuth;
use WPEForm\GraphQL\Registry;
use Exception;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class for all resolvers for siteSettings related queries and mutations.
 *
 * @package WPEForm\GraphQL\Resolver
 */
class SiteSettings implements IResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @return SiteSettingsController
	 */
	public static function get_controller() {
		return new SiteSettingsController(
			new SiteSettingsModel(),
			new SiteSettingsAuth()
		);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'siteSettings' => [
				'type' => Registry::get( 'siteSettings', 'type' ),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->read( '' );
				},
			],
			'testSentrySettings' => [
				'type' => Type::boolean(),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					// read data to trigger permission
					$controller->read( '' );
					throw new Exception( 'Testing sentry settings in GraphQL' );
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
		return [
			'updateSiteSettings' => [
				'type' => Registry::get( 'siteSettings', 'type' ),
				'args' => [
					'data' => Type::nonNull( Registry::get( 'siteSettings', 'input' ) ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$controller = self::get_controller();
					return $controller->update( '', $args['data'] );
				},
			],
		];
	}
}
