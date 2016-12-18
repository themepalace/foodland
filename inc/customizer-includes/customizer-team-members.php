<?php
/**
 * The template for adding Staff member Options in Customizer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

// Staff member section starts

	$wp_customize->add_section( 'foodland_staff_members', array(
		'priority' 			=> 500,
		'title'    			=> __( 'Staff Member Options', 'foodland' ),
	) );

	$wp_customize->add_setting( 'foodland_theme_options[staff_member_option_on]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['staff_member_option_on'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$staff_member_content_options = foodland_section_control_options();
	$choices = array();
	foreach ( $staff_member_content_options as $staff_member_content_option ) {
		$choices[$staff_member_content_option['value']] = $staff_member_content_option['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[staff_member_option_on]', array(
		'label'    			=> __( 'Enable Staff Member Section on', 'foodland' ),
		'priority' 			=> '10',
		'section'  			=> 'foodland_staff_members',
		'settings' 			=> 'foodland_theme_options[staff_member_option_on]',
		'type'     			=> 'select',
		'choices'  			=> $choices,
	) );

	$wp_customize->add_setting( 'foodland_theme_options[sfaff_member_title]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['sfaff_member_title'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'foodland_theme_options[sfaff_member_title]' , array(
		'active_callback' 	=> 'foodland_is_staff_member_active',
		'label'           	=> __( 'Title', 'foodland' ),
		'priority'        	=> '20',
		'section'         	=> 'foodland_staff_members',
		'settings'        	=> 'foodland_theme_options[sfaff_member_title]',
	) );

	$wp_customize->add_setting( 'foodland_theme_options[staff_member_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['staff_member_type'],
		'sanitize_callback' => 'foodland_sanitize_select',
	) );

	$staff_member_content_options = foodland_staff_member_section_type();
	$choices = array();
	foreach ( $staff_member_content_options as $staff_member_content_option ) {
		$choices[$staff_member_content_option['value']] = $staff_member_content_option['label'];
	}

	$wp_customize->add_control( 'foodland_theme_options[staff_member_type]', array(
		'active_callback' 	=> 'foodland_is_staff_member_active',
		'label'           	=> __( 'Select Section Type', 'foodland' ),
		'priority'        	=> '35',
		'section'         	=> 'foodland_staff_members',
		'settings'        	=> 'foodland_theme_options[staff_member_type]',
		'type'            	=> 'select',
		'choices'         	=> $choices,
	) );

    //loop for featured image content
	for ( $i=1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( 'foodland_theme_options[staff_member_note_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( new Foodland_Note_Control( $wp_customize, 'foodland_theme_options[staff_member_note_'. $i .']', array(
			'active_callback' 	=> 'foodland_is_staff_member_active',
			'label'           	=> __( 'Staff Member #', 'foodland' ) . $i,
			'priority'        	=> '50'.'.'.$i,
			'section'         	=> 'foodland_staff_members',
			'settings'        	=> 'foodland_theme_options[staff_member_note_'. $i .']',
			'type'            	=> 'description',
   		) ) );

		$wp_customize->add_setting( 'foodland_theme_options[staff_member_post_id_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'foodland_sanitize_number_range',
		) );


		$wp_customize->add_control( 'foodland_theme_options[staff_member_post_id_'. $i .']', array(
			'active_callback' => 'foodland_is_staff_member_active',
			'label'           => __( 'Post ID', 'foodland' ),
			'description'     => __( 'Enter staff member post ID.', 'foodland' ),
			'priority'        =>  '50' .'.'. $i. $i. $i,
			'section'         => 'foodland_staff_members',
			'settings'        => 'foodland_theme_options[staff_member_post_id_'. $i .']',
			'type'            => 'number',
			'input_attrs'     => array(
				'min'	=> 0
			)
		) );
	}
// Staff member section End