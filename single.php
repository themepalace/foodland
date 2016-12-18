<?php
/**
 * The Template for displaying all single posts
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		
	<?php  
		/** 
		 * foodland_inner_page_div_structure_start hook
		 *
		 * @hooked foodland_inner_page_div_start - 10
		 */
		do_action( 'foodland_inner_page_div_structure_start' ); 
	?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php 
			global $post;
			$post_type = get_post_type( $post );

			if( 'nova_menu_item' == $post_type ){

				get_template_part( 'template-parts/nova', 'single' );

			}
			else{

				get_template_part( 'template-parts/content', 'single' ); 

			}
		?>

		<?php 			
			/** 
			 * foodland_comment_section hook
			 *
			 * @hooked foodland_get_comment_section - 10
			 */
			do_action( 'foodland_comment_section' ); 
		?>
	<?php endwhile; // end of the loop. ?>

		<?php 
			/** 
		 	* foodland_inner_page_div_structure_ends hook
		 	*
		 	* @hooked foodland_inner_page_div_ends - 10
			*/
		do_action( 'foodland_inner_page_div_structure_ends' ); 
		?>

	</main><!-- #main -->
	
<?php get_footer();