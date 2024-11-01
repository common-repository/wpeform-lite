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
 * @subpackage Form\Config\Integrations
 */

namespace WPEForm\Form\Config\Integrations;

use WPEForm\Form\Config\IConfig;
use WPEForm\Handler\Submission as SubmissionHandler;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Interface for all integrations classes. These needs additional methods
 * to actually call the integration during data-save and form admin.
 */
interface IIntegrations extends IConfig {
	/**
	 * Do the integration when the form data is being saved or updated.
	 *
	 * @param SubmissionHandler $handler The submission handler.
	 * @param array             $config    Integration config value as stored in form.
	 * @param bool              $is_update Whether or not this is a submission update.
	 *
	 * @return void
	 */
	public function do_integration( SubmissionHandler $handler, array $config, bool $is_update ) : void;
}
