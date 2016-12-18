<?php
/**
* Function to romove markup of nova menu from jetpack
*
* @since Foodland 0.2
*/

function foodland_remove_nova_markup() {
        if ( class_exists( 'Nova_Restaurant' ) ) {
            remove_filter( 'template_include', array( Nova_Restaurant::init(), 'setup_menu_item_loop_markup__in_filter' ) );
        }
}
add_action( 'wp', 'foodland_remove_nova_markup' );

function foodland_sort_menu_item_queries_by_menu_order( $query ) {
	if ( (
			( isset( $query->query_vars['taxonomy'] ) && Nova_Restaurant::MENU_TAX == $query->query_vars['taxonomy'] )
	||
	( isset( $query->query_vars['post_type'] ) && Nova_Restaurant::MENU_ITEM_POST_TYPE == $query->query_vars['post_type'] ) ) &&
	isset( $query->query_vars['_widget_flag'] ) && $query->query_vars['_widget_flag']
	) {
		$query->query_vars['posts_per_page'] =  $query->query_vars['_posts_per_page'];

	}
}
add_action( 'parse_query', 'foodland_sort_menu_item_queries_by_menu_order',11 );