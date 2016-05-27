<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/public
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_Data_Append_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-data-append-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-data-append-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Appends the data
	 *
	 * @since    1.0.0
	 */
	public function append_data($form) {
		$forms_to_append = get_option('wp_data_append_forms_to_append');		
		$fma = null;
		$tower_data_results = null;
		$wealth_engine_results = null;
		$submission = new stdClass();
		echo '<pre>'; var_dump($form); echo '</pre>'; exit();
		foreach($forms_to_append as $fta) {
			if($form['id'] == $fta->formId) {
				$fma = $fta;
			}
		}		
		if($fma == null) return;
		$has_full_address_field = $fma->fullAddressFieldId != 'none';		
		$has_full_name_field = $fma->fullNameFieldId != 'none';

		if($has_full_name_field) {
			$submission->first = $_POST['input_' . $fma->fullNameFieldId . '_3'];
			$submission->last = $_POST['input_' . $fma->fullNameFieldId . '_6'];
		} else {
			$submission->first = $_POST['input_' . $fma->firstNameFieldId];
			$submission->last = $_POST['input_' . $fma->lastNameFieldId];
		}

		$submission->email = $_POST['input_' . $fma->emailFieldId];

		if($has_full_address_field) {
			$submission->address1 = $_POST['input_' . $fma->fullAddressFieldId . '_1'];
			$submission->address2 = $_POST['input_' . $fma->fullAddressFieldId . '_2'];
			$submission->city = $_POST['input_' . $fma->fullAddressFieldId . '_3'];
			$submission->state = $_POST['input_' . $fma->fullAddressFieldId . '_4'];
			$submission->zip = $_POST['input_' . $fma->fullAddressFieldId . '_5'];
		} else {
			$submission->address1 = $_POST['input_' . $fma->address1FieldId];
			$submission->address2 = $_POST['input_' . $fma->address2FieldId];
			$submission->city = $_POST['input_' . $fma->cityFieldId];
			$submission->state = $_POST['input_' . $fma->stateFieldId];
			$submission->zip = $_POST['input_' . $fma->zipFieldId];
		}				
		if($fma->enableTowerData) {
			$tower_data_results = $this->get_tower_data_data($submission, $fma);	
		}
		if($fma->enableWealthEngine) {
			$wealth_engine_results = $this->get_wealth_engine_data($submission, $fma);	
		}		
		$this->save_results($tower_data_results, $wealth_engine_results, $fma);
	}

	private function save_results($td, $we, $fma) {				
		$results_arr = array_merge($td, $we);		
		foreach($fma->hiddenFieldMap as $key => $value) {
			$_POST['input_' . $value] = $results_arr[$key];			
		}				
	}

	private function get_tower_data_data($s, $fta) {
		$key = get_option('wp_data_append_towerdata_api_license');		
		$td = new TowerData\TowerDataApi($key);
		$results_arr = [];
		$response = $td->query_by_nap($s->first, $s->last, $s->address1, $s->city, $s->state, $s->email);
		// Convert interests JSON array to CSV string
        if ( isset( $response['interests'] ) ) {
            $interests_string = '';           
            foreach ( $response['interests'] as $key => $value) {
                $interests_string .= $key . ',';
            }            
            $response['interests'] = $interests_string;
        }        
        // Set raw result
        $response['raw_result'] = json_encode($response);
		foreach($response as $key => $value) {
			$results_arr['td_' . $key] = $value;
		}
		return $results_arr;
	}

	private function get_wealth_engine_data($s, $fta) {
		$key = get_option('wp_data_append_wealthengine_api_key');
		$we = new WealthEngine\API\HttpClient($key, 'prod', 'full');
		$result = $we->getProfileByAddress($s->last, $s->first, $s->address1, $s->city, $s->state, intval($s->zip));
		if($result->status_code != '200'){
			$result = $we->getProfileByEmailAddress($s->email, $s->first, $s->last);
		}
		$we_results_arr = array(
            'we_result_id'                      =>  $result->id,
            'we_estimated_annual_donations'     =>  $result->giving->estimated_annual_donations->text,
            'we_gift_capacity'                  =>  $result->giving->gift_capacity->text,
            'we_p2g_score'                      =>  $result->giving->p2g_score->text,
            'we_full_name'                      =>  $result->identity->full_name,
            'we_age'                            =>  $result->identity->age,
            'we_gender'                         =>  $result->identity->gender->text,
            'we_total_property_count'           =>  $result->realestate->total_num_properties,
            'we_total_real_estate_value'        =>  $result->realestate->total_realestate_value->text,
            'we_accredited_investor'            =>  $result->wealth->accredited_investor,
            'we_networth'                       =>  $result->wealth->networth->text,
            'we_total_income'                   =>  $result->wealth->total_income->text,            
            'we_maritalstatus'                  =>  $result->identity->marital_status->text,
            'we_has_children'                   =>  $result->demographics->has_children,
            'we_spouse_full_name'               =>  $result->relationship->spouse->full_name,
            'we_affiliation_inclination'        =>  $result->giving->affiliation_inclination->text,
            'we_influence_rating'               =>  $result->giving->influence_rating->text,
            'we_planned_giving'                 =>  $result->giving->planned_giving->text,
            'we_charitable_donations'           =>  $result->giving->charitable_donations->text,
            'we_total_political_donations'      =>  $result->giving->total_political_donations->text,
            'we_business_ownership'             =>  $result->wealth->business_ownership->text,
            'we_business_sales_volume'          =>  $result->wealth->business_sales_volume->text,
            'we_cash_on_hand'                   =>  $result->wealth->cash_on_hand->text,
            'we_investable_assets'              =>  $result->wealth->investable_assets->text,
            'we_total_assets'                   =>  $result->wealth->total_assets->text,
            'we_total_stock'                    =>  $result->wealth->total_stock->text,
            'we_stock_holdings_direct'          =>  $result->wealth->stock_holdings_direct->text,
            'we_stock_holdings_indirect'        =>  $result->wealth->stock_holdings_indirect->text,
            'we_total_pensions'                 =>  $result->wealth->total_pensions->text,
            'we_vehicle_ownership'              =>  $result->vehicles->ownership->text,
            'we_is_board_member'                =>  $result->professional->board_member,
            'we_jobs'                           =>  $result->jobs == null ? null : json_encode($result->jobs),           
            'we_raw_result'                     =>  json_encode($result),
        );                              
        $addresses = $result->locations;
        $we_results_arr['we_address_1'] = $this->get_we_address_string($addresses, 0);
        $we_results_arr['we_address_2'] = $this->get_we_address_string($addresses, 1);
        $we_results_arr['we_address_3'] = $this->get_we_address_string($addresses, 2);   
		return $we_results_arr;
	}


	private function get_we_address_string($address_arr, $i) 
	{	    
	    $address = $address_arr[$i]->address;
	    $phone = $address_arr[$i]->personal_phone;	    
	    if(!$address) return null;	    
	    $street_line_1 = $address->street_line1;
	    $street_line_2 = $address->street_line2;	 
	    $city = $address->city;
	    $state_code = $address->state->value;
	    $zip = $address->postal_code;	    
	    $address_string = '';	    	    
	    if($street_line_2) {
	        $address_string = $street_line_1 . ' ' . $street_line_2 . ' ' . $city  . ', ' . $state_code . ' ' . $zip; 
	    }	    	    
	    $address_string =  $street_line_1 . ' ' . $city  . ', ' . $state_code . ' ' . $zip; 	   	   
	    if($phone) {
	        $address_string .= ' Phone: ' . $phone;
	    }	    
	    return $address_string;
	}
}
