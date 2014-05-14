<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- ><div id="tz"></div> !-->
	<div id="page" class="hfeed site">
	<div class="right-box clr fs13 clr-bc cgb">
		<div class="container">
			<?php get_search_form(); ?>
			<a class="up fr lang" href="<?php echo esc_url( home_url( '/?lang=fr' ) ); ?>">fr</a>
			<!-- <a class="up en lang" href="<?php echo esc_url( home_url( '/?lang=en' ) ); ?>">en</a> !-->
			<a class="up de lang" href="<?php echo esc_url( home_url( '/?lang=de' ) ); ?>">de</a> <span class="lang_select"></span><a href="https://twitter.com/LDF_1914_2018" class="fa fa-twitter twitter"></a> <a href="https://www.facebook.com/lignesdefront.1914.2018" class="fa fa-facebook facebook"></a>
			<?php //do_action('icl_language_selector'); ?>
		</div>
	</div>
	<div class="left-box cgb up">
		<div class="head-box ">
		
			<h1 class="site-title">
				<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>
				</a>
			</h1>
		
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<h2 class="site-sub-description"><?php _e( 'Programme de recherche', 'twentythirteen' );  ?></h2>
		</div>
		<div class="nav-box">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			
			<h3><a class="fs13 thema-toggle" ><?php _e( 'Acces thematique', 'twentythirteen' ); ?></a></h3>
			
			<?php wp_nav_menu( array( 'theme_location' => 'themas', 'menu_class' => 'nav-toggle nav-menu' ) ); ?>
		</div>
	</div>
	<div id="main " class="main red-border scrollBar loaded site-main">
