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
class Users_Options {

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

	/*all customs fields for users*/
	

	const FIELDS_USER = array(
		'user-end-time',
		'user-start-time',
		'user-time-start',
		'user-time-end',

		'select-location-user',
		'select-service-user',
		'user-select-day-work',
		'user-color',
		'user-tel',
		'color-picker-user',


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
	
	
	public function extra_user_profile_fields_qpz( $user ) { 
		$user_id = $user->ID;
		$value_user_tel = get_user_meta( $user->ID,'user-tel', true ) ;
		$value_user_end_time = get_user_meta( $user->ID,'user-time-end', true ) ;
		$value_user_start_time = get_user_meta( $user->ID,'user-time-start', true ) ;
		$value_user_color= get_user_meta( $user->ID, 'color-picker-user', true) ;
		



		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\User-addoption.php';

	}
	public function save_extra_user_profile_fields_qpz( $user_id ) {
		if(!current_user_can( 'edit_user', $user_id ) ) { 
			return false; 
			
		}
		$field=self::FIELDS_USER ;
		global $post ;
		foreach($field as $field){
			if(isset($_POST[$field])){
				update_user_meta( $user_id, $field, $_POST[$field]);
			}
		}
		$fournisseurs = get_users( array( 'role__in' => array( 'fournisseur' ) ) );
			foreach( $fournisseurs as $fournisseur){
				$user_id = $fournisseur->ID ;
				$service_selected = get_user_meta( $user_id, 'select-service-user', true);
				
				if (isset($_POST['select-users-for-this-service'][$user_id]) && !empty($_POST['select-users-for-this-service'][$user_id])){
					$service_selected[$post->ID] = 'yes' ;

				} else {
					if(!isset($service_selected[$post->ID])) {
						
					unset($service_selected[$post->ID]);

					}
				}
				
				update_user_meta( $user_id, 'select-service-user', $service_selected );
			}
			
		
		  /*  var_dump($_POST);
		exit;   */  
	}
	public function create_role(){
	add_role(
		'fournisseur',( 'Fournisseur'),array(
			'read'  => true,
			'edit_posts'   => true,
			'publish_posts' => true,
			'upload_files'  => true,
 // This user will NOT be able to  delete published pages.
		)
	);

	remove_role( 'Spa Bordeaux' );
	add_role(
		'Location',( 'Location'),array(
			'read'  => true,
			'edit_posts'   => true,
			'publish_posts' => true,
			'upload_files'  => true,
 // This user will NOT be able to  delete published pages.
		)
	);
	}

}
?>