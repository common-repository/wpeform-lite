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
 * @subpackage System
 */

namespace WPEForm\System;

use LogicException;
use WPEForm\Factory\Form\Config\Integrations;
use WPEForm\Form\Config\Integrations\MailChimp;
use WPEForm\Factory\Form\Config\Payments;
use WPEForm\Form\Config\Payments\General;
use WPEForm\Form\Config\Payments\Offline;
use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Form\Config\Permissions\AccessPermission;
use WPEForm\Form\Config\Permissions\SubmissionPermission;
use WPEForm\Form\Config\Settings\UserNotification;
use WPEForm\Form\Config\Settings\AdminNotification;
use WPEForm\Form\Config\Settings\UserData;
use WPEForm\Form\Config\Settings\Score;
use WPEForm\Form\Config\Settings\Timer;
use WPEForm\Factory\Form\Config\Settings;
use WPEForm\Form\Config\Styles\Appearance;
use WPEForm\Form\Config\Styles\CustomBackground;
use WPEForm\Form\Config\Styles\Theme;
use WPEForm\Form\Config\Styles\Typography;
use WPEForm\Form\Config\Styles\Pagination;
use WPEForm\Form\Config\Styles\FormBehavior;
use WPEForm\Form\Config\Styles\Redirection;
use WPEForm\Form\Config\Styles\Tracking;
use WPEForm\Factory\Form\Config\Styles;
use WPEForm\Factory\Form\Elements;
use WPEForm\Form\Element\Buttons;
use WPEForm\Form\Element\Captcha;
use WPEForm\Form\Element\Checkbox;
use WPEForm\Form\Element\Radio;
use WPEForm\Form\Element\Group;
use WPEForm\Form\Element\Row;
use WPEForm\Form\Element\Column;
use WPEForm\Form\Element\Dropdown;
use WPEForm\Form\Element\Heading;
use WPEForm\Form\Element\Text;
use WPEForm\Form\Element\Textarea;
use WPEForm\Form\Element\Toggle;
use WPEForm\Editor\Block;
use WPEForm\Editor\Shortcode;
use WPEForm\Form\Element\Address;
use WPEForm\Form\Element\DateTimeInput;
use WPEForm\Form\Element\Range;
use WPEForm\Form\Element\Slider;
use WPEForm\Form\Element\MathCalc;
use WPEForm\Form\Element\MathCalcGroup;
use WPEForm\Form\Element\MatrixChoice;
use WPEForm\Form\Element\MatrixInput;
use WPEForm\Form\Element\RangeGroup;
use WPEForm\Form\Element\Rating;
use WPEForm\Form\Element\RatingGroup;
use WPEForm\Form\Element\SingleCheckbox;
use WPEForm\Form\Element\SliderGroup;
use WPEForm\Form\Element\Sortable;
use WPEForm\Form\Element\StackedGroup;
use WPEForm\GraphQL\Field\SiteSettings;
use WPEForm\View\Admin\WPDashboard;

use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Init class handling all init work.
 */
class Init {
	/**
	 * Freemius plan for free.
	 */
	const PLAN_FREE = 'free';
	/**
	 * Freemius plan for starter.
	 */
	const PLAN_STARTER = 'starter';
	/**
	 * Freemius plan for pro.
	 */
	const PLAN_PRO = 'professional';
	/**
	 * Freemius plan for business.
	 */
	const PLAN_BUSINESS = 'business';

	/**
	 * Holds the table references that EForm uses.
	 *
	 * @var array
	 */
	public static $database = [
		'form' => '',
		'formmeta' => '',
		'submission' => '',
		'file' => '',
		'category' => '',
		'payment' => '',
	];

	/**
	 * EForm settings variable for doing other types of things.
	 * It gets populated from options during init.
	 *
	 * @var array
	 */
	public static $settings = [];

	/**
	 * Enqueue handler from \WPEForm\GeneralDeps\WPackio\Enqueue
	 *
	 * @var \WPEForm\GeneralDeps\WPackio\Enqueue
	 */
	protected static $enqueue = null;

