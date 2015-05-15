<?php
/**
 * Represents the view for the login page.
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
<!-- Customize WP-Login Style start -->   
<style type="text/css">
    #login {
width: 300px;
padding: 2% 5% 5% 5%;
margin: auto;
}
.login form {
padding: 1% 24px 46px;
}
   <?php if( !get_option( 'customize-wp-login-wp_login_logo_image' ) ) {} else { ?>    
.login h1 a {
background-image: url(<?php echo esc_attr( get_option('customize-wp-login-wp_login_logo_image') ); ?>);
background-size:90% 100%;
background-position: center top;
background-repeat: no-repeat;
color: #999;
height: 220px;
font-size: 0px;
margin: 0;
width: 300px;
text-indent: -9999px;
display: block;
        }
.login label , .login label  {
font-size:22px !important;
line-height: 2.2
}
.login form .forgetmenot label {
font-size: 12px !important;
}
   <?php } ?>
   <?php if( !get_option( 'customize-wp-login-wp_links_below' ) ) {} else { ?>     .login p#nav {
            display:none;
        }
   <?php } ?>
   <?php if( !get_option( 'customize-wp-login-wp_icon_label' ) ) {} else { ?>     
   .login label[for="user_login"]::before {
content: "\f110";
font-family: "dashicons" !important;
margin-right: 10px;
font-size: 28px;
position: relative;
top: 7px;
}
.login label[for="user_pass"]::before {
content: "\f112";
font-family: "dashicons" !important;
margin-right: 10px;
font-size: 28px;
position: relative;
top: 7px;
}
   <?php } ?>
        body.login.login-action-login.wp-core-ui, body.login, html {
  background-color:<?php echo esc_attr( get_option('customize-wp-login-wp_login_bg') ); ?> !important;
        }        
        .login label, .login .message, .login #nav a, .login #backtoblog a, p#nav {
color:<?php echo esc_attr( get_option('customize-wp-login-wp_login_label_color') ); ?> !important;
        }
        .login form {
  background:<?php echo esc_attr( get_option('customize-wp-login-wp_login_form_bg') ); ?> ; 
  border:none;
  -webkit-box-shadow: none;
  box-shadow:none; 
        }
        .login .message {
  background:<?php echo esc_attr( get_option('customize-wp-login-wp_login_form_bg') ); ?> ; 
  border:none;
  text-align:center;
  -webkit-box-shadow: none;
  box-shadow:none; 
        }
        .login p.message::before {
font-family: "dashicons";
content: "\f488 ";
font-size:28px;
font-weight:bolder;
line-height:0;
padding-right: 12px;
vertical-align:middle;
}
<?php
 if( selected( get_option( 'customize-wp-login_login_button_style' ), 'wpstyle', false)) { 
} elseif( selected( get_option( 'customize-wp-login_login_button_style' ), 'round', false)) { ?>
input#wp-submit.button.button-primary.button-large, .login input[type="submit"] {
border-radius: 100%;
height: 90px;
width:90px;
font-size: 18px;
font-weight: bold;
position: relative;
left: -76px;
}
input#wp-submit.button.button-primary.button-large:hover {
border-radius: 100%;
}
.login form .forgetmenot label {
line-height:90px;
}
.login form input[type=checkbox] {
border-radius:100% !important;
}
 <?php } elseif( selected( get_option( 'customize-wp-login_login_button_style' ), 'flat', false)) { ?> 
.login label #user_login , .login label #user_pass {
font-size:24px !important;
line-height: 2.2
}
input#wp-submit.button.button-primary.button-large, .login input[type="submit"] {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 2;
  -moz-border-radius: 2;
  border-radius: 2px;
  text-shadow: 2px 1px 4px #666666;
  -webkit-box-shadow: 1px 1px 3px #666666;
  -moz-box-shadow: 1px 1px 3px #666666;
  box-shadow: 1px 1px 3px #666666;
  color: #ffffff;
  font-size: 32px;
  padding: 18px 30px 18px 30px;
  text-decoration: none;
  height:100%;
  width:100%;
  position: relative;
}
input#wp-submit.button.button-primary.button-large:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
.login form .forgetmenot label {
font-size: 12px !important;
line-height: 19px;
display: block;
height: 42px;
position: relative;
left: 100%;
}
<?php } elseif( selected( get_option( 'customize-wp-login_login_button_style' ), 'icon1', false)) {  ?>
div#login,.login input#wp-submit.button.button-primary.button-large, .login input[type="submit"] {
display:none !important;
visibility:hidden !important;
}
#login {
width: 300px;
padding: 2% 5% 5% 5%;
margin: auto;
}
button#wp-submit.button-primary {
font-family: 'Roboto', sans-serif !important;
 background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 2;
  -moz-border-radius: 2;
  border-radius: 2px;
  text-shadow: 2px 1px 4px #666666;
  -webkit-box-shadow: 1px 1px 3px #666666;
  -moz-box-shadow: 1px 1px 3px #666666;
  box-shadow: 1px 1px 3px #666666;
  color: #ffffff;
  font-size: 32px;
  padding: 18px 30px 18px 30px;
  text-decoration: none;
  height:100%;
  width:100%;
  max-width: 250px;
  position: relative;
  left: -33px;
  top: 15px;
}
button#wp-submit.button-primary:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
button#wp-submit.button-primary span {
font-family: "dashicons" !important;
font-size: 28px;
}
.login form .login-remember {
font-size: 12px !important;
display: inline-block;
height: 100%;
width: 100%;
position: relative;
text-align: center;
margin-top: 48px;
}
.login-username, .login-password {
text-align:center;
}
.login-username label, .login-password label {
font-size:24px;
line-height: 2.2
}
.login-username label::before, .login-password label::before {
font-family: "dashicons" !important;
margin-right: 10px;
font-size: 28px;
position: relative;
top: 7px;
}
.login-username label::before {
content: "\f110";
}
.login-password label::before {
content: "\f112";
}

<?php }  // end if/else ?>
</style>
<!-- Customize WP-Login Style end -->
