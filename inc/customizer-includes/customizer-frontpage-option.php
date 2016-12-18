<?php
/**
 * The template for Static Front page options in Customizer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

// Homepage / Frontpage Options
$options = foodland_get_theme_options(); // get values from theme options

	$wp_customize->add_section( 'foodland_static_frontpage', array(
		'priority' 			=> 300,
		'title'    			=> __( 'Frontpage Blog Options', 'foodland' ),
		'description'		=> __( 'Controls for Frontpage Blog Section', 'foodland' ),
	) );
	
	// Title control for homepage
	$wp_customize->add_setting( 'foodland_theme_options[disable_blog_options]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['disable_blog_options'],
		'sanitize_callback'	=> 'foodland_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'foodland_theme_options[disable_blog_options]', array(
        'label'   			=> __( 'Check to Disable blog options', 'foodland' ),
		'priority'			=> '4',
        'section'  			=> 'foodland_static_frontpage',
        'settings' 			=> 'foodland_theme_options[disable_blog_options]',
        'type'     			=> 'checkbox',
    ) );  
	// Homepage title option
	$wp_customize->add_setting( 'foodland_theme_options[front_page_title]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_title'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'foodland_theme_options[front_page_title]', array(
		'active_callback'	=> 'foodland_is_frontpage_blog_options_active',
		'label'           	=> __( 'Frontpage Title', 'foodland' ),
		'priority'        	=> '5',
		'section'         	=> 'foodland_static_frontpage',
		'settings'        	=> 'foodland_theme_options[front_page_title]',
		'type'            	=> 'text',
    ) );  

	//Homepage posts category
	$wp_customize->add_setting( 'foodland_theme_options[front_page_category]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_category'],
		'sanitize_callback'	=> 'foodland_sanitize_category_list',
	) );

	$wp_customize->add_control( new Foodland_Customize_Multiple_Categories_Control( $wp_customize, 'foodland_theme_options[front_page_category]', array(
        'active_callback'	=> 'foodland_is_frontpage_blog_options_active',
        'label'   			=> __( 'Select Categories', 'foodland' ),
        'name'	 			=> 'foodland_theme_options[front_page_category]',
		'priority'			=> '6',
        'section'  			=> 'foodland_static_frontpage',
        'settings' 			=> 'foodland_theme_options[front_page_category]',
        'type'     			=> 'dropdown-categories',
    ) ) );  

    // Homepage no of posts
	$wp_customize->add_setting( 'foodland_theme_options[front_page_no_of_posts]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_no_of_posts'],
		'sanitize_callback'	=> 'foodland_sanitize_number_range',
	) );

	$wp_customize->add_control( 'foodland_theme_options[front_page_no_of_posts]', array(
		'active_callback'	=> 'foodland_is_frontpage_blog_options_active',
		'label'           	=> __( 'No of Posts in Frontpage ', 'foodland' ),
		'description'		=> __( 'Max no of posts is 5', 'foodland' ),
		'priority'        	=> '7',
		'section'         	=> 'foodland_static_frontpage',
		'settings'        	=> 'foodland_theme_options[front_page_no_of_posts]',
		'type'            	=> 'number',
		'input_attrs'     	=> array(
			'min'          	=> 1,
			'max'			=> 5,
			'step'			=> 1,
			'style'        	=> 'width: 60px;'
		),
    ) );  

    // Homepage button label
	$wp_customize->add_setting( 'foodland_theme_options[front_page_button_label]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_button_label'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'foodland_theme_options[front_page_button_label]', array(
		'active_callback'	=> 'foodland_is_frontpage_blog_options_active',
		'label'           	=> __( 'Browse All Button Text', 'foodland' ),
		'priority'        	=> '8',
		'section'         	=> 'foodland_static_frontpage',
		'settings'        	=> 'foodland_theme_options[front_page_button_label]',
		'type'            	=> 'text',
    ) ); 

	// Homepage browse  link
	$wp_customize->add_setting( 'foodland_theme_options[front_page_browse_url]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_browse_url'],
		'sanitize_callback'	=> 'esc_url',
	) );

	$wp_customize->add_control( 'foodland_theme_options[front_page_browse_url]', array(
		'active_callback'	=> 'foodland_is_frontpage_blog_options_active',
		'label'           	=> __( 'Browse All Button Link', 'foodland' ),
		'priority'        	=> '9',
		'section'         	=> 'foodland_static_frontpage',
		'settings'        	=> 'foodland_theme_options[front_page_browse_url]',
		'type'            	=> 'url',
    ) );  

	//Homepage / Frontpage Options End