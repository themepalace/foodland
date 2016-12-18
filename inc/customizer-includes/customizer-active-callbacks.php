<?php
/**
 * Active callbacks for Theme/Customzer Options
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if( ! function_exists( 'foodland_is_feature_slider_active' ) ) :
	/**
	* Return true if featured slider is active
	*
	* @since  Foodland 0.2
	*/
	
	function foodland_is_feature_slider_active( $control ) {
		global $wp_query;
		
		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		  $page_on_front  = get_option('page_on_front') ;

		$enable = $control->manager->get_setting( 'foodland_theme_options[featured_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return (  ( $page_id == $page_on_front && $page_id > 0 ) && $enable == 'homepage' );
	}
endif;

// Active callback for promotional headline.
// check to see if promotional headline is not disable
if( ! function_exists( 'foodland_is_promotional_headline_active' ) ) :
	/**
	* Return true if promotional headline is active
	*
	* @since  Foodland 0.2
	*/
	function foodland_is_promotional_headline_active( $control ) {
		global $wp_query;
		
		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_on_front = get_option('page_on_front'); 

		$enable = $control->manager->get_setting( 'foodland_theme_options[enable_promotional_headline_on]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' );
	}
endif;

if( ! function_exists( 'foodland_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since  Foodland 0.2
	*/
	function foodland_is_featured_content_active( $control ) {
		global $wp_query;
		
		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_on_front = get_option( 'page_on_front' ); 

		$enable = $control->manager->get_setting( 'foodland_theme_options[featured_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( ( $page_id == $page_on_front && $page_id > 0 ) && $enable == 'homepage' );
	}
endif;

if( ! function_exists( 'foodland_is_todays_special_menu_active' ) ) :
	/**
	* Return true if todays special menu is active
	*
	* @since  Foodland 0.2
	*/
	function foodland_is_todays_special_menu_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_on_front = get_option( 'page_on_front' ); 

		$enable = $control->manager->get_setting( 'foodland_theme_options[show_todays_special_on]' )->value();
		//return true only if previwed page on customizer matches the type of content option selected
		return ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' );
	}
endif;

if( ! function_exists( 'foodland_is_staff_member_active' ) ) :
	/**
	* Return true if Enable Staff Member Section is not disabled
	*
	* @since  Foodland 0.2
	*/
	function foodland_is_staff_member_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_on_front = get_option( 'page_on_front' ); 

		$enable = $control->manager->get_setting( 'foodland_theme_options[staff_member_option_on]' )->value();
		//return true only if previwed page on customizer matches the type of content option selected
		return ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' );
	}
endif;

if( !function_exists( 'foodland_is_footer_social_links_active' ) ) :
	/**
	* Return true if  customizing-> theme_options -> social_links -> check to disbale is not checked
	*
	* @since  Foodland 0.2
	*/
	function foodland_is_footer_social_links_active( $control ){

		$disable = $control->manager->get_setting( 'foodland_theme_options[disable_social_icon]' )->value();

		//return true only if social link is not disabled
		return ( '0' == $disable );
	}
endif;

if( !function_exists( 'foodland_is_frontpage_blog_options_active' ) ) :
	/**
	* Return true if ( customizing-> Frontpage blog option -> Checkto disable blog option ) is not checked
	*
	* @since  Foodland 0.2
	*/
	function foodland_is_frontpage_blog_options_active( $control ){

		$disable = $control->manager->get_setting( 'foodland_theme_options[disable_blog_options]' )->value();

		//return true only if frontpage blog option is not disabled
		return ( '0' == $disable );
	}
endif;