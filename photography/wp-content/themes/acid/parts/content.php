<?php
/**
 * @package acid
 * @since acid 1.0
 */
?>

 
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header palm-hide">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php
			if ( comments_open() ):
				comments_popup_link(0, 1, "%", "comments-link");
			endif;
			?>

			<div class="entry-meta">
				<?php get_template_part( 'parts/header__meta' ); ?>
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'acid' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'acid' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

			<?php edit_post_link( __( 'Edit', 'acid' ), '<span class="edit-link">', '</span>' ); ?>
	</article><!-- #post-## -->

