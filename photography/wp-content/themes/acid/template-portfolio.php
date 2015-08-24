<?php
/*
* Template Name: Layout: Portfolio
*/
/*
 * @package acid
 * @since acid 1.0
 * @updated acid 1.4.6
 */

get_header();

if ( ! isset( $village_page ) ) {
	$village_page = get_current_page();
	set_query_var( 'village_page', $village_page );
}


$posts_per_page = get_option( "posts_per_page" );
if ( $village_page === 1 ) {
	$posts_per_page ++;
	$page_offset = 0;
} else {
	$page_offset = 1 + ( $village_page - 1 ) * $posts_per_page;
}

$query = new WP_Query( "post_type=portfolio&offset={$page_offset}&paged={$village_page}&posts_per_page={$posts_per_page}" );


set_query_var( 'village_query', $query );
set_query_var( 'village_page', $village_page );
?>

<?php if ( $query->have_posts() ) : ?>

	<?php
	get_template_part( 'horizontal/layout' );
	wp_reset_query();
	?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>

</div>
<?php get_footer(); ?>