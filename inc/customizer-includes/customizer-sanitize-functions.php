<?php
/**
 * Sanitization functions for Theme/Customzer Options
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

/**
 * Sanitizes Checkboxes
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Foodland 0.2
 */
function foodland_sanitize_checkbox( $checked ) {
    // Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 * 
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function foodland_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}


/**
 * Sanitizes page/post in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Foodland 0.2
 */
function foodland_sanitize_page( $input ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $input );
	// If $page_id is an ID of a published page, return it; otherwise, return false
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : false );
}


/**
 * Sanitizes category list in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Foodland 0.2
 */
function foodland_sanitize_category_list( $input ) {
	if ( $input != '' ) { 
		$args = array(
						'type'			=> 'post',
						'child_of'      => 0,
						'parent'        => '',
						'orderby'       => 'name',
						'order'         => 'ASC',
						'hide_empty'    => 0,
						'hierarchical'  => 0,
						'taxonomy'      => 'category',
					); 
		
		$categories = ( get_categories( $args ) );

		$category_list 	=	array();
		
		foreach ( $categories as $category )
			$category_list 	=	array_merge( $category_list, array( $category->term_id ) );

		if ( count( array_intersect( $input, $category_list ) ) == count( $input ) ) {
	    	return $input;
	    } 
	    else {
    		return '';
   		}
    }
    else {
    	return '';
    }
}


/**
 * Number Range sanitization callback example.
 *
 * - Sanitization: number_range
 * - Control: number, tel
 * 
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
 *                    the setting default.
 */
function foodland_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}


/**
 * Sanitizes footer code
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Foodland 0.2
 */
function foodland_sanitize_footer_code( $input ) {
	// Make sure we kill evil scripts
	return ( stripslashes( wp_filter_post_kses( addslashes ( $input ) ) ) );
}


/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 * 
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 * 
 * @see foodland_sanitize_select()               https://developer.wordpress.org/reference/functions/foodland_sanitize_select/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function foodland_sanitize_select( $input, $setting ) {
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitizes and Make options default for footer editor options
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Foodland 0.2
 */
function foodland_sanitize_footer_content( $input ) {
    if ( $input == '1' ) {
    	//Reset Footer Editor Options
        $options 	= foodland_get_theme_options();
        $defaults 	= foodland_get_default_theme_options();
        
        $options[ 'footer_left_content' ] = $defaults[ 'footer_left_content' ];
		$options[ 'footer_right_content' ] = $defaults[ 'footer_right_content' ];

        set_theme_mod( 'foodland_theme_options', $options );
    }

    return '';
}

/**
 * Dummy Sanitizaition function as it contains no value to be sanitized
 *
 * @since Foodland 0.2
 */
function foodland_sanitize_important_link() {
	return false;
} 


// sanitize function for widgets


/**
 * Sanitizaition function for custom-post widget image position
 *
 * @since Foodland 0.7
 */
function foodland_custom_post_widget_image_position( $image_position ){

	return( isset( $image_position ) && ( $image_position == 'above' || $image_position == 'below' ) ? $image_position : 'above' );
}

/**
 * Sanitizaition function for custom-post widget show content
 *
 * @since Foodland 0.7
 */
function foodland_custom_post_widget_show_content( $show_content ){

	return( isset( $show_content ) && ( $show_content == 'excerpt' || $show_content == 'fullcontent' || $show_content == 'hide'  ) ? $show_content : 'excerpt');
}