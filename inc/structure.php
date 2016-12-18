<?php
/**
 * The template for Managing Theme Structure
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if ( ! function_exists( 'foodland_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'foodland_doctype', 'foodland_doctype', 10 );


if ( ! function_exists( 'foodland_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
		<?php
	}
endif;
add_action( 'foodland_before_wp_head', 'foodland_head', 10 );

if ( ! function_exists( 'foodland_get_site_loader' ) ) :
	/**
	 * site loader
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_get_site_loader() {
		?>
		<div id="loader">
   			<div class="loader-container">
     			<div class="genericon genericon-refresh"></div>
   			</div><!-- .loader-container -->
		</div><!-- .loader -->
		<?php
	}
endif;
add_action( 'foodland_site_loader', 'foodland_get_site_loader', 10 );

if ( ! function_exists( 'foodland_doctype_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_page_start() {
		?>
		<div id="page" class="hfeed site">
		<a class="skip-link screen-reader-text" href="#content"><?php  _e( 'Skip to content','foodland') ?> </a>
		<?php
	}
endif;
add_action( 'foodland_header', 'foodland_page_start', 10 );


if ( ! function_exists( 'foodland_page_end' ) ) :
	/**
	 * End div id #page
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'foodland_footer', 'foodland_page_end', 200 );


if ( ! function_exists( 'foodland_header_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_header_start() {
		?>
		<header id="masthead" class="site-header" role="banner">
        	<div class="wrapper clear">
		<?php
	}
endif;
add_action( 'foodland_header', 'foodland_header_start', 30 );


if ( ! function_exists( 'foodland_header_end' ) ) :
	/**
	 * End Header id #masthead and class .wrapper
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_header_end() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'foodland_header', 'foodland_header_end', 100 );


if ( ! function_exists( 'foodland_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_content_start() {
		?>
		<div id="content" class="site-content">
          <div id="primary" class="content-area">
          	
	<?php
	}
endif;
add_action('foodland_content', 'foodland_content_start', 10 );

if ( ! function_exists( 'foodland_inner_page_div_start' ) ) :
	/**
	 * Start div id #inner-page, class .wrapper and #inner-content
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_inner_page_div_start() {
		global $post;
		$post_type = get_post_type( $post );

		$post_id = '';

		if( is_single() && $post_type == 'nova_menu_item' ){
			$post_id = 'product-detail';
		}

		elseif( ( is_search() || is_archive() ) && $post_type == 'nova_menu_item' ){
			$post_id = 'food-menu-list';
		}

		else{
			$post_id = 'inner-page';
		}

	?>

		<div id="<?php echo $post_id; ?>">
	    	<div class="wrapper">
	        	<div id="inner-content">
	<?php
	}
endif;
add_action('foodland_inner_page_div_structure_start', 'foodland_inner_page_div_start', 10 );

if ( ! function_exists( 'foodland_inner_page_div_ends' ) ) :
		
	/**
	 * Start div id #inner-page, class .wrapper and #inner-content
	 *
	 * @since Foodland 0.2
	 *
	 */
	function foodland_inner_page_div_ends() {
		global $post;
		$post_type = get_post_type( $post );
	?>
	        	</div><!-- #inner-content -->
	    	</div><!-- .wrapper -->
		</div><!-- #inner-page -->
	<?php
	}
endif;
add_action('foodland_inner_page_div_structure_ends', 'foodland_inner_page_div_ends', 10 );

if ( ! function_exists( 'foodland_content_end' ) ) :
	/**
	 * End div id #content and class .wrapper
	 *
	 * @since Foodland 0.2
	 */
	function foodland_content_end() {
		?>
			</div><!-- #primary -->
	    </div><!-- #content -->
		<?php
	}

endif;
add_action( 'foodland_after_content', 'foodland_content_end', 30 );


if ( ! function_exists( 'foodland_footer_content_start' ) ) :
/**
 * Start footer id #colophon
 *
 * @since Foodland 0.2
 */
function foodland_footer_content_start() {
	?>
	 <footer id="colophon" class="site-footer" role="contentinfo">
            
    <?php
}
endif;
add_action('foodland_footer', 'foodland_footer_content_start', 30 );


if ( ! function_exists( 'foodland_footer_sidebar' ) ) :
/**
 * Footer Sidebar
 *
 * @since Foodland 0.2
 */
function foodland_footer_sidebar() {
	get_sidebar( 'footer' );
}
endif;
add_action( 'foodland_footer', 'foodland_footer_sidebar', 40 );


if ( ! function_exists( 'foodland_footer_content_end' ) ) :
/**
 * End footer id #colophon
 *
 * @since Foodland 0.2
 */
function foodland_footer_content_end() {
	?>
	
	</footer><!-- #colophon -->
	<?php
}
endif;
add_action( 'foodland_footer', 'foodland_footer_content_end', 110 );
