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
 * @package WPEForm
 * @subpackage View\Admin
 */
namespace WPEForm\View\Admin;

use  WPEForm\Exception\InsufficientPermissionException ;
use  WPEForm\Exception\ValidationException ;
use  WPEForm\System\Init ;
use function  WPEForm\Helpers\format_datetime ;
use function  WPEForm\Helpers\get_full_name ;
use function  WPEForm\Helpers\shorten_number ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * A class to handle all widgets added to WordPress Dashboard
 * page.
 *
 * Instantiate this class only once in the Init.
 *
 * @package WPEForm\View\Admin
 */
class WPDashboard
{
    /**
     * Initialize the widgets.
     *
     * @return void
     */
    public function init()
    {
        // add enqueues
        \add_action( 'admin_enqueue_scripts', [ $this, 'dashboard_scripts' ] );
        // add the widget
        \add_action( 'wp_dashboard_setup', [ $this, 'dashboard_setup' ] );
    }
    
    /**
     * Add dashboard scripts and styles.
     *
     * @return void
     */
    public function dashboard_scripts()
    {
        // add enqueue, but only on the dashboard page
        $screen = \get_current_screen();
        if ( !$screen || !isset( $screen->id ) || $screen->id !== 'dashboard' ) {
            return;
        }
        $enqueue = Init::enqueue();
        $enqueue->enqueue( 'common', 'wpDashboard', [
            'js'             => true,
            'css'            => true,
            'js_dep'         => [],
            'css_dep'        => [],
            'in_footer'      => true,
            'media'          => 'all',
            'main_js_handle' => 'wpeform-admin-dashboard',
        ] );
        \wp_localize_script( 'wpeform-admin-dashboard', 'WPEFormDashboardL10n', [
            'views'           => \__( '# of views', 'wp-eform' ),
            'submissions'     => \__( '# of submissions', 'wp-eform' ),
            'conversion'      => \__( 'conversion rate', 'wp-eform' ),
            'chartDateFormat' => \_x( 'MMM D, YY', 'chartjs-format-unit-day', 'wp-eform' ),
        ] );
    }
    
    /**
     * Setup all widgets in the dashboard.
     *
     * @return void
     */
    public function dashboard_setup()
    {
        // add only if current user can access stats
        $auth = new \WPEForm\Auth\Form();
        if ( !$auth->can_current_user_create() ) {
            return;
        }
        $widget_id = 'wpeform_dashboard_widget';
        // add the widget
        \wp_add_dashboard_widget( $widget_id, \esc_html__( 'Forms and Submissions - WPEForm', 'wp-eform' ), [ $this, 'forms_submissions_widget' ] );
        // try to force it to top
        // @link https://developer.wordpress.org/apis/handbook/dashboard-widgets/
        // Globalize the metaboxes array, this holds all the widgets for wp-admin.
        global  $wp_meta_boxes ;
        // Get the regular dashboard widgets array
        // (which already has our new widget but appended at the end).
        $default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
        // Backup and delete our new dashboard widget from the end of the array.
        $widget_backup = [
            "{$widget_id}" => $default_dashboard[$widget_id],
        ];
        unset( $default_dashboard[$widget_id] );
        // Merge the two arrays together so our widget is at the beginning.
        $sorted_dashboard = array_merge( $widget_backup, $default_dashboard );
        // Save the sorted array back into the original metaboxes.
        // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
    }
    
    /**
     * Print open in new tab UI, as per guideline of WordPress Dashboard.
     *
     * @return void
     */
    private function print_open_in_new_tab_ui()
    {
        ?>
		<span class="screen-reader-text">
			<?php 
        \esc_html_e( '(opens in a new tab)', 'wp-eform' );
        ?>
		</span>
		<span aria-hidden="true" class="dashicons dashicons-external"></span>
		<?php 
    }
    
    /**
     * Print Stat markup.
     *
     * @param string      $type Type of stat.
     * @param int         $num Number of items.
     * @param string      $label Label.
     * @param string|null $href Optional href to render an anchor tag instead of paragraph.
     * @return void
     */
    private function print_stat_markup(
        string $type,
        int $num,
        string $label,
        ?string $href = null
    )
    {
        ?>
		<?php 
        
        if ( $href ) {
            ?>
			<a href="<?php 
            echo  \esc_attr( $href ) ;
            ?>" class="wpeform-dashboard-widget__stat wpeform-dashboard-widget__stat-<?php 
            echo  \esc_attr( $type ) ;
            ?>">
		<?php 
        } else {
            ?>
			<p class="wpeform-dashboard-widget__stat wpeform-dashboard-widget__stat-<?php 
            echo  \esc_attr( $type ) ;
            ?>">
		<?php 
        }
        
        ?>
			<span class="wpeform-dashboard-widget__num"><?php 
        echo  \esc_html( shorten_number( $num, 0 ) ) ;
        ?></span>
			<span class="wpeform-dashboard-widget__label"><?php 
        echo  \esc_html( $label ) ;
        ?></span>
		<?php 
        
        if ( $href ) {
            ?>
			</a>
		<?php 
        } else {
            ?>
			</p>
		<?php 
        }
        
        ?>
		<?php 
    }
    
