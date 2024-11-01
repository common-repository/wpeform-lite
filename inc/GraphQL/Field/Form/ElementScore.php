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
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GraphQL\Field\Base;
use WPEForm\GraphQL\Registry;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Fields for Element => 'score'
 */
class ElementScore extends Base {
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
		return [];
	}

	/**
	 * Get scoreConditins individual item fields.
	 *
	 * {@internal Used for dynamically creating ObjectType or InputObjectType}
	 *
	 * @return array
	 */
	protected static function get_score_conditions_field() : array {
		return [
			'id' => Type::nonNull( Type::id() ),
			'condition' => Type::nonNull( Registry::get( 'eventComparison', 'enum' ) ),
			'operation' => Type::nonNull( Registry::get( 'eventOperation', 'enum' ) ),
			'compareWith' => Type::nonNull( Type::string() ),
			'scoreId' => Type::nonNull( Type::id() ),
			'scoreOperation' => Type::nonNull( Registry::get( 'scoreOperation', 'enum' ) ),
			'scoreValue' => Type::nonNull( Type::float() ),
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function type_fields() {
		return [
			'scoreConditions' => Type::nonNull(
				Type::listOf(
					Type::nonNull(
						new ObjectType(
							[
								'name' => 'ElementScoreConditionType',
								'fields' => self::get_score_conditions_field(),
							]
						)
					)
				)
			),
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function input_fields() {
		return [
			'scoreConditions' => Type::nonNull(
				Type::listOf(
					Type::nonNull(
						new InputObjectType(
							[
								'name' => 'ElementScoreConditionInput',
								'fields' => self::get_score_conditions_field(),
							]
						)
					)
				)
			),
		];
	}
}
