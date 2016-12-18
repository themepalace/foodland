<?php
/**
 * The template for adding Special menu Options in Customizer
 * 
 * Requires jetpack plugin
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if( class_exists( 'jetpack' ) ){
// Todays Special

	$options = foodland_get_theme_options(); // get values from theme options

	$wp_customize->add_section( 'foodland_todays_special', array(
		'priority' 			=> 300,
		'title'    			=> __( 'Today Special Options', 'foodland' ),
	) );

	// Special menu  control
	$wp_customize->add_setting( 'foodland_theme_options[show_todays_special_on]', array(
		'capability'        => 'edit_theme_options',
		'default'           => $defaults['show_todays_special_on'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$section_control_options = foodland_section_control_options();
	$choices = array();

	foreach ( $section_control_options as $section_control_option ) {
		$choices[$section_control_option['value']] = $section_control_option['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[show_todays_special_on]', array(
		'label'    			=> __( 'Enable Special Menu on', 'foodland' ),
		'priority' 			=> '1',
		'section'  			=> 'foodland_todays_special',
		'type'     			=> 'select',
		'choices'  			=> $choices,
	) );

	// Special menu title
	$wp_customize->add_setting( 'foodland_theme_options[todays_special_title]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['todays_special_title'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'foodland_theme_options[todays_special_title]', array(
		'active_callback' 	=> 'foodland_is_todays_special_menu_active',
		'label'           	=> __( 'Special Menu Title', 'foodland' ),
		'priority'        	=>  '2',
		'section'         	=> 'foodland_todays_special',
	) );

	// Special menu type
	$wp_customize->add_setting( 'foodland_theme_options[todays_special_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['todays_special_type'],
		'sanitize_callback'	=> 'foodland_sanitize_select',
	) );

	$todays_special_types = foodland_todays_special_type();
	$choices = array();

	foreach ( $todays_special_types as $todays_special_type ) {
		$choices[$todays_special_type['value']] = $todays_special_type['label'];
	}

	//check is jetpack is active
	if( ( 'featured-food-menus' == $options['todays_special_type'] ) && !class_exists('jetpack') ){
		$description  = sprintf( __( 'Food Menu requires ', 'foodland' ) .'<a target="_blank" href="'. esc_url( 'https://wordpress.org/plugins/jetpack/' ) .'">'. __( 'JetPack Plugin', 'foodland' ) . '</a>.' );
	}
	else{
		$description = __( 'Save and Refresh page if option is changed.', 'foodland' );
	}

	$wp_customize->add_control( 'foodland_theme_options[todays_special_type]' , array(
		'active_callback' 	=> 'foodland_is_todays_special_menu_active',
		'label'           	=> __( 'Special menu Type', 'foodland' ),
		'description'		=> $description,
		'priority'        	=> '4',
		'section'         	=> 'foodland_todays_special',
		'type'            	=> 'select',
		'choices'         	=> $choices,
	) );

	// Special menu select
	$no_of_menus = 6;

	for( $i = 1; $i <= $no_of_menus; $i++ ){
		$wp_customize->add_setting( 'foodland_theme_options[todays_special_nova_menu_item_'.$i.']', array(
			'capability'        => 'edit_theme_options',
			'default'			=> $defaults['todays_special_nova_menu_item'],
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( new Foodland_Customize_Dropdown_Nova_Menu( $wp_customize, 'foodland_theme_options[todays_special_nova_menu_item_'.$i.']', array(
			'active_callback' 	=> 'foodland_is_todays_special_menu_active',
			'label'           	=> __('Select Menu Item ', 'foodland' ).$i,
			'name'            	=> 'foodland_theme_options[todays_special_nova_menu_item_'.$i.']',
			'priority'        	=> '6'.'.'.$i,
			'section'         	=> 'foodland_todays_special',
			'type'            	=> 'nova-menu',
	    ) ) );	
	}

	// Special menu banner image
	$wp_customize->add_setting( 'foodland_theme_options[todays_special_menu_banner]', array(
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'absint',
	) );

	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'foodland_theme_options[todays_special_menu_banner]' , array(
		'active_callback' 		=> 'foodland_is_todays_special_menu_active',
		'label'           		=> __( 'Banner Image', 'foodland' ),
		'description'     		=> __( 'Preferred image size 570x380 px <br>Click Remove to Disable image field.', 'foodland' ),
		'priority'        		=> '7',
		'section'         		=> 'foodland_todays_special',
		'width'           		=> 570,
		'height'          		=> 380,
		'flex_width'      		=> false, // Allow any width, making the specified value recommended. False by default.
		'flex_height'     		=> false,
	) ) );

	// Banner image url
	$wp_customize->add_setting( 'foodland_theme_options[todays_special_banner_url]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['todays_special_banner_url'],
		'sanitize_callback'	=> 'esc_url',
	) );

	$wp_customize->add_control( 'foodland_theme_options[todays_special_banner_url]', array(
		'active_callback' 	=> 'foodland_is_todays_special_menu_active',
		'label'           	=> __( 'Banner link', 'foodland' ),
		'priority'        	=>  '8',
		'section'         	=> 'foodland_todays_special',
		'type'				=> 'url'
	) );


// todays special items ends
}