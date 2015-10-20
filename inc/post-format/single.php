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
<div class="single" itemscope itemtype="http://schema.org/Article">
	<?php lo_breadcrumbs();?>
	<article class="single-post">
		<header class="post-header <?php if(get_post_meta( $post->ID, '_mirana_images_b_value_key', true ) != '') echo 'hide';?>">
			<h2 class="post-name" itemprop="name headline">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		</header>
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
	
	<div class="post-author">
		<div class="post-author-avatar effect-hover"><?php get_author_avatar();?></div>
		<div class="post-author-info"><h6><?php the_author(); ?></h6>
		<p><?php the_author_description(); ?></p></div>
	</div>

	<div class="post-info side-top-border" data-content="<?php _e('Meta', 'Lophita');?>">
		<div><span class="meta-hide"><?php _e('Time','Lophita');?></span><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" pubdate><?php if(lo_opt('time_style')=='1') the_time('Y-m-d H:i'); elseif(lo_opt('time_style')=='2') the_time('Y/m/d H:i'); elseif(lo_opt('time_style')=='3') the_time('d-m-Y H:i'); else the_time('d/m/Y H:i');?></time></div>
		<div><span class="meta-hide"><?php _e('Views','Lophita');?></span><?php lo_post_views();?></div>
		<div><span class="meta-hide"><?php _e('Score','Lophita');?></span><?php lo_rating($post->ID);?></div>
	</div>

	<div class="post-category side-top-border" data-content="<?php _e('Category', 'Lophita');?>">
		<?php echo lo_get_category( get_the_ID(), 'category' );?>
	</div>

	<?php $tags = lo_get_tags( get_the_ID(), 'post_tag' ); if($tags) { ?>
	<div class="post-tags side-top-border" data-content="<?php _e('Tags', 'Lophita');?>">
		<div class="post-tags" itemprop="keywords"><?php echo $tags;?></div>
	</div>
	<?php } ?>

	<?php comments_template('', true); ?>
</div>