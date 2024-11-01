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
 * @subpackage Form\Config\Integrations
 */
namespace WPEForm\Form\Config\Integrations;

use  WPEForm\GeneralDeps\GraphQL\Type\Definition\Type ;
use  WPEForm\GraphQL\Registry ;
use  WPEForm\GraphQL\Util\FieldVar ;
use  WPEForm\GraphQL\Util\TypeOrInputFromFields ;
use  WPEForm\PremiumDeps\DrewM\MailChimp\MailChimp as McApi ;
use  WPEForm\Exception\InvalidIntegrationException ;
use  WPEForm\Handler\Submission as SubmissionHandler ;
use  Exception ;
use  WPEForm\System\Init ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Class for MailChimp Integrations.
 */
class MailChimp extends Base
{
    /**
     * {@inheritDoc}
     *
     * @return array
     */
    protected function config_vars() : array
    {
        $config_vars = [
            'enabled'     => FieldVar::var( false, Type::boolean() ),
            'apiKey'      => FieldVar::var( '', Type::string() ),
            'listIds'     => FieldVar::var( [], Type::listOf( Type::nonNull( Type::id() ) ) )->setNullable( false ),
            'tags'        => FieldVar::var( '', Type::string() )->setNullable( false ),
            'doubleOptIn' => FieldVar::var( true, Type::boolean() ),
            'customData'  => FieldVar::var( [], Type::listOf( Type::nonNull( Registry::get( 'integrationCustomData', 'type/form' ) ) ), Type::listOf( Type::nonNull( Registry::get( 'integrationCustomData', 'input/form' ) ) ) )->setValidator( 'WPEForm\\Helpers\\validate_list_items_with_id_key' ),
        ];
        return $config_vars;
    }
    
    /**
     * {@inheritDoc}
     *
     * @param array $config Original config.
     * @return array Normalized config.
     */
    public function normalize_on_export( array $config ) : array
    {
        $new_config = $this->get_default_config_value();
        $new_config['doubleOptIn'] = $config['doubleOptIn'];
        $new_config['customData'] = $config['customData'];
        return $new_config;
    }
    
    /**
     * Get mailchimp lists items.
     *
     * @throws InvalidIntegrationException If there's an issue in mailchimp.
     *
     * @param string $api_key API key for MailChimp account.
     *
     * @return array
     */
    protected function get_mailchimp_lists( string $api_key ) : array
    {
        // ENDFS: this if block will be removed
        return [];
    }
    
    /**
     * Create and get query fields for this integration.
     * Return null, if this doesn't create any query fields.
     *
     * @return array|null
     */
    protected function query_fields() : ?array
    {
        $mailchimpList = [
            'id'   => FieldVar::var( '', Type::id() ),
            'name' => FieldVar::var( '', Type::string() ),
        ];
        return [
            'mailchimpLists' => [
            'type'    => Type::nonNull( Type::listOf( TypeOrInputFromFields::create_type( $mailchimpList, 'FormIntegrationMailChimpListItem' ) ) ),
            'args'    => [
            'apiKey' => Type::nonNull( Type::id() ),
        ],
            'resolve' => function ( $root, $args ) {
            return $this->get_mailchimp_lists( $args['apiKey'] );
        },
        ],
        ];
    }
    
    /**
     * Do the integration when the form data is being saved or updated.
     *
     * @param SubmissionHandler $handler The submission handler.
     * @param array             $config    Integration config value as stored in form.
     * @param bool              $is_update Whether or not this is a submission update.
     *
     * @return void
     */
    public function do_integration( SubmissionHandler $handler, array $config, bool $is_update ) : void
    {
        // ENDFS: this if block will be removed
    }

}