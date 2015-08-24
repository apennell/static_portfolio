<?php

if ( ! isset( $village_page ) ) {
	$village_page = get_current_page();
	set_query_var( 'village_page', $village_page );
}

?>

<?php if ( have_posts() ) : ?>

	<div id="scrollbar">
		<div id="primary" class="viewport" data-horizontal-scroll="on">
			<div id="content" class="overview" role="main">

				<?php if ( is_archive() && $village_page === 1 ): ?>
					<div class="hscol vertical-title-container">

						<div class="arrow-right"></div>
						<div class="arrow-bottom"></div>

						<h2 class="vertical-title vertical-title--archive">
							<?php
							if ( is_category() ) {
								printf( __( 'Category %s', 'acid' ), '<span>' . single_cat_title( '', false ) . '</span>' );

							} elseif ( is_tag() ) {
								printf( __( 'Tag %s', 'acid' ), '<span>' . single_tag_title( '', false ) . '</span>' );

							} elseif ( is_author() ) {
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								*/
								the_post();
								printf( __( 'Author: %s', 'acid' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();
							}
							?>
						</h2>
					</div>
					<!-- .hscol.vertical-title-container-->

				<?php endif; ?>


				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part('horizontal/loop-horizontal-entry');
				}

				// Clean up
				Horizontal_Entry::clean_up();

				?>
				<?php village_pagination() ?>
			</div>
			<!-- #content -->

		</div>
		<!-- #primary -->

		<div class="scrollbar">
			<div class="track">
				<div class="thumb"></div>
			</div>
		</div>

	</div> <!-- #scrollbar -->
<?php else : ?>
	<div id="primary">
		<div id="content" role="main">
			<?php get_template_part( 'no-results', 'index' ); ?>
		</div>
		<!-- #content -->
	</div> <!-- #primary -->
<?php endif; ?>
