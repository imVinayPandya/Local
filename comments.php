<?php 
	if ( post_password_required() )
		return;
?>


<div class="panel panel-default">

		<div class="panel-body">
				<legend>
					<?php
						printf( _n( 'One Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'local' ),
							number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
					?>
				</legend>

				<?php
				/* If there are no comments and comments are closed, let's leave a note.
				 * But we only want the note on posts and pages that had comments in the first place.
				 */
				if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="nocomments"><?php _e( 'Comments are closed.' , 'local' ); ?></p>
				<?php endif; ?>


				<?php 

				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );

				$args = array(
				  'id_form'           => 'commentform',
				  'id_submit'         => 'submit',
				  'class_submit'      => 'btn btn-primary',
				  'name_submit'       => 'submit',
				  'title_reply'       => __( 'Leave a Reply', 'local' ),
				  'title_reply_to'    => __( 'Leave a Reply to %s', 'local' ),
				  'cancel_reply_link' => __( 'Cancel Reply', 'local' ),
				  'label_submit'      => __( 'Post Comment', 'local' ),
				  'format'            => 'xhtml',

				  'comment_field' =>
				    '<div class="form-group">
						<label for="comment">'. __( 'Comment', 'noun' ).'</label>
						<textarea id="comment" name="comment" class="form-control" cols="10" rows="5" aria-required="true"></textarea>
					 </div>',

				  'must_log_in' => '<p class="must-log-in">' .
				    sprintf(
				      __( 'You must be <a href="%s">logged in</a> to post a comment.', 'local' ),
				      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
				    ) . '</p>',

				  'logged_in_as' => '<p class="logged-in-as">' .
				    sprintf(
				    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'local' ),
				      admin_url( 'profile.php' ),
				      $user_identity,
				      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
				    ) . '</p>',

				  'comment_notes_before' => '<p class="comment-notes">' .
				    __( 'Your email address will not be published.', 'local' ) . ( $req ? '<span class="required">*</span>' : '' ) .
				    '</p>',

				  'comment_notes_after' => '<p class="form-allowed-tags">' .
				    sprintf(
				      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'local' ),
				      ' <code>' . allowed_tags() . '</code>'
				    ) . '</p>',



				    $fields =  array(
				    		 'author' => '<div class="form-group">
									<label for="author">' . __( 'Name', 'local' ) . '</label> ' .
							    ( $req ? '<span class="required">*</span>' : '' ) .'
									<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							    '" size="30"' . $aria_req . ' class="form-control" placeholder="Enter Your Name">
								</div>',

							  'email' => '<div class="form-group">
							    <label for="email">' . __( 'Email', 'local' ) . '</label> ' .
							    ( $req ? '<span class="required">*</span>' : '' ) .
							    '<input id="email" name="email" type="text" class="form-control" placeholder="Enter Email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
							    '" size="30"' . $aria_req . ' />
							    </div>',

							  'url' =>'<div class="form-group">
							   	<label for="url">' . __( 'Website', 'local' ) . '</label>' .
							    '<input id="url" class="form-control" placeholder="Enter Url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
							    '" size="30" />
							    </div>',

					),

				  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
				);

				comment_form( $args);

				 ?>
		</div>

</div><!-- comment form -->

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
<nav id="comment-nav-below" class="navigation" role="navigation">
	<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'local' ); ?></h1>
	<div class="nav-previous pull-right"><?php previous_comments_link( __( '&larr; Older Comments', 'local' ) ); ?></div>
	<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'local' ) ); ?></div>
</nav>
<?php endif; // check for comment navigation ?>


<div class="comments">
	<ul class="media-list">
		<?php wp_list_comments( array( 'callback' => 'local_comment', 'style' => 'ul' ) ); ?>
	</ul><!-- .commentlist -->
</div><!-- comments  -->