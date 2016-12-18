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
 * @package Themepalace
 */
get_header();

	$defaults = foodland_get_default_theme_options(); //get theme default options
	$options  = foodland_get_theme_options(); // get theme options

	$homepage_title = ! empty( $options['front_page_title'] ) ? $options['front_page_title'] : $defaults['front_page_title']  ;
	?>

	<div id="latest-news">
	    <div class="wrapper">
			<?php if( !empty( $homepage_title ) ){ ?>
				<h2 class="upercase"><?php echo esc_html( $homepage_title ); ?></h2>
			<?php } ?>
			<main id="main" class="site-main" role="main">
			 	<?php do_action( 'jetpack_container_starts' ); // container start for jetpack infinite scroll 
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;
	               		wp_reset_query();

						foodland_content_nav( 'nav-below' );

					else :

					get_template_part( 'template-parts/content', 'none' );

					endif; ?>

           		<?php do_action( 'jetpack_container_ends' ); // container ends for jetpack infinite scroll  ?> 
			</main><!-- #main -->		
		</div><!-- .wrapper -->
	</div><!-- #latest-news -->

<?php get_footer();