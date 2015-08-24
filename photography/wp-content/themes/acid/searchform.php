<?php
/**
 * The template for displaying search forms in acid
 *
 * @package acid
 * @since acid 1.0
 */
?>
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="screen-reader-text"><?php _ex( 'Search', 'assistive text', 'puremellow' ); ?></label>
		<div class="search-container">
		<input type="search" class="searchfield field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'puremellow' ); ?>" />
		<input type="submit" class="submit batch" id="searchsubmit" value="&#xF097;"/>
		</div>
	</form>
