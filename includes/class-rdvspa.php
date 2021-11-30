
<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Rdvspa
 * @subpackage Rdvspa/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Rdvspa
 * @subpackage Rdvspa/includes
 * @author     Valentin <#>
 */
class Rdvspa {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rdvspa_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'RDVSPA_VERSION' ) ) {
			$this->version = RDVSPA_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'rdvspa';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Rdvspa_Loader. Orchestrates the hooks of the plugin.
	 * - Rdvspa_i18n. Defines internationalization functionality.
	 * - Rdvspa_Admin. Defines all hooks for the admin area.
	 * - Rdvspa_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-rdvspa-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-rdvspa-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-rdvspa-admin.php';
		
		/**
		 * The class responsible for defining all actions for options users.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-users-options.php';
		/**
		 * The class responsible for defining all actions for locations.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-locations.php';
		/**
		 * The class responsible for defining all actions for services.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-services.php';
		/**
		 * The class responsible for defining all actions for rooms.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-rooms.php';

		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/template/calendar/index.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-rdvspa-public.php';

/* 		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin\template\meta-box-addlocation.php';
 */
		$this->loader = new Rdvspa_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Rdvspa_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Rdvspa_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Rdvspa_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'Calendrier' );
		$this->loader->add_action( 'save_post',$plugin_admin, 'save_post');
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin,'mw_enqueue_color_picker' );

		$users_options = new Users_Options( $this->get_plugin_name(), $this->get_version() );

		/* -- User can edit his own profile from dashboard with these lines. -- */
		$this->loader->add_action( 'personal_options_update',$users_options, 'save_extra_user_profile_fields_qpz' );
		$this->loader->add_action( 'show_user_profile', $users_options,'extra_user_profile_fields_qpz' );
 		/* -- ADMIN can edit all user profiles from dashboard with these lines. -- */
 		$this->loader->add_action( 'edit_user_profile_update',$users_options, 'save_extra_user_profile_fields_qpz' );
 		$this->loader->add_action( 'edit_user_profile',$users_options, 'extra_user_profile_fields_qpz' );
		/* for the creation users */
		$this->loader->add_action( 'user_new_form',$users_options, 'save_extra_user_profile_fields_qpz' );
		$this->loader->add_action( 'user_new_form',$users_options, 'extra_user_profile_fields_qpz' );
		$this->loader->add_action( 'init',$users_options, 'create_role');

		$cpt_locations = new Cpt_Locations( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'add_meta_boxes',$cpt_locations,'add_meta_box_location');
		$this->loader->add_action( 'save_post',$cpt_locations, 'save_post_location');


		$cpt_services = new Cpt_Services( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'add_meta_boxes',$cpt_services,'add_meta_box_service');
		$this->loader->add_action( 'save_post',$cpt_services, 'save_post_service');

		
		$cpt_rooms = new Cpt_Rooms( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'add_meta_boxes',$cpt_rooms,'add_meta_box_room');
		$this->loader->add_action( 'save_post',$cpt_rooms, 'save_post_room');


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Rdvspa_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Rdvspa_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
