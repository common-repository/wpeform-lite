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
 * @subpackage Form\Config\Permissions
 */

namespace WPEForm\Form\Config\Permissions;

use WPEForm\Form\Config\Base as ConfigBase;
use WPEForm\Form\Config\Permissions\IPermissions;
use WPEForm\Handler\Submission as SubmissionHandler;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Abstract class for all permissions.
 *
 * This extends from the Config Base but also implements IPermissions
 * making do_integration required for all child classes and providing an
 * easy way to write things, instead of writing implements IPermissions for
 * every child classes.
 */
abstract class Base extends ConfigBase implements IPermissions {
	/**
	 * Run pre-save mutations on handler. It is used to check whether the save
	 * can be performed by the controller.
	 *
	 * @param bool              $is_update Whether or not the side effects should be run for update.
	 * @param array             $config Config for the permission class.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 * @return void
	 */
	public function run_presave_mutations( bool $is_update, array $config, SubmissionHandler $handler ) : void {
		// do nothing
	}
}
