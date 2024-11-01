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
 * @subpackage View\Front
 */
namespace WPEForm\View\Front;

use  WPEForm\Model\Submission as SubmissionModel ;
use  WPEForm\System\Init ;
use  WPEForm\System\SystemEndpoint ;
use function  WPEForm\Helpers\combine_wpackio_assets ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
/**
 * View class for summary related output.
 */
class Summary extends Base
{
    /**
     * Enqueue assets for a summary.
     *
     * @param bool $in_footer Whether or not we enqueue in footer.
     * @return array Array of assets being enqueued.
     */
    public static function enqueue_assets( bool $in_footer = true ) : array
    {
        $enqueue = \WPEForm\System\Init::enqueue();
        $entrypoint_name = 'app';
        // ENDFS: this if block will be removed
        $assets = $enqueue->enqueue( $entrypoint_name, 'submission', [
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
     * Get a summary Container where the script would render the react app.
     *
     * @param array $config Configuration array.
     * @param bool  $single_page Whether or not this render is for single page.
     * @param array $assets Assets as enqueued.
     *
     * @return string The HTML of the container.
     */
    public static function get_container( array $config, bool $single_page, array $assets ) : string
    {
        $settings = Init::$settings;
        $token = $config['token'];
        $form_data = $config['form_data'];
        $mode = $config['mode'];
        $form_label = $config['form_label'];
        $theme = $config['theme'];
        $control_type = $config['control_type'];
        $enqueue = \WPEForm\System\Init::enqueue();
        $css_handles = $enqueue->getCssHandles( $assets );
        $container = '<div' . ' class="wp-eform-submission-holder"' . ' data-single-page="' . (( $single_page ? 'true' : 'false' )) . '"' . ' data-css-handles="' . \esc_attr( \json_encode( $css_handles ) ) . '" ';
        
        if ( $form_data ) {
            $theme_style = \json_encode( $form_data['theme_style'] );
            $panels = $form_data['panels'];
            $controls = $form_data['controls'];
            $container .= ' data-theme-style="' . \esc_attr( $theme_style ) . '"' . ' data-panels="' . \esc_attr( $panels ) . '"' . ' data-controls="' . \esc_attr( $controls ) . '"';
        }
        
        $skeleton = $settings['summaryGeneralSSR'] ?? '';
        // Change skeleton based on form_data and mode
        
        if ( $mode === 'preview' ) {
            
            if ( $form_data && isset( $form_data['skeleton']['formSummarySkeleton'] ) ) {
                $skeleton = $form_data['skeleton']['formSummarySkeleton'];
            } else {
                $skeleton = '';
            }
        
        } elseif ( $mode === 'edit' ) {
            
            if ( $form_data && isset( $form_data['skeleton']['formEditSkeleton'] ) ) {
                $skeleton = $form_data['skeleton']['formEditSkeleton'];
            } else {
                $skeleton = '';
            }
        
        }
        
        $container .= ' data-token="' . \esc_attr( $token ) . '"' . ' data-form-label="' . \esc_attr( $form_label ) . '"' . ' data-theme="' . \esc_attr( $theme ) . '"' . ' data-control-type="' . \esc_attr( $control_type ) . '"' . ' data-mode="' . \esc_attr( $mode ) . '">' . self::wrap_in_shadow_dom_if_needed( $skeleton ) . '</div>';
        return $container;
    }
    
    /**
     * Get summary container configuration from request.
     *
     * @return array Summary container configuration.
     */
    public static function get_summary_config_from_request() : array
    {
        // phpcs:disable WordPress.Security.NonceVerification.Recommended
        // get and sanitize the token
        $token = ( isset( $_REQUEST['token'] ) ? \sanitize_key( $_REQUEST['token'] ) : '' );
        // get and sanitize the mode
        $mode = ( isset( $_REQUEST['mode'] ) ? \sanitize_text_field( $_REQUEST['mode'] ) : 'general' );
        // further validate the mode
        if ( !\in_array( $mode, [ 'edit', 'preview', 'general' ] ) ) {
            $mode = 'general';
        }
        // if token is indeed empty, then override the mode to 'general'
        if ( $token === '' ) {
            $mode = 'general';
        }
        $form_data = null;
        
        if ( !empty($token) ) {
            $submission = new SubmissionModel();
            $submission->set_id( null, $token );
            
            if ( $submission->exists() ) {
                $submission_data = $submission->read();
                $form_id = $submission_data['formId'];
                $form_data = self::get_form_data_and_slug( (int) $form_id )[0];
            }
        
        }
        
        // the page title
        $settings = Init::$settings;
        $page_title = $settings['summary']['pageTitle'];
        $form_label = $settings['summary']['formLabel'];
        $theme = $settings['appearance']['defaultTheme'];
        $control_type = $settings['appearance']['defaultControlType'];
        $config = [
            'token'        => $token,
            'form_data'    => $form_data,
            'mode'         => $mode,
            'page_title'   => $page_title,
            'form_label'   => $form_label,
            'theme'        => $theme,
            'control_type' => \strtoupper( $control_type ),
        ];
        return $config;
        // phpcs:enable WordPress.Security.NonceVerification.Recommended
    }
    
    /**
     * Output needed HTML for previewing or editing a summary from front-end of the app.
     *
     * @return void
     */
    public static function handle_standalone_output() : void
    {
        $config = self::get_summary_config_from_request();
        // all set, print the form script
        // first configure the enqueue
        $assets = self::enqueue_assets( false );
        $assets_output = self::get_assets_output_for_standalone_pages();
        // get the body
        $body = self::get_container( $config, true, $assets );
        // render
        self::render_standalone_page(
            $config['page_title'],
            $assets_output,
            $body,
            ( $config['form_data'] ? $config['form_data']['theme_style']['darkMode'] : 'OFF' )
        );
    }

}