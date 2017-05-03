

<?php if(have_posts()): ?>


<?php if(get_posts(array('post_type' => 'services'))){ ?>

<!-- SERVICE -->
<section class="section-service" id="service">

			
			<div class="container">
				
				<header class="heading-wrap">
				
					<h2 class="section-head"><?php _e('Services','business-one'); ?></h2> <!-- end section-head -->

					
				</header> <!-- end heading-wrap -->

				<?php if(get_posts(array('post_type' => 'services'))){ ?>

				<div class="service-wrap clearfix">	

					<?php query_posts('post_type=services'); ?>

					<?php while(have_posts()):the_post(); ?>	

						<?php if(get_field('image_1')){ ?>			

							<div class="service-context col-sm-6 col-md-3">
								
								<div class="service-icon">
									<?php $image_1=get_field('image_1'); ?>
									<img src="<?php echo $image_1['url']; ?>" alt="<?php _e('Service Image','business-one'); ?>">
								</div> <!-- end service-icon -->

								<h3 class="service-head"><?php the_title(); ?></h3> <!-- end service head -->

								<p class="desc"><?php the_field('description_1'); ?></p>

								<a href="<?php echo esc_url(get_field('link_1')); ?>" class="u-url btn btn-default" target="_blank"><?php _e('read more','business-one'); ?></a>

							</div> <!-- end service-context -->

						<?php } ?>

					<?php endwhile; ?>

					<?php wp_reset_query(); ?>

				</div> <!-- end service-wrap -->

				<?php } ?>

				<?php global $business; ?>

				<?php if(isset($business['extra-img']['url'])){ ?>

					<div class="extra-service-wrap">

						<?php if($business['extra-img']['url']){ ?>					
						
							<img src="<?php echo $business['extra-img']['url']; ?>" class="u-photo" alt="<?php _e('Service Image','business-one'); ?>">

						<?php } ?>

						<?php if($business['extra-text']){ ?>	

							<h4 class="extra-head"><?php echo $business['extra-text']; ?></h4>

						<?php } ?>

						<?php if($business['extra-textarea']){ ?>

							<p class="heading-desc"><?php echo $business['extra-textarea']; ?></p>

						<?php } ?>

						<?php if($business['extra-textarea']){ ?>						

							<a href="<?php echo $business['extra-url']; ?>" class="u-url btn btn-primary" target="_blank"><?php _e('get in touch','business-one'); ?></a>

						<?php } ?>

					</div> <!-- end extra-service-wrap -->

				<?php } ?>

			</div> <!-- end container -->


</section>
<!-- END SERVICE -->

<?php } ?>



<?php endif; ?>

