<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

/**
 * Returns the default options for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_get_default_theme_options() {

	$default_theme_options = array(
		//Site Title an Tagline
		'logo'                                            => get_template_directory_uri() . '/images/logo.png',
		'logo_alt_text'                                   => '',

		//Header Image
		'enable_featured_header_image'                    => 'disabled',
		'featured_header_image_url'                       => '',
		'featured_header_image_alt'                       => '',
		'featured_header_image_base'                      => 0,

		//site title Color Options
		'site_title_tagline_color'						  => '#000000',
		'header_nav_menu_color'							  => '#000000',

		// Dropdown page default
		'dropdown_page_default' 						  => 0,

		//Featured Slider Options
		'featured_slider_option'                          => 'disabled',
		'featured_slide_transition_delay'                 => '4',
		'featured_slide_transition_length'                => '1',
		'featured_slider_type'                            => 'featured-page-slider',
		'featured_slide_number'                           => '6',
		'link_button_text'								  => __( 'Order Now', 'foodland' ),

		//Promotional Headline option
		'enable_promotional_headline_on'				  => 'disabled',
		'promotional_headline_type'						  => 'page-headline',
		
		'promotional_headline_page'						  => '0',
		'promotional_headline_button_text'				  => __( 'Read More', 'foodland'),

		//Todays Special Options
		'show_todays_special_on'					  	  => 'disabled',
		'todays_special_title'							  => __( 'menus todays special', 'foodland' ),
		'todays_special_type'							  => 'featured-food-menus',
		'todays_special_nova_menu_item'					  => 0,
		'todays_special_banner_url'						  => '#',

		//Homepage / Frontpage Options
		'disable_blog_options'						  	  => 0,
		'front_page_title'								  => __( 'Latest News', 'foodland' ),
		'front_page_category'                             => array(),
		'front_page_no_of_posts'						  => 5,
		'front_page_button_label'						  => __( 'Browse More', 'foodland'),
		'front_page_browse_url'							  => '',

		//Featured Content Options
		'featured_content_option'                         => 'disabled',
		'featured_content_type'                           => 'featured-page-content',
		
		//Staff Member Options
		'staff_member_option_on'						  => 'disabled',
		'sfaff_member_title' 							  => __( 'People who knows your appetite ', 'foodland'),
		'staff_member_type'								  => 'staff-member-from-post',

		//Theme options starts

		//Font Family Options
		'title_font'                                      => 'sans-serif',
		'tagline_font'                                    => 'sans-serif',
		'headings_font'                                   => 'sans-serif',
		'reset_typography'                                => 0,

		//Custom CSS
		'custom_css'                                      => '',
		'enable_scrollup'								  => false,	

		//Social Links
		'disable_social_icon'							  => 1,

		//Reset all settings
		'reset_all_settings'                              => 0,

		//Theme options ends
	);

	return apply_filters( 'foodland_default_theme_options', $default_theme_options );
}

/**
 * Returns an array of content and control options registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_section_control_options() {
	$section_control_options = array(
		'homepage'    => array(
			'value'       => 'homepage',
			'label'       => __( 'Static Homepage / Frontpage', 'foodland' ),
		),
	
		'disabled'    => array(
			'value'       => 'disabled',
			'label'       => __( 'Disabled', 'foodland' ),
		),
	);

	return apply_filters( 'foodland_section_control_options', $section_control_options );
}

/**
 * Returns an array of feature header enable options
 *
 * @since Foodland 0.2
 */
function foodland_enable_featured_header_image_options() {
	$enable_featured_header_image_options = array(
		'homepage'     => array(
			'value'        => 'homepage',
			'label'        => __( 'Homepage / Frontpage', 'foodland' ),
		),
		'disabled'     => array(
			'value'        => 'disabled',
			'label'        => __( 'Disabled', 'foodland' ),
		),
	);

	return apply_filters( 'foodland_enable_featured_header_image_options', $enable_featured_header_image_options );
}

/**
 * Returns an array of feature slider types registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_featured_slider_types() {
	$featured_slider_types = array(
		'featured-page-slider'     => array(
			'value'                    => 'featured-page-slider',
			'label'                    => __( 'Featured Page Slider', 'foodland' ),
		),
	);

	return apply_filters( 'foodland_featured_slider_types', $featured_slider_types );
}

/**
 * Returns an array of promotional headline type options registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_promotional_headline_type() {
	$promotion_headline_type = array(
		'page-headline'   => array(
			'value'           => 'page-headline',
			'label'           => __( 'Page', 'foodland' ),
		),
	);

	return apply_filters( 'foodland_promotional_headline_type', $promotion_headline_type );
}

/**
 * Returns an array of content and control options registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_todays_special_type() {
	$todays_special_type = array(
		'featured-food-menus' => array(
			'value'                   => 'featured-food-menus',
			'label'                   => __( 'Today Special Food Menus', 'foodland' ),
		),
	);

	return apply_filters( 'foodland_todays_special_type', $todays_special_type );
}

/**
 * Returns an array of feature content types registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_featured_content_types() {
	$featured_content_types = array(
		'featured-page-content'  => array(
			'value'                  => 'featured-page-content',
			'label'                  => __( 'Featured Page Content', 'foodland' ),
		),
	);
	return apply_filters( 'foodland_featured_content_types', $featured_content_types );
}

/**
 * Returns an array of content and control options registered for Staff member section.
 *
 * @since Foodland 0.2
 */
function foodland_staff_member_section_type() {
	$staff_member_section_type = array(
		'staff-member-from-post' => array(
			'value'                       => 'staff-member-from-post',
			'label'                       => __( 'Staff member from post', 'foodland' ),
		),
	);

	return apply_filters( 'foodland_staff_member_section_type', $staff_member_section_type );
}

