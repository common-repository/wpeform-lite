<?php
/**
 * Copyright (C) 2022 Swashata Ghosh <swashata@wpquark.com>
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
 * @subpackage CoR\Submission
 */

namespace WPEForm\CoR\Submission;

use WPEForm\Factory\Form\Config\Permissions;
use WPEForm\Form\Config\Permissions\IPermissions;
use WPEForm\Handler\Submission;
use WPEForm\Auth\Form as FormAuth;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Run Permissions Side effects. This should be run after things are saved
 * in the database.
 *
 * @package WPEForm\CoR\Submission
 */
class PermissionsSideEffectsRunner extends Base {
	/**
	 * {@inheritDoc}
	 */
	protected function process_entity( Submission $handler ): void {
		$handler->elements()->throw_if_elements_not_processed();

		$registered_permissions = Permissions::get_registered_configs();

		$form_data = $handler->get_form_data();
		$form_permissions = $form_data['permissions'];

		/** @var IPermissions $p_instance */
		foreach ( $registered_permissions as $p_key => $p_instance ) {
			$p_instance->run_postsave_side_effect(
				$handler->is_update(),
				$form_permissions[ $p_key ],
				$handler->get_form_model(),
				new FormAuth(),
				$handler
			);
		}
	}
}
