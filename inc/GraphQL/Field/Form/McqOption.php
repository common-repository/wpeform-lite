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
 * @subpackage GraphQL\Field
 */

namespace WPEForm\GraphQL\Field\Form;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Field\Base;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Fields for MCQ Option, like Checkbox, Radio and Dropdown element.
 */
class McqOption extends Base {
	/**
	 * Static variable to hold single instance of Type.
	 *
	 * @var array
	 */
	protected static $type_fields = null;

	/**
	 * Static variable to hold single instance of InputType.
	 *
	 * @var array
	 */
	protected static $input_fields = null;

	/**
	 * {@inheritDoc}
	 *
	 * @return array Array of Scalar Types.
	 */
	public static function common_fields() {
		return [
			'id' => Type::nonNull( Type::id() ),
			// would be slateJSON of singleLine RichTextEditor
			'label' => Type::nonNull( Type::string() ),
			// this will also be slatejs JSON and show up in answers as description
			'answerDescription' => Type::string(), // html can be null
			'num' => Type::float(), // numeric value can be null
			// score and default should be handled by generic configs
		];
	}
}
