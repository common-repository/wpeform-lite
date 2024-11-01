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
 * @subpackage System
 */

namespace WPEForm\System;

use WPEForm\Factory\Role;
use WPEForm\GraphQL\Field\SiteSettings;

use function WPEForm\Helpers\parse_args;


// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * Installation class. Handles all installation related stuff, like
 * installing database, creating options etc.
 */
class Install {

	/**
	 * WP Options name for settings variable.
	 */
	const SETTINGS_OPTION_NAME = 'wpeform-settings';

	/**
	 * WP Options name for version variable.
	 */
	const VERSION_OPTION_NAME = 'wpeform-version';

	/**
	 * Uninstall function. It looks for the settings and only if remove data
	 * is explicitly set to true, it would remove all data.
	 *
	 * @return void
	 */
	public function uninstall() {
		global $wpdb;
		$settings = \get_option( self::SETTINGS_OPTION_NAME, [] );
		$remove_data = $settings['system']['removeDataWhenUninstalling'] ?? false;
		if ( $remove_data === true ) {
			// remove all options
			\delete_option( 'wp-eform-rewrite-flushed' );
			\delete_option( self::SETTINGS_OPTION_NAME );
			\delete_option( self::VERSION_OPTION_NAME );
			// remove all database tables
			$tables = Init::$database;
			foreach ( $tables as $table ) {
				// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$wpdb->query( "DROP TABLE IF EXISTS {$table}" );
			}
		} else {
			// just set rewrite flushed to false
			\update_option( 'wp-eform-rewrite-flushed', 0 );
		}
	}

	/**
	 * Flush rewrite rules from WordPress.
	 *
	 * @return void
	 */
	public function flush_rewrite_rules() {
		// don't flush if already flushed
		if ( get_option( 'wp-eform-rewrite-flushed' ) ) {
			return;
		}
		if ( \did_action( 'init' ) ) {
			\flush_rewrite_rules();
		} else {
			\add_action(
				'init', function() {
					\flush_rewrite_rules();
				}
			);
		}
		update_option( 'wp-eform-rewrite-flushed', 1 );
	}

	/**
	 * Get SQLs to create tables. Pass them directly to dbDelta.
	 *
	 * @global $charset_collate WordPress database charset.
	 *
	 * @param array $tables Associative array of tables.
	 * @return array Indexed array of SQLs to execute through dbDelta.
	 */
	public function get_table_definitions( $tables ) {
		global $charset_collate;

		// Create the queries
		$sqls = [];

		// Form table
		$sqls[] = "CREATE TABLE {$tables['form']} (
			id BIGINT(20) UNSIGNED NOT NULL auto_increment,
			name VARCHAR(255) NOT NULL default '',
			integrations LONGTEXT NOT NULL,
			payments LONGTEXT NOT NULL,
			permissions LONGTEXT NOT NULL,
			settings LONGTEXT NOT NULL,
			styles LONGTEXT NOT NULL,
			structures LONGTEXT NOT NULL,
			elements LONGTEXT NOT NULL,
			pools LONGTEXT NOT NULL,
			conditionals LONGTEXT NOT NULL,
			updated DATETIME NOT NULL default '0000-00-00 00:00:00',
			created DATETIME NOT NULL default '0000-00-00 00:00:00',
			skeleton LONGTEXT NOT NULL,
			ownerid BIGINT(20) UNSIGNED NOT NULL default 0,
			trashed TINYINT(1) UNSIGNED NOT NULL default 0,
			viewCount BIGINT(20) UNSIGNED NOT NULL default 0,
			PRIMARY KEY  (id),
			KEY name (name),
			KEY updated (updated),
			KEY created (created),
			KEY ownerid (ownerid),
			KEY trashed (trashed),
			KEY viewCount (viewCount)
		) {$charset_collate}";

