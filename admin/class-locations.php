<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Rdvspa
 * @subpackage Rdvspa/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rdvspa
 * @subpackage Rdvspa/admin
 * @author     Valentin <#>
 */
class Cpt_Locations {

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

	/*all customs fields */

	const FIELDS_LOCATION = array(
		'location-name',
		'location-tel',
		'location-address',
		'location-city',
		'location-postalcode',
		'location-country',
		'location-mail',
		'select-location',
		
	);


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

	 public function add_meta_box_location() {
			add_meta_box('Lieux','Detail du Lieu',[ $this,'meta_render_location'],'spa');
	}
		
	public function meta_render_location(){
			 global $post;
			 $value_location_name = get_post_meta($post->ID, 'location-name', true);
			 $value_location_tel = get_post_meta($post->ID, 'location-tel', true);
			 $value_location_address = get_post_meta($post->ID, 'location-address', true);
			 $value_location_city = get_post_meta($post->ID, 'location-city', true);
			 $value_location_postalcode = get_post_meta($post->ID, 'location-postalcode', true);
			 $value_location_country = get_post_meta($post->ID, 'location-country', true);
			 $value_location_mail = get_post_meta($post->ID, 'location-mail', true);

			 require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\meta-box-addlocation.php';
			
	}

	
	public function save_post_location() {
    global $post ;
	$field=self::FIELDS_LOCATION ;
	foreach($field as $field){
		if(isset($_POST[$field])){
			update_post_meta( $post->ID, $field, $_POST[$field]);
			}
		}
		

	}


}
?>