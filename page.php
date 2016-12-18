<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

get_header(); ?>

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

<?php get_footer();
