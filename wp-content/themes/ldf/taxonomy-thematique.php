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

<!-- taxonomy-thematique.php -->

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<ul class='flat'>
			<?php 
				$categories = get_terms( 'annee_restitution', array(
					'orderby'    => 'count',
					'hide_empty' => 1
				) );

			     foreach ( $categories as $term ) {
			       echo "<li class='clr-bc'><a href='".icl_get_home_url()."annee_restitution/". $term->slug ."'>" . $term->name . "</a></li>";
			     }
			?>
			</ul>

		<?php if ( have_posts() ) : 
 			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        ?>
        <h1><?php echo $term->name;?></h1>
        <div class="intro2">
            <?php echo apply_filters( 'the_content', $term->description );?>
        </div>




			<!--<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( '%s /Thématiques', 'twentythirteen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' ); ?></h1>
			</header>--><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav('posts '); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<!-- end taxonomy-thematique.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>