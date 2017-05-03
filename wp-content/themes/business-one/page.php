<?php get_header(); ?>


<?php get_header('blog'); ?>


<section class="blog-container" role="main">
		
		<div class="container">		

			<?php if(is_active_sidebar('sidebar')){ ?>
			
			<div class="col-sm-8">

			<?php }else{ ?>

			<div class="col-sm-9">

			<?php } ?>

				<?php while(have_posts()):the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry'); ?>>					
				

						<h3 class="p-name">
							<?php the_title(); ?>
						</h3>

						<div class="article-meta">

							<?php if(comments_open()) { ?>
								<span class="comment">
									<i class="fa fa-comment"></i> <span><?php comments_number(__('No Comments', 'business-one'),__('1 Comment', 'business-one'),__('% Comments', 'business-one')); ?></span>
								</span> 
							<?php } ?>

							<span class="edit">
								<?php edit_post_link(__('Edit','business-one')); ?>
							</span>

						</div> <!-- end article-meta -->

						<div class="e-content">
							 <?php the_content(); ?>
						</div> <!-- end p-summary -->					

					</article>

					<?php comments_template(); ?>

				<?php endwhile; ?>								

			</div>			


			<?php get_sidebar(); ?>

		</div> <!-- end container -->

</section> <!-- end blog-container -->



<?php get_footer('home'); ?>

<?php get_footer(); ?>