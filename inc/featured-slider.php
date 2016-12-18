<?php
/**
 * The template for displaying Featured Slider
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2 
 */

// Check slider status.
add_filter( 'foodland_filter_slider_status', 'foodland_check_slider_status' );

// Add slider to the theme.
add_action( 'foodland_before_content', 'foodland_add_featured_slider', 10 );

// Slider details.
add_filter( 'foodland_filter_slider_details', 'foodland_get_slider_details' );


if ( ! function_exists( 'foodland_get_slider_details' ) ) :
    /**
     * Slider details.
     *
     * @since Foodland 0.2
     *
     * @param array $input Slider details.
     */
    function foodland_get_slider_details( $input ) {

        $options = foodland_get_theme_options();

        $featured_slider_type        = $options[ 'featured_slider_type' ];
        $featured_slider_number      = $options[ 'featured_slide_number' ];
        $featured_slider_button_text = $options[ 'link_button_text' ];


        switch ( $featured_slider_type ) {
            case 'featured-page-slider':

                $ids = array();

                for ( $i = 1; $i <= absint( $featured_slider_number ); $i++ ) {
                    $id = !empty( $options[ 'featured_slider_page_' . $i ] ) ? $options[ 'featured_slider_page_' . $i ] : '';
                    if ( ! empty( $id ) ) {
                        $ids[] = absint( $id );
                    }
                }
                // Bail if no valid pages are selected.
                if ( empty( $ids ) ) {
                    return $input;
                }

                $qargs = array(
                    'post_type'      => 'page',
                    'posts_per_page' => absint( $featured_slider_number ),
                    'post__in'       => $ids,
                    'orderby'        => 'post__in',
                );

                // Fetch posts.
                $all_posts = get_posts( $qargs );
                $slides = array();

                if ( ! empty( $all_posts ) ) {

                    $cnt = 0;
                    foreach ( $all_posts as $key => $post ) {

                        if ( has_post_thumbnail( $post->ID ) ) {
                            $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'foodland-slider' );
                        }else{
                            $image_array = array ( get_template_directory_uri() . '/images/no-thumbnail-image-450x315.png' );
                        }

                        $slides[ $cnt ]['images']  = $image_array;
                        $slides[ $cnt ]['title']   = $post->post_title;
                        $slides[ $cnt ]['excerpt'] = foodland_slider_excerpt_limit( 30, $post );
                        $slides[ $cnt ]['url']     = get_permalink( $post->ID );

                        $cnt++;
                    }
                }
                
                if ( ! empty( $slides ) ) {
                    $input = $slides;
                }
            break;

            default:
            break;
        }
        return $input;
    }
endif;

if ( ! function_exists( 'foodland_add_featured_slider' ) ) :
    /**
     * Add featured slider.
     *
     * @since Foodland 0.2
     */
    function foodland_add_featured_slider() {

        $flag_apply_slider = apply_filters( 'foodland_filter_slider_status', false );
        if ( true !== $flag_apply_slider ) {
            return false;
        }

        $slider_details = array();
        $slider_details = apply_filters( 'foodland_filter_slider_details', $slider_details );

        if ( empty( $slider_details ) ) {
            return;
        }

        // Render slider now.
        foodland_render_featured_slider( $slider_details );

    }
endif;

