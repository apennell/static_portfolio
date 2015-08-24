<?php

global $wp_customize;

$template_dir = get_template_directory();
$village_dir = $template_dir . '/inc/village';

/* -----------------------------------*/
/* 		Load Village Class
/* -----------------------------------*/
require_once $template_dir . '/inc/template-tags.php';
require_once $template_dir . '/inc/wordpress-helpers.php';


require_once  $village_dir . '/Village.class.php';
require_once  $village_dir . '/Village_Class_Ext.php';
require_once  $village_dir . '/Village_One_Page.class.php';


// Initialize Village Class
Village::init();           
Village_One_Page::init();  

/*-----------------------------------*/
/* Village Includes
/*-----------------------------------*/
require_once $village_dir . '/Village_CSS_Options.php';
require_once $village_dir . '/Village_JavaScript_Options.php';

require_once $village_dir . '/metabox_options.php';
require_once $village_dir . '/sidebar_options.php';

require_once $template_dir . '/inc/template-hooks.php';
require_once $template_dir . '/inc/template-functions.php';

require_once $template_dir . '/inc/Horizontal_Entry.php';


/* -----------------------------------*/
/* 		Actions:
/* -----------------------------------*/
add_action( 'after_setup_theme', array( 'Village_Class_Ext', 'setup' ) );



/* -----------------------------------*/
/* 		Dashboard 
/* -----------------------------------*/
# This Conditional Tag checks if the Dashboard or the administration panel is attempting to be displayed.
		
# Load / Require Plugins if current user can activate them
if ( current_user_can( 'activate_plugins' ) ) {
	require_once $template_dir . '/inc/village/plugins/initialize_plugins.php';	
}

/*-----------------------------------*/
/* Redux Framework Configuration
/*-----------------------------------*/
if ( class_exists( 'ReduxFramework' ) ){
	// Get Theme Options
	require_once $template_dir . '/inc/options/TV_Parser.php';
	require_once $template_dir . '/inc/options/customize_redux.php';
	require_once $template_dir . '/inc/options/options.php';
}

	