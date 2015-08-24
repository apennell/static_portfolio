<?php

if ( ! function_exists( 'get_meta_with_defaults' ) ) {
	function get_meta_with_defaults( $post_id, $defaults ) {
		return wp_parse_args( get_post_meta( $post_id ) , $defaults );
	}	
}

/* -----------------------------------*/
/* 	Meta
/* -----------------------------------*/
$meta_to_ext = array(
	'pure_portfolio_client',
	'pure_portfolio_url',
	'pure_portfolio_url_title',
	'pure_portfolio_copyright',
	'pure_portfolio_project_date',
);



$defaults = array_fill_keys($meta_to_ext, array());

# Array shift gets the first value from the meta
$meta = array_map('array_shift', get_meta_with_defaults($post->ID, $defaults));

$filtered_meta = wp_array_slice_assoc( $meta, $meta_to_ext );

extract( $filtered_meta );


/* -----------------------------------*/
/* 	Skills & Taxonomies
/* -----------------------------------*/
$project_types = get_the_term_list( $post->ID, 'project-types', '<li><span class="split__title">'.__('Project Type', 'puremellow').'</span> ', ' / '); 
$skills = get_the_term_list( $post->ID, 'skills', '<li><span class="split__title">'.__('Skills', 'puremellow').'</span> ', ' / ' ); 

/* -----------------------------------*/
/* 	Media
/* -----------------------------------*/
$project_embed = Pure_Portfolio::get_embed( $post->ID );
$project_gallery = Pure_Portfolio::get_images( $post->ID, array('village_mini', 'large') );


/* -----------------------------------*/
/* 	Content
/* -----------------------------------*/
$the_content = get_the_content();


/* -----------------------------------*/
/* 	True/False values about this entry
/* -----------------------------------*/

$is_terms_empty = ( empty($project_types) && empty($skills) );
$is_meta_empty = ( array_filter( $filtered_meta ) === array() );

$is_slider_control_needed = ( !empty( $project_gallery ) && count( $project_gallery ) > 0 );

?>
<header class="entry-title">
	<h1 class="portfolio-title"><?php the_title(); ?></h1>
</header><!-- .entry-header -->

<article <?php post_class(); ?>>
		<div class="slider">
			<div class="flexslider purejs__slider">
				<ul class="slides">
					<?php
						if ( !empty( $project_embed ) ):
							?>
							<li class="portfolio-image--large slide video-slide">
								<div class="clickable-video"></div>
								<div class="fitvids">
									<?php echo wp_oembed_get( $project_embed ); ?>
								</div>
							</li>
							<?php
						endif;
					?>


					<?php
						if ( !empty( $project_gallery ) ):
							foreach ( $project_gallery as $image ):
							?>
								<li class="portfolio-image--large slide">
									<a class="popup-image" href="<?php echo $image['large']; ?>"><img src="<?php echo $image['large'] ?>" title="<?php the_title(); ?>" /></a>
								</li>
							<?php
							endforeach;
						endif;
					?>

				</ul>
			</div>	
		</div>

	<?php if ( $is_slider_control_needed ): ?>
		<div class="entry-info slide-control">
			<h4 class="title"><?php _e("Project Images", "pure"); ?></h4>
			
			<?php /*
				Having a Dejavu ?
				Yes, you've seen this code above, with a slight difference. 
				This thing right here asks for $image['pure_mini'] instead of $image['large']
				Because this is the slider navigation
			 */ ?>
			<div class="flexslider purejs__slider--control">
					<ul class="slides">
					<?php
						if ( !empty( $project_embed ) ):
							?>
							<li class="portfolio-image--large slide video-slide">
								<div class="clickable-video"></div>
								<div class="fitvids">
									<?php echo wp_oembed_get( $project_embed ); ?>
								</div>
							</li>
							<?php
						endif;
					?>


					<?php
						if ( !empty( $project_gallery ) ):
							foreach ( $project_gallery as $image ):
							?>
								<li class="portfolio-image--large slide">
									<a class="popup-image" href="<?php echo $image['village_mini']; ?>"><img src="<?php echo $image['village_mini'] ?>" title="<?php the_title(); ?>" /></a>
								</li>
							<?php
							endforeach;
						endif;
					?>
					</ul>
			</div>
		</div>
	<?php endif; ?>


	<?php if ( !$is_terms_empty || !$is_meta_empty ): ?>
		<div class="entry-info details">
			<h4 class="title"><?php _e("Project Details", "pure"); ?></h4>
			<ul class="split">
				<?php
				// Project Date
				if ( !empty ( $pure_portfolio_project_date ) ): ?>
					<li><span class="split__title"><?php _e('Date', 'puremellow'); ?></span>
					<?php echo $pure_portfolio_project_date; ?>
				<?php endif; ?>

				<?php 
					// Project Type
					echo $project_types;
				?>

				<?php
					// Skills
					echo $skills;
				?>


				<?php
				// Project Client
				if ( !empty ( $pure_portfolio_client ) ): ?>
					<li><span class="split__title"><?php _e('Project Client', 'puremellow'); ?></span>
					<?php echo $pure_portfolio_client; ?> 
				<?php endif; ?>

				<?php
				// Project URL
				if ( !empty ( $pure_portfolio_url ) ): 

					// Get the Link URL
					$link_url = $pure_portfolio_url;
					// Set the link title to be either the set title, or if that's empty use the URL as title
					$link_title = (!empty($pure_portfolio_url_title)) ? $pure_portfolio_url_title : $pure_portfolio_url ;
				?>
					<li><span class="split__title"><?php _e('URL', 'puremellow'); ?></span>
					<a target="_blank" rel="external nofollow" href="<?php echo $link_url;?>"><?php echo $link_title?></a>
				<?php endif; ?>



				<?php
				// Copyright
				if ( !empty ( $pure_portfolio_copyright ) ): ?>
					<li><span class="split__title"><?php _e('Copyright', 'puremellow'); ?></span>
					<?php echo $pure_portfolio_copyright; ?>
				<?php endif; ?>
			</ul>
		</div><!-- .entry-info.details -->
	<?php endif; ?>






	<?php
	if ( !empty($the_content) ):
	?>
		<div class="entry-info description">		
			<h4 class="title"><?php _e("Project Description", "pure"); ?></h4>
				<?php echo $the_content; ?>
		</div>
	<?php endif; ?>

<?php edit_post_link( __( 'Edit', 'acid' ), '<div class="entry-info"><span class="edit-link alignright">', '</span></div>' ); ?>
</article><!-- #post-## -->
