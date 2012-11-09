<?php
/**
 * Template Name: store
 *
 * A custom page template for store.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Express
 * @since Express 1.0
 */
 ?>

<?php get_header(); ?>

    
    
	<div id="primary" class = "c12 centered" <?php //gridiculous_primary_attr(); ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php //comments_template( '', false ); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary.c8 -->

<?php get_footer(); ?>