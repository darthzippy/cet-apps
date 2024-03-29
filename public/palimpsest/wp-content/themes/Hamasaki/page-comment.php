<?php
/*
Template Name: Page with Comments
*/
get_header(); ?>

<div id="content-wrap">
  <div id="content">
    <div class="gap">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post" id="post-<?php the_ID(); ?>">
        <h2>
          <?php the_title(); ?>
        </h2>
        <div class="entry">
          <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        </div>
      </div>

      <?php comments_template(); ?>

      <?php endwhile; endif; ?>
      <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
    </div>
    <!-- /gap -->
  </div>
  <!-- /content -->
</div>
<!-- /content-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
