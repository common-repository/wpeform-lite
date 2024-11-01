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

use  Exception ;
use  Freemius_Exception ;
use  WPEForm\Auth\Form as FormAuth ;
use  WPEForm\Factory\Role ;
use  WPEForm\Handler\Submission as SubmissionHandler ;
use  WPEForm\View\Admin\App ;
use  WPEForm\View\Front\ShortcodeGenerator ;
use  WPEForm\View\Front\Summary as SummaryView ;
use  WPEForm\View\Front\UserPortal as UserPortalView ;
use  FS_Security ;
use  WPEForm\Controller\Form as ControllerForm ;
use  WPEForm\Handler\Headless ;
use  WPEForm\Model\Form as ModelForm ;
use function  WPEForm\Helpers\is_wpeform_app_mode ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
// phpcs:disable WordPress.Security.NonceVerification.Recommended
/**
 * System class for getting things related to global settings. Useful for
 * summary page, portal page etc.
 *
 * Also populates endpoints for `/system/`.
 */
class SystemEndpoint
{
    const  ENDPOINT_PREFIX = 'system' ;
    /**
     * Get endpoint for system base.
     *
     * @param string $path Path to the system base. Defaults `'/'`.
     * @return string
     */
    protected static function get_system_endpoint_url( $path = '/' )
    {
        $endpoint_path = \trailingslashit( '/' . self::ENDPOINT_PREFIX . $path );
        $endpoint = Endpoints::get_endpoint_url( $endpoint_path );
        return $endpoint;
    }
    
    /**
     * Get Submission View Link, given the token for the submission. This does
     * not validate the token.
     *
     * @param string|null $token Token of the submission.
     *
     * @return string URL for the submission.
     */
    public static function get_summary_page_link( ?string $token ) : string
    {
        $page_id = Init::$settings['system']['summaryPage'];
        $summary_page_link = self::get_system_endpoint_url( '/summary' );
        
        if ( $page_id && $page_id !== '0' ) {
            $possible_link = \get_permalink( $page_id );
            if ( $possible_link ) {
                $summary_page_link = $possible_link;
            }
        }
        
        $query_args = [
            'mode' => \rawurlencode( 'preview' ),
        ];
        if ( $token !== null ) {
            $query_args['token'] = \rawurlencode( $token );
        }
        return \add_query_arg( $query_args, $summary_page_link );
    }
    
    /**
     * Get summary download page link. When visited, this will download the PDF.
     *
     * @param string $token Token of the summary.
     * @param bool   $as_admin Whether or not the link should be for admin.
     * @return string
     */
    public static function get_summary_download_page_link( string $token, bool $as_admin ) : string
    {
        $url = self::get_system_endpoint_url( '/summary-pdf/' );
        $params = [
            'mode' => 'download',
        ];
        
        if ( $as_admin ) {
            $params['id'] = \rawurlencode( $token );
        } else {
            $params['token'] = \rawurlencode( $token );
        }
        
        return \add_query_arg( $params, $url );
    }
    
    /**
     * Get summary print page link. When visited, this will print the HTML.
     *
     * @param string $token Token of the summary.
     * @param bool   $as_admin Whether or not the link should be for admin.
     * @return string
     */
    public static function get_summary_print_page_link( string $token, bool $as_admin ) : string
    {
        $url = self::get_system_endpoint_url( '/summary-pdf/' );
        $params = [
            'mode' => 'preview',
        ];
        
        if ( $as_admin ) {
            $params['id'] = \rawurlencode( $token );
        } else {
            $params['token'] = \rawurlencode( $token );
        }
        
        return \add_query_arg( $params, $url );
    }
    
    /**
     * Get Portal Page Link.
     *
     * @return string
     */
    public static function get_userportal_page_link() : string
    {
        $page_id = Init::$settings['system']['portalPage'];
        $portal_page_link = self::get_system_endpoint_url( '/submissions' );
        
        if ( $page_id && $page_id !== '0' ) {
            $possible_link = \get_permalink( $page_id );
            if ( $possible_link ) {
                $portal_page_link = $possible_link;
            }
        }
        
        return $portal_page_link;
    }
    
