<div class="clear"></div>
<?php $options = get_option( 'theme_settings' ); ?>
<div class="main">
	<div id="footer">
		<div class="inners"><div class="siteinfo"><?php echo $options['text-copy']; ?> <a href="/navigmap">Карта сайта</a></div></div>
	</div>
</div>
<!-- end FOOTER -->
<?php wp_footer(); ?>

<?php echo $options['tracking']; ?>
</body>
</html>