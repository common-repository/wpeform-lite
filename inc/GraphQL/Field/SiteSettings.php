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
 * @subpackage GraphQL\Field
 */

namespace WPEForm\GraphQL\Field;

use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GraphQL\Util\TypeOrInputFromFields;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * SiteSettings class for handling with FieldVars.
 *
 * @package WPEForm\Field
 */
class SiteSettings extends Base {
	/**
	 * Static variable to hold single instance of Element Type.
	 *
	 * @var array
	 */
	protected static $type_fields = null;

	/**
	 * Static variable to hold single instance of Element InputType.
	 *
	 * @var array
	 */
	protected static $input_fields = null;

	/**
	 * {@inheritDoc}
	 *
	 * @return array Array of Scalar Types.
	 */
	public static function common_fields() {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array Array of Scalar Types.
	 */
	public static function type_fields() {
		$site_settings = self::get_site_settings_field_vars();
		$fields = [];
		foreach ( $site_settings as $key => $config_vars ) {
			if ( ! empty( $config_vars ) ) {
				$fields[ $key ] = TypeOrInputFromFields::create_type(
					$config_vars,
					'SiteSettings' . ucfirst( $key ) . 'Config'
				);
			}
		}
		return $fields;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array Array of Scalar Types.
	 */
	public static function input_fields() {
		$site_settings = self::get_site_settings_field_vars();
		$fields = [];
		foreach ( $site_settings as $key => $config_vars ) {
			if ( ! empty( $config_vars ) ) {
				$fields[ $key ] = TypeOrInputFromFields::create_input(
					$config_vars,
					'SiteSettings' . ucfirst( $key ) . 'Config'
				);
			}
		}
		return $fields;
	}

	/**
	 * Get site settings field vars for generating GraphQL Type and Input.
	 *
	 * @return array
	 */
	public static function get_site_settings_field_vars() : array {
		return [
			// APPEARANCE RELATED CONFIG
			'appearance' => [
				'defaultTheme' => FieldVar::var( 'teal', Type::string() ),
				'defaultControlType' => FieldVar::var(
					'boxy', // material | boxy
					Registry::get( 'settingsAppearanceControlType', 'enum' )
				),
				'darkMode' => FieldVar::var( 'off', Registry::get( 'darkThemeMode', 'enum' ) ),
				'renderInShadow' => FieldVar::var( true, Type::boolean() ),
				'customCss' => FieldVar::var( '', Type::string() ),
				'customStyleLinks' => FieldVar::var( [], Type::listOf( Type::nonNull( Type::string() ) ) ),
			],
			// SYSTEM RELATED CONFIG
			'system' => [
				'summaryPage' => FieldVar::var( '0', Type::id() ),
				'portalPage' => FieldVar::var( '0', Type::id() ),
				'sandboxAdminPage' => FieldVar::var( true, Type::boolean() ),
				'preferStandaloneAdmin' => FieldVar::var( false, Type::boolean() ),
				'removeDataWhenUninstalling' => FieldVar::var( false, Type::boolean() ),
				'allowedHeadlessOrigins' => FieldVar::var( \site_url( '' ), Type::string() ),
			],
			// SENTRY DEBUGGINS
			'sentry' => [
				'enabled' => FieldVar::var( false, Type::boolean() ),
				'dsn' => FieldVar::var( '', Type::string() ),
				'showFeedbackUI' => FieldVar::var( true, Type::boolean() ),
				'integrateFrontendApp' => FieldVar::var( true, Type::boolean() ),
				'integrateAdminApp' => FieldVar::var( true, Type::boolean() ),
				'integrateGraphQLAPI' => FieldVar::var( true, Type::boolean() ),
			],
			// STANDALONE PAGE MODIFICATION
			'standalonePages' => [
				'beforeBodyHTML' => FieldVar::var( '', Type::string() ),
				'afterBodyHTML' => FieldVar::var( '', Type::string() ),
				'headHTML' => FieldVar::var( '', Type::string() ),
			],
			// USERPORTAL PAGE MODIFICATION
			'userPortal' => [
				'pageTitle' => FieldVar::var(
					\__( 'View all your submissions', 'wp-eform' ),
					Type::string()
				),
				'welcomeLabel' => FieldVar::var(
					\__( 'Welcome %%USERNAME%%', 'wp-eform' ),
					Type::string()
				),
				'welcomeMetaSingular' => FieldVar::var(
					\__( 'You have %%SUBMISSIONS%% submission, with an average score of %%SCOREAVG%%%.', 'wp-eform' ),
					Type::string()
				),
				'welcomeMetaPlural' => FieldVar::var(
					\__( 'You have %%SUBMISSIONS%% submissions, with an average score of %%SCOREAVG%%%.', 'wp-eform' ),
					Type::string()
				),
				'welcomeNoSubmissions' => FieldVar::var(
					\__( 'You do not have any submissions yet.', 'wp-eform' ),
					Type::string()
				),
			],
			// SUMMARY PAGE MODIFICATION
			'summary' => [
				'pageTitle' => FieldVar::var(
					\__( 'View your submission', 'wp-eform' ),
					Type::string()
				),
				'formLabel' => FieldVar::var(
					\__( 'Enter submission id', 'wp-eform' ),
					Type::string()
				),
			],
		];
	}

	/**
	 * Get default site settings value.
	 *
	 * @param string $type One of 'type', 'input', 'default' or 'defaultWithEnumName'. Default is 'default'.
	 *
	 * @return array Default site settings.
	 */
	public static function get_default_site_settings( $type = 'default' ) : array {
		$field_vars = self::get_site_settings_field_vars();
		$settings = [];
		foreach ( $field_vars as $key => $vars ) {
			$settings[ $key ] = FieldVar::extract( $vars, $type );
		}
		return $settings;
	}
}
