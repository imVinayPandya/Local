<?php global $local_wp; ?>
<!DOCTYPE html>
<html <?php language_attributes() ;?>>
	<head>
		<meta charset="utf=8"></meta>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"></meat>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="icon" type="image/png" href="<?php echo $local_wp['favicon']{'url'}; ?>" />
		<?php
		 if( isset($local_wp['color_scheme']) && ! is_admin() ) {
			wp_enqueue_style( 'color_scheme', get_template_directory_uri() .'/css/scheme/'. $local_wp['color_scheme'] );
		}else{
			wp_enqueue_style( 'flatly_css', get_template_directory_uri() . '/css/scheme/boot.css' );	
		} ?>
		<?php wp_head(); ?>

				<style type="text/css">
			<?php 
				echo $local_wp['custom-css'];
			 ?>
		 </style>
	</head>
	<body <?php body_class(); ?>>
	
		<nav class="navbar navbar-inverse">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		        <?php 
		        	       /**
		        	    	* Displays a Primary Left menu
		        	    	* @param array $args Arguments
		        	    	*/
		        	    	$args1 = array(
		        	    		'theme_location' => 'primary-menu',
		        	    		'container' => false,
		        	    		'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
		        	    		'depth' => 2,
								'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
		        	    		'walker' => new wp_bootstrap_navwalker()
		        	    	);
		        	    
		        	    	wp_nav_menu( $args1 );
				?>

		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>