/**
 * Returns list of social icons currently supported
 *
 * @since Foodland 0.2
*/
function foodland_get_social_icons_list() {
	$foodland_social_icons_list = array(
		'facebook_link'		=> array(
			'genericon_class' 	=> 'facebook-alt',
			'label' 			=> esc_html__( 'Facebook', 'foodland' )
			),
		'twitter_link'		=> array(
			'genericon_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'foodland' )
			),
		'email_link'		=> array(
			'genericon_class' 	=> 'mail',
			'label' 			=> esc_html__( 'Email', 'foodland' )
			),
		'linkedin_link'		=> array(
			'genericon_class' 	=> 'linkedin',
			'label' 			=> esc_html__( 'LinkedIn', 'foodland' )
			),
		'youtube_link'		=> array(
			'genericon_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'foodland' )
			),
		'skype_link'		=> array(
			'genericon_class' 	=> 'skype',
			'label' 			=> esc_html__( 'Skype', 'foodland' )
			),

		'dropbox_link'		=> array(
			'genericon_class' 	=> 'dropbox',
			'label' 			=> esc_html__( 'DropBox', 'foodland' ),
			),
		'website_link'		=> array(
			'genericon_class' 	=> 'website',
			'label' 			=> esc_html__( 'Website', 'foodland' ),
			),
		'phone_link'		=> array(
			'genericon_class' 	=> 'phone',
			'label' 			=> esc_html__( 'Phone', 'foodland' ),
			),
		'handset_link'		=> array(
			'genericon_class' 	=> 'handset',
			'label' 			=> esc_html__( 'Handset', 'foodland' ),
		),
	);

	return apply_filters( 'foodland_social_icons_list', $foodland_social_icons_list );
}

/**
 * Returns an array of metabox Nova items Rating Options registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_metabox_nova_item_rating() {
	$nova_rating = array(
		'one-star'    => array(
			'id'          => 'foodland-nova-item-rating',
			'value'       => '1',
			'label'       => __( 'One Star', 'foodland' ),
		),
		'two-stars'   => array(
			'id'          => 'foodland-nova-item-rating',
			'value'       => '2',
			'label'       => __( 'Two Stars', 'foodland' ),
		),
		'three-stars' => array(
			'id'          => 'foodland-nova-item-rating',
			'value'       => '3',
			'label'       => __( 'Three Stars', 'foodland' ),
		),
		'four-stars'  => array(
			'id'          => 'foodland-nova-item-rating',
			'value'       => '4',
			'label'       => __( 'Four Stars', 'foodland' ),
		),
		'five-stars'  => array(
			'id'          => 'foodland-nova-item-rating',
			'value'       => '5',
			'label'       => __( 'Five Stars', 'foodland' ),
		),
	);
	return apply_filters( 'foodland_nova_item_rating', $nova_rating );
}
/**
 * Returns an array of metabox header featured image options registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_metabox_header_featured_image_options() {
	$header_featured_image_options = array(
		'default' => array(
			'id'      => 'foodland-header-image',
			'value'   => 'default',
			'label'   => __( 'Default', 'foodland' ),
		),
		'enable'  => array(
			'id'      => 'foodland-header-image',
			'value'   => 'enable',
			'label'   => __( 'Enable', 'foodland' ),
		),
		'disable' => array(
			'id'      => 'foodland-header-image',
			'value'   => 'disable',
			'label'   => __( 'Disable', 'foodland' )
		)
	);
	return apply_filters( 'header_featured_image_options', $header_featured_image_options );
}

/**
 * Returns an array of metabox featured image options registered for foodland.
 *
 * @since Foodland 0.2
 */
function foodland_metabox_featured_image_options() {
	$featured_image_options = array(
		'default'      => array(
			'id'           => 'foodland-featured-image',
			'value'        => 'default',
			'label'        => __( 'Default', 'foodland' ),
		),
		'header-image' => array(
			'id'           => 'foodland-featured-image',
			'value'        => 'header-image',
			'label'        => __( 'Header Image', 'foodland' )
		),
		'full'         => array(
			'id'           => 'foodland-featured-image',
			'value'        => 'full',
			'label'        => __( 'Full Image', 'foodland' )
		),
		'disable'      => array(
			'id'           => 'foodland-featured-image',
			'value'        => 'disable',
			'label'        => __( 'Disable Image', 'foodland' )
		)
	);
	return apply_filters( 'featured_image_options', $featured_image_options );
}

/**
 * Checks if there are options already present from foodland free version and adds it to the foodland Pro theme options
 *
 * @since Foodland 0.2
 * @hook after_theme_switch
 */
function foodland_setup_options() {
	//Perform action only if theme_mods_food-land-pro[foodland_theme_options] does not exist
	if( !get_theme_mod( 'foodland_theme_options' ) ) {
		//Perform action only if theme_mods_food-land free version exists
		if ( $foodland_free_options = get_option ( 'theme_mods_food-land' ) ) {
			if ( isset( $foodland_free_options['foodland_theme_options'] ) ) {
				$foodland_pro_default_options = foodland_get_default_theme_options();

				$foodland_theme_options = $foodland_free_options;

				$foodland_theme_options['foodland_theme_options'] = array_merge( $foodland_pro_default_options , $foodland_free_options['foodland_theme_options'] );

				update_option( 'theme_mods_food-land-pro', $foodland_theme_options );
			}
		}
	}
}

add_action('after_switch_theme', 'foodland_setup_options');
