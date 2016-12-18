<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, foodland_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * foodland functions and definitions
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

if ( ! function_exists( 'foodland_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function foodland_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options 	= foodland_get_theme_options();
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on foodland, use a find and replace
		 * to change 'foodland' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'foodland', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		* Add support for custom background image.
		*/
		$defaults = apply_filters( 'foodland_custom_background',  array(
			'default-image'          => '',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'center',
			'default-attachment'     => 'scroll',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		));
		add_theme_support( 'custom-background', $defaults );

		/**
		 * Add theme support for site logo
		 *
		 * Since wordpress 4.5 
		 */
		if( 4.5 <= ( float )get_bloginfo( 'version' ) ){
			add_theme_support( 'custom-logo', array( 
				'flex-width'  => true,
				'flex-height' => false,
				'width'       => 250,
				'height'      => 50,
				'header-text' => array( 'site-title', 'site-description' ), 
			) );
		}

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Add Foodland's custom image sizes
		add_image_size( 'foodland-slider', 450, 315, true ); // Used for Featured slider

		add_image_size( 'foodland-featured-content', 336, 224, true ); // used in Featured Content 

		add_image_size( 'foodland-promotional-page',570, 380, true ); // Used in Promotional headline page thumbnail image

		add_image_size( 'foodland-staff-member-image',250, 240, true ); // Used in staff member images

		//Archive Images
		add_image_size( 'foodland-archive-left-right', 480, 318, true ); // used in Archive Left/Right image 

		if( class_exists( 'jetpack' ) ){

			add_theme_support( 'nova_menu_item' ); // add theme support for food items.

			add_image_size( 'foodland-nova-archive',570, 500, true ); // Used in Nova Menu Archive page images
		}

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' 	=> __( 'Primary Menu', 'foodland' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup Editor style
		 */
		add_editor_style( 'css/editor-style.min.css' );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

	}
endif; // foodland_setup
add_action( 'after_setup_theme', 'foodland_setup' );

/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since Foodland 0.2
 */
function foodland_scripts() {
	$options = foodland_get_theme_options();

	$web_fonts_stylesheet = 'https://fonts.googleapis.com/css?family=Roboto';
	
	wp_register_style( 'foodland-web-font', $web_fonts_stylesheet, false, null );

	$foodland_deps = array( 'foodland-web-font' );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//For genericons
	wp_enqueue_style( 'foodland-genericons', get_template_directory_uri() . '/css/genericons.min.css', false, '3.4.1' );

	//For Meanmenu
	wp_enqueue_style( 'foodland-meanmenu', get_template_directory_uri() . '/css/meanmenu.min.css', false, '3.4.1' );

	// enqueue styles required for the theme
	wp_enqueue_style( 'foodland-style', get_stylesheet_uri(), $foodland_deps, FOODLAND_THEME_VERSION );

	// Enqueue scripts required for the theme
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	// Enqueue meanmenu
	wp_enqueue_script( 'jquery-meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.min.js', array('jquery'), '20130115', true );

	/**
	 * Loads up Scroll Up script
	 */
	wp_enqueue_script( 'jquery-scrollup', get_template_directory_uri() . '/js/foodland-scrollup.min.js', array( 'jquery' ), '20160309', true  );
	/**
	 * Loads up fit vids
	 */
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/fitvids.min.js', array( 'jquery' ), '1.1', true );

	/**
	 * Loads up html5.min for IE support
	 */
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.min.js' );

	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	/**
	 * Loads up Cycle JS
	 */
	if( $options['featured_slider_option'] != 'disabled' ) {

		// Load cycle2.css
		wp_enqueue_style( 'cycle2-style', get_template_directory_uri() . '/css/cycle2.min.css' );

		// Load cycle2.min.js
		wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/js/jquery-cycle2.min.js', array( 'jquery' ), '2.1.6', true );

		// Load cycle2-carousel.min.js
		wp_enqueue_script( 'jquery-cycle2-carousel', get_template_directory_uri() . '/js/jquery-cycle2-carousel.min.js', array( 'jquery-cycle2' ), false , true );
	}

	/**
	 * Enqueue custom script for foodland.
	 */
	wp_enqueue_script( 'foodland-custom-scripts', get_template_directory_uri() . '/js/foodland-custom-scripts.min.js', array( 'jquery' ), null );
}
add_action( 'wp_enqueue_scripts', 'foodland_scripts' );

/**
* Recommended plugins
*/
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgm.php';

/**
 * Default Options.
 */
require get_template_directory() . '/inc/default-options.php';

/**
 * Custom Header.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Structure for foodland
 */
require get_template_directory() . '/inc/structure.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-includes/customizer.php';


/**
 * Custom Menus
 */
require get_template_directory() . '/inc/menus.php';

/**
 * Load Slider file.
 */
require get_template_directory() . '/inc/featured-slider.php';

/**
 * Load promotional headline file.
 */
require get_template_directory() . '/inc/promotional-headline.php';

/**
 * Load Special product if jetpack plugin is active
 */
if( class_exists( 'jetpack' ) ){ 
	require get_template_directory() . '/inc/todays-special.php';
}

/**
 * Load Featured Content.
 */
require get_template_directory() . '/inc/featured-content.php';

/**
 * Load Team members
 */
require get_template_directory() . '/inc/team-members.php';

/**
 * Load custom template for nova resturant jetpack.
 */
if ( class_exists( 'Nova_Restaurant' ) ) {

	require get_template_directory() . '/inc/custom-jetpack-template.php';

}

/**
 * Load Widgets and Sidebars
 */
require get_template_directory() . '/inc/widget-includes/widgets-core.php';


/**
 * Load Social Icons
 */
require get_template_directory() . '/inc/social-icons.php';

/**
 * Returns the options array for foodland.
 * @uses  get_theme_mod
 *
 * @since Foodland 0.2
 */
function foodland_get_theme_options() {
	$foodland_default_options = foodland_get_default_theme_options();

	return array_merge( $foodland_default_options , get_theme_mod( 'foodland_theme_options', $foodland_default_options ) ) ;
}


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, foodland_customize_preview (see foodland_customizer function: foodland_customize_preview)
 *
 * @since Foodland 0.2
 */
function foodland_flush_transients(){
	delete_transient( 'foodland_featured_slider' );

	delete_transient( 'foodland_promotional_headline' );

	delete_transient( 'foodland_featured_content' );

	delete_transient( 'foodland_special_product' );

	delete_transient( 'foodland_team_members' );

	delete_transient( 'foodland_footer_content' );

	delete_transient( 'foodland_custom_css' );

	delete_transient( 'foodland_featured_image' );

	delete_transient( 'foodland_social_icons' );

	delete_transient( 'foodland_post_total_category' );

	//Add foodland default themes if there is no values
	if ( !get_theme_mod('foodland_theme_options') ) {
		set_theme_mod( 'foodland_theme_options', foodland_get_default_theme_options() );
	}
}
add_action( 'customize_save', 'foodland_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since Foodland 0.2
 */
function foodland_flush_category_transients(){
	delete_transient( 'foodland_post_total_category' );
}
add_action( 'edit_category', 'foodland_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since Foodland 0.2
 */
function foodland_flush_post_transients(){
	delete_transient( 'foodland_featured_slider' );

	delete_transient( 'foodland_promotional_headline' );

	delete_transient( 'foodland_special_product' );

	delete_transient( 'foodland_featured_content' );

	delete_transient( 'foodland_featured_image' );

	delete_transient( 'foodland_post_total_category' );
}
add_action( 'save_post', 'foodland_flush_post_transients' );

if ( ! function_exists( 'foodland_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since Foodland 0.2
	 */
	function foodland_custom_css() {
		//foodland_flush_transients();
		$options 	= foodland_get_theme_options();

		$defaults 	= foodland_get_default_theme_options();

		if ( ( !$foodland_custom_css = get_transient( 'foodland_custom_css' ) ) ) {
			$foodland_custom_css ='';

			// Header Color Options
			if( $defaults[ 'site_title_tagline_color' ] != get_header_textcolor() ) {
				$foodland_custom_css .=  "#masthead .site-title a, .site-description{ color: #".  get_header_textcolor() ."; }". "\n";
			}
			// Header Navigation menu
			if( $defaults[ 'header_nav_menu_color' ] != $options[ 'header_nav_menu_color' ] ){
				$foodland_custom_css .= "#site-navigation ul li a{ color: ". $options['header_nav_menu_color'] ."; }" . "\n";
			}


			$css = '';

			// Check if the custom CSS feature of 4.7 exists
			if ( function_exists( 'wp_update_custom_css_post' ) ) {
			    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
			    if( !empty( $options['custom_css'] ) )
			    	$css = $options['custom_css'];
			    
			    if ( $css ) {
			        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			        $return = wp_update_custom_css_post( $core_css . $css );
					
			        if ( ! is_wp_error( $return ) ) {
			            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
			   			$options['custom_css'] = '';
						set_theme_mod( 'foodland_theme_options', $options );
			        }
			    }
			} else {
			    // Back-compat for WordPress < 4.7.
				if ( isset( $options['custom_css'] ) ) {
					$foodland_custom_css .= $options['custom_css'];
				}
			}
			set_transient( 'foodland_custom_css', htmlspecialchars_decode( $foodland_custom_css ), 86940 );
		}
		wp_add_inline_style( 'foodland-style', $foodland_custom_css );
	}
endif; //foodland_custom_css
add_action( 'wp_enqueue_scripts', 'foodland_custom_css', 10  );

if ( ! function_exists( 'foodland_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Foodland 0.2
	 */
	function foodland_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options			= foodland_get_theme_options();

		$nav_class = ( is_single() ) ? 'site-navigation post-navigation' : 'site-navigation paging-navigation';

		
		?>
	        <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>">
	        	<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'foodland' ); ?></h3>

	                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'foodland' ) ); ?></div>
	                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'foodland' ) ); ?></div>
	           
	        </nav><!-- #nav -->
		<?php
	}
endif; // foodland_content_nav

if ( ! function_exists( 'foodland_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-holder' ); ?>>
			<div class="coment-wrap">
				<?php _e( 'Pingback:', 'foodland' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'foodland' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-holder' ); ?>>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="avatar-wrap">

					<?php if ( 0 != $args['avatar_size'] ) {
						printf( '<a href="%s">%s</a>', esc_url( get_comment_author_url() ),  get_avatar( $comment, $args['avatar_size'] ) . '</a>' );
						} ?>

				</div><!-- .comment-author -->
				<div class="comment-body">

					<div class="comment-header">
						<?php printf( '<h6 class="post-by">%s</h6>', esc_html( get_comment_author() ) ); ?>
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'foodland' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'foodland' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-header -->

					<div class="comment-inner">
						<?php comment_text(); ?>

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'foodland' ); ?></p>
						<?php endif; ?>

					</div><!-- .comment-inner -->

					<div class="comment-footer">
					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
					</div><!-- .comment-footer -->

				</div><!-- .comment-body -->

			</div><!-- .coment-wrap -->

		<?php
		endif;
	}
endif; // foodland_comment()


if ( ! function_exists( 'foodland_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'foodland_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the
		 * URL of the next adjacent image in a gallery, or the first image (if
		 * we're looking at the last image in a gallery), or, in a gallery of one,
		 * just the link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			esc_attr( the_title_attribute( array( 'echo' => false ) ) ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; //foodland_the_attached_image


if ( ! function_exists( 'foodland_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_entry_meta() {
		echo '<div class="entry-meta">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">' . __( 'posted on ', 'foodland') . '%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">'. _x( 'Posted on', 'Used before publish date.', 'foodland' ). '</span>'),
			esc_url( get_day_link( get_the_time('Y'),get_the_time('m'), get_the_time('d') ) ),
			$time_string
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s"> %3$s </a></span></span>',
				sprintf( '<span class="screen-reader-text">' . _x( 'Author', 'Used before post author name.', 'foodland' ) . '</span>' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		echo '</div><!-- .entry-meta -->';
	}
endif; //foodland_entry_meta


if ( ! function_exists( 'foodland_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'foodland' ) );
			if ( $categories_list && foodland_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s' . __( 'posted in', 'foodland') . ' %2$s</span>',
					sprintf( '<span class="screen-reader-text">' . _x( 'Categories','Used before category names.', 'foodland' ) .'</span>' ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'foodland' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( '<span class="screen-reader-text">' ._x( 'Tags', 'Used before tag names.', 'foodland'). '</span>' ),
					$tags_list
				);
			}

			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( ' Leave a comment', 'foodland' ), esc_html__( '1 Comment', 'foodland' ), esc_html__( '% Comments', 'foodland' ) );
			echo '</span>';
			}

			edit_post_link( esc_html__( ' Edit', 'foodland' ), '<span class="edit-link">', '</span>' );
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //foodland_tag_category


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Foodland 0.2
 */
function foodland_categorized_blog() {
	if ( false === ( $foodland_post_total_category = get_transient( 'foodland_post_total_category' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$foodland_post_total_category = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$foodland_post_total_category = count( $foodland_post_total_category );

		set_transient( 'foodland_post_total_category', $foodland_post_total_category );
	}

	if ( '1' != $foodland_post_total_category ) {
		// This blog has more than 1 category so foodland_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so foodland_categorized_blog should return false
		return false;
	}
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Foodland 0.2
 */
function foodland_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'foodland_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Foodland 0.2
 */
function foodland_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'foodland_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Foodland 0.2
 */
function foodland_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}

if ( ! function_exists( 'foodland_body_classes' ) ) :
	/**
	 * Adds foodland layout classes to the array of body classes.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_body_classes( $classes ) {
		global $post, $wp_query;

		//Getting Ready to load data from Theme Options Panel
		$options 		= foodland_get_theme_options();
		// Check logo 
		if( 4.5 <= (float) get_bloginfo( 'version' ) ){
			has_custom_logo() ? $disable_logo = false : $disable_logo = true; 
		}
		else{
			$site_logo = $options['logo'];
			!empty( $site_logo ) ? $disable_logo = false : $disable_logo = true;
		}
		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if( false == display_header_text() && $disable_logo ){
			$classes[] = ' no_logo_and_title';
		}

		if( ( '' != get_bloginfo( 'name' ) || '' !=  get_bloginfo( 'description' ) )){
			$classes[] = ' has_title';
		}

		if (! $disable_logo ){
			$classes [] = ' has_only_logo'  ;
		}

		$classes 	= apply_filters( 'foodland_body_classes', $classes );

		return $classes;
	}
endif; //foodland_body_classes
add_filter( 'body_class', 'foodland_body_classes' );


if ( ! function_exists( 'foodland_post_classes' ) ) :
	/**
	 * Adds foodland post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since Foodland 0.2
	 */
	function foodland_post_classes( $classes ) {
		//Getting Ready to load data from Theme Options Panel
		$options 		= foodland_get_theme_options();

		$contentlayout = 'excerpt-image-left clear';

		if ( is_archive() || is_home() || is_search() || is_front_page() ) {
			$classes[] = $contentlayout;
		}

		return $classes;
	}
endif; //foodland_post_classes
add_filter( 'post_class', 'foodland_post_classes' );


if ( ! function_exists( 'foodland_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own foodland_archive_content_image(), and that function will be used instead.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_archive_content_image() {
		if ( has_post_thumbnail() ) { ?>
			<figure class="entry-thumbnail one-half">
	            <a rel="bookmark" href="<?php the_permalink(); ?>">
	            <?php the_post_thumbnail( 'foodland-archive-left-right' ); ?>
				</a>
	        </figure><!-- .entry-thumbnail-->
	   	<?php
		}
	}
endif; //foodland_archive_content_image
add_action( 'foodland_before_entry_container', 'foodland_archive_content_image', 10 );


if ( ! function_exists( 'foodland_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own foodland_single_content_image(), and that function will be used instead.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_single_content_image() {
		global $post, $wp_query;
		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();


		// Getting data from Theme Options
	   	$options = foodland_get_theme_options();
	   	if( has_post_thumbnail() ){
		?>
			<figure class="featured-image large ?>">
                <?php the_post_thumbnail( 'large' ); ?>
	        </figure>
	   	<?php
	   }
	   else
	   	return '<!-- No Post/Page image thumbnail -->';
	}
endif; //foodland_single_content_image
add_action( 'foodland_before_post_container', 'foodland_single_content_image', 10 );
add_action( 'foodland_before_page_container', 'foodland_single_content_image', 10 );


if ( ! function_exists( 'foodland_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action foodland_comment_section
	 *
	 * @since Foodland 0.2
	 */
	function foodland_get_comment_section() {
		
			if( is_page() || is_single() )
				if ( comments_open() || '0' != get_comments_number() )
				comments_template();
	}
endif;

add_action( 'foodland_comment_section', 'foodland_get_comment_section', 10 );

/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action foodland_footer
 *
 * @since Foodland 0.2
 */
function foodland_footer_content() {
	//foodland_flush_transients();
	if ( ( !$foodland_footer_content = get_transient( 'foodland_footer_content' ) ) ) {
		echo '<!-- refreshing cache -->';

		// get the data value from theme options
		$options             = foodland_get_theme_options();
		
		$defaults            = foodland_get_default_theme_options();
		
		$footer_content      = __( 'Copyright &copy; All Rights Reserved', 'foodland' );
		
		$replace             = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );
		
		$disable_social_icon = $options['disable_social_icon'];
		
		$social_media_icon   = foodland_get_social_icons();


		if ( !empty( $footer_content ) || !empty( $social_media_icon  ) ) {
			$foodland_footer_content .=  '
				<div class="wrapper clear">
                	<div class="footer-bottom">';

            if( !$disable_social_icon ){
	            $foodland_footer_content .=
	             			'<div class="one-half">
								<div class="social-links">';
	            $foodland_footer_content .= $social_media_icon;

	            $foodland_footer_content .= '
	            				</div> <!-- .social-links -->
	            			</div><!-- .one-half -->';
            }
            
            if( !empty( $footer_content ) ){     
            	$foodland_footer_content .= '
             			<div class="clear"></div>
            			<div class="copyright">    
                      		<p>' . wp_kses_data( $footer_content )  .'</p>
                    	</div><!-- .copyright -->';
            }

            $foodland_footer_content .= '            
               		</div><!-- footer-bottom -->
           		</div>';

	    	set_transient( 'foodland_footer_content', $foodland_footer_content, 86940 );
	    }
    }

    echo $foodland_footer_content;
}
add_action( 'foodland_footer', 'foodland_footer_content', 100 );

if ( ! function_exists( 'foodland_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function foodland_page_post_meta() {
		$foodland_author_url = esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );

		$foodland_page_post_meta = '<span class="post-time">' . __( 'Posted on', 'foodland' ) . ' <time class="entry-date updated" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time></span>';
	    $foodland_page_post_meta .= '<span class="post-author">' . __( 'By', 'foodland' ) . ' <span class="author vcard"><a class="url fn n" href="' . $foodland_author_url . '" title="View all posts by ' . get_the_author() . '" rel="author">' .get_the_author() . '</a></span>';

		return $foodland_page_post_meta;
	}
endif; //foodland_page_post_meta


if ( ! function_exists( 'foodland_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since 1.5
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function foodland_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //foodland_truncate_phrase


if ( ! function_exists( 'foodland_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since 0.1
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function foodland_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		//* Strip tags and shortcodes so the content truncation count is done correctly
		$content = wp_kses_post( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		//* Remove inline styles / scripts
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		//* Truncate $content to $max_char
		$content = foodland_truncate_phrase( $content, $max_characters );

		//* More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', esc_url( get_permalink() ), esc_html( $more_link_text ) ),  $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'foodland_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //foodland_get_the_content_limit


if ( ! function_exists( 'foodland_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action foodland_after_post
	 *
	 * @since Foodland 0.2
	 */
	function foodland_post_navigation() {
		$options	= foodland_get_theme_options();
		
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next &rarr;', 'foodland' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'foodland' ) . '</span> ',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&larr; Previous', 'foodland' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'foodland' ) . '</span> ',
		) );
	}
endif; //foodland_post_navigation
add_action( 'foodland_after_post', 'foodland_post_navigation', 10 );


if( ! function_exists( 'foodland_archive_class' )) :
	/**
	 * Displays Archive class
	 *
	 * @since Foodland 0.2
	 */
function foodland_archive_class(){
	$content_class  = '';
	if( has_post_thumbnail() ){
		$content_class = 'news-content-wrapper one-half';
	}
	else
		$content_class = 'news-content-wrapper';

	return $content_class;
}
endif; //foodland_archive_class

if ( ! function_exists( 'foodland_nova_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in nova menu Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own foodland_nova_archive_content_image(), and that function will be used instead.
	 *
	 * @since Foodland 0.2
	 */
	function foodland_nova_archive_content_image() {
		$options 			= foodland_get_theme_options();

		if ( has_post_thumbnail() ) { ?>
			<figure class="entry-thumbnail one-half">
	            <a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'foodland-nova-archive' ); ?>
				</a>
	        </figure><!-- .entry-thumbnail-->
	   	<?php
		}
		else{
		?>
			<figure class="entry-thumbnail one-half">
	            <a rel="bookmark" href="#">
	            	<img src="<?php echo get_template_directory_uri(); ?>/images/no-featured-image.png" width="570px" height="800px">
				</a>
	        </figure><!-- .entry-thumbnail-->
	    <?php 
		}
	}
endif; //foodland_nova_archive_content_image
add_action( 'foodland_before_nova_entry_container', 'foodland_nova_archive_content_image', 10 );

if ( ! function_exists( 'foodland_slider_excerpt_limit' ) ) :
	/**
	 * Function to return excerpt content for Slider
	 *
	 * @return string Limited content.
	 */
	function foodland_slider_excerpt_limit( $length = 30, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}
		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 35;
		}
		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, ' ...' );
		return $trimmed_content;
	}

endif; //foodland_slider_excerpt_limit

if ( ! function_exists( 'foodland_nova_menu_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the menu section , tags.
	 *
	 * @since Foodland 0.1
	 */
	function foodland_nova_menu_entry_footer() {
		global $post;

		echo '<p class="entry-meta">';
		// get menu sections
		$food_items_section     = wp_get_post_terms( $post->ID, 'nova_menu' );

		// check if at least one menu section is assigned
		if( count( $food_items_section ) > 0 ){
		
			$food_item_section_name = $food_items_section[0]->name ;
			$food_item_section_link = get_term_link( $food_items_section[0]->term_id, 'nova_menu' );

			printf( '<span class="menu-section">%1$s' . __( 'posted in', 'foodland') . ' %2$s</span>',
						sprintf( '<span class="screen-reader-text">' . _x( 'Menu Section','Used before menu section.', 'foodland' ) .'</span>' ),
						sprintf( '<a href="'. esc_url( $food_item_section_link ) .'" rel="menu section">'. esc_html( $food_item_section_name ) . '</a>' )
			);
		}

		// get menu labels
		$food_item_labels     = wp_get_post_terms( $post->ID, 'nova_menu_item_label' );
		// check if at least one menu label is assigned
		if( count( $food_item_labels ) > 0  ){
			$tag_lists = '';
			foreach ( $food_item_labels as $food_item_label ) {
				$tag_name  = $food_item_label->name;
				$tag_link  = get_term_link( $food_item_label->term_id, 'nova_menu_item_label' );
				$tag_lists =  $tag_lists .'<a href="' . esc_url( $tag_link ) . '" rel="menu label">' . esc_html( $tag_name ). ', ' . '</a>';
			}
			// $tag_lists = substr_replace( $tag_lists, '', -6 ); // remove last occurance comma (,) with ('') in the string

			printf( '<span class="menu-label">%1$s %2$s</span>',
						sprintf( '<span class="screen-reader-text">' . _x( 'Menu Labels','Used before menu tags.', 'foodland' ) .'</span>' ), wp_kses_data( $tag_lists )
			);
		}

		edit_post_link( esc_html__( ' Edit', 'foodland' ), '<span class="edit-link">', '</span>' );
		echo '</p><!-- .entry-meta -->';
	}
endif; //foodland_nova_menu_entry_footer

if ( ! function_exists( 'foodland_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action foodland_footer action
	 * @uses set_transient and delete_transient
	 */
	function foodland_scrollup() {
		//foodland_flush_transients();
		if ( !$foodland_scrollup = get_transient( 'foodland_scrollup' ) ) {

			// get the data value from theme options
			$options         = foodland_get_theme_options();
			$enable_scrollup = $options['enable_scrollup']; // check if scroll up option is enabled

			if( $enable_scrollup ){
			echo '<!-- refreshing cache -->';

				$foodland_scrollup =  '<a href="#masthead" id="scrollup" class="genericon"><span class="screen-reader-text">' . __( 'Scroll Up', 'foodland' ) . '</span></a>' ;
			}

			set_transient( 'foodland_scrollup', $foodland_scrollup, 86940 );
		}
		echo $foodland_scrollup;
	}
}
add_action( 'foodland_after', 'foodland_scrollup', 10 );