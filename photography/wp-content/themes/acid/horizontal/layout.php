<?php
// whitespace

if ( ! isset( $village_page ) ) {
	$village_page = get_current_page();
	set_query_var( 'village_page', $village_page );
}

if ( ! isset( $village_query ) ) {
	global $wp_query;

	if ( ! $wp_query->is_main_query() ) {

		echo '	<div class="content-area">
					<div class="entry-content">
						<h1> WP Query Error</h1>
						<p>Please report this error by creating aticket about this at http://help.themevillage.net</p></div>
					</div>
				</div>
		';

		return;
	}

	$village_query = $wp_query;
}


?>
<div id="scrollbar">
	<div id="primary" class="viewport" data-horizontal-scroll="on">
		<div id="content" class="overview" role="main">
			<?php
			while ( $village_query->have_posts() ) {

				// Setup the_post
				$village_query->the_post();
				get_template_part('horizontal/loop-horizontal-entry');

			} // endwhile

			// Clean up
			Horizontal_Entry::clean_up();

			?>

			<?php village_pagination( $village_query ) ?>
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