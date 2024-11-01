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
 * @subpackage Factory\Form\Config
 */

namespace WPEForm\Factory\Form\Config;

use WPEForm\Form\Config\Settings\ISettings;
use WPEForm\Exception\InvalidConfigException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Factory class for Form Settings.
 */
class Settings extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @var ISettings[]
	 */
	protected static $registered_configs = [];

	/**
	 * Throw if config class is improper. Any config class must implement the
	 * IConfig interface.
	 *
	 * @throws InvalidConfigException If class is not found or is improper.
	 *
	 * @param ISettings $instance Config class fully qualified name.
	 * @return void
	 */
	public static function throw_if_config_instance_is_improper( $instance ) : void {
		// call parent
		parent::throw_if_config_instance_is_improper( $instance );

		// check if this implements ISettings
		if ( ! \in_array(
			'WPEForm\\Form\\Config\\Settings\\ISettings',
			\class_implements( $instance )
		) ) {
			throw new InvalidConfigException(
				\sprintf(
					'The config.settings class %s does not implement \\WPEForm\\Form\\Config\\Settings\\ISettings.',
					\get_class( $instance )
				)
			);
		}
	}
}