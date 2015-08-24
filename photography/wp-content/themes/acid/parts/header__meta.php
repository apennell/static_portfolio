<?php
// BEGIN Posted On
if ( Village::is_enabled( 'content_header_post_author') ):
?>
	
	<div class="meta-cell">
		<span class="batch">&#xF044;</span>
		<span class="author">
			<?php the_author_posts_link(); ?>
		</span>
	</div>
<?php 
endif;

// BEGIN Categories
// 
if ( Village::is_enabled( 'content_header_categories') ):
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'themevillage' ) );
		if ( $categories_list && village_categorized_blog() ) :
?>
	<div class="meta-cell">
		<span class="batch">&#xF10A;</span>
		<span class="cat-links">
			<?php printf( __( '%1$s', 'themevillage' ), $categories_list ); ?>
		</span>
	</div>
<?php 
		endif; 
endif;
// END Categories 
?>


<?php
// BEGIN Tags
if ( Village::is_enabled( 'content_header_tags') ):
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', __( ', ', 'themevillage' ) );
	if ( $tags_list ) :
?>
<div class="meta-cell">
	<span class="batch">&#xF0AD;</span>
	<span class="tags-links">
		<?php echo $tags_list; ?>
	</span>
</div>
<?php 
	endif; 
endif;
// END Tags 
?>


<?php
edit_post_link( __( 'edit', 'themevillage' ), '<span class="edit-link"><i>(', ')</i></span>' );





