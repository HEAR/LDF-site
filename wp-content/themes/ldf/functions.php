<?php
function ldf_setup() {
	register_nav_menus( array(
		'themas' => 'My Custom thematique Menu'
	) );
 	add_option('sub-description', 'Programme de recherche', '', 'yes' );
	remove_theme_support( 'post-formats' );

}
add_action( 'after_setup_theme', 'ldf_setup' );



function restitutions_post_type() {
	register_post_type( 'restitutions',
		array(
			'labels' => array(
				'name' => __( 'Restitutions', 'restitution' ),
				'singular_name' => __( 'Restitution' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title','editor','excerpt','thumbnail','author','trackbacks','custom-fields','comments','revisions'),
		
		)
	);
}
function agenda_post_type() {
	register_post_type( 'agenda',
		array(
			'labels' => array(
				'name' => __( 'Agenda' ),
				'singular_name' => __( 'Agenda' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title','editor','excerpt','thumbnail','author','trackbacks','custom-fields','comments','revisions')
		)
	);
}
function annee_agenda_taxo_init() {
	// create a new taxonomy
	register_taxonomy(
		'event-type',
		'agenda',
		array(
			'label' => __( 'Type evenement' ),
			'rewrite' => array( 'slug' => 'event-type' ),
			'hierarchical' => true
		)
	);
	register_taxonomy(
		'annee_agenda',
		'agenda',
		array(
			'label' => __( 'Année Agenda' ),
			'rewrite' => array( 'slug' => 'annee_agenda' ),
			'hierarchical' => true
		)
	);
}

function annee_restitution_taxo_init() {
	// create a new taxonomy
	register_taxonomy(
		'annee_restitution',
		'restitutions',
		array(
			'label' => __( 'Année Restitution' ),
			'rewrite' => array( 'slug' => 'annee_restitution' ),
			'hierarchical' => true
		)
	);
}
function thematique_taxo_init() {
	// create a new taxonomy
	register_taxonomy(
		'thematique',
		'restitutions',
		array(
			  'name' => __( 'thematique', 'taxonomy general name' ),
       		  'singular_name' => __( 'thematique ', 'taxonomy singular name' ),
			'label' => __( 'Thématiques' ),
			'rewrite' => array( 'slug' => 'thematique' ),
			'hierarchical' => true
		)
	);
}

add_action( 'init', 'restitutions_post_type' );
add_action( 'init', 'agenda_post_type' );

add_action( 'init', 'annee_restitution_taxo_init' );
add_action( 'init', 'annee_agenda_taxo_init' );
add_action( 'init', 'thematique_taxo_init' );

function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( '' ) . '</label>
    <span class="fa fa-search"><input type="submit"  id="searchsubmit" value="'. esc_attr__( '' ) .'" /></span>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'my_search_form' );

function ldf_scripts_styles() {
	$rand = rand(5, 150000);
	wp_enqueue_script( 'jrespond', get_stylesheet_directory_uri() . '/js/jRespond.min.js', array( 'jquery' ), $rand, true );

	wp_enqueue_script( 'mCustomScrollbar', get_stylesheet_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), '2013-07-18', true );
	wp_enqueue_script( 'scrollpane_mousejs', get_stylesheet_directory_uri() . '/js/jquery.mousewheel.js', array( 'jquery' ), '2013-07-18', true );
	wp_enqueue_style( 'mCustomScrollbar', get_stylesheet_directory_uri() . '/css/jquery.mCustomScrollbar.css' , array(), null );
	wp_enqueue_style( 'typos_css', get_stylesheet_directory_uri() . '/css/LignesDeFront.css?='.$rand , array(), null );
	wp_enqueue_script( 'commons-script', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery', 'jrespond','mCustomScrollbar' ), $rand, true );

	//	wp_enqueue_style( 'tilezoom_css', get_stylesheet_directory_uri() . '/js/tilezoom/jquery.tilezoom.css' , array(), null );
	//	wp_enqueue_script( 'tilezoom_js', get_stylesheet_directory_uri() . '/js/tilezoom/jquery.tilezoom.js', array( 'jquery' ), '2013-07-18', true );
	wp_enqueue_style( 'fonts-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' , array(), null );
}
add_action( 'wp_enqueue_scripts', 'ldf_scripts_styles' );
function mytheme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>

		<div class="comment-meta commentmetadata">/<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
			?>
		</div>

		<?php comment_text() ?>

		<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
        }





//function ldf_scripts_styles() {}
//add_action( 'wp_enqueue_scripts', 'ldf_scripts_styles' );



if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( '&nbsp;/&nbsp;', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '/ <span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		//echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	// OU PAS
	/*
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
	*/
	
}
endif;
if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav($t) {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">

		<h1 class="screen-reader-text"><?php
		// _e( 'Navigation des');
		//echo ' '.$t;
		  ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span>Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


add_action('wp_head', 'custom_styles');
function custom_styles() {
	$out = ''; 
	$out .='<style>';
	$out .='.clr,a,.searchform span,.searchform input#s,.wpcf7-form p,.wpcf7-submit,#commentform #submit, .site-description, .site-sub-description{color:#ef312f;} .searchform input#s{border-bottom:2px solid #ef312f;} textarea{border-color:#ef312f;}.clr-bc{border-color:#ef312f;color: #EF312F;}';
	$out .='</style>';
	echo $out;
}