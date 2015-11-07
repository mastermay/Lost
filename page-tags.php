<?php
/**
 * Template Name: 标签模板
 *
 * The template for displaying pages
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="page page-tags" itemtype="http://schema.org/Article" itemscope="itemscope">
	<header class="page-header layout-center">
		<h2 class="page-name" itemprop="headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>
		</h2>
	</header>
    <div class="page-content layout-center clearfix" itemprop="articleBody">
		<?php specs_show_tags();?>
    </div>
</article>
	
<?php endwhile; endif;?>
<?php get_footer(); ?>