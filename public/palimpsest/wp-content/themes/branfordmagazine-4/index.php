<?php get_header(); ?>
<?php include (TEMPLATEPATH.'/tools/get-theme-options.php'); ?>

<div id="content">
  <?php
 // Include tabs with the lead story 
	include(TEMPLATEPATH . '/includes/ui.tabs.php'); ?>
  <div id="leftcol">
    <?php 
// "Featured articles" module begins	  
	query_posts("showposts=$prinz_featurednumber;&cat=$prinz_featured;"); ?>
    <h3>
      <?php 
	// name of the "featured articles" category gets printed	  
	wp_list_categories("include=$prinz_featured;&title_li=&style=none"); ?>
    </h3>
    <?php while (have_posts()) : the_post(); ?>
    <div class="feature">
      <?php // This will show the image and link the image to the post. Alter the width and height (in both places) to your needs. ?>
      <?php postimage(250,90); ?>
      
      <a href="<?php the_permalink() ?>" rel="bookmark" class="title">
      <?php 
// title of the "featured articles"	  
	  the_title(); ?>
      </a>
      <p>
        <?php the_excerpt(); ?>
      </p>
    </div>
    <?php endwhile; ?>
  </div>
  <!--END LEFTCOL-->
  <div id="rightcol">
<?php
$display_categories = explode(",",$prinz_homecats);
for ($x = 0; $x < sizeof($display_categories); ++$x) {
?>
    <div class="clearfloat">
    <?php
    query_posts("showposts=$prinz_homecatsnumber&cat=".current($display_categories)."");
    $wp_query->is_category = false;
    $wp_query->is_archive = false;
    $wp_query->is_home = true;
	?>
      <?php // Name and link of each category headline gets printed	?>
      <h3><a href="<?php echo get_category_link(current($display_categories));?>"><?php single_cat_title(); ?></a></h3>
      <?php next($display_categories); ?>
      <?php while (have_posts()) : the_post(); ?>
      <?php // This will show the image and link the image to the post. Alter the width and height (in both places) to your needs. ?>
      <?php postimage(75,75); ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" class="title">
      <?php // this is where title of the article gets printed 
	  the_title(); ?>
      </a><br />
      <?php the_excerpt() ; ?>
      <?php endwhile; ?>
    </div>
    <?php } ?>
  </div>
  <!--END RIGHTCOL-->
</div>
<!--END CONTENT-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
