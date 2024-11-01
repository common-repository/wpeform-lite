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
 * @subpackage Controller
 */

namespace WPEForm\Controller;

use DateInterval;
use DateTime;
use DateTimeZone;
use WPEForm\Exception\InsufficientPermissionException;
use WPEForm\Exception\InvalidOperationException;
use WPEForm\Exception\ValidationException;

use function WPEForm\Helpers\get_submissions_interval_blanks;
use function WPEForm\Helpers\parse_args;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A controller class for Form Dashboard.
 *
 * The methods reflects the ones in our GraphQL Server.
 *
 * This class is responsible for knowing the current user access/auth level
 * and returning corresponding data to the GraphQL server by calling proper
 * methods on model.
 *
 * @property \WPEForm\Model\Dashboard $model
 * @property \WPEForm\Auth\Dashboard  $auth
 */
class Dashboard extends Base {
	/**
	 * Get GraphQL compatible data from model for a single dashboard.
	 *
	 * @return array
	 */
	protected function get_data_from_model() {
		// TODO: Implement
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws InsufficientPermissionException If user tries to filter by trashed and cannot delete.
	 *
	 * @param null|array $filter Filter arguments.
	 * @return array
	 */
	protected function verify_filters_with_auth( ? array $filter ) : array {
		$filter = parent::verify_filters_with_auth( $filter );
		// TODO: requires much implementation
		return $filter;
	}

	/**
	 * Normalize a single node of edges used in GraphQL.
	 *
	 * @param array $node Raw node as retrieved from database.
	 * @param array $pagination Pagination arguments.
	 * @param array $filter Filter arguments.
	 * @return array
	 */
	protected function normalize_collection_node( $node, $pagination, $filter ) {
		// TODO: maybe require implementation
		return $node;
	}

	/**
	 * Get cumulative stats adhering to CumulativeFormsStat GraphQL Type.
	 *
	 * @throws InsufficientPermissionException If current user cannot create forms.
	 *
	 * @return array
	 */
	public static function get_cumulative_stats() {
		$auth = new \WPEForm\Auth\Form();

		if ( ! $auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user cannot read stats.' );
		}
		$current_user_id = $auth->get_current_user_id();

		return \WPEForm\Model\Dashboard::get_cumulative_stats( $current_user_id );
	}

	/**
	 * Get total forms, views and submission stats.
	 *
	 * @return array|null Associative array if stat was found, null otherwise.
	 *
	 * @throws InsufficientPermissionException If current user cannot create a form.
	 */
	public static function get_total_count_stats() {
		$auth = new \WPEForm\Auth\Form();

		if ( ! $auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user cannot read stats.' );
		}
		$current_user_id = $auth->get_current_user_id();

		return \WPEForm\Model\Dashboard::get_total_count_stats( $current_user_id );

	}

	/**
	 * Get performing forms statistics. Adheres to PerformingFormStat GraphQL Type.
	 *
	 * @param int $form_count Number of forms to limit with.
	 * @return array
	 * @throws InsufficientPermissionException If current user cannot create forms.
	 * @throws ValidationException If form count value is greater than 100.
	 */
	public static function get_performing_forms_stats( int $form_count ) {
		$auth = new \WPEForm\Auth\Form();

		if ( ! $auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user cannot read stats.' );
		}
		$current_user_id = $auth->get_current_user_id();

		if ( $form_count > 100 ) {
			throw new ValidationException( 'Form count cannot be greater than 100.' );
		}

		$stats = \WPEForm\Model\Dashboard::get_performing_forms_stat(
			$current_user_id,
			$form_count
		);
		foreach ( $stats as $index => $val ) {
			$stats[ $index ] = parse_args(
				$val,
				[
					'formId' => '0',
					'formName' => '',
					'viewCount' => 0,
					'submissionCount' => 0,
					'conversionRate' => 0.0,
				]
			);
		}

		return $stats;
	}

	/**
	 * Get submission stats in given intervals.
	 *
	 * @param string $type Type of the interval.
	 * @return array
	 * @throws InsufficientPermissionException If current user cannot create forms.
	 */
	public static function get_submissions_interval_stat( string $type ) {
		$auth = new \WPEForm\Auth\Form();

		if ( ! $auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user cannot read stats.' );
		}
		$current_user_id = $auth->get_current_user_id();
		$data = \WPEForm\Model\Dashboard::get_submissions_interval_stat(
			$current_user_id,
			$type
		) ?? [];

		$normalized_data = [];
		$previous_data = null;
		foreach ( $data as $val ) {
			if ( ! isset( $val['period'] ) || empty( $val['period'] ) ) {
				continue;
			}
			$new_data = [
				'submissionCount' => \intval( $val['submissionCount'] ?? 0 ),
				'period' => (string) $val['period'],
			];
			// must fill blank points with zero submissions
			$blanks = [];
			if ( $previous_data !== null ) {
				$blanks = get_submissions_interval_blanks(
					$previous_data['period'],
					$new_data['period'],
					$type
				);
				if ( ! empty( $blanks ) ) {
					\array_push( $normalized_data, ...$blanks );
				}
			}
			$normalized_data[] = $new_data;
			$previous_data = $new_data;
		}

		return $normalized_data;
	}

	/**
	 * Get submission stat, adhering to SubmissionStatType GraphQL Type.
	 *
	 * @param int $since Number of days since today to get result for.
	 * @return array
	 * @throws InsufficientPermissionException If current user cannot create forms.
	 * @throws ValidationException If form count value is greater than 365.
	 */
	public static function get_submission_stat( int $since ) {
		$auth = new \WPEForm\Auth\Form();

		if ( ! $auth->can_current_user_create() ) {
			throw new InsufficientPermissionException( 'Current user cannot read stats.' );
		}
		$current_user_id = $auth->get_current_user_id();

		if ( $since > 365 ) {
			throw new ValidationException( 'Since count cannot be greater than 365.' );
		}
		if ( $since < 1 ) {
			throw new ValidationException( 'Since count cannot be less than 1.' );
		}

		return \WPEForm\Model\Dashboard::get_submission_stat(
			$current_user_id,
			$since
		);
	}
}
