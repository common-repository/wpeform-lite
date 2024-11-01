<?php
/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
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
 * @subpackage Util
 */

namespace WPEForm\Util;

use function WPEForm\Helpers\format_number;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A simple PDF friendly HTML charting library.
 *
 * @package WPEForm\Util
 */
class HTMLChart {
	/**
	 * Plots array.
	 *
	 * @var array
	 */
	protected $plots = [];

	/**
	 * Precisions.
	 *
	 * @var int
	 */
	protected $precisions = 2;

	/**
	 * Create an instance.
	 *
	 * @param int $precisions Decimal precision of value.
	 */
	public function __construct( int $precisions = 2 ) {
		$this->precisions = $precisions;
	}

	/**
	 * Add a plot to the graph.
	 *
	 * @param string $label Label of the plot.
	 * @param float  $percentage_value Percentage value of the plot.
	 * @param string $color Plot color.
	 * @return $this Instance.
	 */
	public function add_plot( string $label, float $percentage_value, string $color ) : HTMLChart {
		$this->plots[] = [
			'label' => $label,
			'value' => $percentage_value,
			'color' => $color,
		];
		return $this;
	}

	/**
	 * Whether or not a graph can be rendered with the plots.
	 *
	 * @return bool
	 */
	public function has_graph() : bool {
		return \count( $this->plots ) > 1;
	}

	/**
	 * Get PDF friendly HTML for rendering the graph.
	 *
	 * @return string HTML.
	 */
	public function get_html() {
		$output = '';
		foreach ( $this->plots as $plot ) {
			$output .= '<div style="margin: 0 0 10px 0">'
				. '<div style="height: 30px; width: ' . $plot['value'] . '%; background-color: ' . $plot['color'] . ';"></div>'
				. '<p style="margin: 2px 0 0 0; font-size: 12px;">'
				. $plot['label'] . ' ' . format_number( $plot['value'], 2 ) . '%'
				. '</p>'
				. '</div>';
		}
		return $output;
	}
}
