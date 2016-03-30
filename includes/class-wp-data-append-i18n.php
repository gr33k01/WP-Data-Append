<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/includes
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_Data_Append_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-data-append',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
