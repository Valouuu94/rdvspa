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
class Rdvspa_Admin {

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

	const FIELDS = array(
		'role',
		
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
		 * defined in Rdvspa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rdvspa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rdvspa-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . 'tui-calendar', 'https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css', array(), $this->version, 'all' );

	}
	public function mw_enqueue_color_picker( $hook_suffix ) {
		// first check that $hook_suffix is appropriate for your admin page
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle', plugin_dir_url( __FILE__ ) . 'js/wp-color-picker.js', array( 'wp-color-picker' ), false, true );
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
		 * defined in Rdvspa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rdvspa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_script( $this->plugin_name . 'tui-calendar-', 'https://uicdn.toast.com/tui.code-snippet/latest/tui-code-snippet.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . 'tui-code-snippet', 'https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js', array( 'jquery' ), $this->version, false );

	}
	public function Calendrier() {

		add_submenu_page(
			'edit.php?post_type=rendezvous',
			'Calendrier',
			'Calendrier',
			'manage_options',
			'page_calendrier',
			[$this,'page_calendrier'],
			1
		);
	 
	 } 
	 
	public function page_calendrier() {
	 
		global $title;   
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\Calendar-vue.php';
	}

	public function save_post() {
    global $post ;
	$field=self::FIELDS ;
	foreach($field as $field){
		if(isset($_POST[$field])){
			update_post_meta( $post->ID, $field, $_POST[$field]);
			}
		
		}
		

	}


}
?>