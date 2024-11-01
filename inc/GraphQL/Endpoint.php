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
 * @subpackage GraphQL
 */

namespace WPEForm\GraphQL;

use WPEForm\Exception\AuthException;
use WPEForm\GeneralDeps\GraphQL\Error\FormattedError;
use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Error\DebugFlag;
use WPEForm\GraphQL\Server\StandardServer;
use WPEForm\GeneralDeps\GraphQL\Server\ServerConfig;

use WPEForm\System\Endpoints;

use function WPEForm\Helpers\get_graphql_nonced_url;
use function WPEForm\Helpers\get_wpeform_app_allowed_origin;
use function WPEForm\Helpers\is_wpeform_app_mode;
use function WPEForm\Helpers\verify_graphql_nonce;
use function WPEForm\Helpers\wpeform_handle_app_mode_headers_and_preflight;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class to handle the endpoint of our GraphQL server.
 */
class Endpoint {
	/**
	 * Determine whether the current request is a HTTP request. This doesn't
	 * rely on WordPress query parameters as by the time it is called, the query
	 * params aren't populated.
	 *
	 * Adapted from WP-GRAPHQL Plugin.
	 *
	 * @link {https://github.com/wp-graphql/wp-graphql/pull/1529/files#R137}
	 * @return bool
	 */
	public static function is_graphql_http_request() {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		// Default is false
		$is_graphql_http_request = false;
		// Support for non pretty permalink style request to /?wp-eform=graphql
		if ( isset( $_GET[ Endpoints::DEFAULT_ENDPOINT_BASE ] ) ) {
			$is_graphql_http_request = $_GET[ Endpoints::DEFAULT_ENDPOINT_BASE ] === 'graphql';
		} else {
			// Support pretty permalink style request to /wp-eform/graphql/
			// Check the server to determine if the GraphQL endpoint is being requested
			if ( isset( $_SERVER['HTTP_HOST'] ) && isset( $_SERVER['REQUEST_URI'] ) ) {
				$haystack = \wp_unslash( $_SERVER['HTTP_HOST'] )
					. \wp_unslash( $_SERVER['REQUEST_URI'] );

				$needle = \site_url( Endpoints::DEFAULT_ENDPOINT_BASE . '/graphql' );

				// Strip protocol.
				$haystack = preg_replace( '#^(http(s)?://)#', '', $haystack );
				$needle = preg_replace( '#^(http(s)?://)#', '', $needle );
				$is_graphql_http_request =
					$haystack === $needle || $haystack === "{$needle}/";
			}
		}
		return $is_graphql_http_request;
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}
	/**
	 * Check whether current request is for the GraphQL API.
	 *
	 * @return bool
	 */
	public static function is_graphql_api_request() {
		$query_var = Endpoints::get_endpoint_query_var();
		return $query_var === 'graphql';
	}

	/**
	 * Handle GraphQL Request.
	 *
	 * @return void
	 * @throws AuthException If not in app mode and requires nonce.
	 */
	public static function handle_graphql_request() {
		// create debug formatters and handlers, based on WordPress env
		$debug = false;
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$debug = DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE | DebugFlag::RETHROW_UNSAFE_EXCEPTIONS;
		}

		try {

			// First check for the nonce
			// this prevents both CSRF and Authorization attacks
			$is_running_as_app = is_wpeform_app_mode();
			if ( $is_running_as_app ) {
				// set cors on headers
				// a preflight check may come from OPTIONS, we need to handle that
				$allowed_origin = get_wpeform_app_allowed_origin();
				wpeform_handle_app_mode_headers_and_preflight( $allowed_origin );
			} else {
				// check for nonce
				if ( ! verify_graphql_nonce() ) {
					throw new AuthException( 'Insufficient permission in nonce.' );
				}
			}

			// GraphQL schema to be passed to query executor
			$schema = Schema::get_schema();

			// Error handlers
			$error_formatter = function( Error $error ) {
				$formatted = FormattedError::createFromException( $error );
				return $formatted;
			};

			$error_handler = function( array $errors, callable $formatter ) {
				return array_map( $formatter, $errors );
			};

			// server configuration
			$config = ServerConfig::create()
				->setSchema( $schema )
				->setDebugFlag( $debug )
				->setErrorFormatter( $error_formatter )
				->setErrorsHandler( $error_handler );

			// create the server and handle request
			$server = new StandardServer( $config );
			$server->handleRequest( null, true );
		} catch ( \Exception $e ) {
			\eform_error_log( $e->getMessage() );
			\eform_error_log( $e->getTraceAsString() );
			StandardServer::send500Error( $e, $debug, true );
		}
		// Since in our both try catch block, we ask standardserver to exit
		// when done, we don't have to do it explicitly.
		// Also WordPress adds `addslashes` to all $_POST, $_GET etc. But our
		// StandardServer reads from `php://input`. So we don't need to remove
		// slashes from there.
	}

	/**
	 * Execute the GraphQL Server.
	 *
	 * @throws AuthException If nonce is needed and is invalid.
	 *
	 * @return void
	 */
	public static function server() {
		// Check if this is our execution point
		if ( ! self::is_graphql_api_request() ) {
			return;
		}

		self::handle_graphql_request();
	}

	/**
	 * Get endpoint URL for GraphQL API. If in headless mode, then it will not put
	 * wp nonce. Otherwise a nonce will be put as GET query parameter.
	 *
	 * @param bool $headless Whether or not this GraphQL Endpoint URL will be used in headless mode.
	 *
	 * @return string
	 */
	public static function get_graphql_endpoint_url( bool $headless = false ) {
		$endpoint = Endpoints::get_endpoint_url( '/graphql/' );
		if ( $headless ) {
			return $endpoint;
		}
		return get_graphql_nonced_url( $endpoint );
	}

	/**
	 * Endpoint handler for GraphQL Playground for EForm.
	 *
	 * It works only if WP_DEBUG is enabled.
	 *
	 * @return void
	 */
	public static function playground() {
		// Check if in debugging mode
		if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
			return;
		}

		// Check if in our endpoint
		if ( 'graphql/playground' !== Endpoints::get_endpoint_query_var() ) {
			return;
		}

		// require the template
		$endpoint = self::get_graphql_endpoint_url();
		require __DIR__ . '/templates/playground.php';

		// exit
		die();
	}
}