    /**
     * Get Logout URL. This is safe to be used with GraphQL and unescapes the
     * URL.
     *
     * @param string $redirect Redirect link.
     *
     * @return string
     */
    public static function get_logout_link( string $redirect = '' ) : string
    {
        return \htmlspecialchars_decode( \wp_logout_url( $redirect ) );
    }
    
    /**
     * Get Login In URL. This is safe to be used with GraphQL and unescapes the
     * URL.
     *
     * @return string
     */
    public static function get_login_link() : string
    {
        return \htmlspecialchars_decode( \wp_login_url() );
    }
    
    /**
     * Get user email view online link.
     *
     * @param string $token Token of the submission.
     * @param bool   $is_update Whether or not for updation.
     * @param bool   $admin_update Whether or not this is an admin update.
     *
     * @return string URL.
     */
    public static function get_user_email_link( string $token, bool $is_update, bool $admin_update ) : string
    {
        return \add_query_arg( [
            'token'        => \rawurlencode( $token ),
            'is_update'    => \rawurlencode( ( $is_update ? 'true' : 'false' ) ),
            'admin_update' => \rawurlencode( ( $admin_update ? 'true' : 'false' ) ),
        ], self::get_system_endpoint_url( '/user-email' ) );
    }
    
    /**
     * Get Headless JavaScript embed link.
     *
     * @return string
     */
    public static function get_headless_js_embed_link()
    {
        return \add_query_arg( [
            'version' => \WP_EFORM_VERSION,
        ], self::get_system_endpoint_url( '/headless-js' ) );
    }
    
    /**
     * Get admin email view online link.
     *
     * @param string $token Token of the submission.
     * @param bool   $is_update Whether or not for updation.
     *
     * @return string URL.
     */
    public static function get_admin_email_link( string $token, bool $is_update ) : string
    {
        return \add_query_arg( [
            'token'     => \rawurlencode( $token ),
            'is_update' => \rawurlencode( ( $is_update ? 'true' : 'false' ) ),
        ], self::get_system_endpoint_url( '/admin-email' ) );
    }
    
    /**
     * Get standalone admin Url.
     *
     * @param string|null $path Path within the admin.
     *
     * @return string
     */
    public static function get_standalone_admin_link( ?string $path = null ) : string
    {
        return self::get_system_endpoint_url( '/admin' . ($path ?? '') );
    }
    
    /**
     * Get wp-admin Url.
     *
     * @param string|null $path Path within the admin.
     * @return string
     */
    public static function get_wp_admin_link( ?string $path = null ) : string
    {
        return \admin_url( 'admin.php?page=' . App::MENU_SLUG . '#' . ($path ?? '') );
    }
    
    /**
     * Get administrative link for a submission.
     *
     * @param string $id Id of the submission.
     *
     * @return string URL to the standalone admin page.
     */
    public static function get_submission_admin_link( string $id ) : string
    {
        return self::get_standalone_admin_link( '/submissions/edit/' . $id );
    }
    
    /**
     * Handle user email from the endpoint.
     *
     * @return void
     */
    protected static function handle_user_email()
    {
        $token = ( isset( $_REQUEST['token'] ) ? \sanitize_key( $_REQUEST['token'] ) : '' );
        if ( !$token || empty($token) ) {
            // do nothing and fallback to 404
            return;
        }
        $is_update = ( isset( $_REQUEST['is_update'] ) && $_REQUEST['is_update'] === 'true' ? true : false );
        $admin_update = ( isset( $_REQUEST['admin_update'] ) && $_REQUEST['admin_update'] === 'true' ? true : false );
        $handler = SubmissionHandler::get_instance_from_token( (string) $token, $is_update, $admin_update );
        
        if ( $handler ) {
            $mailer = $handler->mailer()->get_user_email_mailer( $is_update, $admin_update );
            $html = $mailer->get_html();
            \header( 'content-type: text/html; charset=UTF-8' );
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo  $html ;
            die;
        }
        
        // Let 404 handle the rest
    }
    
