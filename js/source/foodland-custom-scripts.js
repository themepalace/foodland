 /*
 * Custom scripts
 * Description: Custom scripts for foodland
 */

jQuery(document).ready(function() {
	//Fit vids
	if ( jQuery.isFunction( jQuery.fn.fitVids ) ) {
		jQuery('.hentry, .widget').fitVids();
	}

	//sidr
	if ( jQuery.isFunction( jQuery.fn.sidr ) ) {
		jQuery('#mobile-header-left-menu').sidr({
		   name: 'mobile-header-left-nav',
		   side: 'left' // By default
		});
	}

	// add meanmenu
	jQuery('header nav').meanmenu();
	
	// Site loader
	jQuery('#loader').delay(300).fadeOut('slow');
	jQuery('#loader-container').delay(300).fadeOut('slow');
	jQuery('body').delay(300).css({'overflow-x':'hidden'});
});