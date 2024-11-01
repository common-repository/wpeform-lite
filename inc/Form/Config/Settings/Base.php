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

use WPEForm\Form\Config\Base as ConfigBase;
use WPEForm\Handler\Submission;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Abstract class for all settings.
 *
 * This extends from the Config Base but also implements ISettings
 * making methods required for all child classes.
 */
abstract class Base extends ConfigBase implements ISettings {
	/**
	 * Run pre-processors from Settings based on stored config. This is where
	 * settings classes can define some of the features needed for processing
	 * elements, like whether or not timer was on etc.
	 *
	 * @param Submission $submission_handler Submission handler instance.
	 * @param array      $config             Configuration for this settings.
	 * @param bool       $is_update          Whether or not this is a submission update.
	 * @param bool       $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_preprocessor( Submission $submission_handler, array $config, bool $is_update, bool $admin_update ) : void {}
}
