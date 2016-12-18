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
					<?php foodland_entry_meta(); ?>
			</header><!-- .entry-header -->
	
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			
			<footer class="entry-footer">
				<?php foodland_nova_menu_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .news-content-wrapper -->
</article><!-- #post -->
