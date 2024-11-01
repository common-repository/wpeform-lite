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
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for CustomBackground.
 */
class CustomBackground extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			'enabled' => FieldVar::var( false, Type::boolean() ), // Whether to do bg mods
			'backgroundImage' => FieldVar::var( '', Type::string() ), // uploader
			'backgroundPosition' => FieldVar::var( '0% 0%', Type::string() ), // text
			'backgroundSize' => FieldVar::var( 'auto', Type::string() ), // text
			'backgroundRepeat' => FieldVar::var(
				'repeat',
				Registry::get( 'formSettingsBackgroundRepeat', 'enum' )
			), // select
			'backgroundOrigin' => FieldVar::var(
				'padding-box',
				Registry::get( 'formSettingsBackgroundOriginAndClip', 'enum' )
			), // select
			'backgroundClip' => FieldVar::var(
				'border-box',
				Registry::get( 'formSettingsBackgroundOriginAndClip', 'enum' )
			), // select
			'backgroundAttachment' => FieldVar::var(
				'scroll',
				Registry::get( 'formSettingsBackgroundAttachment', 'enum' )
			), // select
		];
		return $config_vars;
	}
}
