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
use WPEForm\GraphQL\Field\Base;
use WPEForm\GraphQL\Registry;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Fields for ScoreDesignation.
 */
class ScoreDesignation extends Base {
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
			'scoreCategory' => [
				'type' => Type::nonNull( Type::id() ),
				'description' => __( 'which category of score the designation works on', 'wp-eform' ),
			],
			'fromToType' => [
				'type' => Type::nonNull( Registry::get( 'ScoreFromToType', 'enum' ) ),
				'description' => __( 'type of from and to, value or percentage', 'wp-eform' ),
			],
			'from' => [
				'type' => Type::nonNull( Type::float() ),
				'description' => __( 'min score', 'wp-eform' ),
			],
			'to' => [
				'type' => Type::nonNull( Type::float() ),
				'description' => __( 'max score', 'wp-eform' ),
			],
			'name' => [
				'type' => Type::nonNull( Type::string() ),
				'description' => __( 'name of designation', 'wp-eform' ),
			],
			'description' => [
				'type' => Type::nonNull( Type::string() ),
				'description' => __( 'description of designation', 'wp-eform' ),
			],
		];
	}
}
