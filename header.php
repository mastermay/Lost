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
    <title><?php lo_title();?></title>
	<?php wp_head(); ?>
</head>
<body <?php lo_body_class();?> >
	<div class="loading-bar"></div>
	<div id="wrap" <?php lo_wrap_class();?> >
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
					<?php do_action('sns');?>
				</div>
			</div>
		</div>
		
		<div id="content">