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
 * @subpackage GraphQL\Type
 */

namespace WPEForm\GraphQL\Type;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class for PageInfoType
 */
class PageInfo extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'PageInfoType',
			'fields' => [
				'hasNextPage' => Type::nonNull( Type::boolean() ),
				'hasPreviousPage' => Type::nonNull( Type::boolean() ),
				'endCursor' => Type::id(),
				'startCursor' => Type::id(),
			],
		];
		parent::__construct( $config );
	}
}
