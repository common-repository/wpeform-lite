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

use  WPEForm\GeneralDeps\GraphQL\Type\Definition\Type ;
use  WPEForm\GraphQL\Registry ;
use  WPEForm\GraphQL\Util\FieldVar ;
use  WPEForm\GraphQL\Util\TypeOrInputFromFields ;
use  WPEForm\System\Init ;
use  WPEForm\Util\SlateJS ;
use  Exception ;
use function  WPEForm\Helpers\get_default_element_config_attributes ;
use function  WPEForm\Helpers\get_default_element_score ;
use function  WPEForm\Helpers\uuid4 ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Sortable Element class. Sortable List.
 *
 * List of items which can be sorted by the form submitter.
 */
class Sortable extends Base
{
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function get_definition() : array
    {
        return [
            'title'       => __( 'Sortable List', 'wp-eform' ),
            'description' => __( 'List of items which can be sorted by the form submitter.', 'wp-eform' ),
            'container'   => false,
            'category'    => 'choice',
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
            'default' => __( 'Sortable List element', 'wp-eform' ),
        ],
        ];
    }
    
    /**
     * Get default sortable items.
     *
     * @return array Sortable items, a list of FormElementSortableItemInput.
     */
    public static function get_default_sortable_items() : array
    {
        static  $items = [] ;
        if ( empty($items) ) {
            for ( $i = 0 ;  $i < 5 ;  $i++ ) {
                $items[] = [
                    'itemId' => uuid4(),
                    'label'  => \sprintf( \__( 'Sortable item %1$d', 'wp-eform' ), $i + 1 ),
                ];
            }
        }
        return $items;
    }
    
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function config_vars() : array
    {
        $sortable_item = [
            'itemId' => Type::nonNull( Type::id() ),
            'label'  => Type::nonNull( Type::string() ),
        ];
        [ $sortable_item_type, $sortable_item_input ] = TypeOrInputFromFields::create_type_and_input( $sortable_item, 'FormElementSortableItem' );
        return [
            'interface'  => [
            'lockVertically' => FieldVar::var( false, Type::boolean() ),
            'items'          => FieldVar::var( self::get_default_sortable_items(), Type::listOf( Type::nonNull( $sortable_item_type ) ), Type::listOf( Type::nonNull( $sortable_item_input ) ) ),
            'shuffle'        => FieldVar::var( false, Type::boolean() ),
        ],
            'attributes' => FieldVar::var( get_default_element_config_attributes(), Registry::get( 'attributes', 'type/form/element/config' ), Registry::get( 'attributes', 'input/form/element/config' ) ),
            'score'      => FieldVar::var( get_default_element_score(), Registry::get( 'score', 'type/form/element/config' ), Registry::get( 'score', 'input/form/element/config' ) ),
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
            'order' => FieldVar::var( [], Type::listOf( Type::nonNull( Type::id() ) ) ),
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
            return [
                'order' => [],
            ];
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
        return \json_encode( $data );
    }

}