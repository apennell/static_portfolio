<?php

if ( ! function_exists( "is_opp_template" ) ) {
	/**
	 * Check whether current page template is "One-page layout"
	 * @return bool
	 */
	function is_opp_template() {
		return is_page_template( 'templates/page-one-page-layout.php' );
	}
}

if ( ! function_exists( "is_opp_child_template" ) ) {

	/**
	 * Check whether current page template is one of one-page children
	 * @return bool
	 */
	function is_opp_child_template() {
		if ( is_page() && (
				is_page_template( 'templates/page-blank.php' )
				|| is_page_template( 'templates/page-centered.php' )
				|| is_page_template( 'templates/page-cover-image.php' )
			)
		) {
			return true;
		} else {
			return false;
		}
	}
}


if ( ! function_exists( 'is_sidebar_enabled' ) ) {
	function is_sidebar_enabled() {

		$enabled  = Village::get_theme_mod( 'blog_sidebar', false );
		$override = get_post_meta( get_the_ID(), 'acid_blog_sidebar', true );


		// If sidebar is disabled by theme options - no more questions, @return false.
		if ( $override === 'enable' ) {
			$enabled = true;
		} elseif ( $override === 'disable' ) {
			$enabled = false;
		} // Check if this is a special case
		elseif (
			// Disable sidebar in pages
			is_singular( 'portfolio' )

			// Portfolio Template
			|| is_page_template( 'template-portfolio.php' )

			// Portfolio Archive
			|| is_post_type_archive( 'portfolio' )

			// Taxonomy Archive: portfolio_category
			|| is_tax( 'project-types' )

			|| is_tax( 'skills' )

			// 404
			|| is_404()

			// One-page Templates
			|| is_opp_template()
			|| is_opp_child_template()
		) {
			$enabled = false;
		} //endif;

		return apply_filters( 'village_enable_sidebar', $enabled );
	}
}
