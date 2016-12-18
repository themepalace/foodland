<?php
/**
 * The template for displaying the footer
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */
?>

<?php 
    /** 
     * foodland_after_content hook
     *
     * @hooked foodland_content_end - 30 
     * @hooked @hooked foodland_featured_content_display - 40 
     * @hooked foodland_team_members -50 
     */
    do_action( 'foodland_after_content' ); 
?>
            
<?php                
    /** 
     * foodland_footer hook
     *
     * @hooked foodland_footer_content_start - 30 
     * @hooked foodland_footer_sidebar - 40 
     * @hooked foodland_footer_content - 100 
     * @hooked foodland_footer_content_end - 110
     * @hooked foodland_page_end - 200
     *
     */
    do_action( 'foodland_footer' );
?>

<?php               
/** 
 * foodland_after hook
 *
 *
 * @hooked foodland_scrollup - 10
 */
do_action( 'foodland_after' );?>

<?php wp_footer(); ?>

</body>
</html>