<?php
/**
 * The main template file
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
			get_template_part( 'inc/post-format/content', get_post_format() );
		}
	}
?>

<?php lo_pagenavi(3);?>
<?php get_footer(); ?>