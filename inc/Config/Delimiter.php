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
 * @subpackage Config
 */

namespace WPEForm\Config;

use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A delimiter configuration class.
 *
 * @package WPEForm\Config
 */
class Delimiter {
	/**
	 * Delimiter for options.
	 *
	 * @var string
	 */
	protected $option;
	/**
	 * Delimiter for rows.
	 *
	 * @var string
	 */
	protected $row;
	/**
	 * Delimiter for range.
	 *
	 * @var string
	 */
	protected $range;
	/**
	 * Delimiter for entry.
	 *
	 * @var string
	 */
	protected $entry;

	/**
	 * Create an instance.
	 *
	 * @param array{option: string, row: string, range: string, entry: string} $delimiter The delimiter in array format.
	 */
	public function __construct( array $delimiter ) {
		$delimiter = parse_args(
			$delimiter,
			[
				'option' => ',',
				'row' => "\n",
				'range' => '-',
				'entry' => "\n\n",
			]
		);
		$this->option = $delimiter['option'];
		$this->row = $delimiter['row'];
		$this->range = $delimiter['range'];
		$this->entry = $delimiter['entry'];
	}

	/**
	 * Get row delimiter.
	 *
	 * @return string
	 */
	public function row() : string {
		return $this->row;
	}

	/**
	 * Get option delimiter.
	 *
	 * @return string
	 */
	public function option() : string {
		return $this->option;
	}

	/**
	 * Get range delimiter.
	 *
	 * @return string
	 */
	public function range() : string {
		return $this->range;
	}

	/**
	 * Get entry delimiter.
	 *
	 * @return string
	 */
	public function entry() : string {
		return $this->entry;
	}
}
