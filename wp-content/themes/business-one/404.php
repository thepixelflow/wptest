<?php get_header(); ?>


<?php get_header('blog'); ?>


<section class="blog-container" role="main">
		
		<div class="container">

			<div class="broken-page col-sm-9">
				
				<h2><i class="fa fa-chain-broken"></i>&nbsp;404</h2>

				<p><?php _e('Go to','business-one'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Homepage','business-one'); ?></a></p>

			</div> <!-- end col-sm-9 -->

		</div> <!-- end container -->

</section> <!-- end blog-container -->



<?php get_footer('home'); ?>

<?php get_footer(); ?>