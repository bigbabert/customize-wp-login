<?php

/**
 * Customize WP-Login
 *
 * @package   Customize_WP_Login_Admin
 * @author    Bigbabert <info@altertech.it>
 * @license   GPL-2.0+
 * @link      http://altertech.it
 * @copyright 2015 AlterTech
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 *
 * @package Customize_WP_Login_Admin
 * @author  Bigbabert <info@altertech.it>
 */
class Customize_WP_Login_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
        
        
	private function __construct() {

		/*
		 * Call $plugin_slug from public plugin class.
		 *
		 */
		$plugin = Customize_WP_Login::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->plugin_name = $plugin->get_plugin_name();
		$this->version = $plugin->get_plugin_version();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {


		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		if ( !isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id || strpos( $_SERVER[ 'REQUEST_URI' ], 'index.php' ) || strpos( $_SERVER[ 'REQUEST_URI' ], get_bloginfo( 'wpurl' ) . '/wp-admin/' ) ) {
			wp_enqueue_style( $this->plugin_slug . '-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array( 'dashicons' ), Customize_WP_Login::VERSION );
			wp_enqueue_style( $this->plugin_slug . '-dashicons-picker-styles', plugins_url( 'assets/css/dashicons-picker.css', __FILE__ ), array( 'dashicons' ), Customize_WP_Login::VERSION );
			wp_enqueue_style( $this->plugin_slug . '-dashicons-picker-styles', plugins_url( 'assets/css/genericons/genericons/genericons.css', __FILE__ ), array( 'dashicons' ), Customize_WP_Login::VERSION );
		        wp_enqueue_style( 'wp-color-picker' );
                        wp_enqueue_style('thickbox');
                        
}
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		if ( !isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-tabs' ), Customize_WP_Login::VERSION );
                        wp_enqueue_script( $this->plugin_slug . '-color-picker-script', plugins_url('assets/js/color-picker-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
                        wp_enqueue_script( $this->plugin_slug . '-upload-script', plugins_url('assets/js/upload-script.js', __FILE__ ), array( 'jquery','media-upload','thickbox' ), false, true );
                        wp_enqueue_script( $this->plugin_slug . '-preview-script', plugins_url('assets/js/customize-wp-preview.js', __FILE__ ), array( 'jquery','media-upload','thickbox' ), false, true );
	                wp_enqueue_script( $this->plugin_slug . '-dashicons-picker', plugins_url('assets/js/dashicons-picker.js', __FILE__ ), array( 'jquery' ), false );
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
                }
	}
	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */

		/*
		 * Settings page in the menu
		 * 
		 */
		$this->plugin_screen_hook_suffix = add_menu_page( __( 'Customize WP-Login Settings', 'customize-wp-login'  ), __( 'WP-Login', $this->plugin_slug ), 'manage_options', $this->plugin_slug, array( $this, 'display_plugin_admin_page' ), 'dashicons-editor-code', 90 );

                function customize_wp_login_login_button_callback() {
     
        $html = '<select id="customize-wp-login_login_button_style" name="customize-wp-login_login_button_style">';
        $html .= '<option value="wpstyle"' . selected( get_option( 'customize-wp-login_login_button_style' ), 'wpstyle', false) . '>'.__( 'Default Style', 'customize-wp-login' ).'</option>';
        $html .= '<option value="round"' . selected( get_option( 'customize-wp-login_login_button_style' ), 'round', false) . '>'.__( 'Round Style', 'customize-wp-login' ).'</option>';
        $html .= '<option value="flat"' . selected( get_option( 'customize-wp-login_login_button_style' ), 'flat', false) . '>'.__( 'Flat Style', 'customize-wp-login' ).'</option>';
        $html .= '<option value="icon1"' . selected( get_option( 'customize-wp-login_login_button_style' ), 'icon1', false) . '>'.__( 'Icon Style', 'customize-wp-login' ).'</option>';
        $html .= '</select>';
        $html .= '<span class="alter_wp_description">'. __( 'select style for login button', 'customize-wp-login' ).'</span>';
    echo $html;
} 
                function customize_wp_login_login_icons_callback() {
     $options = get_option( 'customize-wp-login-dashicons_picker_settings' ); 
     		?>				
	<input class="regular-text" type="text" id="customize-wp-login-dashicons_picker_settings" name="customize-wp-login-dashicons_picker_settings" value="<?php if( isset( $options ) ) { echo esc_attr( $options ); } ?>"/>
	<input type="button" data-target="#customize-wp-login-dashicons_picker_settings" class="button icon-picker" value="Choose Icon" />
        <p class="alter_wp_description"><?php echo  __( '* this icon will appear only with the <strong>Button Style Icon</strong>', 'customize-wp-login' ); ?></p>
       <?php

}// end sandbox_radio_element_callback

                 //call register settings function
	         add_action( 'admin_init', 'customize_wp_login_register_settings' );
                 function customize_wp_login_register_settings() {
	register_setting( 'customize-wp-login-options','customize-wp-login-wp_login_bg');
	register_setting( 'customize-wp-login-options', 'customize-wp-login-wp_login_label_color');
	register_setting( 'customize-wp-login-options', 'customize-wp-login-wp_login_form_bg');
	register_setting( 'customize-wp-login-options', 'customize-wp-login-wp_login_logo_image');
	register_setting( 'customize-wp-login-options',  'customize-wp-login-wp_links_logo');
	register_setting( 'customize-wp-login-options',  'customize-wp-login-wp_links_below');
	register_setting( 'customize-wp-login-options',  'customize-wp-login-wp_icon_label');
        register_setting( 'customize-wp-login-options',  'customize-wp-login_login_button_style');
	register_setting( 'customize-wp-login-options',  'customize-wp-login-dashicons_picker_settings');
	register_setting( 'customize-wp-login-options', 'customize-wp-login_custom_css');
       
}	

        }
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
  }

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		return array_merge(
				array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings' ) . '</a>',
			'donate' => '<a href="https://www.eatscode.com/" target="_blank" >' . __( 'Donate', $this->plugin_slug ) . '</a>'
				), $links
		);
	}

	/**
	 * NOTE:     Actions are points in the execution of a page or process
	 *           lifecycle that WordPress fires.
	 *
	 *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
               
            }

	/**
	 * NOTE:     Filters are points of execution in which WordPress modifies data
	 *           before saving it or sending it to the browser.
	 *
	 *           Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	public function filter_method_name() {

	}


}
