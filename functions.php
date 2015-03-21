<?php
	global $local_wp;

	include(TEMPLATEPATH.'/admin/admin-init.php');
	require_once('wp_bootstrap_navwalker.php');

	
	//add theme supports
	add_theme_support( 'menus' );
	add_theme_support( 'custom-background' );
	//add_theme_support( 'custom-header' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "post-thumbnails" );

	//register theme menu_order
	function local_menus(){
		register_nav_menus(
			array(
					'primary-menu' => __('Primary Menu', 'local')
			)
		);
	}
	add_action( 'init', 'local_menus' );

	function local_register_sidebars() {
		//add sidebar
		$args = array(
			'name'          => __( 'Blog', 'lacal' ),
			'id'            => 'blog-sidebar',
			'description'   => __( 'The widgets you put here, it will display on blog and home page sidebar', 'local'),
			'class'         => '',
			'before_widget' => '<div class="panel panel-default"> ',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="panel-heading">',
			'after_title'   => '</div> <div class="panel-body">'
		);
		register_sidebar( $args );	

		//add sidebar for pages
		$args = array(
			'name'          => __( 'Page', 'lacal' ),
			'id'            => 'page-sidebar',
			'description'   => __( 'The widgets you put here, it will display on page sidebar', 'local'),
			'class'         => '',
			'before_widget' => '<div class="panel panel-default"> ',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="panel-heading">',
			'after_title'   => '</div> <div class="panel-body">'
		);
		register_sidebar( $args );	

		//add sidebar for pages
		$args = array(
			'name'          => __( 'Footer %d', 'lacal' ),
			'id'            => 'footer-%d',
			'description'   => __( 'The widgets you put here, it will display in footer %d', 'local'),
			'class'         => '',
			'before_widget' => '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> ',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="heading">',
			'after_title'   => '</h3>'
		);
		register_sidebars(4, $args );
	}
	add_action( 'widgets_init', 'local_register_sidebars' );


	//load css
	function local_styles() {		
		wp_enqueue_style( 'custom_css', get_template_directory_uri() . "/css/custom.css" );
		wp_enqueue_style( 'style_css', get_template_directory_uri() . "/style.css" );
	}
	add_action( 'wp_enqueue_scripts', 'local_styles' );

	//load javascript
	function local_scripts() {
		wp_enqueue_script( 'respond_js', get_template_directory_uri(). '/respond.js','' , '', false);
		wp_enqueue_script( 'bootstrap_js', get_template_directory_uri(). '/js/bootstrap.min.js',array('jquery') , '', true);
		wp_enqueue_script( 'custom_js', get_template_directory_uri(). '/js/custom.js',array('jquery', 'bootstrap_js') , '', true);
		if ( is_singular() )
			 wp_enqueue_script( "comment-reply" );
	}
	add_action( 'wp_enqueue_scripts', 'local_scripts' );


	//pag nav for home
	function paging_nav() {
		global $wp_query;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 )
			return;
		?>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'local' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'local' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		<?php
	}

	//post page navigation
	function local_post_nav() {
		global $post;

		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'local' ); ?></h1>
			<div class="nav-links">
				<div class="alignleft">
					<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'local' ) ); ?>
				</div>
				<div class="alignright">
					<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'local' ) ); ?>
				</div>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}


	//comment list
	function local_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li class="media" <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'local' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'local' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>


		<li class="media" id="li-comment-<?php comment_ID(); ?>">
			<div class="media-left">
		        <?php echo get_avatar( $comment, 44 );?>
		    </div>

			<div class="media-body">
				<div class="media-heading">
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( '  Your comment is awaiting moderation.  ', 'local' ); ?></p>
					<?php endif; ?>

					<?php
						printf( '<b class="fn">%1$s</b> %2$s',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( '  Post author  ', 'local' ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '  %1$s at %2$s ', 'local' ), get_comment_date(), get_comment_time() )
						);
					?>


					<?php edit_comment_link( __( ' Edit  ', 'local' ) ); ?>

					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '  Reply  ', 'local' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
				<?php comment_text(); ?>

			</div><!-- .comment-content -->
		</li>

		<?php
			break;
		endswitch; // end comment_type check
	}	

	//breadcrob
	function local_breadcrumbs() {
	 
	        global $post;
	 
	        if (!is_home() || is_home() ) {
	 
	            echo "<a href='";
	            echo esc_url( home_url() );
	            echo "'>";
	            echo "HOME";
	            echo "</a>";
	 
	            if (is_category() || is_single()) {
	 
	                
	                $cats = get_the_category( $post->ID );
	 
	                foreach ( $cats as $cat ){
	                    echo " > ";
	                    echo $cat->cat_name;
	                    
	                }
	                if (is_single()) {
	                	echo " > ";
	                    the_title();
	                }
	            } if (is_page()) {
	 
	                if($post->post_parent){
	                    $anc = get_post_ancestors( $post->ID );
	                    $anc_link = get_page_link( $post->post_parent );
	 
	                    foreach ( $anc as $ancestor ) {
	                        $output = " > <a href=".$anc_link.">".get_the_title($ancestor)."</a> > ";
	                    }
	 
	                    echo $output;
	                    the_title();
	 
	                } else {
	                    echo ' > ';
	                    echo the_title();
	                }
	            }
	        }
	    if (is_tag()) {echo" > "; single_tag_title();}
	    if (is_day()) {echo" > Archive > Days > "; the_time('F jS, Y'); echo'</li>';}
	    if (is_month()) {echo" > Archive > Months > "; the_time('F, Y'); echo'</li>';}
	    if (is_year()) {echo" > Archive > Years > "; the_time('Y'); echo'</li>';}
	    if (is_author()) { echo " > Author > "; the_author(); echo'</li>';}
	    if (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blogarchive: "; echo'';}
	    if (is_search()) {echo" > Search results: "; }
	}

	//just putting cnotent_width variable
	if ( ! isset( $content_width ) ) {
		$content_width = 600;
	}

?>