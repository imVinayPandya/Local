<?php get_header(); ?>
<?php global $local_wp; ?>

		<!-- main container -->
		<div class="container">
			<div class="raw jumbotron container-fluid">
					<div class="pull-right">
						<img src="<?php echo $local_wp['welcome-ads-banner']{'url'}; ?>" class="img-responsive img-rounded" alt="Responsive image">
					</div>
					<h1><?php echo $local_wp['welcome-text']; ?></h1>
					<p><?php echo $local_wp['welcome-description']; ?></p>
					
			</div><!-- Welcome are -->

			<?php get_template_part( 'breadcrumb' ); ?>

			<div class="raw">
				<div  id="post-<?php the_ID(); ?>" <?php post_class( "col-lg-8 col-md-8 col-xs-12" );?> >

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>			
					
					<div class="panel panel-default">
						<div class="panel-body">
					  		<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
					  		
					  		<hr>
					  		<?php if( has_post_thumbnail() ) : ?>
					  			<div class="alignleft img-rounded img-responsive" style="margin-right: 10px;">
					  				<?php the_post_thumbnail('thumbnail'); ?>
					  			</div>
					    	<?php endif; ?>
					    	<?php the_excerpt(); ?>
					    	<a href="<?php the_permalink(); ?>" class="btn btn-primary pull-right">More</a>
					 	</div>
					</div>

					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts found.', 'local'); ?></p>
					<?php endif;?>

					<?php paging_nav(); ?>


				</div>
			</div><!-- main area -->

			<?php get_sidebar(); ?>

		</div><!-- main container -->

<?php get_footer( ); ?>