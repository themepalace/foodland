<?php
/**
 * The main template for implementing Theme/Customzer Options
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if ( ! defined( 'FOODLAND_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


/**
 * Implements foodland theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Foodland 0.2
 */
function foodland_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';

	/**
	  * Set priority of blogname (Site Title) to 1.
	  *  Strangly, if more than two options is added, Site title is moved below Tagline. This rectifies this issue.
	  */
	$wp_customize->get_control( 'blogname' )->priority			= 1;

	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = foodland_get_theme_options();

	$defaults = foodland_get_default_theme_options();

	//Custom Controls
	require get_template_directory() . '/inc/customizer-includes/customizer-custom-controls.php';

	// Custom Logo (added to Site Title and Tagline section in Theme Customizer)
	if( 4.5 > (float) get_bloginfo( 'version' ) ){
		$wp_customize->add_setting( 'foodland_theme_options[logo]', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['logo'],
			'sanitize_callback'	=> 'foodland_sanitize_image'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
			'label'		=> __( 'Logo', 'foodland' ),
			'priority'	=> 100,
			'section'   => 'title_tagline',
	        'settings'  => 'foodland_theme_options[logo]',
	    ) ) );

		$wp_customize->add_setting( 'foodland_theme_options[logo_alt_text]', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['logo_alt_text'],
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'foodland_logo_alt_text', array(
			'label'    	=> __( 'Logo Alt Text', 'foodland' ),
			'priority'	=> 102,
			'section' 	=> 'title_tagline',
			'settings' 	=> 'foodland_theme_options[logo_alt_text]',
			'type'     	=> 'text',
		) );
	}
	// Custom Logo End

	// Custom color Option
	$wp_customize->add_setting( 'foodland_theme_options[header_nav_menu_color]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['header_nav_menu_color'],
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'foodland_theme_options[header_nav_menu_color]', array(
		'label'				=> __( 'Header navigation color', 'foodland' ),
        'priority'			=> 2,
		'section'   		=> 'colors',
        'settings'  		=> 'foodland_theme_options[header_nav_menu_color]',
	) ) );
   	// Custom color End

	// Header Options (added to Header section in Theme Customizer)
	require get_template_directory() . '/inc/customizer-includes/customizer-header-options.php';


   	//Additional Menu Options
	$wp_customize->add_section( 'foodland_menu_options', array(
		'description'	=> __( 'Extra Menu Options specific to this theme', 'foodland' ),
		'priority' 		=> 10,
		'title'    		=> __( 'Menu Options', 'foodland' ),
		'panel'			=> 'nav_menus'
	) );

	// Theme Options
	require get_template_directory() . '/inc/customizer-includes/customizer-theme-options.php';

	// Featured Slider Options
	require get_template_directory() . '/inc/customizer-includes/customizer-featured-slider.php';

	// Promotional Headline Options
	require get_template_directory() . '/inc/customizer-includes/customizer-promotional-headline.php';

	// Todays Special
	require get_template_directory() . '/inc/customizer-includes/customizer-todays-special.php';

	// Frontpage Options
	require get_template_directory() . '/inc/customizer-includes/customizer-frontpage-option.php';

	// Featured Content Options
	require get_template_directory() . '/inc/customizer-includes/customizer-featured-content.php';

	// Staff Members Options
	require get_template_directory() . '/inc/customizer-includes/customizer-team-members.php';

	// Reset all settings to default
	$wp_customize->add_section( 'foodland_reset_all_settings', array(
		'description'	=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'foodland' ),
		'priority' 		=> 800,
		'title'    		=> __( 'Reset all settings', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[reset_all_settings]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'foodland_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'foodland_theme_options[reset_all_settings]', array(
		'label'    => __( 'Check to reset all settings to default', 'foodland' ),
		'section'  => 'foodland_reset_all_settings',
		'settings' => 'foodland_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end


	//Important Links
		$wp_customize->add_section( 'important_links', array(
			'priority' 		=> 999,
			'title'   	 	=> __( 'Important Links', 'foodland' ),
		) );

		/**
		 * Has dummy Sanitizaition function as it contains no value to be sanitized
		 */
		$wp_customize->add_setting( 'important_links', array(
			'sanitize_callback'	=> 'foodland_sanitize_important_link',
		) );

		$wp_customize->add_control( new Foodland_Important_Links( $wp_customize, 'important_links', array(
	        'label'   	=> __( 'Important Links', 'foodland' ),
	         'section'  	=> 'important_links',
	        'settings' 	=> 'important_links',
	        'type'     	=> 'important_links',
	    ) ) );
	    //Important Links End
}
add_action( 'customize_register', 'foodland_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for foodland.
 * And flushes out all transient data on preview
 *
 * @since Foodland 0.2
 */
function foodland_customize_preview() {
	wp_enqueue_script( 'foodland_customizer', get_template_directory_uri() . '/js/foodland-customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients
	foodland_flush_transients();
}
add_action( 'customize_preview_init', 'foodland_customize_preview' );


//Active callbacks for customizer
require get_template_directory() . '/inc/customizer-includes/customizer-active-callbacks.php';

//Sanitize functions for customizer
require get_template_directory() . '/inc/customizer-includes/customizer-sanitize-functions.php';

// Load customizer theme pro link
require get_template_directory() . '/inc/customizer-includes/upgrade-to-pro/class-customize.php';

/**
 * Reset all settings to default
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Foodland 0.2
 */
function foodland_reset_all_settings( $input ) {

	$options = foodland_get_theme_options(); // get theme options

	if ( $options['reset_all_settings'] == 1 ) {
        // Set default values
        set_theme_mod( 'foodland_theme_options', foodland_get_default_theme_options() );

       // Remove background color and image
       remove_theme_mod( 'background_color' );
       remove_theme_mod( 'background_image' );
       remove_theme_mod( 'background_repeat' );
       remove_theme_mod( 'background_position_x' );
       remove_theme_mod( 'background_attachment' );

        // Remove header image
       remove_theme_mod( 'header_image' );
       remove_theme_mod( 'header_image_data' );

       //remove header text color
       remove_theme_mod( 'header_textcolor' );
       
        // Flush out all transients	on reset
        foodland_flush_transients();
    } 
    else {
        return false;
    }
}
add_action( 'customize_save_after', 'foodland_reset_all_settings' );