<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-6">
				<?php $url = "http://www.webmonkeydd.com"; ?>
			    <span id="footer-ct1"><?php echo __('Theme By', 'lightning-monkey'); ?> <a href="<?php echo $url; ?>">Web Monkey Design and Development</a></span> 
			</div>
			<div class="col-xs-6" id="footer-ct2">
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'footer-nav', 'theme_location' => 'footer-menu' ) ); ?>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>