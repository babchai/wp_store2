			<?php get_sidebar(); ?>

	</div> <!-- #main.row -->

</div> <!-- #page.grid -->



	<div id="footer-content" class="grid <?php echo gridiculous_theme_options( 'width' ); ?>" style="background-color:#444444">

		<div class="row">
  
           <p  style="padding:10px !important; margin:1px !important; color:#bfbfbf; font-size:9px">
           <?php
         $pageChildren = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = '253' AND post_type = 'page' ORDER BY menu_order", 'OBJECT'); 				?>
       
        <? if ( $pageChildren ) : 
		     foreach ( $pageChildren as $pageChild ) : 
			     //print_r($pageChild);
				 echo '<a href="'.esc_url( get_permalink( get_page_by_title( $pageChild->post_title) ) ).'" style="color:#bfbfbf; a:hover:#df0404">'.$pageChild->post_title .'</a> | ';
	 ?>
<!-- loop stuff here -->
         <? endforeach; endif; ?>
			<br />
            <span>Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo home_url("/"); ?>" style="color:#bfbfbf"><?php echo bloginfo("name"); ?></a>. All Rights Reserved.</span>

           </p>
             


		</div><!-- .row -->

	</div><!-- #footer-content.grid -->



<?php wp_footer(); ?>
<!-- Gridiculous created by c.bavota - http://themes.bavotasan.com -->
</body>
</html>