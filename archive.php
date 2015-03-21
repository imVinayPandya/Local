<?php get_header(); ?>

		<!-- main container -->
		<div class="container">

			<?php get_template_part( 'breadcrumb' ); ?>

			<div class="raw">
				<h1 ><?php wp_title( '-', true, 'right' ); ?> Blog Post</h1>
			</div><!-- breadcrum -->

			<div class="raw">
				<div class="col-lg-8 col-md-8 col-xs-12">

					

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>			
					
					<div class="panel panel-default">
						<div class="panel-body">
					  		<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
					  		
					  		<hr>
					    	<?php the_excerpt(); ?>
					    	<a href="<?php the_permalink(); ?>" class="btn btn-primary pull-right">More</a>
					 	</div>
					</div>

					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts found.', 'local'); ?></p>
					<?php endif;?>


				</div>
			</div><!-- main area -->

			<?php get_sidebar(); ?>

		</div><!-- main container -->

<?php get_footer( ); ?>