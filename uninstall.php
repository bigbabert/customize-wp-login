<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Customize_WP_Config
 * @author    Bigbabert <info@altertech.it>
 * @license   GPL-2.0+
 * @link      http://altertech.it
 * @copyright 2015 AlterTech
 */
// If uninstall not called from WordPress, then exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


if ( is_multisite() ) {

	$blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );

    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_bg`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_bg_logo_image`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_label_color`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_form_bg`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_logo_image`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_links_below`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login_login_button_style`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-dashicons_picker_settings`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login_custom_css`");
	  $GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
        delete_option('customize-wp-login-wp_login_bg');
        delete_option('customize-wp-login-wp_login_bg_logo_image');
        delete_option('customize-wp-login-wp_login_label_color');
	delete_option('customize-wp-login-wp_login_form_bg');
	delete_option('customize-wp-login-wp_login_logo_image');
	delete_option('customize-wp-login-wp_links_logo');
	delete_option('customize-wp-login-wp_links_below');
	delete_option('customize-wp-login-wp_icon_label');
        delete_option('customize-wp-login_login_button_style');
	delete_option('customize-wp-login-dashicons_picker_settings');
	delete_option('customize-wp-login_custom_css');
	if ( $blogs ) {

		foreach ( $blogs as $blog ) {
			switch_to_blog( $blog[ 'blog_id' ] );

     	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_bg`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_bg_logo_image`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_label_color`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_form_bg`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_logo_image`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_links_below`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login_login_button_style`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-dashicons_picker_settings`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login_custom_css`");
	  $GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
        delete_option('customize-wp-login-wp_login_bg');
        delete_option('customize-wp-login-wp_login_bg_logo_image');
	delete_option('customize-wp-login-wp_login_label_color');
	delete_option('customize-wp-login-wp_login_form_bg');
	delete_option('customize-wp-login-wp_login_logo_image');
	delete_option('customize-wp-login-wp_links_logo');
	delete_option('customize-wp-login-wp_links_below');
	delete_option('customize-wp-login-wp_icon_label');
        delete_option('customize-wp-login_login_button_style');
	delete_option('customize-wp-login-dashicons_picker_settings');
	delete_option('customize-wp-login_custom_css');
			

			restore_current_blog();
		}
	}
} else {

    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_bg`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_bg_logo_image`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_label_color`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_form_bg`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_login_logo_image`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-wp_links_below`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login_login_button_style`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login-dashicons_picker_settings`");
    	  $GLOBALS['wpdb']->query("DROP TABLE `".$GLOBALS['wpdb']->prefix."customize-wp-login_custom_css`");
	  $GLOBALS['wpdb']->query("OPTIMIZE TABLE `" .$GLOBALS['wpdb']->prefix."options`");
        delete_option('customize-wp-login-wp_login_bg');
        delete_option('customize-wp-login-wp_login_bg_logo_image');
	delete_option('customize-wp-login-wp_login_label_color');
	delete_option('customize-wp-login-wp_login_form_bg');
	delete_option('customize-wp-login-wp_login_logo_image');
	delete_option('customize-wp-login-wp_links_logo');
	delete_option('customize-wp-login-wp_links_below');
	delete_option('customize-wp-login-wp_icon_label');
        delete_option('customize-wp-login_login_button_style');
	delete_option('customize-wp-login-dashicons_picker_settings');
	delete_option('customize-wp-login_custom_css');
	
}