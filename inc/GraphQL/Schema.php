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
 * @subpackage GraphQL
 */

namespace WPEForm\GraphQL;

use WPEForm\GeneralDeps\GraphQL\Type\SchemaConfig;
use WPEForm\GeneralDeps\GraphQL\Type\Schema as GQLSchema;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A helper class to get Schema for our GraphQL server.
 */
class Schema {
	/**
	 * An instance of GraphQL\Type\Schema
	 *
	 * @var GQLSchema
	 */
	protected static $schema = null;

	/**
	 * Get Schema for EForm GraphQL Server.
	 *
	 * @return GQLSchema
	 */
	public static function get_schema() : GQLSchema {
		if ( null === self::$schema ) {
			$schema_config = SchemaConfig::create()
				->setQuery( Registry::get( 'query', 'type' ) )
				->setMutation( Registry::get( 'mutation', 'type' ) );
			self::$schema = new GQLSchema( $schema_config );
		}
		return self::$schema;
	}
}
