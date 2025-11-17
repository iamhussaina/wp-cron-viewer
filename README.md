# WP Cron Viewer

A standalone, lightweight component for WordPress that adds an admin page under "Tools" -> "Cron Jobs" to view all registered WP-Cron events. This is designed for developers to debug the WordPress cron system without needing to install a heavy plugin.

This component is built to be included within a WordPress theme.

## Features

* Lists all scheduled cron jobs from `_get_cron_array()`.
* Displays the next scheduled run time, converted to the site's local timezone.
* Shows the cron hook name.
* Displays the recurrence schedule (e.g., "Hourly", "Daily", or "One-time").
* Shows any arguments passed to the cron hook in a clean JSON format.
* **Read-only:** This tool is for viewing only. It does not allow for modifying, executing, or deleting jobs.

## Installation

1.  **Download:** Download the `wp-cron-viewer` folder.
2.  **Copy to Theme:** Place the entire `wp-cron-viewer` folder into your active WordPress theme's directory (e.g., `wp-content/themes/your-theme/wp-cron-viewer`).
3.  **Include in Theme:** Open your theme's `functions.php` file and add the following line of PHP code to include the main bootstrap file:

    ```php
    // Load the WP Cron Viewer component
    require get_template_directory() . '/wp-cron-viewer/wp-cron-viewer.php';
    ```

    *Note: If you are using a child theme, you may prefer to use `get_stylesheet_directory()`.*

4.  **Verify:** Go to your WordPress admin dashboard. Navigate to **Tools** -> **Cron Jobs**. You should now see the new admin page listing all scheduled jobs.

## Requirements

* WordPress 5.0 or higher
* PHP 7.2 or higher

## Disclaimer

This is a developer-focused tool. It provides a read-only view of the data stored in the `cron` option in the `wp_options` table.
