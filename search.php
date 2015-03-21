<?php get_header(); ?>

		<!-- main container -->
		<div class="container">
			
			<?php get_template_part( 'breadcrumb' ); ?>

			<div class="raw">
				<div class="col-lg-8 col-md-8 col-xs-12" >					
					<div class="panel panel-default">
						<div class="panel-body">

						<?php if( have_posts() ) : ?>
					  		<h1><?php printf( __( 'Search Results for: %s ', 'local' ), get_search_query() ); ?></h1>
					  		
					  		<?php /* The loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<a href="<?php the_permalink(); ?>">
									<h1><?php the_title(); ?></h1>
								</a>
								<p><?php the_excerpt(); ?></p>
								<hr />
							<?php endwhile; ?>

						<?php else: ?>
							<p><?php _e('Sorry, search content not found, Try another term.', 'local'); ?></p>
						<?php endif;?>
					 	</div>
					</div>

					<?php paging_nav(); ?>

				</div>
			</div><!-- main area -->

			<?php get_sidebar('Page'); ?>

		</div><!-- main container -->

<?php get_footer( ); ?>