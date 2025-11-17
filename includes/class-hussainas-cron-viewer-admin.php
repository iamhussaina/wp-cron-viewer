<?php
/**
 * Handles the admin-facing functionality for the WP Cron Viewer.
 *
 * Creates the admin page and renders the cron job table.
 *
 * @package WPCronViewer
 * @version     1.0.0
 * @author      Hussain Ahmed Shrabon
 * @license     GPL-2.0-or-later
 * @link        https://github.com/iamhussaina
 * @textdomain  hussainas
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Hussainas_Cron_Viewer_Admin
 *
 * Responsible for rendering the admin settings page.
 */
class Hussainas_Cron_Viewer_Admin {

	/**
	 * Register the admin menu page.
	 *
	 * Hooks into 'admin_menu' to add a new page under the 'Tools' menu.
	 *
 * @return void
	 */
	public function add_admin_page() {
		add_management_page(
			'WP Cron Jobs',                     // Page title
			'Cron Jobs',                        // Menu title
			'manage_options',                   // Capability required
			'hussainas-cron-viewer',            // Menu slug
			array( $this, 'render_admin_page' ) // Callback function
		);
	}

	/**
	 * Render the admin page content.
	 *
	 * Fetches all cron jobs using _get_cron_array() and displays them
	 * in a standard WordPress list table.
	 *
	 * @return void
	 */
	public function render_admin_page() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( 'WordPress Cron Jobs' ); ?></h1>
			<p><?php echo esc_html( 'This page displays all scheduled cron jobs and their details. All times are based on your site\'s timezone.' ); ?></p>

			<?php
			// Get the raw cron array.
			$cron_jobs = _get_cron_array();

			if ( empty( $cron_jobs ) ) {
				echo '<p>' . esc_html( 'No cron jobs are currently scheduled.' ) . '</p>';
				echo '</div>'; // Close .wrap
				return;
			}

			// Get registered schedules for display names.
			$schedules = wp_get_schedules();
			?>

			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th scope="col"><?php echo esc_html( 'Next Run (Site Time)' ); ?></th>
						<th scope="col"><?php echo esc_html( 'Schedule' ); ?></th>
						<th scope="col"><?php echo esc_html( 'Hook' ); ?></th>
						<th scope="col"><?php echo esc_html( 'Arguments' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ( $cron_jobs as $timestamp => $hooks ) {
						foreach ( $hooks as $hook => $jobs ) {
							foreach ( $jobs as $key => $job ) {

								// Format the next run time using site's timezone.
								$next_run = 'Unknown';
								if ( $timestamp ) {
									// Converts GMT timestamp to site's local time.
									$next_run = get_date_from_gmt( date( 'Y-m-d H:i:s', $timestamp ), 'Y-m-d H:i:s' );
								}

								// Get the schedule display name.
								$schedule_display = 'One-time';
								if ( ! empty( $job['schedule'] ) ) {
									if ( isset( $schedules[ $job['schedule'] ]['display'] ) ) {
										$schedule_display = $schedules[ $job['schedule'] ]['display'];
									} else {
										// Fallback for custom/missing schedules
										$schedule_display = esc_html( $job['schedule'] );
									}
								}

								// Format arguments for safe display.
								$args_display = 'None';
								if ( ! empty( $job['args'] ) ) {
									// Use wp_json_encode for a clean representation.
									$args_display = '<code>' . esc_html( wp_json_encode( $job['args'] ) ) . '</code>';
								}
								?>
								<tr>
									<td><?php echo esc_html( $next_run ); ?></td>
									<td><?php echo esc_html( $schedule_display ); ?></td>
									<td><code><?php echo esc_html( $hook ); ?></code></td>
									<td><?php echo $args_display; // WPCS: XSS ok. Already escaped. ?></td>
								</tr>
								<?php
							}
						}
					}
					?>
				</tbody>
			</table>

		</div> <?php
	}
}
