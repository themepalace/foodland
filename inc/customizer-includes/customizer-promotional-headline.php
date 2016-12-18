<?php
/**
 * The template for adding promotional headline Options in Customizer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

// Featured page starts
    $wp_customize->add_section( 'foodland_promotional_headline', array(
		'description'		=> __( 'Options for Promotional Headline', 'foodland' ),
		'priority' 			=> 200,
		'title'   	 		=> __( 'Promotional Headline Options', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[enable_promotional_headline_on]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_promotional_headline_on'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$promotional_options = foodland_section_control_options();
	$choices = array();
	foreach ( $promotional_options as $promotional_option ) {
		$choices[$promotional_option['value']] = $promotional_option['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[enable_promotional_headline_on]', array(
		'choices'  			=> $choices,
		'label'    			=> __( 'Enable on', 'foodland' ),
		'priority'			=> '1',
		'section'  			=> 'foodland_promotional_headline',
		'settings' 			=> 'foodland_theme_options[enable_promotional_headline_on]',
		'type'	  			=> 'select',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[promotional_headline_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['promotional_headline_type'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$foodland_promotional_headline_types = foodland_promotional_headline_type();
	$choices = array();
	foreach ( $foodland_promotional_headline_types as $foodland_promotional_headline_type ) {
		$choices[$foodland_promotional_headline_type['value']] = $foodland_promotional_headline_type['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[promotional_headline_type]', array(
		'active_callback' 	=> 'foodland_is_promotional_headline_active',
		'label'           	=> __( 'Promotional Headline Type', 'foodland' ),
		'priority'        	=> '2',
		'section'         	=> 'foodland_promotional_headline',
		'settings'        	=> 'foodland_theme_options[promotional_headline_type]',
		'type'            	=> 'select',
		'choices'         	=> $choices,
	) );

	$wp_customize->add_setting( 'foodland_theme_options[promotional_headline_page]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> 'promotional_headline_page',
		'sanitize_callback'	=> 'foodland_sanitize_page',
		) );

	$wp_customize->add_control( 'foodland_theme_options[promotional_headline_page]', array(
		'active_callback'	=> 'foodland_is_promotional_headline_active',
		'label'    			=> __( 'Select Page', 'foodland' ),
		'priority'			=> '3',
		'section'  			=> 'foodland_promotional_headline',
		'settings' 			=> 'foodland_theme_options[promotional_headline_page]',
		'type'	   			=> 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[promotional_headline_button_text]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotional_headline_button_text'],
		'sanitize_callback'	=> 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'foodland_theme_options[promotional_headline_button_text]', array(
		'active_callback' 	=> 'foodland_is_promotional_headline_active',
		'description'     	=> __( 'Appropriate Words: 3', 'foodland' ),
		'label'           	=> __( 'Link Button Text ', 'foodland' ),
		'priority'        	=> '6',
		'section'         	=> 'foodland_promotional_headline',
		'settings'        	=> 'foodland_theme_options[promotional_headline_button_text]',
		'type'            	=> 'text',
	) );
// Featured page ends