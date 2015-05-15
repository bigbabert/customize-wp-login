<?php

/**
 * Customize_WP_Login
 *
 * @package   Customize_WP_Login
 * @author    Bigbabert <info@altertech.it>
 * @license   GPL-2.0+
 * @link      http://altertech.it
 * @copyright 2015 AlterTech
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 *
 * @package Customize_WP_Login
 * @author  Bigbabert <info@altertech.it>
 */
class Customize_WP_Login {

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    const VERSION = '1.0.0';

    /**
     *
     * Unique identifier for your plugin.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected static $plugin_slug = 'customize-wp-login';

    /**
     *
     * Unique identifier for your plugin.
     *
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected static $plugin_name = 'Customize_WP_Login';

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    private function __construct() {
        // Load plugin text name & description ready to translate
        $plugin_tanslable_name = __('Customize WP-Login','customize-wp-login');
        $plugin_tanslable_desc = __('Customize WP-Login by AlterTech provide a visual editor to customize the wp-login page and if you want should enable social login.','customize-wp-login');
        // Load plugin text domain
        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
        // Activate plugin when new blog is added
        add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );     
        /* 
         * Define custom functionality.
         * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
         */	
        
function customize_wp_login_style_login_page() {
if( selected( get_option( 'customize-wp-login_login_button_style' ), 'round', false)) {
    add_action( 'login_form', 'customize_wp_login_round_btn' );
function customize_wp_login_round_btn() {
    add_filter( 'gettext', 'customize_wp_login_login_txt', 10, 2 );
}

function customize_wp_login_login_txt( $translation, $text ) {
    if ( 'Log In' == $text ) {
        return  'Log In >';
    }
    return $translation;
    }
}
if( selected( get_option( 'customize-wp-login_login_button_style' ), 'icon1', false)) {
         function customize_wp_login_login_footer() {
    return '<button type="submit" name="wp-submit" id="wp-submit" class="button-primary">'.__('Log In','customize-wp-login').' <span class="dashicons '. esc_attr(get_option( 'customize-wp-login-dashicons_picker_settings' )).'"></span></button>';
}
add_filter('login_form_middle', 'customize_wp_login_login_footer');
         function customize_wp_login_login_top() {
             
             $html = '<h1><a href="'. get_home_url().'" title="'.get_bloginfo( 'name' ).'" tabindex="-1">Google_S Theme</a></h1>';
             return $html;
}
add_filter('login_form_top', 'customize_wp_login_login_top');
$args = array(
         'echo'           => true,
        'redirect' => admin_url(),   
        'form_id' => 'login',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => false,
        'remember' => true
    );
    wp_login_form( $args );
} 
if( !get_option( 'customize-wp-login-wp_links_logo' ) ) {} else {
    function customize_wp_login_login_page_custom_link() {
	return esc_url( home_url( '/' ) );
}
function customize_wp_login_change_title_on_logo() { 
	return get_bloginfo( 'name' );
}
add_filter('login_headertitle', 'customize_wp_login_change_title_on_logo');
add_filter('login_headerurl','customize_wp_login_login_page_custom_link');
}
        include_once( 'views/customize-wp-login-page.php' );
}
        add_action( 'login_enqueue_scripts', 'customize_wp_login_style_login_page' );
    }
    /**
     * Return the plugin slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_plugin_slug() {
        return self::$plugin_slug;
    }

    /**
     * Return the plugin name.
     *
     * @since    1.0.0
     *
     * @return    Plugin name variable.
     */
    public function get_plugin_name() {
        return self::$plugin_name;
    }

    /**
     * Return the version
     *
     * @since    1.0.0
     *
     * @return    Version const.
     */
    public function get_plugin_version() {
        return self::VERSION;
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
     * Fired when the plugin is activated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Activate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       activated on an individual blog.
     */
    public static function activate( $network_wide ) {
     

        if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {

                    switch_to_blog( $blog_id );
                    self::single_activate();

                    restore_current_blog();
                }
            } else {
                self::single_activate();
            }
        } else {
            self::single_activate();
        }
       
           

    }
    /**
     * Fired when the plugin is deactivated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Deactivate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       deactivated on an individual blog.
     */
    public static function deactivate( $network_wide ) {

        if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {

                    switch_to_blog( $blog_id );
                    self::single_deactivate();

                    restore_current_blog();
                }
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     *
     * @since    1.0.0
     *
     * @param    int    $blog_id    ID of the new blog.
     */
    public function activate_new_site( $blog_id ) {

        if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
            return;
        }

        switch_to_blog( $blog_id );
        self::single_activate();
        restore_current_blog();
    }

    /**
     * Get all blog ids of blogs in the current network that are:
     * - not archived
     * - not spam
     * - not deleted
     *
     * @since    1.0.0
     *
     * @return   array|false    The blog ids, false if no matches.
     */
    private static function get_blog_ids() {

        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

        return $wpdb->get_col( $sql );
    }

    /**
     * Fired for each blog when the plugin is activated.
     *
     * @since    1.0.0
     */
    private static function single_activate() {
        //Requirements Detection System - read the doc in the library file
        require_once( plugin_dir_path( __FILE__ ) . 'inc/requirements.php' );
        new Plugin_Requirements( self::$plugin_name, self::$plugin_slug, array(
            'WP' => new WordPress_Requirement( '3.9.0' ),
                ) );


       }  
        
    /**
     * Fired for each blog when the plugin is deactivated.
     *
     * @since    1.0.0
     */
    private static function single_deactivate() {
        
 
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {
        $domain = $this->get_plugin_slug();
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
        load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );
    }

    /**
     * Add class in the body on the frontend
     *
     * @since    1.0.0
     */
    public function add_pn_class( $classes ) {
        $classes[] = $this->get_plugin_slug();
        return $classes;
    }

    /**
     * NOTE:  Actions are points in the execution of a page or process
     *        lifecycle that WordPress fires.
     *
     *        Actions:    http://codex.wordpress.org/Plugin_API#Actions
     *        Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
     *
     * @since    1.0.0
     */
    public function action_method_name() {

    }

    /**
     * NOTE:  Filters are points of execution in which WordPress modifies data
     *        before saving it or sending it to the browser.
     *
     *        Filters: http://codex.wordpress.org/Plugin_API#Filters
     *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
     *
     * @since    1.0.0
     */
    public function filter_method_name() {

        }
}
