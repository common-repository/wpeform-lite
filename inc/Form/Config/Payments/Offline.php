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
 * @subpackage Form\Config\Payments
 */

namespace WPEForm\Form\Config\Payments;

use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Model\IModel;
use WPEForm\Auth\IAuth;
use WPEForm\Util\SlateJS;
use function __;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for Offline payment system.
 */
class Offline extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	protected function config_vars() : array {
		$config_vars = [
			'label' => FieldVar::var(
				__( 'Bank Transfer', 'wp-eform' ),
				Type::string()
			),
			'instruction' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Please note down our bank details and make a transfer. Once you are done with the bank transfer, you can submit the details using the form below. If you accidentally close this page, you can still contact us with Order Id and Submission Id and we will sort this out for you.', 'wp-eform' ) .
					'</p>' .
					'<p>' .
						__( '>> Enter the bank details here. <<', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// Label of the receipt field
			'receiptLabel' => FieldVar::var(
				__( 'Enter transaction details as given by the bank', 'wp-eform' ),
				Type::string()
			),
			// Shown in the Order details/Invoice when payment is not finished yet.
			'status' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
					__( 'Awaiting confirmation of your payment. If you have completed the payment, please get in touch with us with Order Id <mentions character="::invoiceId::" />.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			)->setNullable( true ),
		];
		return $config_vars;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function is_gateway(): bool {
		return true;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function is_payment_automatic() : bool {
		return false;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array  $payment_data Payment related data, with `amount`.
	 * @param array  $config Payments config, as extracted from Form model.
	 * @param IModel $data Data model.
	 * @param IModel $payment Payment model.
	 *
	 * @return void
	 */
	public function do_payment( array $payment_data, array $config, IModel $data, IModel $payment ) : void {
		// TODO: Implement feature
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array  $value Stored value in database.
	 * @param IAuth  $auth IAuth instance to determine capability.
	 * @param IModel $model Original model instance.
	 *
	 * @return array|null
	 */
	public function resolver( array $value, IAuth $auth, IModel $model ): ?array {
		// we don't expose sensitive data to client if not authenticated
		if ( ! $auth->can_current_user_read_sensitive_info( $model ) ) {
			$value['status'] = null;
		}
		return $value;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function supports_subscription() :bool {
		return true;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string|null
	 */
	public function gateway_label() : ?string {
		return __( 'Offline Payment', 'wp-eform' );
	}
}
