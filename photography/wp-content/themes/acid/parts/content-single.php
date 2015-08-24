<?php
/**
 * @package acid
 * @since acid 1.0
 */
?>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
		if ( comments_open() ):
			comments_popup_link(0, 1, "%", "comments-link");
		endif;
		?>

		<div class="entry-meta">
			<?php get_template_part( 'parts/header__meta' ); ?>
		</div>
	</header><!-- .entry-header -->
	<br class="clear">
 
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'acid' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

			<?php edit_post_link( __( 'Edit', 'acid' ), '<span class="edit-link">', '</span>' ); ?>
	</article><!-- #post-## -->
