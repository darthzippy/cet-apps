<?php include (TEMPLATEPATH.'/tools/get-theme-options.php'); ?>
<!-- START TABBED SECTION -->

<div id="container-4">
  <ul>
    <li><a class="ui-tabs" href="#fragment-1">Lead Article</a></li>
    <li><a class="ui-tabs" href="#fragment-2">Recent Posts</a></li>
    <li><a class="ui-tabs" href="#fragment-3">About this Theme</a></li>
    <!-- Just add tabs as you like by following this scheme:
    <li><a class="ui-tabs" href="#fragment-X">Link name here</a></li> -->
  </ul>
  <!-- LEAD ARTICLE -->
  <div id="fragment-1">
    <ul id="leadarticle">
      <?php 
// Lead Story module begins 
   query_posts("cat=$prinz_lead;&showposts=$prinz_leadnumber;"); ?>
      <?php while (have_posts()) : the_post(); ?>
      <?php // here the thumbnail image gets automatically generated fron the posts own image gallery ?>
      <?php postimage(300,200); ?>
      <h3>
        <?php 
	// this is where the name of the Lead Story category gets printed	  
	wp_list_categories("include=$prinz_lead;&title_li=&style=none"); ?>
      </h3>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="title">
      <?php 
// this is where the title of the Lead Story gets printed	  
	the_title(); ?>
      </a>
      <?php 
// this is where the excerpt of the Lead Story gets printed	  
	the_excerpt() ; ?> <span class="read-on"> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
        <?php _e('[continue reading...]','branfordmagazine'); ?>
        </a> </span>
      <?php endwhile; ?>
    </ul>
  </div>
  <!-- END LEAD ARTICLE -->
  <!-- RECENT POSTS -->
  <div id="fragment-2" class="bullets">
    <h3 class="title">Recent Posts</h3>
    <p>To show the recent posts is just one thing you can use this tabbed section
      for. There are many more. It&acute;s up to your creativity.</p>
    <?php wp_get_archives('type=postbypost&limit=7'); ?>
  </div>
  <!-- END RECENT POSTS -->
  <!-- ABOUT -->
  <div id="fragment-3">
    <ul class="about">
      <h3 class="title">About this Theme</h3>
      <p>The first version of this theme back in January 2008 was  inspired by the great magazine style themes of Brian
        Gardner and Darren Hoyt. I took those elements that I liked the most
        in every theme and combined them together in one single theme. The different
        page templates are inspired by Brian Gardners
        &quot;Revolution&quot; theme, other elements are taken from  &quot;Mimbo&quot; by Darren Hoyt. The Tabbed section
        is created by using jQuery ui.tabs by Klaus Hartl (stilbuero.de).</p>
      <p>The Name of the theme was inspired by the famous American jazz sax-player,
        Branford Marsalis. Although I&acute;m German, I decided to present this
        theme in english in order to make it available for a greater audience.</p>
      <p>If you detect any bugs, please let
        me know. If you use this theme, please let me also know and make sure
        the copyright remains as it is. </p>
      <p><strong>Find further information, tutorials, support forum, demo and download <a href="http://www.michaeloeser.de/branfordmagazine/0053" target="_blank">on my Website.</a></strong></p>
    </ul>
  </div>
  <!-- END ABOUT -->
</div>
<!-- END TABBED SECTION -->
