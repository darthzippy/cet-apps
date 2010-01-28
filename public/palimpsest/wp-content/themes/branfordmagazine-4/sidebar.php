<!-- SIDEBAR -->
<?php include (TEMPLATEPATH.'/tools/get-theme-options.php'); ?>
<div id="sidebar">
  <ul id="sidelist">
    <?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Regular Sidebar') ) : ?>
      
    <?php
// this is where 10 headlines from the current category get printed	  
if ( is_single() ) :
global $post;
$categories = get_the_category();
foreach ($categories as $category) :
?>
    <li>
      <h2><?php _e('More from this category','branfordmagazine');?></h2>
      <ul class="bullets">
        <?php
$posts = get_posts('numberposts=10&category='. $category->term_id);
foreach($posts as $post) :
?>
        <li><a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
          </a></li>
        <?php endforeach; ?>
        <li><strong><a href="<?php echo get_category_link($category->term_id);?>" title="<?php _e('View all posts filed under','branfordmagazine');?> <?php echo $category->name; ?>"><?php _e('Archive for','branfordmagazine');?> '<?php echo $category->name; ?>' &raquo;</a></strong></li>
      </ul>
    </li>
    <?php endforeach; endif ; ?>
    <?php if ( is_home() ) { ?>
    <li>
      <h3>
        <?php 
	// this is where the name of the News (or whatever) category gets printed	  
	wp_list_categories("include=$prinz_lead;&title_li=&style=none"); ?>
      </h3>
      <?php 
// this is where the last five headlines are pulled from the News (or whatever) category but not the first one (offset=1) since this is already displayed as leadarticle. 
		query_posts("offset=1&cat=$prinz_lead;&showposts=$prinz_sidenewsnumber;");
		?>
      <ul class="bullets">
        <?php while (have_posts()) : the_post(); ?>
        <li><a href="<?php the_permalink() ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></li>
        <?php endwhile; ?>
      </ul>
    </li>
    <?php } ?>
    <li>
      <h3><?php _e('Browse Categories','branfordmagazine');?></h3>
      <ul class="subnav">
       <?php wp_list_categories("exclude=$prinz_sidecats&orderby=name&title_li=&hide_empty=1"); ?>
       	    
      </ul>
    </li>
    <li>
      <h3><?php _e('Ads &amp; Sponsors','branfordmagazine');?></h3>
<!-- GOOGLE ADSENSE GOES HERE -->
     <script type="text/javascript"><!--
google_ad_client = "pub-5141458166056089";
/* 250x250, Erstellt 04.12.09 */
google_ad_slot = "6728694249";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<!-- END GOOGLE ADSENSE -->
     </li>
    <li>
      <h3><?php _e('Browse Archives','branfordmagazine');?></h3>
     <select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
  <option value=""><?php echo attribute_escape(__('Select Month')); ?></option> 
  <?php wp_get_archives('type=monthly&format=option&show_post_count=0'); ?> </select>

    </li>
    <li>
      <h3><?php _e('Stay informed','branfordmagazine');?></h3>
      <ul class="feed">
        <li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
        <li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments RSS)</a></li>
      </ul>
    </li>
    <li>
      <h3><?php _e('Who writes','branfordmagazine');?></h3>
      <ul class="bullets noborder">
        <?php wp_list_authors ('exclude_admin=0&show_fullname=1&hide_empty=1'); ?>
      </ul>
    </li>
  <?php endif; ?>
  </ul>
  <!--END SIDELIST-->
</div>
<!--END SIDEBAR-->
