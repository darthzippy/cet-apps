<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>

<div id="content-wrap">
  <div id="content">
    <div class="gap archives post">
      <h2>Archives by Month:</h2>
      <ul>
        <?php wp_get_archives('type=monthly'); ?>
      </ul>
      <h2>Archives by Subject:</h2>
      <ul>
        <?php wp_list_categories(); ?>
      </ul>
    </div>
    <!-- /gap -->
  </div>
  <!-- /content -->
</div>
<!-- /content-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
