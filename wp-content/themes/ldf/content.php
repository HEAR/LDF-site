<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<!-- content.php -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php

		if(  in_array( get_post_type( get_the_ID() ), array('post', 'agenda') )  ){ ?> 
		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
		</div><!-- .entry-meta -->
		<?php } ?>
		<!--<span class="gblack"> </span>-->
		<?php if ( has_post_thumbnail() && ! post_password_required() && !is_single() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>


		<?php
		$key_1_value = get_post_meta( get_the_ID(), 'date', true );
		// check if the custom field has a value
		if( ! empty( $key_1_value ) ) {
		  echo $key_1_value;
		} 
		?>

		<?php if ( is_single() ) : ?>
 		<?php //do_action('icl_navigation_breadcrumb','p'); ?>

			<?php /*
			<?php $terms = get_the_terms( $post->ID , 'thematique' ); foreach( $terms as $term ) {  print $term->slug;  unset($term); } ?>
			/ <?php $terms = get_the_terms( $post->ID , 'annee' ); foreach( $terms as $term ) {  print $term->slug;  unset($term); } ?>
			/ <?php $terms = get_the_terms( $post->ID , 'event-type' ); foreach( $terms as $term ) {  print $term->slug;  unset($term); } ?>
 			*/?>

		<h1 class="entry-title"><?php the_title(); ?><?php edit_post_link('&nbsp;<i class="fa fa-pencil"></i>');?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a><?php edit_post_link('&nbsp;<i class="fa fa-pencil"></i>');?>
		</h1>

		<?php endif; // is_single() ?>

		
	</header><!-- .entry-header -->

	<?php if ( is_search() || (get_post_type( get_the_ID())=='restitutions' && !is_single() ) ) : // Only display Excerpts for Search ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<?php else : ?>
	
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php // wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Commenter', 'twentythirteen' ) . '</span>', __( '1 commentaire', 'twentythirteen' ), __( 'commentaires', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->

<!-- end content.php -->
