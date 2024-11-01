<?php
/**
 * Copyright (C) 2018-Current Swashata Ghosh <swashata@wpquark.com>
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
 * @subpackage GraphQL\Type\FormMeta
 */

namespace WPEForm\GraphQL\Type\FormMeta;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for FormMetaElementType
 */
class Element extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormMetaElementType',
			'fields' => [
				'type' => Type::nonNull( Type::string() ),
				'defaultConfig' => Type::nonNull(
					Registry::get( 'config', 'type/form/element' )
				),
				'definition' => Type::nonNull(
					Registry::get( 'definition', 'type/formMeta' )
				),
				'defaultAppearance' => Type::nonNull(
					Registry::get( 'appearance', 'type/form/element' )
				),
				'acceptedChildren' => Type::nonNull(
					Type::listOf( Type::nonNull( Type::id() ) )
				),
				'unacceptedChildren' => Type::nonNull(
					Type::listOf( Type::nonNull( Type::id() ) )
				),
				'defaultDataValue' => Type::nonNull(
					Registry::get( 'value', 'type/submission/element' )
				),
			],
		];
		parent::__construct( $config );
	}
}