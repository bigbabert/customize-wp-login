<?php
/**
 * @package   Customize_WP_Login
 * @author    Bigbabert <info@altertech.it>
 * @license   GPL-2.0+
 * @link      http://altertech.it
 * @copyright 2015 AlterTech
 *
 * @wordpress-plugin
 * Plugin Name:       Customize WP-Login
 * Plugin URI:        http://blog.altertech.it/customize-wp-login/
 * Description:       Customize WP-Login by AlterTech provide a visual editor to customize the wp-login page and if you want should enable social login.
 * Version:           1.0.0
 * Author:            Bigbabert
 * Author URI:        http://blog.altertech.it/alberto-cocchiara/
 * Text Domain:       customize-wp-login
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}
/*
 * Load Language wrapper function for WPML/Ceceppa Multilingua/Polylang
 */
//require_once( plugin_dir_path( __FILE__ ) . 'languages/language.php' );
add_action('plugins_loaded', 'customize_wp_login_page_lang_ready');
function customize_wp_login_page_lang_ready() {
	load_plugin_textdomain( 'customize-wp-login', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
/*
 * Load public class to display login page customization
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'public/customize-wp-login-class.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Customize_WP_Login', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Customize_WP_Login', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Customize_WP_Login', 'get_instance' ) );

/* ----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 * ---------------------------------------------------------------------------- */

if ( is_admin()  ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/customize-wp-login-admin-class.php' );
	add_action( 'plugins_loaded', array( 'Customize_WP_Login_Admin', 'get_instance' ) );
}
