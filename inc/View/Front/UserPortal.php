<?php

/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
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
 * @subpackage View\Front
 */
namespace WPEForm\View\Front;

use  WPEForm\System\Init ;
use  WPEForm\System\SystemEndpoint ;
use function  WPEForm\Helpers\combine_wpackio_assets ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
/**
 * View class for submission related output.
 */
class UserPortal extends Base
{
    /**
     * Enqueue user portal related assets.
     *
     * @param bool $in_footer Whether or not we enqueue in footer.
     * @return array Array of assets being enqueued.
     */
    public static function enqueue_assets( bool $in_footer = true ) : array
    {
        $enqueue = \WPEForm\System\Init::enqueue();
        $entrypoint_name = 'app';
        // ENDFS: this if block will be removed
        $assets = $enqueue->enqueue( $entrypoint_name, 'userPortal', [
            'js'                => true,
            'css'               => true,
            'js_dep'            => [],
            'css_dep'           => [],
            'in_footer'         => $in_footer,
            'media'             => 'all',
            'runtime_js_handle' => 'wpeform_front_runtime',
        ] );
        $handle = $enqueue->getPrimaryJsHandle( $assets );
        $runtime = $enqueue->getRuntimeJsHandle( $assets );
        // set translation script
        \wp_set_script_translations( $runtime, 'wp-eform', \plugin_dir_path( \WP_EFORM_PLUGIN ) . 'languages/js/app' );
        SystemEndpoint::append_wpeformgraphqlapp_to_handle( $handle );
        $fontawesome = Init::enqueue_fontawesome();
        return combine_wpackio_assets( $assets, $fontawesome );
    }
    
    /**
     * Get HTML container for printing user portal.
     *
     * @param array $config Configuration array.
     * @param bool  $single_page Whether or not this render is for single page.
     * @param array $assets Assets as enqueued.
     *
     * @return string HTML container.
     */
    public static function get_container( array $config, bool $single_page, array $assets ) : string
    {
        $theme = $config['theme'];
        $control_type = $config['control_type'];
        $welcome_label = $config['welcome_label'];
        $welcome_meta_singular = $config['welcome_meta_singular'];
        $welcome_meta_plural = $config['welcome_meta_plural'];
        $welcome_no_submissions = $config['welcome_no_submissions'];
        $settings = Init::$settings;
        $skeleton = $settings['userPortalSkeleton'] ?? '';
        $enqueue = \WPEForm\System\Init::enqueue();
        $css_handles = $enqueue->getCssHandles( $assets );
        return '<div' . ' class="wp-eform-user-portal-holder"' . ' data-single-page="' . (( $single_page ? 'true' : 'false' )) . '"' . ' data-css-handles="' . \esc_attr( \json_encode( $css_handles ) ) . '"' . ' data-theme="' . \esc_attr( $theme ) . '"' . ' data-darkmode="' . \esc_attr( $config['darkMode'] ) . '"' . ' data-control-type="' . \esc_attr( $control_type ) . '"' . ' data-welcome-label="' . \esc_attr( $welcome_label ) . '"' . ' data-welcome-meta-singular="' . \esc_attr( $welcome_meta_singular ) . '"' . ' data-welcome-meta-plural="' . \esc_attr( $welcome_meta_plural ) . '"' . ' data-welcome-no-submissions="' . \esc_attr( $welcome_no_submissions ) . '">' . self::wrap_in_shadow_dom_if_needed( $skeleton ) . '</div>';
    }
    
    /**
     * Get user portal configs from settings.
     *
     * @return array
     */
    public static function get_userportal_config_from_settings() : array
    {
        $settings = Init::$settings;
        $theme = $settings['appearance']['defaultTheme'];
        $control_type = $settings['appearance']['defaultControlType'];
        $page_title = $settings['userPortal']['pageTitle'];
        $welcome_label = $settings['userPortal']['welcomeLabel'];
        $welcome_meta_singular = $settings['userPortal']['welcomeMetaSingular'];
        $welcome_meta_plural = $settings['userPortal']['welcomeMetaPlural'];
        $welcome_no_submissions = $settings['userPortal']['welcomeNoSubmissions'];
        return [
            'theme'                  => $theme,
            'control_type'           => \strtoupper( $control_type ),
            'page_title'             => $page_title,
            'welcome_label'          => $welcome_label,
            'welcome_meta_singular'  => $welcome_meta_singular,
            'welcome_meta_plural'    => $welcome_meta_plural,
            'welcome_no_submissions' => $welcome_no_submissions,
            'darkMode'               => \strtoupper( $settings['appearance']['darkMode'] ),
        ];
    }
    
    /**
     * Output HTML for User Portal.
     *
     * @return void
     */
    public static function handle_standalone_output() : void
    {
        $config = self::get_userportal_config_from_settings();
        // enqueue and get assets and handles
        $assets = self::enqueue_assets( false );
        // get asset output
        $assets_output = self::get_assets_output_for_standalone_pages();
        // get body
        $body = self::get_container( $config, true, $assets );
        // render
        self::render_standalone_page(
            $config['page_title'],
            $assets_output,
            $body,
            $config['darkMode']
        );
    }

}