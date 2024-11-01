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
 * @subpackage Helpers
 */

namespace WPEForm\Helpers;

use WPEForm\System\Init;

/**
 * Get the metavalue of a WordPress User. Unlike the built-in function, it
 * also searches for userdata. In fact, it looks into userdata first and only
 * if not found, it continues checking with `get_user_meta`.
 *
 * The returned value is always a string or null if not found. If stored
 * metadata is an array, then it is imploded using `"\n"`.
 *
 * @param string   $key The key of the meta.
 * @param null|int $user_id User id, default `null`, in which case current user id will be used.
 * @return null|string string value of metadata if found, null if not found.
 */
function get_user_metavalue( string $key, ?int $user_id = null ) : ?string {
	// figure out the user id first
	if ( \is_user_logged_in() && $user_id === null ) {
		$user_id = \get_current_user_id();
	}

	// Now try to search from userdata first
	$user_data = \get_userdata( $user_id );

	if ( ! $user_data ) {
		return null;
	}

	// Now try to get the metadata from user_data and fallback to `user_meta`
	if ( \property_exists( $user_data->data, $key ) ) {
		$metadata = \wp_strip_all_tags( $user_data->data->{$key} );
	} else {
		$metadata = \get_user_meta( $user_id, $key, true );
	}

	// Now at this stage, if metadata is empty, then bail
	if ( empty( $metadata ) ) {
		return null;
	}

	// Now convert metadata into a string and return
	if ( \is_array( $metadata ) ) {
		return \implode( "\n", $metadata );
	} elseif ( \is_string( $metadata ) ) {
		return $metadata;
	}

	// failed, so return null
	return null;
}

/**
 * Get current user email with a fallback.
 *
 * @param string $fallback Fallback email, defaults to an empty string.
 * @return string User email on success, fallback on failue.
 */
function get_current_wp_user_email( string $fallback = '' ) {
	if ( ! \is_user_logged_in() ) {
		return $fallback;
	}
	$current_user = \wp_get_current_user();
	$email = $current_user->user_email ?? $fallback;
	if ( validate_is_email( $email ) ) {
		return $email;
	}
	return $fallback;
}

/**
 * Determine whether wpeform is running in app mode.
 * This is done via setting WPEFORM_APP_MODE in wp-config.php. Turning this
 * on will essentially skip nonce checks in graphql api.
 *
 * @return bool
 */
function is_wpeform_app_mode() : bool {
	/**
	 * @filter wpeform_is_app_mode
	 * @param bool $is_app_mode Whether or not is app mode
	 */
	return \apply_filters(
		'wpeform_is_app_mode',
		\defined( 'WPEFORM_APP_MODE' ) && ! ! WPEFORM_APP_MODE
	);
}

/**
 * Get allowed origin for wpeform app mode.
 *
 * The value is filtered with `wpeform_cors_allowed_origin` so you can
 * change it programmatically. You can also set WPEFORM_APP_CORS_DOMAIN
 * in wp-config.php file. The filter will take preference.
 *
 * @return string
 */
function get_wpeform_app_allowed_origin() : string {
	$site_origin = \site_url( '' );
	$trusted_origin = $site_origin;
	$settings = Init::$settings;
	if ( ! isset( $_SERVER['HTTP_ORIGIN'] ) ) {
		if ( ! empty( $settings['system']['allowedHeadlessOrigins'] ) && $settings['system']['allowedHeadlessOrigins'] === '*' ) {
			$trusted_origin = '*';
		} else {
			$trusted_origin = $site_origin;
		}
	} else {
		$http_origin = $_SERVER['HTTP_ORIGIN'];
		if ( ! empty( $settings['system']['allowedHeadlessOrigins'] ) ) {
			$allowed_origins = \trim( $settings['system']['allowedHeadlessOrigins'] );
			// if we are matching all, then we set the current origin to be trusted
			if ( $allowed_origins === '*' ) {
				$trusted_origin = '*';
			} else {
				// this is an user specified list, so match against it
				$whitelists = \explode( ',', $settings['system']['allowedHeadlessOrigins'] );
				$whitelists = \map_deep( $whitelists, 'trim' );
				if ( \in_array( $http_origin, $whitelists ) ) {
					$trusted_origin = $http_origin;
				}
			}
		}
	}

	// all calculations complete, we return a filtered trusted_origin
	return \apply_filters( 'wpeform_cors_allowed_origin', $trusted_origin );
}

/**
 * Handle headers and preflight for APP mode in WPEForm. It sends needed
 * headers and checks for CORS pre-flight.
 *
 * @param string $allowed_origin Allowed origin.
 * @return void
 */
function wpeform_handle_app_mode_headers_and_preflight( string $allowed_origin ) {
	// print needed allowed origins
	\header( "Access-Control-Allow-Origin: {$allowed_origin}" );
	\header( 'Access-Control-Allow-Credentials: true' );
	\header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );

	// chrome and some other browser sends a preflight check with OPTIONS
	// if that is found, then we need to send response that it's okay
	// @link https://stackoverflow.com/a/17125550/2754557
	if (
		isset( $_SERVER['REQUEST_METHOD'] )
		&& $_SERVER['REQUEST_METHOD'] === 'OPTIONS'
	) {
		// need preflight here
		\header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept' );
		// add cache control for preflight cache
		// @link https://httptoolkit.tech/blog/cache-your-cors/
		\header( 'Access-Control-Max-Age: 86400' );
		\header( 'Cache-Control: public, max-age=86400' );
		\header( 'Vary: origin' );
		// just exit and CORS request will be okay
		exit( 0 );
	}
}

/**
 * Verify graphql nonce from HTTP GET parameter.
 *
 * @return bool
 */
function verify_graphql_nonce() : bool {
	$nonce = $_GET['__wpnonce'] ?? null;
	if ( ! $nonce || ! \wp_verify_nonce( $nonce, 'wpeform-graphql' ) ) {
		return false;
	}
	return true;
}

/**
 * Get nonced GraphQL endpoint URL.
 *
 * @param string $endpoint Endpoint URL without nonce.
 * @return string
 */
function get_graphql_nonced_url( string $endpoint ) : string {
	$endpoint = \add_query_arg(
		'__wpnonce',
		\wp_create_nonce( 'wpeform-graphql' ),
		$endpoint
	);
	return $endpoint;
}

/**
 * Get default no-reply email that validates against email check.
 *
 * @return string
 */
function get_default_no_reply_email(): string {
	$site_tld = 'example.com';
	$home_url_parts = \wp_parse_url( \home_url() );
	if ( $home_url_parts && \is_array( $home_url_parts ) && $home_url_parts['host'] ) {
		$site_tld = $home_url_parts['host'];
	}
	$email = 'no-reply@' . $site_tld;
	// override if something with the hostname is causing issue
	if ( ! validate_is_email( $email ) ) {
		$email = 'no-reply@example.com';
	}
	return $email;
}
