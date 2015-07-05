<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to ts_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'templatesquare' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One message to %2$s', '%1$s Messages to %2$s', get_comments_number(), 'templatesquare' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use ts_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define ts_comment() and that will be used instead.
					 * See ts_comment() in Blackbox/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'ts_comment' ) );
				?>
			</ol>
			

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older Comments', 'templatesquare' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&raquo;</span>', 'templatesquare'  ) ); ?></div>
			</div><!-- .navigation -->
			
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'templatesquare' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php //comment_form(); ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

<h2><?php comment_form_title(__('Give Alba a message', 'templatesquare'), __('Give Alba a message to %s', 'templatesquare') ); ?></h2>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php _e('You must be', 'templatesquare');?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in', 'templatesquare');?></a><?php _e('to post a comment.', 'templatesquare');?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<fieldset>
<?php if ( is_user_logged_in() ) : ?>

<p><?php _e('Logged in as', 'templatesquare');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'templatesquare');?>"><?php _e('Log out &raquo;', 'templatesquare');?></a></p><br />

<?php else : ?>

 <label><?php _e('Name','templatesquare');?> *<br /> <input type="text" name="author" id="author"  value="<?php echo esc_attr($comment_author); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>  /></label>
 <label><?php _e('Mail', 'templatesquare');?> *<br /><input type="text" id="email" name="email"  value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></label>

 
 <br style="clear:both" />
<?php endif; ?>

<label><?php _e('Comments', 'templatesquare');?><br /><textarea rows="5" cols="" id="comment" name="comment" tabindex="4" class="textarea" ></textarea></label> <br style="clear:both" />
<!--<p><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->
<input name="submit" type="submit" id="submit" tabindex="5" value="Submit" class="button" /> 
<br style="clear:both" />
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</fieldset>
</form>

<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
</div><!-- #comments -->