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
 * @subpackage Element
 * @author Swashata Ghosh <swashata@wpquark.com>
 */
namespace WPEForm\Form\Element;

use  DateTime ;
use  DateTimeZone ;
use  WPEForm\GeneralDeps\GraphQL\Type\Definition\Type ;
use  WPEForm\GraphQL\Registry ;
use  WPEForm\GraphQL\Util\FieldVar ;
use  WPEForm\System\Init ;
use function  WPEForm\Helpers\compare_dates ;
use function  WPEForm\Helpers\get_default_element_config_attributes ;
use function  WPEForm\Helpers\get_default_element_score ;
use function  WPEForm\Helpers\get_mysql_datetime_format ;
use function  WPEForm\Helpers\get_mysql_datetime_from_user_input ;
use function  WPEForm\Helpers\get_user_metavalue ;
use function  WPEForm\Helpers\parse_possible_formula_in_datetime_input ;
use function  WPEForm\Helpers\validate_score_condition_with_datetime ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * DateTime Element class. Datetime Picker.
 *
 * Take user input of date / time.
 */
class DateTimeInput extends Base
{
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function get_definition() : array
    {
        return [
            'title'       => __( 'Datetime Picker', 'wp-eform' ),
            'description' => __( 'Take user input of date / time.', 'wp-eform' ),
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
            'default' => __( 'Datetime Picker', 'wp-eform' ),
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
            'icon'              => FieldVar::var( 'fas fa-calendar-alt', Type::string() ),
            'type'              => FieldVar::var( 'date', Type::string() ),
            'format'            => FieldVar::var( 'mm/dd/yyyy', Type::string() ),
            'timeType'          => FieldVar::var( '12hrs', Type::string() ),
            'dateTimeSeparator' => FieldVar::var( ',', Type::string() ),
            'showInputLabels'   => FieldVar::var( true, Type::boolean() ),
            'hideSeconds'       => FieldVar::var( false, Type::boolean() ),
        ],
            'attributes' => FieldVar::var( get_default_element_config_attributes(), Registry::get( 'attributes', 'type/form/element/config' ), Registry::get( 'attributes', 'input/form/element/config' ) ),
            'score'      => FieldVar::var( get_default_element_score(), Registry::get( 'score', 'type/form/element/config' ), Registry::get( 'score', 'input/form/element/config' ) ),
            'validation' => [
            'required' => FieldVar::var( false, Type::boolean() ),
            'minValue' => FieldVar::var( '', Type::string() ),
            'maxValue' => FieldVar::var( '', Type::string() ),
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
            'input' => FieldVar::var( '', Type::string() ),
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
        return $this->get_validation_error( \__( 'DateTime element requires starter plan or higher, please remove this element from your form.', 'wp-eform' ) );
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
        $selected_value = '';
        $selected_label = '';
        // ENDFS: this if block will be removed
        // if expecting JSON
        if ( $using['return'] === 'json' ) {
            return [
                'input' => ( $using['type'] === 'id' ? $selected_value : $selected_label ),
            ];
        }
        // expecting STRING
        return ( $using['type'] === 'id' ? $selected_value : $selected_label );
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
        // ENDFS: this if block will be removed
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