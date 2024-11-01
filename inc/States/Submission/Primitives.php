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

use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * State and builder for supported primitives on Submission handler.
 *
 * @package WPEForm\States\Submission
 */
class Primitives extends Base {
	const TYPE_FNAME = 'fName';
	const TYPE_LNAME = 'lName';
	const TYPE_EMAIL = 'email';
	const TYPE_PHONE = 'phone';
	const TYPE_IP = 'ip';
	const TYPE_USERID = 'userId';

	/**
	 * Primitives of the submission. They usually correspond to some direct db
	 * table column.
	 *
	 * @var array
	 */
	private $primitives = [
		self::TYPE_FNAME => null,
		self::TYPE_LNAME => null,
		self::TYPE_EMAIL => null,
		self::TYPE_PHONE => null,
		self::TYPE_IP => null,
		self::TYPE_USERID => null,
	];

	/**
	 * Get a primitive value from the handler.
	 *
	 * @throws LogicException If passed in `$primitive` isn't valid.
	 *
	 * @param string $primitive The primitive, one of `PrimitivesStateBuilder::TYPE_*`.
	 *
	 * @return string|null
	 */
	public function get_primitive( string $primitive ) : ?string {
		$this->throw_if_not_valid_primitive( $primitive );

		return $this->primitives[ $primitive ];
	}

	/**
	 * Get a primitive value on the handler.
	 *
	 * @throws LogicException If passed in `$primitive` isn't valid.
	 *
	 * @param string      $primitive The primitive, `fName`, `lName`, `email`, `phone`
	 *                               or `ip`.
	 * @param string|null $value     The value of the primitive.
	 *
	 * @return void
	 */
	public function set_primitive( string $primitive, ?string $value ) : void {
		$this->throw_if_not_valid_primitive( $primitive );

		$this->primitives[ $primitive ] = $value;
	}

	/**
	 * Throw if the passed in `$primitive` isn't a valid one.
	 *
	 * @throws LogicException If passed in `$primitive` isn't valid.
	 *
	 * @param string $primitive The primitive.
	 *
	 * @return void
	 */
	public function throw_if_not_valid_primitive( string $primitive ) : void {
		if ( ! \array_key_exists( $primitive, $this->primitives ) ) {
			throw new LogicException( "{$primitive} is not a valid primitive." );
		}
	}
}
