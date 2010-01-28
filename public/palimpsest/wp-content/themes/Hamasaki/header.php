<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if ( function_exists('optimal_title') ) { optimal_title('|'); bloginfo('name'); } else { bloginfo('name'); wp_title('|'); } ?>
<?php if ( is_home() ) { ?>
|
<?php bloginfo('description'); } ?>
</title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/src/menu.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/src/mootools.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/src/tips.js"></script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body>
<?php
		global $page_sort;	
		if(get_settings('hamasaki_sortpages')!='')
		{ 
			$page_sort = 'sort_column='. get_settings('hamasaki_sortpages');
		}	
		global $pages_to_exclude;
		
		if(get_settings('hamasaki_excludepages')!='')
		{ 
			$pages_to_exclude = 'exclude='. get_settings('hamasaki_excludepages');
		}	

		if(get_settings('hamasaki_excludecats')!='')
		{ 
			$cats_to_exclude = 'exclude='. get_settings('hamasaki_excludecats');
		}	

?>
<div id="top">
  <div id="navr">
    <ul class="menu">
      <li <?php if(is_home()){echo 'class="current_page_item"';}?>><a href="<?php bloginfo('siteurl'); ?>/" title="Home">Home</a></li>
      <?php wp_list_pages($page_sort.'&'.$pages_to_exclude.'&title_li=&depth=1')?>
      <?php wp_register('<li class="admintab">','</li>'); ?>
      <li class="search">
        <?php include (TEMPLATEPATH . '/searchform.php'); ?>
      </li>
    </ul>
  </div>
</div>
<div id="page">
<div id="pager">
  <div id="headr">
    <h1><a href="<?php echo get_option('home'); ?>/">
      <?php bloginfo('name'); ?>
      </a></h1>
    <div class="description">
      <?php bloginfo('description'); ?>
    </div>
    <div id="ads-468">
      <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Ad Place (468x60) [Only 1 Widget Please]') ) : else : ?>
      <img src="<?php bloginfo('template_directory'); ?>/images/ads/468.jpg" alt="Ads" />
      <?php endif; ?>
    </div>
  </div>
</div>
<hr />
<div class="catcat">
  <ul id="dropnav" class="clearfix">
    <?php wp_list_categories('show_count=0&title_li=&depth=5&'.$cats_to_exclude); ?>
  </ul>
</div>
<div id="sub-page">
