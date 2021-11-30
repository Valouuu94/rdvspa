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
class Cpt_Rooms {

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

	const FIELDS_ROOMS = array(
		'room-name',
		'room-capacity',
		'room-location',
		'select-service-room',
		'select-service-user',
		'room-category',
		
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

	public function add_meta_box_room() {
		add_meta_box('Salle','Detail de la salle',[ $this,'meta_render_room'],'salles');
		add_meta_box('Salle_Services','Service associée(s)',[ $this,'meta_box_services_for_this_room'],'salles','side','core');


	}
	public function meta_box_services_for_this_room() {
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\meta-box-services-for-this-room.php';


	}
	public function meta_render_room(){
		global $post;
		$value_room_name = get_post_meta($post->ID, 'room-name', true);
		$value_room_capacity = get_post_meta($post->ID, 'room-capacity', true);
		$value_room_location = get_post_meta($post->ID, 'room-location', true);
		$value_room_category = get_post_meta($post->ID, 'room-category', true);

		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\meta-box-addroom.php';
	   
	}
	public function save_post_room() {
    global $post ;
	$field=self::FIELDS_ROOMS ;
	foreach($field as $field){
		if(isset($_POST[$field])){
			update_post_meta( $post->ID, $field, $_POST[$field]);
			}
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