<?php get_header(); ?>

	<section id="primary" <?php gridiculous_primary_attr(); ?>>

		<?php if ( have_posts() ) : ?>

			<header id="archive-header">
				<?php 
				if ( is_category() || is_author() ) 
					echo '<hgroup>';
				?>
				<h1 class="page-title">
					<?php if ( is_category() ) : ?>
						<?php echo'<span>' . single_cat_title( '', false ) . '</span>'; ?>
					<?php elseif ( is_author() ) : ?>
						<?php printf( __( 'Author Archive for %s', 'gridiculous' ), '<span>' . get_the_author_meta( 'display_name', get_query_var( 'author' ) ) . '</span>' ); ?>
					<?php elseif ( is_tag() ) : ?>
						<?php printf( __( 'Tag Archive for %s', 'gridiculous' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
					<?php elseif ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: %s', 'gridiculous' ), '<span>' . get_the_date() . '</span>' ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: %s', 'gridiculous' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'gridiculous' ) ) . '</span>' ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: %s', 'gridiculous' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'gridiculous' ) ) . '</span>' ); ?>
					<?php else : ?>
						<?php _e( 'Blog Archives', 'gridiculous' ); ?>
					<?php endif; ?>
				</h1><!-- .page-title -->
				<?php
				if ( is_category() ) :
					$category_description = strip_tags( category_description() );

					if ( ! empty( $category_description ) )
						echo '<h2 class="archive-meta">' . $category_description . '</h2>';
				endif;

				if ( is_author() ) :
					$author_description = get_the_author_meta( 'description' );

					if ( ! empty( $author_description ) )
						echo '<h2 class="archive-meta">' . $author_description . '</h2>';
				endif;
				
				if ( is_category() || is_author() )
					echo '</hgroup>'; 
				?>
			</header><!-- #archive-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php gridiculous_pagination(); ?>

		<?php else : ?>

			<article id="post-0" class="post error404 not-found">

		    	<header>
		    	   	<h1 class="post-title"><?php _e( 'Nothing found', 'gridiculous' ); ?></h1>
		        </header>

		        <div class="entry">
		            <p><?php _e( 'No results were found for the requested archive. Perhaps searching will help find a related post.', 'gridiculous' ); ?></p>
		        </div>

		    </article><!-- #post-0.post -->

		<?php endif; ?>

	</section><!-- #primary.c8 -->

<?php get_footer(); ?>