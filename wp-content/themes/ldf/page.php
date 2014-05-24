<?php
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

<!-- page.php -->

	<div id="primary" class="content-area ">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php 
							$itisme	  = get_post($post->ID);
							$parentID = $itisme->post_parent;

							if( !is_front_page() && $parentID!=0) :

								if($parentID){
									$lineage  = get_the_title($post_ID)/*$itisme->post_name*/;
								}
								while( $parentID != 0 ){
									$parent   = get_post($parentID);
									$lineage  = '<a href="'.get_permalink($parentID).'">'.get_the_title($parentID)/*.$parent->post_name*/.'</a> / '.$lineage;
									$parentID = $parent->post_parent;
								}
								
								if($parentID){
									//$lineage=$itisme->post_name;
								}
						?>
						<div class="entry-meta">
								<?php echo $lineage; ?>				
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?><?php edit_post_link(' <i class="fa fa-pencil"></i>');?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<!-- end page.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>