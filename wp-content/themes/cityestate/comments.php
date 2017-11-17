<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Cityestate
 * @since Cityestate 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if( post_password_required() ){
	return;
}

// Get cityestate theme labels
global $theme_labels; ?>


<!-- Check if have comment available -->
<?php if( have_comments() ): ?>

	<div class="display_blog_reply">
		<!-- Comment list labels -->
		<h3><?php echo esc_html($theme_labels['comment_list_label'],'cityestate'); ?></h3>
		<!-- List post comments -->
		<ul class="reply_list">
			<?php wp_list_comments( 'callback=cityestate_comment_callback' ); ?>
		</ul>
		
	</div>
<?php endif; ?>

<!-- Customize comment form -->
	<div class="comment_form_block">
		<?php
		$fields =  array(
			// Visiter name
			'author' => '<div class="col-sm-4 padding_left_none">
							<label>'.$theme_labels['comment_name'].'</label>
							<input name="author" required class="form-control" id="author" value="" type="text">
						</div>',

			// Visiter email address
			'email' => '<div class="col-sm-4 padding_left_none">
							<label>'.$theme_labels['comment_email'].'</label>
							<input type="email" class="form-control" required name="email" id="email">
						</div>',

			// Visiter url
			'url' => '<div class="col-sm-4 padding_left_none">
							<label>'.$theme_labels['comment_website'].'</label>
							<input type="url" class="form-control" name="url" id="url">
						</div>',
		);

		// Comment form args
		$comments_args = array(
			'fields' => $fields,			
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'comment_field' => '<div class="col-sm-12 padding_left_none"><label>'.$theme_labels['comment_message'].'</label><textarea class="" required name="comment" id="comment"></textarea></div>',
			'label_submit' => $theme_labels['comment_submit']
		);

		// Show comment form
		comment_form($comments_args); ?>		
	</div>