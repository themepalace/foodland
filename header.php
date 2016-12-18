<?php
/**
 * The default template for displaying header
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

	/** 
	 * foodland_doctype hook
	 *
	 * @hooked foodland_doctype - 10
	 *
	 */
	do_action( 'foodland_doctype' );?>

<head>
<?php	
	/** 
	 * foodland_before_wp_head hook
	 *
	 * @hooked null
	 * 
	 */
	do_action( 'foodland_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
	/** 
     * foodland_site_loader hook
     *
     * @hooked foodland_get_site_loader - 10
     */
    do_action( 'foodland_site_loader' );
    
	/** 
     * foodland_before_header hook
     *
     */
    do_action( 'foodland_before' );
	
	/** 
	 * foodland_header hook
	 *
	 * @hooked foodland_page_start - 10
	 * @hooked foodland_header_start- 30
	 * @hooked foodland_site_branding - 50
	 * @hooked foodland_primary_menu - 55
	 * @hooked foodland_header_end - 100
	 * 
	 */
	do_action( 'foodland_header' );

	/** 
     * foodland_after_header hook
     * 
     * @hooked foodland_featured_overall_image (after-header) - 10
     */
	do_action( 'foodland_after_header' ); 

	/** 
	 * foodland_before_content hook
	 *
	 * @hooked foodland_featured_slider - 10 
	 * @hooked foodland_promotional_headline - 30 
	 * @hooked foodland_special_product -35 
	 */
	do_action( 'foodland_before_content' );
	
	/** 
     * foodland_main hook
     *
     * @hooked foodland_content_start - 10
     *
     */
	do_action( 'foodland_content' );
	