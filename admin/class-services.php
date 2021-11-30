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
class Cpt_Services {

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

	const FIELDS_SERVICES = array(
		'select-location',
		'service-name',
		'service-price',
		'service-capacity',
		'service-countfournisseur',
		'service-location',
		'service-category',
		'service-duration-number',
		'service-duration',
		'service-time-espacement-padding',
		'service-time-espacement',
		'select-service-room',
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
	
	public function add_meta_box_service() {
		add_meta_box('Service','Detail du service',[ $this,'meta_render_service'],'services');
		add_meta_box('Service_Fournisseur','Fournisseur(s) associé',[ $this,'meta_box_fournisseurs_for_this_service'],'services','side','core');
		add_meta_box('Service_Salles','Salles associée(s)',[ $this,'meta_box_rooms_for_this_service'],'services','side','core');

	}
	public function meta_box_fournisseurs_for_this_service() {

		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\meta-box-fournisseurs-for-this-service.php';

	}
	public function meta_box_rooms_for_this_service(){

		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\meta-box-rooms-for-this-service.php';

	}
	public function meta_render_service(){
		 global $post;
		 $value_service_name = get_post_meta($post->ID, 'service-name', true);
		 $value_service_price = get_post_meta($post->ID, 'service-price', true);
		 $value_service_capacity = get_post_meta($post->ID, 'service-capacity', true);
		 $value_service_duration = get_post_meta($post->ID, 'service-duration', true);
		 $value_service_duration_number = get_post_meta($post->ID, 'service-duration-number', true);
		 $value_service_countfournisseur = get_post_meta($post->ID, 'service-countfournisseur', true);
		 $value_service_location = get_post_meta($post->ID, 'service-location', true);
		 $value_service_category = get_post_meta($post->ID, 'service-category', true);
		 $value_service_time_espacement = get_post_meta($post->ID, 'service-time-espacement', true);
		 $value_service_time_espacement_padding = get_post_meta($post->ID, 'service-time-espacement-padding', true);




		 require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\meta-box-addservice.php';
		
	}
	
	public function save_post_service() {
    global $post ;
	$field=self::FIELDS_SERVICES ;
	foreach($field as $field){
		if(isset($_POST[$field])){
			update_post_meta( $post->ID, $field, $_POST[$field]);
			}
		}
		$fournisseurs = get_users( array( 'role__in' => array( 'fournisseur' ) ) );
			foreach( $fournisseurs as $fournisseur){
				$user_id = $fournisseur->ID ;
				$service_selected = get_user_meta( $user_id, 'select-service-user', true);
				
				if (isset($_POST['select-users-for-this-service'][$user_id]) && !empty($_POST['select-users-for-this-service'][$user_id])){
					$service_selected[$post->ID] = 'yes' ;

				} else {
					if(isset($service_selected[$post->ID])) {
						
					unset($service_selected[$post->ID]);

					}
				}
				
				update_user_meta( $user_id, 'select-service-user', $service_selected );
			}
			$rooms = get_posts(array(
				'post_type' => 'salles',
				'numberposts' => -1,
				));
				foreach( $rooms as $room){
				$service_selected = get_post_meta( $room->ID, 'select-service-room', true);
				
				if (isset($_POST['select-rooms-for-this-service'][$room->ID]) && !empty($_POST['select-rooms-for-this-service'][$room->ID])){
					$service_selected[$post->ID] = 'yes' ;
	
				} else {
					if(isset($service_selected[$post->ID])) {
						
					unset($service_selected[$post->ID]);
	
					}
				}
				
				update_post_meta( $room->ID, 'select-service-room', $service_selected );
			}
	}
}
?>