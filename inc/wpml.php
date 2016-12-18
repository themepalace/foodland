<?php
/**
 * This functions makes the theme compatible with WPML Plugin
 *
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */
 

if ( ! function_exists( 'foodland_wpml_invalidcache' ) ) :
/**
 * Template for Clearing WPML Invalid Cache
 *
 * To override this in a child theme
 * simply create your own foodland_wpml_invalidcache(), and that function will be used instead.
 *
 * @since Foodland  0.1
 */
function foodland_wpml_invalidcache() {
	delete_transient( 'foodland_featured_content' );
	delete_transient( 'foodland_featured_slider' );
	delete_transient( 'foodland_footer_content' );	
	delete_transient( 'foodland_featured_image' );
	delete_transient( 'foodland_post_total_category' );
} // foodland_wpml_invalidcache
endif;

add_action( 'after_setup_theme', 'foodland_wpml_invalidcache' );
