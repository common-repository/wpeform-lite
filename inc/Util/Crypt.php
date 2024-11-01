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
 * @subpackage Util
 */

namespace WPEForm\Util;

use WPEForm\Exception\InvalidPaginationException;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A class for managing all encryption and decryption within EForm.
 */
class Crypt {
	const SALT = \AUTH_SALT;

	/**
	 * Get OpenSSL Cipher. We use `AES-128-CBC`.
	 *
	 * @throws LogicException If `AES-128-CBC` is not found in openssl extension.
	 *
	 * @return string
	 */
	protected static function get_openssl_cipher() : string {
		$cipher = 'aes-128-cbc';
		if ( ! \in_array( $cipher, \openssl_get_cipher_methods() ) ) {
			throw new LogicException( 'Can not use openssl cipher.' );
		}
		return $cipher;
	}

	/**
	 * Encrypt a value.
	 *
	 * @param string $plaintext The string value to encrypt.
	 * @return string|null
	 */
	public static function encrypt( string $plaintext ) : string {
		$key = self::SALT;
		$cipher = self::get_openssl_cipher();

		$ivlen = \openssl_cipher_iv_length( $cipher );
		$iv = \openssl_random_pseudo_bytes( $ivlen );
		$options = \OPENSSL_RAW_DATA;
		$ciphertext_raw = \openssl_encrypt( $plaintext, $cipher, $key, $options, $iv );
		$hmac = \hash_hmac( 'sha256', $ciphertext_raw, $key, true );
		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
		$ciphertext = \base64_encode( $iv . $hmac . $ciphertext_raw );
		return $ciphertext;
	}

	/**
	 * Decrypt a value.
	 *
	 * @param string $ciphertext The value to decrypt.
	 * @return string
	 */
	public static function decrypt( string $ciphertext ) : ?string {
		$key = self::SALT;
		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
		$c = \base64_decode( $ciphertext );
		$cipher = self::get_openssl_cipher();
		$ivlen = \openssl_cipher_iv_length( $cipher );
		$iv = \substr( $c, 0, $ivlen );
		if ( \strlen( $iv ) < $ivlen ) {
			// invalid ciphertext
			return null;
		}

		$sha2len = 32;
		$hmac = \substr( $c, $ivlen, $sha2len );
		if ( \strlen( $hmac ) < $sha2len ) {
			return null;
		}

		$ciphertext_raw = \substr( $c, $ivlen + $sha2len );
		$original_plaintext = \openssl_decrypt( $ciphertext_raw, $cipher, $key, \OPENSSL_RAW_DATA, $iv );
		$calcmac = \hash_hmac( 'sha256', $ciphertext_raw, $key, true );
		// PHP 5.6+ timing attack safe comparison
		if ( \hash_equals( $hmac, $calcmac ) ) {
				return $original_plaintext;
		}
		return null;
	}

	/**
	 * Encode a cursor into an opaque.
	 *
	 * @param string $cursor The Original cursor.
	 * @return string
	 */
	public static function encode_cursor( $cursor ) {
		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
		return \base64_encode( 'cursor::' . (string) $cursor );
	}

	/**
	 * Decode a cursor from an opaque.
	 *
	 * @throws InvalidPaginationException If the cursor is invalid.
	 *
	 * @param string $cursor The encoded cursor.
	 * @return string
	 */
	public static function decode_cursor( $cursor ) {
		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
		$result = \base64_decode( $cursor, true );
		if ( false === $result ) {
			throw new InvalidPaginationException( 'The cursor is invalid' );
		}
		// remove the `cursor::` part
		$result = \str_replace( 'cursor::', '', $result );
		if ( ! is_numeric( $result ) ) {
			throw new InvalidPaginationException( 'The cursor is invalid' );
		}
		return $result;
	}

	/**
	 * Create a string token which would be unique on every call. Use this as
	 * lookup token in db tables like submission.
	 *
	 * It tries to use `random_bytes` which should be present in most of the systems.
	 * If not, then it falls back to `openssl_random_pseudo_bytes`.
	 *
	 * @param int $length Length of the string.
	 *
	 * @return string
	 */
	public static function create_token( int $length = 16 ) : string {
		if ( \function_exists( 'random_bytes' ) ) {
			return \bin2hex( \random_bytes( $length ) );
		}
		return \bin2hex(
			\openssl_random_pseudo_bytes( $length )
		);
	}
}
