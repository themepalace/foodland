<?php
/**
 * The template for displaying the Featured Content
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2 
 */

// Check featured Content status.
add_filter( 'foodland_filter_featured_content_status', 'foodland_featured_content_status' );

// Add featured content to the theme.
add_action( 'foodland_after_content', 'foodland_add_featured_content', 40 );

// Featured content details.
add_filter( 'foodland_filter_featured_content_details', 'foodland_get_featured_content_details' );

if ( ! function_exists( 'foodland_get_featured_content_details' ) ) :
    /**
     * Featured content details.
     *
     * @since Foodland 0.2
     *
     * @param array $input featured content details.
     */
    function foodland_get_featured_content_details( $input ) {

        $options = foodland_get_theme_options(); // get theme options

		$featured_content_type  = $options[ 'featured_content_type' ];
		$featured_slider_number = 4;

        switch ( $featured_content_type ) {
            case 'featured-page-content':

                $ids = array();

                for ( $i = 1; $i <= absint( $featured_slider_number ); $i++ ) {
                    $id = !empty( $options[ 'featured_content_page_' . $i ] ) ? $options[ 'featured_content_page_' . $i ] : '';
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
                            $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'foodland-featured-content' );
                        }else{
                            $image_array = array ( get_template_directory_uri() . '/images/no-thumbnail-image-336x224.png' );
                        }

                        $slides[ $cnt ]['images']  = $image_array;
                        $slides[ $cnt ]['title']   = $post->post_title;
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

if ( ! function_exists( 'foodland_add_featured_content' ) ) :
    /**
     * Add featured content.
     *
     * @since Foodland 0.2
     */
    function foodland_add_featured_content() {

        $flag_apply_content = apply_filters( 'foodland_filter_featured_content_status', false );
        if ( true !== $flag_apply_content ) {
            return false;
        }

        $content_details = array();
        $content_details = apply_filters( 'foodland_filter_featured_content_details', $content_details );

        if ( empty( $content_details ) ) {
            return;
        }

        // Render featured content now.
        foodland_render_featured_content( $content_details );

    }
endif;

if ( ! function_exists( 'foodland_render_featured_content' ) ) :
    /**
     * Render featured content.
     *
     * @since Foodland 0.2
     *
     * @param array $content_details Details of featured content.
     */
    function foodland_render_featured_content( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        }

        $options = foodland_get_theme_options();

        if( ( ! $foodland_featured_content = get_transient( 'foodland_featured_content' ) ) ) {
          echo '<!-- refreshing cache -->';
        $foodland_featured_content = '';

            $foodland_featured_content .= '
                <section id="portfolio-overlay">
            		<div class="featured-img clear">';

                        $count = 1; 
                        foreach ( $content_details as $key => $slide ):

                            $post_thumbnail = $slide['images'];
                            $post_title     = $slide['title'];
                            $post_url       = $slide['url'];

                             	$foodland_featured_content .= '
                                    <div id="featured-post-' . $count . '" class="single-effect">
										<figure class="wpf-demo-6">';

                                        $foodland_featured_content .= '<img src="' . esc_url( $post_thumbnail[0] ) . '" alt="' . esc_attr( $post_title ) . '"/>';

                                        $foodland_featured_content .= '
                                        	<figcaption class="view-caption"><h3 class="upercase">' . esc_html( $post_title ) . '</h3>'. '<a href="' . esc_url( $post_url ) . '" rel="bookmark"><span class="genericon genericon-plus"></span></a>
                                        	</figcaption>';
                                             
                                        $foodland_featured_content .= '
										</figure>
									</div><!-- #featured-post-'. $count .' -->';  

                            $count++;
                        endforeach;
                       
                    $foodland_featured_content .= '
                    </div><!-- .featured-img -->
				</section><!-- #portfolio-overlay -->';
                
            set_transient( 'foodland_featured_content', $foodland_featured_content, 86940 );
        }
        echo $foodland_featured_content;
    }
endif;

if( ! function_exists( 'foodland_featured_content_status' ) ) :

    /**
     * Check status of featured content.
     *
     * @since Foodland 0.2
     */
    function foodland_featured_content_status( $input ) {
        global $post, $wp_query;

        $options = foodland_get_theme_options();
        // Featured content status.
        $featured_slider_status = $options[ 'featured_content_option' ];

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
