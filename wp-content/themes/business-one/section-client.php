<?php if(have_posts()): ?>


<?php if(get_posts(array('post_type' => 'clients'))){ ?>
<!-- CLIENT -->
		<section class="section-client" id="client">

			<div class="container">
				
				<h2 class="section-head"><?php _e('clients','business-one'); ?></h2>

				<div class="slider autoplay">

					<?php query_posts('post_type=clients'); ?>

						<?php while(have_posts()):the_post(); ?>

						<div>

							<?php $client_image=get_field('client_image'); ?>

							<img src="<?php echo $client_image['url']; ?>" class="u-photo" alt="<?php _e('Client Image','business-one'); ?>">

						</div>

						<?php endwhile; ?>

					<?php wp_reset_query(); ?>
									
				</div>				

			</div> <!-- end container -->
			
		</section>
		<!-- END CLIENT -->

<?php } ?>

<?php endif; ?>