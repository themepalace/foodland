<?php
/**
 * The template used for displaying post content in single.php
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			<?php foodland_entry_meta(); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php 
			/** 
			 * foodland_before_post_container hook
			 *
	 		 * @hooked foodland_single_content_image - 10
			 */
				do_action( 'foodland_before_post_container' );
				
				the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links"><span class="pages">' . __( 'Pages:', 'foodland' ) . '</span>',
					'after'  => '</div>',
					'link_before' 	=> '<span>',
                    'link_after'   	=> '</span>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php foodland_tag_category(); ?>
		</footer><!-- .entry-footer -->
</article><!-- #post-## -->