    /**
     * Show onboarding message.
     *
     * @return void
     */
    private function show_onboard_message()
    {
        ?>
		<div class="wpeform-dashboard-widget__onboard">
			<div class="wpeform-dashboard-widget__fakedata">
				<div class="wpeform-dashboard-widget__stats wpeform-dashboard-widget__section">
					<?php 
        $this->print_stat_markup(
            'form',
            12,
            \__( 'Forms', 'wp-eform' ),
            \admin_url( 'admin.php?page=wpeform#/forms' )
        );
        ?>
					<?php 
        $this->print_stat_markup( 'views', 588, \__( 'Views', 'wp-eform' ) );
        ?>
					<?php 
        $this->print_stat_markup(
            'submissions',
            146,
            \__( 'Submissions', 'wp-eform' ),
            \admin_url( 'admin.php?page=wpeform#/submissions' )
        );
        ?>
				</div>
				<div class="wpeform-dashboard-widget__fakegraph wpeform-dashboard-widget__section">
					<div class="wpeform-dashboard-widget__graph-canvas-container">
						<canvas class="wpeform-dashboard-widget__graph-canvas" id="wpeform-dashboard-widget__fakegraph-canvas" height="200"></canvas>
					</div>
				</div>
				<div class="wpeform-dashboard-widget__fakedata-overlay"></div>
			</div>
			<div class="wpeform-dashboard-widget__onboardarticle">
				<h3 class="wpeform-dashboard-widget__title wpeform-dashboard-widget__title--centered">
					<?php 
        \esc_html_e( 'Thank you for installing WPEForm!', 'wp-eform' );
        ?>
				</h3>
				<p class="wpeform-dashboard-widget__para">
					<?php 
        \esc_html_e( 'You do not have any forms or submissions yet! Please see the following links to get started. Once you have created some forms and collected some submissions, beautiful statistics will show up here.', 'wp-eform' );
        ?>
				</p>
			</div>
			<div class="wpeform-dashboard-widget__btngroup">
				<a class="button button-primary" href="<?php 
        echo  \esc_attr( \admin_url( 'admin.php?page=wpeform#/forms/new' ) ) ;
        ?>">
					<?php 
        \esc_html_e( 'New Form', 'wp-eform' );
        ?>
				</a>
				<a class="button button-secondary" href="https://www.wpeform.io/docs/getting-started/form-builder/?utm_source=wpeformplugin&utm_medium=link&utm_campaign=wpeformdashboardwidget" target="_blank" rel="noopener noreferrer">
					<?php 
        \esc_html_e( 'Getting Started', 'wp-eform' );
        ?>
					<?php 
        $this->print_open_in_new_tab_ui();
        ?>
				</a>
			</div>
		</div>
		<?php 
    }
    
    /**
     * Render Dashboard Widget footer.
     *
     * @return void
     */
    private function dashboard_widget_footer()
    {
        ?>
		<p class="wpeform-dashboard-widget__footer">
		<strong class="wpeform-dashboard-widget__footer-version"><?php 
        echo  \esc_html( 'v' . \WP_EFORM_VERSION ) ;
        ?></strong>
			<a href="https://www.wpeform.io/docs/?utm_source=wpeformplugin&utm_medium=link&utm_campaign=wpeformdashboardwidget" target="_blank" rel="noopener noreferrer">
				<?php 
        \esc_html_e( 'Documentation', 'wp-eform' );
        ?>
				<?php 
        $this->print_open_in_new_tab_ui();
        ?>
			</a>
			|
			<a href="https://www.wpeform.io/contact/?utm_source=wpeformplugin&utm_medium=link&utm_campaign=wpeformdashboardwidget" target="_blank" rel="noopener noreferrer">
				<?php 
        \esc_html_e( 'Support', 'wp-eform' );
        ?>
				<?php 
        $this->print_open_in_new_tab_ui();
        ?>
			</a>
			<?php 
        ?>
				|
				<a href="<?php 
        echo  \esc_attr( \wpeform_fs()->get_upgrade_url() ) ;
        ?>">
					<?php 
        \esc_html_e( 'Upgrade', 'wp-eform' );
        ?>
				</a>
				<?php 
        
        if ( \wpeform_fs()->is_plan( Init::PLAN_FREE, true ) ) {
            ?>
					|
					<a href="<?php 
            echo  \esc_attr( \wpeform_fs()->get_trial_url() ) ;
            ?>">
						<?php 
            \esc_html_e( 'Start Trial', 'wp-eform' );
            ?>
					</a>
				<?php 
        }
        
        ?>
			<?php 
        ?>
		</p>
		<?php 
    }
    
