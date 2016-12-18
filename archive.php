<?php
/**
 * The template for displaying Archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">

		<?php  do_action( 'foodland_inner_page_div_structure_start' ); ?>

		<?php do_action( 'jetpack_container_starts' ); // container start for jetpack infinite scroll  ?> 

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */

					global $post;
					$post_type = get_post_type( $post );

					if( 'nova_menu_item' == $post_type ){

						get_template_part( 'template-parts/nova', get_post_format() );

					}
					else{

						get_template_part( 'template-parts/content', get_post_format() );
					}
				?>

			<?php endwhile; ?>

			<?php foodland_content_nav( 'nav-below' ); ?>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		<?php do_action( 'jetpack_container_ends' ); // container ends for jetpack infinite scroll  ?> 

		<?php do_action( 'foodland_inner_page_div_structure_ends' ); ?>

	</main><!-- #main -->

<?php get_footer();
