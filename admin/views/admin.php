<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Customize_WP_Login
 * @author    Bigbabert <info@altertech.it>
 * @license   GPL-2.0+
 * @link      http://altertech.it
 * @copyright 2015 AlterTech
 */
?>
<?php if( isset($_GET['settings-updated']) ) {

?>
    <div id="message" class="updated settings-error notice is-dismissible">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
<?php } ?>
<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php _e('Settings Layout', $this->plugin_slug ); ?></a></li>
			<li><a href="#tabs-2"><?php _e( 'Advanced Settings', $this->plugin_slug ); ?></a></li>
		</ul>
		<div id="tabs-1">

<form method="post" action="options.php" id="<?php $this->plugin_slug .'-options' ?>">
    <input type="hidden" name="object_id" value="<?php $this->plugin_slug .'-options' ?>">
    <?php settings_fields( $this->plugin_slug .'-options','value' == array( $this->plugin_slug ) ); ?>
    <?php do_settings_sections( $this->plugin_slug .'-options','value' == array( $this->plugin_slug ) ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Background Color', $this->plugin_slug ); ?> :</th>
        <td><input type="text" name="customize-wp-login-wp_login_bg" value="<?php echo esc_attr( get_option('customize-wp-login-wp_login_bg') ); ?>" class="wp-color-picker-field" data-default-color="#f1f1f1" /></td>
        <p class="alter_wp_description"><?php echo  __( 'if you use image the color is below', $this->plugin_slug ); ?></p>
        </tr>
        
        <tr class="alter-tr" valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Background Image', $this->plugin_slug ); ?> :</th>
        <td class="alter-td">
            <input type="text" name="customize-wp-login-wp_login_bg_logo_image" id="upload_image1" value="<?php echo esc_attr( get_option('customize-wp-login-wp_login_bg_logo_image') ); ?>" size='40' />
            <input type="button" class='button-secondary' id="customize-wp-login-upload_image_bg_button" value="<?php echo  __( 'Upload Image', $this->plugin_slug ); ?>" />
        <p class="alter_wp_description"><?php echo  __( 'paste url or upload image', $this->plugin_slug ); ?></p>
        <div class="wp-custom-preview_bg"><?php if( !get_option( 'customize-wp-login-wp_login_bg_logo_image' ) ) { } else { ?><p><img src="<?php echo esc_attr( get_option('customize-wp-login-wp_login_bg_logo_image') ); ?>" /></p><h4><?php echo  __( 'Custom Login Background Image', $this->plugin_slug ); ?></h4><?php } ?></div>
        </td>
        </tr>        
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Text Color', $this->plugin_slug ); ?> :</th>
        <td><input type="text" name="customize-wp-login-wp_login_label_color" value="<?php echo esc_attr( get_option('customize-wp-login-wp_login_label_color') ); ?>" class="wp-color-picker-field" data-default-color="#777"  /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Form Background', $this->plugin_slug ); ?> :</th>
        <td><input type="text" name="customize-wp-login-wp_login_form_bg" value="<?php echo esc_attr( get_option('customize-wp-login-wp_login_form_bg') ); ?>" class="wp-color-picker-field" data-default-color="#fff"  />
        <p class="alter_wp_description"><?php echo  __( 'you can use the value' . ' "<strong>transparent</strong>"'.' instead of color', $this->plugin_slug ); ?></p>
        </td>
        </tr>
        
        <tr class="alter-tr" valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Logo Image', $this->plugin_slug ); ?> :</th>
        <td class="alter-td">
            <input type="text" name="customize-wp-login-wp_login_logo_image" id="upload_image" value="<?php echo esc_attr( get_option('customize-wp-login-wp_login_logo_image') ); ?>" size='40' />
            <input type="button" class='button-secondary' id="customize-wp-login-upload_image_button" value="<?php echo  __( 'Upload Image', $this->plugin_slug ); ?>" />
        <p class="alter_wp_description"><?php echo  __( 'paste url or upload image', $this->plugin_slug ); ?></p>
        <div class="wp-custom-preview"><?php if( !get_option( 'customize-wp-login-wp_login_logo_image' ) ) { ?><p><img src="<?php echo admin_url('images/wordpress-logo.svg');?>" /></p><h4><?php echo  __( 'Default Login Logo', $this->plugin_slug ); ?></h4><?php } else { ?><p><img src="<?php echo esc_attr( get_option('customize-wp-login-wp_login_logo_image') ); ?>" /></p><h4><?php echo  __( 'Custom Login Logo', $this->plugin_slug ); ?></h4><?php } ?></div>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Logo Link', $this->plugin_slug ); ?> :</th>
        <td>
        <?php 
 	echo '<input name="customize-wp-login-wp_links_logo" id="customize-wp-login-wp_links_logo" type="checkbox" value="1" default="0" class="code" ' . checked( 1, get_option( 'customize-wp-login-wp_links_logo' ), false ) . ' /> <span class="alter_wp_description">'.  __( 'if checked remove "'.'<strong>'.'link to WordPress' .'</strong>'.'" & tag "'.'<strong>'.'Use WordPress' .'</strong>'.'" on logo', $this->plugin_slug ) .'</span>';
         ?>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Links below', $this->plugin_slug ); ?> :</th>
        <td>
        <?php 
 	echo '<input name="customize-wp-login-wp_links_below" id="customize-wp-login-wp_links_below" type="checkbox" value="1" default="0" class="code" ' . checked( 1, get_option( 'customize-wp-login-wp_links_below' ), false ) . ' /> <span class="alter_wp_description">'.  __( 'if checked remove "'.'<strong>'.'lost my password' .'</strong>'.'" & "'.'<strong>'.'register' .'</strong>'.'" links', $this->plugin_slug ) .'</span>';
         ?>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Icon Label', $this->plugin_slug ); ?> :</th>
        <td>
        <?php 
 	echo '<input name="customize-wp-login-wp_icon_label" id="customize-wp-login-wp_icon_label" type="checkbox" value="1" default="0" class="code" ' . checked( 1, get_option( 'customize-wp-login-wp_icon_label' ), false ) . ' /> <span class="alter_wp_description">'.  __( 'if checked add <span class="dashicons dashicons-admin-users"></span> to Username & <span class="dashicons dashicons-admin-network"></span> to Password', $this->plugin_slug ) .'</span>';
         ?>
        </td>
        </tr>
                
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Button Style', $this->plugin_slug ); ?> :</th>
        <td>
        <?php echo customize_wp_login_login_button_callback(); ?>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Button Icon', $this->plugin_slug ); ?> :</th>
        <td>
        <?php echo customize_wp_login_login_icons_callback(); ?>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Custom CSS', $this->plugin_slug ); ?> :</th>
        <td><p class="alter_wp_description"><?php echo  __( 'insert your custom css code', $this->plugin_slug ); ?></p><textarea type="texta" name="customize-wp-login_custom_css" rows="8" cols="42" /><?php echo esc_attr( get_option('customize-wp-login_custom_css') ); ?></textarea></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>
   <?php  if ( !wp_is_mobile() ) { ?>
    <div class="alter_top_links">
<?php global $text; $alter_save_wp = array( 'id' => 'alter_save_wp' ); submit_button($text, 'primary', 'submit', true, $alter_save_wp); ?></li>
<input type="button" class='button-secondary' id="preview_login_image_button" value="<?php echo  __( 'Preview Login Page', $this->plugin_slug ); ?>" />
    </div>
</form>
  <div class="alter-plugin-head"></a><span><?php $alter_name=__('Customize WP-Login by ', $this->plugin_slug); echo $alter_name; ?><a href="http://altertech.it" target="_blank"><?php $alter_name=__('AlterTech ', $this->plugin_slug); echo $alter_name; ?><img src="<?php echo plugins_url('img/alter-tech-logo.png', __FILE__ ) ;?>" width="50" height="50" class="alter_logo"/></a></span></div>
    <?php } else { ?>  
  </form>
  <div class="alter-plugin-footer-mobile"></a><span><?php $alter_name=__('Customize WP-Login by ', $this->plugin_slug); echo $alter_name; ?><a href="http://altertech.it" target="_blank"><?php $alter_name=__('AlterTech ', $this->plugin_slug); echo $alter_name; ?><img src="<?php echo plugins_url('img/alter-tech-logo.png', __FILE__ ) ;?>" width="50" height="50" class="alter_logo"/></a></span></div>
  <?php } ?>
</div>
<div id="tabs-2">
<?php if( !get_option( 'customize-wp-login-wp_enable_rewrite_rules' ) ) { ?>
    <form method="post" action="options.php" id="<?php $this->plugin_slug .'-options-advanced-enabler' ?>">
    <input type="hidden" name="object_id" value="<?php $this->plugin_slug .'-options-advanced-enabler' ?>"> 
    <?php settings_fields( $this->plugin_slug .'-options-advanced-enabler','value' == array( $this->plugin_slug ) ); ?>
    <h2><?php echo  __( 'Enable this section to use rewrite login rule fuature', $this->plugin_slug ); ?></h2>
    <?php do_settings_sections( $this->plugin_slug .'-options-advanced-enabler','value' == array( $this->plugin_slug ) ); ?>
        <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Rewrite Rule', $this->plugin_slug ); ?> :</th>
        <td>
        <?php 
 	echo '<input name="customize-wp-login-wp_enable_rewrite_rules" id="customize-wp-login-wp_enable_rewrite_rules" type="checkbox" value="1" default="0" class="code" ' . checked( 1, get_option( 'customize-wp-login-wp_enable_rewrite_rules' ), false ) . ' /> <span class="alter_wp_description"><strong>'.  __( 'If checked enable the box to add your rewrite slug', $this->plugin_slug ) .'</strong></span>';
         ?>
        </td>
        </tr>
         </table>               
    <?php submit_button(); ?>
       </form>
<?php } else { ?>
    <form method="post" action="options.php" id="<?php $this->plugin_slug .'-options-advanced-enabler' ?>">
    <input type="hidden" name="object_id" value="<?php $this->plugin_slug .'-options-advanced-enabler' ?>"> 
    <?php settings_fields( $this->plugin_slug .'-options-advanced-enabler','value' == array( $this->plugin_slug ) ); ?>
    <h2><?php echo  __( 'Disable this section to remove rewrite login rule fuature', $this->plugin_slug ); ?></h2>
    <?php do_settings_sections( $this->plugin_slug .'-options-advanced-enabler','value' == array( $this->plugin_slug ) ); ?>
        <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo  __( 'WP-Login Rewrite Rule', $this->plugin_slug ); ?> :</th>
        <td>
        <?php 
 	echo '<input name="customize-wp-login-wp_enable_rewrite_rules" id="customize-wp-login-wp_enable_rewrite_rules" type="checkbox" value="1" default="0" class="code" ' . checked( 1, get_option( 'customize-wp-login-wp_enable_rewrite_rules' ), false ) . ' /> <span class="alter_wp_description"><strong>'.  __( 'If un-checked disable the box below and the feature', $this->plugin_slug ) .'</strong></span>';
         ?>
        </td>
        </tr>
         </table>               
    <?php submit_button(); ?>
       </form>
<form method="post" action="options.php" id="<?php $this->plugin_slug .'-options-advanced' ?>">
    <input type="hidden" name="object_id" value="<?php $this->plugin_slug .'-options-advanced' ?>">
    
    <?php settings_fields( $this->plugin_slug .'-options-advanced','value' == array( $this->plugin_slug ) ); ?>
 
    <?php do_settings_sections( $this->plugin_slug .'-options-advanced','value' == array( $this->plugin_slug ) ); ?>

    <?php submit_button(); ?>
</form>
   <?php }    if ( !wp_is_mobile() ) { ?>
  <div class="alter-plugin-head"></a><span><?php $alter_name=__('Customize WP-Login by ', $this->plugin_slug); echo $alter_name; ?><a href="http://altertech.it" target="_blank"><?php $alter_name=__('AlterTech ', $this->plugin_slug); echo $alter_name; ?><img src="<?php echo plugins_url('img/alter-tech-logo.png', __FILE__ ) ;?>" width="50" height="50" class="alter_logo"/></a></span></div>
    <?php } else { ?>  
  </form>
  <div class="alter-plugin-footer-mobile"></a><span><?php $alter_name=__('Customize WP-Login by ', $this->plugin_slug); echo $alter_name; ?><a href="http://altertech.it" target="_blank"><?php $alter_name=__('AlterTech ', $this->plugin_slug); echo $alter_name; ?><img src="<?php echo plugins_url('img/alter-tech-logo.png', __FILE__ ) ;?>" width="50" height="50" class="alter_logo"/></a></span></div>
  <?php } ?>
</div>
        </div>
</div>