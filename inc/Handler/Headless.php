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
 * @subpackage Handler
 */

namespace WPEForm\Handler;

use Freemius_Exception;
use WPEForm\System\SystemEndpoint;

use function WPEForm\Helpers\get_wpeform_app_allowed_origin;
use function WPEForm\Helpers\wpeform_handle_app_mode_headers_and_preflight;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class to manage different functionalities of headless mode.
 *
 * @package WPEForm\Handler
 */
class Headless {
	/**
	 * Get JavaScript object needed for the headless script. It returns an
	 * associated array with needed values.
	 *
	 * @return array JavaScript object in PHP associated array.
	 */
	public function get_javascript_obj() : array {
		return SystemEndpoint::get_wpeformgraphqlapp_data( true, true );
	}

	/**
	 * Get JavaScript output for the headless embed script.
	 *
	 * @return string JavaScript source code.
	 */
	public function get_javascript_output() : string {
		$output = 'var WPEFormGraphQLApp = '
			. \json_encode( $this->get_javascript_obj() ) . ';';

		return $output;
	}

	/**
	 * Get JavaScript integrity value for the source.
	 *
	 * @return string
	 */
	public function get_javascript_integrity() : string {
		$output = $this->get_javascript_output();
		return 'sha256-'
			// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
			. \base64_encode( \hash( 'sha256', $output, true ) );
	}

	/**
	 * Render JavaScript output for headless script embed.
	 *
	 * @return void
	 */
	public function render_javascript_output() : void {
		// first set CORS and handle preflight request
		$allowed_origin = get_wpeform_app_allowed_origin();
		wpeform_handle_app_mode_headers_and_preflight( $allowed_origin );
		$output = $this->get_javascript_output();
		$length = \strlen( $output );

		// send needed headers for JavaScript and Cache
		$seconds_to_cache = 315360000;
		$ts = \gmdate( 'D, d M Y H:i:s', time() + $seconds_to_cache ) . ' GMT';
		\header( "Expires: $ts" );
		\header( 'Pragma: cache' );
		\header( "Cache-Control: max-age=$seconds_to_cache" );
		\header( "Content-Length: {$length}" );
		\header( 'Content-Type: application/javascript; charset=' . \get_option( 'blog_charset' ) );
		\status_header( '200' );
		// ignoring output not escaped because the output is trusted
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $output;
		die;
	}
}
