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

use WPEForm\Exception\InvalidConfigException;
use WPEForm\Auth\IAuth;
use WPEForm\Model\IModel;
use WPEForm\Form\Config\Payments\IPayments;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Factory class for Form Payments.
 */
class Payments extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @var IPayments[]
	 */
	protected static $registered_configs = [];

	/**
	 * Throw if config class is improper. Any config class must implement the
	 * IConfig interface.
	 *
	 * @throws InvalidConfigException If class is not found or is improper.
	 *
	 * @param IPayments $instance Config class fully qualified name.
	 * @return void
	 */
	public static function throw_if_config_instance_is_improper( $instance ) : void {
		// call parent
		parent::throw_if_config_instance_is_improper( $instance );

		// check if this implements IPayments
		if ( ! \in_array(
			'WPEForm\\Form\\Config\\Payments\\IPayments',
			\class_implements( $instance )
		) ) {
			throw new InvalidConfigException(
				\sprintf(
					'The config.payments class %s does not implement \\WPEForm\\Form\\Config\\Payments\\IPayments.',
					\get_class( $instance )
				)
			);
		}
	}

	/**
	 * Call and get the resolved config value from a registered payments class.
	 *
	 * @param string $name Name of the payments class.
	 * @param array  $data Data as received from model.
	 * @param IAuth  $auth Auth instance.
	 * @param IModel $model Model instance.
	 *
	 * @return null|array
	 */
	public static function get_resolved_config_value( string $name, array $data, IAuth $auth, IModel $model ) : ?array {
		/** @var IPayments $instance */
		$instance = static::get_config_instance( $name );
		return $instance->resolver( $data, $auth, $model );
	}
}
