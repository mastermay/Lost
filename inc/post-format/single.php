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
	<div class="layout-center"><?php lo_breadcrumbs();?></div>
	<article class="single-post layout-center">
		<header class="post-header">
			<h2 class="post-name" itemprop="name headline">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		</header>
		<ul class="post-meta">
			<li><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" pubdate><?php if(lo_opt('time_style')=='1') the_time('Y-m-d H:i'); elseif(lo_opt('time_style')=='2') the_time('Y/m/d H:i'); elseif(lo_opt('time_style')=='3') the_time('d-m-Y H:i'); else the_time('d/m/Y H:i');?></time></li>
			<li><?php lo_post_views(' '.__('Views','Lophita'));?></li>
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
		<ul class="post-info clearfix">
			<li class="right">
				<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite <?php if(isset($_COOKIE['lo_ding_'.$post->ID])) echo ' done';?>" title="Love this">
					<i class="iconfont icon-weiguanzhu"></i>
					<span class="love-count">
						<?php
						if( get_post_meta($post->ID,'lo_ding',true) ){            
							echo get_post_meta($post->ID,'lo_ding',true);
						} else {
							echo '0';
						}?>
					</span>
				</a>
			</li>
			<li class="left"><?php echo '# ';the_category(',');?></li>
			<li class="left"><?php the_tags('# ');?></li>
		</ul>
		<hr>
		<div class="post-author">
			<?php author_image();?>
			<div class="author-meta">
				<p class="name"><?php the_author(); ?></p>
				<p class="description"><?php the_author_description(); ?></p>
			</div>
		</div>
	</article>

	<?php comments_template('', true); ?>
</div>