<?php

//-----------------------------------*/
// Variables Used:
//-----------------------------------*/

$args     = array();
$tabs     = array();
$sections = array();


//--------------------------------------------------------------------*/
// 							Migrate Legacy
//--------------------------------------------------------------------*/
$theme_mods = get_theme_mod('acid_options');
if( ! empty($theme_mods) ) {

	if( $theme_mods['one_page_PPP'] == '4' ) {
		$theme_mods['one_page_PPP'] = 10;
	}

	update_option( Village::$key, $theme_mods );
	remove_theme_mod('acid_options');
}




//--------------------------------------------------------------------*/
// 							BEGIN OPTIONS
//--------------------------------------------------------------------*/

//-----------------------------------*/
// Tab: General Settings
//-----------------------------------*/
$sections[] = array(
	'title'  => __( 'General Settings', 'village' ),
	'icon'   => 'el-icon-cogs',
	'fields' => array(
		/*---------------------------*/
		/*    Site Logo
		/*---------------------------*/
		array(
			'id'   => "site_logo",
			'type' => 'media',
		),
		//-----------------------------------*/
		// One Page Posts Per Pages
		//-----------------------------------*/	
		array(
			'id'      => 'one_page_PPP',
			'title'   => 'One Page Template: Posts per Page',
			'default' => 4,
			'type'    => 'text',
		),
		//-----------------------------------*/
		// Enable Footer
		//-----------------------------------*/		
		array(
			'id'      => 'footer',
			'title'   => 'Enable Footer',
			'default' => '1',
			'type'    => 'switch',
		),
		//-----------------------------------*/
		// Enable Theme Credits
		//-----------------------------------*/	
		array(
			'id'          => 'themevillage_credits',
			'title'       => 'Enable Theme Credits',
			'description' => "Show some love by enabling a link in the footer to ThemeVillage.net",
			'default'     => 1,
			'type'        => 'switch',
		),
		//-----------------------------------*/
		// Auto Initial Scroll
		//-----------------------------------*/
		array(
			'id'      => 'auto_initial_scroll',
			'title'   => 'Auto Initial Scroll',
			'default' => '1',
			'type'    => 'switch',
		),
		//-----------------------------------*/
		// Blinking Arrow
		//-----------------------------------*/
		array(
			'id'      => 'blinking_arrow',
			'title'   => 'Blinking Arrow (Hint to scroll)',
			'default' => '1',
			'type'    => 'switch',
		),
		//-----------------------------------*/
		// Portfolio Style
		//-----------------------------------*/
		array(
			'id'      => 'colorbox',
			'title'   => 'Portfolio Style',
			'default' => 'case_study',
			'type'    => 'select',
			'options' => array(
				'case_study' => 'Case Study',
				'pop_up'     => 'Pop-up'
			),
		),

	),
);
//-----------------------------------*/
// Tab: Blog Options
//-----------------------------------*/
$sections[] = array(
	'title'  => 'Blog Options',
	'icon'   => 'el-icon-pencil',
	'fields' => array(
		//-----------------------------------*/
		// Enable Sidebar
		//-----------------------------------*/		
		array(
			'id'      => 'blog_sidebar',
			'title'   => 'Enable Blog Siderbar',
			'default' => 1,
			'type'    => 'switch',
		),
		//-----------------------------------*/
		// Show Categories in Post meta
		//-----------------------------------*/		
		array(
			'id'      => 'content_header_categories',
			'title'   => 'Show Post Categories',
			'default' => 1,
			'type'    => 'switch',
		),
		//-----------------------------------*/
		// Show Tags in Post meta
		//-----------------------------------*/	
		array(
			'id'      => 'content_header_tags',
			'title'   => 'Show Post Tags',
			'default' => 0,
			'type'    => 'switch',
		),
		//-----------------------------------*/
		// Show Date and Author in Post meta
		//-----------------------------------*/	
		array(
			'id'      => 'content_header_post_author',
			'title'   => 'Show Post Author',
			'default' => 1,
			'type'    => 'switch',
		),

		//-----------------------------------*/
		// Show Date and Author in Post meta
		//-----------------------------------*/
		array(
			'id'      => 'show_post_date_horizontal',
			'title'   => 'Show Post Dates ',
			'subtitle' => "When to show post date in Horizontal Layout ?",
			'default' => 'missing-thumb',
			'options' => array(
				'always' => 'Always',
				'missing-thumb' => 'Only posts without thumbnails',
				'never' => 'Never'
			),
			'type'    => 'select',
		),

		array(
			'id'      => 'show_post_date',
			'title'   => 'Show Post Date: Single',
			'subtitle' => 'Show post date in single posts',
			'default' => 1,
			'type'    => 'switch',
		),

	),
);
//-----------------------------------*/
// Tab:Colors
//-----------------------------------*/
$sections[] = array(
	'title'  => 'Colors',
	'icon'   => 'el-icon-brush',
	'fields' => array(
		array(
			'id'          => 'accent_color',
			'title'       => 'Primary Color',
			'type'        => 'color',
			'default'     => get_theme_mod('accent_color', '#151515'),
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.kilo a, h1 a, .alpha a, h2 a, .beta a, #reply-title a, h3 a, .gamma a, .comments-title a, h4 a, .delta a, .site-sidebar .widget-title a, .error404 .site-sidebar .widgettitle a, .widget_rss li a.rsswidget a, h5 a, .epsilon a, h6 a, .zeta a, .kilo a:visited, h1 a:visited, .alpha a:visited, h2 a:visited, .beta a:visited, #reply-title a:visited, h3 a:visited, .gamma a:visited, .comments-title a:visited, h4 a:visited, .delta a:visited, .site-sidebar .widget-title a:visited, .error404 .site-sidebar .widgettitle a:visited, .widget_rss li a.rsswidget a:visited, h5 a:visited, .epsilon a:visited, h6 a:visited, .zeta a:visited, .accent-color'
				=> array(
					'color' => '%%value%%',
				),
				'.site-header, .sf-menu .sub-menu, #ajax-popup, .entry-header .comments-link, #portable-header .comments-link, .entry-date, .page-links .pagination-item, .page-links .page-numbers a, .page-links .current, .page-links .dots, .site-sidebar .widget-title, .error404 .site-sidebar .widgettitle, .site-footer, .widget_calendar thead th, .site-footer .widget_calendar td:hover, .site-footer .widget_calendar tbody td.pad, .horizontal-scroll .vertical-title-container, .horizontal-scroll #scrollbar .track'
				=> array(
					'background-color' => '%%value%%',
				),
				'.entry-header .comments-link:before, #portable-header .comments-link:before, .site-sidebar .widget-title:before, .error404 .site-sidebar .widgettitle:before, .widget_calendar thead th, .site-footer .widget_calendar thead, .pure-spacer.accent'
				=> array(
					'border-color' => '%%value%%',
				),
				'.horizontal-scroll .vertical-title-container .arrow-bottom'
				=> array(
					'border-top-color' => '%%value%%',
				),
				'.horizontal-scroll .vertical-title-container .arrow-right'
				=> array(
					'border-left-color' => '%%value%%',
				),
				'::selection' => array(
					'background-color' => '%%value%%',
				),
				'::-moz-selection' => array(
					'background-color' => '%%value%%',
				),
			),
		),
		array(
			'id'          => 'lighter_accent_color',
			'title'       => 'Primary Color: Lighter',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.site-footer .widget_calendar thead th'
				=> array(
					'background-color' => '%%value%%',
				),
				'.sf-menu .sub-menu .menu-item'
				=> array(
					'border-color' => '%%value%%',
				)
			),
		),
		array(
			'id'          => 'font_on_accent',
			'title'       => 'Font on Primary Color Background',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.site-header, .sf-menu .sub-menu, #ajax-popup, .entry-header .comments-link, #portable-header .comments-link, .entry-date, .page-links .pagination-item, .page-links .page-numbers a, .page-links .current, .page-links .dots, .site-sidebar .widget-title, .error404 .site-sidebar .widgettitle, .site-footer, .widget_calendar thead th'
				=> array(
					'color' => '%%value%%',
				),
			),
		),
		array(
			'id'          => 'theme_color',
			'title'       => 'Brand Color',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'
						.page-links .pagination-item:hover, .page-links .page-numbers a:hover, .page-links .current:hover, .page-links .dots:hover,
						.is-author, .button, .pure-button, #submit, .submit, input[type=submit], .theme-bg, .accent-bg, .widget_calendar caption, .widget_calendar #today, .tagcloud a, .tagcloud a[class*="tag"], .page-tags a, .page-tags a[class*="tag"], ul.icon-list li:hover div, .horizontal-scroll #scrollbar .thumb
						'
				=> array(
					'background-color' => '%%value%%',
				),
				'blockquote:before, .theme-color, .site-title, .entry-content li:before, .entry-title a:hover, .entry-meta a:hover, .horizontal-scroll .vertical-title-container'
				=> array(
					'color' => '%%value%%',
				),
				'input[type=text]:focus, input[type=email]:focus, input:not([type=submit]):not([type=file]):focus, .searchfield:focus, textarea:focus, .sf-menu > .menu-item > .sub-menu:before, .sf-menu .sub-menu, #ajax-popup, #popup-arrow, .bypostauthor > .comment .avatar, .is-author img, #footer-arrow, #footer-content, .pure-spacer.theme, a.wpp-thumbnail:hover, .site-footer a.wpp-thumbnail'
				=> array(
					'border-color' => '%%value%%',
				),
			),
		),
		array(
			'id'          => 'font_on_theme',
			'title'       => 'Font on Brand Color Background',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.tagcloud a, .tagcloud a[class*="tag"], .page-tags a, .page-tags a[class*="tag"]'
				=> array(
					'color' => '%%value%%',
				),
			),
		),
		array(
			'id'          => 'lighter_theme_color',
			'title'       => 'Brand Color: Lighter',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.button:hover, .pure-button:hover, #submit:hover, .submit:hover, input[type=submit]:hover, .tagcloud a:hover, .tagcloud a[class*="tag"]:hover, .page-tags a:hover, .page-tags a[class*="tag"]:hover'
				=> array(
					'color' => '%%value%%',
				),
			),
		),
		array(
			'id'          => 'darker_theme_color',
			'title'       => 'Brand Color: Darker',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'ul.icon-list li:hover .batch'
				=> array(
					'color' => '%%value%%',
				),
				'.button, .pure-button, #submit, .submit, input[type=submit], .widget_calendar #today'
				=> array(
					'border-color' => '%%value%%',
				)
			),
		),
		array(
			'id'          => 'font_color',
			'title'       => 'Font Color',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'#cboxTitle, body, .container, #respond, .entry-title a, .field, .wpcf7-text'
				=> array(
					'color' => '%%value%%',
				)
			),
		),
		array(
			'id'          => 'lightest_font',
			'title'       => 'Light Font',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.widget-title, .error404 .site-sidebar .widgettitle, .widget_calendar caption'
				=> array(
					'color' => '%%value%%',
				)
			),
		),


		array(
			'id'          => 'link_color',
			'title'       => 'Link Color',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.site-header a, .sf-menu .sub-menu a, #ajax-popup a, .entry-header .comments-link a, #portable-header .comments-link a, .entry-date a, .page-links .pagination-item a, .page-links .page-numbers a a, .page-links .current a, .page-links .dots a, .site-sidebar .widget-title a, .error404 .site-sidebar .widgettitle a, .site-footer a, .widget_calendar #today, .widget_calendar #today a'
				=> array(
					'color' => '%%value%%',
				)
			),
		),
		array(
			'id'          => 'link_hover',
			'title'       => 'Link Hover',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.site-header a:hover, .sf-menu .sub-menu a:hover, #ajax-popup a:hover, .entry-header .comments-link a:hover, #portable-header .comments-link a:hover, .entry-date a:hover, .page-links .pagination-item a:hover, .page-links .page-numbers a a:hover, .page-links .current a:hover, .page-links .dots a:hover, .site-sidebar .widget-title a:hover, .error404 .site-sidebar .widgettitle a:hover, .site-footer a:hover'
				=> array(
					'color' => '%%value%%',
				)
			),
		),
		array(
			'id'          => 'link_light',
			'title'       => 'Light Links',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.site-header a, .sf-menu .sub-menu a, #ajax-popup a, .entry-header .comments-link a, #portable-header .comments-link a, .entry-date a, .page-links .pagination-item a, .page-links .page-numbers a a, .page-links .current a, .page-links .dots a, .site-sidebar .widget-title a, .error404 .site-sidebar .widgettitle a, .site-footer a, .widget_calendar #today, .widget_calendar #today a'
				=> array(
					'color' => '%%value%%',
				)
			),
		),
		array(
			'id'          => 'link_light_hover',
			'title'       => 'Light Links on Hover',
			'type'        => 'color',
			'default'     => '#151515',
			'validate'    => 'color',
			'transparent' => false,
			'css'         => array(
				'.site-header a:hover, .sf-menu .sub-menu a:hover, #ajax-popup a:hover, .entry-header .comments-link a:hover, #portable-header .comments-link a:hover, .entry-date a:hover, .page-links .pagination-item a:hover, .page-links .page-numbers a a:hover, .page-links .current a:hover, .page-links .dots a:hover, .site-sidebar .widget-title a:hover, .error404 .site-sidebar .widgettitle a:hover, .site-footer a:hover'
				=> array(
					'color' => '%%value%%',
				)
			),
		),

	),
);

