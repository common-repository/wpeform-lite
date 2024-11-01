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

use WPEForm\Factory\Form\Config\Integrations;
use WPEForm\Form\Config\Integrations\IIntegrations;
use WPEForm\Handler\Submission;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Process integrations for a submission. It expects the elements data to be
 * processed.
 *
 * @package WPEForm\CoR\Submission
 */
class IntegrationsRunner extends Base {
	/**
	 * {@inheritDoc}
	 */
	protected function process_entity( Submission $handler ): void {
		$handler->elements()->throw_if_elements_not_processed();

		$registered_integrations = Integrations::get_registered_configs();

		$form_data = $handler->get_form_data();
		$form_integrations = $form_data['integrations'];

		// Loop through all integrations and
		/** @var IIntegrations $i_instance */
		foreach ( $registered_integrations as $i_key => $i_instance ) {
			// Call integration with the element data passed
			$i_instance->do_integration(
				$handler,
				$form_integrations[ $i_key ],
				$handler->is_update()
			);
		}
	}
}
