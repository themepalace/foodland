<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

get_header();

	$defaults = foodland_get_default_theme_options(); //get theme default options
	$options  = foodland_get_theme_options(); // get theme options

	$disable_title = ! empty( $options['front_page_title_control'] ) ? $options['front_page_title_control'] : $defaults['front_page_title_control']  ;

	$homepage_title = ! empty( $options['front_page_title'] ) ? $options['front_page_title'] : $defaults['front_page_title']  ;
	?>

	<div id="latest-news">
	    <div class="wrapper">
			<?php if( ! $disable_title ){ ?>
				<h2 class="upercase"><?php echo esc_html( $homepage_title ); ?></h2>
			<?php } ?>
			<main id="main" class="site-main" role="main">
			 	<?php do_action( 'jetpack_container_starts' ); // container start for jetpack infinite scroll  ?> 

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php foodland_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>
				<?php do_action( 'jetpack_container_ends' ); // container ends for jetpack infinite scroll  ?> 
			</main><!-- #main -->		
		</div><!-- .wrapper -->
	</div><!-- #latest-news -->

<?php get_footer();