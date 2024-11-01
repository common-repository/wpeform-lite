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
 * @subpackage Model
 */

namespace WPEForm\Model;

use WPEForm\System\Init;

use function WPEForm\Helpers\get_maximum_datetime;
use function WPEForm\Helpers\get_minimum_datetime;
use function WPEForm\Helpers\split_datetime_into_ranges;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A Model class for managing Form Dashboard related DB operations.
 *
 * All of the operations are read only and doesn't correspond any delete on
 * actual data. Data can be sorted and filtered.
 */
class Dashboard extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @return string
	 */
	protected function get_table_name() {
		return '';
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array  $data Raw data from the database.
	 * @param string $purpose Purpose for normalization.
	 * @return array
	 */
	protected function normalize_data( $data, $purpose ) {
		return $data;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param int|null    $id Id of the entry.
	 * @param null|string $token Token of the entry.
	 * @return array
	 */
	protected function get_data_from_db( $id, $token = null ) {
		return [];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return array [ $wpdb insert result, last insert id ]
	 */
	protected function create_data_on_db( $data ) {
		return [ null, false ];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @param array $data Data to create on db.
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function update_data_on_db( $data ) {
		return null;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @global \WPDB $wpdb
	 *
	 * @return int|boolean False on failure, number of rows affected on success.
	 */
	protected function delete_data_on_db() {
		return null;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param array $pagination Pagination Arguments.
	 * @param array $filter Filter arguments.
	 * @return array [ $edges, $edges_count, $all_edges_count, $limit ]
	 */
	protected function get_edges_for_collection( $pagination, $filter ) {
		// does nothing
		return [ null, 0, 0, 0 ];
	}

	/**
	 * Get minimum and maximum form created dates in an associative array of
	 * `createdMin` and `createdMax`.
	 *
	 * @param int $owner_id Id of form owner.
	 * @return array|null
	 */
	public static function get_form_date_edges( int $owner_id ) {
		global $wpdb;
		$form_table = Init::$database['form'];

		// get form date edges

		/*
		SELECT
			MIN(created) createdMin,
			MAX(created) createdMax
		FROM
			wp_wpq_eform_form
		WHERE
			ownerid = 1
			AND trashed = 0;
		*/
		return $wpdb->get_row(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT
					MIN(created) createdMin,
					MAX(created) createdMax
				FROM {$form_table}
				WHERE
					ownerid = %d
				AND
					trashed = 0",
				$owner_id
			),
			\ARRAY_A
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}

	/**
	 * Get minimum and maximum submission created dates in an associative array of
	 * `createdMin` and `createdMax`.
	 *
	 * @param int $owner_id Id of form owner.
	 * @return array|null
	 */
	public static function get_submission_date_edges( int $owner_id ) {
		global $wpdb;
		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			MIN(s.created) createdMin,
			MAX(s.created) createdMax
		FROM
			wp_wpq_eform_submission s
			LEFT JOIN wp_wpq_eform_form f ON s.formId = f.id
		WHERE
			f.ownerid = 1
			AND f.trashed = 0
			AND s.trashed = 0;
		*/
		return $wpdb->get_row(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT
					MIN(s.created) createdMin,
					MAX(s.created) createdMax
				FROM
					{$submission_table} s
					LEFT JOIN {$form_table} f ON s.formId = f.id
				WHERE
					f.ownerid = %d
					AND (f.trashed = 0 OR f.trashed IS NULL)
					AND s.trashed = 0",
				$owner_id
			),
			\ARRAY_A
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}

	/**
	 * Get forms created in intervals, adhering to RangeBasedStatBreakdown GraphQL
	 * datatype.
	 *
	 * @param array $intervals Intervals.
	 * @param int   $owner_id Form owner Id.
	 * @return array Empty array on error.
	 */
	public static function get_forms_created_in_intervals( array $intervals, int $owner_id ) {
		global $wpdb;
		$form_table = Init::$database['form'];

		/*
		SELECT
			sum( if(f.created >= "2020-01-01 00:00:00" AND f.created <= "2021-01-01 23:59:59", 1, 0)) AS created0,
			sum( if(f.created >= "2021-01-02 00:00:00" AND f.created <= "2021-12-31 23:59:59", 1, 0)) AS created1
		FROM
			wp_wpq_eform_form f
		WHERE
			f.ownerid = 1 AND f.trashed = 0;
		*/
		$sums = [];
		foreach ( $intervals as $index => $dates ) {
			$sums[] = $wpdb->prepare(
				"sum( if(f.created >= %s AND f.created <= %s, 1, 0)) AS created{$index}", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$dates['start_date'],
				$dates['end_date']
			);
		}
		$all_sum = \join( ', ', $sums );
		$result = $wpdb->get_row(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT
					{$all_sum}
				FROM {$form_table} f
				WHERE
					f.ownerid = %d AND f.trashed = 0
				",
				$owner_id
			),
			\ARRAY_A
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
		if ( ! \is_array( $result ) ) {
			return [];
		}

		$data = [];
		foreach ( $intervals as $index => $dates ) {
			$data[] = [
				'startDate' => $dates['start_date'],
				'endDate' => $dates['end_date'],
				'value' => $result[ "created{$index}" ] ?? 0,
			];
		}
		return $data;
	}

	/**
	 * Get submission stats in given interval.
	 *
	 * @param array $intervals Intervals.
	 * @param int   $owner_id Form owner id.
	 * @return array Empty array on error.
	 */
	public static function get_submissions_stat_in_intervals( array $intervals, int $owner_id ) {
		global $wpdb;
		$data = [
			'formsViewed' => [],
			'formSubmissions' => [],
		];
		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			sum( if(f.created >= "2019-01-01 00:00:00" AND f.created <= "2021-01-01 23:59:59", f.viewCount, 0)) AS viewed0,
			sum( if(f.created >= "2021-01-02 00:00:00" AND f.created <= "2021-12-31 23:59:59", f.viewCount, 0)) AS viewed1
		FROM
			wp_wpq_eform_form f
		WHERE
			f.ownerid = 1 AND f.trashed = 0;

		SELECT
			sum( if(s.created >= "2019-01-01 00:00:00" AND s.created <= "2021-01-01 23:59:59", 1, 0)) AS submission0,
			sum( if(s.created >= "2021-01-02 00:00:00" AND s.created <= "2021-12-31 23:59:59", 1, 0)) AS submission1
		FROM
			wp_wpq_eform_submission s
			LEFT JOIN wp_wpq_eform_form f ON s.formId = f.id
		WHERE
			s.trashed = 0 AND f.ownerid = 1 AND f.trashed = 0;
		*/

		$form_sums = [];
		$submission_sums = [];

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		foreach ( $intervals as $index => $dates ) {
			$form_sums[] = $wpdb->prepare(
				"sum( if(f.created >= %s AND f.created <= %s, f.viewCount, 0)) AS viewed{$index}",
				$dates['start_date'],
				$dates['end_date']
			);
			$submission_sums[] = $wpdb->prepare(
				"sum( if(s.created >= %s AND s.created <= %s, 1, 0)) AS submission{$index}",
				$dates['start_date'],
				$dates['end_date']
			);
		}

		$all_form_sum = \join( ', ', $form_sums );
		$all_submission_sum = \join( ', ', $submission_sums );

		$form_result = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT
					{$all_form_sum}
				FROM {$form_table} f
				WHERE
					f.ownerid = %d AND f.trashed = 0
				",
				$owner_id
			),
			\ARRAY_A
		);
		$submission_result = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT
					{$all_submission_sum}
				FROM
					{$submission_table} s
					LEFT JOIN {$form_table} f ON s.formId = f.id
				WHERE
					s.trashed = 0 AND f.ownerid = %d AND (f.trashed = 0 OR f.trashed IS NULL);
				",
				$owner_id
			),
			\ARRAY_A
		);
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( ! \is_array( $form_result ) || ! \is_array( $submission_result ) ) {
			return $data;
		}

		foreach ( $intervals as $index => $dates ) {
			$forms_viewed = $form_result[ "viewed{$index}" ] ?? 0;
			$form_submissions = $submission_result[ "submission{$index}" ] ?? 0;
			if ( $forms_viewed < $form_submissions ) {
				$forms_viewed = $form_submissions;
			}

			$data['formsViewed'][] = [
				'startDate' => $dates['start_date'],
				'endDate' => $dates['end_date'],
				'value' => $forms_viewed,
			];
			$data['formSubmissions'][] = [
				'startDate' => $dates['start_date'],
				'endDate' => $dates['end_date'],
				'value' => $form_submissions,
			];
		}

		return $data;
	}

	/**
	 * Get data for the CumulativeFormsStat GraphQL API.
	 *
	 * @param int $owner_id ID of the owner for whom we calculate cumulative stat.
	 *
	 * @return array Datastructure mathcing CumulativeFormsStat
	 */
	public static function get_cumulative_stats( int $owner_id ) {
		/**
		 * BACKEND LOGIC:
		 *
		 * 1. Determine least date a form was created/submission was made (whichever is less).
		 * 2. Determine greatest date a form was created/submission was made (whichever is more).
		 * 3. Split the dates into equal range.
		 *  3.1: If difference is greater than 10days, then 10.
		 *  3.2: Else number of days.
		 * 4. For the given range, calculate:
		 *  4.1: Number of forms created.
		 *  4.2: Number of form views.
		 *  4.3: Number of form submissions.
		 *  4.4: Value of conversion rate.
		 * 5. Return type would be: CumulativeFormStatsType
		 */

		$data = [
			'formsOwned' => [],
			'formsViewed' => [],
			'formSubmissions' => [],
		];

		// get form date edges
		$form_date_edges = self::get_form_date_edges( $owner_id );
		// if no forms, then bail
		if ( $form_date_edges === null ) {
			return $data;
		}

		// get submission date edges
		$submission_date_edges = self::get_submission_date_edges( $owner_id );

		// now determine the least date and greatest date
		$least_date = $submission_date_edges
			? get_minimum_datetime( $submission_date_edges['createdMin'], $form_date_edges['createdMin'] )
			: $form_date_edges['createdMin'];
		$greatest_date = $submission_date_edges
			? get_maximum_datetime( $submission_date_edges['createdMax'], $form_date_edges['createdMax'] )
			: $form_date_edges['createdMax'];

		// bail if invalid datetime
		if (
			! $least_date
			|| ! $greatest_date
			|| $least_date > $greatest_date
		) {
			return $data;
		}

		// Now get date intervals
		$intervals = split_datetime_into_ranges( $least_date, $greatest_date, 10 );

		// now populate the data
		$data['formsOwned'] = self::get_forms_created_in_intervals(
			$intervals,
			$owner_id
		);
		if ( $submission_date_edges ) {
			$sub_result = self::get_submissions_stat_in_intervals(
				$intervals,
				$owner_id
			);
			$data['formsViewed'] = $sub_result['formsViewed'];
			$data['formSubmissions'] = $sub_result['formSubmissions'];
		}

		// Now create the date range
		return $data;
	}

	/**
	 * Get performing forms statistics based on owner id and form count.
	 *
	 * @param int $owner_id Form owner id.
	 * @param int $form_count Total forms to return.
	 * @return array Empty array on error.
	 */
	public static function get_performing_forms_stat( int $owner_id, int $form_count ) {
		global $wpdb;
		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];

		/*
		SELECT
			COUNT(s.id) submissionCount,
			( if(f.viewCount < COUNT(s.id), COUNT(s.id), f.viewCount)) AS viewCount,
			f.id formId,
			f.name formName,
			( if(f.viewCount < COUNT(s.id), 100, ROUND((COUNT(s.id) / f.viewCount * 100), 0))) AS conversionRate
			FROM
				wp_wpq_eform_form f
			LEFT JOIN wp_wpq_eform_submission s ON f.id = s.formId
		WHERE
			f.trashed = 0 AND(s.trashed = 0 OR s.trashed IS NULL) AND f.ownerid = 1
		GROUP BY
			f.id
		ORDER BY
			conversionRate DESC,
			submissionCount DESC,
			viewCount DESC
		LIMIT 0, 20;
		*/
		$result = $wpdb->get_results(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT
					COUNT(s.id) submissionCount,
					( if(f.viewCount < COUNT(s.id), COUNT(s.id), f.viewCount)) AS viewCount,
					f.id formId,
					f.name formName,
					( if(f.viewCount < COUNT(s.id), 100.00, ROUND((COUNT(s.id) / f.viewCount * 100), 2))) AS conversionRate
					FROM
						{$form_table} f
					LEFT JOIN {$submission_table} s ON f.id = s.formId
				WHERE
					f.trashed = 0 AND(s.trashed = 0 OR s.trashed IS NULL) AND f.ownerid = %d
				GROUP BY
					f.id
				ORDER BY
					conversionRate DESC,
					submissionCount DESC,
					viewCount DESC
				LIMIT 0, %d;",
				$owner_id,
				$form_count
			),
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			\ARRAY_A
		);

		return $result ?? [];
	}

	/**
	 * Get submission across forms stat since the given day.
	 *
	 * @param int $owner_id Form owner id.
	 * @param int $since Since days to calculate.
	 * @return array Empty array on error.
	 */
	public static function get_submission_stat( int $owner_id, int $since ) {
		global $wpdb;
		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];

		$current_day = \time();
		$since_day = $current_day - $since * \DAY_IN_SECONDS;
		$since_formatted = \gmdate( 'Y-m-d', $since_day ) . ' 00:00:00';

		/*
		SELECT
			COUNT(s.id) submissions,
			COUNT(DISTINCT (f.id)) forms
		FROM
			wp_wpq_eform_submission s
			LEFT JOIN wp_wpq_eform_form f ON s.formId = f.id
		WHERE
			s.trashed = 0
			AND f.ownerid = 1
			AND(f.trashed = 0
				OR f.trashed IS NULL)
			AND s.created >= "2020-01-01 00:00:00";
		*/
		$result = $wpdb->get_row(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT
					COUNT(s.id) submissions,
					COUNT(DISTINCT (f.id)) forms
				FROM
					{$submission_table} s
					LEFT JOIN {$form_table} f ON s.formId = f.id
				WHERE
					s.trashed = 0
					AND f.ownerid = %d
					AND(f.trashed = 0
						OR f.trashed IS NULL)
					AND s.created >= %s;",
				$owner_id,
				$since_formatted
			),
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			\ARRAY_A
		);

		return $result ?? [
			'submissions' => 0,
			'forms' => 0,
		];
	}

	/**
	 * Get submissions interval statistics.
	 *
	 * @param int    $owner_id Form owner id.
	 * @param string $type Type of interval.
	 * @return array|null
	 */
	public static function get_submissions_interval_stat( int $owner_id, string $type ) {
		/*
		SELECT
			COUNT(s.id) submissionCount,
			YEARWEEK(s.created) AS `period`
		FROM
			wp_wpq_eform_submission s
			LEFT JOIN wp_wpq_eform_form f ON f.id = s.formId
		WHERE
			s.trashed = 0
			AND(f.trashed = 0
				OR f.trashed IS NULL)
			AND f.ownerid = 1
			AND s.created >= UTC_DATE() - INTERVAL 10 WEEK
		GROUP BY
			`period`
		ORDER BY `period` DESC;

		SELECT
			COUNT(s.id) submissionCount,
			EXTRACT(YEAR_MONTH FROM s.created) AS `period`
		FROM
			wp_wpq_eform_submission s
			LEFT JOIN wp_wpq_eform_form f ON f.id = s.formId
		WHERE
			s.trashed = 0
			AND(f.trashed = 0
				OR f.trashed IS NULL)
			AND f.ownerid = 1
			AND s.created >= UTC_DATE() - INTERVAL 12 MONTH
		GROUP BY
			`period`
		ORDER BY `period` DESC;

		SELECT
			COUNT(s.id) submissionCount,
			DATE(s.created) AS `period`
		FROM
			wp_wpq_eform_submission s
			LEFT JOIN wp_wpq_eform_form f ON f.id = s.formId
		WHERE
			s.trashed = 0
			AND(f.trashed = 0
				OR f.trashed IS NULL)
			AND f.ownerid = 1
			AND s.created >= UTC_DATE() - INTERVAL 30 DAY
		GROUP BY
			`period`
		ORDER BY `period` DESC;
		*/
		global $wpdb;
		$submission_table = Init::$database['submission'];
		$form_table = Init::$database['form'];

		$period = 'DATE(s.created) AS `period`';
		$interval = 'INTERVAL 30 DAY';

		if ( $type === 'week' ) {
			$period = 'YEARWEEK(s.created) AS `period`';
			$interval = 'INTERVAL 10 WEEK';
		} elseif ( $type === 'month' ) {
			$period = 'EXTRACT(YEAR_MONTH FROM s.created) AS `period`';
			$interval = 'INTERVAL 12 MONTH';
		}

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$query = $wpdb->prepare(
			"SELECT
				COUNT(s.id) submissionCount,
				{$period}
			FROM
				{$submission_table} s
				LEFT JOIN {$form_table} f ON f.id = s.formId
			WHERE
				s.trashed = 0
				AND(f.trashed = 0
					OR f.trashed IS NULL)
				AND f.ownerid = %d
				AND s.created >= UTC_DATE() - {$interval}
			GROUP BY
				`period`
			ORDER BY `period` ASC;",
			$owner_id
		);
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		return $wpdb->get_results( $query, \ARRAY_A );
	}

	/**
	 * Get total count of forms, form views and submissions for a user.
	 *
	 * @param int $owner_id User Id.
	 * @return array|null Associative array if stat was found, null otherwise.
	 */
	public static function get_total_count_stats( int $owner_id ) {
		/*
		SELECT
			SUM(f.viewCount) formViews,
			COUNT(s.id) submissions,
			COUNT(DISTINCT (f.id)) forms
		FROM
			wp_wpq_eform_form f
			LEFT JOIN wp_wpq_eform_submission s ON f.id = s.formId
		WHERE
			f.trashed = 0
			AND f.ownerid = 1
			AND(s.trashed = 0
				OR s.trashed IS NULL);
		*/
		global $wpdb;
		$submission_table = Init::$database['submission'];
		$form_table = Init::$database['form'];
		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$query = $wpdb->prepare(
			"SELECT
				SUM(f.viewCount) formViews,
				COUNT(s.id) submissions,
				COUNT(DISTINCT (f.id)) forms
			FROM
				{$form_table} f
				LEFT JOIN {$submission_table} s ON f.id = s.formId
			WHERE
				f.trashed = 0
				AND f.ownerid = %d
				AND(s.trashed = 0
					OR s.trashed IS NULL);",
			$owner_id
		);
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		return $wpdb->get_row( $query, \ARRAY_A );
	}

	/**
	 * Checks if stats are available for the dashboard to show up.
	 *
	 * @param int $owner_id Form owner Id.
	 * @return bool
	 */
	public static function are_stats_available( int $owner_id ) : bool {
		// stats are available, if there is at-least one form
		global $wpdb;
		$form_table = Init::$database['form'];
		$submission_table = Init::$database['submission'];

		return ! ! $wpdb->get_var(
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->prepare(
				"SELECT
					s.id sid
				FROM
					{$submission_table} s
					LEFT JOIN {$form_table} f ON f.id = s.formId
				WHERE
					s.trashed = 0
					AND f.ownerid = %d
					AND (f.trashed = 0 OR f.trashed IS NULL)
				LIMIT 0,1;",
				$owner_id
			)
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}
}
