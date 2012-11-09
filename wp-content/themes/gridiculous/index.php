<?php get_header(); ?>

<?php if(!is_front_page()) : ?>

	<div id="primary" <?php gridiculous_primary_attr(); ?>>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php gridiculous_pagination(); ?>

		<?php else : ?>

			<article id="post-0" class="post error404 not-found">

		    	<header>
		    	   	<h1 class="post-title"><?php _e("Not found", 'gridiculous'); ?></h1>
		        </header>

		        <div class="entry">
		            <p><?php _e("No results were found for your request.", 'gridiculous'); ?></p>
		        </div>

		    </article>

		<?php endif; ?>

	</div><!-- #primary.c8 -->
<?php endif; ?>
<?php get_footer(); ?>