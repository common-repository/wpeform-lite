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
 * @subpackage Util
 */
namespace WPEForm\Util;

use  LogicException ;
use  WPEForm\GeneralDeps\Pelago\Emogrifier\HtmlProcessor\HtmlNormalizer ;
use  WPEForm\PremiumDeps\Mpdf\Mpdf ;
use  WPEForm\System\Init ;
use function  WPEForm\Helpers\parse_args ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * A PDF class for handling PDF related stuff.
 *
 * @package WPEForm\Util
 */
class Pdf
{
    /**
     * Style Id for styling the pdf.
     *
     * @var Style
     */
    protected  $style ;
    /**
     * PDF body.
     *
     * @var string|null
     */
    protected  $body_content = null ;
    /**
     * Template file.
     *
     * @var string|null
     */
    protected  $template_file = 'postmark' ;
    /**
     * Array of attributes.
     *
     * ```
     * [
     *   'value' => string,
     *   'label' => string,
     * ][]
     * ```
     *
     * @var array
     */
    protected  $attributes = array() ;
    /**
     * Page title.
     *
     * @var string|null
     */
    protected  $page_title_content = null ;
    /**
     * Title text.
     *
     * @var string|null
     */
    protected  $title_content = null ;
    /**
     * Footer content (with HTML).
     *
     * @var string|null
     */
    protected  $footer_content = null ;
    /**
     * Set attributes for the email.
     *
     * @param array $attributes Array of attributes, with label and value.
     * @return Pdf Current instance.
     */
    public function attrs( array $attributes ) : Pdf
    {
        $this->attributes = parse_args( [
            'val' => $attributes,
        ], [
            'val' => [ [
            'value' => '',
            'label' => '',
        ] ],
        ] )['val'];
        return $this;
    }
    
    /**
     * Set the footer of the email.
     *
     * @param string $footer The footer HTML.
     * @return Pdf Current instance.
     */
    public function footer( string $footer ) : Pdf
    {
        $this->footer_content = $footer;
        return $this;
    }
    
    /**
     * Set title of the Email.
     *
     * @param string $title title HTML.
     *
     * @return Pdf Current instance.
     */
    public function title( string $title ) : Pdf
    {
        $this->title_content = $title;
        return $this;
    }
    
    /**
     * Set page title of the Email.
     *
     * @param string $page_title title HTML.
     *
     * @return Pdf Current instance.
     */
    public function page_title( string $page_title ) : Pdf
    {
        $this->page_title_content = $page_title;
        return $this;
    }
    
    /**
     * Set Style for the Pdf. Should correspond to a style JSON.
     *
     * @param Style $style A Style instance.
     * @return Pdf Current instance.
     */
    public function set_style( Style $style ) : Pdf
    {
        $this->style = $style;
        return $this;
    }
    
    /**
     * Get template file path, based on template Id.
     *
     * @param string $template_id Template Id.
     * @return string File path.
     */
    protected function get_template_file_path( string $template_id ) : string
    {
        return \dirname( __FILE__ ) . '/pdf-templates/' . $template_id . '.php';
    }
    
    /**
     * Set the template file id. It checks if it is actually present and if not,
     * it will fallback to the default one.
     *
     * @param string $template_id Id of the template.
     * @return Pdf Current instance.
     */
    public function set_template( string $template_id ) : Pdf
    {
        $template_file = $template_id;
        $file = $this->get_template_file_path( $template_id );
        if ( !\file_exists( $file ) ) {
            $template_file = 'postmark';
        }
        $this->template_file = $template_file;
        return $this;
    }
    
    /**
     * Set the email body.
     *
     * @param string $body Body HTML, do not put `<html><body>` tags, those
     *                     will be handled automatically.
     *
     * @return Pdf Current instance.
     */
    public function body( string $body ) : Pdf
    {
        $this->body_content = $body;
        return $this;
    }
    
    /**
     * Get email HTML from the current instance.
     *
     * @param string $mode Mode for HTML. Could be preview|print|pdf.
     * @return string Email HTML.
     * @throws LogicException If needed variables are not set.
     */
    public function get_html( string $mode = 'preview' ) : string
    {
        // things to check for
        $needed_vars = [
            'style',
            'page_title_content',
            'title_content',
            'body_content',
            'footer_content'
        ];
        foreach ( $needed_vars as $nv ) {
            if ( !isset( $this->{$nv} ) ) {
                throw new LogicException( "The {$nv} of the Pdf is not set." );
            }
        }
        // prepare the variables
        $style = $this->style;
        $page_title_content = $this->page_title_content;
        $title_content = $this->title_content;
        $attributes = $this->attributes;
        $body = $this->body_content;
        $footer_content = $this->footer_content;
        if ( $mode === 'print' ) {
            $body = "<style>html, body { font-family: --apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;}</style>" . $body;
        }
        \ob_start();
        include $this->get_template_file_path( $this->template_file );
        $html = \ob_get_clean();
        // create instance
        // $css_inliner = CssInliner::fromHtml( $html );
        // $css_inliner->inlineCss()->render()
        // output
        return HtmlNormalizer::fromHtml( $html )->render();
    }
    
    /**
     * Stream PDF for download.
     *
     * @param string $filename Filename for download.
     */
    public function stream( string $filename = 'download.pdf' )
    {
        // ENDFS: this if block will be removed
        \wp_die( 'This feature is available only in starter+ plans.', 'Insufficient License' );
    }

}