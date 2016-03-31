<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              natehobi.com
 * @since             1.0.0
 * @package           Wp_Data_Append
 *
 * @wordpress-plugin
 * Plugin Name:       WP Data Append
 * Plugin URI:        https://github.com/gr33k01/WP-Data-Append
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nate Hobi
 * Author URI:        natehobi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-data-append
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-data-append-activator.php
 */
function activate_wp_data_append() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-data-append-activator.php';
	Wp_Data_Append_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-data-append-deactivator.php
 */
function deactivate_wp_data_append() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-data-append-deactivator.php';
	Wp_Data_Append_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_data_append' );
register_deactivation_hook( __FILE__, 'deactivate_wp_data_append' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-data-append.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_data_append() {

	$plugin = new Wp_Data_Append();
	$plugin->run();

}

function register_ajax_calls(){
	add_action( 'wp_ajax_get_gf_form_object', 'get_form_object' );	
	add_action( 'wp_ajax_get_saved_data_append_settings', 'get_saved_data_append_settings' );
}

function get_form_object() {
	header('Content-Type: application/json');
	echo json_encode(GFAPI::get_form($_POST['form_id']));
	wp_die();
}

function get_saved_data_append_settings() {
	header('Content-Type: application/json');
	echo json_encode(get_option(wp_data_append_forms_to_append));
	wp_die();
};

register_ajax_calls();
run_wp_data_append();


