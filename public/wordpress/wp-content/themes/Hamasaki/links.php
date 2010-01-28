<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>

<div id="content-wrap">
  <div id="content">
    <div class="gap">
      <h2>Links:</h2>
      <ul>
        <?php get_links_list(); ?>
      </ul>
    </div>
    <!-- /gap -->
  </div>
  <!-- /content -->
</div>
<!-- /content-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
