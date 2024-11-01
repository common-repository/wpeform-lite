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
 * @package WPEForm
 * @subpackage Form\Config\Styles
 */

namespace WPEForm\Form\Config\Styles;

use WPEForm\Form\Config\Base;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\System\Init;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for Theme.
 */
class Theme extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			'scheme' => FieldVar::var(
				Init::$settings['appearance']['defaultTheme'] ?? 'teal',
				Type::string()
			), // Check JS for available ones
			'darkMode' => FieldVar::var(
				Init::$settings['appearance']['darkMode'] ?? 'off',
				Registry::get( 'darkThemeMode', 'enum' )
			),
			'customColorPrimary' => FieldVar::var( null, Type::string() )
				->setNullable( true )
				->setValidator( '\\WPEForm\\Helpers\\validate_is_color_code' ),
			'customColorSecondary' => FieldVar::var( null, Type::string() )
				->setNullable( true )
				->setValidator( '\\WPEForm\\Helpers\\validate_is_color_code' ),
			'customColorBg' => FieldVar::var( null, Type::string() )
				->setNullable( true )
				->setValidator( '\\WPEForm\\Helpers\\validate_is_color_code' ),
			'customColorText' => FieldVar::var( null, Type::string() )
				->setNullable( true )
				->setValidator( '\\WPEForm\\Helpers\\validate_is_color_code' ),
			'css' => FieldVar::var( '', Type::string() ),
		];
		return $config_vars;
	}
}
