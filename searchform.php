<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */
?>

<?php $options 	= foodland_get_theme_options(); // Get options ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'foodland' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e( 'Search...', 'foodland' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'foodland' ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'foodland' ); ?>">
</form>
