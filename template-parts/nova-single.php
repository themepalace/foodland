<?php
/**
 * The template used for displaying product content in nova.php
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2 
 */

 // get theme options
 $options = foodland_get_theme_options();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   	<div class="product-image clearfix">
        <?php 
        	/** 
			 * foodland_before_post_container hook
			 *
	 		 * @hooked foodland_single_content_image - 10
			 */
				do_action( 'foodland_before_post_container' );
        ?>
            <div class="product-info">
                <div class="pdt-name">
                   <?php the_title( '<h2 class="upercase">', '</h2>' ); ?>
                </div><!-- .pdt-name -->
            	<div class="pdt-cost">
                <?php
                    $nova_price =  get_post_meta ( $post->ID, 'nova_price', true );
                    if( !empty( $nova_price ) ) {
                        echo '<p class="dollar-cost">'. esc_html( $nova_price ) .'</p>';
                    }
                ?>
                </div><!-- .pdt-cost -->
            </div><!-- .product-info -->
    </div><!-- .product-image -->
               
    <div class="product-descrp">
        <?php the_title( '<h2 class="upercase">', '</h2>' );?>
            <div class="empty-space1"></div>
                <?php the_content(); ?>
    </div><!-- product-description -->
               
</article>