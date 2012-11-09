<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> --> 
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="grid<?php echo ' ' . gridiculous_theme_options( 'width' ); ?>">
	
		<header id="header" class="row" role="banner">

			<div class="c12">
            
            		<!--<hgroup>
					<h1 id="site-title" style="width:300px;"> -->
                    <div style="width:300px; float:left;">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php //bloginfo( 'name' ); ?>
                     
                   <img src="http://www.hoboworkshop.com/wp_store2/wp-content/uploads/2012/10/logo.jpg" title="" alt="" />
                    
                    </a>
                    </div>
                    <!--</h1>
									</hgroup> -->
            <?php
            	// Header Widgetized Area
				dynamic_sidebar( 'header-area' );
				?>
            <div style="float:right; width: 55%; text-align:right">
               <form action="<?php echo esc_url( get_permalink( get_page_by_title( 'Search' ) ) ); ?>">
                  <input type="text" name="k" style="width:auto;" /> <input type="submit" value="search" style="width:auto;">
                 </form>
            </div>
            <nav id="site-navigation" role="navigation">
					<!--<h3 class="assistive-text"><?php _e( 'Main menu', 'gridiculous' ); ?></h3>-->
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?>
				</nav><!-- #site-navigation -->

				<div id="drop-down-search">
					<?php get_search_form(); ?>
				</div>	

				<nav id="mobile-menu">
					<a href="<?php echo home_url(); ?>" class="circle home"></a>
					<a href="#" class="circle menu" data-div="#site-navigation" data-speed="500"></a>
					<a href="#" class="circle search" data-div="#drop-down-search" data-speed="fast"></a>
				</nav>

            
            <div id="top-bar" style="border-top:solid 1px #CCCCCC;float:left; width:100%; height:10px; "> </div> 
		   
				
				<?php 
			  if(is_front_page()):
				$header_image = get_header_image();
				if ( ! empty( $header_image ) ) :
					?>
					<img id="header-img" src="<?php header_image(); ?>" style="width:99%"  alt="" />
                    <?php //echo get_custom_header()->width; ?>
					<?php //echo get_custom_header()->height; ?>
					<?php 
					
				endif;
			  endif;	
				?>
				
				
			</div><!-- .c12 -->

		</header><!-- #header .row -->
        <div id="main" class="row">
		<?php 
		global $paged;
		if ( gridiculous_theme_options( 'home_widget' ) && is_front_page() && 2 > $paged ) { 
			?>

		<div id="home-page-widgets" class="row">
			<?php if ( ! dynamic_sidebar( 'home-page-top-area' ) ) : ?>
			<aside class="home-widget c4 widget_text">
				<h3 class="home-widget-title">Responsive Design</h3>
				<div class="textwidget">
					<img src="<?php echo GRIDICULOUS_THEME_URL; ?>/images/ex01.jpg" alt="" />
					Built using Gridiculous, a fully responsive grid layout boilerplate. Resize the browser window to see how your site will adjust for desktop viewing, tablets and handheld devices.  
				</div>
			</aside>

			<aside class="home-widget c4 widget_text">
				<h3 class="home-widget-title">Fully Customizable</h3>
				<div class="textwidget">
					<img src="<?php echo GRIDICULOUS_THEME_URL; ?>/images/ex02.jpg" alt="" />
					Use the new theme customizer in <a href="http://wordpress.org/">WordPress 3.4</a> to preview all your changes before putting them live. Select a custom header image, background color, page layout, link color and so much more.
				</div>
			</aside>
			
			<aside class="home-widget c4 widget_text">
				<h3 class="home-widget-title">Color Options</h3>
				<div class="textwidget">
					<img src="<?php echo GRIDICULOUS_THEME_URL; ?>/images/ex03.jpg" alt="" />
					With so many colors to choose from, the possibilities are endless. Select one for your header text and your links. If one color isn't enough for your background you can also select any image you choose.
				</div>
			</aside>			

			<?php endif; ?>
		</div>
		
		<?php } ?>

		<?php
		$sticky = get_option( 'sticky_posts' );
		$featured = new WP_Query( array(
			'posts_per_page' => 1,
			'post__in'  => $sticky,
			'ignore_sticky_posts' => 1
		) );
		if ( ! empty( $sticky[0] ) && is_home() && 2 > $paged ) {
		?>
		
		<div id="featured" class="row">
			
			<div class="c12">

				<?php
				while ( $featured->have_posts() ) : $featured->the_post();

					get_template_part( 'content', get_post_format() );

				endwhile;
				
				wp_reset_postdata();
				?>
			
			</div>
			
		</div>
		
		<?php } ?>
	    <!--<div id="main" class="row">-->