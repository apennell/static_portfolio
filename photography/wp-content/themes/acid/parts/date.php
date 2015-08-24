<?php

$class = array('entry-date');
$display_condition = Village::get_theme_mod('show_post_date_horizontal', 'missing-thumb');

switch ( $display_condition ) {
	case 'missing-thumb':
		$display = ( ! has_post_thumbnail() );
		break;

	case 'always':
		$display = true;
		$class[] = 'display-always';
		break;

	case 'never':
		$display = false;
		break;

	default:
		$display = false;

}



?>
<?php if( $display ): ?>
	<div<?php Village::render_class( $class )?>>
		<div class="month"><?php the_time("M");?></div>
		<div class="date"><?php the_time("d");?></div>
		<div class="year"><?php the_time("Y");?></div>
	</div>

<?php endif; ?>