    /**
     * Handle admin email from the endpoint.
     *
     * @return void
     */
    protected static function handle_admin_email()
    {
        $token = ( isset( $_REQUEST['token'] ) ? \sanitize_key( $_REQUEST['token'] ) : '' );
        if ( !$token || empty($token) ) {
            // do nothing and fallback to 404
            return;
        }
        $is_update = ( isset( $_REQUEST['is_update'] ) && $_REQUEST['is_update'] === 'true' ? true : false );
        $handler = SubmissionHandler::get_instance_from_token( (string) $token, $is_update, false );
        
        if ( $handler ) {
            // if user is not logged in, then redirect
            $auth = new FormAuth();
            if ( !$auth->can_current_user_edit( $handler->get_form_model() ) ) {
                
                if ( $auth->is_user_logged_in() ) {
                    \wp_die( \esc_html__( 'You do not have permission to view this page.', 'wp-eform' ), \esc_html__( 'Authentication Error', 'wp-eform' ), 401 );
                } else {
                    \wp_safe_redirect( \wp_login_url( self::get_admin_email_link( $token, $is_update ) ) );
                    die;
                }
            
            }
            $mailer = $handler->mailer()->get_admin_email_mailer( $is_update );
            $html = $mailer->get_html();
            \header( 'content-type: text/html; charset=UTF-8' );
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo  $html ;
            die;
        }
        
        // Let 404 handle the rest
    }
    
    /**
     * Get freemius related for the back-end application.
     *
     * @return array
     */
    public static function get_freemius_backend_data() : array
    {
        static  $data ;
        
        if ( !$data ) {
            // first get the front-end data
            $data = self::get_freemius_frontend_data();
            // now merge them with the backend data
            $timestamp = time();
            $fs = \wpeform_fs();
            $context_params = [
                'plugin_id'         => $fs->get_id(),
                'plugin_public_key' => $fs->get_public_key(),
                'plugin_version'    => $fs->get_plugin_version(),
                'is_enriched'       => true,
                'trial'             => $fs->is_trial(),
            ];
            $bundle_id = $fs->get_bundle_id();
            if ( !is_null( $bundle_id ) ) {
                $context_params['bundle_id'] = $bundle_id;
            }
            
            if ( $fs->is_registered() ) {
                $context_params = \array_merge( $context_params, FS_Security::instance()->get_context_params( $fs->get_site(), $timestamp, 'upgrade' ) );
            } else {
                $context_params['home_url'] = home_url();
            }
            
            // Append plugin secure token for sandbox mode authentication.)
            if ( $fs->is_payments_sandbox() ) {
                $context_params['sandbox'] = FS_Security::instance()->get_secure_token( $fs->get_plugin(), $timestamp, 'checkout' );
            }
            $pricing = $fs->get_api_plugin_scope()->get( 'pricing.json?' . \http_build_query( $context_params ) );
            $plans = [];
            
            if ( isset( $pricing->plans ) && !empty($pricing->plans) ) {
                $processed_features = [];
                foreach ( $pricing->plans as $plan ) {
                    $new_plan = [
                        'title'       => $plan->title,
                        'planName'    => $plan->name,
                        'recommended' => $plan->is_featured === true,
                        'isHidden'    => $plan->is_hidden,
                        'features'    => [],
                        'pricing'     => [
                        'monthly'  => 0.0,
                        'annual'   => 0.0,
                        'lifetime' => 0.0,
                    ],
                    ];
                    if ( isset( $plan->features ) && \is_array( $plan->features ) ) {
                        foreach ( $plan->features as $feature ) {
                            
                            if ( !\in_array( $feature->id, $processed_features ) ) {
                                $new_plan['features'][] = [
                                    'id'          => $feature->id,
                                    'title'       => $feature->title,
                                    'description' => $feature->description,
                                ];
                                $processed_features[] = $feature->id;
                            }
                        
                        }
                    }
                    if ( isset( $plan->pricing ) && \is_array( $plan->pricing ) ) {
                        foreach ( $plan->pricing as $price ) {
                            
                            if ( $price->licenses === 1 ) {
                                $new_plan['pricing']['monthly'] = $price->monthly_price;
                                $new_plan['pricing']['annual'] = $price->annual_price;
                                $new_plan['pricing']['lifetime'] = $price->lifetime_price;
                            }
                        
                        }
                    }
                    $plans[] = $new_plan;
                }
            }
            
            $data = \array_merge( $data, [
                'canUpgrade'        => \current_user_can( \WPEForm\Auth\Dashboard::ADMIN ),
                'upgradeUrl'        => $fs->get_upgrade_url(),
                'trialUrl'          => $fs->get_trial_url(),
                'checkoutUrl'       => $fs->checkout_url(),
                'canUsePremiumCode' => $fs->can_use_premium_code(),
                'isNotPaying'       => $fs->is_not_paying(),
                'isTrial'           => $fs->is_trial(),
                'isTrialUtilized'   => $fs->is_trial_utilized(),
                'currentPlan'       => $fs->get_plan_name(),
                'plans'             => $plans,
                'isSandbox'         => $fs->is_payments_sandbox(),
            ] );
        }
        
        return $data;
    }
    
