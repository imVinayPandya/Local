<?php get_header(); ?>

		<!-- main container -->
		<div class="container main-container">

			<?php get_template_part( 'breadcrumb' ); ?>

			<div class="raw">
				<div  id="post-<?php the_ID(); ?>" <?php post_class( "col-lg-8 col-md-8 col-xs-12" );?> >

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>			
					
					<div class="panel panel-default">
						<div class="panel-body">
					  		<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
					  		
					  		<hr>
					  		<?php if( has_post_thumbnail() ) : ?>
					  			<div class="alignleft img-rounded img-responsive" style="margin: 0 25px 10px 0;" />
					  				<?php the_post_thumbnail('medium'); ?>
					  			</div>
					    	<?php endif; ?>
					    	<?php the_content(); ?>

					    	<a href="<?php the_permalink(); ?>" class="btn btn-primary pull-right">More</a>
					 	</div>
					</div>

					<?php endwhile; else: ?>
						<p><?php _e('Sorry, nothing found.', 'local'); ?></p>
					<?php endif;?>


				</div>
			</div><!-- main area -->

			<?php get_sidebar(); ?>

		</div><!-- main container -->

<?php get_footer( ); ?>