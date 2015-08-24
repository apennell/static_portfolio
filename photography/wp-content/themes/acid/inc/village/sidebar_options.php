<?php
/* -----------------------------------*/
/* 		Add Extended Meta Boxes
/* -----------------------------------*/
function pure_extended_options()
{

	 global $meta_boxes;
	if ( !class_exists( 'RW_Meta_Box' ) )
	return;
	

    $prefix = 'acid_';
    
    $meta_box = array(
        'id' => 'pure-extended-options',
        'title'    => 'Sidebar',
        'priority' => 'high',
        'pages'    => array('page', 'post'),
        'fields' => array(
            
            array(
                'name' => 'Enable/Disable Sidebar',
                'std' => '',
                'id'   => $prefix . 'blog_sidebar',
                'type' => 'select',
                'options' => array(
                    'ignore' => ' - - - ' ,
                    'enable' => 'Enable Sidebar',
                    'disable' => 'Disable Sidebar',
                ),
            ),
        ),
    );
    new RW_Meta_Box( $meta_box );
}
add_action( 'admin_menu', 'pure_extended_options' );