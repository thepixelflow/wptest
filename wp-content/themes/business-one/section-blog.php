<?php if(get_posts(array('post_type' => 'post'))){ ?>

<!-- BLOG -->
		<section class="section-blog clearfix" id="blog">


			<header class="heading-wrap">
				
				<h2 class="section-head"><?php _e('blog','business-one'); ?></h2> <!-- end section-head -->

			</header> <!-- end heading-wrap -->

			<?php 

				$home_post=get_posts(array(
					'post_type' => 'post',
					'posts_per_page' => 8
					));

			 ?>


			<div class="blog-wrap clearfix">

				<?php foreach($home_post as $post){ ?>

					<?php setup_postdata( $post ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry col-sm-4 col-md-3'); ?>>
						
						<figure>
							
							<a href="<?php the_permalink(); ?>" class="u-url">
								<?php the_post_thumbnail(); ?>	
							</a>

						</figure>


						<h4 class="entry-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h4>

					</article> <!-- end h-entry -->	

				<?php } ?>

				<?php wp_reset_postdata(); ?>

			</div> <!-- end blog-wrap -->
			


		</section>
		<!-- END BLOG -->

<?php } ?>