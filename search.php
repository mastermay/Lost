<?php
/**
 * The template for displaying search results pages.
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php 
	the_search_form($s);
	if( have_posts() ){ ?>
	<div class="search-title layoutCenter"><p><?php  global $wp_query;$count = $wp_query->found_posts; echo $count.' '._n( 'Result' , 'Results' , $count ); if(get_query_var('paged')) echo ', '.__('Page', 'Lophita').' '.get_query_var('paged');?></p></div><div class="search-result">
	<?php	while ( have_posts() ){
			the_post(); 
			get_template_part( 'inc/post-format/category', get_post_format() );
		}
	echo '</div>';
	lo_pagenavi();
	} else {
?>
<div class="search-no-result">
	<div class="search-title layoutCenter"><p><?php _e('Apologies, but no results were found. The following are the latest posts', 'Lophita');?></p></div>
	
	<?php
	$the_query = new WP_Query( array("posts_per_page"=>get_option('posts_per_page'),"post_status"=>"publish","post_type"=>"post") );
	while ( $the_query->have_posts() ){
		$the_query->the_post();
		get_template_part( 'inc/post-format/category', get_post_format() );
	}
    wp_reset_postdata();
	
	?>
	
</div>
<?php } ?>
<?php get_footer(); ?>