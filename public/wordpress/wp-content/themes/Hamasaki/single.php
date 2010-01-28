<?php get_header(); ?>

<div id="content-wrap">
  <div id="content">
    <div class="gap">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post" id="post-<?php the_ID(); ?>">
        <h2><?php the_title(); ?></h2>
        <div class="entry">
          <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        </div>
      </div>


<div class="singlelis">
<h3>Post Metadata</h3>
      <div class="inn">
      <div class="leftarea">
      Date
      </div>
      <div class="rightarea">
      <span class="timr">
        <?php the_time('F jS, Y') ?>
        </span>
       </div>
       <br class="clear" />
       </div>
      <div class="inn">
      <div class="leftarea">
      Author
      </div>
      <div class="rightarea">
      <?php the_author() ?>
       </div>
       <br class="clear" />
       </div>
 
       <div class="inn">
      <div class="leftarea">
      Category
      </div>
      <div class="rightarea">
		 <span class="catr">
        <?php the_category(', ') ?> <?php edit_post_link('e', '<span class="editr">[', ']</span>'); ?>
        </span>
      </div>
       <br class="clear" />
       </div>
      
      <div class="inn">
      <div class="leftarea">
      Tags
      </div>
      <div class="rightarea">
		 <span class="catr">
        <?php the_tags(' ',', ') ?>
        </span>
      </div>
       <br class="clear" />
       </div>

      
      <div class="inn">
      <div class="leftarea">
           </div>
      <div class="rightarea">
    <?php if ($post->ping_status == "open") { ?>
    <span class="trackbackr"><a href="<?php trackback_url(display); ?>">Trackback <acronym title="Uniform Resource Identifier">URI</acronym></a></span>
    <?php } ?>
      </div>
       <br class="clear" />
       </div>
    <div class="inn">
      <div class="leftarea">
           </div>
      <div class="rightarea">
    <?php if ($post-> comment_status == "open") {?>
    <span class="commentsfeedr">
    <?php comments_rss_link('Comments RSS'); ?>
    </span>
    <?php }; ?>
          </div>
       <br class="clear" />
       </div>
       
</div>
      
	<?php comments_template('', true); ?>
      <?php endwhile; else: ?>
      <p>Sorry, no posts matched your criteria.</p>
      <?php endif; ?>

<br class="clear" />
      <div class="navigation">
        <div class="alignleft">
          <?php previous_post_link('&larr; %link') ?>
        </div>
        <div class="alignright">
          <?php next_post_link('%link &rarr;') ?>
        </div>
      </div>
      <br class="clear" />
    </div>
    <!-- /gap -->
  </div>
  <!-- /content -->
</div>
<!-- /content-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
