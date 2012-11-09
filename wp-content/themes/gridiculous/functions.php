<?php
if ( ! isset( $content_width ) )
	$content_width = 680;

define( 'GRIDICULOUS_THEME_URL', get_template_directory_uri() );
define( 'GRIDICULOUS_THEME_TEMPLATE', get_template_directory() );

add_action( 'after_setup_theme', 'gridiculous_setup' );
if ( ! function_exists( 'gridiculous_setup' ) ) :
/**
 * Initial setup for Gridiculous theme 
 *
 * This function is attached to the 'after_setup_theme' action hook.
 *
 * @uses	load_theme_textdomain()
 * @uses	get_locale()
 * @uses	GRIDICULOUS_THEME_TEMPLATE
 * @uses	add_theme_support()
 * @uses	add_editor_style()
 * @uses	add_custom_background()
 * @uses	add_custom_image_header()
 * @uses	register_default_headers()
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_setup() {
	load_theme_textdomain( 'gridiculous', GRIDICULOUS_THEME_TEMPLATE . '/languages' );

	$locale = get_locale();
	$locale_file = GRIDICULOUS_THEME_TEMPLATE . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'gridiculous' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'quote', 'link', 'status', 'aside' ) );

	// This theme uses Featured Images (also known as post thumbnails) for archive pages
	add_theme_support( 'post-thumbnails' );

	// Add a filter to gridiculous_header_image_width and gridiculous_header_image_height to change the width and height of your custom header.
	$custom_header_support = array(
		'default-text-color' => '333',
		'flex-height' => true,
		'flex-width' => true,
		'random-default' => true,
		'width' => apply_filters( 'gridiculous_header_image_width', 1280 ),
		'height' => apply_filters( 'gridiculous_header_image_height', 288 ),
		'wp-head-callback' => 'gridiculous_header_style',
		'admin-head-callback' => 'gridiculous_admin_header_style',
		'admin-preview-callback' => 'gridiculous_admin_header_image'
	);	
	
	add_theme_support( 'custom-header', $custom_header_support );

	// Add support for custom backgrounds
	$custom_background_support = array( 
		'default-image' => GRIDICULOUS_THEME_URL . '/images/solid.png',
		'admin-head-callback' => 'gridiculous_admin_background_style'
	); 

	add_theme_support( 'custom-background', $custom_background_support );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'froggy' => array(
			'url' => '%s/images/froggy.jpg',
			'thumbnail_url' => '%s/images/froggy-thumbnail.jpg',
			'description' => __( 'Froggy', 'gridiculous' )
		)
	) );
}
endif; // gridiculous_setup

if ( ! function_exists( 'gridiculous_admin_background_style' ) ) :
/**
 * Styles the background displayed on the Appearance > Background admin panel.
 *
 * Referenced via add_custom_background() in gridiculous_setup().
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_admin_background_style() {
	?>
	<style type="text/css">
		#custom-background-image {
			background-image: url(<?php background_image(); ?>) !important;
		}
	</style>
	<?php
}
endif; // gridiculous_admin_background_style

if ( ! function_exists( 'gridiculous_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;
		
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
		?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		<?php
		// If the user has set a custom color for the text use that
		else :
		?>
		#site-title a,
		#site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // gridiculous_header_style

if ( ! function_exists( 'gridiculous_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in gridiculous_setup().
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_admin_header_style() {
	?>
	<style type="text/css">
	@font-face {
		font-family: 'Russo One';
		font-style: normal;
		font-weight: 400;
		src: local('Russo One'), local('RussoOne-Regular'), url('http://themes.googleusercontent.com/static/fonts/russoone/v1/RO6e96EC9m6OLO0tr7J3z7O3LdcAZYWl9Si6vvxL-qU.woff') format('woff');
	}

	.appearance_page_custom-header #headimg {
		border: none;
		}
	
	#headimg h1 {
		margin: 0;
		}

	#headimg h1 a {
		font-family: 'Russo One', sans-serif;
		text-decoration: none;
		font-size: 60px;
		line-height: 1;
		}

	#desc {
		font-family: Arial, sans-serif;
		margin: 0 0 30px;
		font-size: 20px;
		line-height: 1;
		font-weight: bold;
		}
	<?php
	// If the user has set a custom color for the text use that
	if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1140px;
		height: auto;
		width: 100%;
	}
	</style>
	<?php
}
endif; // gridiculous_admin_header_style

if ( ! function_exists( 'gridiculous_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in gridiculous_setup().
 *
 * @uses	get_theme_mod()
 * @uses	bloginfo()
 * @uses	get_header_image()
 * @uses	home_url()
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_admin_header_image() { 
	?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();

		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
	<?php 
}
endif; // gridiculous_admin_header_image

add_action( 'pre_get_posts', 'gridiculous_home_query' );
if ( ! function_exists( 'gridiculous_home_query' ) ) :
/**
 * Remove sticky posts from home page query
 *
 * This function is attached to the 'pre_get_posts' action hook.
 *
 * @param	array $query
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_home_query( $query = '' ) {
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() )
		return;

	$query->set( 'post__not_in', get_option( 'sticky_posts' ) );
}
endif;

add_action( 'wp_enqueue_scripts', 'gridiculous_add_js' );
if ( ! function_exists( 'gridiculous_add_js' ) ) :
/**
 * Load all JavaScript to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 * @uses	is_admin()
 * @uses	is_singular()
 * @uses	get_option()
 * @uses	wp_enqueue_script()
 * @uses	GRIDICULOUS_THEME_URL
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_add_js() {
	if ( ! is_admin() ) {
		if ( is_singular() && get_option( 'thread_comments' ) ) 
			wp_enqueue_script( 'comment-reply' );

		wp_enqueue_script( 'modernizr', GRIDICULOUS_THEME_URL .'/js/modernizr.min.js', '', '2.5.3');
		wp_enqueue_script( 'jquery' );
	}
}
endif; // gridiculous_add_js

add_action( 'admin_enqueue_scripts', 'gridiculous_admin_scripts' );
if ( ! function_exists( 'gridiculous_admin_scripts' ) ) :
/**
 * Add JS file to set class of post format to visual editor.
 *
 * This function is attached to the 'admin_enqueue_scripts' action hook.
 *
 * @param	$hook  The page template file for the current page
 *
 * @uses	wp_enqueue_script()
 * @uses	GRIDICULOUS_THEME_URL
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_admin_scripts( $hook ) {
	if( 'post-new.php' == $hook || 'post.php' == $hook )
	    wp_enqueue_script( 'editor_styles_post_format_js', GRIDICULOUS_THEME_URL . '/js/editor-styles-post-format.js', true, array( 'jquery' ), '1.0.0' );
}
endif; // gridiculous_admin_scripts

add_action( 'widgets_init', 'gridiculous_widgets_init' );
if ( ! function_exists( 'gridiculous_widgets_init' ) ) :
/**
 * Creating the two sidebars 
 *
 * This function is attached to the 'widgets_init' action hook.
 *
 * @uses	register_sidebar()
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Header Area', 'gridiculous' ),
		'id' => 'header-area',
		'description' => __( 'Widgetized area in the header to the right of the site name. Great place for a search box or a banner ad.', 'gridiculous' ),
		'before_widget' => '<aside id="%1$s" class="header-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="header-widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Home Page Top Area', 'gridiculous' ),
		'id' => 'home-page-top-area',
		'description' => __( 'Widgetized area on the home page directly below the navigation menu. Specifically designed for 3 text widgets. Must be turned on in the Layout options on the Customize Gridiculous admin page.', 'gridiculous' ),
		'before_widget' => '<div id="%1$s" class="home-widget c12">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="home-widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Sidebar', 'gridiculous' ),
		'id' => 'sidebar',
		'description' => __( 'This is the sidebar widgetized area. All defaults widgets work great here.', 'gridiculous' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
endif; // gridiculous_widgets_init

if ( !function_exists( 'gridiculous_pagination' ) ) :
/**
 * Add pagination 
 *
 * @uses	paginate_links()
 * @uses	add_query_arg()
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_pagination() {
	global $wp_query;

	$current = max( 1, get_query_var('paged') );
	$big = 999999999; // need an unlikely integer
	
	$pagination_return = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => $current,
		'total' => $wp_query->max_num_pages,
		'next_text' => '&raquo;',
		'prev_text' => '&laquo;'
	) );
	
	if ( ! empty( $pagination_return ) ) {
		echo '<div id="pagination">';
		echo '<div class="total-pages">';
		printf( __( 'Page %1$s of %2$s', 'gridiculous' ), $current, $wp_query->max_num_pages );
		echo '</div>';
		echo $pagination_return;
		echo '</div>';
	}
}
endif; // gridiculous_pagination

add_filter( 'wp_title', 'gridiculous_filter_wp_title' );
if ( !function_exists( 'gridiculous_filter_wp_title' ) ) :
/**
 * Filters the page title appropriately depending on the current page 
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 *
 * @since Gridiculous 1.0.1
 */
