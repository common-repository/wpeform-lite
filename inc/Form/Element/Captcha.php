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
 * @subpackage Element
 * @author Swashata Ghosh <swashata@wpquark.com>
 */

namespace WPEForm\Form\Element;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\Util\Crypt;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Captcha Element class. Captcha.
 *
 * Anti bot measures. It will show a simple math challenge.
 */
class Captcha extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_definition() : array {
		return [
			'title' => __( 'Captcha', 'wp-eform' ),
			'description' => __( 'Anti bot measures. It will show a simple math challenge.', 'wp-eform' ),
			'container' => false,
			'category' => 'security',
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function get_generic_appearance_structure(): array {
		return [
			'title' => [
				'uses' => true,
				'default' => __( 'Solve the challange', 'wp-eform' ),
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function config_vars() : array {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function data_value_vars(): array {
		return [
			'solved' => FieldVar::var( '', Type::string() ),
			'encrypted' => FieldVar::var( '', Type::string() ),
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array An associative array with success => bool, and message => string
	 */
	public function get_validation_status( array $config, array $data_value ) : array {
		// if value is null
		if ( empty( $data_value['solved'] ) || empty( $data_value['encrypted'] ) ) {
			return $this->get_validation_error(
				__( 'Invalid captcha solution.', 'wp-eform' )
			);
		}

		// solved value and encrypted value should match
		$decrypted = Crypt::decrypt( $data_value['encrypted'] );
		if ( $data_value['solved'] !== $decrypted ) {
			return $this->get_validation_error(
				__( 'Invalid captcha solution.', 'wp-eform' )
			);
		}

		// everything checksout
		return $this->get_default_validation_status();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $config Normalized configuration value.
	 * @param array $data_value Normalized data.value.
	 *
	 * @return array
	 */
	public function get_data_score( array $config, array $data_value ) : array {
		return $this->get_default_data_score();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array|null $config Config data.
	 *
	 * @return string|null
	 */
	public function get_extra_type_data( ?array $config ): ?string {
		// In the client we will use numOne, numTwo and operation
		// do the add or subtract operation and then, give back the
		// solved and the original encrypted. Server will check for
		// authenticity.
		$num_one = \wp_rand( 6, 10 );
		$num_two = \wp_rand( 1, 5 );
		$operation = \wp_rand( 0, 1 ) === 0 ? 'add' : 'subtract';
		$result = $operation === 'add'
			? $num_one + $num_two
			: $num_one - $num_two;
		$encrypted = Crypt::encrypt( (string) $result );
		return \json_encode(
			[
				'numOne' => $num_one,
				'numTwo' => $num_two,
				'operation' => $operation,
				'result' => $result,
				'encrypted' => $encrypted,
			]
		);
	}
}
