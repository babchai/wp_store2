<?php 
if ( 3 != gridiculous_theme_options( 'layout' ) ) {
	?>
	<div id="secondary" <?php gridiculous_sidebar_class(); ?> role="complementary">

		<div id="sidebar-one">

			<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

			<aside id="meta" class="widget">
				<h3 class="widget-title"><?php _e( 'Meta', 'gridiculous' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

			<aside id="archives" class="widget">
				<h3 class="widget-title"><?php _e( 'Archives', 'gridiculous' ); ?></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>
	
			<?php endif; ?>

		</div><!-- #sidebar-one -->

	</div><!-- #secondary.widget-area -->
	<?php
}