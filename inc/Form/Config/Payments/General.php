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
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\TypeOrInputFromFields;
use WPEForm\Auth\IAuth;
use WPEForm\Model\IModel;
use WPEForm\Util\SlateJS;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for General Payments.
 */
class General extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	protected function config_vars(): array {
		$couponListFieldVars = [
			'id' => FieldVar::var( '', Type::id() ),
			'code' => FieldVar::var( '', Type::string() ),
			'type' => FieldVar::var(
				'value',
				Registry::get( 'formPaymentsCouponType', 'enum' )
			),
			'value' => FieldVar::var( 0, Type::float() ),
			'min' => FieldVar::var( 0, Type::float() ),
		];

		return [
			'enabled' => FieldVar::var( false, Type::boolean() ),
			'type' => FieldVar::var( 'onetime', Registry::get( 'formPaymentType', 'enum' ) ),
			'subscriptionStatement' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__(
							'Every <mentions character="::paymentFrequency::"></mentions> <mentions character="::paymentInterval::"></mentions>',
							'wp-eform'
						) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'selectedGateways' => FieldVar::var(
				[],
				Type::listOf( Type::nonNull( Type::id() ) )
			),
			'defaultGateway' => FieldVar::var(
				'offline',
				Type::string()
			),
			'lockSubmissionOnPendingPayment' => FieldVar::var( false, Type::boolean() ),
			'lockMessage' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__(
							'Sorry but your submission would be visible only after completing the payment.',
							'wp-eform'
						) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'formula' => FieldVar::var(
				'',
				Type::string()
			),
			'currency' => FieldVar::var(
				'USD',
				Type::string()
			),
			'zeroDecimal' => FieldVar::var(
				false,
				Type::boolean()
			),
			'currencyPrefix' => FieldVar::var(
				'$',
				Type::string()
			),
			'currencySuffix' => FieldVar::var(
				'',
				Type::string()
			),
			'coupons' => FieldVar::var(
				[],
				Type::listOf(
					Type::nonNull(
						TypeOrInputFromFields::create_type( $couponListFieldVars, 'FormPaymentsCouponItem' )
					)
				),
				Type::listOf(
					Type::nonNull(
						TypeOrInputFromFields::create_input( $couponListFieldVars, 'FormPaymentsCouponItem' )
					)
				)
			)->setValidator( 'WPEForm\\Helpers\\validate_list_items_with_id_key' ),
			'itemName' => FieldVar::var( 'Custom item', Type::string() ),
			'itemDescription' => FieldVar::var( 'Description of the custom item.', Type::string() ),
			'itemSku' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						'wpeform-product-<mentions character="::formId::" />' .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// this is the only place where we keep the `::id::` which would be used internally
			// and be replaced with the actual invoice Id
			'invoiceNumber' => FieldVar::var( 'INV-::id::', Type::string() ),
			// Will override general success subject
			'successSubject' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__(
							'Successfully paid for Order <mentions character="::invoiceId::" /> via <mentions character="::paymentGatewayName::"></mentions>',
							'wp-eform'
						) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// will override general success message
			'successMessage' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__(
							'Your payment was successful. Your Order ID is <mentions character="::invoiceId::"></mentions>. Kindly take a note of it for future references.',
							'wp-eform'
						) .
					'</p>' .
					'<p>' .
						'You can find the full order details below.' .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			// will override the general success message
			'errorSubject' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Payment Error for Order ID <mentions character="::invoiceId::" /> with <mentions character="::paymentGatewayName::" />', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'errorMessage' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Your payment could not be processed at this moment. Please try again. If any amount was deducted, it will be refunded automatically.', 'wp-eform' ) .
					'</p>' .
					'<p>' .
						__( 'For future communications, kindly note the Invoice Id <mentions character="::invoiceId::" />. You can also retry the payment using the form below.', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'cancelSubject' => FieldVar::var(
				SlateJS::parseHTML(
					'<p>' .
						__( 'Payment Cancelled for Order ID <mentions character="::invoiceId::" />', 'wp-eform' ) .
					'</p>'
				)->getEditorChildrenJSON(),
				Type::string()
			),
			'cancelMessage' => FieldVar::var(
				__( 'Your payment was cancelled before it could be completed. You can retry the payment using the form below.', 'wp-eform' ),
				Type::string()
			),
			'retrySubjectPrefix' => FieldVar::var(
				__( '[RETRY] ', 'wp-eform' ),
				Type::string()
			),
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function is_gateway() : bool {
		return false;
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
		// it doesn't do any payment, so do nothing
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
		// we expose general config to client
		return $value;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function supports_subscription() :bool {
		return false;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return string|null
	 */
	public function gateway_label() : ?string {
		return null;
	}
}
