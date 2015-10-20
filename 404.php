<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<article class="page page-404" itemtype="http://schema.org/Article" itemscope="itemscope">
	<header class="page-header">
		<h2 class="page-name" itemprop="headline">
			<a href="javascript:;"><?php _e("404. That's an error.", 'Lophita'); ?></a>
		</h2>
	</header>
	<div class="page-content" itemprop="articleBody">
		<?php _e("The requested URL was not found on this server. That's all we know.", 'Lophita'); ?>
	</div>
</article>

<?php get_footer(); ?>