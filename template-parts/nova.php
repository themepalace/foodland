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
    <div class="single-row product-image clear">
        <div class="one-half">
            <div class="pdt-image">
              <?php do_action( 'foodland_before_nova_entry_container' ); ?>
            </div><!-- .pdt-image -->
        </div><!-- .one-half-->
        <div class="one-half">
            <div class="product-info active">
                <div class="pdt-name">
                    <?php the_title( '<h2 class="upercase">', '</h2>' ); ?>
                    <p class="pdt-content"><?php the_excerpt(); ?></p>
                </div><!-- .pdt-name -->
                <div class="pdt-cost">
                <?php
                    $nova_price =  get_post_meta ( $post->ID, 'nova_price', true );
                    if( !empty( $nova_price ) ) {
                        echo '<p class="dollar-cost">'. esc_html( $nova_price ) .'</p>';
                    }
                    if( !empty( $options['link_button_text'] ) ){
                        echo '<a class="rounded-btn upercase" href="'. esc_url( get_the_permalink() ) .'">'. esc_html( $options['link_button_text'] ). '</a>';
                    } 
                ?>
                </div><!-- .pdt-cost -->
            </div><!--  .product-info -->
        </div><!-- .one-half -->
    </div><!-- .product-image -->
</article>