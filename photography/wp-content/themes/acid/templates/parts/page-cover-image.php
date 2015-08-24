<div class="cover-image hscol large page">
	<?php 
	if( has_post_thumbnail() ) {
		$background_featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID ) );
		echo get_the_post_thumbnail( $post->ID, "large" );
	} else {
		echo "<h1>No featured image was set. Please set a featured image for this page tempalte type.</h1>";
	}
	?>
</div>	