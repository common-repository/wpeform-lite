<?php

/**
 * WPEForm - Drag and Drop Live Form Builder for Contact, Payment & Quiz Forms
 *
 * @package     WPEForm
 * @author      Swashata Ghosh <swashata@wpquark.com>
 * @copyright   2021 WPEForm
 * @license     GPL-3.0
 *
 * @wordpress-plugin
 * Plugin Name:  WPEForm - Drag and Drop Live Form Builder
 * Plugin URI:   https://www.wpeform.io
 * Description:  Drag and Drop Live Form Builder with landing page, cost estimation, quizzes, personality tests, surveys, data collection and user feedback of all kind. Also supports headless forms for your react applications.
 * Version:      1.6.5
 * Author:       WPEForm
 * Author URI:   https://www.wpeform.io
 * Text Domain:  wp-eform
 * Domain Path:  /languages
 * Requires PHP: 7.1
 * Requires at least: 5.4
 * Tested up to: 6.3
 * License:      GPL-3.0
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 *
 */
use  WPEForm\Util\TVarDumper ;
/**
 * Copyright Swashata Ghosh - WPQuark <swashata@wpquark.com>, 2019-2021
 *
 * The PHP, JS, CSS and any other code and integrated HTML are licensed under
 * the GPL license as is WordPress itself. You will find a copy of the license
 * text in the same directory as this text file. Or you can read it here:
 * http://wordpress.org/about/gpl/
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$wpeform_is_testing = defined( 'WPEFORM_IS_TESTING' ) && WPEFORM_IS_TESTING === true;

if ( function_exists( 'wpeform_fs' ) && !$wpeform_is_testing ) {
    wpeform_fs()->set_basename( false, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    
    if ( !function_exists( 'wpeform_fs' ) ) {
        // Create a helper function for easy SDK access.
        /**
         * Main Freemius integration function under wpeform namespace.
         *
         * @return Freemius The freemius instance.
         */
        function wpeform_fs()
        {
            /** @var Freemius $wpeform_fs */
            global  $wpeform_fs ;
            
            if ( !isset( $wpeform_fs ) ) {
                // Activate multisite network integration.
                if ( !defined( 'WP_FS__PRODUCT_3563_MULTISITE' ) ) {
                    define( 'WP_FS__PRODUCT_3563_MULTISITE', true );
                }
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $wpeform_fs = fs_dynamic_init( array(
                    'id'              => '3563',
                    'slug'            => 'wpeform-lite',
                    'premium_slug'    => 'wp-eform',
                    'type'            => 'plugin',
                    'public_key'      => 'pk_5a6fd065c598a8a43a54da8ee0a22',
                    'is_premium'      => false,
                    'has_addons'      => false,
                    'has_paid_plans'  => true,
                    'trial'           => array(
                    'days'               => 14,
                    'is_require_payment' => false,
                ),
                    'menu'            => array(
                    'slug' => 'wpeform',
                ),
                    'has_affiliation' => 'selected',
                    'is_live'         => true,
                ) );
            }
            
            return $wpeform_fs;
        }
        
        // Init Freemius.
        wpeform_fs();
        // Signal that SDK was initiated.
        do_action( 'wpeform_fs_loaded' );
    }
    
    // ... Your plugin's main file logic ...
    // Little Error Log
    if ( !function_exists( 'eform_error_log' ) ) {
        /**
         * Logs error in the WordPress debug mode
         *
         * @param mixed ...$params Variable parameters.
         * @return void
         */
        function eform_error_log( ... $params )
        {
            // Do nothing if not in debugging environment
            if ( !defined( 'WP_DEBUG' ) || true !== WP_DEBUG || 'cli' === php_sapi_name() ) {
                return;
            }
            if ( !empty($params) ) {
                foreach ( $params as $var ) {
                    // Log the variable
                    error_log( TVarDumper::dump( $var ) );
                    // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
                }
            }
        }
    
    }
    // Initialize system
    // define plugin path
    define( 'WP_EFORM_ABSPATH', trailingslashit( __DIR__ ) );
    define( 'WP_EFORM_PLUGIN', __FILE__ );
    define( 'WP_EFORM_VERSION', '1.6.5' );
    // Autoload from composer
    require_once WP_EFORM_ABSPATH . 'vendor/autoload.php';
    // Autoload from php-deps
    require_once WP_EFORM_ABSPATH . 'php-deps/general/libs/autoload.php';
    // ENDFS: this if block will be removed
    // Fire initiator
    $eform_system_init = new \WPEForm\System\Init( new \WPEForm\System\Install(), new \WPEForm\System\Endpoints() );
    $eform_system_init->boot();
}
