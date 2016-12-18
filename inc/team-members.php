<?php
/**
 * The template for displaying the Team Members
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

// Check staff member status.
add_filter( 'foodland_staff_member_status', 'foodland_staff_member_section_status' );

// Add staff member to the theme.
add_action( 'foodland_after_content', 'foodland_add_staff_member', 50 );

// staff member details.
add_filter( 'foodland_filter_staff_member', 'foodland_get_staff_member' );


if ( ! function_exists( 'foodland_get_staff_member' ) ) :
    /**
     * staff member details.
     *
     * @since Foodland 0.2
     *
     * @param array $input staff member details.
     */
    function foodland_get_staff_member( $input ) {

        $options = foodland_get_theme_options();

        $staff_member_type        = $options[ 'staff_member_type' ];

        switch ( $staff_member_type ) {
            case 'staff-member-from-post':

                $ids = array();

                for ( $i = 1; $i <= 4; $i++ ) {
                    $id = !empty( $options[ 'staff_member_post_id_' . $i ] ) ? $options[ 'staff_member_post_id_' . $i ] : '';
                    if ( ! empty( $id ) ) {
                        $ids[] = absint( $id );
                    }
                }
                // Bail if no valid pages are selected.
                if ( empty( $ids ) ) {
                    return $input;
                }

                $qargs = array(
                    'posts_per_page' => 4,
                    'post__in'       => $ids,
                    'orderby'        => 'post__in',
                );

                // Fetch posts.
                $all_posts = get_posts( $qargs );
                $staff_members = array();

                if ( ! empty( $all_posts ) ) {

                    $cnt = 0;
                    foreach ( $all_posts as $key => $post ) {

                        if ( has_post_thumbnail( $post->ID ) ) {
                            $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'foodland-staff-member-image' );
                        }else{
                            $image_array = array ( get_template_directory_uri() . '/images/no-thumbnail-image-250x240.png' );
                        }

                        $staff_members[ $cnt ]['images']  = $image_array;
                        $staff_members[ $cnt ]['title']   = $post->post_title;
                        $staff_members[ $cnt ]['url']     = get_permalink( $post );


                        $cnt++;
                    }
                }
                
                if ( ! empty( $staff_members ) ) {
                    $input = $staff_members;
                }
            break;

            default:
            break;
        }
        return $input;
    }
endif;

if ( ! function_exists( 'foodland_add_staff_member' ) ) :
    /**
     * Add featured staff member.
     *
     * @since Foodland 0.2
     */
    function foodland_add_staff_member() {

        $flag_apply_staff_member = apply_filters( 'foodland_staff_member_status', false );
        if ( true !== $flag_apply_staff_member ) {
            return false;
        }

        $staff_member = array();
        $staff_member = apply_filters( 'foodland_filter_staff_member', $staff_member );

        if ( empty( $staff_member ) ) {
            return;
        }

        // Render staff member now.
        foodland_render_staff_member( $staff_member );
    }
endif;

if ( ! function_exists( 'foodland_render_staff_member' ) ) :
    /**
     * Render featured staff member.
     *
     * @since Foodland 0.2
     *
     * @param array $staff_member Details of staff member content.
     */
    function foodland_render_staff_member( $staff_member = array() ) {

        if ( empty( $staff_member ) ) {
            return;
        }

        $options = foodland_get_theme_options();
        
        $staff_count = 0;
        for ( $i = 1; $i <= 4; $i++ ) {
            if ( !empty( $options[ 'staff_member_post_id_' . $i ] ) ){
                $staff_count ++;
            }
        }

        $title                = $options['sfaff_member_title'];
        $staff_section_select = $options['staff_member_type'];

        //if( ( ! $foodland_staff_member = get_transient( 'foodland_staff_member' ) ) ) {
          echo '<!-- refreshing cache -->';
            $foodland_staff_member = '';

            $foodland_staff_member .= '
                <section id="team-member" class="team-member four-column">
                    <div class="wrapper clear">';

                    //Check for the title option  in customizer
                    if( isset( $title ) && !empty( $title ) ) {
                        $foodland_staff_member .= '
                        <h2 class="upercase">'.esc_html( $title ).'</h2>';
                    }
                    $foodland_staff_member .= '
                        <div class="empty-space1"></div>
                        <div class="team-block">';

                        foreach ( $staff_member as $key => $staff ):

                            $post_thumbnail = $staff['images'];
                            $post_title     = $staff['title'];
                            $post_url       = $staff['url'];

                            $foodland_staff_member .= '
                                <div class="team-member">
                                    <figure class="member-img hover-on">
                                        <a href="'. esc_url(  $post_url ) .'">
                                            <div class="img">
                                                <img src="'. esc_url( $post_thumbnail[0] ) .'" alt="'. esc_attr(  $post_title ) .'">
                                            </div>
                                            <figcaption class="view-caption">
                                            <h3 class="upercase">'. esc_html( $post_title ).'</h3>
                                            </figcaption>
                                        </a> 
                                    </figure>
                                </div>';
    
                        endforeach;
                
                    $foodland_staff_member .= '
                        </div><!-- .team-block -->
                    </div><!-- .wrapper -->
                </section><!-- #team-member -->';

                
            //set_transient( 'foodland_staff_member', $foodland_staff_member, 86940 );
      // }
        echo ( $foodland_staff_member );
    }
endif;

if( ! function_exists( 'foodland_staff_member_section_status' ) ) :

    /**
     * Check status of staff member.
     *
     * @since Foodland 0.2
     */
    function foodland_staff_member_section_status( $input ) {
        global $post, $wp_query;

        $options = foodland_get_theme_options();
        // Team member status.
        $staff_member_status = $options[ 'staff_member_option_on' ];

        // Get Page ID outside Loop.
        $page_id = $wp_query->get_queried_object_id();

        // Front page displays in Reading Settings.
        $page_on_front  = absint( get_option( 'page_on_front' ) );
        $page_for_posts = absint( get_option( 'page_for_posts' ) );

        switch ( $staff_member_status ) {
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
