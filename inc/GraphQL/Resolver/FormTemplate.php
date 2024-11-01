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
use WPEForm\Util\FormTemplate as UtilFormTemplate;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to provide all resolvers for formTemplate related queries and mutations.
 *
 * @package WPEForm\GraphQL\Resolver
 */
class FormTemplate implements IResolver {
	/**
	 * {@inheritDoc}
	 *
	 * @return FormController
	 */
	public static function get_controller() {
		return new FormController(
			new FormModel(),
			new FormAuth()
		);
	}

	/**
	 * Get all query fields for root query.
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'formTemplates' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'formTemplate', 'type' ) )
					)
				),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$auth = new FormAuth();
					if ( ! $auth->can_current_user_create() ) {
						throw new InsufficientPermissionException(
							'Current user cannot read form templates.'
						);
					}
					$templates = new UtilFormTemplate();
					return $templates->get_templates();
				},
			],
			'previewFormTemplate' => [
				'type' => Type::nonNull( Registry::get( 'form', 'type' ) ),
				'args' => [
					'templateId' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$auth = new FormAuth();
					if ( ! $auth->can_current_user_create() ) {
						throw new InsufficientPermissionException(
							'Current user cannot read form templates.'
						);
					}
					$template = new UtilFormTemplate();
					$template_id = $args['templateId'];
					$template_content = $template->read_template( $template_id );
					$controller = self::get_controller();
					return $controller->get_template_data( $template_content );
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
		return [
			'createFormFromTemplate' => [
				'type' => Type::nonNull( Type::id() ),
				'args' => [
					'templateId' => Type::nonNull( Type::id() ),
				],
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					$auth = new FormAuth();
					if ( ! $auth->can_current_user_create() ) {
						throw new InsufficientPermissionException(
							'Current user cannot read form templates.'
						);
					}
					$template = new UtilFormTemplate();
					$template_id = $args['templateId'];
					$template_content = $template->read_template( $template_id );
					$controller = self::get_controller();
					return $controller->import( $template_content );
				},
			],
		];
	}
}
