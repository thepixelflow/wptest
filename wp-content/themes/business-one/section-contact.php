<?php /* Template Name: Contact */ 


if(is_front_page()){

	get_header();

}else{

	get_header();

	get_header('blog'); ?>

	
	<style>

		.section-contact{
			padding-top: 5em;
		}

	</style>


<?php }



$homepage=get_posts(array(
	'post_type' => 'page',
	'posts_per_page' => 20
));

foreach($homepage as $post){ 

$contact=get_post_meta($post->ID,'_wp_page_template',true);


if($contact=='section-contact.php'){ ?>

<!-- CONTACT -->
<section class="section-contact" id="contact">

	<header class="heading-wrap">
				
		<h2 class="section-head"><?php _e('contact','business-one'); ?></h2> <!-- end section-head -->		

	</header> <!-- end heading-wrap -->
	

	<div class="google-map">					
					
	 	<?php echo do_shortcode(get_field('google_map')); ?>

	</div> <!-- end google-map -->



		<div class="container">
					
					<div class="contact-way col-sm-8 col-sm-offset-2">

						<?php setup_postdata($post); ?>
						<div class="form-wrap col-sm-6">						
							
							<?php the_content(); ?>							
						
						</div> <!-- end form-wrap -->


						<div class="contact-wrap col-sm-5 pull-right">
								
							<address class="h-adr">

								<?php if(get_field('company_name')){ ?>
									<h4 class="company-name"><?php the_field('company_name'); ?></h4>
								<?php } ?>			

								<?php if(get_field('address')){ ?>
									<span class="p-street-address"><?php the_field('address'); ?></span>
								<?php } ?>

								<div>
									<?php if(get_field('city')){ ?>
										<span class="p-locality"><?php the_field('city'); ?></span>
									<?php } ?>

									<?php if(get_field('country')){ ?>
										<span class="p-country-name"> , <strong><?php the_field('country'); ?></strong></span>
									<?php } ?>
								</div>

								<?php if(get_field('postal_code')){ ?>								
									<span class="p-postal-code"><strong><?php _e('Postal Code','business-one'); ?> : </strong><?php the_field('postal_code'); ?></span>
								<?php } ?>

								<div class="tel-wrap">
									
									<?php if(get_field('phone_number')){ ?>
										<span><strong><?php _e('Phone','business-one'); ?></strong> : <?php the_field('phone_number'); ?></span>
									<?php } ?>

									<?php if(get_field('fax')){ ?>
										<span><strong><?php _e('Fax','business-one'); ?></strong> : <?php the_field('fax'); ?></span>
									<?php } ?>								

								</div> <!-- end tel-wrap -->


								

							</address> <!-- end h-adr -->	


							<ul class="social-list">
									
									<?php if(get_field('facebook')){ ?>
										<li><a href="<?php echo esc_url(get_field('facebook')); ?>" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
									<?php } ?>

									<?php if(get_field('twitter')){ ?>
										<li><a href="<?php echo esc_url(get_field('twitter')); ?>" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
									<?php } ?>
	
									<?php if(get_field('wordpress')){ ?>									
										<li><a href="<?php echo esc_url(get_field('wordpress')); ?>" title="WordPress.org" target="_blank"><i class="fa fa-wordpress"></i></a></li>
									<?php } ?>

									<?php if(get_field('behance')){ ?>
										<li><a href="<?php echo esc_url(get_field('behance')); ?>" title="Behance" target="_blank"><i class="fa fa-behance"></i></a></li>
									<?php } ?>
									
									<?php if(get_field('linkedin')){ ?>
										<li><a href="<?php echo esc_url(get_field('linkedin')); ?>" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
									<?php } ?>
	
									<?php if(get_field('digg')){ ?>									
										<li><a href="<?php echo esc_url(get_field('digg')); ?>" title="Digg" target="_blank"><i class="fa fa-digg"></i></a></li>							
									<?php } ?>

							</ul>
							
						</div> <!-- end contact-wrap -->

						<?php wp_reset_postdata(); ?>


					</div> <!-- end contact-way -->

		</div> <!-- end container -->		

		


</section>
<!-- END CONTACT -->

<?php } }

if(is_front_page()){

	get_footer();

}else{

	get_footer('home');

	get_footer();

}