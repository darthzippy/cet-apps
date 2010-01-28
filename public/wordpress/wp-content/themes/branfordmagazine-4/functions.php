<?php
// Prepare for localization
load_theme_textdomain ('branfordmagazine');

// include the theme options
include(TEMPLATEPATH."/tools/theme-options.php");

// include the widgetized areas (The Widgets)
include(TEMPLATEPATH."/tools/widgetized-areas.php");


// Function to get WordPress image attachment and use tim thumb to rezize and crob
// usage: < ?php postimage(300,200); ? > or whatever dimensions you want
// requires tim thumb in your themes /scripts folder and at least WordPress 2.9

function postimage($width,$height) {
    $scriptpath = get_bloginfo('template_directory'); 
    $attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
    if (empty ($attachments)) {
        echo '';
    }
    else {
    $img = array_shift($attachments);
    $imagelink = wp_get_attachment_image_src($img->ID,'full');
    $image = $imagelink[0];
		echo '<a class="alignleft" href="';
		echo the_permalink();
        echo '" rel="bookmark" title="Permanent Link to ';
		echo the_title();
		echo '">';
        echo '<img src="'.$scriptpath.'/scripts/timthumb.php?src='.$image.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1" alt="';
		echo the_title();
		echo '" />';
		echo '</a>';
}
}
?>
<?php
//modify the excerpt lenght in the "featured articles" section on the homepage
add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
    if(in_category(4)) { // put here the ID (4 by default) of the category used for the "featured" articles
        return 25; // put the number of words (default 25)
    } else {
        return 55; // show 55 words for any other excerpt (or change this number also)
    }
}
?>
<?php
// PRiNZ Theme scripts
	
//add_action('wp_enqueue_scripts', 'prinz_scripts');

//function prinz_scripts() {
	//wp_enqueue_script('jquery');
	//wp_enqueue_script('superfish', get_bloginfo('template_url').'/scripts/superfish/superfish.js', array('jquery'), '1.4.8', true);
	//wp_enqueue_script('supersubs', get_bloginfo('template_url').'/scripts/superfish/supersubs.js', array('jquery'), '1.4.8', true);
	//wp_enqueue_style('superfish', get_bloginfo('template_url').'/scripts/superfish/superfish.css', false, '1.4.8', 'all' );
	
	//wp_enqueue_script('prettyPhoto', get_bloginfo('template_url').'/scripts/pretty/jquery.prettyPhoto.js', array('jquery'), '2.5', true);
	//wp_enqueue_style('pretty', get_bloginfo('template_url').'/scripts/pretty/prettyPhoto.css', false, '2.5', 'all' );
//}?>