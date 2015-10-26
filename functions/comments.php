<?php
/**
 * Functions for comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

function comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
?>
   <li class="comment" id="li-comment-<?php comment_ID() ?>" itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">

<article id="comment-<?php comment_ID(); ?>" class="comment-container clearfix">
	<div class="comment-header">
		<span class="comment-name" itemprop="author"><?php printf(__('%s'), get_comment_author_link()) ?></span>
		<time class="comment-date" datetime="<?php comment_time('Y/m/d H:i:s'); ?>" itemprop="datePublished"><?php echo time_ago(); ?></time>
		<?php comment_reply_link(array_merge( $args, array('reply_text' => __('reply', 'Lophita'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	</div>
	<div class="comment-content" itemprop="description">
		<?php comment_text() ?>
	</div>
</article>
<?php
}

function time_ago( $type = 'commennt', $day = 30 ) {
	$d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
	$timediff = time() - $d('U');
	if ($timediff <= 60*60*24*$day) {
		echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
	}
	if ($timediff > 60*60*24*$day) {
		if(lo_opt('time_style')=='1') 
			echo date('Y-m-d',get_comment_date('U')), ' ', get_comment_time('H:i'); 
		elseif(lo_opt('time_style')=='2')
			echo  date('Y/m/d',get_comment_date('U')), ' ', get_comment_time('H:i');
		elseif(lo_opt('time_style')=='3')
			echo date('d-m-Y',get_comment_date('U')), ' ', get_comment_time('H:i'); 
		else 
			echo date('d/m/Y',get_comment_date('U')), ' ', get_comment_time('H:i');
	};
}

/*ajax comment submit*/
add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment');
add_action('wp_ajax_ajax_comment', 'ajax_comment');
function ajax_comment(){
    global $wpdb;
    //nocache_headers();
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    $post_author = $post->post_author;
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.','Lophita'));
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err(__('Sorry, comments are closed for this item.','Lophita'));
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.','Lophita'));
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.','Lophita'));
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err(__('Password Protected','Lophita'));
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
	$edit_id              = ( isset($_POST['edit_id']) ) ? $_POST['edit_id'] : null;
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = $wpdb->escape($user->display_name);
        $comment_author_email = $wpdb->escape($user->user_email);
        $comment_author_url   = $wpdb->escape($user->user_url);
        $user_ID			  = $wpdb->escape($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err(__('Sorry, you must be logged in to post a comment.','Lophita'));
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err( __('Error: please fill the required fields (name, email).', 'Lophita'));
        elseif ( !is_email($comment_author_email))
            ajax_comment_err( __('Error: please enter a valid email address.' ,'Lophita'));
    }
    if ( '' == $comment_content )
        ajax_comment_err( __('Error: please type a comment.' ,'Lophita'));
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!','Lophita'));
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err(__('You are posting comments too quickly.  Slow down.','Lophita'));
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    if ( $edit_id )
	{
		$comment_id = $commentdata['comment_ID'] = $edit_id;
		if( ihacklog_user_can_edit_comment($commentdata,$comment_id) )
		{  
			wp_update_comment( $commentdata );
		}
		else
		{
			ajax_comment_err( __('Cheatin&#8217; uh?','Lophita') );
		}

	}
	else
	{
	$comment_id = wp_new_comment( $commentdata );
	}

    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment;
    ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment-container">
		<div class="comment-header">
			<span class="comment-name"><?php printf(__('%s'), get_comment_author_link()) ?></span>
			<time class="comment-date" datetime="<?php comment_time('Y/m/d H:i:s'); ?>"><?php echo time_ago(); ?></time>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
			<p class="comment-awaiting-moderation">您的评论正在排队等待审核，请稍后再来！</p>
		<?php endif; ?>

		<div class="comment-content">
			<?php comment_text() ?>
		</div>
	</article>

    <?php die();

}
function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}

function ihacklog_user_can_edit_comment($new_cmt_data,$comment_ID = 0) {
    if(current_user_can('edit_comment', $comment_ID)) {
        return true;
    }
    $comment = get_comment( $comment_ID );
    $old_timestamp = strtotime( $comment->comment_date);
    $new_timestamp = current_time('timestamp');
    $rs = $comment->comment_author_email === $new_cmt_data['comment_author_email']
            && $comment->comment_author_IP === $_SERVER['REMOTE_ADDR']
                && $new_timestamp - $old_timestamp < 3600;
    return $rs;
}

add_action('wp_ajax_nopriv_ajax_comment_page_nav', 'ajax_comment_page_nav');
add_action('wp_ajax_ajax_comment_page_nav', 'ajax_comment_page_nav');
function ajax_comment_page_nav(){
    global $post,$wp_query, $wp_rewrite;
    $postid = $_POST["um_post"];
    $pageid = $_POST["um_page"];
    $comments = get_comments('post_id='.$postid.'&status=approve');
    $post = get_post($postid);
    if( 'desc' != get_option('comment_order') ){
        $comments = array_reverse($comments);
    }
    $wp_query->is_singular = true;
    $baseLink = '';
    if ($wp_rewrite->using_permalinks()) {
        $baseLink = '&base=' . user_trailingslashit(get_permalink($postid) . 'comment-page-%#%', 'commentpaged');
    }
    echo '<ol class="comments-list">';
    wp_list_comments('type=comment&style=ol&callback=comment&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);
    echo '</ol>';
    echo '<nav class="commentnav" data-postid="'.$postid.'">';
    paginate_comments_links('current=' . $pageid . '&prev_text=«&next_text=»');
    echo '</nav>';
    die;
}

add_action('comment_post','comment_mail_notify'); 
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
	$message = '
	<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
	<p><strong>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</strong></p>
	<p><strong>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言为:</strong><br />'
	. trim(get_comment($parent_id)->comment_content) . '</p>
	<p><strong>' . trim($comment->comment_author) . ' 给你的回复是:</strong><br />'
	. trim($comment->comment_content) . '<br /></p>
	<p>你可以点击此链接 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整内容</a></p><br />
	<p>欢迎再次来访<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	<p>(此邮件为系统自动发送，请勿直接回复.)</p>
	</div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
  }
}

add_filter('get_comment_author_link', 'lo_popuplinks', 6);
function lo_popuplinks($text) {
    $text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
    return $text;
}

add_filter('comment_reply_link', 'lo_add_nofollow', 420, 4);
function lo_add_nofollow($link, $args, $comment, $post){
    return preg_replace( '/href=\'(.*(\?|&)replytocom=(\d+)#respond)/', 'href=\'#comment-$3', $link );
}

add_filter( 'comment_text' , 'lo_comment_add_at', 20, 2);
function lo_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '<a href="#comment-' . $comment->comment_parent . '">@'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }
  return $comment_text;
}
?>