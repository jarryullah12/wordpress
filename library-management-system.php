<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://onlinewebtutorblog.com/
 * @since             3.0.0
 * @package           Library_Management_System
 *
 * @wordpress-plugin
 * Plugin Name:       Library Management System
 * Plugin URI:        https://onlinewebtutorblog.com/library-management-system-wordpress-plugin/
 * Description:       Library Management System plugin gives the flexibility to manage users, branches, bookcases, sections, categories, books, etc. By using this LMS plugin you can <strong>Manage the Library System of Users</strong>. Plugin manage reports, late fine system, filters, etc. Using: <strong>LMS Free Version</strong>
 * Version:           3.0.0
 * Author:            Online Web Tutor
 * Author URI:        https://onlinewebtutorblog.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       library-management-system
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 3.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LIBRARY_MANAGEMENT_SYSTEM_VERSION', '3.0.0' );
define( 'LIBRARY_MANAGEMENT_SYSTEM_PREFIX', 'owt7' );
define( 'LIBRARY_BUY_PRO_VERSION_LINK' , 'https://onlinewebtutorblog.com/library-management-system-wordpress-plugin/');
define( 'LIBRARY_FREE_VERSION_DOC_LINK' , 'https://onlinewebtutorblog.com/doc/lms-free-version/');
define( 'LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define( 'LIBRARY_MANAGEMENT_SYSTEM_PLUGIN_URL', plugin_dir_url(__FILE__));
define( 'LIBRARY_MANAGEMENT_SYSTEM_BASE_NAME', plugin_basename(__FILE__) );
define( 'LMS_FREE_VERSION_LIMIT', "MTU=" );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-library-management-system-activator.php
 */
function activate_library_management_system() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-library-management-system-activator.php';
	$table_activator = new Library_Management_System_Activator();
    $table_activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-library-management-system-deactivator.php
 */
function deactivate_library_management_system() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-library-management-system-activator.php';
	$table_activator = new Library_Management_System_Activator();
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-library-management-system-deactivator.php';
	$table_deactivator = new Library_Management_System_Deactivator($table_activator);
    $table_deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_library_management_system' );
register_deactivation_hook( __FILE__, 'deactivate_library_management_system' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-library-management-system.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.0
 */
function run_library_management_system() {

	$plugin = new Library_Management_System();
	$plugin->run();

}
run_library_management_system();
