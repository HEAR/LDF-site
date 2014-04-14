<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<div class="breadthumb">
	
		</div>

		<?php if ( have_posts() ) : 


 	?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'restitutions', 'twentythirteen' ), '<span></span>' ); ?></h1>
<!--
				<ul class="yearly">
				<li><a>2012</a></li>
				<li><a>2013</a></li>
				<li><a>2014</a></li>

				</ul>
			!-->
			</header><!-- .archive-header -->


			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav('restitutions'); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>