if ( ! function_exists( 'foodland_render_featured_slider' ) ) :
    /**
     * Render featured slider.
     *
     * @since Foodland 0.2
     *
     * @param array $slider_details Details of slider content.
     */
    function foodland_render_featured_slider( $slider_details = array() ) {

        if ( empty( $slider_details ) ) {
            return;
        }

        $options = foodland_get_theme_options();
        $featured_slider_number  = $options[ 'featured_slide_number' ];
        
        $slides_count = 0;
        for ( $i = 1; $i <= absint( $featured_slider_number ); $i++ ) {
            if ( !empty( $options[ 'featured_slider_page_' . $i ] ) ){
                $slides_count ++;
            }
        }

        switch ( $slides_count ) {
            case 1:
                $carousel_visible_no = 1;
                break;
            case 2:
                $carousel_visible_no = 2;
                break;
            default:
                 $carousel_visible_no = 3;
                break;
        }

        if( ( ! $foodland_featured_slider = get_transient( 'foodland_featured_slider' ) ) ) {
          echo '<!-- refreshing cache -->';
            $foodland_featured_slider = '';

            $foodland_featured_slider .= '
                <section id="feature-slider">
                    <div class="cycle-slideshow"
                        data-cycle-log="false"
                        data-cycle-pause-on-hover="true"
                        data-cycle-swipe="true"
                        data-cycle-fx="carousel"
                        data-cycle-auto-height=container
                        data-cycle-speed="' . absint( $options['featured_slide_transition_length'] ) * 1000 . '"
                        data-cycle-timeout="' . absint( $options['featured_slide_transition_delay'] ) * 1000 . '"
                        data-cycle-loader="wait"
                        data-cycle-carousel-visible="'. absint( $carousel_visible_no ) .'"
                        data-cycle-carousel-fluid=true
                        data-cycle-loop="0"
                        data-cycle-prev="#prev"
                        data-cycle-next="#next"
                        data-cycle-slides="> article">';

                        $no_of_slides = $options['featured_slide_number'];

                            $count = 1; 

                            foreach ( $slider_details as $key => $slide ):

                                $post_thumbnail = $slide['images'];
                                $post_title     = $slide['title'];
                                $post_excerpt   = $slide['excerpt'];
                                $post_url       = $slide['url'];

                                $foodland_featured_slider .= '
                                    <article class="slides">
                                        <div class="item hover-on">';

                                            $foodland_featured_slider .= '<img src="' . esc_url( $post_thumbnail[0] ) . '" alt="' . esc_attr( $post_title ). '"/>';

                                            $foodland_featured_slider .= '
                                                <div class="product-info">
                                                    <div class="pdt-name">';
                                                    if( !empty( $post_title ) ){
                                                        $foodland_featured_slider .= '   <h2 class="upercase"><a href="' . esc_url( $post_url ) . '" >' . esc_html( $post_title ) . '</a></h2>';
                                                    }
                                                    
                                                    if( !empty( $post_excerpt ) ) {
                                                        $foodland_featured_slider .= '<p>' . wp_kses_data( $post_excerpt ) . '</p>';
                                                    }
                                                    $foodland_featured_slider .= '
                                                    </div><!-- .pdt-name -->';
                                                
                                                if( !empty( $options['link_button_text'] ) && !empty( $post_url ) ) {
                                                    $foodland_featured_slider .= '
                                                    <div class="pdt-cost"><a class="rounded-btn upercase" href="' . esc_url( $post_url ) . '">' .esc_html( $options['link_button_text'] ) . '</a>
                                                    </div><!-- .pdt-cost -->';
                                                }

                                                $foodland_featured_slider .= '
                                            </div><!-- .product-info -->
                                        </div><!-- .item -->
                                    </article><!-- .slides -->';  

                                $count++;
                            endforeach;
                
                    $foodland_featured_slider .= '
                    </div><!-- .cycle-slideshow -->';
                    // show controls only if no of slides is grater than 2.
                    if( $count > 2 ){
                        $foodland_featured_slider .= '
                            <div class="center">
                                <a href=# id="prev" class="prev"> Prev </a>
                                <a href=# id="next" class="next"> Next  </a>
                            </div><!-- .center -->';
                    }
                 $foodland_featured_slider .= '    
                </section><!-- #feature-slider -->';
                
            set_transient( 'foodland_featured_slider', $foodland_featured_slider, 86940 );
       }
        echo ( $foodland_featured_slider );
    }
endif;

if( ! function_exists( 'foodland_check_slider_status' ) ) :

    /**
     * Check status of slider.
     *
     * @since Foodland 0.2
     */
    function foodland_check_slider_status( $input ) {
        global $post, $wp_query;

        $options = foodland_get_theme_options();
        // Slider status.
        $featured_slider_status = $options[ 'featured_slider_option' ];

        // Get Page ID outside Loop.
        $page_id = $wp_query->get_queried_object_id();

        // Front page displays in Reading Settings.
        $page_on_front  = absint( get_option( 'page_on_front' ) );
        $page_for_posts = absint( get_option( 'page_for_posts' ) );

        switch ( $featured_slider_status ) {
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
