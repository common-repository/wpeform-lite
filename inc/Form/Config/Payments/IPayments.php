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

use WPEForm\Form\Config\IConfig;
use WPEForm\Auth\IAuth;
use WPEForm\Model\IModel;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Interface for all Payments classes. These needs additional methods
 * to actually call the integration during data-save and form admin.
 */
interface IPayments extends IConfig {
	/**
	 * A resolver method which is called by the controller. This makes sure
	 * no sensitive data leaks into the output if user doesn't have proper
	 * permission.
	 *
	 * @param array  $value Stored value in database.
	 * @param IAuth  $auth IAuth instance to determine capability.
	 * @param IModel $model Original model instance.
	 *
	 * @return array|null
	 */
	public function resolver( array $value, IAuth $auth, IModel $model ) : ?array;

	/**
	 * Whether or not this is a payment gateway provider. If this is a gateway
	 * provider, then do_payment is called on User submission, shows up in Gateway
	 * selection etc.
	 *
	 * @return bool
	 */
	public function is_gateway() : bool;

	/**
	 * Whether or not the payment status is managed automatically with some
	 * online payment gateway. Having this true, would block all edit functionalities
	 * within eform. Set to false, so that admin can edit them.
	 *
	 * @return bool
	 */
	public function is_payment_automatic() : bool;

	/**
	 * Do the payment related stuff. EForm will automatically create a New
	 * transaction on database and will pass the model. It is the responsibility
	 * of the payments class to do the payment, and update the data.
	 *
	 * @param array  $payment_data Payment related data, with `amount`.
	 * @param array  $config Payments config, as extracted from Form model.
	 * @param IModel $data Data model.
	 * @param IModel $payment Payment model.
	 *
	 * @return void
	 */
	public function do_payment( array $payment_data, array $config, IModel $data, IModel $payment ) : void;

	/**
	 * Whether or not this payment integration supports recurring/subscription
	 * type payments.
	 *
	 * @return bool
	 */
	public function supports_subscription() : bool;

	/**
	 * Get the label for this gateway. Could be null, if this is not a gateway.
	 *
	 * @return string|null
	 */
	public function gateway_label() : ?string;
}
