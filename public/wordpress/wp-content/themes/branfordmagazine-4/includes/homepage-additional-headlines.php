<div id="additional-headlines">
<?php while (have_posts()) : the_post(); ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" class="title">
      <?php // this is where title of the article gets printed 
	  the_title(); ?>
      </a><br />
      <?php endwhile; ?>
</div>