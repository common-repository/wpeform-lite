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
 * @subpackage WPEForm\Form\Config\Styles
 */

namespace WPEForm\Form\Config\Styles;

use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Form\Config\Base;
use WPEForm\GraphQL\Registry;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Config class for Pagination.
 */
class Pagination extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			// TABS and PROGRESSBAR
			'showTabs' => FieldVar::var(
				true,
				Type::boolean()
			),
			'showProgressBar' => FieldVar::var(
				false,
				Type::boolean()
			),
			'progressDecimalPoint' => FieldVar::var(
				2,
				Type::int()
			),
			'progressBarPosition' => FieldVar::var(
				'top', // top, bottom
				Registry::get( 'settingsAppearanceProgressBarPosition', 'enum' )
			),
			'showProgressLabel' => FieldVar::var(
				true,
				Type::boolean()
			),
			// PROGRESS BEHAVIOR
			'autoProgress' => FieldVar::var( false, Type::boolean() ),
			'autoProgressDelay' => FieldVar::var( 1500, Type::int() ),
			'autoSubmit' => FieldVar::var( false, Type::boolean() ),
			'autoScroll' => FieldVar::var( true, Type::boolean() ),
			'scrollOffset' => FieldVar::var( 100, Type::int() ),
			'blockPreviousNavigation' => FieldVar::var( false, Type::boolean() ),
			'paginationRestriction' => FieldVar::var(
				'onlyWhenAllValid',
				Registry::get( 'formPaginationRestriction', 'enum' )
			),
			// BUTTON PANEL
			'panelEnabled' => FieldVar::var( true, Type::boolean() ),
			// interface
			'alignment' => FieldVar::var(
				'justify',
				Registry::get( 'alignment', 'enum' )
			),
			'size' => FieldVar::var(
				'default',
				Registry::get( 'genericSize', 'enum' )
			),
			// use `core/collections/buttonStyle
			'style' => FieldVar::var( '3d', Type::string() ),
			// if has rounded corner
			'rounded' => FieldVar::var( false, Type::boolean() ),
			// mono-colored or primary-colored
			'colored' => FieldVar::var( false, Type::boolean() ),
			// button group appearance
			'barlike' => FieldVar::var( true, Type::boolean() ),
			// NEXT Button
			'nextLabel' => FieldVar::var( __( 'Next', 'wp-eform' ), Type::string() ),
			'nextIcon' => FieldVar::var( 'fas fa-angle-right', Type::string() ),
			'nextIconPosition' => FieldVar::var(
				'after',
				Registry::get( 'buttonIconPosition', 'enum' )
			),
			// PREV Button
			'prevLabel' => FieldVar::var( __( 'Previous', 'wp-eform' ), Type::string() ),
			'prevIcon' => FieldVar::var( 'fas fa-angle-left', Type::string() ),
			'prevIconPosition' => FieldVar::var(
				'before',
				Registry::get( 'buttonIconPosition', 'enum' )
			),
			// SUBMIT Button
			'submitLabel' => FieldVar::var( __( 'Submit', 'wp-eform' ), Type::string() ),
			'submitIcon' => FieldVar::var( 'fas fa-save', Type::string() ),
			'submitIconPosition' => FieldVar::var(
				'before',
				Registry::get( 'buttonIconPosition', 'enum' )
			),
			// UPDATE Button
			'updateLabel' => FieldVar::var( __( 'Update', 'wp-eform' ), Type::string() ),
			'updateIcon' => FieldVar::var( 'fas fa-save', Type::string() ),
			'updateIconPosition' => FieldVar::var(
				'before',
				Registry::get( 'buttonIconPosition', 'enum' )
			),
			// RESET Button
			'showResetButton' => FieldVar::var( false, Type::boolean() ),
			'resetLabel' => FieldVar::var( __( 'Reset', 'wp-eform' ), Type::string() ),
			'resetMessage' => FieldVar::var(
				__( 'This will reset your form and the action can not be undone. Are you sure?', 'wp-eform' ),
				Type::string()
			),
			'resetIcon' => FieldVar::var( 'fas fa-undo', Type::string() ),
			'resetIconPosition' => FieldVar::var(
				'before',
				Registry::get( 'buttonIconPosition', 'enum' )
			),
			// hide button or simply disable it, disable it by default
			'hideWhenNotRelevant' => FieldVar::var( false, Type::boolean() ),
		];
		return $config_vars;
	}
}
