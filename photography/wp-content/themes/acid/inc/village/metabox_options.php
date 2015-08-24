<?php
/* -----------------------------------*/
/* 		Add Meta Boxes
/* -----------------------------------*/
function village_page_options()
{

	global $meta_boxes;
	
	if ( !class_exists( 'RW_Meta_Box' ) )
	return;
	

	$prefix = 'acid_';
	
	$page_meta = array(
		'id' => 'pure-one-page-options',
		'title'    => 'One Page Layout options',
		'pages'	   => array('page'),
		'priority' => 'high',
		'fields' => array(

  	        array(
                'name' => 'Page Width',
                'std' => '',
                'id'   => $prefix . 'page_width',
                'type' => 'text',
                'desc' => 'For Example: 500 (for a 500 pixel width)'
                ),
			
			array(
				'name' => 'Page Background Color',
				'std' => '',
				'id'   => $prefix . 'page_color',
				'type' => 'color',
			),
	        
			array(
				'name' => 'Page Font Color',
				'std' => '',
				'id'   => $prefix . 'page_font_color',
				'type' => 'color',
			),
	        

	        array(
                'name' => 'Display Page Title',
                'std' => '',
                'id'   => $prefix . 'page_title_enabled',
                'type' => 'select',
                'options' => array(
                    '1' => 'Yes',
                    'false' => "No",
                ),
            ),

			array(
				'name' => 'Page Title Background Color',
				'std' => '',
				'id'   => $prefix . 'page_title_color',
				'type' => 'color',
			),

			array(
				'name' => 'Page Title Font Color',
				'std' => '',
				'id'   => $prefix . 'page_title_font_color',
				'type' => 'color',
			),
		)
	);
			



	$post_meta = array(
	    'id' => 'pure-post-color-options',
	    'title'    => 'Post Color Options',
	    'pages' => array( 'portfolio', 'post' ),
	    'context'  => 'side',
	    'priority' => 'high',

	    'fields' => array(
	        array(
	            'name' => 'Post Color',
	            'id'   => 'pure_post_color',
	            'type' => 'color',
	        ),
	    )
	);


	new RW_Meta_Box( $post_meta );
	new RW_Meta_Box( $page_meta );
}


add_action( 'admin_menu', 'village_page_options' );