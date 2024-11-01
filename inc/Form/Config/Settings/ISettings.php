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
 * @subpackage Form\Config\Settings
 */

namespace WPEForm\Form\Config\Settings;

use WPEForm\Form\Config\IConfig;
use WPEForm\Handler\Submission as SubmissionHandler;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Interface for all settings class. These needs additional methods from IConfig
 * to be called during submission create and update.
 */
interface ISettings extends IConfig {
	/**
	 * Run pre-processors from Settings based on stored config. This is where
	 * settings classes can define some of the features needed for processing
	 * elements, like whether or not timer was on etc.
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_preprocessor( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ) : void;

	/**
	 * Do action based on stored config value and elements data. You may choose
	 * to not do anything by simply not writing anything inside it, but most, if
	 * not all of the settings classes are supposed to have some side-effects, like
	 * sending emails, creating PDFs etc.
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_side_effect( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ) : void;

	/**
	 * Run mutation on the submission handler before saving to the database. You
	 * may choose to not do anything as well. Check the Submission Handler to
	 * figure out how data mutations are possible.
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_mutation( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ) : void;

	/**
	 * Controls whether or not this is user facing settings.
	 *
	 * @return bool
	 */
	public function is_user_facing() : bool;
}
