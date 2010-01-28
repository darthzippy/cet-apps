<?php
function hamasaki_add_theme_page() {
	if ( $_GET['page'] == basename(__FILE__) ) {
	
	    // save settings
		if ( 'save' == $_REQUEST['action'] ) {

			update_option( 'hamasaki_sortpages', $_REQUEST[ 'data_sortpages' ] );
			update_option ('hamasaki_description', $_REQUEST['hamasaki_desc']  );
			if( isset( $_POST[ 'excludepages' ] ) ) { 
			update_option( 'hamasaki_excludepages', implode(',', $_POST['excludepages']) ); } 			else { 
			delete_option( 'hamasaki_excludepages' ); }
			if( isset( $_POST[ 'excludecats' ] ) ) { 
			update_option( 'hamasaki_excludecats', implode(',', $_POST['excludecats']) ); } 			else { 
			delete_option( 'hamasaki_excludecats' ); }
			if( isset( $_POST[ 'featuredcats' ] ) ) { 
			update_option( 'hamasaki_featuredcats', implode(',', $_POST['featuredcats']) ); } 			else { 
			delete_option( 'hamasaki_featuredcats' ); }

			// goto theme edit page
			header("Location: themes.php?page=hamasaki-options.php&saved=true");
			die;

  		// reset settings
		} else if( 'reset' == $_REQUEST['action'] ) {

			delete_option( 'hamasaki_sortpages' );			
			delete_option( 'hamasaki_excludepages' );
			delete_option( 'hamasaki_excludecats' );
			delete_option( 'hamasaki_featuredcats' );
			delete_option( 'hamasaki_description' );
			// goto theme edit page
			header("Location: themes.php?page=hamasaki-options.php&reset=true");
			die;

		}
	}
    add_theme_page("Hamasaki Options", "Hamasaki Options", 'edit_themes', basename(__FILE__), 'hamasaki_theme_page');
}

function hamasaki_theme_page() {

	// --------------------------
	// Hamasaki theme page content
	// --------------------------

	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Hamasaki Theme: Settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>Hamasaki Theme: Settings reset.</strong></p></div>';
	
?>
<style>
.wrap {
}
.block {
	margin:1em;
	padding:1em;
	line-height:1.6em;
}
table tr td {
	border:#ddd 1px solid;
	font-family:Verdana, Arial, Serif;
	font-size:0.9em;
}
h4 {
	font-size:1.3em;
	color:#669;
	font-weight:bold;
	margin:0;
	padding:10px 0;
}
</style>
<div class="wrap">
<h2>Hamasaki 1.0</h2>
<p>Welcome to <strong>Hamasaki Theme Options</strong>, you can configure the theme on this page. If you find something goes wrong just leave message to my themes pages.</p>
<form method="post">
  <!-- blog layout options -->
  <fieldset class="options">
  <legend>Theme Settings</legend>
  <p>Configure "Hamasaki" to work as you desire.</p>
  <table width="100%" cellspacing="5" cellpadding="10" class="editform">
    <tr>
      <td valign="top" style="border:0px;margin:0;padding:0;"><input type="hidden" name="action" value="save" />
        <?php pn_input( "save", "submit", "", "Save Settings" );?>
      </td>
    </tr>
    <tr valign="top">
      <td align="left"><h3>Master Navigation</h3>
        <?php
	pn_heading("Navigation Pages");		
		global $wpdb;
		if (function_exists('wp_list_bookmarks')) //WP 2.1 or greater
			$results = $wpdb->get_results("SELECT ID, post_title from $wpdb->posts WHERE post_type='page' AND post_parent=0 ORDER BY post_title");
		else
			$results = $wpdb->get_results("SELECT ID, post_title from $wpdb->posts WHERE post_status='static' AND post_parent=0 ORDER BY post_title");
				
		$excludepages = explode(',', get_settings('hamasaki_excludepages'));
				
		if($results) {				
			_e('<br/>Exclude the Following Pages from the Top Navigation <br/><br/>');
			foreach($results as $page) {
				echo '<input type="checkbox" name="excludepages[]" value="' . $page->ID . '"';
				if(in_array($page->ID, $excludepages)) { echo ' checked="checked"'; }
				echo ' /> <a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a><br />';
			}		
		}		
		_e('<br/><br/>');
		pn_heading('Sort by');
		
		pn_input( "data_sortpages", "radio", "Page Title ?", "post_title", get_settings( 'hamasaki_sortpages' ) );		
		pn_input( "data_sortpages", "radio", "Date ?", "post_date", get_settings( 'hamasaki_sortpages' ) );		
		pn_input( "data_sortpages", "radio", "Page Order ?", "menu_order", get_settings( 'hamasaki_sortpages' ) );
		echo "(Each Page can be given a page order number, from the wordpress admin, edit page area)";
		echo "<br/>";			
?>
        <h3>Category Navigation</h3>
        <?php
	pn_heading('Exclude Categories From Main Menu');
				
$excludecats = explode(',', get_settings('hamasaki_excludecats'));

$cats = get_categories('orderby=name'); 
   foreach($cats as $cat){
       echo '<br /><input type="checkbox" name="excludecats[]" value="' . $cat->cat_ID . '"';						   if(in_array($cat->cat_ID, $excludecats)) { echo ' checked="checked"'; }       
       echo ' /> <a href="' . get_category_link($cat->cat_ID) . '">' . $cat->name . '</a>';
   }				


?>


<h3>Category Featured</h3>
        <?php
	pn_heading('Category Featured on the bottom');
				
$featuredcats = explode(',', get_settings('hamasaki_featuredcats'));
?>
<ul>
<?php
$fcats = get_categories('orderby=name'); 
   foreach($fcats as $fcat){
       echo '<li><input type="radio" name="featuredcats[]" value="' . $fcat->cat_ID . '"';						   if(in_array($fcat->cat_ID, $featuredcats)) { echo ' checked="checked"'; }       
       echo ' /> <a href="' . get_category_link($fcat->cat_ID) . '">' . $fcat->name . '</a></li>';
   }				


?>
</ul>

      </td>
    </tr>
    <tr>
      <td valign="top" style="border:0px;margin:0;padding:0;"><input type="hidden" name="action" value="save" />
        <?php pn_input( "save", "submit", "", "Save Settings" );?>
      </td>
    </tr>
  </table>
  </fieldset>
</form>
<form method="post">
  <fieldset class="options">
  <legend>Reset</legend>
  <p>If for some reason you want to uninstall "Hamasaki" then press the reset button to clean things up in the database.</p>
  <p>You have to make sure to delete the theme folder, if you want to completely remove the theme.</p>
  <?php

	pn_input( "reset", "submit", "", "Reset Settings" );
	
?>
  </div>
  <input type="hidden" name="action" value="reset" />
</form>
<?php
}
add_action('admin_menu', 'hamasaki_add_theme_page');


