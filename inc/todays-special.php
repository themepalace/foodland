<?php
/**
 * The template for displaying the Today special section
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2 
 */

// Check today special status.
add_filter( 'foodland_filter_today_special_status', 'foodland_today_special_status' );

// Add today special to the theme.
add_action( 'foodland_before_content', 'foodland_add_today_special', 35 );

// Today special details.
add_filter( 'foodland_filter_today_special_details', 'foodland_get_today_special_details' );

if ( ! function_exists( 'foodland_get_today_special_details' ) ) :
    /**
     * Today special details.
     *
     * @since Foodland 0.2
     *
     * @param array $input today special details.
     */
    function foodland_get_today_special_details( $input ) {

        $options            = foodland_get_theme_options(); // get theme options        
        $today_special_type = $options[ 'todays_special_type' ];
        $no_of_menu_items   = 6;

        switch ( $today_special_type ) {
            case 'featured-food-menus' :
                // check if jetpack plugin is active
                if( class_exists( 'jetpack' ) ){
                    $ids = array();

                    // get valid post id
                    for ( $i = 1; $i <= $no_of_menu_items; $i++ ) {
                        $id  = ! empty( $options[ 'todays_special_nova_menu_item_' . $i ] ) ? $options[ 'todays_special_nova_menu_item_' . $i ] : '';
                        if ( ! empty( $id ) ) {
                            $ids[] = absint( $id );
                        }
                    }
                    // Bail if no valid posts are selected.
                    if ( empty( $ids ) ) {
                        return $input;
                    }

                    $qargs = array(
                        'post_type'     => 'nova_menu_item',
                        'post__in'       => $ids,
                        'orderby'        => 'post__in',
                        'posts_per_page' => absint( $no_of_menu_items ),
                    );

                    // Fetch posts.
                    $all_posts = get_posts( $qargs );
                    $today_special = array();

                    if ( ! empty( $all_posts ) ) {

                        $cnt = 0;
                        foreach ( $all_posts as $key => $post ) {
                            $today_special[ $cnt ]['food_item_name'] = $post->post_title;
                            $today_special[ $cnt ]['price']          = get_post_meta( $post->ID, 'nova_price', true );
                            $today_special[ $cnt ]['url']            = get_permalink( $post->ID );
                            $cnt++;
                        }
                    }
                    if ( ! empty( $today_special ) ) {
                        $input = $today_special;
                    }
                }
            break;

            default:
            break;
        }
        return $input ;
    }
endif;

if ( ! function_exists( 'foodland_add_today_special' ) ) :
    /**
     * Add today special.
     *
     * @since Foodland 0.2
     */
    function foodland_add_today_special() {

        $flag_apply_content = apply_filters( 'foodland_filter_today_special_status', false );
        if ( true !== $flag_apply_content ) {
            return false;
        }

        $content_details = array();
        $content_details = apply_filters( 'foodland_filter_today_special_details', $content_details );

        if ( empty( $content_details ) ) {
            return;
        }
        // Render today special now.
        foodland_render_today_special( $content_details );

    }
endif;

if ( ! function_exists( 'foodland_render_today_special' ) ) :
    /**
     * Render today special.
     *
     * @since Foodland 0.2
     *
     * @param array $content_details of today special.
     */
    function foodland_render_today_special( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        }

        $options            = foodland_get_theme_options();
        $today_special_type = $options['todays_special_type'];
      
        if( !empty( $options['todays_special_menu_banner'] ) ){
            $class = 'one-half ';
            $banner_image_id = absint( $options['todays_special_menu_banner'] );
            $banner_image = wp_get_attachment_image( $banner_image_id, array( 570,379 ) );
        }
        else{
            $class        = '';
            $banner_image = '';
        }

        if( ( ! $foodland_today_special = get_transient( 'foodland_special_product' ) ) ) {
            echo '<!-- refreshing cache -->';
            $foodland_today_special = '';

            $foodland_today_special .= '
            <section id="menu-items" class="menu-items">
                <div class="wrapper clear">';

                if( !empty( $options['todays_special_title'] ) ){
                    $foodland_today_special .= '<h2 class="upercase">'.esc_html( $options['todays_special_title'] ).'</h2>';
                }

                $foodland_today_special .= '
                    <div class="' . $class . 'menu-special">      
                        <div class="menu-table">';

                    $menu_index = 1;
                    foreach ( $content_details as $key => $food_item ):

                        $food_item_title = $food_item['food_item_name'];
                        $food_item_price = $food_item['price'];
                        $food_item_url   = $food_item['url'];

                        $foodland_today_special .= '
                            <div class="item-name-price clear">';

                            if( !empty( $food_item_title ) ){

                                $foodland_today_special .= '    <div class="item-name"><a href="'. esc_url( $food_item_url ).'">' . $menu_index . '. ' . esc_html( $food_item_title ).'</a></div><!-- .item-name -->';
                            }

                            if( !empty( $food_item_price ) ){
                                    $foodland_today_special .= ' <div class="item-price"><span>'.esc_html( $food_item_price ).'</span></div><!-- .item-price -->';
                            }

                        $foodland_today_special .= '
                            </div><!-- .item-name-price -->';
                    $menu_index ++;
                    endforeach;
                       
                    $foodland_today_special .= '
                        </div><!-- .menu-table -->
                    </div> <!-- .menu-special -->';

                if( !empty( $banner_image ) ) { 
                    $banner_link = !empty ( $options['todays_special_banner_url'] ) ? $options['todays_special_banner_url'] : '#';   

                    $foodland_today_special .= '
                    <div class="one-half">
                        <div class="single-image-wrap"><a href="' . esc_url( $banner_link ) . '">' . $banner_image . '</a>
                        </div> <!-- .single-image-wrap -->
                    </div><!-- .one-half -->';
                }

            $foodland_today_special .= '
                </div> <!-- .wrapper -->
            </section><!-- # menu-items -->';
                
            set_transient( 'foodland_special_product', $foodland_today_special, 86940 );
        }
        echo $foodland_today_special;
    }
endif;

if( ! function_exists( 'foodland_today_special_status' ) ) :
    /**
     * Check status of today special.
     *
     * @since Foodland 0.2
     */
    function foodland_today_special_status( $input ) {
        global $post, $wp_query;

        $options = foodland_get_theme_options();
        // today special status.
        $today_special_status = $options[ 'show_todays_special_on' ];

        // Get Page ID outside Loop.
        $page_id = $wp_query->get_queried_object_id();

        // Front page displays in Reading Settings.
        $page_on_front  = absint( get_option( 'page_on_front' ) );
        $page_for_posts = absint( get_option( 'page_for_posts' ) );

        switch ( $today_special_status ) {
            case 'homepage':
                if ( $page_on_front === $page_id && $page_on_front > 0 ) {
                    $input = true;
                }
                break;

            case 'disabled':
                $input = false;
                break;

            default:
                break;
        }
        return $input;
    }
endif;
