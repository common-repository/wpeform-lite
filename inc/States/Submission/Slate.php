<?php
/**
 * Copyright (C) 2022 Swashata Ghosh <swashata@wpquark.com>
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
 * @subpackage Helpers\Submission
 */

namespace WPEForm\States\Submission;

use WPEForm\Exception\InvalidOperationException;
use WPEForm\Handler\Submission;
use WPEForm\Model\Form;
use WPEForm\System\SystemEndpoint;
use WPEForm\Util\SlateJS;
use WPEForm\View\Front\Form as FrontForm;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Helper class for SlateJS related things in the Submission handler.
 */
class Slate {
	/**
	 * @var Submission
	 */
	private $submission_handler;

	/**
	 * Constructor.
	 *
	 * @param Submission $submission_handler The submission handler.
	 */
	public function __construct( Submission $submission_handler ) {
		$this->submission_handler = $submission_handler;
	}

	/**
	 * Get slatejs dynamic anchor tags.
	 *
	 * @param bool $is_admin If true, it will also add admin specific links.
	 * @return array Dynamic anchor tags.
	 */
	public function get_slatejs_dynamic_anchor_tags( bool $is_admin ) : array {
		$form_id = (int) $this->submission_handler->get_form_model()->get_id();

		$tags = [
			'%SUBMISSION_LINK%' => $this->submission_handler->get_submission_link(),
			'%FORM_LINK%' => $this->referer ?? FrontForm::get_form_standalone_link(
				$form_id
			),
		];
		if ( $is_admin ) {
			$tags['%FORM_ADMIN_LINK%'] = SystemEndpoint::get_standalone_admin_link(
				'/forms/edit/' . (string) $form_id
			);
			$tags['%ADMIN_SUBMISSION_LINK%'] = SystemEndpoint::get_submission_admin_link(
				(string) $this->submission_handler->get_submission_id()
			);
		}

		return $tags;
	}

	/**
	 * Get the callback for SlateJS mentions renderer scoped to the form and
	 * submission.
	 *
	 * @return callable Callback.
	 */
	public function get_slatejs_mentions_callback() : callable {
		return [ $this, 'slatejs_mentions_renderer' ];
	}

	/**
	 * A mentions renderer scoped to the form and submission data. This can be
	 * used directly from the instance to a SlateJS model.
	 *
	 * It is upto the caller to properly set the `$nested` argument to prevent any
	 * circular calls.
	 *
	 * @param string $element_id ID of the element/mention.
	 * @param bool   $nested If true, then it will not render another element.
	 *
	 * @return string Rendered value.
	 *
	 * @throws \LogicException|InvalidOperationException If submission Id is not set.
	 */
	public function slatejs_mentions_renderer( string $element_id, bool $nested = false ) : string {
		$form_model = $this->submission_handler->get_form_model();

		// first take care of the built-in ones
		$form_data = $form_model->read();

		$first_name = $this->submission_handler->primitives()->get_primitive( 'fName' )
			?? \__( 'Anonymous', 'wp-eform' );
		$last_name = $this->submission_handler->primitives()->get_primitive( 'lName' );
		$full_name = $first_name . ( $last_name ? ' ' . $last_name : '' );

		switch ( $element_id ) {
			case '::submissionId::':
				return $this->submission_handler->get_submission_id();
			case '::formId::':
				return (string) $form_model->get_id();
			case '::formName::':
				return $form_data['name'];
			case '::invoiceId::':
				return '';
			case '::paymentFrequency::':
				return '';
			case '::paymentInterval::':
				return '';
			case '::paymentGatewayName::':
				return '';
			case '::paymentInvoice::':
				return '';
			case '::paymentStatus::':
				$payment_status = $this->submission_handler->get_paid();
				return $payment_status === 0
					? \__( 'unpaid', 'wp-eform' )
					: (
						$payment_status === 1
							? \__( 'paid', 'wp-eform' )
							: \__( 'not needed', 'wp-eform' )
					);
			case '::siteName::':
				return \get_bloginfo( 'name' );
			case '::name::':
				return $full_name;
			case '::fName::':
				return $first_name;
			case '::lName::':
				return $last_name;
			case '::email::':
				return $this->submission_handler->primitives()->get_primitive( 'email' ) ?? '';
			case '::phone::':
				return $this->submission_handler->primitives()->get_primitive( 'phone' ) ?? '';
			case '::totalSubmissions::':
				return Form::get_total_submission_count( $form_model->get_id() );
			case '::adminRemarks::':
				return \esc_html( $this->submission_handler->get_admin_remarks() );
		}

		// process the score related stuff
		if ( isset( $this->score_designation_mentions[ $element_id ] ) ) {
			return $this->score_designation_mentions[ $element_id ];
		}

		return $this->submission_handler->elements()->get_element_simple_value( $element_id, $nested );
	}

	/**
	 * Get HTML from a SlateJS editor children json (as stored in model.)
	 *
	 * @param string     $editor_json Editor JSON.
	 * @param bool       $is_admin Whether or not for administrator.
	 * @param string     $mode Render mode.
	 * @param null|array $exclude_mentions_characters Mentions characters to exlcude.
	 * @param bool       $render_mentions Whether to disable rendering mentions.
	 * @return string Rendered HTML.
	 */
	public function get_slatejs_html( string $editor_json, bool $is_admin = false, string $mode = 'multiline', ?array $exclude_mentions_characters = null, bool $render_mentions = true ) : string {
		return SlateJS::parseEditorChildrenJSON( $editor_json )
			->setRenderMentions( $this->get_slatejs_mentions_callback() )
			->setDynamicAnchorTags(
				$this->get_slatejs_dynamic_anchor_tags( $is_admin )
			)
			->getHTML( $mode, $exclude_mentions_characters, $render_mentions );
	}

	/**
	 * Get Text from a SlateJS editor children json (as stored in model.)
	 *
	 * @param string     $editor_json Editor JSON.
	 * @param bool       $is_admin Whether or not for administrator.
	 * @param string     $mode Render mode.
	 * @param null|array $exclude_mentions_characters Mentions characters to exlcude.
	 * @param bool       $render_mentions Whether to disable rendering mentions.
	 * @return string Rendered Text.
	 */
	public function get_slatejs_text( string $editor_json, bool $is_admin = false, string $mode = 'singleline', ?array $exclude_mentions_characters = null, bool $render_mentions = true ) : string {
		return SlateJS::parseEditorChildrenJSON( $editor_json )
			->setRenderMentions( $this->get_slatejs_mentions_callback() )
			->setDynamicAnchorTags(
				$this->get_slatejs_dynamic_anchor_tags( $is_admin )
			)
			->getText( $mode, $exclude_mentions_characters, $render_mentions );
	}
}