function pn_input( $var, $type, $description = "", $value = "", $selected="" ) {

	// ------------------------
	// add a form input control
	// ------------------------
	
 	echo "\n";
 	
	switch( $type ){
	
	    case "text":

	 		echo "<input name=\"$var\" id=\"$var\" type=\"$type\" style=\"width: 60%\" class=\"textbox\" value=\"$value\" />";
			
			break;
			
		case "submit":
		
	 		echo "<p class=\"submit\"><input name=\"$var\" type=\"$type\" value=\"$value\" /></p>";

			break;

		case "option":
		
			if( $selected == $value ) { $extra = "selected=\"true\""; }

			echo "<option value=\"$value\" $extra >$description</option>";
		
		    break;
  		case "radio":
  		
			if( $selected == $value ) { $extra = "checked=\"true\""; }
  		
  			echo "<label><input name=\"$var\" id=\"$var\" type=\"$type\" value=\"$value\" $extra /> $description</label><br/>";
  			
  			break;
  			
		case "checkbox":
		
			if( $selected == $value ) { $extra = "checked=\"true\""; }

  			echo "<label for=\"$var\"><input name=\"$var\" id=\"$var\" type=\"$type\" value=\"$value\" $extra /> $description</label><br/>";

  			break;

		case "textarea":
		
		    echo "<textarea name=\"$var\" id=\"$var\" style=\"width: 80%; height: 10em;\" class=\"code\">$value</textarea>";
		
		    break;
	}

}

function pn_heading( $title ) {

	// ------------------
	// add a table header
	// ------------------

   echo "<h4>" .$title . "</h4>";

}

define('HEADER_IMAGE', '%s/images/you.jpg'); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 300);
define('HEADER_IMAGE_HEIGHT', 153);
define('HEADER_TEXTCOLOR', 'fff');

function admin_header_style() { ?>
<style type="text/css">
#ayu,#headimg {
        background: #fff url(<?php header_image(); ?>) right top no-repeat;
        height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
}
#headimg h1, #headimg #desc {
	display: none;
}
</style>

<?php }

function header_style() { ?>

<style type="text/css">
#ayu {
}

<?php if ( 'blank' == get_header_textcolor() ) { ?>

#ayu h1 {
        display: none;
}

<?php }else{ ?>

#ayu h1 a{
        color: #<?php header_textcolor(); ?>;
}
#ayu .description {
        display: none;
}
<?php } ?>

</style>

<?php }

if ( function_exists('add_custom_image_header') ) {
  add_custom_image_header('header_style', 'admin_header_style');
} 
?>
