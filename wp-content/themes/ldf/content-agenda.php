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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		



		<header class="entry-header">
<?php 
$has_thumb = has_post_thumbnail();
if (has_post_thumbnail() && ! post_password_required()) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif;  ?>


		<?php echo '<div class="entry-right-part has_thumb-'.$has_thumb. '">'; ?>
	
		



			<?php
			$key_1_value = get_post_meta( get_the_ID(), 'date', true );
			// check if the custom field has a value
			if( ! empty( $key_1_value ) ) {
			  echo '<span class="entry_custom_date">'.$key_1_value.' </span>';
			} 
		
			// taxo fallback
			else{
						 	
			 	$terms = get_the_terms( $post->ID , 'annee_agenda' );
			 	if($terms){
			 		foreach( $terms as $term ) { 
						echo '<span class="entry_custom_date">'.$term->slug.' </span>';
			 	 		unset($term); 
			 		 }
			 	 }
						 	
			}
			?>
			<span class="entry_terms clr">
				<?php $terms = get_the_terms( $post->ID , 'event-type' ); 
				if($terms){
					foreach( $terms as $term ) {  
						echo ' <span class="black_c">/</span> '. $term->slug;  unset($term); 
					}
				}
				?>
			</span>
						<span class="gblack">&nbsp;</span>

		<h1 class="entry-title upper">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>


	<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php endif; ?>



</div>
			
</header>



	
		
		

	

	<?php if ( is_single() ) : // Only display Excerpts for Search ?>
		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php //wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->


	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php //get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
	<?php endif; ?>
	
		


</article><!-- #post -->
