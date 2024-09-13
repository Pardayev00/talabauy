<?php

namespace WPAdminify\Inc\Classes;

use WPAdminify\Inc\Utils;
use WPAdminify\Inc\Admin\AdminSettings;
use WPAdminify\Inc\Classes\DarkModeConflicts;
use WPAdminify\Inc\Admin\AdminSettingsModel;
// no direct access allowed
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class AdminBar extends AdminSettingsModel {
    public $options;

    public $post_types;

    public $adminify_ui;

    public function __construct() {
        $this->options = (array) AdminSettings::get_instance()->get( 'admin_bar_settings' );
        $this->adminify_ui = AdminSettings::get_instance()->get( 'admin_ui' );
        $admin_bar_mode = AdminSettings::get_instance()->get( 'admin_bar_mode' );
        if ( $admin_bar_mode != 'light' ) {
            new DarkModeConflicts();
        }
        // $admin_bar_user_roles = !empty($this->options['admin_bar_user_roles']) ? $this->options['admin_bar_user_roles'] : '';
        // if (Utils::restricted_for($admin_bar_user_roles)) {
        // return;
        // }
        // Disable the default admin bar
        // add_filter('show_admin_bar', '__return_false');
        // Add admin-bar support if not already activated
        // add_theme_support('admin-bar', ['callback' => '__return_false']);
        // Check Adminify Setup Wizard Page
        if ( !empty( $_GET['page'] ) && 'wp-adminify-setup-wizard' == $_GET['page'] ) {
            return;
        }
        add_action( 'plugins_loaded', [$this, 'initialize'] );
        add_action( 'wp_admin_bar_class', [$this, 'load_wp_admin_bar_class'] );
        if ( !empty( $this->options['admin_bar_search'] ) ) {
            add_action( 'adminify/before/secondary_menu', [$this, 'before_secondary_menu'] );
        }
        if ( is_admin() ) {
            // Switcher for Default UI
            if ( empty( $this->adminify_ui ) ) {
                add_action( 'admin_bar_menu', [$this, 'jltwp_adminify_dark_mode_switcher_icon'] );
            }
        }
    }

    // Add Switcher Icon on Admin Bar Secondary
    public function jltwp_adminify_dark_mode_switcher_icon( $wp_admin_bar ) {
        if ( empty( $this->options['admin_bar_dark_light_btn'] ) ) {
            return;
        }
        $color_mode = ( !empty( $this->options['admin_bar_mode'] ) ? $this->options['admin_bar_mode'] : 'light' );
        $adminbar_switcher_icon = '<div id="wp-adminify-color-mode-wrapper">
			<div class="mode-icon adminify-color-mode-' . esc_attr( $color_mode ) . '-active">
                <svg viewBox="0 0 24 24" width="24" height="24" class="darkIcon" ><path fill="currentColor" d="M9.37,5.51C9.19,6.15,9.1,6.82,9.1,7.5c0,4.08,3.32,7.4,7.4,7.4c0.68,0,1.35-0.09,1.99-0.27C17.45,17.19,14.93,19,12,19 c-3.86,0-7-3.14-7-7C5,9.07,6.81,6.55,9.37,5.51z M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36 c-0.98,1.37-2.58,2.26-4.4,2.26c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"></path></svg>
                <svg viewBox="0 0 24 24" width="24" height="24" class="lightIcon"><path fill="currentColor" d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5 S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1 s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0 c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95 c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41 L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41 s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06 c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z"></path></svg>
				<svg width="16" height="16" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="systemIcon">
					<path d="M20 13V4.2C20 3.0799 20 2.51984 19.782 2.09202C19.5903 1.71569 19.2843 1.40973 18.908 1.21799C18.4802 1 17.9201 1 16.8 1H5.2C4.07989 1 3.51984 1 3.09202 1.21799C2.71569 1.40973 2.40973 1.71569 2.21799 2.09202C2 2.51984 2 3.0799 2 4.2V13M3.66667 17H18.3333C18.9533 17 19.2633 17 19.5176 16.9319C20.2078 16.7469 20.7469 16.2078 20.9319 15.5176C21 15.2633 21 14.9533 21 14.3333C21 14.0233 21 13.8683 20.9659 13.7412C20.8735 13.3961 20.6039 13.1265 20.2588 13.0341C20.1317 13 19.9767 13 19.6667 13H2.33333C2.02334 13 1.86835 13 1.74118 13.0341C1.39609 13.1265 1.12654 13.3961 1.03407 13.7412C1 13.8683 1 14.0233 1 14.3333C1 14.9533 1 15.2633 1.06815 15.5176C1.25308 16.2078 1.79218 16.7469 2.48236 16.9319C2.73669 17 3.04669 17 3.66667 17Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
            </div>
            <div class="light-dark-dropdown">
                <div class="light">
                    <svg viewBox="0 0 24 24" width="24" height="24" class="lightIcon"><path fill="currentColor" d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5 S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1 s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0 c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95 c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41 L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41 s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06 c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z"></path></svg>
                    <span>Light</span>
                </div>
                <div class="dark">
                    <svg viewBox="0 0 24 24" width="24" height="24" class="darkIcon"><path fill="currentColor" d="M9.37,5.51C9.19,6.15,9.1,6.82,9.1,7.5c0,4.08,3.32,7.4,7.4,7.4c0.68,0,1.35-0.09,1.99-0.27C17.45,17.19,14.93,19,12,19 c-3.86,0-7-3.14-7-7C5,9.07,6.81,6.55,9.37,5.51z M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36 c-0.98,1.37-2.58,2.26-4.4,2.26c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"></path></svg>
                    <span>Dark</span>
                </div>
                <div class="system">
					<svg width="16" height="16" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="systemIcon">
						<path d="M20 13V4.2C20 3.0799 20 2.51984 19.782 2.09202C19.5903 1.71569 19.2843 1.40973 18.908 1.21799C18.4802 1 17.9201 1 16.8 1H5.2C4.07989 1 3.51984 1 3.09202 1.21799C2.71569 1.40973 2.40973 1.71569 2.21799 2.09202C2 2.51984 2 3.0799 2 4.2V13M3.66667 17H18.3333C18.9533 17 19.2633 17 19.5176 16.9319C20.2078 16.7469 20.7469 16.2078 20.9319 15.5176C21 15.2633 21 14.9533 21 14.3333C21 14.0233 21 13.8683 20.9659 13.7412C20.8735 13.3961 20.6039 13.1265 20.2588 13.0341C20.1317 13 19.9767 13 19.6667 13H2.33333C2.02334 13 1.86835 13 1.74118 13.0341C1.39609 13.1265 1.12654 13.3961 1.03407 13.7412C1 13.8683 1 14.0233 1 14.3333C1 14.9533 1 15.2633 1.06815 15.5176C1.25308 16.2078 1.79218 16.7469 2.48236 16.9319C2.73669 17 3.04669 17 3.66667 17Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<span>System</span>
                </div>
            </div>
		</div>';
        // $user_id = get_current_user_id();
        // if ( ! $user_id ) {
        // 	return;
        // }
        // $adminbar_switcher_icon_toggle = get_user_meta( $user_id, 'adminbar_switcher_icon_toggle', true );
        // $admin_bar_mode = !empty($this->options['admin_bar_mode']) ? $this->options['admin_bar_mode'] : '';
        // if ( $adminbar_switcher_icon_toggle == 'off' ) {
        // 	return;
        // }
        $args = [
            'parent' => 'top-secondary',
            'id'     => 'wp-adminify-admin-bar-switcher',
            'title'  => $adminbar_switcher_icon,
            'meta'   => false,
        ];
        $wp_admin_bar->add_node( $args );
    }

    public function initialize() {
        $admin_bar_position = ( !empty( $this->options['admin_bar_position'] ) ? $this->options['admin_bar_position'] : 'top' );
        if ( is_admin() ) {
            if ( $admin_bar_position == 'top' || $admin_bar_position == 'bottom' ) {
                if ( !empty( $this->adminify_ui ) ) {
                    add_action( 'admin_init', [$this, 'jltwp_adminify_add_admin_bar'] );
                } else {
                    add_action( 'admin_head', [$this, 'jltwp_adminify_legacy_admin_bar_positon'] );
                }
            }
            add_action( 'admin_enqueue_scripts', [$this, 'jltwp_adminify_admin_scripts'], 100 );
            // Remove Unnecessary Menus from Admin bar
            // add_action('wp_before_admin_bar_render', [$this, 'jltma_adminify_remove_admin_bar_menus'], 0);
            add_filter( 'admin_body_class', [$this, 'admin_bar_body_class'] );
            add_action( 'admin_head', [$this, 'jltwp_adminify_admin_bar_css'], 999 );
            add_action( 'wp_ajax_adminify_all_search', [$this, 'adminify_all_search'] );
            add_action( 'wp_ajax_wp_adminify_color_mode', [$this, 'wp_adminify_color_mode'] );
            // Screen Option and Help Tab
            add_action(
                'admin_head',
                [$this, 'jltwp_adminify_remove_screen_options'],
                10,
                3
            );
            add_action( 'admin_head', [$this, 'jltwp_adminify_remove_help_tab'] );
        } else {
            // Admin bar Frontend settings
            $frontend_admin = ( !empty( $this->options['admin_bar_hide_frontend'] ) ? $this->options['admin_bar_hide_frontend'] : 'show' );
            $this->jltwp_adminify_front_bar();
            if ( $admin_bar_position == 'bottom' ) {
                add_action( 'init', [$this, 'admin_bar_front_style_init'] );
            }
            if ( $frontend_admin == 'hide' ) {
                add_filter( 'show_admin_bar', '__return_false' );
            }
        }
    }

    public function before_secondary_menu() {
        ?>
		<div class="wp-adminify-top-header--search--form">
			<form class="top-header--search--form" action="$">
				<span class="adminify-search-expand"><i class="icon-magnifier icons"></i></span>
				<input id="top-header-search-input" class="top-header-search-input" type="search" placeholder="Search here">
			</form>

			<div id="top-header-search-results" class=" top-header-search-results" style="display: none;">
				<div class="top-header-results-wrapper">
				</div>
			</div>
		</div>
	<?php 
    }

    public function load_wp_admin_bar_class() {
        return 'WPAdminify\\Inc\\Classes\\Adminify_Admin_Bar';
    }

    public function jltwp_adminify_front_bar() {
        add_action( 'admin_init', [$this, 'jltwp_adminify_add_admin_bar'] );
        add_filter( 'body_class', [$this, 'admin_bar_body_class'] );
    }

    public function admin_bar_front_style_init() {
        add_filter( 'wp_enqueue_scripts', [$this, 'admin_bar_front_style'] );
    }

    // Frontend Admin bar style
    public function admin_bar_front_style() {
        $admin_bar_css = '';
        $admin_bar_css .= '.admin-bar-position-bottom #wpadminbar{
            top:auto;
            bottom: 0;
        }
        .admin-bar-position-bottom  #wpadminbar .menupop .ab-sub-wrapper{
            bottom: 32px;
        }
        @media all and (max-width:600px){
            body.logged-in.admin-bar-position-bottom {
                position: relative;
            }
        }';
        wp_add_inline_style( 'admin-bar', $admin_bar_css );
    }

    // Remove Screen Options
    public function jltwp_adminify_remove_screen_options() {
        $enable_screen_tab = Utils::get_user_preference( 'screen_options_tab' );
        if ( $enable_screen_tab ) {
            add_filter( 'screen_options_show_screen', '__return_false' );
        }
    }

    // Contextual Help Tab Remove
    public function jltwp_adminify_remove_help_tab() {
        $enable_screen_tab = Utils::get_user_preference( 'adminify_help_tab' );
        if ( $enable_screen_tab ) {
            $screen = get_current_screen();
            $screen->remove_help_tabs();
        }
    }

    // Get All registered WP Admin Menus
    public static function get_wp_admin_menus( $thismenu, $thissubmenu ) {
        $options = [];
        if ( !empty( $thismenu ) && is_array( $thismenu ) ) {
            foreach ( $thismenu as $item ) {
                if ( !empty( $item[0] ) ) {
                    // the preg_replace removes "Comments" & "Plugins" menu spans.
                    $options[$item[2]] = preg_replace( '/\\<span.*?>.*?\\<\\/span><\\/span>/s', '', $item[0] );
                }
            }
        }
        if ( !empty( $thissubmenu ) && is_array( $thissubmenu ) ) {
            foreach ( $thissubmenu as $items ) {
                foreach ( $items as $item ) {
                    if ( !empty( $item[0] ) ) {
                        $options[$item[1]] = preg_replace( '/\\<span.*?>.*?\\<\\/span><\\/span>/s', '', $item[0] );
                    }
                }
            }
        }
        return $options;
    }

    public function jltwp_adminify_admin_scripts() {
        global $pagenow;
        // 21-2-24
        // if (!is_user_logged_in() && $pagenow != 'wp-login.php') {
        if ( $pagenow == 'wp-login.php' || $pagenow == 'wp-register.php' || $pagenow == 'customize.php' ) {
            return;
        }
        // if (is_admin_bar_showing()) { }
        if ( !empty( $this->adminify_ui ) ) {
            wp_enqueue_style( 'wp-adminify-admin-bar' );
            $this->admin_topbar_loader_css();
        }
        wp_localize_script( 'wp-adminify-admin', 'WPAdminify', $this->adminify_create_admin_bar_js_object() );
        // wp_enqueue_style('wp-adminify-admin-bar', WP_ADMINIFY_ASSETS . 'css/admin-bar.css', false, WP_ADMINIFY_VER);
        // wp_enqueue_script('wp-adminify-admin', WP_ADMINIFY_ASSETS . 'js/wp-adminify.js',  ['jquery'], WP_ADMINIFY_VER, true);
        // wp_localize_script('wp-adminify-admin', 'WPAdminify', $this->adminify_create_admin_bar_js_object());
    }

    public function adminify_create_admin_bar_js_object() {
        return [
            'ajax_url'       => admin_url( 'admin-ajax.php' ),
            'security_nonce' => wp_create_nonce( 'adminify-admin-bar-security-nonce' ),
            'notice_nonce'   => wp_create_nonce( 'adminify-notice-nonce' ),
        ];
    }

    /**
     * Preloader
     *
     * @return void
     */
    public function admin_topbar_loader_css() {
        $output_css = '';
        $topbar_wireframe_img = WP_ADMINIFY_ASSETS_IMAGE . 'topbar-wireframe.svg';
        $output_css .= '.js .wp-adminify-topbar-loader{background: url(' . esc_url( $topbar_wireframe_img ) . '); }';
        echo '<style>' . wp_strip_all_tags( $output_css ) . '</style>';
        ?>

		<script>
			window.addEventListener('load', function() {
				const isFullscreenMode = wp.data.select('core/edit-post').isFeatureActive('fullscreenMode');

				if (isFullscreenMode) {
					// wp.data.dispatch('core/edit-post').toggleFeature('fullscreenMode');
					console.log('yes its it');
					jQuery('.adminify-top_bar').css({
						'display': 'none !important'
					});
				}
			});
		</script>

		<?php 
    }

    /**
     * Save Color Mode by Ajax
     *
     * @return void
     */
    public function wp_adminify_color_mode() {
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX && check_ajax_referer( 'adminify-admin-bar-security-nonce', 'security' ) > 0 ) {
            $admin_bar_mode = AdminSettings::get_instance()->get();
            if ( !empty( $_POST['key'] ) ) {
                $key = sanitize_key( $_POST['key'] );
                $value = Utils::clean_ajax_input( wp_unslash( $_POST['value'] ) );
                if ( $key == '' ) {
                    $message = __( 'No Color Mode supplied to save', 'adminify' );
                    echo Utils::ajax_error_message( $message );
                    die;
                }
            }
            // Light/Dark Mode
            if ( $key === 'color_mode' ) {
                $admin_bar_mode['admin_bar_mode'] = $value;
                $admin_bar_mode['enable_schedule_dark_mode'] = false;
                if ( $value == 'system' ) {
                    $admin_bar_mode['enable_schedule_dark_mode'] = true;
                    $admin_bar_mode['schedule_dark_mode_type'] = 'system';
                }
                update_option( '_wpadminify', $admin_bar_mode );
                die;
            }
            // Screen Options, Help Tabs and WP Hide Links
            if ( $key === 'screen_options_tab' || $key === 'hide_wp_links' || $key === 'adminify_help_tab' ) {
                $userid = get_current_user_id();
                $current = get_user_meta( $userid, '_wpadminify_preferences', true );
                if ( is_array( $current ) ) {
                    $current[$key] = $value;
                } else {
                    $current = [];
                    $current[$key] = $value;
                }
                $state = update_user_meta( $userid, '_wpadminify_preferences', $current );
                if ( $state ) {
                    $returndata = [];
                    $returndata['success'] = true;
                    $returndata['message'] = __( 'Preferences saved', 'adminify' );
                    echo json_encode( $returndata );
                } else {
                    $message = __( 'Unable to save user preferences', 'adminify' );
                    echo Utils::ajax_error_message( $message );
                    die;
                }
            }
        }
    }

    /**
     * Search Everything
     *
     * @return void
     */
    public function adminify_all_search() {
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX && check_ajax_referer( 'adminify-admin-bar-security-nonce', 'security' ) > 0 ) {
            if ( !empty( $_POST['search'] ) ) {
                $term = sanitize_text_field( wp_unslash( $_POST['search'] ) );
            }
            // Search Arguments
            $args = [
                'numberposts' => -1,
                's'           => $term,
                'post_status' => [
                    'publish',
                    'pending',
                    'draft',
                    'future',
                    'private',
                    'inherit'
                ],
            ];
            // All Post Types
            $post_types = $this->get_post_types();
            foreach ( $post_types as $type ) {
                $args['post_type'][] = $type->name;
            }
            // All Categories/Taxonomies
            $all_taxonomies = get_taxonomies();
            // Get Comments
            $all_comments = get_comments();
            // Get All Users
            $all_users = get_users();
            // All Users
            // $blogusers = get_users();
            // foreach ($blogusers as $type) {
            // $name = $type->user_login;
            // $id = $type->ID;
            // $args['author__in'][] = $type->ID;
            // }
            // // All Menus
            // $all_admin_menus = self::get_wp_admin_menus();
            // All Plugins
            if ( !function_exists( 'get_plugins' ) ) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            $all_plugins = get_plugins();
            $foundposts = get_posts( $args );
            // $count_items = '';
            // if (count($foundposts) > 0) {
            // $count_items .= count($foundposts);
            // } elseif (count($all_plugins)) {
            // $count_items .= count($all_plugins);
            // }
            ob_start();
            ?>

			<p><span class="count"></span><?php 
            echo count( $foundposts ) . wp_kses_post( ' item<span>s</span> found' );
            ?></p>

			<table class="top-header-result-table" style="height:500px;">
				<thead>
					<tr class="has-text-left">
						<th><?php 
            esc_html_e( 'Title', 'adminify' );
            ?></th>
						<th><?php 
            esc_html_e( 'Type', 'adminify' );
            ?></th>
						<th><?php 
            esc_html_e( 'User', 'adminify' );
            ?></th>
						<th><?php 
            esc_html_e( 'Date', 'adminify' );
            ?></th>
					</tr>
				</thead>
				<tbody>

					<?php 
            foreach ( $foundposts as $item ) {
                $author_id = $item->post_author;
                $editurl = get_edit_post_link( $item );
                $public = get_permalink( $item );
                ?>
						<tr>
							<td><span class="table-title"><a href="<?php 
                echo esc_url( $editurl );
                ?>"><?php 
                echo wp_kses_post( get_the_title( $item ) );
                ?></a></span></td>
							<td><span class="type"><?php 
                echo wp_kses_post( get_post_type( $item ) );
                ?></span></td>
							<td><span class="user"><?php 
                echo wp_kses_post( the_author_meta( 'user_login', $author_id ) );
                ?></span></td>
							<td><span class="date"><?php 
                echo wp_kses_post( get_the_date( get_option( 'date_format' ), $item ) );
                ?></span></td>
						</tr>
					<?php 
            }
            ?>

					<?php 
            foreach ( $all_taxonomies as $tax_name ) {
                $terms = get_terms( [
                    'taxonomy'   => $tax_name,
                    'hide_empty' => 1,
                ] );
                foreach ( $terms as $cat ) {
                    if ( strpos( strtolower( $cat->name ), strtolower( $term ) ) === false ) {
                        continue;
                    }
                    // $user = get_userdata($cat->term_id);
                    ?>
							<tr>
								<td>
									<span class="table-title">
										<a href="<?php 
                    echo esc_url( get_term_link( $cat->slug, $cat->taxonomy ) );
                    ?>">
											<?php 
                    echo esc_html( $cat->name );
                    ?>
										</a>
									</span>
								</td>
								<td>
									<span class="type"><?php 
                    echo esc_html( $cat->taxonomy );
                    ?></span>
								</td>
								<td>
									<span class="user">
										<?php 
                    esc_html_e( 'N/A', 'adminify' );
                    ?>
									</span>
								</td>
								<td>
									<span class="date">
										<?php 
                    esc_html_e( 'N/A', 'adminify' );
                    ?>
									</span>
								</td>
								<td>
								</td>
							</tr>
					<?php 
                }
            }
            ?>


					<!-- Get Comments  -->
					<?php 
            foreach ( $all_comments as $comment ) {
                if ( strpos( strtolower( $comment->comment_content ), strtolower( $term ) ) === false ) {
                    continue;
                }
                ?>
						<tr>
							<td>
								<span class="table-title">
									<a href="<?php 
                echo esc_url_raw( admin_url( 'comment.php?action=editcomment&c=' . esc_attr( $comment->comment_ID ) ) );
                ?>">
										<?php 
                echo wp_kses_post( $comment->comment_content );
                ?>
									</a>
								</span>
							</td>
							<td>
								<span class="type">
									<?php 
                echo wp_kses_post( ucwords( $comment->comment_type ) );
                ?>
								</span>
							</td>
							<td>
								<span class="user">
									<?php 
                echo wp_kses_post( the_author_meta( 'display_name', $comment->user_id ) );
                ?>
								</span>
							</td>
							<td>
								<span class="date">
									<?php 
                echo esc_html( get_the_date( get_option( 'date_format' ), $comment->comment_date ) );
                ?>
								</span>
							</td>
						</tr>
					<?php 
            }
            ?>



					<!-- Get Users  -->
					<?php 
            foreach ( $all_users as $user ) {
                if ( strpos( strtolower( $user->user_login ), strtolower( $term ) ) === false ) {
                    continue;
                }
                ?>
						<tr>
							<td>
								<span class="table-title">
									<a href="<?php 
                echo esc_url( admin_url( 'user-edit.php?user_id=' . $user->ID ) );
                ?>">
										<?php 
                echo esc_html( $user->display_name );
                ?>
									</a>
								</span>
							</td>
							<td>
								<span class="type">
									<?php 
                esc_html_e( 'User', 'adminify' );
                ?>
								</span>
							</td>
							<td>
								<span class="user">
									<?php 
                echo wp_kses_post( the_author_meta( 'display_name', $user->ID ) );
                ?>
								</span>
							</td>
							<td>
								<span class="date">
									<?php 
                echo wp_kses_post( get_the_date( get_option( 'date_format' ), $user->user_registered ) );
                ?>
								</span>
							</td>
						</tr>
					<?php 
            }
            ?>



					<!-- Get Plugins  -->
					<?php 
            foreach ( $all_plugins as $plugin ) {
                if ( strpos( strtolower( $plugin['Name'] ), strtolower( $term ) ) === false ) {
                    continue;
                }
                ?>
						<tr>
							<td>
								<span class="table-title">
									<a href="<?php 
                echo esc_url( admin_url( 'plugins.php' ) );
                ?>">
										<?php 
                echo esc_html( $plugin['Name'] );
                ?>
									</a>
								</span>
							</td>
							<td>
								<span class="type">
									<?php 
                esc_html_e( 'Plugin', 'adminify' );
                ?>
								</span>
							</td>
							<td>
								<span class="user">
									<?php 
                echo esc_html( $plugin['AuthorName'] );
                ?>
								</span>
							</td>
							<td>
								<span class="date">
									<?php 
                esc_html_e( 'N/A', 'adminify' );
                ?>
								</span>
							</td>
						</tr>
					<?php 
            }
            ?>


				</tbody>
			</table>


		<?php 
            $output_data = ob_get_clean();
            echo json_encode( $output_data );
        }
        die;
    }

    public function jltwp_adminify_admin_bar_css() {
        $current_screen = get_current_screen();
        $admin_bar_mode = AdminSettings::get_instance()->get();
        $admin_bar_mode = ( !empty( $admin_bar_mode['admin_bar_mode'] ) ? $admin_bar_mode['admin_bar_mode'] : '' );
        $output_css = '';
        $output_css .= '<style type="text/css">';
        if ( !empty( $current_screen->is_block_editor ) ) {
            $output_css .= '.wp-adminify.adminify-ui.block-editor-page:not(.wp-adminify.is-fullscreen-mode) .interface-interface-skeleton { top: 90px !important; left: 244px !important; border-top: 0 !important; border-left: 0 !important; }';
            $output_css .= '.wp-adminify.block-editor-page.is-fullscreen-mode.block-editor-page .interface-interface-skeleton { top: 0 !important; left: 0 !important; border-top: 0 !important; border-left: 0 !important; }';
        }
        $admin_bar_container = ( !empty( $this->options['admin_bar_container'] ) ? $this->options['admin_bar_container'] : 'full_container' );
        if ( $admin_bar_mode === 'light' ) {
            $light_bg_type = ( !empty( $this->options['admin_bar_light_bg'] ) ? $this->options['admin_bar_light_bg'] : 'color' );
            $light_bg_color = ( !empty( $this->options['admin_bar_light_bg_color'] ) ? $this->options['admin_bar_light_bg_color'] : '' );
            // Full Container Colors
            if ( $admin_bar_container == 'full_container' ) {
                if ( $light_bg_type === 'color' ) {
                    $output_css .= '.wp-adminify.adminify-light-mode .adminify-top_bar nav.navbar, .wp-adminify .wp-adminify-horizontal-menu { background-color:' . esc_attr( $light_bg_color ) . ' ; }';
                }
            } elseif ( $admin_bar_container == 'admin_bar_only' ) {
                // Admin Bar Colors
                if ( $light_bg_type === 'color' ) {
                    if ( !empty( $this->options['admin_bar_light_bg_color'] ) ) {
                        $output_css .= '.wp-adminify.adminify-light-mode .adminify-top_bar nav.navbar { background-color:' . esc_attr( $light_bg_color ) . ' }';
                    }
                }
            }
            if ( !empty( $admin_bar_colors['icon_color'] ) ) {
                $output_css .= '.adminify-top_bar nav.navbar .navbar-menu .topbar-icon { fill: ' . esc_attr( $admin_bar_colors['icon_color'] ) . ' }';
            }
        } elseif ( $admin_bar_mode === 'dark' ) {
            $dark_bg_type = ( isset( $this->options['admin_bar_dark_bg'] ) ? $this->options['admin_bar_dark_bg'] : 'color' );
            if ( $admin_bar_container == 'full_container' ) {
                if ( $dark_bg_type === 'color' ) {
                    $dark_bg_color = $this->options['admin_bar_dark_bg_color'];
                    $output_css .= '.wp-adminify.adminify-dark-mode .adminify-top_bar nav.navbar, .wp-adminify .wp-adminify-horizontal-menu{ background-color:' . esc_attr( $dark_bg_color ) . ' }';
                } elseif ( $dark_bg_type === 'gradient' ) {
                    $dark_gradient_bg_color = $this->options['admin_bar_dark_bg_gradient']['background-color'];
                    $dark_gradient_color = $this->options['admin_bar_dark_bg_gradient']['background-gradient-color'];
                    $dark_gradient_color_dir = $this->options['admin_bar_dark_bg_gradient']['background-gradient-direction'];
                    $output_css .= '.wp-adminify.adminify-dark-mode .adminify-top_bar nav.navbar, .wp-adminify .wp-adminify-horizontal-menu{ background-image : linear-gradient(' . esc_attr( $dark_gradient_color_dir ) . ', ' . esc_attr( $dark_gradient_bg_color ) . ' , ' . esc_attr( $dark_gradient_color ) . '); }';
                }
            } elseif ( $admin_bar_container == 'admin_bar_only' ) {
                if ( $dark_bg_type === 'color' ) {
                    $dark_bg_color = $this->options['admin_bar_dark_bg_color'];
                    $output_css .= '.wp-adminify.adminify-dark-mode .adminify-top_bar nav.navbar{ background-color:' . esc_attr( $dark_bg_color ) . ' }';
                }
            }
        }
        // "New" Button Colors
        $new_btn_colors = ( !empty( $this->options['admin_bar_link_color'] ) ? $this->options['admin_bar_link_color'] : '' );
        if ( !empty( $new_btn_colors['link_color'] ) ) {
            $output_css .= '.wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-content > .ab-item .ab-label, .wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-content .ab-item .ab-icon:before { color:' . esc_attr( $new_btn_colors['link_color'] ) . ' !important; }';
        }
        if ( !empty( $new_btn_colors['hover_color'] ) ) {
            $output_css .= '.wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-content > .ab-item:hover .ab-label, .wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-content .ab-item:hover .ab-icon:before{ color:' . esc_attr( $new_btn_colors['hover_color'] ) . ' !important; }';
        }
        if ( !empty( $new_btn_colors['bg_color'] ) ) {
            $output_css .= '.wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-content > .ab-item, .wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-content:hover > .ab-item { background:' . esc_attr( $new_btn_colors['bg_color'] ) . ' !important;}';
        }
        // "New" Button Hover Colors
        $new_btn_dropwon = ( !empty( $this->options['admin_bar_link_dropdown_color'] ) ? $this->options['admin_bar_link_dropdown_color'] : '' );
        if ( !empty( $new_btn_dropwon['wrapper_bg'] ) ) {
            $output_css .= '.wp-adminify #wpadminbar .ab-top-menu .ab-sub-wrapper, .wp-adminify #wpadminbar .ab-top-menu .ab-sub-wrapper .ab-submenu, .wp-adminify #wpadminbar .ab-top-menu .ab-sub-wrapper .ab-submenu .ab-item { background-color:' . esc_attr( $new_btn_dropwon['wrapper_bg'] ) . ' !important;}';
        }
        if ( !empty( $new_btn_dropwon['bg_color'] ) ) {
            $output_css .= '.wp-adminify #wpadminbar .ab-top-menu .ab-sub-wrapper .ab-submenu .ab-item:hover { background-color:' . esc_attr( $new_btn_dropwon['bg_color'] ) . ' !important;}';
        }
        if ( !empty( $new_btn_dropwon['link_color'] ) ) {
            $output_css .= '.wp-adminify #wpadminbar .ab-top-menu .ab-sub-wrapper .ab-submenu .ab-item { color:' . esc_attr( $new_btn_dropwon['link_color'] ) . ' !important }';
        }
        if ( !empty( $new_btn_dropwon['hover_color'] ) ) {
            $output_css .= '.wp-adminify #wpadminbar .ab-top-menu .ab-sub-wrapper .ab-submenu .ab-item:hover { color:' . esc_attr( $new_btn_dropwon['hover_color'] ) . ' !important }';
        }
        // Text Color
        if ( !empty( $this->options['admin_bar_text_color'] ) ) {
            $output_css .= '.adminify-top_bar nav.navbar .navbar-brand .navbar-item .wp-adminify-site-name, .adminify-top_bar nav.navbar .navbar-menu .wp-adminify-user-site-list button { color:' . esc_attr( $this->options['admin_bar_text_color'] ) . ' }';
            $output_css .= '.wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-post > .ab-item { color:' . esc_attr( $this->options['admin_bar_text_color'] ) . ' ; }';
            $output_css .= '.wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-post > .ab-item .ab-icon:before { color:' . esc_attr( $this->options['admin_bar_text_color'] ) . ' ; }';
            $output_css .= '.wp-adminify #wpadminbar #wp-admin-bar-root-default #wp-admin-bar-new-post > .ab-item .ab-label { color:' . esc_attr( $this->options['admin_bar_text_color'] ) . ' ; }';
        }
        // Icon Color
        if ( !empty( $this->options['admin_bar_icon_color'] ) ) {
            $output_css .= '.adminify-top_bar nav.navbar .navbar-menu .topbar-icon svg path { fill:' . esc_attr( $this->options['admin_bar_icon_color'] ) . ' }';
            $output_css .= '.adminify-top_bar nav.navbar .navbar-end i, .adminify-top_bar nav.navbar .navbar-burger i { color:' . esc_attr( $this->options['admin_bar_icon_color'] ) . ' }';
        }
        $output_css .= '.wp-adminify .editor-document-tools__left button.editor-document-tools__inserter-toggle {
            padding: 0 !important;
            border: 2px solid var(--adminify-btn-bg) !important;
        }';
        $output_css .= ' </style>';
        // echo Utils::wp_kses_custom($output_css);
        echo $output_css;
    }

    // Admin Bar Body Class
    public function admin_bar_body_class( $classes ) {
        if ( is_admin() ) {
            $classes .= ' wp-adminify-admin-bar';
            $admin_bar_position = ( !empty( $this->options['admin_bar_position'] ) ? $this->options['admin_bar_position'] : 'top' );
            if ( $admin_bar_position === 'top' ) {
                $classes .= ' position-top';
            } elseif ( $admin_bar_position === 'bottom' ) {
                $classes .= ' position-bottom';
            }
            if ( !empty( $this->options['enable_admin_bar'] ) ) {
                $classes .= ' topbar-disabled';
            }
        } else {
            global $pagenow;
            if ( !is_user_logged_in() && $pagenow != 'wp-login.php' ) {
                return $classes;
            }
            $classes[] = 'wp-adminify-admin-bar';
            $admin_bar_position = ( !empty( $this->options['admin_bar_position'] ) ? $this->options['admin_bar_position'] : 'top' );
            if ( $admin_bar_position === 'top' ) {
                $classes[] = 'admin-bar-position-top';
            } elseif ( $admin_bar_position === 'bottom' ) {
                $classes[] = 'admin-bar-position-bottom';
            }
            if ( !empty( $this->options['enable_admin_bar'] ) ) {
                $classes[] = 'topbar-disabled';
            }
        }
        return $classes;
    }

    public function get_post_types() {
        if ( is_array( $this->post_types ) ) {
            return $this->post_types;
        } else {
            $args = [
                'public' => true,
            ];
            $output = 'objects';
            $post_types = get_post_types( $args, $output );
            $this->post_types = $post_types;
            return $post_types;
        }
    }

    public function jltwp_adminify_legacy_admin_bar_positon() {
        if ( !empty( $this->options['admin_bar_position'] ) && $this->options['admin_bar_position'] == 'bottom' ) {
            $jltwp_adminify_thirdparty_css = '';
            $jltwp_adminify_thirdparty_css .= 'body.wp-adminify.position-bottom {
					margin-top: -28px;
					padding-bottom: 28px;
				}

				body.wp-adminify.position-bottom.admin-bar #wphead {
					padding-top: 0;
				}

				body.wp-adminify.position-bottom.admin-bar #footer {
					padding-bottom: 28px;
				}

				body.wp-adminify.position-bottom #wpadminbar {
					top: auto !important;
					bottom: 0;
				}

				body.wp-adminify.position-bottom #wpadminbar .quicklinks .ab-top-menu .menupop .ab-sub-wrapper {
					bottom: 32px;
				}

				body.wp-adminify.position-bottom #wpadminbar .quicklinks .ab-top-menu .menupop .ab-sub-wrapper .ab-submenu .menupop .ab-sub-wrapper {
					bottom: -9px;
				}';
            echo '<style>' . wp_strip_all_tags( $jltwp_adminify_thirdparty_css ) . '</style>';
        }
    }

    public function jltwp_adminify_add_admin_bar() {
        // For Testing Admin Bar on Setup Wizard
        // add_action('admin_head', [$this, 'jltwp_adminify_render_admin_bar']);
        add_action( 'in_admin_header', [$this, 'jltwp_adminify_render_admin_bar'], -999999999 );
        // on frontend area
        add_action( 'wp_head', [$this, 'jltwp_adminify_render_admin_bar'] );
    }

    public function jltwp_adminify_render_admin_bar() {
        global $pagenow;
        if ( !is_user_logged_in() && $pagenow != 'wp-login.php' ) {
            return;
        }
        // Check Gutenberg Editor Page
        // if (Utils::is_block_editor_page()) {
        // 	return;
        // }
        // if (!is_admin_bar_showing()) {
        // 	return false;
        // }
        // Remove Adminbar from Gutenberg Block Editor Page
        // if (function_exists('is_gutenberg_page') && is_gutenberg_page()) {
        // 	// The Gutenberg plugin is on.
        // 	return;
        // }
        // if (function_exists('get_current_screen')) {
        // 	$current_screen = get_current_screen();
        // 	if (!empty($current_screen->is_block_editor)) {
        // 		return;
        // 	}
        // }
        global $wp_admin_bar;
        if ( empty( $wp_admin_bar ) ) {
            return false;
        }
        $admin_bar_mode = AdminSettings::get_instance()->get();
        $admin_bar_mode = ( empty( $admin_bar_mode['admin_bar_mode'] ) ? 'light' : $admin_bar_mode['admin_bar_mode'] );
        // Light/Dark Mode
        $enable_dark_mode = $admin_bar_mode != 'light';
        // Screen Option && Hide WP Links
        $enable_screen_tab = Utils::get_user_preference( 'screen_options_tab' );
        $enable_help_tab = Utils::get_user_preference( 'adminify_help_tab' );
        // $enable_hide_wp_links = Utils::get_user_preference( 'hide_wp_links' );
        // Admin Bar Position
        if ( !empty( $this->options['admin_bar_position'] ) && $this->options['admin_bar_position'] === 'top' ) {
            $admin_bar_position = 'top_bar';
        } elseif ( !empty( $this->options['admin_bar_position'] ) && $this->options['admin_bar_position'] === 'bottom' ) {
            $admin_bar_position = 'bottom_bar is-fixed-bottom';
        } else {
            $admin_bar_position = 'top_bar';
        }
        $current_user = wp_get_current_user();
        ob_start();
        // Temporarily removing Topbar
        // <div class="wp-adminify-topbar-loader"></div>
        // 17-7-23, removed opacity for Conflicting Opacity Issue
        // <div class="wp-adminify adminify-top_bar" style="opacity: 0;">
        ?>



		<div class="wp-adminify adminify-top_bar">
			<nav class="navbar adminify-top-navbar <?php 
        echo esc_attr( $admin_bar_position );
        ?>">

				<?php 
        $this->jltwp_adminify_logo();
        ?>
				<div class="adminify-admin-wrapper">
					<div class="adminify-legacy-admin">
						<?php 
        echo wp_admin_bar_render();
        ?>
					</div>

					<div id="wp-adminify-top-adminbar" class="navbar-menu">

						<div class="navbar-end">
							<div class="field is-grouped">

								<?php 
        if ( !empty( $this->options['admin_bar_dark_light_btn'] ) ) {
            ?>
									<div class="wp-admnify--mode--switcher pr-4">
										<label class="admnify-switcher is-pulled-right">
											<input type="checkbox" id="light-dark-switcher-btn" <?php 
            checked( $enable_dark_mode, 1 );
            ?>>
											<span class="slider round"></span>
										</label>
									</div>
								<?php 
        }
        ?>

								<?php 
        if ( !empty( $this->options['admin_bar_comments'] ) ) {
            ?>
									<div class="wp-adminify--top--comment ml-4 mr-4">
										<button class="comment-trigger is-clickable">
											<div class="topbar-icon">
												<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M0.25 13.75V1.75C0.25 0.921573 0.921572 0.25 1.75 0.25H12.25C13.0784 0.25 13.75 0.921573 13.75 1.75V9.25C13.75 10.0784 13.0784 10.75 12.25 10.75H4.75C4.42535 10.7494 4.10936 10.8547 3.85 11.05L0.25 13.75ZM1.75 1.75V10.75L3.3505 9.55C3.60973 9.35448 3.9258 9.24913 4.2505 9.25H12.25V1.75H1.75Z" fill="#4E4B66" />
												</svg>
											</div>
											<span class="comment-counter p-0 tag is-rounded">
												<?php 
            $comments_count = wp_count_comments();
            echo esc_html( $comments_count->moderated );
            ?>
											</span>
										</button>
									</div>

								<?php 
        }
        if ( !empty( $this->options['admin_bar_view_website'] ) ) {
            ?>
									<div class="wp-adminify--preview mr-4">
										<a class="preview-trigger is-clickable" href="<?php 
            echo esc_url( get_home_url() );
            ?>" <?php 
            if ( !empty( $this->options['admin_bar_view_website_window_type'] ) && $this->options['admin_bar_view_website_window_type'] == 'new_tab' ) {
                ?> target="_blank" <?php 
            }
            ?>>
											<i class="dashicons dashicons-visibility"></i>
										</a>
									</div>
								<?php 
        }
        ?>

								<div class="wp-adminify--user--account">
									<button class="user-avatar is-clickable">
										<div class="image is-45x45">
											<?php 
        echo get_avatar(
            $current_user->user_email,
            45,
            '',
            '',
            [
                'class' => 'is-rounded',
            ]
        );
        ?>
										</div>
										<span class="user-status tag p-0 is-rounded"></span>
									</button>
								</div>

							</div>
						</div>
					</div>
				</div>
			</nav>

			<?php 
        if ( !empty( $this->options['admin_bar_user_offcanvas_menu'] ) ) {
            ?>
				<div class="wp-adminify--user--wrapper">
					<div class="user-wqrapper-inner">
						<button class="user-wrapper-close is-clickable">
							<img src="<?php 
            echo esc_url( WP_ADMINIFY_ASSETS );
            ?>images/header/close.svg" alt="Close Icon">
						</button>

						<div class="user-wrapper-top media">
							<figure class="media-left">
								<p class="image is-85x85">
									<?php 
            echo get_avatar(
                $current_user->user_email,
                85,
                '',
                '',
                [
                    'class' => 'is-rounded',
                ]
            );
            ?>
								</p>
							</figure>
							<div class="media-content">
								<div class="content">
									<h3 class="name">
										<?php 
            echo esc_html( $current_user->display_name );
            ?>
									</h3>
									<a href="<?php 
            echo esc_url( admin_url( 'profile.php' ) );
            ?>" class="email">
										<?php 
            echo wp_kses_post( is_email( $current_user->user_email ) );
            ?>
									</a>
									<br>
									<a href="<?php 
            echo esc_url( wp_logout_url() );
            ?>" class="logout button">
										<?php 
            echo esc_html__( 'Log Out', 'adminify' );
            ?>
									</a>
								</div>
							</div>
						</div>


						<div class="user-wrapper-content">
							<div class="panel-insider">
								<h4 class="title"><?php 
            esc_html__( 'Overview', 'adminify' );
            ?></h4>
								<ul>
									<li>
										<a href="<?php 
            echo esc_url( get_home_url() );
            ?>" target="_blank">
											<img class="user-panel-icon" src="<?php 
            echo esc_url( WP_ADMINIFY_ASSETS );
            ?>images/header/panel/building.svg" alt="<?php 
            echo esc_html__( 'View Website Icon', 'adminify' );
            ?>">
											<?php 
            echo esc_html_e( 'View Website', 'adminify' );
            ?>
										</a>
									</li>
									<li>
										<a href="<?php 
            echo esc_url( admin_url( 'profile.php' ) );
            ?>">
											<img class="user-panel-icon" src="<?php 
            echo esc_url( WP_ADMINIFY_ASSETS );
            ?>images/header/panel/users.svg" alt="<?php 
            echo esc_html__( 'Profile Icon', 'adminify' );
            ?>">
											<?php 
            esc_html_e( 'View Profile', 'adminify' );
            ?>
										</a>
									</li>
								</ul>
							</div>

							<?php 
            $all_updates = Utils::get_all_updates();
            $total_updates = $all_updates['total'];
            $plugin_updates = $all_updates['plugin'];
            $theme_updates = $all_updates['theme'];
            $wp_updates = $all_updates['wordpress'];
            ?>


							<div class="panel-insider">
								<h4 class="title"><?php 
            esc_html_e( 'Updates', 'adminify' );
            ?></h4>
								<?php 
            if ( $total_updates < 1 ) {
                ?>
									<p class="adminify-meta">
										<?php 
                esc_html_e( 'Everything is up to date', 'adminify' );
                ?>
									</p>
								<?php 
            } else {
                ?>
									<ul>

										<li>
											<a href="<?php 
                echo esc_url( admin_url( 'update-core.php' ) );
                ?>">
												<span class="icon-reload"></span>
												<?php 
                esc_html_e( 'All Updates', 'adminify' );
                ?>
												<span class="count tag is-rounded">
													<?php 
                echo esc_html( $total_updates );
                ?>
												</span>
											</a>
										</li>
										<li>
											<a href="<?php 
                echo esc_url( admin_url( 'update-core.php' ) );
                ?>">
												<span class="dashicons dashicons-wordpress"></span>
												<?php 
                esc_html_e( ' WordPress Core', 'adminify' );
                ?>
												<span class="count tag is-rounded">
													<?php 
                echo esc_html( $wp_updates );
                ?>
												</span>
											</a>
										</li>
										<li>
											<a href="<?php 
                echo esc_url( admin_url( 'plugins.php' ) );
                ?>">
												<span class="icon-energy"></span>
												<?php 
                esc_html_e( ' Plugins', 'adminify' );
                ?>
												<span class="count tag is-rounded"><?php 
                echo esc_html( count( $plugin_updates ) );
                ?></span>
											</a>
										</li>
										<li>
											<a href="<?php 
                echo esc_url( admin_url( 'themes.php' ) );
                ?>">
												<img class="user-panel-icon" src="<?php 
                echo esc_url( WP_ADMINIFY_ASSETS );
                ?>images/header/panel/plugins.svg" />
												<?php 
                esc_html_e( ' Themes', 'adminify' );
                ?>
												<span class="count tag is-rounded"><?php 
                echo esc_html( count( $theme_updates ) );
                ?></span>
											</a>
										</li>
									</ul>
								<?php 
            }
            ?>
							</div>

							<div class="panel-insider">
								<h4 class="title"><?php 
            esc_html_e( 'Preferences', 'adminify' );
            ?></h4>
								<ul>
									<li>
										<?php 
            esc_html_e( 'Screen Tab Hide', 'adminify' );
            ?>
										<label class="admnify-switcher is-pulled-right">
											<input type="checkbox" id="screen-option-switcher-btn" <?php 
            checked( $enable_screen_tab, 1 );
            ?>>
											<span class="slider round"></span>
										</label>
									</li>
									<li>
										<?php 
            esc_html_e( 'Help Tab Hide ', 'adminify' );
            ?>
										<label class="admnify-switcher is-pulled-right">
											<input type="checkbox" id="help-option-switcher-btn" <?php 
            checked( $enable_help_tab, 1 );
            ?>>
											<span class="slider round"></span>
										</label>
									</li>
									<?php 
            $on = false;
            // temporary hide this menu
            if ( $on == true ) {
                ?>
										<li>
											<?php 
                esc_html_e( 'Hide WP Links', 'adminify' );
                ?>
											<label class="admnify-switcher is-pulled-right">
												<input type="checkbox" id="hide-wp-links-switcher-btn" <?php 
                checked( $enable_hide_wp_links, 1 );
                ?>>
												<span class="slider round"></span>
											</label>
										</li>
									<?php 
            }
            ?>
								</ul>
							</div>
						</div>

						<!-- <div class="user-notification-area pb-5">
							<h4>
							<?php 
            // esc_html_e('All Notifications', 'adminify');
            ?>
								</h4>
							<ul class="m-0 p-0">
								<li>
									<a href="#">Dashboard: <span class="count has-text-centered is-pulled-right">2</span></a>
								</li>
								<li>
									<a href="#">Themes: <span class="count has-text-centered is-pulled-right">2</span></a>
								</li>
								<li>
									<a href="#">Plugins: <span class="count has-text-centered is-pulled-right">2</span></a>
								</li>
								<li>
									<a href="#">Settings: <span class="count has-text-centered is-pulled-right">2</span></a>
								</li>
							</ul>
						</div> -->

					</div>
				</div>
			<?php 
        }
        ?>
		</div>

	<?php 
        $output_wp_admin_bar = ob_get_clean();
        // echo Utils::wp_kses_custom($output_wp_admin_bar);
        echo $output_wp_admin_bar;
    }

    public function jltwp_adminify_logo() {
        global $wp_admin_bar;
        $adminurl = get_admin_url();
        $homeurl = $adminurl;
        // Light Logo
        $admin_bar_mode = AdminSettings::get_instance()->get();
        $menu_layout = (array) $admin_bar_mode['menu_layout_settings'];
        // Menu Layouts
        $menu_layout = ( !empty( $admin_bar_mode['menu_layout_settings'] ) ? $admin_bar_mode['menu_layout_settings'] : '' );
        $menu_mode = ( !empty( $menu_layout['menu_mode'] ) ? $menu_layout['menu_mode'] : 'classic' );
        $menu_layout = ( !empty( $menu_layout['layout_type'] ) ? $menu_layout['layout_type'] : 'vertical' );
        $admin_bar_logo_type = ( !empty( $admin_bar_mode['admin_bar_logo_type'] ) ? $admin_bar_mode['admin_bar_logo_type'] : 'image_logo' );
        $light_mode = ( !empty( $admin_bar_mode['admin_bar_light_mode'] ) ? $admin_bar_mode['admin_bar_light_mode'] : '' );
        $light_logo = '';
        if ( $admin_bar_logo_type == 'image_logo' ) {
            if ( $menu_mode == 'icon_menu' ) {
                if ( isset( $light_mode['mini_admin_bar_light_logo']['url'] ) && $light_mode['mini_admin_bar_light_logo']['url'] ) {
                    $light_logo = $light_mode['mini_admin_bar_light_logo']['url'];
                } else {
                    $light_logo = WP_ADMINIFY_ASSETS_IMAGE . 'logos/logo-text-light.svg';
                }
            } else {
                // Logo Image
                if ( !empty( $light_mode['admin_bar_light_logo']['url'] ) ) {
                    $light_logo = $light_mode['admin_bar_light_logo']['url'];
                } else {
                    $light_logo = WP_ADMINIFY_ASSETS_IMAGE . 'logos/logo-text-light.svg';
                }
            }
        } elseif ( $admin_bar_logo_type == 'text_logo' ) {
            // Text Logo
            if ( $admin_bar_mode['admin_bar_mode'] == 'light' ) {
                $text_logo = $light_mode['admin_bar_light_logo_text'];
            }
        }
        // Logo Size
        $light_width = ( isset( $light_mode['light_logo_size']['width'] ) ? $light_mode['light_logo_size']['width'] : '150' );
        $light_height = ( isset( $light_mode['light_logo_size']['height'] ) ? $light_mode['light_logo_size']['height'] : '45' );
        // Dark Logo
        $dark_mode = ( !empty( $admin_bar_mode['admin_bar_dark_mode'] ) ? $admin_bar_mode['admin_bar_dark_mode'] : '' );
        $dark_logo = '';
        if ( $admin_bar_logo_type == 'image_logo' ) {
            if ( $menu_mode == 'icon_menu' ) {
                if ( isset( $dark_mode['mini_admin_bar_dark_logo']['url'] ) && $dark_mode['mini_admin_bar_dark_logo']['url'] ) {
                    $dark_logo = $dark_mode['mini_admin_bar_dark_logo']['url'];
                } else {
                    $dark_logo = WP_ADMINIFY_ASSETS_IMAGE . 'logos/logo-text-dark.svg';
                }
            } else {
                // Dark Logo Image
                if ( isset( $dark_mode['admin_bar_dark_logo']['url'] ) && $dark_mode['admin_bar_dark_logo']['url'] ) {
                    $dark_logo = $dark_mode['admin_bar_dark_logo']['url'];
                } else {
                    $dark_logo = WP_ADMINIFY_ASSETS_IMAGE . 'logos/logo-text-dark.svg';
                }
            }
        } elseif ( $admin_bar_logo_type == 'text_logo' ) {
            // Text Logo
            if ( $admin_bar_mode['admin_bar_mode'] == 'dark' ) {
                $text_logo = $dark_mode['admin_bar_dark_logo_text'];
            }
        }
        // Dark Logo Size
        $dark_width = ( isset( $dark_mode['dark_logo_size']['width'] ) ? $dark_mode['dark_logo_size']['width'] : '150' );
        $dark_height = ( isset( $dark_mode['dark_logo_size']['height'] ) ? $dark_mode['dark_logo_size']['height'] : '45' );
        ?>

		<div class="navbar-brand">
			<a class="navbar-item p-0" href="<?php 
        echo esc_url( $homeurl );
        ?>">
				<?php 
        if ( $admin_bar_logo_type == 'image_logo' ) {
            ?>
					<img alt="<?php 
            echo esc_attr( get_bloginfo( 'name' ) );
            ?>" class="logo-light" src="<?php 
            echo esc_url( $light_logo );
            ?>" width="<?php 
            echo esc_attr( $light_width );
            ?>" height="<?php 
            echo esc_attr( $light_height );
            ?>">
					<img alt="<?php 
            echo esc_attr( get_bloginfo( 'name' ) );
            ?>" class="logo-dark" src="<?php 
            echo esc_url( $dark_logo );
            ?>" width="<?php 
            echo esc_attr( $dark_width );
            ?>" height="<?php 
            echo esc_attr( $dark_height );
            ?>">
				<?php 
        } elseif ( $admin_bar_logo_type == 'text_logo' ) {
            ?>
					<span class="wp-adminify-site-name">
						<?php 
            echo esc_html( $text_logo );
            ?>
					</span>
				<?php 
        }
        ?>
			</a>


			<div class="navbar-burger" data-target="wp-adminify-top-adminbar">
				<i class="dashicons dashicons-menu-alt"></i>
			</div>

		</div>

<?php 
    }

    /* Remove from the administration bar */
    public function jltma_adminify_remove_admin_bar_menus() {
        global $wp_admin_bar;
        $restricted_user = ( !empty( $this->options['admin_bar_new_button_user_roles'] ) ? $this->options['admin_bar_new_button_user_roles'] : '' );
        if ( $restricted_user ) {
            if ( Utils::restrict_for( $this->options['admin_bar_new_button_user_roles'] ) ) {
                $wp_admin_bar->remove_menu( 'new-content' );
                return;
            }
        }
        $wp_admin_bar->remove_menu( 'wp-logo' );
        $wp_admin_bar->remove_menu( 'site-name' );
        $wp_admin_bar->remove_menu( 'updates' );
        $wp_admin_bar->remove_menu( 'menu-toggle' );
    }

}
