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

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

/**
 * GraphQL Type `FormTemplateNodeType`.
 *
 * @package WPEForm\GraphQL\Type
 */
class FormTemplateNode extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$config = [
			'name' => 'FormTemplateNodeType',
			'description' => 'Form templates for easy starting.',
			'fields' => [
				'templateId' => Type::nonNull( Type::id() ),
				'name' => Type::nonNull( Type::string() ),
				'plan' => Type::nonNull( Type::string() ),
			],
		];
		parent::__construct( $config );
	}
}
