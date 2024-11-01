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
 * @subpackage System
 */

namespace WPEForm\System;

use WPEForm\Exception\InvalidEndpointException;
use WPEForm\GraphQL\Endpoint as GQLEndpoint;
use WPEForm\View\Front\Form as FormEndpoint;

use function WPEForm\Helpers\string_ends_with;
use function WPEForm\Helpers\string_starts_with;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd


/**
 * Endpoints class.
 *
 * This handles all pretty endpoints created by WP EForm and it's add-ons.
 */
class Endpoints {
	/**
	 * Custom endpoints registered by WP EForm
	 *
	 * @var array
	 */
	private $endpoints;

	/**
	 * Defautt endpoint base for all endpoint related stuff.
	 *
	 * @var string
	 */
	const DEFAULT_ENDPOINT_BASE = 'wp-eform';

	/**
	 * Get endpoint base.
	 *
	 * @return string The endpoint base.
	 */
	public static function get_endpoint_base() : string {
		return self::DEFAULT_ENDPOINT_BASE;
	}

	/**
	 * Check whether or not pretty permalink is enabled.
	 *
	 * @return bool
	 */
	public static function is_pretty_permalink_enabled() : bool {
		if ( \get_option( 'permalink_structure' ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Get query params to be used for non pretty permalinks to endpoint.
	 *
	 * It does not remove leading and trailing slashes from path.
	 *
	 * @param string $path Path of the endpoing. MUST NOT HAVE LEADING AND TRAILING SLASHES.
	 * @return array Query params.
	 */
	public static function get_query_params_for_non_pretty_permalinks( string $path ) {
		$query_args = [];
		$query_args[ self::get_endpoint_base() ] = \rawurlencode( $path );
		return $query_args;
	}

	/**
	 * Get WordPress URL for WP EForm GraphQL API Endpoint.
	 *
	 * It takes into account, whether pretty permalink is enabled or not. If enabled
	 * then it returns pretty URLs, otherwise, it returns parameterized URLs.
	 *
	 * @param string $path Path after endpoint URL. MUST HAVE A LEADING AND TRAILING '/'.
	 *
	 * @return string
	 */
	public static function get_endpoint_url( string $path = '' ) : string {
		// Path must have a leading and trailing slash
		if ( $path !== '' ) {
			if ( ! string_starts_with( '/', $path ) ) {
				$path = '/' . $path;
			}
			if ( ! string_ends_with( '/', $path ) ) {
				$path = $path . '/';
			}
		}

		// If pretty permalink is enabled, then just add it to home URL and return
		if ( self::is_pretty_permalink_enabled() ) {
			return \home_url( '/' . self::get_endpoint_base() . $path );
		}

		// pretty permalink is not enabled
		// so now, remove the leading and trailing slashes
		if ( $path !== '' ) {
			// remove the leading /
			$path = \mb_substr( $path, 1 );
			// remove the ending slash
			$path = \mb_substr( $path, 0, \mb_strlen( $path ) - 1 );
		}

		$home_url = \home_url( '/' );

		return \add_query_arg(
			self::get_query_params_for_non_pretty_permalinks( $path ),
			$home_url
		);
	}

	/**
	 * Get endpoint query var (if present) from the current WP Query.
	 *
	 * @return string Endpoint query var if present.
	 */
	public static function get_endpoint_query_var() {
		return \get_query_var( self::get_endpoint_base(), false );
	}

	/**
	 * Create the endpoint registry with built-ins and scope for
	 * third-party hooking.
	 */
	public function create_endpoint_registry() {
		$this->endpoints = \apply_filters(
			'wp_eform_endpoints', [
				// graphql server
				[ GQLEndpoint::class, 'server' ],
				// graphql playground
				[ GQLEndpoint::class, 'playground' ],
				// Form output
				[ FormEndpoint::class, 'handle_standalone_output' ],
				// system endpoints
				[ SystemEndpoint::class, 'register_system_endpoints' ],
			]
		);
	}

	/**
	 * Register all EForm custom endpoints to WordPress System.
	 *
	 * @return void
	 */
	public function register_endpoints() {
		add_filter( 'query_vars', [ $this, 'add_query_var' ], 1, 1 );
		add_action( 'template_redirect', [ $this, 'register_output' ] );
	}

	/**
	 * Adds the query_var for the route
	 *
	 * @param array $query_vars The array of whitelisted query variables.
	 */
	public static function add_query_var( $query_vars ) {
		$query_vars[] = self::DEFAULT_ENDPOINT_BASE;
		return $query_vars;
	}

	/**
	 * Register all rewrites, by calling the endpoint hooks to WordPress.
	 *
	 * @throws InvalidEndpointException If endpoints are not proper.
	 *
	 * @return void
	 */
	public function register_rewrite() {
		\add_rewrite_endpoint( $this->get_endpoint_base(), EP_ROOT );
	}

	/**
	 * Register all endpoint outputs, by calling the endpoint hooks.
	 *
	 * @throws InvalidEndpointException If endpoints are not proper.
	 *
	 * @return void
	 */
	public function register_output() {
		$query_var = self::get_endpoint_query_var();
		// if this is our query var present
		if ( $query_var && $query_var !== '' ) {
			// call all endpoints
			foreach ( $this->endpoints as $endpoint ) {
				if ( ! \is_callable( $endpoint ) ) {
					throw new InvalidEndpointException( 'Endpoint output must be callable' );
				}
				\call_user_func( $endpoint );
			}
			// if none of the endpoints actually died, then we redirect to 404
			\status_header( 404 );
			\nocache_headers();
			include \get_query_template( '404' );
			die();
		}
	}
}
