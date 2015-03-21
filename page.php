<?php get_header(); ?>

		<!-- main container -->
		<div class="container">
			
			<?php get_template_part( 'breadcrumb' ); ?>

			<div class="raw">
				<div  id="page-<?php the_ID(); ?>" <?php post_class( "col-lg-8 col-md-8 col-xs-12" );?> >

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>			
					
					<div class="panel panel-default">
						<div class="panel-body">
					  		<h1><?php the_title(); ?></h1>
					  		<small>Posted on <em><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?php the_date( 'd j, Y' ); echo " ";  the_time(); ?></em></small>
					  		
					  		<small>, By <?php the_author_posts_link(); ?></small>
					  		<hr>
					    	<?php the_content();?>
					 	</div>
					</div>

					<?php echo comments_template(); ?>

					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no page found.', 'local'); ?></p>
					<?php endif;?>


				</div>
			</div><!-- main area -->

			<?php get_sidebar('Page'); ?>

		</div><!-- main container -->

<?php get_footer( ); ?>