		// Form metadata
		$sqls[] = "CREATE TABLE {$tables['formmeta']} (
			id BIGINT(20) UNSIGNED NOT NULL auto_increment,
			foreign_id BIGINT(20) UNSIGNED NOT NULL default 0,
			meta_key VARCHAR(24) NOT NULL default '',
			meta_value VARCHAR(255) NOT NULL default '',
			PRIMARY KEY  (id),
			KEY foreign_id (foreign_id),
			KEY meta_key (meta_key),
			KEY meta_value (meta_value)
		) {$charset_collate}";

		// Form category
		$sqls[] = "CREATE TABLE {$tables['category']} (
			id BIGINT(20) UNSIGNED NOT NULL auto_increment,
			title VARCHAR(255) NOT NULL default '',
			description TEXT,
			trashed TINYINT(1) UNSIGNED NOT NULL default 0,
			PRIMARY KEY  (id),
			KEY title (title),
			KEY trashed (trashed)
		) {$charset_collate}";

		// Submission data
		$sqls[] = "CREATE TABLE {$tables['submission']} (
			id BIGINT(20) UNSIGNED NOT NULL auto_increment,
			formId BIGINT(20) UNSIGNED NOT NULL default 0,
			fName VARCHAR(255) default NULL,
			lName VARCHAR(255) default NULL,
			email VARCHAR(255) default NULL,
			phone VARCHAR(20) default NULL,
			elements LONGTEXT NOT NULL,
			ip VARCHAR(50) default NULL,
			score DECIMAL(12, 2) default NULL,
			maxScore DECIMAL(12, 2) default NULL,
			scoreData TEXT default NULL,
			urlTrack VARCHAR(255) default NULL,
			created DATETIME NOT NULL default '0000-00-00 00:00:00',
			lastUpdated DATETIME default NULL,
			adminRemarks LONGTEXT NOT NULL,
			userId BIGINT(20) UNSIGNED default NULL,
			referer TEXT default NULL,
			paid TINYINT(1) NOT NULL default 2,
			time INT(11) UNSIGNED default NULL,
			token VARCHAR(50) default NULL,
			trashed TINYINT(1) UNSIGNED NOT NULL default 0,
			PRIMARY KEY  (id),
			UNIQUE KEY token (token),
			KEY formId (formId),
			KEY fName (fName),
			KEY lName (lName),
			KEY email (email),
			KEY score (score),
			KEY maxScore (maxScore),
			KEY created (created),
			KEY lastUpdated (lastUpdated),
			KEY paid (paid),
			KEY userId (userId),
			KEY trashed (trashed)
		) {$charset_collate}";

		// Payments data
		// All needed data should be recorded, so that a Payment can be shown
		// and retried without needing the actual submission.
		// ..
		// mode => Name of Gateway
		// type 0 => onetime, 1 => recurring
		// subsInterval 0 => none, 1 => day, 2 => week, 3 => month, 4 => year
		// subsFrequency => interval frequency
		// status:
		// ** 0 => Unpaid
		// ** 1 => Paid
		// ** 2 => Cancelled
		// ** 3 => Unsuccessful
		// ** 4 => Awaiting
		$sqls[] = "CREATE TABLE {$tables['payment']} (
			id BIGINT(20) NOT NULL auto_increment,
			txn VARCHAR(255),
			formId BIGINT(20) UNSIGNED NOT NULL default 0,
			submissionId BIGINT(20) UNSIGNED NOT NULL default 0,
			orderId VARCHAR(255) NOT NULL default '',
			amount decimal(12, 2) NOT NULL default 0,
			mode VARCHAR(255) NOT NULL,
			status TINYINT(1) NOT NULL default 0,
			meta LONGTEXT NOT NULL,
			currency VARCHAR(10) NOT NULL default 'USD',
			date DATETIME NOT NULL default '0000-00-00 00:00:00',
			type TINYINT(1) UNSIGNED NOT NULL default 0,
			subsPlan VARCHAR(255) NOT NULL default '',
			subsInterval TINYINT(1) UNSIGNED NOT NULL default 0,
			subsFrequency SMALLINT UNSIGNED NOT NULL default 0,
			PRIMARY KEY  (id),
			UNIQUE KEY txn (txn),
			KEY orderId (orderId),
			KEY formId (formId),
			KEY submissionId (submissionId),
			KEY amount (amount),
			KEY mode (mode),
			KEY status (status),
			KEY date (date),
			KEY type (type)
		) {$charset_collate}";

		return $sqls;
	}

	/**
	 * Create the tables needed by EForm, or if already present
	 * then upgrade.
	 *
	 * All the hard work is basically done by dbDelta function.
	 *
	 * @global $charset_collate
	 *
	 * @param array $tables Associative array of table names.
	 * @return string dbDelta result. Useful for logging.
	 */
	public function update_tables( $tables ) {
		// Get the dbDelta function
		if ( defined( 'ABSPATH' ) ) {
			// we do it this way, so that we can test stuff
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		$sqls = $this->get_table_definitions( $tables );
		$result = \dbDelta( $sqls, true );
		do_action( 'wpeform_install_database', $result );
		return $result;
	}

	/**
	 * Get file content, with a fallback default value.
	 *
	 * @param string $file_path File path to read.
	 * @param string $default_value Default value if file is not found.
	 * @return string
	 */
	protected function get_file_content( string $file_path, string $default_value ) : string {
		if ( \file_exists( $file_path ) && \is_file( $file_path ) ) {
			return \file_get_contents( $file_path );
		}
		return $default_value;
	}

	/**
	 * Get default EForm settings array.
	 *
	 * @return array Associative array of default settings.
	 */
	public function get_default_settings() {
		$default_site_settings = SiteSettings::get_default_site_settings();
		$user_portal_skeleton = \WP_EFORM_ABSPATH . 'static/skeletons/userPortalSkeleton.html';
		$summary_skeleton_file = \WP_EFORM_ABSPATH . 'static/skeletons/summaryGeneralSSR.html';
		$default_site_settings['userPortalSkeleton'] = $this->get_file_content( $user_portal_skeleton, '' );
		$default_site_settings['summaryGeneralSSR'] = $this->get_file_content( $summary_skeleton_file, '' );
		return $default_site_settings;
	}

	/**
	 * Update or create options of EForm.
	 *
	 * @return array Associative array of new option.
	 */
	public function update_options() {
		$version = WP_EFORM_VERSION;
		$settings = $this->get_default_settings();

		$old_version = \get_option( self::VERSION_OPTION_NAME, '' );
		$old_settings = \get_option( self::SETTINGS_OPTION_NAME, [] );

		// Create the new settings
		$new_settings = parse_args( $old_settings, $settings, true );

		// Some specific stuff for older versions
		switch ( $old_version ) {
			case '1.0.1':
			case '1.0.2':
			case '1.0.3':
			case '1.0.4':
			case '1.1.0':
			case '1.1.1':
			case '1.2.0':
			case '1.2.6':
			case '1.2.7':
			case '1.2.8':
				// always upgrade the skeletons
				$new_settings['userPortalSkeleton'] = $settings['userPortalSkeleton'];
				$new_settings['summaryGeneralSSR'] = $settings['summaryGeneralSSR'];
				break;
			case '1.3.0':
			default:
				// do nothing and use the old skeletons
		}

		// Update the options
		update_option( self::VERSION_OPTION_NAME, $version );
		update_option( self::SETTINGS_OPTION_NAME, $new_settings );

		// Fire the hook
		do_action( 'wpeform_install_options', $new_settings, $version );
		return $new_settings;
	}

	/**
	 * Get default EForm roles and capabilities in an Associative array.
	 *
	 * The key of the array is the role name (WordPress Defaults).
	 * The values of the array is another indexed array of capabilities it should
	 * have.
	 *
	 * @return array Associative array of roles and capabilities.
	 */
	public function get_roles() {
		return Role::get_caps_for_builtins();
	}

	/**
	 * Sets default EForm capabilities.
	 *
	 * @global \WP_Roles $wp_roles
	 *
	 * @return boolean True on success
	 */
	public function set_capabilities() {
		$wp_roles = wp_roles();
		$roles = $this->get_roles();
		$this->log( $roles );

		foreach ( $roles as $role => $caps ) {
			foreach ( $caps as $cap ) {
				$wp_roles->add_cap( $role, $cap );
			}
		}

		return true;
	}

	/**
	 * Hit the upgade/install procedure. Creates tables and options.
	 * If already present, then updates them.
	 *
	 * @param array $tables Associative array of tables.
	 *
	 * @return void
	 */
	public function upgrade( $tables ) {
		$db_log = $this->update_tables( $tables );
		$new_option = $this->update_options();
		$this->set_capabilities();
		$this->log( $db_log, $new_option );
		\update_option( 'wp-eform-rewrite-flushed', 0 );
	}

	/**
	 * A custom logger.
	 *
	 * @param mixed ...$params Variable parameters.
	 * @return void
	 */
	protected function log( ...$params ) {
		// don't log if we are testing, this messes phpunit outout with phpdbg
		if ( \defined( 'WPEFORM_IS_TESTING' ) && WPEFORM_IS_TESTING ) {
			return;
		}
		\eform_error_log( ...$params );
	}
}
