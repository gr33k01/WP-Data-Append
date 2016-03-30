<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/admin
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_Data_Append_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options prefix to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_prefix 	Option prefix of this plugin
	 */
	private $option_prefix = 'wp_data_append';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Data_Append_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Data_Append_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-data-append-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Data_Append_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Data_Append_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Just in case
		wp_deregister_script('angular');

		wp_register_script('angular', plugin_dir_url( __FILE__ ) . 'js/libs/angular.min.js', array());
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-data-append-admin.js', array( 'angular' ), $this->version, false );

		$ajax_url = get_site_url() . '/wp-admin/admin-ajax.php';
		wp_localize_script( $this->plugin_name, 'dataAppendAdmin', array('ajaxUrl' => $ajax_url) );

		wp_enqueue_script( $this->plugin_name );
	}

	public function register_ajax_calls() {
		add_action('wp_ajax_get_gf_form_object', array( $this, 'get_gf_form_object' ));
	}

	public function get_gf_form_object() {
		header('Content-Type: application/json');
		// echo json_encode(GFAPI::get_form($_POST['form_id']));
		echo 'mildew';
		wp_die(); 
	}

	/**
	 * Displays the admin page
	 *
	 * @since    1.0.0
	 */
	public function display_admin_page() {
		add_menu_page(
			'Data Append',
			'Data Append',
			'manage_options',
			'wp_data_append_admin',
			array( $this, 'show_page' ),
			'dashicons-editor-code',
			'50.0'
			);
	}

	/**
	 * Includes the admin area display
	 *
	 * @since    1.0.0
	 */
	public function show_page() {
		include __DIR__ . '/partials/wp-data-append-admin-display.php';
	}

	/**
	 * Register settings
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {
		// Adds a General section
		add_settings_section(
			$this->option_prefix . '_general',
			__( 'General', 'wp-data-append' ),
			array( $this, $this->option_prefix . '_general_cb' ),
			$this->plugin_name
			);

		// Adds 'Parameters to track' field in General secion
		add_settings_field(
			$this->option_prefix . '_forms_to_apend',
			__( 'Forms to Append', 'wp-data-append' ),
			array( $this, $this->option_prefix . '_forms_to_append_cb' ),
			$this->plugin_name,
			$this->option_prefix . '_general',
			array( 'label_for' => $this->option_prefix . '_forms_to_append' )
			);

		// Registers the 'Parameters to track' field
		register_setting( $this->plugin_name, $this->option_prefix . '_forms_to_append', array( $this, $this->option_prefix . '_sanitize_forms_to_append' ) );
	}

	public function wp_data_append_general_cb() {
		echo '<hr />';
	}

	public function wp_data_append_forms_to_append_cb() {
		include __DIR__ . '/partials/wp-data-append-forms-to-append-display.php';
	}

	public function wp_data_append_sanitize_forms_to_append($value) {
		return $value;
	}
}
