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
 * Fields for Conditional/Logic Event.
 */
class Event extends Base {
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
			'fieldid' => [
				'type' => Type::nonNull( Type::id() ),
				'description' => __( 'Element Id for the event', 'wp-eform' ),
			],
			'has' => [
				'type' => Type::nonNull( Registry::get( 'eventHas', 'enum' ) ),
				'description' => __( 'Compare against for the event.', 'wp-eform' ),
			],
			'operation' => [
				'type' => Type::nonNull( Registry::get( 'eventOperation', 'enum' ) ),
				'description' => __( 'Is or is not operation.', 'wp-eform' ),
			],
			'operator' => [
				'type' => Type::nonNull( Registry::get( 'eventComparison', 'enum' ) ),
				'description' => __( 'Comparison operator for the event.', 'wp-eform' ),
			],
			'value' => [
				'type' => Type::string(),
				'description' => __( 'Comparison against value.', 'wp-eform' ),
			],
			'relation' => [
				'type' => Type::nonNull( Registry::get( 'eventRelation', 'enum' ) ),
				'description' => __( 'Logical relation with next event.', 'wp-eform' ),
			],
		];
	}
}
