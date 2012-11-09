<?php get_header(); ?>

	<section id="primary" <?php gridiculous_primary_attr(); ?>>

		<?php if ( have_posts() ) : ?>

			<header id="search-header">
				<h1 class="page-title"><?php
				global $wp_query;
			    $num = $wp_query->found_posts;
				printf( '%1$s "%2$s"',
				    $num . __( ' search results for', 'gridiculous'), 
				    get_search_query()
				);
				?></h1>
			</header><!-- #search-header -->

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
		            <p><?php _e( 'No results were found for your search. Please try again.', 'gridiculous' ); ?></p>
		        </div>

		    </article><!-- #post-0.post -->

		<?php endif; ?>

	</section><!-- #primary.c8 -->

<?php get_footer(); ?>