<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	global $wpdb; 
	$all_link_cats = array();
	$linkcats = $wpdb->get_results("SELECT T1.name AS name, T1.term_id AS ID FROM $wpdb->terms T1, $wpdb->term_taxonomy T2 WHERE T1.term_id = T2.term_id AND T2.taxonomy = 'link_category'");
	if($linkcats) {
		foreach($linkcats as $linkcat) {
			$all_link_cats[$linkcat->ID] = $linkcat->name;
		}
	}
	//var_dump($all_link_cats);

	$options = array();

	$options[] = array(
		'name' => '通用设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '作者头像',
		'id' => 'author_image',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '样式',
		'id' => 'theme_style',
		'std' => '2',
		'type' => 'radio',
		'options' => array(
						'1' => '宽屏',
						'2' => '窄屏'
						)
	);
	
	$options[] = array(
		'name' => '背景图片',
		'id' => 'index_bg',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '首页描述',
		'desc' => '仅需填入首页 description，其他页面会自动生成',
		'id' => 'index_description',
		'placeholder' => '网站描述',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => '页底信息',
		'desc' => '',
		'id' => 'footer_info',
		'placeholder' => '页底信息',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '禁止站内 pingback',
		'desc' => '开启后站内 pingback 将会被禁止',
		'id' => 'nopingback',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '日期格式',
		'desc' => '选择主题中日期的显示格式',
		'id' => 'time_style',
		'std' => '4',
		'type' => 'radio',
		'options' => array(
						'1' => '2012-01-02',
						'2' => '2012/01/02',
						'3' => '02-01-2012',
						'4' => '02/01/2012'
					)
	);

	$options[] = array(
		'name' => 'SNS 设置',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '新浪微博',
		'desc' => '留空则不显示（下同），别忘了http://',
		'id' => 'sns_weibo',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => 'github',
		'desc' => '',
		'id' => 'sns_github',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => 'twitter',
		'desc' => '',
		'id' => 'sns_twitter',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => 'Linkedin',
		'desc' => '',
		'id' => 'sns_linkedin',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => 'Google+',
		'desc' => '',
		'id' => 'sns_google',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => 'RSS',
		'desc' => '勾选以显示',
		'id' => 'sns_rss',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '自定义代码',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '自定义样式',
		'desc' => '填入 css 代码，不需要包含 style 标签',
		'id' => 'custom_style',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => '头部通用代码',
		'desc' => '填入 js 代码，不需要包含 script 标签',
		'id' => 'header_js',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => '底部通用代码',
		'desc' => '填入 js 代码，不需要包含 script 标签',
		'id' => 'footer_js',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => '流量统计代码',
		'desc' => '填入 js 代码，不需要包含 script 标签',
		'id' => 'tongji_js',
		'type' => 'textarea'
	);


	return $options;
}