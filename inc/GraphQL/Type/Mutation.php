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

use WPEForm\GraphQL\Resolver\Form;
use WPEForm\GraphQL\Resolver\Category;
use WPEForm\Factory\Form\Config\Integrations;
use WPEForm\Factory\Form\Config\Payments;
use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Factory\Form\Config\Settings;
use WPEForm\Factory\Form\Config\Styles;
use WPEForm\GraphQL\Resolver\FormTemplate;
use WPEForm\GraphQL\Resolver\Submission;
use WPEForm\GraphQL\Resolver\SiteSettings;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Mutation type for our GraphQL Server.
 */
class Mutation extends ObjectType {
	/**
	 * Create a mutation instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'Mutation',
			'fields' => \array_merge(
				// forms
				Form::get_mutation_fields(),
				// category
				Category::get_mutation_fields(),
				// integrations
				Integrations::get_registered_configs_graphql_mutation_fields(),
				// payments
				Payments::get_registered_configs_graphql_mutation_fields(),
				// Permissions
				Permissions::get_registered_configs_graphql_mutation_fields(),
				// Settings
				Settings::get_registered_configs_graphql_mutation_fields(),
				// Styles
				Styles::get_registered_configs_graphql_mutation_fields(),
				// submissions
				Submission::get_mutation_fields(),
				// site settings
				SiteSettings::get_mutation_fields(),
				// Form Templates
				FormTemplate::get_mutation_fields()
			),
		];

		parent::__construct( $config );
	}
}
