<?php global $business; ?>

<!-- FOOTER -->
		<footer class="bottom-footer clearfix" role="contentinfo">
			
			
			<div class="container">
				
				<div class="col-sm-5">

					<?php if(isset($business['credit'])){ ?>
					
					<?php if($business['credit']==true){ ?>

					<div class="site-generator">
					
						<span><?php _e('Theme by','business-one'); ?> <a href="<?php echo esc_url("http://burak-aydin.com"); ?>" target="_blank" rel="generator">Burak Aydin</a></span>
						<span class="sep">|</span>
						<span><?php _e('Powered by','business-one'); ?> <a href="<?php echo esc_url("http://wordpress.org"); ?>" target="_blank" rel="generator">WordPress</a></span>

					</div> <!-- end site-generator -->				

					<?php } } ?>

					<?php if(isset($business['opt-editor'])){ ?>

					<div class="div-copyright">

						<?php echo $business['opt-editor']; ?>

					</div> <!-- end div-copyright -->

					<?php } ?>				

					

				</div> <!-- end col-sm-5 -->


				<div class="col-sm-2">
					
					<figure>

						<?php business_one_logo(); ?>					

					</figure> <!-- end logo -->	

				</div> <!-- end col-sm-2 -->					


				<?php wp_nav_menu(array(
					'theme_location' => 'footer-menu',
					'menu_class' => 'nav',
					'container' => 'nav',
					'container_class' => 'col-sm-5',
					'depth' => 1,
					'fallback_cb' => 'business_one_footerfb'
				)); ?>	


			</div> <!-- end container -->
			

		</footer>
		<!-- END FOOTER -->