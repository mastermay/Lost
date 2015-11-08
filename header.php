<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */
?>
<!DOCTYPE html>
<html lang="zh-CN" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,minimal-ui" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>
	<?php
	if(is_front_page() || is_home()) { 
		bloginfo('name');
		echo ' | '.get_bloginfo( 'description', 'display' );
	} else if(is_single() || is_page()) {
		wp_title(' |', true, 'right'); bloginfo('name');
	} else if(is_category()) {
		single_cat_title('', true);
		echo ' | ';
		bloginfo('name');
	} else if(is_search()) {
		printf(__('Search Result: %1$', 'Lophita' ), wp_specialchars($s, 1));
		echo ' | ';
		bloginfo('name');
	} else if(is_tag()) {
		single_tag_title('', true);
		echo ' | ';
		bloginfo('name');
	} else if(is_date()) {
		_e('Archives by Date', 'Lophita');
	} else {
		bloginfo('name');
		echo ' | '.get_bloginfo( 'description', 'display' );
	}
	?></title>
	<?php wp_head(); ?>

<?php if( lo_opt('header_js') != '' ) echo '<script>'.lo_opt('header_js').'</script>';?>
<?php if( lo_opt('custom_style') != '' ) echo '<style>'.lo_opt('custom_style').'</style>';?>
</head>
<body>
	<div class="loading-bar"></div>
	<div id="wrap" <?php if(lo_comments_open()) echo 'class="comments-open"';?>>
		<div id="header" class="standard" <?php if(lo_opt('index_bg')) echo 'style="background-image: url(\''.lo_opt('index_bg').'\');"';?>>
			<div class="header-wrap layout-center">
				<h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name')?></a></h1>
				<div id="header-menu">
					<i class="iconfont icon-liebiao"></i>
					<?php 
						if(function_exists('wp_nav_menu')) {
							wp_nav_menu(array( 'theme_location' => 'header-menu','container' => 'ul', 'menu_class' => 'menu')); 
						}
					?>
				</div>
				<div class="sns">
					<?php if(lo_opt('sns_github')) echo '<a class="github" href ="'.lo_opt('sns_github').'" target="_blank"><i class="iconfont icon-github"></i></a>';?>
					<?php if(lo_opt('sns_weibo')) echo '<a class="weibo" href ="'.lo_opt('sns_weibo').'" target="_blank"><i class="iconfont icon-weibo"></i></a>';?>
					<?php if(lo_opt('sns_twitter')) echo '<a class="twitter" href ="'.lo_opt('sns_twitter').'" target="_blank"><i class="iconfont icon-twitter"></i></a>';?>
					<?php if(lo_opt('sns_linkedin')) echo '<a class="linkedin" href ="'.lo_opt('sns_linkedin').'" target="_blank"><i class="iconfont icon-0457linkedin"></i></a>';?>
					<?php if(lo_opt('sns_google')) echo '<a class="google" href ="'.lo_opt('sns_google').'" target="_blank"><i class="iconfont icon-googleplus3"></i></a>';?>
					<?php if(lo_opt('sns_rss')) echo '<a class="rss" href ="'.get_bloginfo('url').'/feed" target="_blank"><i class="iconfont icon-rss"></i></a>';?>
				</div>
			</div>
		</div>
		
		<div id="content">