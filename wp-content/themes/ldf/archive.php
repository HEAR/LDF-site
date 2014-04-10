<?php
/**
 * The template for displaying  archives
 *
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
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
				<h1 class="archive-title"><?php printf( __( 'Agenda', 'twentythirteen' ), '<span></span>' ); ?></h1>
			</header><!-- .archive-header -->
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content-agenda', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav('posts'); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>