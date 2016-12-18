<?php
/**
 * The template for displaying Social Icons
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if ( ! function_exists( 'foodland_get_social_icons' ) ) :
/**
 * Generate social icons.
 *
 * @since Foodland 0.2
 */
function foodland_get_social_icons(){
	if( ( !$output = get_transient( 'foodland_social_icons' ) ) ) {
		$output	= '';

		$options 	= foodland_get_theme_options(); // Get options
		$disable_social_media = $options['disable_social_icon'];

		//Pre defined Social Icons Link Start
		$pre_def_social_icons 	=	foodland_get_social_icons_list();

		if( ! $disable_social_media ){
			$output .= '<div class="social-icons">';
			foreach ( $pre_def_social_icons as $key => $item ) {
				if( isset( $options[ $key ] ) && '' != $options[ $key ] ) {
					$value = $options[ $key ];

					if ( 'email_link' == $key  ) {
						$output .= '<a class="icon icon-border ' . sanitize_key( $item['label'] ) . ' soc-icons" target="_blank" title="' . esc_attr__( 'Email', 'foodland') . '" href="mailto:' . antispambot( sanitize_email( $value ) ) . '"><span class="genericon genericon-' . esc_attr( $item['genericon_class'] ) . '"></span>
							<span class="screen-reader-text">' . __( 'Email', 'foodland' ) . '</span></a>';
					}
					else if ( 'skype_link' == $key  ) {
						$output .= '<a class="icon icon-border '. sanitize_key( $item['label'] ) .' soc-icons" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="'. esc_attr( $value ) .'"><span class="genericon genericon-'. esc_attr( $item['genericon_class'] ). '"></span> 
							<span class="screen-reader-text">' . __( 'Skype', 'foodland' ) . '</span></a>';
					}
					else if ( 'phone_link' == $key || 'handset_link' == $key ) {
						$output .= '<a class="icon icon-border '. sanitize_key( $item['label'] ) .' soc-icons" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="tel:' . preg_replace( array('/\s+/', '/\D+/' ), '', esc_attr( $value ) ) . '"><span class="genericon genericon-'. esc_attr( $item['genericon_class'] ) . '"></span> 
							<span class="screen-reader-text">' . esc_attr( $item['label'] ) . '</span></a>';
					}
					else {
						$output .= '<a class="icon icon-border '. sanitize_key( $item['label'] )  .' soc-icons" target="_blank" title="'. esc_attr( $item['label'] ) .'" href="'. esc_url( $value ) .'"><span class="genericon genericon-'. esc_attr( $item['genericon_class'] ) . '"></span> 
							<span class="screen-reader-text">' . esc_attr( $item['label'] ) . '</span></a>';
					}
				}
			}
			//Pre defined Social Icons Link End
			
			$output .= '</div><!-- .social-icons -->';
		}
		//Custom Social Icons Link End
		set_transient( 'foodland_social_icons', $output, 86940 );
	}

	return $output;
} 
endif; // foodland_get_social_icons
