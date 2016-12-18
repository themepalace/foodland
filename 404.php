<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">

		<?php  do_action( 'foodland_inner_page_div_structure_start' ); ?>

		<section class="error-404 not-found">
			<?php if ( is_active_sidebar( 'sidebar-notfound' ) ) :
				
					dynamic_sidebar( 'sidebar-notfound' ); 
				
				else : ?>
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops!! That page can&rsquo;t be found.', 'foodland' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'foodland' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			<?php endif; ?>
		</section><!-- .error-404 -->

		<?php do_action( 'foodland_inner_page_div_structure_ends' ); ?>

	</main><!-- #main -->

<?php get_footer();