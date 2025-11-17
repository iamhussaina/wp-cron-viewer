<?php
/**
 * Main bootstrap file for the WP Cron Viewer.
 *
 * This file initializes the cron viewing functionality by loading
 * necessary files and instantiating the main class.
 *
 * @package WPCronViewer
 * @version     1.0.0
 * @author      Hussain Ahmed Shrabon
 * @license     MIT  GPL-2.0-or-later
 * @link        https://github.com/iamhussaina
 * @textdomain  hussainas
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define component path for easier including.
if ( ! defined( 'HUSSAINAS_CRON_VIEWER_PATH' ) ) {
	define( 'HUSSAINAS_CRON_VIEWER_PATH', __DIR__ );
}

// Include required class files.
require_once HUSSAINAS_CRON_VIEWER_PATH . '/includes/class-hussainas-cron-viewer.php';
require_once HUSSAINAS_CRON_VIEWER_PATH . '/includes/class-hussainas-cron-viewer-admin.php';

/**
 * Initializes the Cron Viewer.
 *
 * A global-scope function to instantiate the main class.
 *
 * @return void
 */
function hussainas_run_cron_viewer() {
	$hussainas_cron_viewer = new Hussainas_Cron_Viewer();
	$hussainas_cron_viewer->init();
}

// Run the initialization function.
hussainas_run_cron_viewer();
