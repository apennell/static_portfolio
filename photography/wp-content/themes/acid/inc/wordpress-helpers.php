<?php

function pure_get_post_images($sizes = 'thumbnail') {
	global $post;

	$sizes = array_map('trim', explode(',', $sizes));
	$thumbnail_id = get_post_thumbnail_id( $post->ID );


	if(is_string($sizes)) {
		$sizes = (array)$sizes;
	}

	$photos = get_children( array(
					'post_parent' => $post->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order ID',
					'exclude' => $thumbnail_id
					) 
	);

	$results = array();

	if ( $photos && !is_wp_error( $photos ) ) {
		foreach ($photos as $photo) {
			foreach($sizes as $size) {
				$out[$size] =  array_shift(wp_get_attachment_image_src($photo->ID, $size));
			}
			$results[] = $out;
		}
	}

	return $results;
}

function pure_get_post_image_ids() {
	global $post;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );

	$photos = get_children( array(
					'post_parent' => $post->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order ID',
					'exclude' => $thumbnail_id
					) 
	);

	$results = array();

	if ( $photos && !is_wp_error( $photos ) ) {
		foreach ($photos as $photo) {
			$results[] = $photo->ID;
		}
	}
	return $results;
}
