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
 * GraphQL Type for `HeadlessGlobalsType`.
 *
 * @package WPEForm\GraphQL\Type
 */
class HeadlessGlobals extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$freemius = new ObjectType(
			[
				'name' => 'HeadlessGlobalsFreemiusType',
				'fields' => [
					'canUsePremiumCode' => Type::nonNull( Type::boolean() ),
					'isPlanBusinessOnly' => Type::nonNull( Type::boolean() ),
					'isPlanBusinessOrHigher' => Type::nonNull( Type::boolean() ),
					'isPlanProfessionalOnly' => Type::nonNull( Type::boolean() ),
					'isPlanProfessionalOrHigher' => Type::nonNull( Type::boolean() ),
					'isPlanStarterOnly' => Type::nonNull( Type::boolean() ),
					'isPlanStarterOrHigher' => Type::nonNull( Type::boolean() ),
					'isTrial' => Type::nonNull( Type::boolean() ),
				],
			]
		);
		$config = [
			'name' => 'HeadlessGlobalsType',
			'fields' => [
				'appVersion' => Type::nonNull( Type::string() ),
				'freemius' => Type::nonNull( $freemius ),
				'gqlUri' => Type::nonNull( Type::string() ),
				'userPortal' => Type::nonNull( Type::string() ),
				'summaryPage' => Type::nonNull( Type::string() ),
			],
		];
		parent::__construct( $config );
	}
}