    /**
     * Enqueue assets for administrator application.
     *
     * @param bool $standalone Whether this enqueue is for standalone page or wp-admin page.
     * @return void
     */
    public static function enqueue_admin_page_assets( bool $standalone )
    {
        \wp_enqueue_media();
        
        if ( $standalone ) {
            \wp_enqueue_script( 'media-grid' );
            \wp_enqueue_script( 'media' );
        }
        
        $enqueue = \WPEForm\System\Init::enqueue();
        $entrypoint_name = 'admin';
        // ENDFS: this if block will be removed
        $assets = $enqueue->enqueue( $entrypoint_name, 'main', [
            'js'             => true,
            'css'            => true,
            'js_dep'         => [],
            'css_dep'        => [],
            'in_footer'      => true,
            'media'          => 'all',
            'main_js_handle' => 'wpeform-admin-handle',
        ] );
        $admin_script_handle = $enqueue->getPrimaryJsHandle( $assets );
        $standalone_admin_url = self::get_standalone_admin_link();
        $router_base = \home_url( '/' . Endpoints::get_endpoint_base() . '/system/admin/', 'relative' );
        $is_pretty_permalink = Endpoints::is_pretty_permalink_enabled();
        
        if ( !$is_pretty_permalink ) {
            $router_base = \home_url( '/', 'relative' );
            $router_base = \add_query_arg( Endpoints::get_query_params_for_non_pretty_permalinks( 'system/admin' ), $router_base );
        }
        
        $is_administrator = \current_user_can( \WPEForm\Auth\Dashboard::ADMIN );
        $settings = Init::$settings;
        $site_status = null;
        if ( $is_administrator ) {
            $site_status = [
                'pluginVersionScript' => \WP_EFORM_VERSION,
                'pluginVersionDb'     => Init::get_db_plugin_version(),
                'arePagesPublished'   => $settings['system']['summaryPage'] !== '0' && $settings['system']['portalPage'] !== '0',
                'phpOkay'             => \version_compare( \PHP_VERSION, '7.1.0', '>=' ),
                'phpVersion'          => \PHP_MAJOR_VERSION . '.' . \PHP_MINOR_VERSION . '.' . \PHP_RELEASE_VERSION,
                'isPrettyPermalink'   => $is_pretty_permalink,
            ];
        }
        $current_user_id = (int) \get_current_user_id();
        $script_data = [
            'gqlUri'             => \WPEForm\GraphQL\Endpoint::get_graphql_endpoint_url(),
            'isAdministrator'    => $is_administrator,
            'standaloneAdminUrl' => $standalone_admin_url,
            'wpAdminUrl'         => self::get_wp_admin_link(),
            'caps'               => Role::get_can_user_caps_for_builtins(),
            'userId'             => $current_user_id,
            'standalone'         => $standalone,
            'routerBase'         => $router_base,
            'formPreviewUrl'     => Endpoints::get_endpoint_url( '/form/' ),
            'isPrettyPermalink'  => $is_pretty_permalink,
            'freemius'           => self::get_freemius_backend_data(),
            'siteStatus'         => $site_status,
            'statsAvailable'     => \WPEForm\Model\Dashboard::are_stats_available( $current_user_id ),
        ];
        
        if ( is_wpeform_app_mode() ) {
            $script_data['isHeadless'] = true;
            $headless = new Headless();
            $script_data['headlessUrl'] = self::get_headless_js_embed_link();
            $script_data['headlessUrlIntegrity'] = $headless->get_javascript_integrity();
            $script_data['headlessEmbed'] = $headless->get_javascript_obj();
        }
        
        \wp_add_inline_script( $admin_script_handle, 'var WPEFormAdminApp = ' . \json_encode( $script_data ) . ';', 'before' );
        self::append_wpeformgraphqlapp_to_handle( $admin_script_handle );
        // set translation script
        \wp_set_script_translations( 'wpeform-admin-handle', 'wp-eform', \plugin_dir_path( \WP_EFORM_PLUGIN ) . 'languages/js/admin' );
        // enqueue fontawesome
        Init::enqueue_fontawesome();
    }
    
