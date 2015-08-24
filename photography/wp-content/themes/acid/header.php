<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package acid
 * @since acid 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>

<!-- The quickest way for us to know that JavaScript is turned on -->
<script type="text/javascript">document.documentElement.className = 'js';</script>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/ie/explorer.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css">
<![endif]-->

<meta name="format-detection" content="telephone=no">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="village-loading" class="site-loading__background">
    <div class="site-loading"></div>
</div>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
        <header class="site-header cf" role="banner">
            <div class="site-header-inner">
                <!-- BEGIN Logo -->
                <?php

                    $site_logo = Village::get_theme_mod( "site_logo", false );

                    if( is_array( $site_logo) ) {
                        $site_logo = $site_logo['url'];
                    }

                ?>
                <a id="logo" class="alpha site-title <?php if ( $site_logo ) echo " image"; ?>" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <?php if ( $site_logo ): ?>
                    <img class="site-logo" src=<?php echo esc_url_raw( $site_logo ); ?> alt="<?php bloginfo( 'name' ); ?>" />
                 <?php else: ?>   
                    <?php bloginfo( 'name' ); ?>
                <?php endif; ?>
                </a>
                <!-- END Logo -->

                <!-- BEGIN .site-navigation -->
                <nav id="navigation" role="navigation" class="site-navigation">
                    <?php wp_nav_menu( array( 
                                    'theme_location' => 'primary', 
                                    'menu_class' => 'sf-menu',
                                    'menu_id' => 'menu-main-menu',
                                    'container_class' => 'sf-container',
                                    ) ); ?>
                </nav>
                <!-- END .site-navigation -->
            </div> 
            <!-- END .site-header-innet -->
        </header>
        <!-- END Header -->
    
    

	<div id="container" class="container">
    <div id="main" class="site-main">
