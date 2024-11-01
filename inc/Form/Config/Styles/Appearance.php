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
 * @subpackage WPEForm\Config\Styles
 */

namespace WPEForm\Form\Config\Styles;

use WPEForm\Form\Config\Base;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\System\Init;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for Appearance.
 */
class Appearance extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			// for fluid layout, the form container will grow per screen-size
			// for fixed layout, it will take a width most optimized for appearance
			'containerLayout' => FieldVar::var(
				'fluid', // fluid | fixed
				Registry::get( 'settingsAppearanceContainerLayout', 'enum' )
			),
			'maxWidth' => FieldVar::var(
				'600px',
				Type::string()
			),
			// following three are overridable in individual element config
			// each element's appearance will have an option "overrideControlAppearance"
			// which if enabled, will take into consideration the values of same
			// configs, like appearance.controlType, appearance.controlAlignment etc.
			'controlType' => FieldVar::var(
				Init::$settings['appearance']['defaultControlType'] ?? 'boxy', // material | boxy
				Registry::get( 'settingsAppearanceControlType', 'enum' )
			),
			'controlAlignment' => FieldVar::var(
				'left',
				Registry::get( 'settingsAppearanceControlAlignment', 'enum' )
			),
			'controlLayout' => FieldVar::var(
				'vertical',
				Registry::get( 'settingsAppearanceControlLayout', 'enum' )
			),
			// end overridable.
		];
		return $config_vars;
	}
}
