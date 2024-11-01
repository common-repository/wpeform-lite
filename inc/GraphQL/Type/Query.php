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
 * @subpackage GraphQL\Type
 */

namespace WPEForm\GraphQL\Type;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GraphQL\Resolver\Category;
use WPEForm\GraphQL\Resolver\Form;
use WPEForm\GraphQL\Resolver\User;
use WPEForm\Factory\Form\Config\Integrations;
use WPEForm\Factory\Form\Config\Payments;
use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Factory\Form\Config\Settings;
use WPEForm\Factory\Form\Config\Styles;
use WPEForm\GraphQL\Resolver\Dashboard;
use WPEForm\GraphQL\Resolver\DataSet;
use WPEForm\GraphQL\Resolver\FormTemplate;
use WPEForm\GraphQL\Resolver\HeadlessGlobals;
use WPEForm\GraphQL\Resolver\Submission;
use WPEForm\GraphQL\Resolver\SiteSettings;
use WPEForm\GraphQL\Resolver\Wp;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Primary Query class for GraphQL server.
 */
class Query extends ObjectType {

	/**
	 * Create an instance of Query.
	 */
	public function __construct() {
		$config = [
			'name' => 'Query',
			'fields' => \array_merge(
				// categories
				Category::get_query_fields(),
				// form
				Form::get_query_fields(),
				// integrations
				Integrations::get_registered_configs_graphql_query_fields(),
				// payments
				Payments::get_registered_configs_graphql_query_fields(),
				// Permissions
				Permissions::get_registered_configs_graphql_query_fields(),
				// Settings
				Settings::get_registered_configs_graphql_query_fields(),
				// Styles
				Styles::get_registered_configs_graphql_query_fields(),
				// submissions
				Submission::get_query_fields(),
				// user
				User::get_query_fields(),
				// site settings
				SiteSettings::get_query_fields(),
				// wp resources
				Wp::get_query_fields(),
				// Dashboard
				Dashboard::get_query_fields(),
				// Form templates
				FormTemplate::get_query_fields(),
				// DataSet
				DataSet::get_query_fields(),
				// Headless
				HeadlessGlobals::get_query_fields()
			),
		];
		parent::__construct( $config );
	}
}
