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
        $plugin_tanslable_desc = __('Customize WP-Login by AlterTech provide a visual editor to customize the wp-login page and if you want should enable social login. There is also a security feature that you can enable in Advanced Settings, to rewrite the url of the login.','customize-wp-login');
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
if( !get_option( 'customize-wp-login-wp_enable_rewrite_rules' ) ) {} else {
    
class Customize_WP_Login_Admin_Advanced {

		private $wp_login_php;

        /**
         * Instance of this class.
         *
         * @since    1.0.0
         *
         * @var      object
         */
        protected static $instance = null;

		private function basename() {

			return plugin_basename( __FILE__ );

		}

		private function path() {

			return trailingslashit( dirname( __FILE__ ) );

		}

		private function use_trailing_slashes() {

			return ( '/' === substr( get_option( 'permalink_structure' ), -1, 1 ) );

		}

		private function user_trailingslashit( $string ) {

			return $this->use_trailing_slashes()
				? trailingslashit( $string )
				: untrailingslashit( $string );

		}

		private function wp_template_loader() {

			global $pagenow;

			$pagenow = 'index.php';

			if ( ! defined( 'WP_USE_THEMES' ) ) {

				define( 'WP_USE_THEMES', true );

			}

			wp();

			if ( $_SERVER['REQUEST_URI'] === $this->user_trailingslashit( str_repeat( '-/', 10 ) ) ) {

				$_SERVER['REQUEST_URI'] = $this->user_trailingslashit( '/wp-login-php/' );

			}

			require_once( ABSPATH . WPINC . '/template-loader.php' );

			die;

		}

		private function new_login_slug() {

			if ( $slug = get_option( 'alt_login_page' ) ) {
				return $slug;
			} else if ( ( is_multisite() && is_plugin_active_for_network( $this->basename() ) && ( $slug = get_site_option( 'alt_login_page', 'login' ) ) ) ) {
    			return $slug;
			} else if ( $slug = 'login' ) {
    			return $slug;
			}

		}

		public function new_login_url( $scheme = null ) {

			if ( get_option( 'permalink_structure' ) ) {

				return $this->user_trailingslashit( home_url( '/', $scheme ) . $this->new_login_slug() );

			} else {

				return home_url( '/', $scheme ) . '?' . $this->new_login_slug();

			}

		}

		public function __construct() {

            add_action( 'admin_init', array( $this, 'admin_init' ) );
            add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ), 2 );
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
			add_action( 'network_admin_notices', array( $this, 'admin_notices' ) );
			add_action( 'wp_loaded', array( $this, 'wp_loaded' ) );

            add_filter( 'plugin_action_links_' . $this->basename(), array( $this, 'plugin_action_links' ) );
			add_filter( 'site_url', array( $this, 'site_url' ), 10, 4 );
			add_filter( 'network_site_url', array( $this, 'network_site_url' ), 10, 3 );
			add_filter( 'wp_redirect', array( $this, 'wp_redirect' ), 10, 2 );
			add_filter( 'site_option_welcome_email', array( $this, 'welcome_email' ) );

			remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );

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

		public function admin_notices_incompatible() {

			echo '<div class="error notice is-dismissible"><p>' . __( 'Please upgrade to the latest version of WordPress to activate', 'customize-wp-login') . ' <strong>' . __( 'Customize WP-Login', 'customize-wp-login') . '</strong>.</p></div>';

		}



		public function activate() {
                
			add_option( 'alt_adv_redirect', '1' );

			delete_option( 'alt_adv_admin' );

		}

		public function wpmu_options() {

			$out = '';

			$out .= '<h3>' . __( 'Customize WP-Login Rewrite Rules', 'customize-wp-login') . '</h3>';
			$out .= '<table class="form-table">';
				$out .= '<tr valign="top">';
					$out .= '<th scope="row"><label for="alt_login_page">' . __( 'Networkwide default', 'customize-wp-login' ) . '</label></th>';
					$out .= '<td><input id="alt_login_page" type="text" name="alt_login_page" value="' . esc_attr( get_site_option( 'alt_login_page', 'login' ) )  . '"></td>';
				$out .= '</tr>';
			$out .= '</table>';

			echo $out;

		}

		public function update_wpmu_options() {
			    if ( ( $alt_login_page = sanitize_title_with_dashes( $_POST['alt_login_page'] ) )
			    	&& strpos( $alt_login_page, 'wp-login' ) === false
			    	&& ! in_array( $alt_login_page, $this->forbidden_slugs() ) ) {
                
			    	update_site_option( 'alt_login_page', $alt_login_page );
                
			    }
            
		}

		public function admin_init() {

			global $pagenow;

			add_settings_section(
				'customize-wp-login-section',
				'Customize WP-Login Rewrite Rules',
				null,
				'customize-wp-login-options-advanced'
			);

			add_settings_field(
				'alt_login_page',
				'<label for="alt_login_page">' . __( 'Login url', 'customize-wp-login' ) . '</label>',
				array( $this, 'alt_login_page_input' ),
				'customize-wp-login-options-advanced',
				'customize-wp-login-section'
			);
			
			register_setting( 'customize-wp-login-options-advanced', 'alt_login_page', 'sanitize_title_with_dashes' );

			if ( get_option( 'alt_adv_redirect' ) ) {

				delete_option( 'alt_adv_redirect' );

				if ( is_multisite()
					&& is_super_admin()
					&& is_plugin_active_for_network( $this->basename() ) ) {

					$redirect = network_admin_url( 'page=customize-wp-login' );

				} else {

					$redirect = admin_url( 'page=customize-wp-login' );

				}

				wp_safe_redirect( $redirect );

				die;

			}

		}



		public function alt_login_page_input() {

			if ( get_option( 'permalink_structure' ) ) {

				echo '<code>' . trailingslashit( home_url() ) . '</code> <input id="alt_login_page" type="text" name="alt_login_page" value="' . $this->new_login_slug()  . '">' . ( $this->use_trailing_slashes() ? ' <code>/</code>' : '' );

			} else {

				echo '<code>' . trailingslashit( home_url() ) . '?</code> <input id="alt_login_page" type="text" name="alt_login_page" value="' . $this->new_login_slug()  . '">';

			}

		}

		public function admin_notices() {

			global $pagenow;

			$out = '';

			if ( ! is_network_admin()
				&& $pagenow === 'options-general.php'
				&& isset( $_GET['settings-updated'] ) ) {

				echo '<div class="updated notice is-dismissible"><p>' . sprintf( __( 'Your login page is now here: <strong><a href="%1$s">%2$s</a></strong>. Bookmark this page!', 'customize-wp-login' ), $this->new_login_url(), $this->new_login_url() ) . '</p></div>';

			}

		}


		public function plugins_loaded() {

			global $pagenow;

			if ( ! is_multisite()
				&& ( strpos( $_SERVER['REQUEST_URI'], 'wp-signup' )  !== false
					|| strpos( $_SERVER['REQUEST_URI'], 'wp-activate' ) )  !== false ) {

				wp_die( __( 'This feature is not enabled.', 'customize-wp-login' ) );

			}

			$request = parse_url( $_SERVER['REQUEST_URI'] );

			if ( ( strpos( $_SERVER['REQUEST_URI'], 'wp-login.php' ) !== false
					|| untrailingslashit( $request['path'] ) === site_url( 'wp-login', 'relative' ) )
				&& ! is_admin() ) {

				$this->wp_login_php = true;

				$_SERVER['REQUEST_URI'] = $this->user_trailingslashit( '/' . str_repeat( '-/', 10 ) );

				$pagenow = 'index.php';

			} elseif ( untrailingslashit( $request['path'] ) === home_url( $this->new_login_slug(), 'relative' )
				|| ( ! get_option( 'permalink_structure' )
					&& isset( $_GET[$this->new_login_slug()] )
					&& empty( $_GET[$this->new_login_slug()] ) ) ) {

				$pagenow = 'wp-login.php';

			}

		}

		public function wp_loaded() {

			global $pagenow;

			if ( is_admin()
				&& ! is_user_logged_in()
				&& ! defined( 'DOING_AJAX' ) ) {

				status_header(404);
                nocache_headers();
                include( get_404_template() );
                exit;
			}

			$request = parse_url( $_SERVER['REQUEST_URI'] );

			if ( $pagenow === 'wp-login.php'
				&& $request['path'] !== $this->user_trailingslashit( $request['path'] )
				&& get_option( 'permalink_structure' ) ) {

				wp_safe_redirect( $this->user_trailingslashit( $this->new_login_url() )
					. ( ! empty( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : '' ) );

				die;

			} elseif ( $this->wp_login_php ) {

				if ( ( $referer = wp_get_referer() )
					&& strpos( $referer, 'wp-activate.php' ) !== false
					&& ( $referer = parse_url( $referer ) )
					&& ! empty( $referer['query'] ) ) {

					parse_str( $referer['query'], $referer );

					if ( ! empty( $referer['key'] )
						&& ( $result = wpmu_activate_signup( $referer['key'] ) )
						&& is_wp_error( $result )
						&& ( $result->get_error_code() === 'already_active'
							|| $result->get_error_code() === 'blog_taken' ) ) {

						wp_safe_redirect( $this->new_login_url()
							. ( ! empty( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : '' ) );

						die;

					}

				}

				$this->wp_template_loader();

			} elseif ( $pagenow === 'wp-login.php' ) {

				global $error, $interim_login, $action, $user_login;

				@require_once ABSPATH . 'wp-login.php';

				die;

			}

		}

		public function site_url( $url, $path, $scheme, $blog_id ) {

			return $this->filter_wp_login_php( $url, $scheme );

		}

		public function network_site_url( $url, $path, $scheme ) {

			return $this->filter_wp_login_php( $url, $scheme );

		}

		public function wp_redirect( $location, $status ) {

			return $this->filter_wp_login_php( $location );

		}

		public function filter_wp_login_php( $url, $scheme = null ) {

			if ( strpos( $url, 'wp-login.php' ) !== false ) {

				if ( is_ssl() ) {

					$scheme = 'https';

				}

				$args = explode( '?', $url );

				if ( isset( $args[1] ) ) {

					parse_str( $args[1], $args );

					$url = add_query_arg( $args, $this->new_login_url( $scheme ) );

				} else {

					$url = $this->new_login_url( $scheme );

				}

			}

			return $url;

		}

		public function welcome_email( $value ) {

			return $value = str_replace( 'wp-login.php', trailingslashit( get_site_option( 'alt_login_page', 'login' ) ), $value );

		}

		public function forbidden_slugs() {

			$wp = new WP;

			return array_merge( $wp->public_query_vars, $wp->private_query_vars );

		}

        public function alt_adv_load_textdomain() {
            load_plugin_textdomain( 'customize-wp-login', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

	}
}