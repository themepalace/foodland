<?php
/**
 * The template for adding Customizer Custom Controls
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */
	
// Custom control for multiple category select
class Foodland_Customize_Multiple_Categories_Control extends WP_Customize_Control {
	public $type = 'dropdown-categories';

	public $name;

	public function render_content() {
		$dropdown = wp_dropdown_categories(
			array(
				'name'             => $this->name,
				'echo'             => 0,
				'hide_empty'       => false,
				'show_option_none' => false,
				'hide_if_empty'    => false,
			)
		);

		$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:95px;" ' . $this->get_link(), $dropdown );

		printf(
			'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
			esc_html( $this->label ),
			$dropdown
		);

		echo '<p class="description">'. __( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'foodland' ) . '</p>';
	}
}


// Custom control for any note, use label as output description
class Foodland_Note_Control extends WP_Customize_Control {
	public $type = 'description';

	public function render_content() {
		echo '<h2 class="description">' . esc_html( $this->label ) . '</h2>';
	}
}

// Custom control for dropdown category multiple select
class Foodland_Important_Links extends WP_Customize_Control {
    public $type = 'important-links'; 
    
    public function render_content() {
    	//Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links
        $important_links = array(
			'theme_instructions' => array( 
				'link'	=> esc_url( 'http://themepalace.com/theme-instructions/foodland/' ),
				'text' 	=> __( 'Theme Instructions', 'foodland' ),
				),
			'support' => array( 
				'link'	=> esc_url( 'http://themepalace.com/forum/foodland/' ),
				'text' 	=> __( 'Support', 'foodland' ),
				),
			);
		foreach ( $important_links as $important_link) {
			echo '<p><a target="_blank" href="' . esc_url( $important_link['link'] ).'" >' . esc_attr( $important_link['text'] ) .' </a></p>';
		}
    }
}


// Custom control for dropdown category nova menu items
class Foodland_Customize_Dropdown_Nova_Menu extends WP_Customize_Control {
	public $type = 'nova-menu';

	public $name;

	public function render_content() {

		// get post array from nova_menu_post type 
		$nova_menu_posts = get_posts( array(
            'post_type'  => 'nova_menu_item',
            'numberposts' => -1
   		) );

		if( ! $nova_menu_posts ) return;

	    $display = '<select '. $this->get_link().'>';

	    //default option
	    $display .= '<option value="0">' . __( '-- Select Menu item --', 'foodland') . '</option>';
	    foreach( $nova_menu_posts as $nova_menu_post )
	    {
	        $display .= '<option  value="' .  $nova_menu_post->ID . '">' . esc_html( $nova_menu_post->post_title ) . '</option>';
	    }
	    $display .= '</select>';
		printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				 esc_html( $this->label ),
				$display
		);
	}
}