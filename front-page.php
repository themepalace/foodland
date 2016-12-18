<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 */
	// Get the reading setting option
	$show_on_front = get_option( 'show_on_front' );

	// Check if "latest posts" is selected in reading setting
	if ( 'posts' == $show_on_front ) {
		// Load home.php
		get_template_part( 'home' );
	} else {
		// Load front page with additional sections
		get_header();
	?>
		<div id="latest-news">
		    <div class="wrapper">

				<main id="main" class="site-main" role="main">
				
				<?php  do_action( 'foodland_inner_page_div_structure_start' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

					<?php 
						/** 
						 * foodland_comment_section hook
						 *
						 * @hooked foodland_get_comment_section - 10
						 */
						do_action( 'foodland_comment_section' ); 
					?>

				<?php endwhile; // end of the loop. ?>

				<?php do_action( 'foodland_inner_page_div_structure_ends' ); ?>

				</main><!-- #main -->
	
			</div><!-- .wrapper -->
		</div><!-- #latest-news -->

	<?php
		get_footer();
	}