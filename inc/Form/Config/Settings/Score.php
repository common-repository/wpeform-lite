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
 * @subpackage Form\Config\Settings
 */

namespace WPEForm\Form\Config\Settings;

use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Handler\Submission as SubmissionHandler;

use function WPEForm\Helpers\format_number;
use function WPEForm\Helpers\get_default_settings_scorelists;
use function WPEForm\Helpers\get_element_from_array_by_id;

use WPEForm\GraphQL\Registry;
use WPEForm\Util\SlateJS;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for Score.
 */
class Score extends Base {
	/**
	 * Primary score Id. This should always be present.
	 *
	 * @var string
	 */
	const PRIMARY_SCORE_ID = 'default-score';

	/**
	 * {@inheritDoc}
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_side_effect( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ): void {
		// no side effect
	}

	/**
	 * Get designation name or description, given designations config and score.
	 *
	 * @see {src/core/form/form-submission/components/SlateViewWithData/index.tsx::getDesignation}
	 *
	 * @param SubmissionHandler $handler Submission handler instance.
	 * @param string            $type Type, could be 'name' or 'description'.
	 * @param array             $designations Designations config.
	 * @param array             $score Score data.
	 * @return string Output.
	 */
	protected function get_designation( SubmissionHandler $handler, string $type, array $designations, array $score ) : string {
		$possible_return = '';
		foreach ( $designations as $des ) {
			if ( $des['scoreCategory'] === $score['scoreId'] ) {
				$current_score_range_check_val = $score['obtained'];
				if ( $des['fromToType'] === 'percentage' ) {
					// we supress warning because it could be division by 0
					// phpcs:disable WordPress.PHP.NoSilencedErrors.Discouraged
					$current_score_range_check_val = ( @( $score['obtained'] / $score['outof'] ) * 100 );
					// phpcs:enable WordPress.PHP.NoSilencedErrors.Discouraged
				}

				// check if the range checks out
				if (
					\is_finite( $current_score_range_check_val ) &&
					$current_score_range_check_val >= $des['from'] &&
					$current_score_range_check_val <= $des['to']
				) {
					$possible_return = SlateJS::parseEditorChildrenJSON(
						$type === 'name'
							? $des['name']
							: $des['description']
					)->setRenderMentions(
						$handler->slate()->get_slatejs_mentions_callback()
					)->getHTML( $type === 'name' ? 'singleline' : 'multiline' );
				}
			}
		}
		return $possible_return;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param SubmissionHandler $handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_mutation( SubmissionHandler $handler, array $config, bool $is_update, bool $admin_update ): void {
		$score_data = $handler->score()->get_score_data( true );

		// if it has no score, then no need
		if ( ! $score_data ) {
			return;
		}

		$mentions = [];
		$score_config = $config['scoreLists'];
		$designations = $config['designations'];
		// If score config is empty, then bail
		if ( empty( $score_config ) ) {
			return;
		}

		$precision = $config['precision'];

		// set the primary score outcome name
		$primary_score = get_element_from_array_by_id( $score_config, self::PRIMARY_SCORE_ID );
		if ( $primary_score ) {
			$handler->score()->set_primaryscore_metadata(
				[
					'label' => SlateJS::parseEditorChildrenJSON(
						$primary_score['outcomeName']
					)->setRenderMentions(
						$handler->slate()->get_slatejs_mentions_callback()
					)->getHTML( 'singleline' ),
					'obtained' => format_number( $handler->score()->get_score_obtained(), $precision ),
					'outof' => format_number( $handler->score()->get_max_score(), $precision ),
					'formatter' => function( $value ) use ( $precision ) {
						return format_number( \floatval( $value ), $precision );
					},
				]
			);
		}

		// All set, now calculate the highest score
		$highest_score_id = null;

		foreach ( $score_data as $score_key => $score ) {
			// First calculate the highest score
			if ( ! $highest_score_id ) {
				$highest_score_id = $score_key;
			} else {
				$last_score = $score_data[ $highest_score_id ];
				// we supress error because score could be a division by 0
				// phpcs:disable WordPress.PHP.NoSilencedErrors.Discouraged
				$last_score_percentage = @( $last_score['obtained'] / $last_score['outof'] );
				$current_score_percentage = @( $score['obtained'] / $score['outof'] );
				// phpcs:enable WordPress.PHP.NoSilencedErrors.Discouraged
				if (
					\is_finite( $last_score_percentage ) &&
					\is_finite( $current_score_percentage ) &&
					$current_score_percentage > $last_score_percentage
				) {
					$highest_score_id = $score_key;
				}
			}

			// and add score specific mentions
			$current_score_config = get_element_from_array_by_id( $score_config, $score_key );

			$mentions[ "::score-obtained-{$score_key}::" ] = format_number( $score['obtained'], $precision );
			$mentions[ "::score-outof-{$score_key}::" ] = format_number( $score['outof'], $precision );

			if ( $current_score_config ) {
				$mentions[ "::score-name-{$score_key}::" ] =
					SlateJS::parseEditorChildrenJSON(
						$current_score_config['outcomeName']
					)->setRenderMentions(
						$handler->slate()->get_slatejs_mentions_callback()
					)->getHTML( 'singleline' );

				$mentions[ "::score-description-{$score_key}::" ] =
					SlateJS::parseEditorChildrenJSON(
						$current_score_config['outcomeDescription']
					)->setRenderMentions(
						$handler->slate()->get_slatejs_mentions_callback()
					)->getHTML( 'multiline' );
			}

			$mentions[ "::score-designation-{$score_key}::" ] = $this->get_designation(
				$handler,
				'name',
				$designations,
				$score
			);

			$mentions[ "::score-designationd-{$score_key}::" ] = $this->get_designation(
				$handler,
				'description',
				$designations,
				$score
			);
		}

		// Now calculate the mentions for highest score related stuff
		$highest_score_config = get_element_from_array_by_id( $score_config, $highest_score_id );

		$mentions['::score-obtained-high::'] = format_number(
			$score_data[ $highest_score_id ]['obtained'],
			$precision
		);

		$mentions['::score-outof-high::'] = format_number(
			$score_data[ $highest_score_id ]['outof'],
			$precision
		);

		if ( $highest_score_config ) {
			$mentions['::score-name-high::'] =
				SlateJS::parseEditorChildrenJSON(
					$highest_score_config['outcomeName']
				)->setRenderMentions(
					$handler->slate()->get_slatejs_mentions_callback()
				)->getHTML( 'singleline' );

			$mentions['::score-description-high::'] =
				SlateJS::parseEditorChildrenJSON(
					$highest_score_config['outcomeDescription']
				)->setRenderMentions(
					$handler->slate()->get_slatejs_mentions_callback()
				)->getHTML( 'singleline' );
		}

		$mentions['::score-designation-high::'] = $this->get_designation(
			$handler,
			'name',
			$designations,
			$score_data[ $highest_score_id ]
		);

		$mentions['::score-designationd-high::'] = $this->get_designation(
			$handler,
			'description',
			$designations,
			$score_data[ $highest_score_id ]
		);

		// add the mentions to the handler
		$handler->score()->set_score_and_designation_mentions( $mentions );
		$handler->score()->set_score_settings( $config );
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			// score precision
			'precision' => FieldVar::var( 2, Type::int() ),
			// categorized score list
			'scoreLists' => FieldVar::var(
				get_default_settings_scorelists(),
				Type::listOf(
					Type::nonNull( Registry::get( 'scoreItem', 'type/form' ) )
				),
				Type::listOf(
					Type::nonNull( Registry::get( 'scoreItem', 'input/form' ) )
				)
			)->setValidator( 'WPEForm\\Helpers\\validate_list_items_with_id_key' ),
			'designations' => FieldVar::var(
				[],
				Type::listOf(
					Registry::get( 'scoreDesignation', 'type/form' )
				),
				Type::listOf(
					Type::nonNull( Registry::get( 'scoreDesignation', 'input/form' ) )
				)
			)->setValidator( 'WPEForm\\Helpers\\validate_list_items_with_id_key' ),
		];
		return $config_vars;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function is_user_facing() : bool {
		return true;
	}
}