//-----------------------------------*/
// Tab:Advanced Options
//-----------------------------------*/
$sections[] = array(
	'title'  => 'Advanced Options',
	'icon'   => 'el-icon-wrench',
	'fields' => array(

		array(
			"id"       => "custom_css",
			"title"    => 'Custom CSS',
			'mode'     => 'css',
			'theme'    => 'monokai',
			'subtitle' => 'Quickly add some CSS the theme. Use with caution, only if you know what you are doing.',
			'type'     => 'ace_editor',
			'validate' => 'css',
		),

	),

);


//--------------------------------------------------------------------*/
// 							END OPTIONS
//--------------------------------------------------------------------*/


//--------------------------------------------------------------------*/
// 								INIT
//--------------------------------------------------------------------*/


//-----------------------------------*/
// Setting Up Redux Framework:
//-----------------------------------*/
$theme_data              = wp_get_theme();
$args['display_name']    = $theme_data->get( 'Name' );
$args['display_version'] = $theme_data->get( 'Version' );
$args['menu_title']      = __( "Theme Options", 'village' );

// Disable Redux CSS Output
$args['output']   = false;
$args['dev_mode'] = false;

$args['share_icons'][] = array(
	'url'   => 'http://twitter.com/Theme_Village',
	'title' => 'Follow us on Twitter',
	'icon'  => 'el-icon-twitter'
);
$args['share_icons'][] = array(
	'url'   => 'http://www.facebook.com/themevillage.net',
	'title' => 'Like us on Facebook',
	'icon'  => 'el-icon-facebook'
);

