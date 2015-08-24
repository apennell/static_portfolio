<?php

if( ! function_exists('village_remove_redux_demo') ) {
	
	function village_remove_redux_demo() { // Be sure to rename this function to something more unique
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	    }
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	    }

	}
	add_action('init', 'village_remove_redux_demo');
	
}
