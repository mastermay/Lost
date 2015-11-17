<?php
/**
 * Load files
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
require_once dirname( __FILE__ ) . '/admin/options-framework.php';

$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

include (TEMPLATEPATH . '/functions/theme.php');
include (TEMPLATEPATH . '/functions/clear.php');
include (TEMPLATEPATH . '/functions/comments.php');
include (TEMPLATEPATH . '/functions/tags.php');
include (TEMPLATEPATH . '/functions/functions.php');
include (TEMPLATEPATH . '/functions/actions.php');

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('Lophita', get_template_directory() . '/languages');
}

register_nav_menus(array('header-menu' => '顶部导航'));

add_theme_support( 'post-formats', array( 'status'));

function prefix_options_menu_filter( $menu ) {
	$menu['mode'] = 'menu';
	$menu['page_title'] = 'Lost 主题设置';
	$menu['menu_title'] = 'Lost 主题设置';
	$menu['menu_slug'] = 'lost-options';
	return $menu;
}
add_filter( 'optionsframework_menu', 'prefix_options_menu_filter' );

?>