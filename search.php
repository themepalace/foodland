<?php
/**
 * The template for displaying Search Results pages
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

get_header();
global $post; ?>

	<main id="main" class="site-main" role="main">

		<?php  do_action( 'foodland_inner_page_div_structure_start' ); ?>

		<?php do_action( 'jetpack_container_starts' ); // container start for jetpack infinite scroll  ?> 

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'foodland' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); 

				if( 'nova_menu_item' == $post->post_type ){
					get_template_part( 'template-parts/nova', 'search' );
				}

				else{
					get_template_part( 'template-parts/content', 'search' ); 
				}?>

			<?php endwhile; ?>

			<?php foodland_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		<?php do_action( 'jetpack_container_ends' ); // container start for jetpack infinite scroll  ?> 

		<?php do_action( 'foodland_inner_page_div_structure_ends' ); ?>

	</main><!-- #main -->

<?php get_footer();
