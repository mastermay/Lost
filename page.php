<?php
/**
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

<article class="page" itemtype="http://schema.org/Article" itemscope="itemscope">
	<header class="page-header layout-center">
		<h2 class="page-name" itemprop="headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>
		</h2>
	</header>
    <div class="page-content layoutCenter clearfix" itemprop="articleBody">
		<?php the_content();?>
		<?php comments_template('', true); ?>
    </div>
</article>
	
<?php endwhile; endif;?>
<?php get_footer(); ?>