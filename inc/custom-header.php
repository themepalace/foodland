<?php
/**
 * Implement Custom Header functionality
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if ( ! function_exists( 'foodland_custom_header' ) ) :
/**
 * Implementation of the Custom Header feature
 * Setup the WordPress core custom header feature and default custom headers packaged with the theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
	function foodland_custom_header() {

		/**
		 * Get Theme Options Values
		 */		
		$options 	= foodland_get_theme_options();

		$args = array(
		
		// Header image default
		'default-image'			=> get_template_directory_uri() . '/images/header.png',
		
		// Set height and width, with a maximum value for the width.
		'height'                 => 400,
		'width'                  => 1200,
		
		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,
			
		// Random image rotation off by default.
		'random-default'         => false,	
	);

	$args = apply_filters( 'custom-header', $args );

	// Add support for custom header	
	add_theme_support( 'custom-header', $args );

	}
endif; // foodland_custom_header
add_action( 'after_setup_theme', 'foodland_custom_header' );

if ( ! function_exists( 'foodland_site_branding' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @uses get_transient, foodland_get_theme_options, get_header_textcolor, get_bloginfo, set_transient, display_header_text
	 * @get logo from options
	 * 
	 * @display logo
	 *
	 * @action 	
	 *
	 * @since Foodland 0.2
	 */
	function foodland_site_branding() {
		$options       = foodland_get_theme_options();
		$site_title    = get_bloginfo( 'name' );
		$site_tagline  = get_bloginfo( 'description' );
		$logo_alt_text = $options['logo_alt_text'];
		$site_logo     = $options['logo'];

		//Checking logo
		if( 4.5 <= (float)get_bloginfo( 'version' ) ){
			if( has_custom_logo() ){
				$logo_image = get_custom_logo();
				$foodland_site_logo = '<div id="site-logo">'.  $logo_image  . '</div><!-- #site-logo -->';
			}else{
				$foodland_site_logo = '';
			}
		}else{
			if( !empty( $options['logo'] ) ){
				$foodland_site_logo = '
					<div id="site-logo">
						<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $site_title) . '" rel="home">
							<img src="' . esc_url( $site_logo ) . '" alt="' . esc_attr( $logo_alt_text ). '">
						</a>
					</div><!-- #site-logo -->';
			}
			else{
				$foodland_site_logo = '';
			}
		} 
		
		// site title and description check
		$site_title_enable  = display_header_text(); // check to enable or disable site title

		if ( ('' != $site_title || '' != $site_tagline )  && true == $site_title_enable ){
			$foodland_header_text = '
				<div id="site-header">';
				if( !empty( $site_title ) ){					
					$foodland_header_text .='<h2 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( $site_title ) . '</a></h2>';
				}
				if( !empty( $site_tagline ) ){

					$foodland_header_text .='<h3 class="site-description">' . esc_html( $site_tagline ) . '</h3>';
				}
			$foodland_header_text .='</div><!-- #site-header -->';		
		}
		else{
			$foodland_header_text = '';
		}
		
		if ( '' != $foodland_site_logo ) {
			$foodland_site_branding  = '<div class="site-branding">';
			$foodland_site_branding .= $foodland_site_logo;
			$foodland_site_branding .= $foodland_header_text;
			$foodland_site_branding .= '</div><!-- .site-branding-->';
		}
		else {
			$foodland_site_branding	 = '<div class="site-branding">';
			$foodland_site_branding	.= $foodland_header_text;
			$foodland_site_branding .= '</div><!-- .site-branding-->';
		}
		echo $foodland_site_branding ;	
	}
endif; // foodland_site_branding
add_action( 'foodland_header', 'foodland_site_branding', 50 );


if ( ! function_exists( 'foodland_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own foodland_featured_image(), and that function will be used instead.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_featured_image() {
		$options		= foodland_get_theme_options();	
		
		$header_image 	= get_header_image();

		//Support Random Header Image
		if ( is_random_header_image() ) {
			delete_transient( 'foodland_featured_image' );
		}
			
		if ( !$foodland_featured_image = get_transient( 'foodland_featured_image' ) ) {
			
			echo '<!-- refreshing cache -->';

			if ( $header_image != '' ) {
				
				// Header Image Link and Target
				if ( !empty( $options[ 'featured_header_image_url' ] ) ) {
					
						$link = esc_url( $options[ 'featured_header_image_url' ] );
					
					//Checking Link Target
					if ( !empty( $options[ 'featured_header_image_base' ] ) )  {
						$target = '_blank'; 	
					}
					else {
						$target = '_self'; 	
					}
				}
				else {
					$link = '';
					$target = '';
				}
				
				// Header Image Title/Alt
				if ( !empty( $options[ 'featured_header_image_alt' ] ) ) {
					$title = esc_attr( $options[ 'featured_header_image_alt' ] ); 	
				}
				else {
					$title = '';
				}
				
				// Header Image
				$feat_image = '<img class="wp-post-image" alt="'.esc_attr( $title ).'" src="'.esc_url(  $header_image ).'" />';
				
				$foodland_featured_image = '<div id="header-featured-image">
					<div class="wrapper">';
					// Header Image Link 
					if ( !empty( $options[ 'featured_header_image_url' ] ) ) :
						$foodland_featured_image .= '<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'" target="'.esc_attr( $target ).'">' . $feat_image . '</a>'; 	
					else:
						// if empty featured_header_image on theme options, display default
						$foodland_featured_image .= $feat_image;
					endif;
				$foodland_featured_image .= '</div><!-- .wrapper -->
				</div><!-- #header-featured-image -->';
			}
				
			set_transient( 'foodland_featured_image', $foodland_featured_image, 86940 );	
		}	
		
		echo $foodland_featured_image;
		
	} // foodland_featured_image
endif;

if ( ! function_exists( 'foodland_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own foodland_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_featured_overall_image() {
		global $post, $wp_query;
		$options           = foodland_get_theme_options();	
		$defaults          = foodland_get_default_theme_options(); 
		$enableheaderimage = $options['enable_featured_header_image'];
		
		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		$page_for_posts = get_option('page_for_posts');

		// Check Homepage 
		if ( $enableheaderimage == 'homepage' ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				foodland_featured_image();
			}
		}
		else {
			echo '<!-- Disable Header Image -->';
		}
	} // foodland_featured_overall_image
endif;
add_action( 'foodland_after_header', 'foodland_featured_overall_image', 10 );