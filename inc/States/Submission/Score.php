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
 * @subpackage States\Submission
 */

namespace WPEForm\States\Submission;

use WPEForm\Handler\Submission;

use function WPEForm\Helpers\convert_dictionary_to_list;
use function WPEForm\Helpers\convert_list_to_dictionary;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Score builder class.
 *
 * @package WPEForm\States\Submission
 */
class Score extends Base {
	/**
	 * Score obtained throughout all elements for the primary score.
	 *
	 * @var float
	 */
	private $score_obtained = 0;

	/**
	 * Max possible score for the primary score.
	 *
	 * @var float
	 */
	private $max_score = 0;

	/**
	 * Whether or not this element has score.
	 *
	 * @var bool
	 */
	private $has_score = false;

	/**
	 * Score data which stores all possible scores.
	 *
	 * @var array
	 */
	private $score_data = [];

	/**
	 * Primary score outcome name. Should be set by the mutators.
	 *
	 * @var array|null
	 */
	private $score_metadata = null;

	/**
	 * Mentions for score designation and mentions.
	 *
	 * @var array
	 */
	private $score_designation_mentions = [];

	/**
	 * Score settings.
	 *
	 * Some settings class should override this.
	 *
	 * @var array
	 */
	private $score_settings = [];

	/**
	 * Get an empty score data with proper structure.
	 *
	 * @param string $id ID of the score.
	 * @return array Empty score data.
	 */
	public static function get_empty_score_data( string $id ) : array {
		return [
			'scoreId' => $id,
			'has' => false,
			// important to have the .0 to tell our `parse_args` that it is a float.
			'outof' => 0.0,
			'obtained' => 0.0,
		];
	}

	/**
	 * Set score on the instance.
	 *
	 * @param bool      $has_score Whether has score.
	 * @param float|int $score_obtained Score obtained.
	 * @param float|int $max_score Maximum score.
	 * @param array     $score_data Score breakdown data.
	 * @return Submission
	 */
	public function set_score( bool $has_score, float $score_obtained = 0, float $max_score = 0, array $score_data = [] ): Submission {
		$this->has_score = $has_score;

		if ( ! $this->has_score ) {
			$this->score_obtained = 0;
			$this->max_score = 0;
			$this->score_data = [];

			return $this->submission_handler;
		}

		$this->score_obtained = $score_obtained;
		$this->max_score = $max_score;
		$this->score_data = $score_data;

		return $this->submission_handler;
	}

	/**
	 * Reset score data on the instance.
	 *
	 * @return void
	 */
	public function reset_score() : void {
		$this->set_score( false );
	}

	/**
	 * Get score obtained from processed elements from the instance.
	 * It returns null if elements don't have any scorable config.
	 *
	 * @return float|null
	 */
	public function get_score_obtained() : ?float {
		if ( ! $this->has_score ) {
			return null;
		}
		return $this->score_obtained;
	}

	/**
	 * Get maximum score one can obtain from processed elements from the instance.
	 * It returns null if elements don't have any scorable config.
	 *
	 * @return float|null
	 */
	public function get_max_score() : ?float {
		if ( ! $this->has_score ) {
			return null;
		}
		return $this->max_score;
	}

	/**
	 * Get cumulative score data for all listed scores in the form.
	 *
	 * @param bool $dictionary Whether or not to return in dictionary format.
	 *
	 * @return array|null
	 */
	public function get_score_data( $dictionary = false ) : ?array {
		if ( ! $this->has_score ) {
			return null;
		}
		if ( $dictionary ) {
			return $this->score_data;
		}
		return convert_dictionary_to_list(
			$this->score_data,
			'scoreId'
		);
	}

	/**
	 * Set score data from db stored values.
	 *
	 * @param bool  $has_score Whether or not submission has score value.
	 * @param float $score Score obtained.
	 * @param float $max_score Maximum score to be obtained.
	 * @param array $score_data Cumulative score data.
	 *
	 * @return void
	 */
	public function set_score_from_db( bool $has_score, float $score = 0, float $max_score = 0, array $score_data ) : void {
		if ( ! $has_score ) {
			$this->has_score = false;
			$this->max_score = 0;
			$this->score_obtained = 0;
			$this->score_data = [];
		} else {
			$this->has_score = true;
			$this->score_obtained = $score;
			$this->max_score = $max_score;
			$this->score_data = convert_list_to_dictionary( $score_data, 'scoreId' );
		}
	}

	/**
	 * Set score and designation mentions data.
	 *
	 * @param array $mentions The mentions data.
	 *
	 * @return void
	 */
	public function set_score_and_designation_mentions( array $mentions ) : void {
		$this->score_designation_mentions = $mentions;
	}

	/**
	 * Get score and designation mentions.
	 *
	 * @return array
	 */
	public function get_score_and_designation_mentions() : array {
		return $this->score_designation_mentions;
	}

	/**
	 * Set score settings.
	 *
	 * @param array $settings Score settings as per config. Check FormSettingsScoreInput.
	 * @return void
	 */
	public function set_score_settings( array $settings ) : void {
		$this->score_settings = $settings;
	}

	/**
	 * Get score settings.
	 *
	 * @return array
	 */
	public function get_score_settings() : array {
		return $this->score_settings;
	}

	/**
	 * Set primary score outcome name.
	 *
	 * @param array{label: string, obtained: string, outof: string} $data Score data.
	 * @return void
	 */
	public function set_primaryscore_metadata( array $data ) : void {
		$this->score_metadata = $data;
	}

	/**
	 * Get score metadata for the form. Returns null if the submission doesn't have any score.
	 *
	 * @return null|array
	 */
	public function get_primaryscore_metadata(): ?array {
		if ( ! $this->has_score ) {
			return null;
		}

		return $this->score_metadata;
	}
}