function gridiculous_filter_wp_title( $title ) {
	global $page, $paged;

	$site_description = get_bloginfo( 'description' );
	
	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'gridiculous' ), max( $paged, $page ) ) : '';
		
	return $filtered_title;
}
endif; // gridiculous_filter_wp_title

if ( ! function_exists( 'gridiculous_comment' ) ) :
/**
 * Callback function for comments
 *
 * Referenced via wp_list_comments() in comments.php.
 *
 * @uses	get_avatar()
 * @uses	get_comment_author_link()
 * @uses	get_comment_date()
 * @uses	get_comment_time()
 * @uses	edit_comment_link()
 * @uses	comment_text()
 * @uses	comments_open()
 * @uses	comment_reply_link()
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 60 ); ?>
				</div>     
				<div class="comment-content">
					<div class="comment-author">
						<?php echo get_comment_author_link() . ' '; ?>
					</div>
					<div class="comment-meta">
						<?php
						printf( __( '%1$s at %2$s', 'gridiculous' ), get_comment_date(), get_comment_time() ); 
						edit_comment_link( __( '(edit)', 'gridiculous' ), '  ', '' );
						?>
					</div>
					<div class="comment-text">
						<?php if ( '0' == $comment->comment_approved ) { echo '<em>' . __( 'Your comment is awaiting moderation.', 'gridiculous' ) . '</em>'; } ?>
						<?php comment_text() ?>
					</div>
					<?php if ( $args['max_depth'] != $depth && comments_open() && 'pingback' != $comment->comment_type ) { ?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php
			break;

		case 'pingback'  :
		case 'trackback' :
		?>
		<li class="pingback">
			<div class="comment-body">
				<?php _e( 'Pingback:', 'gridiculous' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(edit)', 'gridiculous' ), ' ' ); ?>
			</div>
			<?php
			break;
	endswitch;
}
endif; // gridiculous_comment

add_filter( 'comment_form_default_fields', 'gridiculous_html5_fields' );
if ( ! function_exists( 'gridiculous_html5_fields' ) ) :
/**
 * Adds HTML5 fields to comment form
 *
 * This function is attached to the 'comment_form_default_fields' filter hook.
 *
 * @param	array $fields
 *
 * @return	Modified comment form fields
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_html5_fields( $fields ) {
	$fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" required size="30" placeholder="' . __( 'Name', 'gridiculous' ) . ' *" aria-required="true" /></p>';
	$fields['email'] = '<p class="comment-form-email"><input id="email" name="email" type="email" required size="30" placeholder="' . __( 'Email', 'gridiculous' ) . ' *" aria-required="true" /></p>';
	$fields['url'] = '<p class="comment-form-url"><input id="url" name="url" type="url" size="30" placeholder="' . __( 'Website', 'gridiculous' ) . '" /></p>';

	return $fields;
}
endif; // gridiculous_html5_fields

add_filter( 'get_search_form', 'gridiculous_html5_search_form' );
if ( ! function_exists( 'gridiculous_html5_search_form' ) ) :
/**
 * Update default WordPress search form to HTML5 search form 
 *
 * This function is attached to the 'get_search_form' filter hook.
 *
 * @param	$form
 *
 * @return	Modified search form
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_html5_search_form( $form ) {
    return '<form role="search" method="get" id="searchform" class="slide" action="' . home_url( '/' ) . '" >
    <label class="assistive-text" for="site-search">' . __('Search for:', 'gridiculous') . '</label>
    <input type="search" placeholder="' . __( 'Search&hellip;', 'gridiculous' ) . '" value="' . get_search_query() . '" name="s" id="site-search" />
    </form>';
}
endif; // gridiculous_html5_search_form

/**
 * Custom function to display post/page content pagination links
 *
 * @param	array $args
 *
 * @return	Pagenum links
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_link_pages( $args = '' ) {
	global $page, $numpages, $multipage, $more, $pagenow;

	$defaults = array(
        'before' => '<nav id="post-pagination"><h3 class="assistive-text">' . __( 'Post Pages menu', 'gridiculous' ) . '</h3>',
		'after' => '</nav>'
	);
	
	$output = '';
	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	if ( $multipage ) {
	    $output .= $before;
	    for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
			$j = str_replace( '%', $i, '%' );
		
			$output .= ' ';
			$output .= ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) ? _wp_link_page( $i ) :'<span class="current-post-page">';
			$output .= $j;
			$output .= ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) ? '</a>' : '</span>';
	    }
	    $output .= $after;
	}
	return $output;
}

add_filter( 'excerpt_more', 'gridiculous_excerpt_more' );
if ( ! function_exists( 'gridiculous_excerpt_more' ) ) :
/**
 * Adds a read more link to all excerpts
 *
 * @param	int $more
 *
 * @return	Custom read more link
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_excerpt_more( $more ) {
	return '&hellip;<p class="more-link-p"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read more &rarr;', 'gridiculous' ) . '</a></p>';
}
endif; // gridiculous_excerpt_more

add_filter( 'excerpt_length', 'gridiculous_excerpt_length', 999 );
if ( ! function_exists( 'gridiculous_excerpt_length' ) ) :
/**
 * Custom excerpt length
 *
 * @param	int $length
 *
 * @return	Custom excerpt length
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_excerpt_length( $length ) {
	return 40;
}
endif;

add_filter( 'post_gallery', 'gridiculous_gallery_shortcode' );
/**
 * Add Lightbox effect to gallery images.
 *
 * This function is attached to the 'post_gallery' filter hook.
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_gallery_shortcode( $attr ) {
	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract( shortcode_atts( array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => get_the_ID(),
		'itemtag' => 'li',
		'include' => '',
		'exclude' => ''
	), $attr ) );

	$id = (int) $id;
	$orderby = ( 'RAND' == $order ) ? 'none' : $orderby;

	if ( ! empty( $include ) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $exclude ) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
	}

	if ( empty( $attachments ) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link( $att_id, 'thumbnail', true ) . "\n";
		return $output;
	}

	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$i = 1;
	$output = "<div id='$selector' class='gallery galleryid-{$id}'>";
	foreach ( $attachments as $id => $attachment ) {
		$full_image_src = wp_get_attachment_image_src( $id, 'full' );
		$image_src = wp_get_attachment_image_src( $id, 'thumbnail' );

		$output .= "<div class='gallery-item'>";
		$output .= '<img class="img-' . $i . '" data-next-image="img-' . ($i + 1) . '" data-prev-image="img-' . ($i - 1) . '" data-full-image="' . esc_url( $full_image_src[0] ) . '" data-caption="' . esc_attr( $attachment->post_excerpt ) . '" src="' . esc_url( $image_src[0] ) . '" width="' . esc_attr( $image_src[1] ) . '" height="' . esc_attr( $image_src[2] ) . '" alt="" />';
		$output .= "</div>";
		$i++;
	}
	
	$output .= "</div>\n";

	return $output;
}

add_action( 'wp_footer', 'gridiculous_scripts', 99 );
if ( ! function_exists( 'gridiculous_scripts' ) ) :
/**
 * Adds video resize script to footer
 *
 * This function is attached to the 'wp_footer' action hook.
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_scripts() {
	?>
<script type="text/javascript">
/* <![CDATA[ */
( function( $ ) {
	// Responsive videos
	var all_videos = $( 'iframe[src^="http://player.vimeo.com"], iframe[src^="http://www.youtube.com"], iframe[src^="http://www.dailymotion.com"], object, embed' ),
    	input = document.createElement( 'input' ),
    	i;
	    	
	all_videos.each(function() {
		var el = $(this);
		el
			.attr( 'data-aspectRatio', el.height() / el.width() )
			.attr( 'data-oldWidth', el.attr( 'width' ) );
	} );
	
	$(window)
		.resize( function() {
			all_videos.each( function() {
				var el = $(this),
					newWidth = el.parents( '.post-content' ).width(),
					oldWidth = el.attr( 'data-oldWidth' );
	
				if ( oldWidth > newWidth ) {
					el
						.removeAttr( 'height' )
						.removeAttr( 'width' )
					    .width( newWidth )
				    	.height( newWidth * el.attr( 'data-aspectRatio' ) );
				}
			} );
			
			if ( $(window).width() > 600 ) {
				$( '#site-navigation' ).show();
				$( '#drop-down-search' ).hide();
			}
		} )
		.resize()
	
	// Placeholder fix for older browsers
    if ( ( 'placeholder' in input ) == false ) { 
		$( '[placeholder]' ).focus( function() {
			i = $( this );
			if ( i.val() == i.attr( 'placeholder' ) ) {
				i.val( '' ).removeClass( 'placeholder' );
				if ( i.hasClass( 'password' ) ) {
					i.removeClass( 'password' );
					this.type = 'password';
				}			
			}
		} ).blur( function() {
			i = $( this );	
			if ( i.val() == '' || i.val() == i.attr( 'placeholder' ) ) {
				if ( this.type == 'password' ) {
					i.addClass( 'password' );
					this.type = 'text';
				}
				i.addClass( 'placeholder' ).val( i.attr( 'placeholder' ) );
			}
		} ).blur().parents( 'form' ).submit( function() {
			$( this ).find( '[placeholder]' ).each( function() {
				i = $( this );
				if ( i.val() == i.attr( 'placeholder' ) )
					i.val( '' );
			} )
		} );
	}

	// Lightbox effect for gallery
	$( '#primary' ).find( '.gallery-item img' ).click( function() {
		$( '#lightbox' ).remove();
	
		var el = $( this ),
			full = el.data( 'full-image' ),
			caption = el.data( 'caption' ),
			next = el.data( 'next-image' ),
			prev = el.data( 'prev-image' ),
			count = $( '.gallery-item img' ).length,
			prev_text = ( 'img-0' != prev ) ? '<span class="prev-image" data-prev-image="' + prev + '">&larr;</span>' : '';
			next_text = ( 'img-' + ( count + 1 ) != next ) ? '<span class="next-image" data-next-image="' + next + '">&rarr;</span>' : '';

		$( '#page' ).append( '<div id="lightbox"><div class="lightbox-container">' + prev_text + next_text + '<img src="' + full + '" /><p>' + caption + '</p></div></div>' );
	} );

	$( '#page' )
		.on( 'click', '#lightbox', function() {
			$( this ).fadeOut();
		} )
		.on( 'click', '#lightbox .prev-image', function(e) {
			e.stopPropagation();
			var prev = $( this ).data( 'prev-image' );
			
			$( '.' + prev ).trigger( 'click' );
		} )
		.on( 'click', '#lightbox .next-image', function(e) {
			e.stopPropagation();
			var next = $( this ).data( 'next-image' );
			
			$( '.' + next ).trigger( 'click' );
		} )
		.on( 'click', '#lightbox img', function(e) {
			e.stopPropagation();
			$( '#lightbox .next-image' ).trigger( 'click' );
		} );

	// Mobile menu
	$( '#header' ).on( 'click', '#mobile-menu a', function(e) {
		var el = $( this ),
			div = $(this).data("div"),
			speed = $(this).data("speed");
	
		if ( el.hasClass( 'home' ) )
			return true;

		e.preventDefault();
		$(div).slideToggle(speed);		
	} );

} )( jQuery );
/* ]]> */
</script>
	<?php
}
endif; // gridiculous_scripts

