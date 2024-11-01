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
 * @subpackage Form\Config\Permission
 */

namespace WPEForm\Form\Config\Permissions;

use WPEForm\Form\Config\IConfig;
use WPEForm\Model\Form as FormModel;
use WPEForm\Auth\Form as FormAuth;
use WPEForm\Handler\Submission as SubmissionHandler;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Interface for all permission classes. These needs additional methods
 * to actually call the integration during data-save and form admin.
 */
interface IPermissions extends IConfig {
	/**
	 * Get preemptive limitation for a form, without any submission data.
	 *
	 * @param array     $config Config for the permission class.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array Limitations array. Check GraphQL type FormLimitationMessage for shape.
	 */
	public function get_preemptive_limitations( array $config, FormModel $model, FormAuth $auth ) : array;

	/**
	 * Get preemptive notices for a form, without any submission data.
	 *
	 * @param array     $config Config for the permission class.
	 * @param FormModel $model Form Model.
	 * @param FormAuth  $auth Form Auth.
	 *
	 * @return array Notices array. Check GraphQL type FormLimitationMessage for shape.
	 */
	public function get_preemptive_notices( array $config, FormModel $model, FormAuth $auth ) : array;

	/**
	 * Get limitations of a form, after submission data is processed, but before
	 * saving them. Useful for things like IP/Email etc based limitations.
	 *
	 * @param array             $config Config for the permission class.
	 * @param FormModel         $model Form Model.
	 * @param FormAuth          $auth Form Auth.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 *
	 * @return array Notices array. Check GraphQL type FormLimitationMessage for shape.
	 */
	public function get_postsubmission_limitations( array $config, FormModel $model, FormAuth $auth, SubmissionHandler $handler ) : array;

	/**
	 * Run pre-save mutations on handler. It is used to check whether the save
	 * can be performed by the controller.
	 *
	 * @param bool              $is_update Whether or not the side effects should be run for update.
	 * @param array             $config Config for the permission class.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 * @return void
	 */
	public function run_presave_mutations( bool $is_update, array $config, SubmissionHandler $handler ) : void;

	/**
	 * Run Side effects after saving data to database. This is still done before
	 * sending anything to the client, so we can have cookies access here.
	 *
	 * @param bool              $is_update Whether or not the side effects should be run for update.
	 * @param array             $config Config for the permission class.
	 * @param FormModel         $model Form Model.
	 * @param FormAuth          $auth Form Auth.
	 * @param SubmissionHandler $handler Submission Handler instance.
	 *
	 * @return void
	 */
	public function run_postsave_side_effect( bool $is_update, array $config, FormModel $model, FormAuth $auth, SubmissionHandler $handler ) : void;
}
