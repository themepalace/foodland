<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core foodland-core.php and define theme version
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

//define theme version
if ( !defined( 'FOODLAND_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();
	
	define ( 'FOODLAND_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require get_template_directory() . '/inc/foodland-core.php';

