<?php
// Prepare for Pagination
if ( $village_page === 1 && Horizontal_Entry::is_first() ) {
	$column_size = 1;
} else {
	$column_size = 2;
}

// Render a Horizontal Entry
$entry = new Horizontal_Entry( $column_size );
$entry->render();


?>