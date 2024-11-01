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
 * @package EForm
 * @subpackage Editor
 */

namespace WPEForm\Editor;

use WPEForm\Exception\InvalidOperationException;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class to manage all tinyMCE and shortcode related stuff.
 *
 * @package WPEForm\Editor
 */
class Shortcode {
	/**
	 * TinyMCE custom plugin name.
	 */
	const TMCECLASS = 'wpEFormTinyMCE';

	/**
	 * Add a TInyMCE plugin compatible JS file to the editor instance.
	 *
	 * @param array $plugin_array Array of registered tinyMCE plugins.
	 * @return array Modified array
	 */
	public static function add_tinymce_plugin( $plugin_array ) {
		$plugin_array[ self::TMCECLASS ] = \plugins_url( '/static/tinymce/register.js', \WP_EFORM_PLUGIN );

		return $plugin_array;
	}

	/**
	 * Adds a button to the TinyMCE editor which the user can click to access
	 * our shortcode generator.
	 *
	 * @param array $buttons Array of registered TinyMCE buttons.
	 * @return array Modified TinyMCE buttons.
	 */
	public static function add_tinymce_toolbar_button( $buttons ) {
		\array_push( $buttons, self::TMCECLASS );
		return $buttons;
	}

	/**
	 * Register tinyMCE extensions for this plugin.
	 *
	 * @return void
	 */
	public static function register_tinymce_extension() {
		// if current user cannot edit posts or pages, then there's no point
		if ( ! \current_user_can( 'edit_posts' ) && ! \current_user_can( 'edit_pages' ) ) {
			return;
		}

		// if not using rich editing, then no point
		if ( \get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}

		// if cannot create forms, then no point
		if ( ! \current_user_can( \WPEForm\Auth\Form::MANAGE ) ) {
			return;
		}

		// Setup some filters
		add_filter( 'mce_buttons', [ self::class, 'add_tinymce_toolbar_button' ] );
		add_filter( 'mce_external_plugins', [ self::class, 'add_tinymce_plugin' ] );
	}

	/**
	 * Render form shortcode.
	 *
	 * `[wpeform_form id="12"]` is the shortcode signature.
	 *
	 * @param mixed $atts Shortcode attributes.
	 * @return string Shortcode output.
	 */
	public static function render_form_shortcode( $atts ) {
		$attributes = \shortcode_atts(
			[
				'id' => '0',
			],
			$atts,
			'wpeform_form'
		);
		$form_id = $attributes['id'] ?? '0';
		return Block::render_form( $form_id );
	}

	/**
	 * Render summary shortcode.
	 *
	 * `[wpeform_summary]` is the shortcode signature.
	 *
	 * @param mixed $atts Shortcode attributes.
	 * @return string Rendered HTML.
	 */
	public static function render_summary_shortcode( $atts ) {
		return Block::render_summary();
	}

	/**
	 * Render userportal shortcode.
	 *
	 * `[wpeform_userportal]` is the shortcode signature.
	 *
	 * @param mixed $atts Shortcode attributes.
	 * @return string Rendered HTML.
	 */
	public static function render_userportal_shortcode( $atts ) {
		return Block::render_userportal();
	}

	/**
	 * Register all shortcodes for this plugin.
	 *
	 * @return void
	 */
	public static function register_shortcodes() {
		\add_shortcode( 'wpeform_form', [ self::class, 'render_form_shortcode' ] );
		\add_shortcode( 'wpeform_summary', [ self::class, 'render_summary_shortcode' ] );
		\add_shortcode( 'wpeform_userportal', [ self::class, 'render_userportal_shortcode' ] );
	}

	/**
	 * Register all needed stuff for shortcodes, including generator and
	 * shortcode renderers.
	 *
	 * @return void
	 */
	public static function register() {
		self::register_tinymce_extension();
		self::register_shortcodes();
	}
}
