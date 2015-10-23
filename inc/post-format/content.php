<?php
/**
 * The default template for displaying content
 *
 * Used for index.
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */
	$postnew ='';
	$views = (int)get_post_meta($post->ID, 'views', true);
	$diff=(time()-strtotime($post->post_date))/3600;
	if(is_sticky()){
		$postnew = 'sticky';
	}elseif($diff<24){
		$postnew = 'new';
	}elseif( $views > 1000){
		$postnew = 'hot';
	}
	$lo_love = 0;
	if( get_post_meta($post->ID,'lo_love',true) ){            
		$lo_love = (int)get_post_meta($post->ID,'lo_love',true);
	}
?>

<article class="post layout-center<?php echo ' '.$postnew;?>" itemscope itemtype="http://schema.org/Article">
	<?php if( has_post_thumbnail() ) { ?>
	<figure class="post-thumb">
		<a rel="bookmark" href="<?php the_permalink(); ?>">
			<?php echo lo_get_thumb(700, 400); ?>
		</a>
	</figure>
	<?php } ?>

	<header class="post-header">
		<h2 class="post-name" itemprop="name headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="tooltip tip-right" data-tooltip="<?php echo $views.' '.__('views', 'Lophita').__(' with ', 'Lophita').$post->comment_count.' '.__('comments', 'Lophita');?>"><?php the_title(); ?></a>
			<?php if(lo_opt('series_is_open')) { ?><sup><?php echo lo_get_category_only(get_the_ID(), 'series')?></sup><?php } ?>
		</h2>
    </header>
	<div class="post-meta">
		<ul>
			<li><?php the_category(','); ?></li>
			<li><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" pubdate><?php if(lo_opt('time_style')=='1') the_time('Y-m-d'); elseif(lo_opt('time_style')=='2') the_time('Y/m/d'); elseif(lo_opt('time_style')=='3') the_time('d-m-Y'); else the_time('d/m/Y');?></time></li>
		</ul>
	</div>
    <div class="post-content clearfix" itemprop="description">
		<?php
		$pc=$post->post_content;
		$st=strip_tags(apply_filters('the_content',$pc));
		if(has_excerpt())
			the_excerpt();
		elseif(preg_match('/<!--more.*?-->/',$pc) || mb_strwidth($st)<200)
			the_content('');
		elseif(function_exists('mb_strimwidth'))
			echo'<p>'.mb_strimwidth($st,0,260,' ...').'</p>';
		else the_content('');
		?>
    </div>
</article>