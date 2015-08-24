<?php
/**
 * @package Acid
 * @since Acid 1.0
 */
$post_hover_color = get_post_color( get_the_ID() );

?>
    <div class="box large" data-follower-color="<?php echo $post_hover_color; ?>" style="background-color: <?php echo $post_hover_color;?>;">

        <?php get_template_part('parts/date'); ?>

        <a class="box__link js--link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php if ( has_post_thumbnail()) : ?>
    			   <?php the_post_thumbnail("pure_thumbnail_large"); ?>
			<?php endif; ?>

            <div class="box__content <?php if( ! has_post_thumbnail() ) echo "visible" ?>">

                <h2 class="entry-title"><?php the_title();?></h2>
                <?php if( ! has_post_thumbnail() ): ?>
                    <div class="entry-excerpt"> <?php the_excerpt();?> </div>
                <?php endif; ?>
            </div>
        </a>
        
    </div>