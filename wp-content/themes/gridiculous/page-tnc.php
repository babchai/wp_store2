<?php
/**
 * Template Name: tnc
 *
 * A custom page template for tnc.
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

<h1 class="post-title" style="margin:auto"> <?php echo get_the_title(); ?> </h1><br />



    <div style="float:left; width:25%">
        <?php
         $pageChildren = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = '253' AND post_type = 'page' ORDER BY menu_order", 'OBJECT'); 				?>
         <ul>
        <? if ( $pageChildren ) : 
		     foreach ( $pageChildren as $pageChild ) : 
			     //print_r($pageChild);
				 echo '<li><a href="'.esc_url( get_permalink( get_page_by_title( $pageChild->post_title) ) ).'">'.$pageChild->post_title .'</a></li>';
	 ?>
<!-- loop stuff here -->
         <? endforeach; endif; ?>
	  </ul>
    </div>
    
	<div style="float:left; width:70%">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php //comments_template( '', false ); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary.c8 -->

<?php get_footer(); ?>