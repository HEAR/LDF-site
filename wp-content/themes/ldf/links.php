<?php
/*
Template Name: Links
*/
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				$bookmarks = get_bookmarks( array(
								'orderby'        => 'name',
								'order'          => 'ASC',
								//	'category_name'  => 'Related Sites'
				));
				foreach ( $bookmarks as $bookmark ) { 
					// debug : print_r($bookmark);
			 	?>
				<article>
					<header class="link-header">
						<h3 class="link-title"><a href="<?php echo $bookmark->link_url; ?>"><?php echo $bookmark->link_url; ?></a></h3>
						<span class="gblack">&nbsp;</span>
						<h4 class="link-subtitle upper"><?php echo $bookmark->link_name; ?></h4>
					</header><!-- .entry-header -->
					<div class="link-content">
					<?php echo $bookmark->link_description; ?>
					</div><!-- .entry-content -->
				</article><!-- #post -->
			<?php } ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>