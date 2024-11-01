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
 * @package EForm
 * @subpackage GraphQL\Type\Form\Element
 */

namespace WPEForm\GraphQL\Type\Form\Element;

use WPEForm\GraphQL\Field\FormElementMatrixRowColumn;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class for FormElementMatrixRowColumnType.
 *
 * @package WPEForm\GraphQL\Type\Form\Element
 */
class MatrixRowColumn extends ObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		parent::__construct(
			[
				'name' => 'FormElementMatrixRowColumnType',
				'fields' => FormElementMatrixRowColumn::get_type_fields(),
			]
		);
	}
}
