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
 * @package WPEForm
 * @subpackage Util
 */
namespace WPEForm\Util;

use  WPEForm\Exception\ResourceDoesNotExistException ;
use  WPEForm\Exception\ValidationException ;
use  WPEForm\System\Init ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Form templates utility class.
 *
 * @package WPEForm\Util
 */
class FormTemplate
{
    /**
     * An associative array of templates.
     *
     * @var array
     */
    protected  $templates = [] ;
    /**
     * Get form information from a form file name. It should match
     * `form-xx-(free|starter|professional|business)-form-name.json` and
     * relevant information will be extracted from it.
     *
     * @param string $form Form file name.
     * @return null|array Array of `name`, `plan` and `templateId` on success, null on failure.
     */
    protected function get_form_info_from_file( string $form ) : ?array
    {
        $matches = [];
        
        if ( \preg_match( '/^form\\-(\\d+)\\-(free|starter|professional|business)\\-(.*)\\.json$/i', $form, $matches ) ) {
            $name = \str_replace( '-', ' ', $matches[3] );
            $name = \ucwords( $name );
            return [
                'name'       => $name,
                'plan'       => $matches[2],
                'templateId' => $form,
            ];
        }
        
        return null;
    }
    
    /**
     * Scan for form templates given in a directory.
     *
     * @param string $dirname Directory name from `inc/Util/form-templates`.
     * @return array Array of form templates. Check GraphQL for type.
     */
    protected function scan_form_templates_in_directory( string $dirname ) : array
    {
        $form_templates = [];
        $path = \WP_EFORM_ABSPATH . 'inc/Util/form-templates/' . $dirname;
        // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
        $forms = @\scandir( $path );
        if ( !$forms ) {
            return $form_templates;
        }
        foreach ( $forms as $form ) {
            
            if ( '.' !== $form && '..' !== $form && @is_file( $path . '/' . $form ) ) {
                $form_info = $this->get_form_info_from_file( $form );
                if ( !$form_info ) {
                    continue;
                }
                $form_templates[] = [
                    'name'       => $form_info['name'],
                    'plan'       => $form_info['plan'],
                    'templateId' => Crypt::encrypt( $dirname . '/' . $form_info['templateId'] ),
                ];
            }
        
        }
        return $form_templates;
    }
    
    /**
     * Scan and populate form template categories and forms for free templates.
     *
     * @return void
     */
    protected function scan_free_template_directory()
    {
        $form_templates = $this->scan_form_templates_in_directory( 'free' );
        $this->templates[] = [
            'categoryId'   => 'free',
            'categoryName' => \__( 'Free Forms', 'wp-eform' ),
            'templates'    => $form_templates,
        ];
    }
    
    /**
     * Populate templates by scanning the plugin directory.
     */
    public function populate_templates()
    {
        // ENDFS: this if block will be removed
        // search the free directory
        $this->scan_free_template_directory();
    }
    
    /**
     * Get all templates.
     *
     * @return array
     */
    public function get_templates()
    {
        if ( empty($this->templates) ) {
            $this->populate_templates();
        }
        return $this->templates;
    }
    
    /**
     * Read a template file and get it's content.
     *
     * @param string $template_id Template Id.
     * @return string Template content.
     *
     * @throws ValidationException If provided template id is invalid.
     * @throws ResourceDoesNotExistException If provided template id does not exist.
     */
    public function read_template( string $template_id ) : string
    {
        $template_id = Crypt::decrypt( $template_id );
        if ( !$template_id ) {
            throw new ValidationException( 'Invalid templateId.' );
        }
        // sanitize template id
        if ( !\preg_match( '/^\\w+\\/(\\w|\\d|\\/|-)+\\.json$/i', $template_id ) ) {
            throw new ValidationException( 'Invalid templateId.' );
        }
        $path = \WP_EFORM_ABSPATH . 'inc/Util/form-templates/' . $template_id;
        if ( !\is_file( $path ) ) {
            throw new ResourceDoesNotExistException( 'Requested resource does not exist.' );
        }
        return \file_get_contents( $path );
    }

}