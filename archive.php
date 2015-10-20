<?php
/**
 * The template for displaying archive pages
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="archive-page-header">
	<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
	?>
</div>
<?php 
	if( have_posts() ){ 
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'inc/post-format/category', get_post_format() );
		}
	}
?>
<?php lo_pagenavi();?>
<?php get_footer(); ?>