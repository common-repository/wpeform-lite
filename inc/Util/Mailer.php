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

use LogicException;
use WPEForm\GeneralDeps\Pelago\Emogrifier\CssInliner;
use WPEForm\GeneralDeps\Pelago\Emogrifier\HtmlProcessor\HtmlNormalizer;
use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A mailer class to send emails using system (WP) functions, supporting
 * templating and style.
 *
 * @package WPEForm\Util
 */
class Mailer {
	/**
	 * Style Id for styling the email.
	 *
	 * @var Style
	 */
	protected $style;

	/**
	 * Send to addresses.
	 *
	 * @var array
	 */
	protected $to_addresses = [];

	/**
	 * From Address.
	 *
	 * @var string|null
	 */
	protected $from_address = null;

	/**
	 * Subject line.
	 *
	 * @var string|null
	 */
	protected $subject_line = null;

	/**
	 * Email body.
	 *
	 * @var string|null
	 */
	protected $body_content = null;

	/**
	 * Email data (like submission preview HTML.)
	 *
	 * @var string|null
	 */
	protected $data_content = null;

	/**
	 * Template file.
	 *
	 * @var string|null
	 */
	protected $template_file = 'postmark';

	/**
	 * Heading of the email.
	 *
	 * @var string|null
	 */
	protected $heading_text = null;

	/**
	 * Heading link of the email.
	 *
	 * @var string|null
	 */
	protected $heading_link = null;

	/**
	 * Header content (with HTML).
	 *
	 * @var string|null
	 */
	protected $header_content = null;

	/**
	 * Footer content (with HTML).
	 *
	 * @var string|null
	 */
	protected $footer_content = null;

	/**
	 * Email view online URL.
	 *
	 * @var string|null
	 */
	protected $email_url = null;

	/**
	 * CTA button data.
	 *
	 * @var string[]
	 */
	protected $cta_config = [
		'label' => null,
		'link' => null,
		'body' => null,
	];

	/**
	 * Array of attributes.
	 *
	 * ```
	 * [
	 *   'value' => string,
	 *   'label' => string,
	 * ][]
	 * ```
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Additional email headers.
	 *
	 * @var array
	 */
	protected $email_headers = [];

	/**
	 * Reply to address.
	 *
	 * @var string|null
	 */
	protected $reply_to_addr = null;

	/**
	 * Set reply to address.
	 *
	 * @param string $addr The address to reply to.
	 * @return Mailer Current instance.
	 */
	public function reply_to( string $addr ) : Mailer {
		$this->reply_to_addr = $addr;
		return $this;
	}

	/**
	 * Set email headers.
	 *
	 * @param array|string $headers Additional headers. One per line or array.
	 * @return Mailer Current instance.
	 */
	public function set_email_headers( $headers ) : Mailer {
		if ( \is_array( $headers ) ) {
			$this->email_headers = $headers;
		} else {
			$headers = \str_replace( "\r\n", "\n", $headers );
			$headers = \explode( "\n", $headers );
			$this->email_headers = $headers;
		}
		return $this;
	}

	/**
	 * Set attributes for the email.
	 *
	 * @param array $attributes Array of attributes, with label and value.
	 * @return Mailer Current instance.
	 */
	public function attrs( array $attributes ) : Mailer {
		$this->attributes = parse_args(
			[ 'val' => $attributes ],
			[
				'val' => [
					[
						'value' => '',
						'label' => '',
					],
				],
			]
		)['val'];
		return $this;
	}

	/**
	 * Set email view URL.
	 *
	 * @param string $url The URL.
	 * @return Mailer Current instance.
	 */
	public function email_url( string $url ) : Mailer {
		$this->email_url = $url;
		return $this;
	}

	/**
	 * Set the CTA button config.
	 *
	 * @param string      $label Label of the button.
	 * @param string      $link Link of the button.
	 * @param string|null $body Body of the CTA block.
	 *
	 * @return Mailer Current instance.
	 */
	public function cta( string $label, string $link, ?string $body = null ) : Mailer {
		$this->cta_config = [
			'label' => $label,
			'link' => $link,
			'body' => $body,
		];
		return $this;
	}

	/**
	 * Set the header of the email.
	 *
	 * @param string $header The header HTML.
	 * @return Mailer Current instance.
	 */
	public function header( string $header ) : Mailer {
		$this->header_content = $header;
		return $this;
	}

	/**
	 * Set the footer of the email.
	 *
	 * @param string $footer The footer HTML.
	 * @return Mailer Current instance.
	 */
	public function footer( string $footer ) : Mailer {
		$this->footer_content = $footer;
		return $this;
	}

	/**
	 * Set heading of the Email.
	 *
	 * @param string $heading Heading HTML.
	 * @param string $link Heading link.
	 *
	 * @return Mailer Current instance.
	 */
	public function heading( string $heading, string $link ) : Mailer {
		$this->heading_text = $heading;
		$this->heading_link = $link;
		return $this;
	}

	/**
	 * Set Style for the Mailer. Should correspond to a style JSON.
	 *
	 * @param Style $style A Style instance.
	 * @return Mailer Current instance.
	 */
	public function set_style( Style $style ) : Mailer {
		$this->style = $style;
		return $this;
	}

