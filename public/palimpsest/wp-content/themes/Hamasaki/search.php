<?php get_header(); ?>

<div id="content-wrap">
  <div id="content">
    <div class="gap">
      <?php if (have_posts()) : ?>
      <h2 class="pagetitle">Search Results</h2>
      <?php while (have_posts()) : the_post(); ?>
    <div class="post double" id="post-<?php the_ID(); ?>">
        
        <div class="post-image">
					<?php
$id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0];
?>
        <div class="tumbr" style="border: 1px solid #333; width: 140px;height: 110px;background: url(<?php if($image_src != '') { echo $image_src; } else { ?><?php bloginfo('template_directory'); ?>/images/no-image.gif<?php } ?>) 0 0 no-repeat;"> </div>
        			                    
                    </div>        
     <div class="postin">   
     <div class="postmetadata">
       <span class="timr"><?php the_time('d m y') ?></span> &#8226; <span class="catr"><?php the_category(', ') ?>
        </div>  

        <h2><a class="thetip" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
          <?php the_title(); ?>
          </a></h2>
        <div class="entry">
          <?php the_excerpt_rss('Read the rest of this entry &rarr;  '); ?> <?php edit_post_link('e', '<span class="editr">[', ']</span>'); ?>
        </div>
        <div class="metameta">
        <span class="tages">
        <?php if(function_exists('the_tags')): the_tags(); endif;?>
        </span>
        
          <span class="commr">
          <?php comments_popup_link('No Comments', 'Comment (1)', 'Comments (%)'); ?>
          </span> </div>
      </div>       </div>
      
      <?php endwhile; ?>
      <div class="navigation">
        <div class="alignleft">
          <?php next_posts_link('&larr; Previous Entries') ?>
        </div>
        <div class="alignright">
          <?php previous_posts_link('Next Entries &rarr;') ?>
        </div>
      </div>
      <?php else : ?>
      <h2 class="center">No posts found. Try a different search?</h2>
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>
      <?php endif; ?>
    </div>
    <!-- /gap -->
  </div>
  <!-- /content -->
</div>
<!-- /content-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
