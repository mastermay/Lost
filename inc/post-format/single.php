<?php
/**
 * The template for displaying all single posts
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */
?>
<div class="single layout-center" itemscope itemtype="http://schema.org/Article">
	<?php lo_breadcrumbs();?>
	<article class="single-post">
		<header class="post-header <?php if(get_post_meta( $post->ID, '_mirana_images_b_value_key', true ) != '') echo 'hide';?>">
			<h2 class="post-name" itemprop="name headline">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		</header>
		<ul class="post-meta">
			<li><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" pubdate><?php if(lo_opt('time_style')=='1') the_time('Y-m-d H:i'); elseif(lo_opt('time_style')=='2') the_time('Y/m/d H:i'); elseif(lo_opt('time_style')=='3') the_time('d-m-Y H:i'); else the_time('d/m/Y H:i');?></time></li>
			<li><?php lo_post_views(__('Views','Lophita'));?></li>
		</ul>
		<div class="post-content clearfix" itemprop="articleBody">
			<?php the_content(); ?>
			<div class="post-pagenvi">
			<?php {
				wp_link_pages('before=<strong>&after=</strong>&next_or_number=next&previouspagelink=«&nextpagelink=&nbsp');  
				wp_link_pages('before=<span class="wp-pagenavi">&after=</span>&next_or_number=number');  
				//echo "&nbsp;";  
				wp_link_pages('before=<strong>&after=</strong>&next_or_number=next&previouspagelink=&nbsp&nextpagelink=»');  
			} ?>  
			</div>
		</div>
	</article>
	

	<ul class="post-info">
		<li><?php echo '# ';the_category(',');?></li>
		<li><?php the_tags('# ');?></li>
	</ul>

	<?php comments_template('', true); ?>
</div>