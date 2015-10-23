<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */
if(comments_open()) {?>

<div class="comments clearfix">
	<meta content="UserComments:<?php echo count($comments); ?>" itemprop="interactionCount">
	<?php if( count($comments)!=0) { ?>
	<h5 id="comments-title"><span><?php echo count($comments); ?> <?php _e("Comments", 'Lophita');?></span></h5>
	<?php } ?>
	<div class="commentshow">
		<ol class="comments-list">
			<?php wp_list_comments('type=comment&callback=comment&max_depth=1000&style=ol'); ?>
		</ol>
		<nav class="commentnav" data-postid="<?php echo $post->ID?>"><?php paginate_comments_links('prev_text=«&next_text=»');?></nav>
	</div>
	
	<div class="responses">
		<p><?php _e('Have thoughts to share?','Lophita');?></p>
		<a class="respond-overlay-open" href="javascript:;"><?php _e('Write your response','Lophita');?></a>
	</div>

	<div id="respond" class="comment-respond">
		<h5 id="replytitle" class="comment-reply-title"><?php _e("Leave a Reply","Lophita");?> <small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;"><?php _e("Cancel reply", 'Lophita');?></a></small></h5>
		<form action="#" method="post" id="commentform" class="clearfix">
			<?php if ( $user_ID ) { ?>
			<div class="comment-saved-author fontJH">
				<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>
			</div>
			<?php } else {
				if(!empty($comment_author) && !empty($comment_author_email)){ ?>
					<div class="comment-saved fontJH clearfix">
					<p><?php _e('Welcome back','Lophita'); ?><span class="show-form tooltip tip-right" data-tooltip="点击编辑个人信息"><?php echo esc_attr($comment_author); ?></span></p>
					</div>
					<div id="comment-info" class="clearfix">
				<?php } else { ?>
					<div class="clearfix">
				<?php }?>
			<p class="input-row">
				<label for="author"><?php _e('NAME', 'Lophita');?></label>
				<input type="text" name="author" id="author" class="comments-input" tabindex="1" value="<?php if ( !empty($comment_author) ) { echo esc_attr($comment_author); } else { echo ''; } ?>"/>
			</p>
			
			<p class="input-row input-row-mail">
				<label for="email"><?php _e('E-MAIL', 'Lophita');?></label>
				<input type="email" name="email" id="email" class="comments-input" tabindex="2" value="<?php if ( !empty($comment_author_email) ) { echo esc_attr($comment_author_email); } else { echo ''; } ?>"/>
			</p>
			
			<p class="input-row input-row-url">
				<label for="url"><?php _e('WEBSITE', 'Lophita');?></label>
				<input type="text" name="url" id="url" class="comments-input" tabindex="3" value="<?php if (!empty($comment_author_url)) { echo esc_attr($comment_author_url); } else { ''; } ?>"/>
			</p>
			</div>
			<?php }?>
			
			<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>

			<p class="message-row">
				<textarea class="text_area" rows="4" name="comment" id="comment" tabindex="4"></textarea>
				<label for="comment" id="textarea_label"><?php _e('CONTENT', 'Lophita');?></label>
			</p>
			<input type="submit" name="submit" id="submit" tabindex="5" value="<?php _e('Post Comment', 'Lophita');?>"/>
		</form>
	</div>
</div>
<?php } ?>