    /**
     * Get freemius related data for plugin operation. Use these data in
     * the front-end.
     *
     * @return array
     */
    public static function get_freemius_frontend_data() : array
    {
        static  $data ;
        
        if ( !$data ) {
            $wpeform_fs = \wpeform_fs();
            $data = [
                'canUsePremiumCode'                                     => $wpeform_fs->can_use_premium_code(),
                'isTrial'                                               => $wpeform_fs->is_trial(),
                'isPlan' . \ucfirst( Init::PLAN_STARTER ) . 'Only'      => $wpeform_fs->is_plan_or_trial( Init::PLAN_STARTER, true ),
                'isPlan' . \ucfirst( Init::PLAN_PRO ) . 'Only'          => $wpeform_fs->is_plan_or_trial( Init::PLAN_PRO, true ),
                'isPlan' . \ucfirst( Init::PLAN_BUSINESS ) . 'Only'     => $wpeform_fs->is_plan_or_trial( Init::PLAN_BUSINESS, true ),
                'isPlan' . \ucfirst( Init::PLAN_STARTER ) . 'OrHigher'  => $wpeform_fs->is_plan_or_trial( Init::PLAN_STARTER, false ),
                'isPlan' . \ucfirst( Init::PLAN_PRO ) . 'OrHigher'      => $wpeform_fs->is_plan_or_trial( Init::PLAN_PRO, false ),
                'isPlan' . \ucfirst( Init::PLAN_BUSINESS ) . 'OrHigher' => $wpeform_fs->is_plan_or_trial( Init::PLAN_BUSINESS, false ),
            ];
        }
        
        return $data;
    }
    
