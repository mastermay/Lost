<?php
/**
 * The default template for displaying content
 *
 * Used both for category and search.
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */	
?>

<article class="archive layout-center" itemscope itemtype="http://schema.org/Article">
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="archive-thumb">
		<?php echo lo_get_thumb(); ?>
	</div>
	<?php } ?>
	<header class="archive-header">
		<h2 class="archive-name" itemprop="name headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
    </header>

    <div class="archive-content clearfix" itemprop="description">
		<?php
		$pc=$post->post_content;
		$str = apply_filters('the_content',$pc);
		//$str = preg_replace( "@<script(.*?)</script>@is", "", $str ); 
		//$str = preg_replace( "@<iframe(.*?)</iframe>@is", "", $str ); 
		//$str = preg_replace( "@<style(.*?)</style>@is", "", $str );	
		$st=strip_tags($str);
		if(mb_strwidth($st)<200)
			the_content('');
		elseif( function_exists('mb_strimwidth') )
			echo'<p>'.mb_strimwidth($st,0,200,' ...').'</p>';
		?>
    </div>

    <footer class="archive-meta">
		<ul>
			<li><?php the_category(','); ?></li>
			<li><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" pubdate><?php if(lo_opt('time_style')=='1') the_time('Y-m-d'); elseif(lo_opt('time_style')=='2') the_time('Y/m/d'); elseif(lo_opt('time_style')=='3') the_time('d-m-Y'); else the_time('d/m/Y');?></time></li>
		</ul>
	</footer>
</article>