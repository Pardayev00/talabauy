<?php
namespace WPAdminify\Inc\Classes;

use WPAdminify\Libs\Recommended;

if ( ! class_exists( 'Recommended_Plugins' ) ) {
	/**
	 * Recommended Plugins class
	 *
	 * Jewel Theme <support@jeweltheme.com>
	 */
	class Recommended_Plugins extends Recommended {

		/**
		 * Constructor method
		 */
		public function __construct() {
			$this->menu_order = 62; // for submenu order value should be more than 10 .
			parent::__construct( $this->menu_order );
		}

		/**
		 * Menu list
		 */
		public function menu_items() {
			return array(
				array(
					'key'   => 'all',
					'label' => 'All',
				),
				array(
					'key'   => 'featured', // key should be used as category to the plugin list.
					'label' => 'Featured Item',
				),
				array(
					'key'   => 'popular',
					'label' => 'Popular',
				),
				array(
					'key'   => 'favorites',
					'label' => 'Favorites',
				),
			);
		}

		/**
		 * Plugins List
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function plugins_list() {
			return array(

				'admin-bar'             => array(
					'slug'              	=> 'admin-bar',
					'name'              	=> 'Admin Bar Editor',
					'short_description' 	=> 'The Admin Bar Editor plugin revolutionizes the way you interact with the WordPress Admin Bar, also known as the Toolbar. This powerful plugin allows for extensive customization of both the backend and frontend Admin Bars.',
					'icon'              	=> 'https://ps.w.org/admin-bar/assets/icon.svg',
					'download_link'     	=> 'https://downloads.wordpress.org/plugin/admin-bar.zip',
					'type'              	=> array('featured', 'popular'),
				),
				'rolemaster-suite'      => array(
					'slug'              	=> 'rolemaster-suite',
					'name'              	=> 'RoleMaster Suite – User Role Editor',
					'short_description' 	=> 'RoleMaster Suite a User Role Editor plugin for WordPress that allows website administrators with the ability to fine-tune user roles and capabilities with precision.',
					'icon'              	=> 'https://ps.w.org/rolemaster-suite/assets/icon.svg',
					'download_link'     	=> 'https://downloads.wordpress.org/plugin/rolemaster-suite.zip',
					'type'              	=> array('featured', 'popular'),
				),
				'loginfy'      			=> array(
					'slug'              	=> 'loginfy',
					'name'              	=> 'Loginfy – Custom Login Page Customizer',
					'short_description' 	=> 'Loginfy Plugin allows users to easily customize their WordPress login page, providing a unique and personalized experience for website administrators and users.',
					'icon'              	=> 'https://ps.w.org/loginfy/assets/icon.svg',
					'download_link'     	=> 'https://downloads.wordpress.org/plugin/loginfy.zip',
					'type'              	=> array('featured', 'popular'),
				),
				'master-addons'                 => array(
					'slug'              => 'master-addons',
					'name'              => 'Master Addons for Elementor',
					'short_description' => 'Master Addons for Elementor provides the most comprehensive Elements & Extensions with a user-friendly interface. It is packed with 50+ Elementor Elements & 20+ Extension.',
					'icon'              => 'https://ps.w.org/master-addons/assets/icon.svg',
					'download_link'     => 'https://downloads.wordpress.org/plugin/master-addons.zip',
					'type'              => array( 'all', 'featured', 'popular', 'favorites' ),
				),
				'copy-to-clipboard'             => array(
					'slug'              => 'copy-to-clipboard',
					'name'              => 'Copy to Clipboard',
					'short_description' => 'Copy To Clipboard is a WordPress plugin that makes it simple to copy & paste text, paragraphs, blockquotes, coupons codes and source codes from your WP website with a single click. It’s an efficient way to save effort and time while navigating through your WordPress site content',
					'icon'              => 'https://ps.w.org/copy-to-clipboard/assets/icon.svg?rev=2840276',
					'download_link'     => 'https://downloads.wordpress.org/plugin/copy-to-clipboard.zip',
					'type'              => array( 'featured', 'popular' ),
				),

			);
		}

		/**
		 * Admin submenu
		 */
		public function admin_menu() {
			// For submenu .
			$this->sub_menu = add_submenu_page(
				'wp-adminify-settings',       // Ex. wp-adminify-settings /  edit.php?post_type=page .
				__( 'Addons', 'adminify' ),
				__( 'Addons', 'adminify' ),
				'manage_options',
				'wp-adminify-recommended-plugins',
				array( $this, 'render_recommended_plugins' )
			);
		}
	}
}
