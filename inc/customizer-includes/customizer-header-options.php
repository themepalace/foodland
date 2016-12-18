<?php
/**
 * The template for adding Additional Header Option in Customizer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

// Header Options
	$wp_customize->add_setting( 'foodland_theme_options[enable_featured_header_image]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_featured_header_image'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$foodland_enable_featured_header_image_options = foodland_enable_featured_header_image_options();
	$choices = array();
	foreach ( $foodland_enable_featured_header_image_options as $foodland_enable_featured_header_image_option ) {
		$choices[$foodland_enable_featured_header_image_option['value']] = $foodland_enable_featured_header_image_option['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[enable_featured_header_image]', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Enable Featured Header Image on ', 'foodland' ),
			'section'   => 'header_image',
	        'settings'  => 'foodland_theme_options[enable_featured_header_image]',
	        'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_header_image_alt]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_alt'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'foodland_theme_options[featured_header_image_alt]', array(
			'label'		=> __( 'Featured Header Image Alt/Title Tag ', 'foodland' ),
			'section'   => 'header_image',
	        'settings'  => 'foodland_theme_options[featured_header_image_alt]',
	        'type'	  	=> 'text',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_header_image_url]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'foodland_theme_options[featured_header_image_url]', array(
			'label'		=> __( 'Featured Header Image Link URL', 'foodland' ),
			'section'   => 'header_image',
	        'settings'  => 'foodland_theme_options[featured_header_image_url]',
	        'type'	  	=> 'url',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_header_image_base]', array(
		'capability'		=> 'edit_theme_options',
		'default'	=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'foodland_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'foodland_theme_options[featured_header_image_base]', array(
		'label'    	=> __( 'Check to Open Link in New Window/Tab', 'foodland' ),
		'section'  	=> 'header_image',
		'settings' 	=> 'foodland_theme_options[featured_header_image_base]',
		'type'     	=> 'checkbox',
	) );	
// Header Options End