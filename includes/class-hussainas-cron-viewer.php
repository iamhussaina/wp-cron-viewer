<?php
/**
 * Main class for the WP Cron Viewer.
 *
 * This class handles the initialization and loading of the
 * admin-facing components.
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
 * Class Hussainas_Cron_Viewer
 *
 * Main orchestrator for the cron viewer component.
 */
class Hussainas_Cron_Viewer {

	/**
	 * Initialize the component.
	 *
	 * Loads dependencies and sets up WordPress hooks.
	 */
	public function init() {
		$this->add_hooks();
	}

	/**
	 * Add WordPress action and filter hooks.
	 *
	 * @return void
	 */
	private function add_hooks() {
		// Check if we are in the admin area.
		if ( is_admin() ) {
			// Instantiate the admin handler and register admin menu hook.
			$admin_handler = new Hussainas_Cron_Viewer_Admin();
			add_action( 'admin_menu', array( $admin_handler, 'add_admin_page' ) );
		}
	}
}
