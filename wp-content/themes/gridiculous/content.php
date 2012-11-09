<?php 
$format = ( function_exists( 'has_post_format' ) ) ? get_post_format() : '';
$header = array( '', 'status', 'gallery', 'video', 'image', 'audio' );
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( in_array( $format, $header ) ) : ?>	
		<header>
			<?php
			if ( 'status' == $format ) {
				echo get_avatar( get_the_author_meta( 'ID' ), 60 );
				echo '<span class="author">';
				the_author_posts_link();
				echo '</span>';
			} else { ?>
			<hgroup>
				<?php if ( ! is_archive() && ! is_page() ) { ?>
				<h3 class="post-category"><?php the_category( ', ' ); ?></h3>
				<?php } ?>
                <!--
				<h1 class="post-title">
					<?php if ( ! is_singular() ) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'gridiculous' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php } ?>
						<?php the_title(); ?>
					<?php 
					if ( ! is_singular() )
						echo '</a>'; 
					?>
				</h1>
                -->

				<?php if ( ! is_page() && 'page' != get_post_type() ) { ?>
				<h2 class="post-meta">
					<?php 
					_e('by', 'gridiculous'); echo ' '; the_author_posts_link(); 
					echo '&nbsp;&bull;&nbsp;';
					echo '<a class="date-anchor" href="' . get_permalink() . '">';
					the_time( get_option( 'date_format' ) );
					echo '</a>';
					
					if ( comments_open() ) {
						echo '&nbsp;&bull;&nbsp;'; 
						comments_popup_link( __( '0 Comments', 'gridiculous' ), __( '1 Comment', 'gridiculous' ), __( '% Comments', 'gridiculous' ) );
					}
					?>
				</h2>
				<?php } ?>
			</hgroup>
			<?php } ?>
		</header>
	<?php endif	?>
	
	    <div class="post-content">
	    <?php 
		if ( 'link' == $format || 'aside' == $format )
			echo '<header><h3 class="post-format">' . $format . '</h3></header>';

		if ( 'status' == $format ) {
			echo '<span class="the-time">';
			printf( __( 'Posted %1$s at %2$s', 'gridiculous' ), get_the_time( get_option( 'date_format' ) ), get_the_time( get_option( 'time_format' ) ) );
			echo '</span>';
		}

		if ( ! is_singular() && ( ( 'excerpt' == gridiculous_theme_options( 'excerpt_content' ) && empty( $format ) ) || 'image' == $format ) ) {
			$size = ( 'image' == $format ) ? 'full' : 'thumbnail';
			$class = ( 'image' == $format ) ? 'alignnone' : 'alignleft';
			if( has_post_thumbnail() ) 
				the_post_thumbnail( $size, array( 'class' => $class ) );
		}

		if ( 'gallery' == $format && ! is_single() ) { 
			global $post;
			$images = get_children( array( 
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'numberposts' => 100
			) );
		
			if ( ! empty( $images ) ) :
				$total_images = count( $images );
				$image = array_shift( $images );
				$image_img_tag = wp_get_attachment_image( $image->ID, 'full' );
				?>
			<a class="gallery-thumb alignnone" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
			<p class="gallery-text"><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo &rarr;</a>', 'This gallery contains <a %1$s>%2$s photos &rarr;</a>', $total_images, 'gridiculous' ), 'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'gridiculous' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
					number_format_i18n( $total_images ) ); ?></em></p>
				<?php 
			endif;
		} else {
			if ( 'image' == $format && has_post_thumbnail() ) {
				// do nothing
			} else {
				if ( 'excerpt' == gridiculous_theme_options( 'excerpt_content' ) && empty( $format ) && ! is_singular() )
					the_excerpt();
				else
					the_content( 'Read more &rarr;' );		
			}
		}
		?>
    	    </div><!-- .post-content --> 
	    
	    <?php if ( is_singular() ) : ?>
        
	    <footer class="article">
		    <?php
		   	wp_link_pages( array( 'before' => '<p id="pages">' . __( 'Pages:', 'gridiculous' ) ) );
		   	the_tags( '<p class="tags">Tags: ', ' ', '</p>' );
			edit_post_link( __( '(edit)', 'gridiculous' ), '<p>', '</p>' );
			?>
		</footer><!-- .article --> 	
		<?php endif ?>
	</article><!-- #post-<?php the_ID(); ?> -->