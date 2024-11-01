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
use WPEForm\Form\Config\Permissions\IPermissions;
use WPEForm\Model\Form as FormModel;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\Handler\Submission as SubmissionHandler;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Factory class for Form Permissions.
 */
class Permissions extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @var IPermissions[]
	 */
	protected static $registered_configs = [];

	/**
	 * Throw if config class is improper. Any config class must implement the
	 * IConfig interface.
	 *
	 * @throws InvalidConfigException If class is not found or is improper.
	 *
	 * @param IPermissions $instance Config class fully qualified name.
	 * @return void
	 */
	public static function throw_if_config_instance_is_improper( $instance ) : void {
		// call parent
		parent::throw_if_config_instance_is_improper( $instance );

		// check if this implements IPermissions
		if ( ! \in_array(
			'WPEForm\\Form\\Config\\Permissions\\IPermissions',
			\class_implements( $instance )
		) ) {
			throw new InvalidConfigException(
				\sprintf(
					'The config.permission class %s does not implement \\WPEForm\\Form\\Config\\Permissions\\IPermissions.',
					\get_class( $instance )
				)
			);
		}
	}

	/**
	 * Get all pre emptive notices from the registered permissions classes.
	 *
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array Notices Array FormLimitationMessage[]
	 */
	public static function get_preemptive_notices( FormModel $model, FormAuth $auth ) : array {
		$notices = [];

		$registered_permissions = self::get_registered_configs();
		$form_data = $model->read();
		$form_permissions = $form_data['permissions'];

		/** @var IPermissions $p_instance */
		foreach ( $registered_permissions as $p_key => $p_instance ) {
			$new_notices = $p_instance->get_preemptive_notices(
				$form_permissions[ $p_key ],
				$model,
				$auth
			);
			if ( ! empty( $new_notices ) ) {
				$notices = \array_merge( $notices, $new_notices );
			}
		}

		return $notices;
	}

	/**
	 * Get all pre emptive limitations from the registered permissions classes.
	 *
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array Limitations Array FormLimitationMessage[]
	 */
	public static function get_preemptive_limitations( FormModel $model, FormAuth $auth ) : array {
		$limitations = [];

		$registered_permissions = self::get_registered_configs();
		$form_data = $model->read();
		$form_permissions = $form_data['permissions'];

		/** @var IPermissions $p_instance */
		foreach ( $registered_permissions as $p_key => $p_instance ) {
			$new_limitations = $p_instance->get_preemptive_limitations(
				$form_permissions[ $p_key ],
				$model,
				$auth
			);
			if ( ! empty( $new_limitations ) ) {
				$limitations = \array_merge( $limitations, $new_limitations );
			}
		}

		return $limitations;
	}

	/**
	 * Get post submission limitations from all registered Permissions Config.
	 *
	 * @param FormModel         $model Form Model.
	 * @param FormAuth          $auth Form Auth.
	 * @param SubmissionHandler $handler Submission Handler.
	 *
	 * @return array Limitations.
	 */
	public static function get_postsubmission_limitations( FormModel $model, FormAuth $auth, SubmissionHandler $handler ) : array {
		$limitations = [];

		$registered_permissions = self::get_registered_configs();
		$form_data = $model->read();
		$form_permissions = $form_data['permissions'];

		/** @var IPermissions $p_instance */
		foreach ( $registered_permissions as $p_key => $p_instance ) {
			$new_limitations = $p_instance->get_postsubmission_limitations(
				$form_permissions[ $p_key ],
				$model,
				$auth,
				$handler
			);
			if ( ! empty( $new_limitations ) ) {
				$limitations = \array_merge( $limitations, $new_limitations );
			}
		}

		return $limitations;
	}
}
