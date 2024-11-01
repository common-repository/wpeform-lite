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
 * @subpackage Form\Config\Styles
 */

namespace WPEForm\Form\Config\Styles;

use WPEForm\Form\Config\Base;
use WPEForm\GraphQL\Registry;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Util\SlateJS;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for FormBehavior.
 */
class FormBehavior extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$subject = SlateJS::parseHTML(
			'<p>' .
				__( 'Thank you for submitting the form.', 'wp-eform' ) .
			'</p>'
		);
		$message = SlateJS::parseHTML(
			'<p>' .
				__( 'Thank you <mentions character="::fName::"></mentions>, your submission has been recorded. You can visit it at <a href="%SUBMISSION_LINK%">this link</a>.', 'wp-eform' ) .
			'</p>' .
			'<p>' .
				__( 'We will get back to you as soon as possible. For confirmation we have also sent you an email.', 'wp-eform' ) .
			'</p>'
		);
		$update_subject = SlateJS::parseHTML(
			'<p>' .
				__( 'Thank you for updating the submission.', 'wp-eform' ) .
			'</p>'
		);
		$update_message = SlateJS::parseHTML(
			'<p>' .
				__( 'Your submission has been updated. You can visit it at <a href="%SUBMISSION_LINK%">this link</a>.', 'wp-eform' ) .
			'</p>' .
			'<p>' .
				__( 'We will get back to you as soon as possible. For confirmation we have also sent you an email.', 'wp-eform' ) .
			'</p>'
		);
		$kiosk_message = SlateJS::parseHTML(
			'<p>' .
				__( 'Resetting the kiosk in <mentions character="::kioskResetTime::"></mentions>.', 'wp-eform' ) .
			'</p>'
		);
		$error_subject = SlateJS::parseHTML(
			'<p>' .
				__( 'Oops, we have encountered an error.', 'wp-eform' ) .
			'</p>'
		);

		$config_vars = [
			'disabledAutoComplete' => FieldVar::var( false, Type::boolean() ),
			'subject' => FieldVar::var(
				$subject->getEditorChildrenJSON(),
				Type::string()
			),
			'message' => FieldVar::var(
				$message->getEditorChildrenJSON(),
				Type::string()
			),
			'updateSubject' => FieldVar::var(
				$update_subject->getEditorChildrenJSON(),
				Type::string()
			),
			'updateMessage' => FieldVar::var(
				$update_message->getEditorChildrenJSON(),
				Type::string()
			),
			'errorSubject' => FieldVar::var(
				$error_subject->getEditorChildrenJSON(),
				Type::string()
			),
			'errorRetryButtonLabel' => FieldVar::var(
				__( 'RETRY', 'wp-eform' ),
				Type::string()
			),
			'errorRetryButtonIcon' => FieldVar::var( 'fas fa-sync', Type::string() ),
			'errorRetryButtonIconPosition' => FieldVar::var(
				'before',
				Registry::get( 'buttonIconPosition', 'enum' )
			),
			'kioskMode' => FieldVar::var( false, Type::boolean() ), // will disabled redirection and reset form after submit
			'kioskMessage' => FieldVar::var(
				$kiosk_message->getEditorChildrenJSON(),
				Type::string()
			),
			'kioskTime' => FieldVar::var(
				10,
				Type::int()
			),
		];
		return $config_vars;
	}
}
