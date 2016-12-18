<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	/** 
	 * foodland_before_entry_container hook
	 *
	 * @hooked foodland_archive_content_image - 10
	 */
		do_action( 'foodland_before_entry_container' );
	?>
		<div class="<?php echo esc_attr( foodland_archive_class() ); ?>">
			<header class="entry-header">
				<h3 class="entry-title"><a href="<?php  the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

				<?php if ( 'post' == get_post_type() ) : ?>
				
					<?php foodland_entry_meta(); ?>
				
				<?php endif; ?>
			</header><!-- .entry-header -->

		<?php 
		$options = foodland_get_theme_options();
		

		if ( is_search() || is_archive() || is_front_page() || is_home() ) : //display Excerpts ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>			
			<div class="entry-content">

				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links"><span class="pages">' . __( 'Pages:', 'foodland' ) . '</span>',
						'after'  => '</div>',
						'link_before' 	=> '<span>',
	                    'link_after'   	=> '</span>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php foodland_tag_category(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .news-content-wrapper -->
</article><!-- #post -->