$args['opt_name']  = Village::$key;
$args['page_slug'] = 'village';
$parsed_sections = TV_Parser::parse_sections( $sections );
do_action( 'before_redux_setup', $parsed_sections );

$Theme_Village_Options = new ReduxFramework( $parsed_sections, $args, $tabs );


function remove_redux_menu() {
	remove_submenu_page( 'tools.php', 'redux-about' );
	remove_submenu_page( 'tools.php', 'redux-extensions' );
	remove_submenu_page( 'tools.php', 'redux-changelog' );
	remove_submenu_page( 'tools.php', 'redux-credits' );
	remove_submenu_page( 'tools.php', 'redux-support' );
	remove_submenu_page( 'tools.php', 'redux-status' );
}


// Remove Redux Menu from Admin
function remove_redux_menu_form_admin() {
	add_action( 'admin_menu', 'remove_redux_menu' );
}
add_action('init', 'remove_redux_menu_form_admin');


//-----------------------------------*/
// Disable Redux Tracking:
//
//  Sorry Dovy, I don't agree with the tracking philosophy.
//  I understand that tracking is important, but purposely preventing authors from removing tracking
//  by not providing the option to do so has pushed me over to the dark side.
//  I love Redux, and I'm all for supporting the development, but I strongly disagree with some of the decisions here.
//-----------------------------------*/
$tracking = get_option( 'redux-framework-tracking' );
if ( $tracking && ( ! is_array( $tracking ) || empty( $tracking['allow-tracking'] ) ) ) {
	$tracking                   = array();
	$tracking['dev_mode']       = false;
	$tracking['allow_tracking'] = 'no';
	$tracking['tour']           = 0;
	update_option( 'redux-framework-tracking', $tracking );
}
