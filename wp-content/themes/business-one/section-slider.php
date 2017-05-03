<?php global $business; ?>

<?php if(isset($business['opt-gallery'])){ 

		 if($business['opt-gallery']){ ?>
	
		<!-- HEADER -->
<header class="top-header" role="banner" id="home">
				
				<div class="container">
					
					<figure class="logo col-sm-3 col-md-2 col-lg-3">

						<?php business_one_logo(); ?>

					</figure> <!-- end logo -->				

			
					<div class="col-sm-9 col-md-10 col-lg-9">
						
						<?php wp_nav_menu(array(

							'theme_location' => 'homepage-menu',
							'menu_class' => 'nav navbar-nav',
							'container' => 'nav',
							'container_class' => 'top-navigation',
							'depth' => 2,
							'fallback_cb' => 'business_one_menufb'

						)); ?>

					</div>

				</div>

				


				<div class="top-slider">
					
						<div class="content">						
													
							<div class="fade">

							<?php 							

								$business_gallery=$business['opt-gallery'];

								$galleries=explode(',',$business_gallery);
							

							 foreach($galleries as $gallery){ ?>
								
								<div>
									<div class="image"><img src="<?php echo wp_get_attachment_url($gallery); ?>"></div>									
								</div>

							<?php } ?>
															
								
							</div> <!-- end fade -->						
							
						</div> <!-- end content -->			

				</div> <!-- end top-slider -->



				<div class="featured-content">						
							
					<div class="container">

						<?php if(isset($business['slider-title'])){ ?>

							<?php if($business['opt-gallery']){ ?>
							
								<h1 class="featured-heading"><?php echo $business['slider-title']; ?></h1>

							<?php } ?>

							<?php if($business['slider-text']){ ?>

								<div class="featured-line"></div>

								<p class="featured-text"><?php echo $business['slider-text']; ?></p>

							<?php } ?>

							<?php if($business['slider-url']){ ?>							

							<a href="<?php echo $business['slider-url']; ?>" class="btn" title="<?php _e('Go for Details','business-one'); ?>" target="_blank"><?php _e('More details','business-one'); ?></a>

							<?php } ?>

						<?php } ?>

					</div> <!-- end container -->

				</div> <!-- end featured-content -->		


</header> 
<!-- END HEADER -->

<?php } } ?>