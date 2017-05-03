<body <?php body_class(); ?>>

<div class="page-loader">
	<img src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" alt="<?php _e('ajax loader','business-one'); ?>">
</div> <!-- end page-loader -->

<?php global $business; ?>

<!-- CUSTOM HEADER -->
	<div class="custom-header" role="banner">
		
		<div class="container">
			
			<h2 class="heading-blog">
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo get_bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>
			</h2>

			<p class="blog-desc"><?php bloginfo('description'); ?></p>

		</div> <!-- end container -->

	</div>
	<!-- END CUSTOM HEADER -->


	<!-- blog-justify -->
	<div class="blog-justify">
		
		<i class="fa fa-align-justify"></i>

	</div> <!-- blog-justify -->


	<header class="blog-mobile-menu">	
			
		<?php wp_nav_menu(array(
			'theme_location' => 'top-menu',
			'menu_class' => 'nav',
			'container' => 'nav',
			'container_class' => '',
			'depth' => 2,
			'fallback_cb' => 'business_one_menufb'
		)); ?>		

	</header>
	

	<!-- NAVIGATION and LOGO -->
	<header class="blog-header">
		
		<div class="container">

			<div class="col-sm-3">
				
				<div class="blog-logo">
					
					<?php if(isset($business['logo']['url'])){ ?>

						<?php if($business['logo']['url']){ ?>

							<a href="<?php echo esc_url(home_url('/')); ?>" class="u-photo" title="<?php bloginfo('name'); ?>">
								<img src="<?php echo $business['logo']['url']; ?>" alt="<?php _e('logo','business-one'); ?>">
							</a>

					<?php } } ?>

				</div> <!-- end blog-logo -->

			</div> <!-- end col-sm-3 -->						
				

			<?php wp_nav_menu(array(
				'theme_location' => 'top-menu',
				'menu_class' => 'nav navbar-nav',
				'container' => 'nav',
				'container_class' => 'col-sm-9 clearfix',
				'depth' => 2,
				'fallback_cb' => 'business_one_menufb'
			)); ?>			


		</div> <!-- end container -->


	</header> 
	<!-- END NAVIGATION and LOGO -->