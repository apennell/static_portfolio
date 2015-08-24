<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Acid
 * @since Acid 1.0
 */

if ( ! function_exists( 'village_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Acid 1.0
	 */
	function village_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;

		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() )
			$nav_class = 'site-navigation post-navigation';
?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'themevillage' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'themevillage' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'themevillage' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'themevillage' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'themevillage' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
	}
endif; // village_content_nav

if ( ! function_exists( 'village_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Acid 1.0
	 */
	function village_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		if(in_array("bypostauthor", get_comment_class() )) {
				$is_author = true;
		} else {
				$is_author = false;
			}


		switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'themevillage' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'themevillage' ), ' ' ); ?></p>
	<?php
		break;
	default :


?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment__container cf">

				<footer class="comment-author g one-sixth lap-one-fifth palm-one-whole">
						
						<div class="avatar-container">
							<?php echo get_avatar( $comment, 125 ); ?>
						</div>



					<div class="comment-meta commentmetadata">						
						<?php edit_comment_link( __( '(Edit)', 'themevillage' ), ' ' );?>

					</div><!-- .comment-meta .commentmetadata -->

				</footer>

				<div class="comment-content g five-sixths lap-four-fifths palm-one-whole">
					<div class="name">
						<?php echo get_comment_author_link(); ?>
					</div>

						<?php 
						// Currently Disable is_author
						$is_author = false;
						if (true === $is_author): ?>
							<span class="is-author">
								<?php _e( "Author", 'themevillage' ); ?> </span>
							<br>						
							<?php endif; ?>
					<time class="comment-meta" pubdate datetime="<?php comment_time( 'c' ); ?>">
							<?php echo get_comment_time(); ?>
							<?php echo get_comment_date(); ?> &colon; 
					</time><br>

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'themevillage' ); ?></em>
						<br />
					<?php endif; ?>
					<?php comment_text(); ?></div>
			</div><!--  .comment__container -->

			<div class="reply batch">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => '&#xF158;','depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
		break;
		endswitch;
	}
endif; // ends check for village_comment()


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Acid 1.0
 */
function village_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so village_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so village_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in village_categorized_blog
 *
 * @since Acid 1.0
 */

function village_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'village_category_transient_flusher' );
add_action( 'save_post', 'village_category_transient_flusher' );
