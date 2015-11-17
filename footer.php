<?php
/**
 * The template for displaying the footer
 *
 * @author Javis <javismay@gmail.com>
 * @license MIT
 * @since 1.0
 * @version 1.0
 */
?>
		</div>

		<footer id="footer" <?php if(lo_opt('index_bg')) echo 'style="background-image: url(\''.lo_opt('index_bg').'\');"';?>role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
			<div class="footer-wrap">
				<div class="information"><p><?php echo lo_opt('footer_info');?></p></div>
				<?php do_action('footer_copyright');?>
			</div>
		</footer>
	</div>
	<a id="gotop" href="javascript:;" class="iconfont icon-up"></a>

<?php 
	wp_footer();
?>
</body>
</html>