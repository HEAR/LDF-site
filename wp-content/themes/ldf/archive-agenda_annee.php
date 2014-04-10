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

agenda _ annee
 <?php // echo get_the_term_list( $post->ID, 'annee', 'People: ', ', ', '' ); ?> 

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

<?php $categories = get_terms( 'annee_agenda', array(
 	'orderby'    => 'count',
 	'hide_empty' => 0
 ) );



     echo "<ul>";
     foreach ( $categories as $term ) {
       echo "<li><a href='".esc_url( home_url( '' ) )."/annee_agenda/". $term->slug ."'>" . $term->name . "</a></li>";
        
     }
     echo "</ul>";

?>


		<?php if ( have_posts() ) : 


 		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        ?>
        <h1><?php echo $term->name;?></h1>
        <div class="intro2">
            <p>
            <?php echo $term->description;?>
            </p>
        </div>




			<header class="archive-header">
				



			</header><!-- .archive-header -->


			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content-agenda', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>