add_action( 'wp_head', 'gridiculous_styles' );
/**
 * Add a style block to the theme for the current link color.
 *
 * This function is attached to the 'wp_head' action hook.
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_styles() {
	?>
	<style>
	/* Link color */
	.post-meta a, .post-content a, .widget a { color: <?php echo gridiculous_theme_options( 'link_color' ); ?>; }
	</style>
	<?php
}

if ( ! function_exists( 'gridiculous_theme_options' ) ) :
/**
 * Set up the default theme options
 *
 * @param	string $name  The option name
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_theme_options( $name ) {
	$default_theme_options = array(
		'width' => 'w960',
		'layout' => '2',
		'primary' => 'c8',
		'tagline' => 'on',
		'link_color' => '#333333',
		'excerpt_content' => 'content',
		'home_widget' =>'on'
	);

	$options = wp_parse_args( get_option( 'gridiculous_theme_options' ), $default_theme_options );

	return $options[$name];
}
endif;

add_action( 'customize_register', 'gridiculous_customize_register' );
/**
 * Adds theme options to the Customizer screen
 *
 * This function is attached to the 'customize_register' action hook.
 *
 * @param	class $wp_customize
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'gridiculous_theme_options[tagline]', array(
		'default'    => gridiculous_theme_options( 'tagline' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'gridiculous_tagline', array(
		'label'      => __( 'Display Tagline', 'gridiculous' ),
		'section'    => 'title_tagline',
		'settings' => 'gridiculous_theme_options[tagline]',
		'type' => 'checkbox',
	) );

	$wp_customize->add_section( 'gridiculous_layout', array(
		'title' => __( 'Layout', 'gridiculous' ),
		'priority' => 35,
	) );

	$wp_customize->add_setting( 'gridiculous_theme_options[width]', array(
		'default'    => gridiculous_theme_options( 'width' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'gridiculous_width', array(
		'label'      => __( 'Site Width', 'gridiculous' ),
		'section'    => 'gridiculous_layout',
		'settings' => 'gridiculous_theme_options[width]',
		'type' => 'select',
		'choices' => array(
			'' => '1200px',
			'w960' => __( '960px', 'gridiculous' ),
			'w640' => __( '640px', 'gridiculous' ),
			'wfull' => __( 'Full Width', 'gridiculous' ),
		),
	) );

	$wp_customize->add_setting( 'gridiculous_theme_options[layout]', array(
		'default'    => gridiculous_theme_options( 'layout' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'gridiculous_site_layout', array(
		'label'      => __( 'Site Layout', 'gridiculous' ),
		'section'    => 'gridiculous_layout',
		'settings' => 'gridiculous_theme_options[layout]',
		'type' => 'radio',
		'choices' => array(
			'1' => __( 'Left Sidebar', 'gridiculous' ),
			'2' => __( 'Right Sidebar', 'gridiculous' ),
			'3' => __( 'No Sidebar', 'gridiculous' ),
		),
	) );

	$wp_customize->add_setting( 'gridiculous_theme_options[primary]', array(
		'default'    => gridiculous_theme_options( 'primary' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'gridiculous_primary_column', array(
		'label'      => __( 'Main Content', 'gridiculous' ),
		'section'    => 'gridiculous_layout',
		'settings' => 'gridiculous_theme_options[primary]',
		'type' => 'select',
		'choices' => array(
			'c1' => __( '1 Column', 'gridiculous' ),
			'c2' => __( '2 Columns', 'gridiculous' ),
			'c3' => __( '3 Columns', 'gridiculous' ),
			'c4' => __( '4 Columns', 'gridiculous' ),
			'c5' => __( '5 Columns', 'gridiculous' ),
			'c6' => __( '6 Columns', 'gridiculous' ),
			'c7' => __( '7 Columns', 'gridiculous' ),
			'c8' => __( '8 Columns', 'gridiculous' ),
			'c9' => __( '9 Columns', 'gridiculous' ),
			'c10' => __( '10 Columns', 'gridiculous' ),
			'c11' => __( '11 Columns', 'gridiculous' ),
			'c12' => __( '12 Columns', 'gridiculous' ),
		),
	) );

	$wp_customize->add_setting( 'gridiculous_theme_options[excerpt_content]', array(
		'default'    => gridiculous_theme_options( 'excerpt_content' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'gridiculous_excerpt_content', array(
		'label'      => __( 'Post Content Display', 'gridiculous' ),
		'section'    => 'gridiculous_layout',
		'settings' => 'gridiculous_theme_options[excerpt_content]',
		'type' => 'radio',
		'choices' => array(
			'excerpt' => __( 'Teaser Excerpt', 'gridiculous' ),
			'content' => __( 'Full Content', 'gridiculous' ),
		),
	) );

	$wp_customize->add_setting( 'gridiculous_theme_options[home_widget]', array(
		'default'    => gridiculous_theme_options( 'home_widget' ),
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'gridiculous_home_widget', array(
		'label'      => __( 'Display Home Page Top Widget Area', 'gridiculous' ),
		'section'    => 'gridiculous_layout',
		'settings' => 'gridiculous_theme_options[home_widget]',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'gridiculous_theme_options[link_color]', array(
		'default'           => gridiculous_theme_options( 'link_color' ),
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'    => __( 'Link Color', 'gridiculous' ),
		'section'  => 'colors',
		'settings' => 'gridiculous_theme_options[link_color]',
	) ) );
}

/**
 * Create the required attributes for the #primary container
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_primary_attr() {
	$column = gridiculous_theme_options( 'primary' );
	$class = ( 3 == gridiculous_theme_options( 'layout' ) ) ? $column . ' centered' : $column;
	$style = ( 1 == gridiculous_theme_options( 'layout' ) ) ? ' style="float: right;"' : ''; 
	
	echo 'class="' . $class . '"' . $style;
}

/**
 * Create the required classes for the #secondary sidebar container
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_sidebar_class() {
	$end = ( 2 == gridiculous_theme_options( 'layout' ) ) ? ' end' : '';
	$class = str_replace( 'c', '', gridiculous_theme_options( 'primary' ) );
	$class = 'c' . ( 12 - $class ) . $end;
	 
	echo 'class="' . $class . '"';
}

add_action( 'admin_bar_menu', 'gridiculous_add_admin_bar_menu_item', 1000 );
/**
 * Add a 'customize' menu item to the admin bar
 *
 * This function is attached to the 'admin_bar_menu' action hook.
 *
 * @since Gridiculous 1.0.0
 */