	/**
	 * Installer dependency.
	 *
	 * @var \WPEForm\System\Install
	 */
	private $installer;

	/**
	 * Endpoint dependency.
	 *
	 * @var \WPEForm\System\Endpoints
	 */
	private $endpoints;

	/**
	 * Admin View instances.
	 *
	 * Each of them is an instance of \WPEForm\View\Admin\Base
	 * and responsible for adding something to the menu.
	 *
	 * @var array
	 */
	public $admin_instances = [];

	/**
	 * Populate the database variable with global $wpdb
	 * and eform prefixes.
	 *
	 * @return void
	 */
	public function populate_database_variable() {
		global $wpdb;
		$prefix = $wpdb->prefix . 'wpq_eform_';
		self::$database = [
			'form' => $prefix . 'form',
			'formmeta' => $prefix . 'formmeta',
			'submission' => $prefix . 'submission',
			'file' => $prefix . 'file',
			'category' => $prefix . 'category',
			'payment' => $prefix . 'payment',
		];
	}

	/**
	 * Populate the $settings variable from the database.
	 *
	 * @return void
	 */
	public function populate_settings_variable() {
		$settings = \get_option( Install::SETTINGS_OPTION_NAME, [] );
		$default = SiteSettings::get_default_site_settings();
		$parsed = parse_args( $settings, $default );
		$parsed['summaryGeneralSSR'] = $settings['summaryGeneralSSR'] ?? '';
		$parsed['userPortalSkeleton']  = $settings['userPortalSkeleton'] ?? '';
		self::$settings = $parsed;
	}

	/**
	 * Installation callback when the plugin is activated
	 *
	 * @return void
	 */
	public function install() {
		$this->installer->upgrade( self::$database );
		$this->populate_settings_variable();
	}

	/**
	 * Get plugin version as stored in database.
	 *
	 * @return string
	 */
	public static function get_db_plugin_version() {
		$db_version = \get_option( Install::VERSION_OPTION_NAME, '' );
		return $db_version;
	}

	/**
	 * Check if updating EForm is required. Happens when the script
	 * version does not match database version and during first install.
	 *
	 * @return void
	 */
	public function check_for_update() {
		$db_version = self::get_db_plugin_version();
		if ( WP_EFORM_VERSION !== $db_version ) {
			$this->install();
		}
	}

	/**
	 * Filter available admin classes and instantiate every one of them.
	 * The classses themselves should be responsible for hooking.
	 *
	 * @return void
	 */
	public function init_admin_menus() {
		$admin_classes = apply_filters(
			'wpeform_admin_classes', [
				'\\WPEForm\\View\\Admin\\App',
				// '\\WPEForm\\View\\Admin\\AllForms',
			]
		);
		foreach ( $admin_classes as $class ) {
			$this->admin_instances[] = new $class();
		}
	}

	/**
	 * Enqueue globally needed admin styles.
	 *
	 * @return void
	 */
	public function global_admin_styles() {
		// Enqueue EForm font-styles
		\wp_enqueue_style(
			'wp-eform-branding-font',
			plugins_url( '/static/wp-eform-font/style.css', WP_EFORM_PLUGIN ),
			[],
			\WP_EFORM_VERSION
		);
		$enqueue = self::enqueue();
		// Enqueue common/tinymcePlugin to extend tinymce and add shortcodes
		$assets = $enqueue->enqueue(
			'common',
			'tinymcePlugin',
			[
				'js' => true,
				'css' => true,
				'js_dep' => [],
				'css_dep' => [],
				'in_footer' => false,
				'media' => 'all',
			]
		);
		$handle = $enqueue->getPrimaryJsHandle( $assets );
		\wp_localize_script(
			$handle,
			'wpEFormTinyMCEL10n',
			[
				'text' => \__( 'WP EForm Shortcodes', 'wp-eform' ),
				'mcePlugin' => Shortcode::TMCECLASS,
				'mceButton' => Shortcode::TMCECLASS,
				'generatorUrl' => SystemEndpoint::get_shortcode_generator_link(),
			]
		);
	}

