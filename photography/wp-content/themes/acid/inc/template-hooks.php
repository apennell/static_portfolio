<?php


/**
 * Modify Body Class
 */
add_filter( 'body_class', 'village_body_class' );
function village_body_class( $classes ) {

	if ( is_sidebar_enabled() ) {
		$classes[] = "sidebar-enabled";
	} else {
		$classes[] = 'sidebar-disabled';
	}

	return $classes;
}

