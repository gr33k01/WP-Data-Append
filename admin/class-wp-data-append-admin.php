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
	 * The logger to be used in this class
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	Logger 		$logger 	The logger to be used in this class
	 */
	private $logger;

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
		// $this->logger = new Logger(__DIR__ . '/../logs/');
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

		// Register scripts
		wp_register_script('angular', plugin_dir_url( __FILE__ ) . 'js/libs/angular.min.js', array());
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-data-append-admin.js', array( 'angular' ), $this->version, false );

		// Localize scripts
		$ajax_url = get_site_url() . '/wp-admin/admin-ajax.php';
		wp_localize_script( $this->plugin_name, 'dataAppendAdmin', array('ajaxUrl' => $ajax_url) );

		// Enqueue scripts
		wp_enqueue_script( $this->plugin_name );
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
			'dashicons-chart-line',
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
		// Adds a Tower Data section
		add_settings_section(
			$this->option_prefix . '_towerdata',
			__( 'TowerData', 'wp-data-append' ),
			array( $this, $this->option_prefix . '_towerdata_cb' ),
			$this->plugin_name
			);

		// Adds a WealthEngine section
		add_settings_section(
			$this->option_prefix . '_wealthengine',
			__( 'WealthEngine', 'wp-data-append' ),
			array( $this, $this->option_prefix . '_wealthengine_cb' ),
			$this->plugin_name
			);

		// Adds a General section
		add_settings_section(
			$this->option_prefix . '_general',
			__( 'General', 'wp-data-append' ),
			array( $this, $this->option_prefix . '_general_cb' ),
			$this->plugin_name
			);


		// Adds 'API License' field in TowerData secion
		add_settings_field(
			$this->option_prefix . '_towerdata_api_license',
			__( 'API License', 'wp-data-append' ),
			array( $this, $this->option_prefix . '_towerdata_api_license_cb' ),
			$this->plugin_name,
			$this->option_prefix . '_towerdata',
			array( 'label_for' => $this->option_prefix . '_towerdata_api_license' )
			);

		// Registers the 'API License' field
		register_setting( $this->plugin_name, $this->option_prefix . '_towerdata_api_license', array( $this, $this->option_prefix . '_sanitize_towerdata_api_license' ) );

		// Adds 'API License' field in TowerData secion
		add_settings_field(
			$this->option_prefix . '_wealthengine_api_key',
			__( 'API Key', 'wp-data-append' ),
			array( $this, $this->option_prefix . '_wealthengine_api_key_cb' ),
			$this->plugin_name,
			$this->option_prefix . '_wealthengine',
			array( 'label_for' => $this->option_prefix . '_wealthengine_api_key' )
			);

		// Registers the 'API License' field
		register_setting( $this->plugin_name, $this->option_prefix . '_wealthengine_api_key', array( $this, $this->option_prefix . '_sanitize_wealthengine_api_key' ) );

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

	/**
	 * Towerdata section callback
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_towerdata_cb() {
		echo '<hr />';
	}

	/**
	 * Wealthengine section callback
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_wealthengine_cb() {
		echo '<hr />';
	}

	/**
	 * General section callback
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_general_cb() {
		echo '<hr />';
	}

	/**
	 * Forms to append field callback
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_forms_to_append_cb() {
		include __DIR__ . '/partials/wp-data-append-forms-to-append-display.php';
	}

	/**
	 * Sanitize forms to append
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_sanitize_forms_to_append($value) {
		if(gettype($value) == 'string') {
			$value = json_decode($value);	
		}
		// Remove form maps with no form id
		for($i = 0; $i < count($value); $i++) {
			if($value[$i]->formId == null) {
				unset($value[$i]);
			}
		}
		foreach($value as $form) {
			$hiddenFieldMap = $this->create_fields($form->formId);
			$form->hiddenFieldMap = $hiddenFieldMap;			
		}
		
		return $value;
	}

	/**
	 * Towerdata API license field callback
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_towerdata_api_license_cb() {
		$f_id = $this->option_prefix . '_towerdata_api_license';
		$value = get_option($f_id);
	?>
		<input type="text" name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"  value="<?php echo $value; ?>"/>
		<em class="description">A valid TowerData API license.</em>
	<?php
	}

	/**
	 * Sanitize TowerData API license field.
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_sanitize_towerdata_api_license($value) {
		return $value;
	}

	/**
	 * WealthEngine API key field callback
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_wealthengine_api_key_cb() {
		$f_id = $this->option_prefix . '_wealthengine_api_key';
		$value = get_option($f_id);
	?>
		<input type="text" name="<?php echo $f_id; ?>" id="<?php echo $f_id; ?>"  value="<?php echo $value; ?>"/>
		<em class="description">A valid WealthEngine API key.</em>
	<?php
	}

	/**
	 * Sanitize WealthEngine API key field
	 *
	 * @since    1.0.0
	 */
	public function wp_data_append_sanitize_wealthengine_api_key($value) {
		return $value;
	}
	
	/**
	 * Creates data append fields on a form if they do not exist
	 *
	 * @since    1.0.0
	 */
	private function create_fields($form_id) {
		$form = GFAPI::get_form($form_id);
	    $has_all_fields = true;
	    $max_id = 0;
	    $form_change = false;
	    $the_labels =  $this->get_labels();
	    $flat_label_array = array();
	    $hiddenFieldMap = array();

	    foreach($the_labels as $key=>$value) {
	    	array_push($flat_label_array, $key);
	    }

	    foreach ($form['fields'] as $field) {
	        // increment the $max_id so we don't assign the same id to the new hidden fields
	        if (floatval( $field->id ) > $max_id) {
	            $max_id = floatval( $field->id );
	        }

	        // check if the label for the current field is in the $the_labels array
	        if (in_array( $field->label, $flat_label_array)) {
	            // the label has been found, we don't need to add this hidden field so set the boolean to false.
	            $the_labels[ $field->label ] = false;	          
	            $hiddenFieldMap[$field->label] = $field->id;
	        }	        
	    }

	    // Loop through the labels and if a label is needed add a hidden field
	    foreach ($the_labels as $label => $needed) {
	        if ($needed) {
	        	$new_id = ++ $max_id;
	        	$this->logger->info('Adding field ' . $label . ' to ' . $form['title']);
	            array_push($form['fields'], array(
	                'type'  => 'hidden',
	                'label' => $label,
	                'id'    => $new_id,
	            	));

	            $hiddenFieldMap[$label] = $new_id;
	            $form_change = true;
	        }
	    }

	    // Only update the form if it has changed.
	    if ($form_change) {
	        GFAPI::update_form( $form );
	    }	

	    if(!$form_change) {
	    	$this->logger->info('No fields added to ' . $form['title']);
	    }

	    return $hiddenFieldMap;
	}	

	/**
	 * Returns static list of labels for requried hidden fields.
	 *
	 * @since    1.0.0
	 */
	private function get_labels() {
		return Wp_Data_Append_Service::get_labels();
	}


	/**
	 * Removes form map
	 *
	 * @since    1.0.0
	 */
	public function remove_form_map() {
		$index = $_POST['formMapIndex'];
		$option = 'wp_data_append_forms_to_append';
		$forms_to_append = get_option($option);
		$form = GFAPI::get_form($forms_to_append[$index]->formId);

		try {
			$this->logger->info('Removing ' . $form['title'] .  ' from data appends.');
			unset($forms_to_append[$index]);			
			update_option( $option, $forms_to_append);			
			http_response_code(204);
		}
		catch(Exception $e) {
			$message = 'Error removing form map for ' . $form['title'] .': ' . $e->getMessage();
			$this->logger->error($message);
			http_response_code(500);
		}
	}

	/**
	 * Removes form labels
	 *
	 * @since    1.0.0
	 */
	private function remove_form_fields($form_id) {
		try {
			$form = GFAPI::get_form($form_id);
			$labels = $this->get_labels();
			$update_form = false;
			$this->logger->info($form_id);

			foreach($form['fields'] as $key => $value) {
				$field = $value;				
				if(array_key_exists($value['label'], $labels)) {
					$update_form = true;
					$this->logger->info('Removing ' . $value['label'] . ' from ' .$form['title']);
					unset($form['fields'][$key]);
				}
			}
				
			if($update_form) GFAPI::update_form($form);
		}
		catch(Exception $e) {
			$message = 'Error removing fields from ' . $form['title'] .': ' . $e->getMessage();
			$this->logger->error($message);
		}		
	}
}
