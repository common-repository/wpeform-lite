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
 * @subpackage Form\Config\Styles
 */

namespace WPEForm\Form\Config\Styles;

use WPEForm\Form\Config\Base;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Util\SlateJS;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for Redirection.
 */
class Redirection extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$message = SlateJS::parseHTML(
			'<p>' .
				__( 'You will be redirected in <mentions character="::redirectDelay::"></mentions>. If your browser fails to redirect, then please <a href="%REDIRECT_LINK%">Click Here</a>.', 'wp-eform' ) .
			'</p>'
		);

		$config_vars = [
			'type' => FieldVar::var(
				'none',
				Registry::get( 'redirectType', 'enum' )
			),
			'url' => FieldVar::var( '', Type::string() ),
			'delay' => FieldVar::var( 10, Type::int() ), // in second
			'message' => FieldVar::var(
				$message->getEditorChildrenJSON(),
				Type::string()
			),
			'iframeRedirect' => FieldVar::var( false, Type::boolean() ),
			'scoreTotalLogic' => FieldVar::var(
				[
					[
						'id' => 'default-sct-id',
						'scoreId' => 'default-score',
						'url' => '',
						'from' => 0,
						'to' => 10,
					],
				],
				Type::listOf(
					Type::nonNull(
						Registry::get( 'scoreTotalRedirectionItem', 'type/form' )
					)
				),
				Type::listOf(
					Type::nonNull(
						Registry::get( 'scoreTotalRedirectionItem', 'input/form' )
					)
				)
			),
			'scorePercentageLogic' => FieldVar::var(
				[
					[
						'id' => 'default-sct-id',
						'scoreId' => 'default-score',
						'url' => '',
						'from' => 0,
						'to' => 10,
					],
				],
				Type::listOf(
					Type::nonNull(
						Registry::get( 'scorePercentageRedirectionItem', 'type/form' )
					)
				),
				Type::listOf(
					Type::nonNull(
						Registry::get( 'scorePercentageRedirectionItem', 'input/form' )
					)
				)
			),
			'conditionalLogic' => FieldVar::var(
				[],
				Type::listOf(
					Type::nonNull(
						Registry::get( 'scoreConditionalRedirectionItem', 'type/form' )
					)
				),
				Type::listOf(
					Type::nonNull(
						Registry::get( 'scoreConditionalRedirectionItem', 'input/form' )
					)
				)
			),
		];
		return $config_vars;
	}
}
