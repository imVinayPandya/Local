<?php get_header(); ?>

		<!-- main container -->
		<div class="container">
			
			<?php get_template_part( 'breadcrumb' ); ?>

			<div class="raw">
				<div  id="post-<?php the_ID(); ?>" <?php post_class( "col-lg-8 col-md-8 col-xs-12" );?> >

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>			
					
					<div class="panel panel-default">
						<div class="panel-body">
					  		<h1><?php the_title(); ?></h1>
					  		<small>Posted on <em><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?php the_date( 'd j, Y' ); echo " ";  the_time(); ?></em></small>
					  		
					  		<small> in <?php the_category( ', ' ); ?> </small>
					  		<small>, By <?php the_author_posts_link(); ?></small>
					  		<hr>
					  		<?php if( has_post_thumbnail() ) : ?>
					  			<div class="alignleft img-rounded img-responsive" style="margin: 0 25px 10px 0;" />
					  				<?php the_post_thumbnail('medium'); ?>
					  			</div>
					    	<?php endif; ?>
					    	<?php the_content();?>
					    	<?php wp_link_pages(); ?>
					    	<hr>
					    	<small> <?php the_tags( 'Tags: ', ', ', ' ' ); ?> </small>
					    	<small><?php edit_post_link( __( 'Edit Post', 'local' ), '<span class="alignright">', '</span>' ); ?></small>
					    	<hr />
					    	<?php local_post_nav(); ?>


					 	</div>
					</div>

					<?php echo comments_template(); ?>

					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts found.', 'local'); ?></p>
					<?php endif;?>


				</div>
			</div><!-- main area -->

			<?php get_sidebar(); ?>

		</div><!-- main container -->

<?php get_footer( ); ?>