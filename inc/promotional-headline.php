<?php
/**
 * The template for displaying Promotional Headline	
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if( !function_exists( 'foodland_promotional_headline' ) ) :
/**
* Add Promotional headline .
*
* @uses action hook foodland_before_content.
*
* @since Foodland 0.2
*/
function foodland_promotional_headline() {
	//foodland_flush_transients();
	global $post, $wp_query;

	// get data value from options
	$options            = foodland_get_theme_options();
	$enable_headline_on = $options['enable_promotional_headline_on'];
	$content_select     = $options['promotional_headline_type'];
	
	// Front page displays in Reading Settings
	$page_on_front 	= get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 


	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	if ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable_headline_on == 'homepage' ) {
		 
		if ( ( !$foodland_promotional_headline = get_transient( 'foodland_promotional_headline' ) ) ) {
			echo '<!-- refreshing cache -->';

			$foodland_promotional_headline = '
				<section id="intro-part">
	                <div class="wrapper clear">';
	               
	                if( 'page-headline' == $content_select && function_exists( 'foodland_page_promotional_headline' ) ){
	                	$foodland_promotional_headline .= foodland_page_promotional_headline( $options ); 
	                }
	                
	        $foodland_promotional_headline .= '
	               	</div><!-- wrapper -->
	                
	            </section><!-- # intro -->';
			
			set_transient( 'foodland_promotional_headline', $foodland_promotional_headline, 86940 );
		}
		echo $foodland_promotional_headline;	
	}
}
endif;

add_action( 'foodland_before_content', 'foodland_promotional_headline', 30 );

//foodland_page_promotional_headline function starts
if( !function_exists( 'foodland_page_promotional_headline' ) ){
	function foodland_page_promotional_headline( $options ){
		global $post;

		$page_id     = absint( $options['promotional_headline_page'] );		
		$button_text = $options['promotional_headline_button_text'];
		$content     = get_post_field('post_content', $page_id);

		if( has_post_thumbnail( $page_id ) ){
			$class              = 'one-half ';
			$has_thumbnail_flag = true; 
			$image              = get_the_post_thumbnail( $page_id, 'foodland-promotional-page' );
		}
		else{
			$class              = '';
			$has_thumbnail_flag = false; 
		}

		if( !empty( $page_id ) && $page_id > 0 ){
			$page_promotional_headline = '
				<div class="'. $class .'about">
	                <h2 class="upercase"><a href="' . esc_url( get_permalink( $page_id ) ) . '">'. esc_html( get_the_title( $page_id ) ) .'</a></h2>
	               
	                <p>'. wp_kses_post( $content ) .'</p>
	           
	                <a class="rounded-btn upercase" href="'.esc_url( get_permalink( $page_id ) ).'"><span>'. esc_html( $button_text ) .'</span></a>
	                   
	            </div><!-- one-half -->';
	            if( $has_thumbnail_flag ){
			        $page_promotional_headline .= '
			        	<div class="one-half right">
			                <div class="single-image-wrap"><a href="' . esc_url( get_permalink( $page_id ) ) . '">'. $image .'</a>    
			                </div><!-- .single-image-wrap -->
			            </div><!-- one-half -->';
				}
        }else{
        	$page_promotional_headline = '';
        }

    return $page_promotional_headline;

	}
}
//foodland_custom_promotional_headline ends