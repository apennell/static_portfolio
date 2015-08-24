<?php
/**
 * @package Acid
 * @since   Acid 1.1
 */

$post_hover_color = get_post_color( get_the_ID() );
?>
<div class="box" data-follower-color="<?php echo $post_hover_color; ?>"
     style="background-color: <?php echo $post_hover_color; ?>;">
	<?php
	if ('pop_up' === Village::get_theme_mod( "colorbox", 'pop_up' ) && true === has_post_thumbnail()):
	$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	?>

	<a class="box__link  js--link  colorbox" rel="protfolio" href="<?php echo $featured_image_url; ?>"
	   title="<?php the_title_attribute(); ?>">
	<?php
	else:
	?>
		<a class="box__link js--link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php endif; ?>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( "pure_thumbnail" ); ?>
			<?php endif; ?>

			<div class="box__content <?php if ( ! has_post_thumbnail() )
				echo "visible" ?>">
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</div>
		</a>

</div>