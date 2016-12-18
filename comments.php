<?php
/**
 * The template for displaying Comments
 *
 * @package Theme Palace
 * @subpackage Foodland
 * @since Foodland 0.2
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="reply-thread">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<div class="coment-value">
			<h4 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'foodland' ),
					number_format_i18n( get_comments_number() ), '<span>' . esc_html( get_the_title() ) . '</span>' );
			?>
			</h4>
		</div><!-- .coment-value -->

		<div class="comment-content">
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'foodland' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'foodland' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'foodland' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>
		
		<ul class="coment-lists">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use foodland_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define foodland_comment() and that will be used instead.
				 * See foodland_comment() in foodland/functions.php for more.
				 */
				wp_list_comments( array( 
					'callback' => 'foodland_comment',
					'style' => 'ul',
					'avatar_size' => 70,
					'short_ping' => true,
				) );
			?>
		</ul>		

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'foodland' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'foodland' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'foodland' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'foodland' ); ?></p>
	<?php endif; ?>

	<?php 
	$comments_args = array(
        // change the title of send button 
        'label_submit'		=> __( 'Post Comment', 'foodland' ),

        'class_submit'		=> 'btn-custom btn-post',

        // change the title of the reply section
        'title_reply'		=> __( 'Write a Reply or Comment', 'foodland' ),

        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',

        // redefine your own textarea (the comment body)
        'comment_field' 	=> '<p class="comment-form-comment"><label for="comment">' . _x( 'Leave your comment','comment label', 'foodland' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true" placeholder="' . _x( 'Comment here...', 'comment placeholder', 'foodland' ) . '""></textarea></p>',
	);
	comment_form( $comments_args ); ?>

	</div><!-- .comment-content -->

</div><!-- #comments -->
