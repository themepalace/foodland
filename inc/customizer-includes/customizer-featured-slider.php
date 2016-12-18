<?php
/**
 * The template for adding Featured Slider Options in Customizer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

// Featured Slider
	$wp_customize->add_section( 'foodland_featured_slider_section', array(
		'priority'      	=> 150,
		'title'				=> __( 'Featured Slider Options', 'foodland' ),
		'description'		=> __( 'Minimum 3 featured page # should be selected for proper functioning of  slider.', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_slider_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_option'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$featured_slider_content_options = foodland_section_control_options();
	$choices = array();
	foreach ( $featured_slider_content_options as $featured_slider_content_option ) {
		$choices[$featured_slider_content_option['value']] = $featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[featured_slider_option]', array(
		'choices'   		=> $choices,
		'label'    			=> __( 'Enable Slider on', 'foodland' ),
		'priority'			=> '10',
		'section'  			=> 'foodland_featured_slider_section',
		'settings' 			=> 'foodland_theme_options[featured_slider_option]',
		'type'    			=> 'select',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_slide_transition_delay]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_delay'],
		'sanitize_callback'	=> 'foodland_sanitize_number_range',
	) );

	$wp_customize->add_control( 'foodland_theme_options[featured_slide_transition_delay]' , array(
		'active_callback' 	=> 'foodland_is_feature_slider_active',
		'input_attrs'     	=> array(
			'min'          	=> 1,
			'max'			=> 5,
			'style'        	=> 'width: 60px;'
		),
		'label'           	=> __( 'Transition Delay', 'foodland' ),
		'description'  		=> __( 'Max. transition delay is 5 Sec.', 'foodland' ),
		'priority'        	=> '20',
		'section'         	=> 'foodland_featured_slider_section',
		'settings'        	=> 'foodland_theme_options[featured_slide_transition_delay]',
		'type'            	=> 'number',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_slide_transition_length]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_length'],
		'sanitize_callback'	=> 'foodland_sanitize_number_range',
	) );

	$wp_customize->add_control( 'foodland_theme_options[featured_slide_transition_length]' , array(
		'active_callback' 	=> 'foodland_is_feature_slider_active',
		'description'  		=> __( 'Max. transition length is 5 Sec.', 'foodland' ),
		'input_attrs'     	=> array(
			'min'          	=> 1,
			'max'			=> 5,
			'style'        	=> 'width: 60px;'
		),
		'label'           	=> __( 'Transition Length', 'foodland' ),
		'priority'        	=> '30',
		'section'         	=> 'foodland_featured_slider_section',
		'settings'        	=> 'foodland_theme_options[featured_slide_transition_length]',
		'type'            	=> 'number',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[featured_slide_number]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_number'],
		'sanitize_callback'	=> 'foodland_sanitize_number_range',
	) );

	$wp_customize->add_control( 'foodland_theme_options[featured_slide_number]' , array(
		'active_callback' 	=> 'foodland_is_feature_slider_active',
		'description'     	=> __( 'Save and refresh the page if No. of Slides is changed. Max no of slides is 6 and recommended no of slides is 3.', 'foodland' ),
		'input_attrs'     	=> array(
		'style'           	=> 'width: 45px;',
			'min'          	=> 3,
			'max'          	=> 6,
		),
		'label'           	=> __( 'No of Slides', 'foodland' ),
		'priority'        	=> '40',
		'section'         	=> 'foodland_featured_slider_section',
		'settings'        	=> 'foodland_theme_options[featured_slide_number]',
		'type'            	=> 'number',
	) );
	
	$wp_customize->add_setting( 'foodland_theme_options[featured_slider_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_type'],
		'sanitize_callback'	=> 'foodland_sanitize_select',
	) );

	$featured_slider_types = foodland_featured_slider_types();
	$choices = array();

	foreach ( $featured_slider_types as $featured_slider_type ) {
		$choices[$featured_slider_type['value']] = $featured_slider_type['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[featured_slider_type]', array(
		'active_callback' 	=> 'foodland_is_feature_slider_active',
		'choices'         	=> $choices,
		'label'           	=> __( 'Select Slider Type', 'foodland' ),
		'priority'        	=> '50',
		'section'         	=> 'foodland_featured_slider_section',
		'settings'        	=> 'foodland_theme_options[featured_slider_type]',
		'type'            	=> 'select',
	) );

	for ( $i=1; $i <=  $options['featured_slide_number'] ; $i++ ) {

		$wp_customize->add_setting( 'foodland_theme_options[featured_slider_page_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'foodland_sanitize_page',
			'default' 			=> $options['dropdown_page_default'],
		) );

		$wp_customize->add_control( 'foodland_theme_options[featured_slider_page_'. $i .']', array(
			'active_callback' 	=> 'foodland_is_feature_slider_active',
			'label'           	=> __( 'Featured Page', 'foodland' ) . ' # ' . $i ,
			'description'		=> __( 'Recommended thumbnail size is 450px * 331px', 'foodland' ),
			'priority'        	=> '6' . $i,
			'section'         	=> 'foodland_featured_slider_section',
			'settings'        	=> 'foodland_theme_options[featured_slider_page_'. $i .']',
			'type'            	=> 'dropdown-pages',
		) );
	}

	$wp_customize->add_setting( 'foodland_theme_options[link_button_text]', array(
		'capability'        => 'edit_theme_options',
		'default'			=> $defaults['link_button_text'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control(  'foodland_theme_options[link_button_text]', array(
		'active_callback' 	=> 'foodland_is_feature_slider_active',
		'label'           	=> __( 'Link Button Text', 'foodland' ),
		'description'		=> __( 'Leave empty to remove link button', 'foodland' ),
		'priority'        	=> '70',
		'section'         	=> 'foodland_featured_slider_section',
		'settings'        	=> 'foodland_theme_options[link_button_text]',
		'type'            	=> 'text',
	) );
// Featured Slider End