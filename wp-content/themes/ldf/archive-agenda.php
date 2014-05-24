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

<!-- archive-agenda.php -->

 <?php // echo get_the_term_list( $post->ID, 'annee', 'People: ', ', ', '' ); ?> 

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : 


 		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        ?>
        <!--<h1><?php echo $term->name;?></h1>-->
        <!--<div class="intro2">
            <p>
            <?php echo $term->description;?>
            </p>
        </div>-->




	<header class="archive-header">
		<?php $categories = get_terms( 'annee_agenda', array(
									 	'orderby'    => 'count',
									 	'hide_empty' => true
										 ) );
     echo "<ul class='flat'>";
     foreach ( $categories as $term ) {
        //echo icl_object_id($term->term_id,'annee_agenda',true, ICL_LANGUAGE_CODE).' ';
        //if($term->term_id == icl_object_id($term->term_id,'annee_agenda',false)){
            echo "<li class='clr-bc'><a href='".icl_get_home_url()."annee_agenda/". $term->slug ."'>" . $term->name . "</a></li>";
            //echo '<li><a href="'.$category_url.'?annee_agenda='. $term->slug.'">' . $term->name . '</a></li>';
        //}
     }
     echo "</ul>";


    	 $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        ?>
        <!--<h1><?php echo $term->name;?></h1>-->
        <!--<div class="intro2">
            <p>
            <?php echo $term->description;?>
            </p>
        </div>-->
	</header><!-- .archive-header -->


			<?php /* The loop */
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

                global $wp_query;
                $args = array_merge(
                    $wp_query->query_vars,
                    array(
                        'post_status' => array('future','publish'),
                        'paged' => $paged, 
                    )
                );
                query_posts($args)
            ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_type() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav('agenda'); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<!-- end archive-agenda.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>