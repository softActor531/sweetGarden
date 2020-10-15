<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number()) { ?>

	<div class="eltdf-comment-holder clearfix <?php if(get_comments_number() == 0){echo "eltdf-comment-holder-no-comments";} ?>" id="comments">
		<div class="eltdf-comment-holder-inner">
			<div class="eltdf-comments-title">
				<h2><span class="eltdf-comments-number"> <?php comments_number(); ?> </span></h2>
			</div>
			<div class="eltdf-comments">
				<?php if ( have_comments() ) { ?>
					<ul class="eltdf-comment-list">
						<?php wp_list_comments(array( 'callback' => 'satine_elated_comment')); ?>
					</ul>
				<?php } ?>
				<?php if( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' )) { ?>
					<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'satine'); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
		$eltdf_commenter = wp_get_current_commenter();
		$eltdf_req = get_option( 'require_name_email' );
		$eltdf_aria_req = ( $eltdf_req ? " aria-required='true'" : '' );

		$eltdf_args = array(
			'id_form' => 'commentform',
			'id_submit' => 'submit_comment',
			'title_reply'=> esc_html__( 'LEAVE A COMMENT','satine' ),
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after' => '</h2>',
			'title_reply_to' => esc_html__( 'Post a Reply to %s','satine' ),
			'cancel_reply_link' => esc_html__( 'cancel reply','satine' ),
			'label_submit' => esc_html__( 'POST COMMENT','satine' ),
			'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Write a comment...','satine' ).'" name="comment" cols="45" rows="6" aria-required="true"></textarea>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<input id="author" name="author" placeholder="'. esc_html__( 'Full Name*','satine' ) .'" type="text" value="' . esc_attr( $eltdf_commenter['comment_author'] ) . '"' . $eltdf_aria_req . ' />',
				'email' => '<input id="email" name="email" placeholder="'. esc_html__( 'Email Address*','satine' ) .'" type="text" value="' . esc_attr(  $eltdf_commenter['comment_author_email'] ) . '"' . $eltdf_aria_req . ' />',
				'website' => '<input id="url" name="url" placeholder="'. esc_html__( 'Website','satine' ) .'" type="text" value="' . esc_attr(  $eltdf_commenter['comment_author_url'] ) . '"' . $eltdf_aria_req . ' />'
				 ) ) );
	 ?>
	<?php if(get_comment_pages_count() > 1){ ?>
		<div class="eltdf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>
	<div class="eltdf-comment-form">
		<div class="eltdf-comment-form-inner">
			<?php comment_form($eltdf_args); ?>
		</div>
	</div>
<?php } ?>
