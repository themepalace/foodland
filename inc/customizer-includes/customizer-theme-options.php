<?php
/**
 * The template for adding additional theme options in Customizer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

//Theme Options
	$wp_customize->add_panel( 'foodland_theme_options', array(
		'description' 		=> __( 'Basic theme Options', 'foodland' ),
		'capability'  		=> 'edit_theme_options',
		'priority'    		=> 700,
		'title'       		=> __( 'Theme Options', 'foodland' ),
	) );
   	
   	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
   	// Custom CSS Option
	$wp_customize->add_section( 'foodland_custom_css', array(
		'description'		=> __( 'Custom/Inline CSS', 'foodland'),
		'panel'  			=> 'foodland_theme_options',
		'priority' 			=> 203,
		'title'    			=> __( 'Custom CSS Options', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[custom_css]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['custom_css'],
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	) );

	$wp_customize->add_control( 'foodland_theme_options[custom_css]', array(
		'label'				=> __( 'Enter Custom CSS', 'foodland' ),
        'priority'			=> 1,
		'section'   		=> 'foodland_custom_css',
        'settings'  		=> 'foodland_theme_options[custom_css]',
		'type'				=> 'textarea',
	) );
   	// Custom CSS End
	}

	//social icons starts
	$wp_customize->add_section( 'foodland_social_links', array(
		'panel'				=> 'foodland_theme_options',
		'priority' 			=> 217,
		'title'   	 		=> __( 'Social Links', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[disable_social_icon]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['disable_social_icon'],
		'sanitize_callback'	=> 'foodland_sanitize_checkbox',
	) );

	$wp_customize->add_control(  'foodland_theme_options[disable_social_icon]', array(
		'label'				=> __( 'Check to Disable Footer Social Media Icons', 'foodland' ),
		'priority'			=> '1',
		'section'   		=> 'foodland_social_links',
		'settings'  		=> 'foodland_theme_options[disable_social_icon]',
		'type'				=> 'checkbox',
	) );

	$foodland_social_icons 	=	foodland_get_social_icons_list();

	foreach ( $foodland_social_icons as $key => $value ){
		if( 'skype_link' == $key ){
			$wp_customize->add_setting( 'foodland_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'sanitize_text_field',
				) );

			$wp_customize->add_control( 'foodland_theme_options['. $key .']', array(
				'active_callback' 		=> 'foodland_is_footer_social_links_active',
				'label'           		=> $value['label'],
				'description'     		=> __( 'Skype link can be of formats:<br>callto://+{number}<br> skype:{username}?{action}. More Information in readme file', 'foodland' ),
				'section'         		=> 'foodland_social_links',
				'settings'        		=> 'foodland_theme_options['. $key .']',
				'type'            		=> 'text',
			) );
		}
		else if( 'email_link' == $key ){
			$wp_customize->add_setting( 'foodland_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'sanitize_email',
				) );

			$wp_customize->add_control( 'foodland_theme_options['. $key .']', array(
				'active_callback' 		=> 'foodland_is_footer_social_links_active',
				'label'           		=> $value['label'],
				'section'         		=> 'foodland_social_links',
				'settings'        		=> 'foodland_theme_options['. $key .']',
				'type'            		=> 'email',
			) );
		}
		else if( 'handset_link' == $key || 'phone_link' == $key ){
			$wp_customize->add_setting( 'foodland_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'sanitize_text_field',
				) );

			$wp_customize->add_control( 'foodland_theme_options['. $key .']', array(
				'active_callback' 		=> 'foodland_is_footer_social_links_active',
				'label'    				=> $value['label'],
				'section'  				=> 'foodland_social_links',
				'settings' 				=> 'foodland_theme_options['. $key .']',
				'type'	   				=> 'text',
			) );
		}
		else {
			$wp_customize->add_setting( 'foodland_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'esc_url_raw',
				) );

			$wp_customize->add_control( 'foodland_theme_options['. $key .']', array(
				'active_callback' 		=> 'foodland_is_footer_social_links_active',
				'label'           		=> $value['label'],
				'section'         		=> 'foodland_social_links',
				'settings'        		=> 'foodland_theme_options['. $key .']',
				'type'            		=> 'url',
			) );
		}
	}
	// Social Icons End
	// Scrollup
	$wp_customize->add_section( 'foodland_scrollup', array(
		'panel'    			=> 'foodland_theme_options',
		'priority' 			=> 218,
		'title'    			=> __( 'Scrollup Options', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[enable_scrollup]', array(
		'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['enable_scrollup'],
		'sanitize_callback' => 'foodland_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'foodland_theme_options[enable_scrollup]', array(
		'label'				=> __( 'Check to enable Scroll Up', 'foodland' ),
		'section'   		=> 'foodland_scrollup',
        'settings'  		=> 'foodland_theme_options[enable_scrollup]',
		'type'				=> 'checkbox',
	) );
	// Scrollup End
//Theme Option End