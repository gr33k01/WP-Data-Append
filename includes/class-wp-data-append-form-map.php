<?php

/**
 * Used to store form field map settings.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/includes
 */

/**
 * Used to store form field map settings.
 *
 * This class has all fields to configure field mappings.
 *
 * @since      1.0.0
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/includes
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_Data_Append_Form_Settings {

	/**
	 * The gravity form id.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $form_id    The gravity form id.
	 */
	public $form_id;
	public $first_name_id;
	public $last_name_id;
	public $email_id;
	public $address_id;
	public $address_2_id;
	public $city_id;
	public $state_id;
	public $zip_id;

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function __construct( $form_id, $first_name_id, $last_name_id, 
		$email_id, $address_id, $address_2_id, $city_id, $state_id, $zip_id ) {


		$this->form_id = $form_id;
		$this->first_name_id = $first_name_id;
		$this->last_name_id = $last_name_id;
		$this->email_id = $email_id;
		$this->address_id = $address_id;
		$this->address_2_id = $address_2_id;
		$this->city_id = $city_id;
		$this->state_id = $state_id;
		$this->zip_id = $zip_id;
	}

}