    /**
     * Get WPEFormGraphQLApp script data in associative array. You need to JSON
     * encode yourself before using it.
     *
     * @param bool $headless Whether or not to consider headless mode.
     * @param bool $for_embed Whether or not to return fields for embed only.
     * @return array
     */
    public static function get_wpeformgraphqlapp_data( bool $headless = false, bool $for_embed = false ) : array
    {
        $settings = Init::$settings;
        $current_user = null;
        if ( \is_user_logged_in() && !$headless ) {
            $current_user = \WPEForm\GraphQL\Resolver\User::get_user_by_id( \get_current_user_id() );
        }
        $script_data = [
            'isHeadless'       => is_wpeform_app_mode(),
            'gqlUri'           => \WPEForm\GraphQL\Endpoint::get_graphql_endpoint_url( $headless ),
            'userPortal'       => self::get_userportal_page_link(),
            'summaryPage'      => self::get_summary_page_link( null ),
            'appVersion'       => \WP_EFORM_VERSION,
            'sentry'           => [
            'enabled'              => $settings['sentry']['enabled'],
            'dsn'                  => ( $settings['sentry']['enabled'] ? $settings['sentry']['dsn'] : '' ),
            'showFeedbackUI'       => ( $settings['sentry']['enabled'] ? $settings['sentry']['showFeedbackUI'] : false ),
            'integrateFrontendApp' => ( $settings['sentry']['enabled'] ? $settings['sentry']['integrateFrontendApp'] : false ),
            'integrateAdminApp'    => ( $settings['sentry']['enabled'] ? $settings['sentry']['integrateAdminApp'] : false ),
        ],
            'userInfo'         => $current_user,
            'freemius'         => self::get_freemius_frontend_data(),
            'customCSS'        => $settings['appearance']['customCss'],
            'customStyleLinks' => $settings['appearance']['customStyleLinks'],
            'renderInShadow'   => $settings['appearance']['renderInShadow'],
            'debug'            => \defined( 'WP_DEBUG' ) && \WP_DEBUG,
        ];
        if ( $headless && $for_embed ) {
            return [
                'appVersion'  => $script_data['appVersion'],
                'freemius'    => $script_data['freemius'],
                'gqlUri'      => $script_data['gqlUri'],
                'userPortal'  => $script_data['userPortal'],
                'summaryPage' => $script_data['summaryPage'],
            ];
        }
        return $script_data;
    }
    
    /**
     * Append global `WPEFormGraphQLApp` JavaScript variable to a script handle.
     * This is the central source for the datastructure of the said variable.
     *
     * @param string $handle Handle of the script.
     * @return void
     */
    public static function append_wpeformgraphqlapp_to_handle( string $handle ) : void
    {
        $script_data = self::get_wpeformgraphqlapp_data();
        \wp_add_inline_script( $handle, 'var WPEFormGraphQLApp=' . \json_encode( $script_data ) . ';', 'before' );
    }
    
    /**
     * Handle the standalone admin app.
     *
     * @return void
     */
    protected static function handle_standalone_admin()
    {
        // if user is not logged in, then redirect
        
        if ( !\is_user_logged_in() ) {
            $query_args = [];
            if ( isset( $_GET ) && !empty($_GET) ) {
                foreach ( $_GET as $key => $val ) {
                    $query_args[$key] = \rawurlencode_deep( \map_deep( \wp_unslash( $val ), 'sanitize_textarea_field' ) );
                }
            }
            \wp_safe_redirect( \wp_login_url( \add_query_arg( $query_args, self::get_system_endpoint_url( '/admin/' ) ) ) );
            die;
        }
        
        // check for at-least dashboard auth
        $dashboard_auth = new \WPEForm\Auth\Dashboard();
        $dashboard_model = new \WPEForm\Model\Dashboard();
        if ( !$dashboard_auth->can_current_user_read( $dashboard_model ) ) {
            \wp_die( \esc_html__( 'You do not have proper permissions to access this page.', 'wp-eform' ), \esc_html__( 'Unauthorized access', 'wp-eform' ) );
        }
        // facilitate the admin
        self::enqueue_admin_page_assets( true );
        \ob_start();
        \WPEForm\System\Init::enqueue()->printPublicPath();
        \wp_print_styles();
        \wp_print_scripts();
        $assets_output = \ob_get_clean();
        include \WP_EFORM_ABSPATH . 'inc/View/Admin/templates/admin-app.php';
        die;
    }
    
    /**
     * Handle summary page, where we show submission.
     *
     * @return void
     */
    protected static function handle_summary()
    {
        SummaryView::handle_standalone_output();
        // let 404 handle rest
    }
    
