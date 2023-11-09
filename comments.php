<?php
$mts_options = get_option(MTS_THEME_NAME);
/**
 * The template for displaying the comments.
 *
 * This contains both the comments and the comment form.
 */

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ( __('Please do not load this page directly. Thanks!', 'crypto' ) );
 
if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'crypto' ); ?></p>
<?php
return;
}
?>
<!-- You can start editing here. -->
<?php if ( comments_open() ) : ?>
	<div id="comments">
		<h4 class="comments-heading"><?php comments_number(__('Comments (No)', 'crypto' ), __('Comment (1)', 'crypto' ),  __('Comments (%)', 'crypto' ) );?></h4>
		<?php if($mts_options['mts_facebook_comments'] == 1) { ?>
			<div class="facebook-comments">
				<?php if ( post_password_required() ) : ?>
			    	    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'crypto' ); ?></p>
			        </div>
			        <?php return; ?>
			    <?php endif; ?>
			 
			    <?php if ( comments_open() ) : ?>
			        <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-colorscheme="light" data-width="100%"></div>
			    <?php endif; ?>

			    <?php if ( ! comments_open() ) : ?>
					<p class="nocomments"></p>
			    <?php endif; ?>
		    </div>
	    <?php } ?>
	    <?php if ( get_comments_number() > 0 ) : ?>
		    <div class="commentlist-wrap">
				<ol class="commentlist">
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
						<div class="navigation">
							<div class="alignleft"><?php previous_comments_link() ?></div>
							<div class="alignright"><?php next_comments_link() ?></div>
						</div>
					<?php }
					
					wp_list_comments('callback=mts_comments');
					
					if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
						<div class="navigation">
							<div class="alignleft"><?php previous_comments_link() ?></div>
							<div class="alignright"><?php next_comments_link() ?></div>
						</div>
					<?php } ?>
				</ol>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ( comments_open() ) : ?>
	<div id="commentsAdd">

		<div id="respond" class="box m-t-6">
			<?php
			// Declare Vars.
			$comment_send     = esc_html__( 'Post Comment', 'crypto' );
			$comment_reply    = esc_html__( 'Leave a Reply', 'crypto' );
			$comment_reply_to = esc_html__( 'Reply', 'crypto' );
			$comment_author   = esc_html__( 'Name*', 'crypto' );
			$comment_email    = esc_html__( 'Email*', 'crypto' );
			$comment_body     = esc_html__( 'Insert Your Reply...', 'crypto' );
			$comment_url      = esc_html__( 'Website', 'crypto' );
			$comment_cancel   = esc_html__( 'Cancel Reply', 'crypto' );
			$comments_args    = [
				// Define Fields.
				'fields'               => [
					// Author field.
					'author'  => '<p class="comment-form-author"><input id="author" name="author" aria-required="true" placeholder="' . $comment_author . '"></input></p>',
					// Email Field.
					'email'   => '<p class="comment-form-email"><input id="email" name="email" placeholder="' . $comment_email . '"></input></p>',
					// URL Field.
					'url'     => '<p class="comment-form-url"><input id="url" name="url" placeholder="' . $comment_url . '"></input></p>',
				],
				// Change the title of send button.
				'label_submit'         => $comment_send,
				// Change the title of the reply section.
				'title_reply'          => $comment_reply,
				// Change the title of the reply section.
				'title_reply_to'       => $comment_reply_to,
				// Cancel Reply Text.
				'cancel_reply_link'    => $comment_cancel,
				// Redefine your own textarea (the comment body).
				'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="6" aria-required="true" placeholder="' . $comment_body . '"></textarea></p>',
				// Message Before Comment.
				'comment_notes_before' => '',
				'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
				'title_reply_after' => '</h4>',
				// Remove "Text or HTML to be displayed after the set of comment fields".
				'comment_notes_after'  => '',
				// Submit Button ID.
				'id_submit'            => 'submit',
			];
			comment_form( $comments_args );
			?>
		</div>

	</div>
	<div class="comments-hide"><a href="#"><?php _e('Hide Comments', 'crypto'); ?></a></div>
<?php
endif;
