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

<div class="comments">
	<div class="layout-center clearfix">
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

		<div id="respond" class="responses comment-respond">
			<h5 id="replytitle" class="comment-reply-title"><?php _e("Leave a Reply","Lophita");?> <small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;"><?php _e("Cancel reply", 'Lophita');?></a></small></h5>
			<form action="#" method="post" id="commentform" class="clearfix">
				<?php if ( $user_ID ) { ?>
				<div class="comment-saved-author">
					<?php _e('Admin', 'Lophita');?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>
				</div>
				<?php } else {
					if(!empty($comment_author) && !empty($comment_author_email)){ ?>
						<div class="comment-saved clearfix">
						<p><?php _e('Welcome back','Lophita'); ?> <span class="show-form tooltip tip-right" data-tooltip="点击编辑个人信息"><?php echo esc_attr($comment_author); ?></span></p>
						</div>
						<div id="comment-info" class="clearfix">
					<?php } else { ?>
						<div class="clearfix">
					<?php }?>
				<p class="input-row">
					<input type="text" name="author" id="author" class="comments-input" tabindex="1" value="<?php if ( !empty($comment_author) ) { echo esc_attr($comment_author); } else { echo ''; } ?>" placeholder="<?php _e('NAME', 'Lophita');?>"/>
				</p>
				
				<p class="input-row input-row-mail">
					<input type="email" name="email" id="email" class="comments-input" tabindex="2" value="<?php if ( !empty($comment_author_email) ) { echo esc_attr($comment_author_email); } else { echo ''; } ?>" placeholder="<?php _e('E-MAIL', 'Lophita');?>"/>
				</p>
				
				<p class="input-row input-row-url">
					<input type="text" name="url" id="url" class="comments-input" tabindex="3" value="<?php if (!empty($comment_author_url)) { echo esc_attr($comment_author_url); } else { ''; } ?>" placeholder="<?php _e('WEBSITE', 'Lophita');?>"/>
				</p>
				</div>
				<?php }?>
				
				<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>

				<p class="input-row">
					<textarea class="text_area" rows="4" name="comment" id="comment" tabindex="4" placeholder="<?php _e('CONTENT', 'Lophita');?>"></textarea>
				</p>
				<input type="submit" name="submit" id="submit" tabindex="5" value="<?php _e('Post Comment', 'Lophita');?>"/>
			</form>
		</div>
	</div>
</div>
<?php } ?>