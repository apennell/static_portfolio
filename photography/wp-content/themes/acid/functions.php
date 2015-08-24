<?php

// IMPORTANT: Do not remove this line or change its position
require_once( get_template_directory() . '/inc/includes.php' );


/**
 * acid functions and definitions
 *
 * @package acid
 * @since   acid 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since acid 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
} /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since acid 1.0
 */
function village_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'themevillage' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'themevillage' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

/**
 * Enqueue and Register scripts and styles
 */
function village_scripts() {
	$protocol = ( is_ssl() ) ? "https" : "http";

	/* -----------------------------------*/
	/* 		Register / Deregister
	/* -----------------------------------*/
	// We're fetching our own style

	if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
		$style = 'style.css';
	} else {
		$style = 'style.min.css';
	}

	wp_register_style( 'style', get_template_directory_uri() . '/css/' . $style );
	wp_register_style( 'village-social-icons', get_template_directory_uri() . '/css/social.css' );
	wp_register_style( 'oxygen-font', $protocol . '://fonts.googleapis.com/css?family=Oxygen:400,300,700' );

	/* -----------------------------------*/
	/* 		Enqueue
	/* -----------------------------------*/
	wp_enqueue_style( 'style' );
	wp_enqueue_style( 'oxygen-font' );

	// All compressed libraries in /js/libs/*
	wp_enqueue_script(
		'compressed-libs',
		get_template_directory_uri() . '/js/libs.js',
		array( 'jquery' ),
		null,
		true // In Footer ?
	);

	// Main JavaScript file (Compressed coffeescript from /js/coffee/* )
	wp_enqueue_script(
		'app',
		get_template_directory_uri() . '/js/app.js',
		array( 'jquery', 'compressed-libs' ),
		null,
		true // In Footer ?
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply', $in_footer = true );
	}

	// if ( is_single() ) {
	// 	wp_enqueue_script( 'post_colors', 
	// 		get_template_directory_uri() . '/js/post_colors.js', 
	// 		array( 'jquery' ), 
	// 		null,
	// 		true // In Footer ? 
	// 	);
	// }

	if ( ! is_admin() ) {
		wp_dequeue_style( 'tipsy-social-icons' );
		wp_enqueue_style( 'village-social-icons' );
	}
}

function village_scripts_child() {
	wp_register_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style' );
}


/* -----------------------------------*/
/* 		Modify Plugins
/* -----------------------------------*/

if ( class_exists( 'Tipsy_Social_Icons' ) ) {
	// Modify the looks of the Social Icon to hearts content
	function modify_social_icon( $args ) {
		extract( $args );
		?>
		<a href="<?php echo $network_value ?> " class="pure-icon icon-<?php echo $network ?> small-box">
			<span class="icon"><?php echo ucfirst( $network ) ?></span>
		</a>

		<?php
	}

	add_action( 'tipsy_social_render_icon', 'modify_social_icon' );


	// Remove Tipsy Options
	function edit_tipsy_options( $args ) {
		return array(
			"behance",
			"digg",
			"dribbble",
			"facebook",
			"flickr",
			"deviantart",
			"forrst",
			"github",
			"googleplus",
			"lastfm",
			"linkedin",
			"pinterest",
			"rss",
			"skype",
			"stumbleupon",
			"twitter",
			"vimeo",
			"yelp",
			"youtube",
		);
	}

	add_filter( 'tipsy_social_networks', 'edit_tipsy_options' );
	add_filter( 'tipsy_social_options', '__return_empty_array' );
}


/**
 * Pure Shortcode Modification
 *
 * @param $wp_query
 * @param $atts - Shortcode Attributes
 *
 * @return string      Return the content
 *
 * Note: Do not echo. Process and Return!
 * @internal param $ (array) $args Arguments passed from Shortcode
 *
 */
