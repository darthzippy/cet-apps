<div id="sidebar">
  <div class="boxtop">
    <ul class="box-ad clearfix">
      <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/ads/ads1.jpg" border="0" alt="Your Ads Here" /></a></li>
      <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/ads/ads1.jpg" border="0" alt="Your Ads Here" /></a></li>
      <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/ads/ads1.jpg" border="0" alt="Your Ads Here" /></a></li>
      <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/ads/ads1.jpg" border="0" alt="Your Ads Here" /></a></li>
    </ul>
  </div>
  <div id="ayu">
  <img src="<?php header_image(); ?>" alt="Photos" />
  </div>
  
  <div class="side1">
    <div class="gapy">
      <ul>
        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Right Left') ) : else : ?>
        <?php J_ShowAbout(); ?>
        <li class="boxr archiv">
          <h3>Archives</h3>
          <ul>
            <?php wp_get_archives('type=monthly'); ?>
          </ul>
        </li>
        <li class="boxr meta">
          <h3>Meta</h3>
          <ul>
            <?php wp_register(); ?>
            <li>
              <?php wp_loginout(); ?>
            </li>
            <li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
            <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
            <li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
            <?php wp_meta(); ?>
          </ul>
        </li>
        <?php endif; // End of Sidebar ?>
      </ul>
    </div>
  </div>
  <div class="side2">
    <div class="gapy">
      <ul>
      <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Ad Place (120x600)') ) : else : ?>
        <li>
          <div id="ads-120"> <img src="<?php bloginfo('template_directory'); ?>/images/ads/120.jpg" alt="Ads" /></div>
        </li>
        <?php endif; // End of Sidebar ?>
      </ul>
    </div>
  </div>
</div>
<!-- /#sidebar -->
