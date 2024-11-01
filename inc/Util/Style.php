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
 * @subpackage Util
 */
namespace WPEForm\Util;

use  WPEForm\Exception\InvalidOperationException ;
use  LogicException ;
use  WPEForm\System\Init ;
use function  WPEForm\Helpers\validate_is_exploitable_filename ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * A class to work with built-in styles.
 *
 * @package WPEForm\Util
 */
class Style
{
    /**
     * The style value as retrieved from JSON.
     *
     * @var array
     */
    private  $style = array() ;
    /**
     * Computed style_id.
     *
     * @var string
     */
    private  $style_id ;
    /**
     * Get computed style_id.
     *
     * @return string
     */
    public function get_style_id() : string
    {
        return $this->style_id;
    }
    
    /**
     * Create an instance.
     *
     * @param string $style_id Id of the style. Should correspond to the filename.
     *
     * @throws LogicException If JSON is invalid.
     * @throws InvalidOperationException If $style_id can be used for exploitation.
     */
    public function __construct( string $style_id )
    {
        if ( validate_is_exploitable_filename( $style_id ) ) {
            throw new InvalidOperationException( 'The style id is invalid.' );
        }
        $file = \dirname( __FILE__ ) . '/styles/' . $style_id . '.json';
        // ENDFS: this if block will be removed
        
        if ( !\file_exists( $file ) ) {
            $file = \dirname( __FILE__ ) . '/styles/teal.json';
            $this->style_id = 'teal';
        } else {
            $this->style_id = $style_id;
        }
        
        $style = \json_decode( \file_get_contents( $file ), true );
        if ( !$style ) {
            throw new LogicException( 'Invalid json file passed to Style class.' );
        }
        $this->style = $style;
    }
    
    /**
     * Get primaryLightColor.
     *
     * @return string
     */
    public function primaryLightColor() : string
    {
        return $this->style['primaryLightColor'];
    }
    
    /**
     * Get primaryColor.
     *
     * @return string
     */
    public function primaryColor() : string
    {
        return $this->style['primaryColor'];
    }
    
    /**
     * Get primaryDarkColor.
     *
     * @return string
     */
    public function primaryDarkColor() : string
    {
        return $this->style['primaryDarkColor'];
    }
    
    /**
     * Get primaryBackgroundColor.
     *
     * @return string
     */
    public function primaryBackgroundColor() : string
    {
        return $this->style['primaryBackgroundColor'];
    }
    
    /**
     * Get primaryBgText.
     *
     * @return string
     */
    public function primaryBgText() : string
    {
        return $this->style['primaryBgText'];
    }
    
    /**
     * Get accentColor.
     *
     * @return string
     */
    public function accentColor() : string
    {
        return $this->style['accentColor'];
    }
    
    /**
     * Get backgroundShade.
     *
     * @return string
     */
    public function backgroundShade() : string
    {
        return $this->style['backgroundShade'];
    }
    
    /**
     * Get backgroundHover.
     *
     * @return string
     */
    public function backgroundHover() : string
    {
        return $this->style['backgroundHover'];
    }
    
    /**
     * Get backgroundControl.
     *
     * @return string
     */
    public function backgroundControl() : string
    {
        return $this->style['backgroundControl'];
    }
    
    /**
     * Get appBackgroundColor.
     *
     * @return string
     */
    public function appBackgroundColor() : string
    {
        return $this->style['appBackgroundColor'];
    }
    
    /**
     * Get linkColor.
     *
     * @return string
     */
    public function linkColor() : string
    {
        return $this->style['linkColor'];
    }
    
    /**
     * Get successColor.
     *
     * @return string
     */
    public function successColor() : string
    {
        return $this->style['successColor'];
    }
    
    /**
     * Get warningColor.
     *
     * @return string
     */
    public function warningColor() : string
    {
        return $this->style['warningColor'];
    }
    
    /**
     * Get errorColor.
     *
     * @return string
     */
    public function errorColor() : string
    {
        return $this->style['errorColor'];
    }
    
    /**
     * Get errorBackgroundColor.
     *
     * @return string
     */
    public function errorBackgroundColor() : string
    {
        return $this->style['errorBackgroundColor'];
    }
    
    /**
     * Get successBackgroundColor.
     *
     * @return string
     */
    public function successBackgroundColor() : string
    {
        return $this->style['successBackgroundColor'];
    }
    
    /**
     * Get warningBackgroundColor.
     *
     * @return string
     */
    public function warningBackgroundColor() : string
    {
        return $this->style['warningBackgroundColor'];
    }
    
    /**
     * Get headingColor.
     *
     * @return string
     */
    public function headingColor() : string
    {
        return $this->style['headingColor'];
    }
    
    /**
     * Get textColor.
     *
     * @return string
     */
    public function textColor() : string
    {
        return $this->style['textColor'];
    }
    
    /**
     * Get textColorSecondary.
     *
     * @return string
     */
    public function textColorSecondary() : string
    {
        return $this->style['textColorSecondary'];
    }
    
    /**
     * Get darkTextColor.
     *
     * @return string
     */
    public function darkTextColor() : string
    {
        return $this->style['darkTextColor'];
    }
    
    /**
     * Get lightTextColor.
     *
     * @return string
     */
    public function lightTextColor() : string
    {
        return $this->style['lightTextColor'];
    }
    
    /**
     * Get borderColorBase.
     *
     * @return string
     */
    public function borderColorBase() : string
    {
        return $this->style['borderColorBase'];
    }
    
    /**
     * Get borderColorSplit.
     *
     * @return string
     */
    public function borderColorSplit() : string
    {
        return $this->style['borderColorSplit'];
    }
    
    /**
     * Get borderColorLight.
     *
     * @return string
     */
    public function borderColorLight() : string
    {
        return $this->style['borderColorLight'];
    }
    
    /**
     * Get borderColorError.
     *
     * @return string
     */
    public function borderColorError() : string
    {
        return $this->style['borderColorError'];
    }
    
    /**
     * Get disabledColor.
     *
     * @return string
     */
    public function disabledColor() : string
    {
        return $this->style['disabledColor'];
    }
    
    /**
     * Get disabledBackgroundColor.
     *
     * @return string
     */
    public function disabledBackgroundColor() : string
    {
        return $this->style['disabledBackgroundColor'];
    }
    
    /**
     * Get boxShadowBase.
     *
     * @return string
     */
    public function boxShadowBase() : string
    {
        return $this->style['boxShadowBase'];
    }

}