<?php
/**
 * Template Name: 存档模板
 *
 * The template for posts archives page.
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */

get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="page page-archives" itemtype="http://schema.org/Article" itemscope="itemscope">
	<header class="page-header layout-center">
		<h2 class="page-name" itemprop="headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>
		</h2>
	</header>
    <div class="page-content layout-center clearfix" itemprop="articleBody">
		<ul class="all-posts">
		<?php
			$myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
        	foreach($myposts as $post) :
		 ?>
			<li>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<ul class="meta">
					<li><?php the_category(','); ?></li>
					<li><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" pubdate><?php if(lo_opt('time_style')=='1') the_time('Y-m-d'); elseif(lo_opt('time_style')=='2') the_time('Y/m/d'); elseif(lo_opt('time_style')=='3') the_time('d-m-Y'); else the_time('d/m/Y');?></time></li>
				</ul>
			</li>
        <?php endforeach; ?>
       </ul>
    </div>
</article>
	
<?php endwhile; endif;?>
<?php get_footer(); ?>