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
			<span class='langselector'>
				<?php
					languages_list();
					function languages_list(){
					    $languages = icl_get_languages('skip_missing=1'); // &orderby=code
					    if(!empty($languages)){
					    	//$i = 0;
					        foreach($languages as $l){
					        	//echo $i>0 ? ' / ' : '';
					            echo ' <span class="lang up">';
					            if(!$l['active']) echo '<a href="'.$l['url'].'">';
					            echo substr($l['native_name'], 0,2 );
					            if(!$l['active']) echo '</a>';
					            echo '</span>';
					            //$i++;
					        }
					    }
					}
				?>
				<span class="selector">></span>
			</span>

			<a href="https://twitter.com/LDF_1914_2018" class="fa fa-twitter twitter"></a>
			<a href="https://www.facebook.com/lignesdefront.1914.2018" class="fa fa-facebook facebook"></a>
		</div>
	</div>
	<div class="left-box cgb up">
		<div class="head-box ">
		
			<h1 class="site-title">
				<a class="home-link" href="<?php echo icl_get_home_url(); //bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-HD.png" width="112" height="112" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" id="logo" />
				</a>
			</h1>
			<div class="slogan">
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<h2 class="site-sub-description"><?php _e( 'Programme de recherche', 'twentythirteen' );  ?></h2>
			</div>
		</div>
		<div class="nav-box">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			
			<h3><a class="fs13 thema-toggle" ><?php _e( 'Acces thematique', 'twentythirteen' ); ?><span class="toggle">&or;</span></a></h3>
			
			<?php wp_nav_menu( array( 'theme_location' => 'themas', 'menu_class' => 'nav-toggle nav-menu' ) ); ?>
		</div>
	</div>
	<div id="main " class="main red-border scrollBar loaded site-main">