	/**
	 * Register admin menus by hooking into plugins_loaded.
	 *
	 * Also enqueues global admin styles and scripts
	 *
	 * @return void
	 */
	public function register_admin() {
		if ( \is_admin() ) {
			\add_action( 'plugins_loaded', [ $this, 'init_admin_menus' ] );
			\add_action( 'admin_enqueue_scripts', [ $this, 'global_admin_styles' ] );
		}
	}

	/**
	 * Register EForm extensions by firing a custom hook.
	 *
	 * All third-party plugins should hook their loading to this
	 * action. This is fired when all plugins are loaded so there
	 * isn't any race condition.
	 *
	 * @return void
	 */
	public function register_eform_extensions() {
		\do_action( 'extend_wpeform' );
	}

	/**
	 * Fires on wp_enqueue_scripts hook to enqueue frontend
	 * critical assets dependencies.
	 *
	 * @return void
	 */
	public function register_frontend_assets() {
		// wp_enqueue_* stuff here, not needed right now.
	}

	/**
	 * Fire built-in extensible components. It mostly registers Form configs,
	 * add elements etc to the system through various factories.
	 *
	 * @return void
	 */
	public function fire_built_ins() {
		// == Elements == //
		// design Elements
		Elements::register_element( 'group', new Group() );
		Elements::register_element( 'row', new Row() );
		Elements::register_element( 'column', new Column() );
		Elements::register_element( 'heading', new Heading() );
		Elements::register_element( 'buttons', new Buttons() );
		Elements::register_element( 'mathcalcgroup', new MathCalcGroup() );
		Elements::register_element( 'ratinggroup', new RatingGroup() );
		Elements::register_element( 'slidergroup', new SliderGroup() );
		Elements::register_element( 'rangegroup', new RangeGroup() );
		Elements::register_element( 'stackedgroup', new StackedGroup() );
		// choice Elements
		Elements::register_element( 'radio', new Radio() );
		Elements::register_element( 'checkbox', new Checkbox() );
		Elements::register_element( 'dropdown', new Dropdown() );
		Elements::register_element( 'singlecheckbox', new SingleCheckbox() );
		Elements::register_element( 'toggle', new Toggle() );
		Elements::register_element( 'slider', new Slider() );
		Elements::register_element( 'range', new Range() );
		Elements::register_element( 'rating', new Rating() );
		Elements::register_element( 'matrixchoice', new MatrixChoice() );
		Elements::register_element( 'sortable', new Sortable() );
		// input Elements
		Elements::register_element( 'text', new Text() );
		Elements::register_element( 'textarea', new Textarea() );
		Elements::register_element( 'address', new Address() );
		Elements::register_element( 'mathcalc', new MathCalc() );
		Elements::register_element( 'datetimeinput', new DateTimeInput() );
		Elements::register_element( 'matrixinput', new MatrixInput() );
		// security elements
		Elements::register_element( 'captcha', new Captcha() );
		/* TODO: Add password element */

		// == Configs == //
		// Add integrations
		Integrations::register_config( 'mailchimp', new MailChimp() );
		// Add payments
		Payments::register_config( 'general', new General() );
		Payments::register_config( 'offline', new Offline() );
		// Add permissions
		Permissions::register_config( 'accessPermission', new AccessPermission() );
		Permissions::register_config( 'submissionPermission', new SubmissionPermission() );
		// Add settings
		Settings::register_config( 'userNotification', new UserNotification() );
		Settings::register_config( 'adminNotification', new AdminNotification() );
		Settings::register_config( 'userData', new UserData() );
		Settings::register_config( 'score', new Score() );
		Settings::register_config( 'timer', new Timer() );
		// Add Styles
		Styles::register_config( 'appearance', new Appearance() );
		Styles::register_config( 'pagination', new Pagination() );
		Styles::register_config( 'customBackground', new CustomBackground() );
		Styles::register_config( 'theme', new Theme() );
		Styles::register_config( 'typography', new Typography() );
		Styles::register_config( 'formBehavior', new FormBehavior() );
		Styles::register_config( 'redirection', new Redirection() );
		Styles::register_config( 'tracking', new Tracking() );
	}

