<?php if ( has_post_thumbnail()) : ?>
   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail(  esc_url( Village::get_theme_mod("thumbnail_size", "village_thumbnail_medium_wide" ) ) ); ?>
   </a>
<?php endif; ?>