function acid_print_items( $query, $atts ) {
	$out = "";
	ob_start();  // Yeah. We'll capture a Template part like this. 


	// Don't print shortcode entries as large-thumbnails
	// Kind of a hack: Set the village_page to be 2
	set_query_var( 'village_page', 2 );

	while ( $query->have_posts() ) {
		$query->the_post();
		get_template_part( 'horizontal/loop-horizontal-entry' );
	}

	Horizontal_Entry::clean_up();

	$out .= ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();

	return $out;
}


function wp_version_compare( $version ) {
	$wp_version = get_bloginfo( "version" );

	return version_compare( $version, $wp_version );
}


/* -----------------------------------*/
/* 		Load 1 more post on Index Page
/* -----------------------------------*/
function village_pre_get_posts( $query ) {
	# We only care if this thing isn't paged
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$posts_per_page = get_option( "posts_per_page" );
	// Add one more post, if in the first page
	if ( is_home() || is_archive( "skills", "project-types" ) || is_post_type_archive( "portfolio" ) ) {
		if ( ! is_paged() ) {
			$query->set( "posts_per_page", $posts_per_page + 1 );

			return;
		} else {

			//Manually determine page query offset (offset + current page (minus one) x posts per page)
			$page_offset = 1 + ( ( $query->get( 'paged' ) - 1 ) * $posts_per_page );

			//Apply adjust page offset
			$query->set( 'offset', $page_offset );
		}

	}
}


/* -----------------------------------*/
/* 		Pure Functions
/* -----------------------------------*/

function village_pagination( $wp_query = false ) {
	if ( $wp_query === false ) {
		global $wp_query;
	}
	$total_pages = $wp_query->max_num_pages;

	if ( $total_pages > 1 ): ?>
		<div class="page-links">
			<?php
			$current_page = max( 1, get_query_var( 'paged' ) );
			echo paginate_links( array(
				'base'      => get_pagenum_link( 1 ) . '%_%',
				'format'    => 'page/%#%',
				'current'   => $current_page,
				'total'     => $total_pages,
				'type'      => 'list',
				'prev_text' => __( "&larr;", "themevillage" ),
				'next_text' => __( "&rarr;", "themevillage" ),
			) );
			?>
		</div>
		<?php
	endif;
}


/*
*	Gets the real current page
*
*	@since acid 1.1
*/
function get_current_page() {
	if ( get_query_var( 'paged' ) ) {
		return get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		return get_query_var( 'page' );
	} else {
		return 1;
	}
}

/* -----------------------------------*/
/* 		In case sanitize_hex_color doesn't exist
/* -----------------------------------*/
if ( ! function_exists( "sanitize_hex_color" ) ) {
	function sanitize_hex_color( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}

		return null;
	}
}

/* -----------------------------------*/
/* 		Get post color
/* -----------------------------------*/
function get_post_color( $post_id = false ) {

	if ( is_numeric( $post_id ) ) {
		$color = get_post_meta( $post_id, 'pure_post_color', true );
	}

	if ( empty( $color ) ) {
		$color = sprintf( '#%06X', mt_rand( 0, 0xFFFFFF ) );
	}

	return sanitize_hex_color( $color );
}


/* -----------------------------------*/
/* 		Add / Remove Actions
/* -----------------------------------*/
// Add actions
add_action( 'widgets_init', 'village_widgets_init' );

add_action( 'wp_enqueue_scripts', 'village_scripts', 1000 );

if ( is_child_theme() ) {
	add_action( 'wp_enqueue_scripts', 'village_scripts_child', 1001 );
}


add_action( 'pre_get_posts', 'village_pre_get_posts', 1 );

// Add Filters
add_filter( 'pure_print_items', 'acid_print_items', 10, 2 );


// Remove Portfolio RW Meta Box if we're using Colorbox type portfolio
if ( true === Village::is_enabled( "colorbox", false ) ) {
	remove_action( "admin_menu", "village_portfolio_meta" );
}


// Clean your head:
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