	/**
	 * Register custom endpoints for WP EForm.
	 *
	 * @return void
	 */
	public function register_endpoints() {
		$this->endpoints->create_endpoint_registry();
		$this->endpoints->register_endpoints();
		// flush rewrite rules if necessary
		$this->installer->flush_rewrite_rules();
	}

	/**
	 * Init, scoped to Admin.
	 *
	 * @return void
	 */
	public function admin_init() {
		$dashboard_widgets = new WPDashboard();
		$dashboard_widgets->init();
	}

	/**
	 * Fire all `init` hooks needed by the plugin.
	 *
	 * @return void
	 */
	public function fire_init_hooks() {
		// fire up the endpoint registration
		$this->endpoints->register_rewrite();
		// Load custom mo files for translations
		\load_plugin_textdomain(
			'wp-eform',
			false,
			\dirname(
				\plugin_basename(
					\WP_EFORM_PLUGIN
				)
			) . '/languages'
		);
	}

	/**
	 * Modify some freemius stuff.
	 *
	 * @return void
	 */
	protected function modify_freemius() {
		$fs = \wpeform_fs();
		// immediately show trial if in debug mode
		$testing = false;
		if (
			$testing
			&& \defined( 'WP_DEBUG' ) && \WP_DEBUG === true
			&& \defined( 'WP_FS__DEV_MODE' ) && \WP_FS__DEV_MODE === true
		) {
			$fs->add_filter(
				'show_first_trial_after_n_sec',
				function() {
					return 10;
				}
			);
			$fs->add_filter(
				'reshow_trial_after_every_n_sec',
				function() {
					return 10;
				}
			);
		}

		// override pricing js path
		$fs->add_filter(
			'freemius_pricing_js_path',
			function( $default_path ) {
				return \plugin_dir_path( \WP_EFORM_PLUGIN )
					. 'static/freemius-pricing/freemius-pricing.js';
			}
		);

		// override plugin_icon path
		$fs->add_filter(
			'plugin_icon',
			function() {
				return \WP_EFORM_ABSPATH . 'static/images/wpeform-logo-color.png';
			}
		);

		// uninstall hook
		\wpeform_fs()->add_action(
			'after_uninstall',
			[ $this, 'uninstall' ]
		);
	}

	/**
	 * Call the uninstaller.
	 *
	 * @return void
	 */
	public function uninstall() {
		$this->installer->uninstall();
	}

	/**
	 * Modify plugin action links for wpeform plugin.
	 *
	 * @param array  $links Existing links.
	 * @param string $file Basename of the plugin.
	 * @return array Modified links.
	 */
	public function modify_plugin_action_links( $links, $file ) {
		$url = \admin_url( 'admin.php?page=wpeform' );
		\array_unshift(
			$links,
			'<a href="' . \esc_attr( $url ) . '">' . \__( 'Get started', 'wp-eform' ) . '</a>'
		);
		return $links;
	}

	/**
	 * Load own textdomain for plugin usage. Since we ship both free and pro
	 * with same translation string, we need to load our own translation files.
	 *
	 * @param mixed $mofile Mo file.
	 * @param mixed $domain Translation domain.
	 * @return mixed
	 */
	public function load_own_textdomain( $mofile, $domain ) {
		if (
			'wp-eform' === $domain
			&& false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' )
		) {
			$locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
			$mofile = WP_PLUGIN_DIR . '/' . dirname( \WP_EFORM_PLUGIN ) . '/languages/' . $domain . '-' . $locale . '.mo';
		}
		return $mofile;
	}