	/**
	 * Get template file path, based on template Id.
	 *
	 * @param string $template_id Template Id.
	 * @return string File path.
	 */
	protected function get_template_file_path( string $template_id ) : string {
		return \dirname( __FILE__ ) . '/mailer-templates/' . $template_id . '.php';
	}

	/**
	 * Set the template file id. It checks if it is actually present and if not,
	 * it will fallback to the default one.
	 *
	 * @param string $template_id Id of the template.
	 * @return Mailer Current instance.
	 */
	public function set_template( string $template_id ) : Mailer {
		$template_file = $template_id;
		$file = $this->get_template_file_path( $template_id );
		if ( ! \file_exists( $file ) ) {
			$template_file = 'postmark';
		}
		$this->template_file = $template_file;
		return $this;
	}

	/**
	 * Set send to addresses. Could be a single or multiple addresses, in array
	 * or in CSV. This checks of valid email addresses and rejects if invalid.
	 *
	 * @param mixed $addresses Addresses, either array or comma separated list.
	 * @return Mailer Current instance.
	 */
	public function to( $addresses ) : Mailer {
		// get the addresses based on type of input
		if ( \is_array( $addresses ) ) {
			$parsed_addresses = $addresses;
		} else {
			$parsed_addresses = \explode( ',', (string) $addresses );
			$parsed_addresses = \array_map( '\\trim', $parsed_addresses );
		}

		// make sure all of them are valid emails
		$parsed_addresses = \array_filter( $parsed_addresses, '\\is_email' );

		// set
		$this->to_addresses = $parsed_addresses;

		return $this;
	}

	/**
	 * Set from address. Must be RFC 2822 compliant.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_mail/
	 *
	 * @param string $from From address.
	 * @return Mailer Current instance.
	 */
	public function from( string $from ) : Mailer {
		$this->from_address = $from;
		return $this;
	}

	/**
	 * Set subject line.
	 *
	 * @param string $subject Subject.
	 * @return Mailer Current instance.
	 */
	public function subject( string $subject ) : Mailer {
		$this->subject_line = $subject;
		return $this;
	}

	/**
	 * Set the email body.
	 *
	 * @param string $body Body HTML, do not put `<html><body>` tags, those
	 *                     will be handled automatically.
	 *
	 * @return Mailer Current instance.
	 */
	public function body( string $body ) : Mailer {
		$this->body_content = $body;
		return $this;
	}

	/**
	 * Set the email data. This part will be shown after CTA button (if enabled).
	 *
	 * @param string $data The data.
	 * @return Mailer Current instane.
	 */
	public function data( string $data ) : Mailer {
		$this->data_content = $data;
		return $this;
	}

	/**
	 * Get email HTML from the current instance.
	 *
	 * @return string Email HTML.
	 * @throws LogicException If needed variables are not set.
	 */
	public function get_html() : string {
		// things to check for
		$needed_vars = [
			'style',
			'subject_line',
			'body_content',
			'heading_text',
			'header_content',
			'footer_content',
		];
		foreach ( $needed_vars as $nv ) {
			if ( ! isset( $this->{$nv} ) ) {
				throw new LogicException( "The {$nv} of the Mailer is not set." );
			}
		}

		// prepare the variables
		$style = $this->style;
		$heading = $this->heading_text;
		$heading_link = $this->heading_link;
		$header_content = $this->header_content;
		$subject = $this->subject_line;
		$body = $this->body_content;
		$data = $this->data_content;
		$footer_content = $this->footer_content;
		$email_view_online_url = $this->email_url;
		$cta_label = $this->cta_config['label'];
		$cta_url = $this->cta_config['link'];
		$cta_body = $this->cta_config['body'];
		$attributes = $this->attributes;

		\ob_start();
		include $this->get_template_file_path( $this->template_file );
		$html = \ob_get_clean();

		// create instance
		$css_inliner = CssInliner::fromHtml( $html );

		// output
		return HtmlNormalizer::fromHtml(
			$css_inliner->inlineCss()->render()
		)->render();
	}

	/**
	 * Send the email.
	 *
	 * @return void
	 *
	 * @throws LogicException If style, addresses, from_address, subject or body is not set.
	 */
	public function mail() : void {
		// things to check for
		$needed_vars = [
			'to_addresses',
			'from_address',
		];
		foreach ( $needed_vars as $nv ) {
			if ( ! isset( $this->{$nv} ) || empty( $this->{$nv} ) ) {
				throw new LogicException( "The {$nv} of the Mailer is not set." );
			}
		}

		// get the email html, where the rest of the needed variables are checked
		$email_html = $this->get_html();

		// prepare the headers
		$headers = [
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . $this->from_address,
		];
		if ( ! empty( $this->email_headers ) ) {
			$headers = \array_merge( $headers, $this->email_headers );
		}
		if ( $this->reply_to_addr ) {
			$headers[] = 'Reply-To: ' . $this->reply_to_addr;
		}

		$send_to_addresses = $this->to_addresses;
		$to = \array_shift( $send_to_addresses );
		foreach ( $send_to_addresses as $addr ) {
			$headers[] = 'Cc: ' . $addr;
		}

		// send
		\wp_mail(
			$to,
			$this->subject_line,
			$email_html,
			$headers
		);
	}
}
