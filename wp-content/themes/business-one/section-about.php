<?php global $business; ?>

<!-- ABOUT -->

<?php if(have_posts()): ?>


	<?php if(get_posts(array('post_type' => 'about')) || get_posts(array('post_type' => 'skill'))){ ?>

	<section class="section-about col-sm-12" id="about">

			<div class="container">
				
				<header class="heading-wrap">
				
					<h2 class="section-head"><?php _e('about','business-one'); ?></h2> <!-- end section-head -->

					<?php if(isset($business['about-text'])){

					if($business['about-text']){ ?>

						<div class="heading-line"></div>

						<p class="heading-desc"><?php echo $business['about-text']; ?></p>

					<?php } } ?>

				</header> <!-- end heading-wrap -->



				<?php if(get_posts(array('post_type' => 'about'))){ ?>

					<div class="job-wrap">

					<?php query_posts('post_type=about'); ?>

					<?php while(have_posts()):the_post(); ?>

						<?php if(get_field('job_describe_one')){ ?>

							<div class="h-resume col-sm-6 col-md-3">
					
								<h3 class="p-experience"><?php the_title(); ?></h3>

								<div class="p-desc">
									<?php the_field('job_describe_one'); ?>
								</div> <!-- end p-desc -->
							
							</div> <!-- end h-resume -->

						<?php } ?>

					<?php endwhile; ?>

					<?php wp_reset_query(); ?>

					</div> <!-- end job-wrap -->

				<?php } ?>



				<?php if(get_posts(array('post_type' => 'skill'))){ ?>

				<div class="skill-wrap col-sm-6">

						<h4><?php _e('Skills','business-one'); ?></h4>

						<?php query_posts('post_type=skill'); ?>

						<?php while(have_posts()):the_post(); ?>

						<?php if(get_field('progress_bar_rate_1')){ ?>	

							<span class="progress-title"><?php the_title(); ?></span>
							<div class="progress">
							  <div class="progress-bar" role="progressbar" aria-valuenow="<?php the_field('progress_bar_rate_1'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							    <?php the_field('progress_bar_rate_1'); ?>%
							  </div>
							</div>

						<?php } ?>

						<?php endwhile; ?>

						<?php wp_reset_query(); ?>

				</div> <!-- end skill-wrap -->
				
				<?php } ?>					

					<?php if(isset($business['about-textarea'])){ ?>

						<?php if($business['about-textarea']){ ?>

						<div class="history-wrap col-sm-6">

							<h4><?php _e('History','business-one'); ?></h4>
							
							<p><?php echo $business['about-textarea']; ?></p>

						</div> <!-- end history-wrap -->

					<?php } } ?>
			

			</div> <!-- end container -->

			
	</section>

	<?php } ?>


<?php endif; ?>

<!-- END ABOUT -->
