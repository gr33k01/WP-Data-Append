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
 * Used to store form data append settings.
 *
 * This class has all fields to configure data appends.
 *
 * @since      1.0.0
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/includes
 * @author     Nate Hobi <nate.hobi@gmail.com>
 */
class Wp_Data_Append_Settings {

	/**
	 * An array of form map objects.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $form_maps    An array of form map objects.
	 */
	public $form_maps;

	/**
	 * The TowerData API license.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $tower_data_api_license    The TowerData API license.
	 */
	public $tower_data_api_license;

	/**
	 * The WealthEngine API key.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $wealth_engine_api_key    The WealthEngine API key.
	 */
	public $wealth_engine_api_key;

	/**
	 * The WealthEngine mode.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $wealth_engine_mode   The WealthEngine mode.
	 */
	public $wealth_engine_mode;

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function __construct( $form_maps, $tower_data_api_license, 
		$wealth_engine_api_key, $wealth_engine_mode ) {
		try {
			$this->form_maps = $form_maps;
			$this->tower_data_api_license = $tower_data_api_license;
			$this->wealth_engine_api_key = $wealth_engine_api_key;
			$this->wealth_engine_mode = $wealth_engine_mode;
		} catch(Exception $e) {

		}
	}
}
