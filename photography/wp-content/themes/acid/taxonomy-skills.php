<?php
/**
 * The main template file.
 *
 * @package acid
 * @since acid 1.0
 * @updated acid 1.4.6
 */

get_header(); 
?>

<?php if ( have_posts() ) : ?>
	<?php get_template_part('horizontal/layout'); ?>
<?php else : ?>
	<?php get_template_part( 'no-results', 'index' ); ?>
<?php endif; ?>


<?php get_footer(); ?>