    /**
     * Print Graphical data for stats.
     *
     * @return void
     */
    private function print_stat_graph_data()
    {
        $stats = [
            'counts'               => \WPEForm\Controller\Dashboard::get_total_count_stats(),
            'performingForms'      => \WPEForm\Controller\Dashboard::get_performing_forms_stats( 5 ),
            'recentSubmissions'    => \WPEForm\Controller\Dashboard::get_submission_stat( 30 ),
            'submissionsGraphData' => \WPEForm\Controller\Dashboard::get_submissions_interval_stat( 'day' ),
        ];
        $total_forms = $stats['counts']['forms'] ?? 0;
        $total_views = $stats['counts']['formViews'] ?? 0;
        $total_submissions = $stats['counts']['submissions'] ?? 0;
        ?>
		<div class="wpeform-dashboard-widget__graphs wpeform-dashboard-widget__wrapper">
			<div class="wpeform-dashboard-widget__stats wpeform-dashboard-widget__section">
				<?php 
        $this->print_stat_markup(
            'form',
            $total_forms,
            \__( 'Forms', 'wp-eform' ),
            \admin_url( 'admin.php?page=wpeform#/forms' )
        );
        ?>
				<?php 
        $this->print_stat_markup( 'views', $total_views, \__( 'Views', 'wp-eform' ) );
        ?>
				<?php 
        $this->print_stat_markup(
            'submissions',
            $total_submissions,
            \__( 'Submissions', 'wp-eform' ),
            \admin_url( 'admin.php?page=wpeform#/submissions' )
        );
        ?>
			</div>
			<div class="wpeform-dashboard-widget__graph wpeform-dashboard-widget__section">
				<div class="wpeform-dashboard-widget__graph-canvas-container">
					<canvas
						class="wpeform-dashboard-widget__graph-canvas"
						id="wpeform-dashboard-widget__graph-canvas-submissions"
						height="200"
						data-submissions-graph="<?php 
        echo  \esc_attr( \json_encode( $stats['submissionsGraphData'] ) ) ;
        ?>"
					></canvas>
				</div>
				<h3 class="wpeform-dashboard-widget__title wpeform-dashboard-widget__title--centered">
					<?php 
        
        if ( $stats['recentSubmissions']['submissions'] ) {
            ?>
						<?php 
            \printf(
                /* translators: %1$s is number of submissions, %2$s is number of forms */
                \esc_html_x( '%1$s across %2$s in last 30 days', 'wpeform-dashboard-stat-heading', 'wp-eform' ),
                \sprintf( \esc_html(
                    /* translators: %1$s is number of submissions */
                    \_nx(
                        '%1$d new submission',
                        '%1$d new submissions',
                        (int) $stats['recentSubmissions']['submissions'],
                        'wpeform-dashboard-stat-heading',
                        'wp-eform'
                    )
                ), (int) $stats['recentSubmissions']['submissions'] ),
                \sprintf( \esc_html(
                    /* translators: %1$s is number of forms */
                    \_nx(
                        '%1$d form',
                        '%1$d forms',
                        (int) $stats['recentSubmissions']['forms'],
                        'wpeform-dashboard-stat-heading',
                        'wp-eform'
                    )
                ), (int) $stats['recentSubmissions']['forms'] )
            );
            ?>
					<?php 
        } else {
            ?>
						<?php 
            \esc_html_e( 'No new submissions in last 10 days', 'wp-eform' );
            ?>
					<?php 
        }
        
        ?>
				</h3>
			</div>
			<div class="wpeform-dashboard-widget__graph wpeform-dashboard-widget__section">
				<div class="wpeform-dashboard-widget__graph-canvas-container">
					<canvas
						class="wpeform-dashboard-widget__graph-canvas"
						id="wpeform-dashboard-widget__graph-canvas-forms"
						height="200"
						data-performing-forms="<?php 
        echo  \esc_attr( \json_encode( $stats['performingForms'] ) ) ;
        ?>"
					></canvas>
				</div>
				<h3 class="wpeform-dashboard-widget__title wpeform-dashboard-widget__title--centered">
					<?php 
        \esc_html_e( 'Best performing forms', 'wp-eform' );
        ?>
				</h3>
			</div>
		</div>
		<?php 
    }
    
