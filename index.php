<?php
/*
Plugin Name: WordPress Restaurant menu Plugin
Plugin URI:  https://github.com/simonrcodrington/Introduction-to-WordPress-Plugins---Location-Plugin
Description: Creates an interfaces to manage store / business locations on your website. Useful for showing location based information quickly. Includes both a widget and shortcode for ease of use.
Version:     1.0.0
Author:      Simon Codrington
Author URI:  http://www.simoncodrington.com.au
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

use MenuRestaurant\Classes\RestaurantMenu;

defined( 'ABSPATH' ) || die();
define( 'PLUGIN_DIR', ( function_exists( 'plugin_dir_path' ) ? plugin_dir_path( __FILE__ ) : __DIR__ . '/' ) );

/**
 * Autoloader init
 */
if ( file_exists( PLUGIN_DIR . 'vendor/autoload.php' ) ) {
	require_once PLUGIN_DIR . 'vendor/autoload.php';
}

RestaurantMenu::init();

add_action( 'admin_head', 'my_custom_fonts' );

function my_custom_fonts() {
	echo '<style>
				.wp-menu-image.dashicons-before img {
					height: 20px;
				}
		  </style>';
}


