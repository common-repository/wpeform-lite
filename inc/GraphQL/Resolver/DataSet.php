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
 * @subpackage GraphQL\Resolver
 */

namespace WPEForm\GraphQL\Resolver;

use WPEForm\Controller\Form as FormController;
use WPEForm\Model\Form as FormModel;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\Exception\InsufficientPermissionException;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\Util\DataSet\DataSet as DataSetDataSet;
use WPEForm\Util\FormTemplate as UtilFormTemplate;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to provide resolver for all DataSet related queries.
 *
 * @package WPEForm\GraphQL\Resolver
 */
class DataSet implements IResolver {
	/**
	 * Get all query fields for root query.
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'dataSetAllItems' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'dataSet', 'type' ) )
					)
				),
				'args' => [
					'dataSetId' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$data_set = new DataSetDataSet();
					return $data_set->read( $args['dataSetId'] );
				},
			],
			'dataSetItem' => [
				'type' => Registry::get( 'dataSet', 'type' ),
				'args' => [
					'dataSetId' => Type::nonNull( Type::id() ),
					'itemId' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$data_set = new DataSetDataSet();
					return $data_set->read( $args['dataSetId'], $args['itemId'] );
				},
			],
		];
	}

	/**
	 * Get all Mutation fields for root Mutation.
	 *
	 * @return array
	 */
	public static function get_mutation_fields() {
		return [];
	}
}
