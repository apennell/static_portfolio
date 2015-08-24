<?php


class Village_Class_Ext extends Village {

	
	public static function get_from_meta($meta_array, $get, $on_failure = false) {

		if( !isset( $meta_array[$get] ) || empty( $meta_array[$get] ) ) {
			return $on_failure;
		} 
		else {

			if( is_array( $meta_array[$get] ) ) {
				$return =  $meta_array[$get][0];
			} 
			else {
				$return = $meta_array[$get];	
			}

			if ($return == "0" or $return == "false" or $return == false) {
				return false;
			} else {
				
				return $return;

			}
			




		}
	}

	public static function setup() {

		/* -----------------------------------*/
		/* 		Thumbnails
		/* -----------------------------------*/

		// Blog
		add_image_size( 'pure_thumbnail_large', 1200, 1200, true );
		add_image_size( 'pure_thumbnail', 600, 600, true );
		add_image_size( 'pure_mini', 125, 125, true );

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on InkBerry, use a find and replace
		 * to change 'inkberry' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'acid', get_template_directory() . '/lang' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );


		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
		                   'primary' => __( 'Primary Menu', 'puremellow' ),
		                   'footer-menu' => __( 'Footer Menu', 'puremellow' )
		                   ) );

		/**
		 * Add support for the Aside Post Formats
		 */
		add_theme_support( 'post-formats', array( 'quote' ) );

		/**
		* 	Custom Background Image Options
		*/
		$args = array(
			'default-color' => '',
			'default-image' => '',
		);

		$args = apply_filters( 'village_custom_background_args', $args );
		add_theme_support( 'custom-background', $args );

	}

}