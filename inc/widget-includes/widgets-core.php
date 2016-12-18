<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Foodland 0.2
 */
function foodland_widgets_init() {
	$footer_sidebar_number = 4; //Number of footer sidebars

	for( $i=1; $i <= $footer_sidebar_number; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( __( 'Footer Area %d', 'foodland' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></section><!-- #widget-default-search -->',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'description'	=> sprintf( __( 'Footer %d widget area.', 'foodland' ), $i ),
		) );
	}
}
add_action( 'widgets_init', 'foodland_widgets_init' );

/**
 * Load foodland featured post widget
 */
require get_template_directory() . '/inc/widget-includes/featured-post-widget.php';


/**
 * Register Widgets
 *
 * @since Foodland 0.2
 */
function foodland_register_widgets() {
	register_widget( 'Foodland_featured_post_widget' );
}
add_action( 'widgets_init', 'foodland_register_widgets' );