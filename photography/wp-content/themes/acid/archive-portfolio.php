<?php
get_header();
?>

	<?php if ( have_posts() ) : ?>
		<?php get_template_part('horizontal/layout'); ?>
	<?php else : ?>
		<div id="primary">
			<div id="content" role="main">
				<?php get_template_part( 'no-results', 'index' ); ?>
			</div><!-- #content -->
		</div> <!-- #primary -->
	<?php endif; ?>

	
<?php get_footer(); ?>