function gridiculous_add_admin_bar_menu_item() {
    global $wp_admin_bar, $wpdb;

    if ( current_user_can( 'edit_theme_options' ) && is_admin_bar_showing() )
    	$wp_admin_bar->add_menu( array( 'id' => 'theme_options', 'title' => __( 'Theme Options', 'gridiculous' ), 'href' => admin_url( 'customize.php' ) ) );
       	$wp_admin_bar->add_menu( array( 'id' => 'upgrade_to_pro', 'title' => __( 'Upgrade to Gridiculous Pro', 'gridiculous' ), 'href' => '' ) );
       	$wp_admin_bar->add_group( array( 'parent' => 'upgrade_to_pro', 'id' => 'bavotasan_videos', ) );
       	$video = '
       	<div style="float: left;">
       		<iframe style="width: 560px; height: 315px;" width="560" height="315" src="http://www.youtube.com/embed/Ws0bWg64wck?rel=0" frameborder="0" allowfullscreen></iframe>
       		<a style="text-shadow: none; padding: 0 0 10px;" href="http://themes.bavotasan.com/2012/gridiculous-pro/">'
       		. __( 'Upgrade to Gridiculous Pro Now &rarr;', 'gridiculous' ) .
       		'</a>
       	</div>';
       	$wp_admin_bar->add_menu( array( 'parent' => 'bavotasan_videos', 'id' => 'gridiculous_preview', 'title' => $video, 'href' =>'' ) );
}

add_action ( 'admin_menu', 'gridiculous_add_link_admin' );
/**
 * Add a 'customize' menu item to the Appearance panel
 *
 * This function is attached to the 'admin_menu' action hook.
 *
 * @since Gridiculous 1.0.4
 */
function gridiculous_add_link_admin() {
	add_theme_page( 'Theme Options', __( 'Theme Options', 'gridiculous' ), 'edit_theme_options', 'customize.php' );
}

add_action( 'wp_login_failed', 'pippin_login_fail' );  // hook failed login
function pippin_login_fail( $username ) {
     $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
     // if there's a valid referrer, and it's not the default log-in screen
     if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
          wp_redirect(get_permalink( get_page_by_title( 'login' ) )  . '/?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
          exit;
     }
}

/* Disable WordPress Admin Bar for all users but admins. */
if (!current_user_can('administrator')):
  show_admin_bar(false);
endif;
