<?php
	$thumbnail_above = Village::is_enabled( "thumbnail_above_title", false );

	if (  $thumbnail_above === true ) {
		get_template_part( 'parts/thumbnail', get_post_format() );
	}


?>

	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'puremellow' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>		
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php get_template_part('parts/header__meta'); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

<?php

	if (  $thumbnail_above === false ) {
		get_template_part( 'parts/thumbnail', get_post_format() );
	}

?>