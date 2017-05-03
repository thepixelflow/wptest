<?php global $business; 

if(have_posts()):

if(get_posts(array('post_type' => 'portfolio'))){ ?>

<!-- PORTFOLIO -->
		<section class="section-portfolio clearfix" id="portfolio">
			
			<header class="heading-wrap">
				
				<h2 class="section-head"><?php _e('portfolio','business-one'); ?></h2> <!-- end section-head -->

				<?php if(isset($business['portfolio-text'])){ 

				if($business['portfolio-text']){ ?>

					<div class="heading-line"></div>

					<p class="heading-desc"><?php echo $business['portfolio-text']; ?></p>

				<?php } } ?>

			</header> <!-- end heading-wrap -->


			<div class="portfolioContainer clearfix">

			<?php query_posts('post_type=portfolio'); ?>

			<?php while(have_posts()):the_post(); ?>				

				<div class="h-product col-sm-6 col-md-4 col-lg-3">
					
					<a href="<?php the_permalink(); ?>" class="u-url">
						<?php the_post_thumbnail(); ?>
					</a>

					<h4 class="p-name"><?php the_title(); ?></h4>
				</div>

				<?php endwhile; ?>

				<?php wp_reset_query(); ?>				
				
			</div>

		</section>
		<!-- END PORTFOLIO -->

<?php } ?>

<?php endif; ?>