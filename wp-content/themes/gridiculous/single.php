<?php get_header(); ?>

	<div id="primary" <?php gridiculous_primary_attr(); ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<nav id="posts-pagination">
            
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'gridiculous' ); ?></h3>
				<div class="previous fl"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> %title', 'gridiculous' ) ); ?></div>
				<div class="next fr"><?php next_post_link( '%link', __( '%title <span class="meta-nav">&rarr;</span>', 'gridiculous' ) ); ?></div>
			</nav><!-- #posts-pagination -->

			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary.c8 -->

<?php get_footer(); ?>