<?php include (TEMPLATEPATH.'/tools/get-theme-options.php'); ?>
</div> 
<div id="footer"> 
  <?php wp_footer(); ?>
  <div> &#169; <?php echo date('Y'); ?> 
    <?php bloginfo('name'); ?>
    | Powered by <a href="http://wordpress.org/" target="_blank">WordPress</a> 
    | <a href="http://www.wp-themes.der-prinz.com/magazine/" target="_blank" title="By DER PRiNZ - Michael Oeser">BranfordMagazine theme</a> by <a href="http://www.michaeloeser.de" target="_blank" title="By Michael Oeser">Michael Oeser</a> at <a href="http://www.der-prinz.com" target="_blank" title="DER PRiNZ - Michael Oeser">DER PRiNZ</a>
    <div></div> 
    <?php wp_loginout(); ?> | 
    <?php wp_register('', ' |'); ?>
	<?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds.
  </div>
</div>


<!-- Google (or other) analytics code (if set in the options) -->
<?php echo $prinz_analytics; ?>
</body>
</html>
