<?php load_theme_textdomain('branfordmagazine'); ?>
<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] = get_option( $value['id'] ); }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php 
echo '	<title>';
if ( is_home() ) {
	// Blog's Home
	echo get_bloginfo('name') . '  &raquo; '; bloginfo('description') ; 
} elseif ( is_single() or is_page() ) {
	// Single blog post or page
	wp_title(''); echo ' - ' . get_bloginfo('name');
} elseif ( is_category() ) {
	// Archive: Category
	echo get_bloginfo('name') . ' &raquo;  '; single_cat_title();
} elseif ( is_day() ) {
	// Archive: By day
	echo get_bloginfo('name') . ' &raquo; ' . get_the_time('d') . '. ' . get_the_time('F') . ' ' . get_the_time('Y');
} elseif ( is_month() ) {
	// Archive: By month
	echo get_bloginfo('name') . ' &raquo; ' . get_the_time('F') . ' ' . get_the_time('Y');
} elseif ( is_year() ) {
	// Archive: By year
	echo get_bloginfo('name') . ' &raquo; ' . get_the_time('Y');
} elseif ( is_search() ) {
	// Search
	echo get_bloginfo('name') . ' &raquo; &lsaquo;' . wp_specialchars($s, 1) . '&rsaquo;';
} elseif ( is_404() ) {
	// 404
	echo get_bloginfo('name') . '  &raquo; 404 - ERROR';
} else {
	// Everything else. Fallback
	bloginfo('name'); wp_title();
}
echo '</title>';
?>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<!-- leave this for stats -->
  
<?php wp_head(); ?>  

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/nav.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/plugins.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/template-style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/ui.tabs.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/custom-style.css" type="text/css" media="screen" />


<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/dropdowns.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/ui.tabs.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/ui.tabs.js"></script>

<script type="text/javascript">
 var $j = jQuery.noConflict();
          $j(document).ready(function(){
			$j('#container-4 > ul').tabs({ fx: { opacity: 'toggle', duration: 300 }});
			});
</script>
          

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
</head>
<body<?php if ( is_home() ) { ?> id="home"<?php } ?>>
<div id="page" class="clearfloat">
<div class="clearfloat">
  <div id="branding" class="left" onclick="location.href='<?php echo get_settings('home'); ?>';" style="cursor: pointer;">
    <div class="blogtitle" ><a href="<?php echo get_option('home'); ?>/">
      <?php //bloginfo('name'); ?>
      </a></div>
    <div class="description">
      <?php //bloginfo('description'); ?>
    </div>
  </div>
  <div class="right">
    <?php include (TEMPLATEPATH . '/searchform.php'); ?>
  </div>
</div>
<ul id="nav" class="clearfloat">
  <li><a href="<?php echo get_option('home'); ?>/" class="on">Home</a></li>
  <?php wp_list_pages('title_li='); ?>
</ul>
