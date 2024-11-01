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

use WPEForm\Model\Form as ModelForm;
use WPEForm\Model\Payment as ModelPayment;
use WPEForm\Util\Crypt;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Main Payment Handler class. This is responsible all things related to
 * payments happening server side. The WPEForm\Form\Config\Payments augments the
 * handler to fulfill its mission.
 *
 * @package WPEForm\Handler
 */
class Payment {
	/**
	 * Form Model.
	 *
	 * @var ModelForm
	 */
	protected $form_model;

	/**
	 * Submission Handler.
	 *
	 * @var Submission
	 */
	protected $submission_handler;

	/**
	 * Payment information data needed.
	 *
	 * @var array
	 */
	protected $payment_information = [];

	/**
	 * Create the default payment information. Later it will be carried through
	 * the different WPEForm\Form\Config\Payments classes for augmentation.
	 *
	 * @return void
	 */
	protected function prepare_default_payment_information() {
		$this->payment_information = [
			'amount' => 0,
			'mode' => 'offline',
			'currency' => 'USD',
			'type' => 0,
			'subsPlan' => '',
			'subsInterval' => 0,
			'subsFrequency' => 0,
		];
	}

	/**
	 * Create an instance of the payments handler.
	 *
	 * @param ModelForm  $form_model Form Model with data already set.
	 * @param Submission $submission_handler Submission handler.
	 */
	public function __construct( ModelForm $form_model, Submission $submission_handler ) {
		$this->form_model = $form_model;
		$this->submission_handler = $submission_handler;
		$this->prepare_default_payment_information();
	}

	/**
	 * Determines if payment is needed for this submission or not.
	 *
	 * @return bool
	 */
	public function is_payment_needed(): bool {
		// TODO: actually implement the logic
		return false;
	}

	/**
	 * Create a record on the payments table before doing any actual work on the
	 * payment gateway.
	 *
	 * @return void
	 */
	public function initialize_record() {
		$order_id = Crypt::create_token( 32 );
		$db_data = [
			'formId' => $this->form_model->get_id(),
			'submissionId' => $this->submission_handler->get_submission_id(),
			'orderId' => $order_id,
			// amount
			// mode
			'status' => 4,
			'meta' => '',
			// currency
			'date' => $this->submission_handler->clock()->get_date(),
			// type
			// subsPlan
			// subsInterval
			// subsFrequency
		] + $this->payment_information;

		$payment_handler = $this->get_payment_handler();

		$payment_model = new ModelPayment();

		$payment_model->create( $db_data );
	}

	/**
	 * Get the payment handler for the current form.
	 *
	 * @todo Implement the logic to get the payment handler.
	 *
	 * @return void
	 */
	protected function get_payment_handler() {
		// TODO implement.
	}
}