    /**
     * Handle summary PDF renderer.
     *
     * @return void
     */
    protected static function handle_summary_pdf()
    {
        $token = ( isset( $_REQUEST['token'] ) ? \sanitize_key( $_REQUEST['token'] ) : '' );
        $id = ( isset( $_REQUEST['id'] ) ? (string) \intval( $_REQUEST['id'] ) : '' );
        $mode = ( isset( $_REQUEST['mode'] ) ? \sanitize_text_field( $_REQUEST['mode'] ) : 'download' );
        // validate mode inputs
        if ( !\in_array( $mode, [ 'download', 'preview' ] ) ) {
            $mode = 'download';
        }
        // requests made by id will check for admin priviledges
        $is_admin_request = false;
        
        if ( $id ) {
            $is_admin_request = true;
            $handler = SubmissionHandler::get_instance_from_id( $id, false, false );
        } else {
            $handler = SubmissionHandler::get_instance_from_token( $token, false, false );
        }
        
        
        if ( !$handler ) {
            return;
            // let 404 handle the rest
        }
        
        // check for permissions
        $form_auth = new FormAuth();
        if ( $is_admin_request && !$form_auth->can_current_user_read_sensitive_info( $handler->get_form_model() ) ) {
            \wp_die( \esc_html__( 'You do not have sufficient permission to view this resource.', 'wp-eform' ), \esc_html__( 'Insufficient Permission', 'wp-eform' ) );
        }
        $pdf = $handler->pdf()->get_summary_pdf( !!$id );
        
        if ( $mode === 'preview' ) {
            \header( 'content-type: text/html; charset=UTF-8' );
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo  $pdf->get_html( 'print' ) ;
            die;
        } else {
            $pdf->stream( $handler->pdf()->get_pdf_name() );
        }
    
    }
    
    /**
     * Handle user portal page.
     *
     * @return void
     */
    protected static function handle_portal()
    {
        // if user is not logged in, then redirect
        if ( !\is_user_logged_in() ) {
            \wp_safe_redirect( \wp_login_url( self::get_userportal_page_link() ) );
        }
        UserPortalView::handle_standalone_output();
    }
    
    /**
     * Get shortcode generator app URL.
     *
     * @return string
     */
    public static function get_shortcode_generator_link()
    {
        return self::get_system_endpoint_url( '/shortcode-generator' );
    }
    
    /**
     * Handle shortcode generator page. This is used primarily by tinyMCE plugin.
     *
     * @return void
     */
    protected static function handle_shortcode_generator()
    {
        // do something
        if ( !\is_user_logged_in() ) {
            \wp_die( \esc_html__( 'Can only be accessed when logged in.', 'wp-eform' ) );
        }
        ShortcodeGenerator::handle_standalone_output();
    }
    
    /**
     * Handle headless JavaScript output.
     *
     * @return void
     */
    public static function handle_headless_js()
    {
        // if not in app mode, then don't do anything
        if ( !is_wpeform_app_mode() ) {
            return;
        }
        $headless = new Headless();
        $headless->render_javascript_output();
    }
    
    /**
     * Register all endpoint output related to System functionalities.
     *
     * @return void
     */
    public static function register_system_endpoints() : void
    {
        $endpoint_query = Endpoints::get_endpoint_query_var();
        // check if endpoint matches
        $matches = [];
        if ( !\preg_match( '/^' . self::ENDPOINT_PREFIX . '(\\/?)([^\\/]*)(.*)/i', $endpoint_query, $matches ) ) {
            return;
        }
        // It's a match, now process
        
        if ( isset( $matches[2] ) ) {
            switch ( $matches[2] ) {
                // user email
                case 'user-email':
                    self::handle_user_email();
                    break;
                    // admin email
                // admin email
                case 'admin-email':
                    self::handle_admin_email();
                    break;
                    // standalone admin app
                // standalone admin app
                case 'admin':
                    self::handle_standalone_admin();
                    break;
                case 'summary':
                    self::handle_summary();
                    break;
                case 'submissions':
                    self::handle_portal();
                    break;
                case 'shortcode-generator':
                    self::handle_shortcode_generator();
                    break;
                case 'summary-pdf':
                    self::handle_summary_pdf();
                    break;
                case 'headless-js':
                    self::handle_headless_js();
                    break;
            }
            // ENDFS: this if block will be removed
        }
        
        // let it process and fallback to error 404
    }

}