<?php
// check functions
  if ( function_exists('wp_list_bookmarks') ) //used to check WP 2.1 or not
    $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' and post_status = 'publish'");
	else
    $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
  if (0 < $numposts) $numposts = number_format($numposts); 
	$numcmnts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
		if (0 < $numcmnts) $numcmnts = number_format($numcmnts);
// ----------------

function J_ShowAbout() { ?>

<li class="about">
  <h3>About</h3>
  <p>The Second and the next episodes my Ayumi Hamasaki themes series. Hamasaki is mix coloumns layout themes, I hope you like and enjoy it. Any feedback are welcome ^_*</p>
  <p class="stats">Stats: <span class="catr"><a title="<?php global $numcmnts;echo $numcmnts;?> Post">
    <?php global $numposts;echo $numposts; ?>
    </a> Posts</span>, <span class="commr"><a title="<?php global $numcmnts;echo $numcmnts;?> Comments">
    <?php global $numcmnts;echo $numcmnts;?>
    </a></span> Comments</p>
</li>
<?php }	function J_ShowRecentPosts() {?>
<li class="boxr">
  <h3>Recent Post</h3>
  <ul>
    <?php wp_get_archives('type=postbypost&limit=10');?>
  </ul>
</li>
<?php }	?>
<?php

// WIDEGT OPTIONS
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
			'name'=>'Sidebar Right Left'
	));
	register_sidebar(array(
			'name'=>'Ad Place (120x600)'
	));
	register_sidebar(array(
		'name'=>'Ad Place (468x60) [Only 1 Widget Please]',
		'before_widget' => '<div class="inner1">', // Removes <li>
		'after_widget' => '</div>', // Removes </li>
		'before_title' => '<h3 class="468-header">', // Replaces <h2>
		'after_title' => '</h3>', // Replaces </h2>
	));
}

$jh_trackbacks = array();
$jh_comments = array();

function split_comments( $source ) {

    if ( $source ) foreach ( $source as $comment ) {

        global $jh_trackbacks;
        global $jh_comments;

        if ( $comment->comment_type == 'trackback' || $comment->comment_type == 'pingback' ) {
            $jh_trackbacks[] = $comment;
        } else {
            $jh_comments[] = $comment;
        }
    }
}

//Theme Options Page
include_once(TEMPLATEPATH . '/hamasaki-options.php');

/* WordPress 2.7 and Later on */
add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
	if(!function_exists('wp_list_comments')) 	$file = TEMPLATEPATH . '/old.comments.php';
	return $file;
}

/**
 * count for Trackback, pingback, comment, pings
 *
 * use it:
 * fb_comment_type_count('ping');
 * fb_comment_type_count('comment');
 */
if ( !function_exists('fb_comment_type_count') ) {
	function fb_get_comment_type_count($type='all', $post_id = 0) {
		global $cjd_comment_count_cache, $id, $post;
 
		if ( !$post_id )
			$post_id = $post->ID;
		if ( !$post_id )
			return;
 
		if ( !isset($cjd_comment_count_cache[$post_id]) ) {
			$p = get_post($post_id);
			$p = array($p);
			update_comment_type_cache($p);
		}
 
		if ( $type == 'pingback' || $type == 'trackback' || $type == 'comment' )
			return $cjd_comment_count_cache[$post_id][$type];
		elseif ( $type == 'pings' )
			return $cjd_comment_count_cache[$post_id]['pingback'] + $cjd_comment_count_cache[$post_id]['trackback'];
		else
			return array_sum((array) $cjd_comment_count_cache[$post_id]);
	}
 
	// comment, trackback, pingback, pings
	function fb_comment_type_count($type = 'all', $post_id = 0) {
		echo fb_get_comment_type_count($type, $post_id);
	}
}

function update_comment_type_cache(&$queried_posts) {
global $cjd_comment_count_cache, $wpdb;

if ( !$queried_posts )
return $queried_posts;

foreach ( (array) $queried_posts as $post )
if ( !isset($cjd_comment_count_cache[$post->ID]) )
$post_id_list[] = $post->ID;

if ( $post_id_list ) {
$post_id_list = implode(',', $post_id_list);

foreach ( array('','pingback', 'trackback') as $type ) {
$counts = $wpdb->get_results("SELECT ID, COUNT( comment_ID ) AS ccount
FROM $wpdb->posts
LEFT JOIN $wpdb->comments ON ( comment_post_ID = ID AND comment_approved = '1' AND comment_type='$type' )
WHERE post_status = 'publish' AND ID IN ($post_id_list)
GROUP BY ID");

if ( $counts ) {
if ( '' == $type )
$type = 'comment';
foreach ( $counts as $count )
$cjd_comment_count_cache[$count->ID][$type] = $count->ccount;
}
}
}
return $queried_posts;
}


function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> <span><?php comment_date('d m y'); ?></span>
<?php } 

function list_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>" class="thechild">
      <div class="leftarea cleft">
         <?php echo get_avatar($comment, 52); ?>
	  </div>
      <div class="rightarea cright">      
      <div class="comment-author vcard by">
         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
    </div>
      </div>
   </li>               
<?php
        }
?>