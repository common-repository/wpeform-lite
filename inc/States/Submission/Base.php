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
 * @subpackage States\Submission
 */

namespace WPEForm\States\Submission;

use WPEForm\Handler\Submission;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Base abstract class.
 *
 * @package WPEForm\States\Submission
 */
abstract class Base {
	/**
	 * @var Submission
	 */
	protected $submission_handler;

	/**
	 * Constructor.
	 *
	 * @param Submission $submission_handler The submission handler.
	 */
	public function __construct( Submission $submission_handler ) {
		$this->submission_handler = $submission_handler;
	}
}
