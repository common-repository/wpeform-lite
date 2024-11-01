<?php

/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of WPEForm - WordPress Builder.
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
 * along with WPEForm - WordPress Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package WPEForm
 * @subpackage Element
 * @author Swashata Ghosh <swashata@wpquark.com>
 */
namespace WPEForm\Form\Element;

use  WPEForm\GeneralDeps\GraphQL\Type\Definition\Type ;
use  WPEForm\GraphQL\Registry ;
use  WPEForm\GraphQL\Util\FieldVar ;
use  WPEForm\System\Init ;
use function  WPEForm\Helpers\get_default_element_config_attributes ;
use function  WPEForm\Helpers\get_user_metavalue ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Address Element class. Address.
 *
 * Take address from users, with customizable fields.
 */
class Address extends Base
{
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function get_definition() : array
    {
        return [
            'title'       => __( 'Address', 'wp-eform' ),
            'description' => __( 'Take address from users, with customizable fields.', 'wp-eform' ),
            'container'   => false,
            'category'    => 'input',
        ];
    }
    
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function get_generic_appearance_structure() : array
    {
        return [
            'title' => [
            'uses'    => true,
            'default' => __( 'Address', 'wp-eform' ),
        ],
        ];
    }
    
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function config_vars() : array
    {
        return [
            'interface'  => [
            'disableIcons'        => FieldVar::var( false, Type::boolean() ),
            'fieldOne'            => FieldVar::var( true, Type::boolean() ),
            'fieldOnePlaceholder' => FieldVar::var( \__( 'House no. and street', 'wp-eform' ), Type::string() ),
            'fieldTwo'            => FieldVar::var( true, Type::boolean() ),
            'fieldTwoPlaceholder' => FieldVar::var( \__( 'Locality / sector', 'wp-eform' ), Type::string() ),
            'showCountry'         => FieldVar::var( true, Type::boolean() ),
            'countryPlaceholder'  => FieldVar::var( \__( 'Country', 'wp-eform' ), Type::string() ),
            'restrictCountries'   => FieldVar::var( [], Type::listOf( Type::nonNull( Type::id() ) ) ),
            'showState'           => FieldVar::var( true, Type::boolean() ),
            'statePlaceholder'    => FieldVar::var( \__( 'State', 'wp-eform' ), Type::string() ),
            'showCity'            => FieldVar::var( true, Type::boolean() ),
            'cityPlaceholder'     => FieldVar::var( \__( 'City / Town / Village', 'wp-eform' ), Type::string() ),
            'showZip'             => FieldVar::var( true, Type::boolean() ),
            'zipPlaceholder'      => FieldVar::var( \__( 'Zip code', 'wp-eform' ), Type::string() ),
        ],
            'attributes' => FieldVar::var( get_default_element_config_attributes(), Registry::get( 'attributes', 'type/form/element/config' ), Registry::get( 'attributes', 'input/form/element/config' ) ),
            'validation' => [
            'required' => FieldVar::var( false, Type::boolean() ),
        ],
        ];
    }
    
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function data_value_vars() : array
    {
        return [
            'fieldOne' => FieldVar::var( '', Type::string() ),
            'fieldTwo' => FieldVar::var( '', Type::string() ),
            'city'     => FieldVar::var( '', Type::string() ),
            'country'  => FieldVar::var( '', Type::string() ),
            'state'    => FieldVar::var( '', Type::string() ),
            'zip'      => FieldVar::var( '', Type::string() ),
        ];
    }
    
    /**
     * {@inheritDoc}
     *
     * @param array $config Normalized configuration value.
     * @param array $data_value Normalized data.value.
     *
     * @return array An associative array with success => bool, and message => string
     */
    public function get_validation_status( array $config, array $data_value ) : array
    {
        // ENDFS: this if block will be removed
        return $this->get_default_validation_status();
    }
    
    /**
     * {@inheritDoc}
     *
     * @param array                                                                                          $config Normalized configuration value.
     * @param array{selected: array<string>, other: string}                                                  $data_value Normalized data.value.
     * @param array{option: string, row: string, range: string, entry: string, return: string, type: string} $using An associative array of using config.
     * @param callable|null                                                                                  $mentions_callback Callback function for mentions.
     *
     * @return array|string Element's value.
     */
    protected function simple_value(
        array $config,
        array $data_value,
        array $using,
        ?callable $mentions_callback = null
    )
    {
        // ENDFS: this if block will be removed
        // if expecting JSON
        if ( $using['return'] === 'json' ) {
            $selected_values = [];
        }
        // expecting STRING
        return '';
    }
    
    /**
     * {@inheritDoc}
     *
     * @param array $config Normalized configuration value.
     * @param array $data_value Normalized data.value.
     *
     * @return array
     */
    public function get_data_score( array $config, array $data_value ) : array
    {
        // return default score if this element doesn't have score
        return $this->get_default_data_score();
    }
    
    /**
     * {@inheritDoc}
     *
     * @param array         $config Normalized config of the element.
     * @param array         $data_value Normalized data value of the element.
     * @param null|callable $mentions_callback Mentions callback for SlateJS renderer.
     * @param string        $purpose Purpose of the HTML. Could be 'email' or 'pdf'.
     * @return string HTML output.
     */
    protected function html_value(
        array $config,
        array $data_value,
        ?callable $mentions_callback,
        string $purpose = 'email'
    ) : string
    {
        // ENDFS: this if block will be removed
        return '<p>Not implemented.</p>';
    }
    
    /**
     * {@inheritDoc}
     *
     * @param array|null $config Config data.
     *
     * @return string|null
     */
    public function get_extra_type_data( ?array $config ) : ?string
    {
        // we use the extra type data for dealing with meta based prefil values
        $data = [
            'metaValue' => null,
        ];
        // ENDFS: this if block will be removed
        return \json_encode( $data );
    }

}