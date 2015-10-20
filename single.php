<?php
/**
 * The template for displaying all single posts
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


<?php 

	if( have_posts() ){
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'inc/post-format/single', get_post_format() );
		}
	}
?>

<?php get_footer(); ?>