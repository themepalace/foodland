<?php
/**
 * The template for adding Featured Content Settings in Customizer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

// Featured Content
	$wp_customize->add_section( 'foodland_featured_content_settings', array(
		'priority'      	=> 400,
		'title'				=> __( 'Featured Content Options', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_content_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_option'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$foodland_featured_slider_content_options = foodland_section_control_options();
	$choices = array();
	foreach ( $foodland_featured_slider_content_options as $foodland_featured_slider_content_option ) {
		$choices[$foodland_featured_slider_content_option['value']] = $foodland_featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[featured_content_option]', array(
		'choices'  			=> $choices,
		'label'    			=> __( 'Enable Featured Content on', 'foodland' ),
		'priority'			=> '1',
		'section'  			=> 'foodland_featured_content_settings',
		'settings' 			=> 'foodland_theme_options[featured_content_option]',
		'type'	  			=> 'select',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_content_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_type'],
		'sanitize_callback'	=> 'foodland_sanitize_select',
	) );

	$foodland_featured_content_types = foodland_featured_content_types();
	$choices = array();

	foreach ( $foodland_featured_content_types as $foodland_featured_content_type ) {
		$choices[$foodland_featured_content_type['value']] = $foodland_featured_content_type['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[featured_content_type]', array(
		'active_callback' 	=> 'foodland_is_featured_content_active',
		'choices'         	=> $choices,
		'label'           	=> __( 'Select Featured Content Type', 'foodland' ),
		'priority'        	=> '3',
		'section'         	=> 'foodland_featured_content_settings',
		'settings'        	=> 'foodland_theme_options[featured_content_type]',
		'type'            	=> 'select',
	) );

	//loop for featured post content
	for ( $i=1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( 'foodland_theme_options[featured_content_page_'. $i .']', array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback'	=> 'foodland_sanitize_page',
			'default'			=> $defaults['dropdown_page_default'],
		) );

		$wp_customize->add_control( 'foodland_featured_content_page_'. $i .'', array(
			'active_callback' 	=> 'foodland_is_featured_content_active',
			'label'           	=> __( 'Featured Page', 'foodland' ) . ' ' . $i ,
			'priority'        	=> '5' . $i,
			'section'         	=> 'foodland_featured_content_settings',
			'settings'        	=> 'foodland_theme_options[featured_content_page_'. $i .']',
			'type'            	=> 'dropdown-pages',
		) );
	}
// Featured Content Setting End