<?php
/**
 * The template for displaying custom menus
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

if ( ! function_exists( 'foodland_primary_menu' ) ) :
/**
 * Shows the Primary Menu 
 *
 * default load in sidebar-header-right.php
 */
function foodland_primary_menu() {
    $options  = foodland_get_theme_options();
    	?>
    	<nav id="site-navigation" class="main-navigation nav-collapse" role="navigation">
           <div class="right-menu-list">
              <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" style="display:none;"><?php _e( 'Primary Menu', 'foodland' ); ?></button>
                   <div class="menu-main-menu-container">
                <?php
                    if ( has_nav_menu( 'primary' ) ) { 
                        $foodland_primary_menu_args = array(
                            'theme_location'    => 'primary',
                            'menu_class'        => 'menu',
                            'menu_id'           => 'primary-menu',
                            'container'         => false
                        );
                        wp_nav_menu( $foodland_primary_menu_args );
                    }
                    else {
                        wp_page_menu( array( 'menu_class'  => 'menu foodland-nav-menu' ) );
                    }
                    ?>
        	       </div><!-- .menu-main-menu-container -->
            </div> <!-- .right-menu-list-->
        </nav><!-- .nav-primary -->
        <?php
}
endif; //foodland_primary_menu
add_action( 'foodland_header', 'foodland_primary_menu', 55 );


if ( ! function_exists( 'foodland_add_page_menu_class' ) ) :
/**
 * Filters wp_page_menu to add menu class  for default page menu
 *
 */    
function foodland_add_page_menu_class( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul class="menu page-menu-wrap">', $ulclass, 1 );
}
endif; //foodland_add_page_menu_class
add_filter( 'wp_page_menu', 'foodland_add_page_menu_class' );
