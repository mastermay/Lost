<?php
/**
 * Actions and filters
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */


/**
 * head custom code
 *
 * @since 1.0
 */
function head_custom_code() {
	if( lo_opt('header_js') != '' ) {
		echo '<script>'.lo_opt('header_js').'</script>';
	}
	if( lo_opt('custom_style') != '' ) {
		echo '<style>'.lo_opt('custom_style').'</style>';
	}
}
add_action( 'wp_head', 'head_custom_code' );

/**
 * footer custom code
 *
 * @since 1.0
 */
function footer_custom_code() {
	if( lo_opt('footer_js') != '' ) {
		echo '<script>'.lo_opt('footer_js').'</script>';
	}
	if( lo_opt('tongji_js') != '' ) {
		echo '<script>'.lo_opt('tongji_js').'</script>';
	}
}
add_action( 'wp_footer', 'footer_custom_code' );

/**
 * footer copyright
 *
 * @since 1.0
 *
 */
function footer_copyright() {
	echo '<div class="copyright"><p>Proudly powered by <a href="https://wordpress.org/" target="_blank">WordPress</a> · Theme by <a href="http://lostg.com" target="_blank">Javis</a></p></div>';
}

add_action( 'footer_copyright', 'footer_copyright' );

/**
 * sns
 *
 * @since 1.0
 *
 */
function sns() {
	if(lo_opt('sns_github')) {
		echo '<a class="github" href ="'.lo_opt('sns_github').'" target="_blank"><i class="iconfont icon-github"></i></a>';
	}
	if(lo_opt('sns_weibo')) {
		echo '<a class="weibo" href ="'.lo_opt('sns_weibo').'" target="_blank"><i class="iconfont icon-weibo"></i></a>';
	}
	if(lo_opt('sns_twitter')) {
		echo '<a class="twitter" href ="'.lo_opt('sns_twitter').'" target="_blank"><i class="iconfont icon-twitter"></i></a>';
	}
	if(lo_opt('sns_linkedin')) {
		echo '<a class="linkedin" href ="'.lo_opt('sns_linkedin').'" target="_blank"><i class="iconfont icon-0457linkedin"></i></a>';
	}
	if(lo_opt('sns_google')) {
		echo '<a class="google" href ="'.lo_opt('sns_google').'" target="_blank"><i class="iconfont icon-googleplus3"></i></a>';
	}
	if(lo_opt('sns_rss')) {
		echo '<a class="rss" href ="'.get_bloginfo('url').'/feed" target="_blank"><i class="iconfont icon-rss"></i></a>';
	}
}
add_action( 'sns', 'sns' );
?>