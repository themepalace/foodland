<?php
/**
 * The Footer Sidebar containing the footer widget areas.
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

/* The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'footer-1' )
  && ! is_active_sidebar( 'footer-2' )
  && ! is_active_sidebar( 'footer-3'  )
  && ! is_active_sidebar( 'footer-4'  )
  
) {
	return;
}
// If we get this far, we have widgets. Let do this.
?>
   <div id="footer-widgets" <?php foodland_footer_sidebar_class(); ?>>
    <div class="wrapper clear">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>

                <div class="f-widget f-widget-1">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div><!-- .f-widget -->
            <?php endif; ?>
        
            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <div class="f-widget f-widget-2">
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                </div><!-- #second .widget-area -->
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="f-widget f-widget-3">
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                </div><!-- .f-widget -->
            <?php endif; ?>
        
            <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                <div class="f-widget f-widget-4">
                    <?php dynamic_sidebar( 'footer-4' ); ?>
                </div><!-- #second .widget-area -->
             <?php endif; ?>

      </div><!-- .wrapper -->
   </div> <!-- .footer-widgets -->
