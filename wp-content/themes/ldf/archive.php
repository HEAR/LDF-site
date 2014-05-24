<?php
/**
 * The template for displaying  archives
 *
 */
get_header(); ?>

<!-- archive.php -->

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php /* The loop */
			if(get_post_type() == 'agenda'){

				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	            global $wp_query;
	            $args = array_merge(
	            	$wp_query->query_vars,
	            	array(
	            		'post_status' => array('future','publish'),
	            		'paged' => $paged, 
	            	)
	            );
	            query_posts($args);
	        }
        ?>
		<?php if ( have_posts() ) : 
		
 		//$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        ?>
        <!--<h1><?php echo $term->name;?></h1>-->
        <!--<div class="intro2">
            <p>
            <?php echo $term->description;?>
            </p>
        </div>-->
			<!--<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Agenda', 'twentythirteen' ), '<span></span>' ); ?></h1>
			</header>--><!-- .archive-header -->

			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_type() ); ?>
			
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav('posts'); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<!-- end archive.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>