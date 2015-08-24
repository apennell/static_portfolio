<?php
/*
*	Template Name: Layout: One Page
*/
get_header(); 

$registered_custom_templates = apply_filters( "acid_custom_tempaltes", array("blank", "cover-image") );
/* -----------------------------------*/
/* 		Get the featured image before running a new query
/* -----------------------------------*/
if( has_post_thumbnail() ) {
	$background_featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID ) );
	$page_thumbnail = get_the_post_thumbnail( $post->ID, "large" );
	$main_page_width = get_post_meta( $post->ID, "acid_page_width" ,true );
} else {
	$page_thumbnail = false;
	$background_featured_image = false;
}

$paged = (get_query_var('page')) ? get_query_var('page') : 1;

$menu_items = Village_One_Page::page_get_menu_items("village_one_page");

$query = new WP_Query(array(
            'post_type' => 'page',
            'post__in' => $menu_items,
            'posts_per_page' => intval( Village::get_theme_mod( "one_page_PPP", 10 ) ),
            'orderby' => 'post__in',
            'paged' => $paged,
			));




?>
	<div id="scrollbar">
		<div id="primary" class="viewport" data-horizontal-scroll="on">
				<div id="content" class="overview" role="main">
					<?php
					if ( !empty( $main_page_width ) && false !== $page_thumbnail && $paged === 1 ):
					?>
						<div id="page-thumbnail" class="cover-image hscol large page">
							<?php echo $page_thumbnail; ?>
						</div>
					<?php
					endif;
					?>
			<?php
			if ( $query->have_posts() ) : 

			while ( $query->have_posts() ) : $query->the_post(); 
				
				$meta = get_post_meta( $post->ID );
				
				$template_name = Village_Class_Ext::get_from_meta($meta, "_wp_page_template", null);
				
				// Turns "templates/page-someVeryNice-Page_123.php" into "someVeryNice-Page_123"
				// Also accepts files not in the templates directory
				// Otherwise filters down to null and get_template_part is going to use the default tempalte
				$template_name = preg_replace("/(?:templates\/)?page-([^.]*)\.php/", "$1", $template_name);
			
				$page_title_enabled = Village_Class_Ext::get_from_meta($meta, "acid_page_title_enabled", true);
				
				// Colors
				$page_color = sanitize_hex_color( Village_Class_Ext::get_from_meta( $meta, "acid_page_color" ) );
				$page_font_color = sanitize_hex_color( Village_Class_Ext::get_from_meta( $meta, "acid_page_font_color" ) );
				$page_title_color = sanitize_hex_color( Village_Class_Ext::get_from_meta( $meta, "acid_page_title_color" ) );
				$page_title_font_color = sanitize_hex_color( Village_Class_Ext::get_from_meta( $meta, "acid_page_title_font_color" ) );
				
				// Page Width
				$page_width = Village_Class_Ext::get_from_meta($meta, "acid_page_width", "960");
				
				// Make sure the page width is only numbers, so we can safely set that to "px"
				$page_width = preg_replace( '/[^0-9]/', '', $page_width );


			?>			
				<?php if ( false !== $page_title_enabled ): ?>
					<div class="hscol vertical-title-container" style="<?php
						echo ( $page_title_color ) ? "background-color: {$page_title_color}; " : null;
						echo ( $page_title_font_color ) ? "color: {$page_title_font_color}; " : null;
					?>">
						<div class="arrow-right"<?php echo ( $page_title_color ) ? ' style="border-left-color: '.$page_title_color.';"': null; ?>></div>
						<div class="arrow-bottom"<?php echo ( $page_title_color ) ? ' style="border-top-color: '.$page_title_color.';"': null; ?>></div>
						<h2 class="vertical-title">
						<?php the_title(); ?>
						</h2>
					</div>
				<?php endif; // page_title_enabled? ?>

					<?php
					if( in_array( $template_name, $registered_custom_templates ) ):
						 get_template_part( 'templates/parts/page', $template_name );				
					else:
						
						if(has_post_thumbnail()) {
							$page_background = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID ) );
						} else {
							$page_background = false;
						}

					?>

						<div class="hscol page <?php echo $template_name ?>" style="<?php
						echo "width: {$page_width}px; ";

						// Background Color / Pattern
						echo ( ! empty( $page_color ) || $page_background ) ? "background:" : null;
						echo ( ! empty( $page_color ) ) ? "{$page_color} " : null;
						echo ( ! empty( $page_background ) ) ? "url('".$page_background."') repeat" : null;
						echo ( ! empty( $page_color ) || $page_background ) ? ";" : null;
						echo ( ! empty( $page_font_color ) ) ? "color: {$page_font_color}; " : null;
						?>">
						
						<?php
							get_template_part( 'templates/parts/page', $template_name );
						?>
						

						</div>
					<?php endif; ?>


			<?php 
				endwhile;
				village_pagination($query);
				wp_reset_query();
			 ?>
			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content -->
		</div> <!-- #primary -->

		<div class="scrollbar">
			<div class="track">
				<div class="thumb"></div>
			</div>
		</div>

	</div> <!-- #scrollbar -->
<?php get_footer(); ?>