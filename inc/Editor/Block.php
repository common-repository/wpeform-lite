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

use WPEForm\System\Init;
use WPEForm\System\SystemEndpoint;
use WPEForm\View\Front\Form as FormView;
use WPEForm\View\Front\UserPortal as UserPortalView;
use WPEForm\View\Front\Summary as SummaryView;
use function register_block_type;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Block rendering class.
 *
 * @package WPEForm\Editor
 */
class Block {

	/**
	 * Render a form in a block, given the form id.
	 *
	 * @param mixed $form_id The form id.
	 * @return string
	 */
	public static function render_form( $form_id ) {
		if ( ! $form_id ) {
			return '<p>' . \__( 'ERROR: No form id provided.', 'wp-eform' ) . '</p>';
		}

		[ $form_data ] = FormView::get_form_data_and_slug( (int) $form_id );
		if ( ! $form_data ) {
			return '<p>' . \__( 'ERROR: The form no longer exists.', 'wp-eform' ) . '</p>';
		}

		// All good
		// increase form view count
		// if not being viewed by the owner

		FormView::increase_form_view_count( (int) $form_id, $form_data );
		// now enqueue and print stuff
		$assets = FormView::enqueue_assets( true );
		return FormView::get_container(
			[
				'form_id' => $form_id,
				'form_data' => $form_data,
			],
			false,
			$assets
		);
	}

	/**
	 * Render user portal.
	 *
	 * @return string
	 */
	public static function render_userportal() {
		$config = UserPortalView::get_userportal_config_from_settings();
		$assets = UserPortalView::enqueue_assets( true );
		return UserPortalView::get_container(
			$config,
			false,
			$assets
		);
	}

	/**
	 * Render Summary page.
	 *
	 * @return string
	 */
	public static function render_summary() {
		$config = SummaryView::get_summary_config_from_request();
		$assets = SummaryView::enqueue_assets( true );

		return SummaryView::get_container(
			$config,
			false,
			$assets
		);
	}

	/**
	 * Register all blocks.
	 *
	 * @return void
	 */
	public static function register_blocks() {
		// check if register block actually exists
		if ( ! \function_exists( 'register_block_type' ) ) {
			return;
		}

		try {
			$enqueue = Init::enqueue();
			$fontawesome = $enqueue->register(
				'fontawesome',
				'main',
				[
					'js' => true,
					'css' => true,
					'js_dep' => [],
					'css_dep' => [],
					'in_footer' => true,
					'media' => 'all',
				]
			);

			$assets = $enqueue->register(
				'editor', 'blocks', [
					'js' => true,
					'css' => true,
					'js_dep' => [
						$enqueue->getPrimaryJsHandle( $fontawesome ),
					],
					'css_dep' => [
						$enqueue->getPrimaryCssHandle( $fontawesome ),
					],
					'in_footer' => false,
					'media' => 'all',
				]
			);
			$main_block_js = $enqueue->getPrimaryJsHandle( $assets );
			$main_block_css = $enqueue->getPrimaryCssHandle( $assets );

			SystemEndpoint::append_wpeformgraphqlapp_to_handle(
				$main_block_js
			);

			$blocks_manifest = \json_decode(
				\file_get_contents( WP_EFORM_ABSPATH . 'inc/Editor/dictionary.json' ),
				true
			);

			$block_dependencies = [
				'api_version' => 2,
				'editor_script' => $main_block_js,
			];
			if ( $main_block_css ) {
				$block_dependencies['editor_style'] = $main_block_css;
			} else {
				$block_dependencies['editor_style'] = $enqueue->getPrimaryCssHandle( $fontawesome );
			}

			// register blocks
			// form
			register_block_type(
				'wp-eform/form',
				\array_merge(
					$block_dependencies,
					[
						'render_callback' => function( $block_attributes, $content ) {
							$form_id = \is_array( $block_attributes )
								&& isset( $block_attributes['formId'] )
									? $block_attributes['formId']
									: 0;
							return self::render_form( $form_id );
						},
						'attributes' => $blocks_manifest['form']['attributes'],
					]
				)
			);

			// user portal
			register_block_type(
				'wp-eform/user-portal',
				\array_merge(
					$block_dependencies,
					[
						'render_callback' => function( $block_attributes, $content ) {
							return self::render_userportal();
						},
						'attributes' => $blocks_manifest['userPortal']['attributes'],
					]
				)
			);

			// summary
			register_block_type(
				'wp-eform/summary',
				\array_merge(
					$block_dependencies,
					[
						'render_callback' => function( $block_attributes, $content ) {
							return self::render_summary();
						},
						'attributes' => $blocks_manifest['summary']['attributes'],
					]
				)
			);
			// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
		} catch ( \Exception $e ) {
			// brood silently
		}
	}
}