	/**
	 * Initialize new EForm system. Register the plugin, add hooks
	 * and do all other kinds of funny work that EForm needs to get
	 * into WordPress.
	 *
	 * @return void
	 */
	public function boot() {
		// populate database variables
		$this->populate_database_variable();

		\add_filter(
			'load_textdomain_mofile',
			[ $this, 'load_own_textdomain' ],
			10,
			2
		);

		// Register inits
		\add_action( 'init', [ $this, 'fire_init_hooks' ] );

		\add_action( 'admin_init', [ $this, 'admin_init' ] );

		// Register activation hook
		\register_activation_hook( WP_EFORM_PLUGIN, [ $this, 'install' ] );

		// hook built-in functionality
		\add_action( 'plugins_loaded', [ $this, 'fire_built_ins' ] );

		// open up third party extensibility
		\add_action( 'plugins_loaded', [ $this, 'register_eform_extensions' ], 10 );

		// populate settings variable
		$this->populate_settings_variable();

		// register graphql endpoint, at a later stage when all plugins are loaded
		// this is to make sure that plugins can hook into the GraphQL API exposed
		// by eform
		\add_action( 'plugins_loaded', [ $this, 'register_endpoints' ], 99 );

		// Initialize admin menus and scripts
		$this->register_admin();

		// Load frontend assets dependencies
		\add_action( 'wp_enqueue_scripts', [ $this, 'register_frontend_assets' ] );

		// Add gutenberg blocks
		\add_action( 'init', [ Block::class, 'register_blocks' ] );

		// Add shortcodes
		\add_action( 'init', [ Shortcode::class, 'register' ] );

		// Modify plugin action links
		\add_filter(
			'plugin_action_links_' . \plugin_basename( \WP_EFORM_PLUGIN ),
			[ $this, 'modify_plugin_action_links' ],
			1000,
			2
		);

		// Add filter to support for application passwords
		\add_filter(
			'application_password_is_api_request',
			[ $this, 'is_graphql_api_request' ]
		);

		$this->modify_freemius();

		// Now check if update or install is needed and do likewise
		$this->check_for_update();
	}

	/**
	 * Determines whether the request is an API request to play nice with
	 * application passwords and potential other WordPress core functionality
	 * for APIs
	 *
	 * @param bool $is_api_request Whether the request is an API request.
	 *
	 * @return bool
	 */
	public function is_graphql_api_request( $is_api_request ) {
		$is_wpeform_graphql_api = \WPEForm\GraphQL\Endpoint::is_graphql_http_request();
		return $is_wpeform_graphql_api
			? true
			: $is_api_request;
	}

	/**
	 * Create the enqueue instance from WPackio/Enqueue
	 *
	 * It makes sure that the instance is created only once.
	 */
	protected static function create_enqueue() {
		// create the enqueue once
		if ( null === self::$enqueue ) {
			self::$enqueue = new \WPEForm\GeneralDeps\WPackio\Enqueue(
				'wpqEform',
				'dist',
				WP_EFORM_VERSION,
				'plugin',
				WP_EFORM_PLUGIN
			);
		}
	}

	/**
	 * Get the Enqueue API from \WPEForm\GeneralDeps\WPackio\Enqueue instantiated for this project.
	 *
	 * @return \WPEForm\GeneralDeps\WPackio\Enqueue
	 */
	public static function enqueue() : \WPEForm\GeneralDeps\WPackio\Enqueue {
		return self::$enqueue;
	}

	/**
	 * Enqueue fontawesome assets and return the manifest.
	 *
	 * @return array
	 */
	public static function enqueue_fontawesome() : array {
		return self::enqueue()->enqueue(
			'fontawesome',
			'main',
			[
				'js' => true,
				'css' => true,
				'js_dep' => [],
				'css_dep' => [],
				'in_footer' => true,
				'media' => 'all',
			]
		);
	}

	/**
	 * Create an instance of the Init class
	 *
	 * @param \WPEForm\System\Install   $installer The installer dependency.
	 * @param \WPEForm\System\Endpoints $endpoints The endpoints dependency.
	 */
	public function __construct( \WPEForm\System\Install $installer, \WPEForm\System\Endpoints $endpoints ) {
		$this->installer = $installer;
		$this->endpoints = $endpoints;

		// create the enqueue
		self::create_enqueue();
	}
}
