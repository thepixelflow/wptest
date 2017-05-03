<?php if(have_posts()): ?>

<?php if(get_posts(array('post_type' => 'team'))){ ?>

<!-- TEAM -->
	<section class="section-team clearfix" id="team">			

			<header class="heading-wrap">
				
				<h2 class="section-head"><?php _e('team','business-one'); ?></h2> <!-- end section-head -->

				

			</header> <!-- end heading-wrap -->


			<div class="container">
				
				<div class="team-wrap">

				<?php query_posts('post_type=team'); ?>

				<?php while(have_posts()):the_post(); ?>

					<div class="h-card col-sm-6 col-md-3">
		
						<div class="team-overlay">

						<?php if(get_field('team_image')){ ?>

							<?php $team_image=get_field('team_image'); ?>

							<img src="<?php echo $team_image['url']; ?>" class="u-photo" alt="<?php _e('Team Image','business-one'); ?>">

						<?php } ?>

						</div> <!-- end team-overlay -->

						<div class="team-social">
							
							<ul>

							<?php if(get_field('facebook_link')){ ?>

								<li><a href="<?php echo esc_url(get_field('facebook_link')); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							
							<?php } ?>

							<?php if(get_field('twitter_link')){ ?>

								<li><a href="<?php echo esc_url(get_field('twitter_link')); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							
							<?php } ?>

							<?php if(get_field('linkedin_link')){ ?>

								<li><a href="<?php echo esc_url(get_field('linkedin_link')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>

							<?php } ?>

							</ul>

						</div> <!-- end team-social -->

						<div class="team-desc">

						<?php if(get_field('team_name')){ ?>
							
							<h5 class="p-name"><?php the_field('team_name'); ?></h5>

						<?php } ?>

						<?php if(get_field('profession')){ ?>

							<span class="p-job-title"><?php the_field('profession'); ?></span>

						<?php } ?>

						</div> <!-- end team-desc -->
						
					</div> <!-- end h-card -->

				<?php endwhile; ?>

				<?php wp_reset_query(); ?>		

				</div> <!-- end team-wrap -->

			</div> <!-- end container -->			

	</section> 
<!-- END TEAM -->

<?php } ?>

<?php endif; ?>