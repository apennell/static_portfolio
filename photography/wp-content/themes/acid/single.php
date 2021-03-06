<?php
/**
 * The Template for displaying all single posts.
 *
 * @package acid
 * @since acid 1.0
 */

get_header(); 

$previous_post = get_previous_post();
$next_post = get_next_post();
$post_color = get_post_color($post->ID);

?>
<?php  if ( ! empty( $next_post ) ): ?>
	<?php $color_next = get_post_color( $next_post->ID ); ?>
	<div id="next-post" class="static-nav  next-post  js--post-link  hoverable" data-color="<?php echo $color_next;?>" style="background-color: <?php echo $post_color; ?>">
		<div class="meta-container">
			<div class="meta">
				<div class="adjacent-title">
					<?php next_post_link("%link"); ?>
				</div>
			</div>
			<div class="post-nav-image"></div>
		</div>
	</div>
<?php else: ?>
<div id="next-post" class="static-nav  next-post  js--post-link" data-color="<?php echo $post_color;?>" style="background-color: <?php echo $post_color; ?>">
</div>
<?php endif; ?>


<?php  if ( ! empty( $previous_post ) ): ?>
	<?php $color_previous = get_post_color( $previous_post->ID ); ?>
	<div id="prev-post" class="static-nav  prev-post  js--post-link  hoverable" data-color="<?php echo $color_previous;?>" style="background-color: <?php echo $post_color; ?>">
		<div class="meta-container">
			<div class="post-nav-image"></div>
			<div class="meta">
				<div class="adjacent-title">
					<?php previous_post_link("%link"); ?>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
<div id="prev-post" class="static-nav  prev-post  js--post-link" data-color="<?php echo $post_color;?>" style="background-color: <?php echo $post_color; ?>">
</div>
<?php endif; ?>

	
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main" data-color="<?php echo $post_color; ?>">


			<?php if( Village::is_enabled('show_post_date') ): ?>
				<div class="entry-header--aside">
					<div class="entry-date">
						<div class="month"><?php the_time("M");?></div>
						<div class="date"><?php the_time("d");?></div>
						<div class="year"><?php the_time("Y");?></div>
					</div>
				</div>
			<?php endif;?>
				
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'parts/content', 'single' ); ?>
				<?php endwhile; // end of the loop. ?>
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
<?php get_footer(); ?>