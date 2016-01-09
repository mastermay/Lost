<?php
/**
 * Load scripts and styles
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.1
 */

add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts_frontpage' );
function my_enqueue_scripts_frontpage() {
	wp_enqueue_style( 'default', get_template_directory_uri() . '/style.css', array(), '1.1.0' );
	wp_deregister_script( 'jquery' ); 
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.10.2.min.js'); 
	wp_enqueue_script( 'jquery' ); 

	wp_enqueue_script( 'base', get_template_directory_uri() . '/js/global.js', array(), '1.1.0', true);

	wp_localize_script('base', 'ajax', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'home' => home_url(),
		'gif' => includes_url('/images/spinner.gif')
	));
}

?>