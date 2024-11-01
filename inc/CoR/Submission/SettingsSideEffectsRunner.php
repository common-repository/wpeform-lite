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

use WPEForm\Factory\Form\Config\Settings;
use WPEForm\Handler\Submission;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Process all settings by calling each of the registered settings with
 * elements and their side effects.
 *
 * @package WPEForm\CoR\Submission
 */
class SettingsSideEffectsRunner extends Base {
	/**
	 * {@inheritDoc}
	 */
	protected function process_entity( Submission $handler ): void {
		$handler->elements()->throw_if_elements_not_processed();

		$registered_settings = Settings::get_registered_configs();

		$form_data = $handler->get_form_data();
		$form_settings = $form_data['settings'];

		// Loop over all registered Settings config
		/** @var ISettings $s_instance */
		foreach ( $registered_settings as $s_key => $s_instance ) {
			// call run side effect on each and every one of them
			$s_instance->run_side_effect(
				$handler,
				$form_settings[ $s_key ],
				$handler->is_update(),
				$handler->is_admin_update()
			);
		}
	}
}
