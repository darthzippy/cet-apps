<?php get_header(); ?>

<div id="content-wrap">
  <div id="content">
    <div class="gap">
      <?php if ( $paged < 2 ) {  // Do stuff specific to first page  ?>
      <?php if (have_posts()) : ?>
      <?php $my_query = new WP_Query('showposts=1');
  while ($my_query->have_posts()) : $my_query->the_post();
  $do_not_duplicate = $post->ID;?>
      <div class="post lastlast clearfix" id="post-<?php the_ID(); ?>">
        <?php
$id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0];
?>
        <div class="tumbr" style="z-index:2;margin-left: 10px;float:right; width: 295px; height: 290px; background: url(<?php if($image_src != '') { echo $image_src; } else { ?><?php bloginfo('template_directory'); ?>/images/no-img.gif<?php } ?>) 0 0 no-repeat; content: ".";"> </div>
        
        <div class="superlast clearfix">
        <div class="superdate">
        <span class="catr">
          <?php the_category(', ') ?>
          </span> <span class="timr">
          <?php the_time('F jS, Y') ?>
          </span> <span class="author">by
          <?php the_author_posts_link() ?>
          </span>
		</div>
        
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
          <?php the_title(); ?>
          </a></h2>
        <div class="entry">
          <?php //the_content_rss('', TRUE, '', 70); ?>
          <?php the_excerpt_rss('Read the rest of this entry &rarr;  '); ?> <?php edit_post_link('e', '<span class="editr">[', ']</span>'); ?>
        </div>
        <div class="metameta"><span class="commr"><?php comments_popup_link('No Comments', 'Comment (1)', 'Comments (%)'); ?></span></div>
      
      </div>
      <br class="clear" />
      
      </div>
      <?php endwhile; ?>
      <div class="superflow">
      <?php
            $counter = 0; $counter2 = 0;

      
       if (have_posts()) : while (have_posts()) : the_post(); 
      
      
      $counter++; $counter2++;
      
  if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>
     <div class="posties <?php if ($counter == 1) { echo 'leftside'; } else { echo 'rightside'; $counter = 0; } ?>" id="post-<?php the_ID(); ?>">
       <div class="postmetadata">
       <span class="timr"><?php the_time('d m y') ?></span> &#8226; <span class="catr"><?php the_category(', ') ?>
        </div>  
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
          <?php the_title(); ?>
          </a></h2>
        <div class="entry">

		<p><?php
						$texter = get_the_excerpt();
						if(strlen($texter ) > 220) {
						$texter = substr($texter , 0, 220);
						}
						echo ''.$texter.'[...]'; 
						?>
						</p>
        </div>
        <div class="metameta"> 
        <span class="more"><a href="<?php the_permalink(); ?>" title="Go to <?php the_title(); ?>">Read More &rarr;</a></span>
          <?php edit_post_link('e', '<span class="editr">[', ']</span>'); ?>
          <span class="commr">
          <?php comments_popup_link('No Comments', 'Comment (1)', 'Comments (%)'); ?>
          </span> </div>
      </div>
      <?php endwhile;  endif; ?>
      <br class="clear" />
      <div class="navigation">
        <div class="alignleft">
          <?php next_posts_link('&larr; Previous Entries') ?>
        </div>
        <div class="alignright">
          <?php previous_posts_link('Next Entries &rarr;') ?>
        </div>
      </div>
      
      
      
      <div class="box">
      <?php
      		if(get_settings('hamasaki_featuredcats')!='')
		{ 
			$cats_on_featured = 'cat='. get_settings('hamasaki_featuredcats');
		}	

	?>
                   <div class="featured">
 
 <?php $my_cat = new WP_Query('showposts=1&'.$cats_on_featured); ?>
			<?php while ($my_cat->have_posts()) : $my_cat->the_post(); ?>
          	<h3 class="title"><span><?php the_category(', ') ?></span></h3>
		<?php endwhile; ?>

 <?php $my_query = new WP_Query('showposts=2&'.$cats_on_featured); ?>

			<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
 
 				<div class="featured-post" id="post-<?php the_ID(); ?>">
                 <div class="post-content">		
						<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    	<p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?></p>
                  </div>
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
<br class="clear" />                    
                  <p class="posted"><?php edit_post_link('e', '<span class="editr">[', ']</span>'); ?><span class="comments"><?php comments_popup_link('Comments (0)', 'Comments (1)', 'Comments (%)'); ?></span></p>
                  
				</div><!--/post-->

		<?php endwhile; ?>
        
            </div><!--/featured_posts-->
                        
</div><!--/box-->

      
      
      </div> <!-- /.superflow -->
      <?php else : ?>
      <h2 class="center">Not Found</h2>
      <p class="center">Sorry, but you are looking for something that isn't here.</p>
      <?php include (TEMPLATEPATH . "/searchform.php"); ?>
      <?php endif; ?>
      <?php } else { // Do stuff specific to non-first page ?>
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

      <?php endwhile;  ?>
      <div class="navigation">
        <div class="alignleft">
          <?php next_posts_link('&larr; Previous Entries') ?>
        </div>
        <div class="alignright">
          <?php previous_posts_link('Next Entries &rarr;') ?>
        </div>
      </div>
      <?php } ?>
</div> <!-- /gap -->
</div> <!-- /content -->
</div> <!-- /content-wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>