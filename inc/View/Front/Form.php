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

use  WPEForm\System\Endpoints ;
use  WPEForm\System\Init ;
use  WPEForm\System\SystemEndpoint ;
use function  WPEForm\Helpers\combine_wpackio_assets ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * View class for all Form related output.
 *
 * These work mostly by hooking into endpoints.
 */
class Form extends Base
{
    /**
     * Get the URI (part after endpoint) given a form id and slug.
     *
     * @param int    $form_id Form Id.
     * @param string $slug Slug, derived from form name.
     * @return string Form URI.
     */
    public static function get_form_standalone_uri( int $form_id, string $slug ) : string
    {
        return '/form/' . $slug . '/' . (string) $form_id . '/';
    }
    
    /**
     * Get Form Standalone Link.
     *
     * @param int $form_id Id of the form.
     * @return string URL to the standalone page.
     */
    public static function get_form_standalone_link( int $form_id ) : string
    {
        [ , $slug ] = self::get_form_data_and_slug( $form_id );
        return Endpoints::get_endpoint_url( self::get_form_standalone_uri( $form_id, $slug ) );
    }
    
    /**
     * Enqueue assets for a form.
     *
     * @param bool $in_footer Whether or not we enqueue in footer.
     * @return array Array of assets being enqueued.
     */
    public static function enqueue_assets( bool $in_footer = true ) : array
    {
        $enqueue = \WPEForm\System\Init::enqueue();
        $entrypoint_name = 'app';
        // ENDFS: this if block will be removed
        $assets = $enqueue->enqueue( $entrypoint_name, 'form', [
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
     * Get a Form Container where the script would render the react app.
     *
     * @param array $config Configuration array.
     * @param bool  $single_page Whether or not this render is for single page.
     * @param array $assets Assets as enqueued.
     *
     * @return string The HTML of the container.
     */
    public static function get_container( array $config, bool $single_page, array $assets ) : string
    {
        $form_id = $config['form_id'];
        $form_data = $config['form_data'];
        $theme_style = \json_encode( $form_data['theme_style'] );
        $panels = $form_data['panels'] ?? 1;
        $controls = $form_data['controls'] ?? 1;
        $enqueue = \WPEForm\System\Init::enqueue();
        $css_handles = $enqueue->getCssHandles( $assets );
        $container = '<div' . ' class="wp-eform-form-holder"' . ' data-single-page="' . (( $single_page ? 'true' : 'false' )) . '"' . ' data-theme-style="' . \esc_attr( $theme_style ) . '"' . ' data-panels="' . \esc_attr( (string) $panels ) . '"' . ' data-controls="' . \esc_attr( (string) $controls ) . '"' . ' data-css-handles="' . \esc_attr( \json_encode( $css_handles ) ) . '"' . ' data-form-id="' . \esc_attr( (string) $form_id ) . '">' . self::wrap_in_shadow_dom_if_needed( $form_data['skeleton']['formPreviewSkeleton'] ?? '' ) . '</div>';
        return $container;
    }
    
    /**
     * Endpoint hook for form outout.
     *
     * @return void
     */
    public static function handle_standalone_output() : void
    {
        $endpoint_url = Endpoints::get_endpoint_query_var();
        $possible_matches = [];
        
        if ( \preg_match( '/^form(\\/.*)?\\/(\\d+)$/', $endpoint_url, $possible_matches ) ) {
            $form_id = $possible_matches[2];
            // get the data and slug
            [ $form_data, $slug ] = self::get_form_data_and_slug( (int) $form_id );
            // if form name is valid, then proceed
            
            if ( $form_data ) {
                $url_slug = \mb_substr( $possible_matches[1], 1 );
                // make sure the slug is correct
                
                if ( $slug !== $url_slug ) {
                    $standalone_form_url = Endpoints::get_endpoint_url( self::get_form_standalone_uri( $form_id, $slug ) );
                    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                    $params = $_GET ?? [];
                    
                    if ( !empty($params) ) {
                        // unset the endpoint base from $_GET
                        unset( $params[Endpoints::get_endpoint_base()] );
                        // first get the parameters with it's original values
                        $params = \wp_unslash( $params );
                        // deeply sanitize it
                        $params = \map_deep( $params, 'sanitize_textarea_field' );
                        // finaly URL encode it
                        $params = \rawurlencode_deep( $params );
                    }
                    
                    \wp_safe_redirect( \add_query_arg( $params, $standalone_form_url ), 301 );
                    die;
                }
                
                // all set, print the form script
                // first configure the enqueue
                $assets = self::enqueue_assets( false );
                $assets_output = self::get_assets_output_for_standalone_pages();
                // increase form view count
                // this handles for currently logged in user
                self::increase_form_view_count( (int) $form_id, $form_data );
                // get the body
                $body = self::get_container( [
                    'form_id'   => $form_id,
                    'form_data' => $form_data,
                ], true, $assets );
                // the page title
                $page_title = $form_data['name'];
                // render
                self::render_standalone_page(
                    $page_title,
                    $assets_output,
                    $body,
                    $form_data['theme_style']['darkMode']
                );
            }
        
        }
    
    }

}