    /**
     * Print latest submissions.
     *
     * @return void
     */
    private function print_latest_submissions()
    {
        $controller = new \WPEForm\Controller\Submission( new \WPEForm\Model\Submission(), new \WPEForm\Auth\Submission() );
        $latest_submissions = $controller->collection( [
            'with'    => 'offset',
            'orderby' => 'created',
            'page'    => 1,
            'first'   => 5,
        ], [
            'asAdmin'      => true,
            'resourceView' => 'owned',
        ] );
        ?>
		<div class="wpeform-dashboard-widget__submissions wpeform-dashboard-widget__wrapper">
			<div class="wpeform-dashboard-widget__btngroup">
				<a class="button button-secondary" href="<?php 
        echo  \esc_attr( \admin_url( 'admin.php?page=wpeform#/forms' ) ) ;
        ?>">
					<?php 
        \esc_html_e( 'Forms', 'wp-eform' );
        ?>
				</a>
				<a class="button button-primary" href="<?php 
        echo  \esc_attr( \admin_url( 'admin.php?page=wpeform#/submissions' ) ) ;
        ?>">
					<?php 
        \esc_html_e( 'Submissions', 'wp-eform' );
        ?>
				</a>
			</div>
			<h3 class="wpeform-dashboard-widget__title wpeform-dashboard-widget__title--separator">
				<?php 
        \esc_html_e( 'Latest Submissions', 'wp-eform' );
        ?>
			</h3>
			<ul class="wpeform-dashboard-widget__submission-list">
				<?php 
        foreach ( $latest_submissions['edges'] as $edge ) {
            ?>
					<li>
						<div class="wpeform-dashboard-widget__submission-avatar">
							<a href="<?php 
            echo  \esc_attr( \admin_url( 'admin.php?page=wpeform#/submissions/view/' . $edge['node']['id'] ) ) ;
            ?>">
								<?php 
            echo  \get_avatar( $edge['node']['email'] ?? '' ) ;
            ?>
							</a>
						</div>
						<p class="wpeform-dashboard-widget__submission-data">
							<?php 
            \printf(
                /* translators: %1$s is submitter name, %2$s is form name, %3$s is ip address, %4$s is date */
                \__(
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<strong>%1$s</strong> submitted the form %2$s from %3$s, on %4$s.',
                    'wp-eform'
                ),
                \esc_html( get_full_name( $edge['node']['fName'], $edge['node']['lName'] ) ),
                \esc_html( $edge['node']['formName'] ),
                \esc_html( $edge['node']['ip'] ),
                \esc_html( format_datetime( \strtotime( $edge['node']['created'] ) ) )
            );
            ?>
						</p>
						<p class="wpeform-dashboard-widget__submission-links">
							<a href="<?php 
            echo  \esc_attr( \admin_url( 'admin.php?page=wpeform#/submissions/view/' . $edge['node']['id'] ) ) ;
            ?>">
								<?php 
            \esc_html_e( 'View', 'wp-eform' );
            ?>
							</a>
							|
							<a href="<?php 
            echo  \esc_attr( \admin_url( 'admin.php?page=wpeform#/submissions/edit/' . $edge['node']['id'] ) ) ;
            ?>">
								<?php 
            \esc_html_e( 'Edit', 'wp-eform' );
            ?>
							</a>
							|
							<a href="<?php 
            echo  \esc_attr( $edge['node']['downloadLink'] ) ;
            ?>">
								<?php 
            \esc_html_e( 'Download', 'wp-eform' );
            ?>
							</a>
						</p>
					</li>
				<?php 
        }
        ?>
			</ul>
		</div>
		<?php 
    }
    
    /**
     * Show actual statistical data.
     *
     * @return void
     */
    private function show_stats_data()
    {
        ?>
		<div class="wpeform-dashboard-widget__stats-data">
			<?php 
        $this->print_stat_graph_data();
        ?>
			<?php 
        $this->print_latest_submissions();
        ?>
		</div>
		<?php 
    }
    
    /**
     * Output the forms submissions widget.
     *
     * @return void
     */
    public function forms_submissions_widget()
    {
        $current_user_id = (int) \get_current_user_id();
        echo  '<div class="wpeform-dashboard-widget">' ;
        
        if ( !\WPEForm\Model\Dashboard::are_stats_available( $current_user_id ) ) {
            $this->show_onboard_message();
        } else {
            $this->show_stats_data();
        }
        
        $this->dashboard_widget_footer();
        echo  '</div>' ;
    }

}