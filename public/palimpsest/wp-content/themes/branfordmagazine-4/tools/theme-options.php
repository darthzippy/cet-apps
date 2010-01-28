<?php

$themename = "BranfordMagazine";
$shortname = "prinz";

// Create theme options

$options = array (

				array(	"desc" => __("<h3>Michael Oeser DER PRiNZ - Information</h3>
										<p>If you want to stay updated on regular WordPress tipps & tricks please visit my <a href=\"http://www.michaeloeser.de\" title=\"www.michaeloeser.de\">Business Website (German)</a>, my <a href=\"http://www.der-prinz.com\" title=\"www.der-prinz.com\">Themes Website (English)</a> or subscribe via <a href=\"http://feeds.feedburner.com/michaeloeser\" title=\"RSS Feed\">RSS Feed</a> or <a href=\"http://feedburner.google.com/fb/a/mailverify?uri=michaeloeser\">email.</a><br />For all kind of issues concerning my themes I do offer support via my <a href=\"http://www.der-prinz.com/support-forum/\" title=\"Support Forum\">Support Forum</a> only.</p>
										<p><strong>INFO:</strong> All preset IDs are just examples and do match the categories in my demodatabase. In most cases they will not match the IDs in YOUR database!</p><hr /><br /><br />"),
						"type" => "nothing"),

				array(	"desc" => __("<h3>Setup the leadarticle</h3>
				<p>The leadarticle is the most recent newsarticle displayed in the tabbed area of the homepage</p>"),
						"type" => "nothing"),
						
				array(	"name" => __('Leadarticle category'),
						"desc" => __("Enter the ID of the category that will be used as the leadarticle category"),
						"id" => $shortname."_lead",
						"std" => __(""),
						"type" => "text"),
						
				array(	"name" => __('Leadarticle number of posts'),
						"desc" => __("Enter a number of posts displayed in the leadarticle (default = 1)"),
						"id" => $shortname."_leadnumber",
						"std" => __("1"),
						"type" => "text"),
						
				array(	"desc" => "<hr /><br /><br />",
						"type" => "nothing"),
						
				array(	"desc" => __("<h3>Setup the featured articles in the left column</h3>
				<p>The featured articles are the articles (three by default) in the left column of the homepage. They are taken from one specific category, typicallly called \"featured articles\"</p>"),
						"type" => "nothing"),

				array(	"name" => __('Featured articles category'),
						"desc" => __("Enter the ID of the category that will be used as the featured article category"),
						"id" => $shortname."_featured",
						"std" => __(""),
						"type" => "text"),
						
				array(	"name" => __('Featured articles number of posts'),
						"desc" => __("Enter a number of posts displayed in the featured articles (default = 3)"),
						"id" => $shortname."_featurednumber",
						"std" => __("3"),
						"type" => "text"),
						
				array(	"desc" => "<hr /><br /><br />",
						"type" => "nothing"),


				array(	"desc" => __("<h3>Setup the homepage middle column</h3>
				<p>In the middle column of the homepage all other categories are displayed. Always the most recent article from the categories defined here will be displayed</p>"),
						"type" => "nothing"),

				array(	"name" => __('Homepage categories'),
						"desc" => __("Enter the IDs of the categories separated by a comma (e.g. 3,5,7,8,9)"),
						"id" => $shortname."_homecats",
						"std" => __(""),
						"type" => "text"),

				array(	"name" => __('Homepage categories number of posts per category'),
						"desc" => __("Enter a number of posts per category displayed in the in the middle column of the homepage (default = 1)"),
						"id" => $shortname."_homecatsnumber",
						"std" => __("1"),
						"type" => "text"),
						
				array(	"desc" => "<hr /><br /><br />",
						"type" => "nothing"),
						
						
				array(	"desc" => __("<h3>Setup the Sidebar</h3>
				<p>Here you can define how many newsheadlines are displayed on the homepage sidebar and which categories should NOT appear in the list of categories. It makes sense not to display the \"featured\" and also the \"news\" category. But it´s up to you. If you use widgets in the sidebar then you don´t need to care about this section. Widgets will completely replace the default stuff.</p>"),
						"type" => "nothing"),
						
				array(	"name" => __('Number of news in the homepage sidebar'),
						"desc" => __("Enter the number of news you want to display (default = 5)"),
						"id" => $shortname."_sidenewsnumber",
						"std" => __("5"),
						"type" => "text"),

				array(	"name" => __('Sidebar categories to exclude'),
						"desc" => __("Enter the IDs of the categories separated by a comma (e.g. 4,6)"),
						"id" => $shortname."_sidecats",
						"std" => __("4,6"),
						"type" => "text"),
					
				array(	"desc" => "<hr /><br /><br />",
						"type" => "nothing"),

						
				array(	"desc" => __("<h3>Setup the 3-column page template</h3>
				<p>The 3-column page is a special template to display content from three different categories in a very prominent way.</p>"),
						"type" => "nothing"),
						
				array(	"name" => __('3 column page left side category'),
						"desc" => __("Enter the ID of the category that will be used in the left column of the 3-column page"),
						"id" => $shortname."_3col_left",
						"std" => __("5"),
						"type" => "text"),
						
				array(	"name" => __('3-column page left number of posts per category'),
						"desc" => __("Enter a number of posts displayed in the in the left column of the 3-column page (default = 1)"),
						"id" => $shortname."_3col_leftnum",
						"std" => __("1"),
						"type" => "text"),
						
				array(	"name" => __('3 column page middle category'),
						"desc" => __("Enter the ID of the category that will be used in the middle column of the 3-column page"),
						"id" => $shortname."_3col_middle",
						"std" => __("6"),
						"type" => "text"),
						
				array(	"name" => __('3-column page middle number of posts per category'),
						"desc" => __("Enter a number of posts displayed in the in the middle column of the 3-column page (default = 1)"),
						"id" => $shortname."_3col_middlenum",
						"std" => __("1"),
						"type" => "text"),
						
				array(	"name" => __('3 column page right side category'),
						"desc" => __("Enter the ID of the category that will be used in the right column of the 3-column page"),
						"id" => $shortname."_3col_right",
						"std" => __("8"),
						"type" => "text"),
						
				array(	"name" => __('3-column page right number of posts per category'),
						"desc" => __("Enter a number of posts displayed in the in the right column of the 3-column page (default = 1)"),
						"id" => $shortname."_3col_rightnum",
						"std" => __("1"),
						"type" => "text"),
						
				array(	"desc" => "<hr /><br /><br />",
						"type" => "nothing"),

							);
							
function mytheme_add_admin() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
                header("Location: themes.php?page=theme-options.php&saved=true");
                die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option( $value['id'] ); }
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        } else if ( 'reset_widgets' == $_REQUEST['action'] ) {
            $null = null;
            update_option('sidebars_widgets',$null);
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        }
    }
    add_theme_page($themename."Options", "BranfordMagazine Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved.','branfordmagazine').'</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset.','branfordmagazine').'</strong></p></div>';
    if ( $_REQUEST['reset_widgets'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('widgets reset.','branfordmagazine').'</strong></p></div>';
?>
<div class="wrap">
<?php if ( function_exists('screen_icon') ) screen_icon(); ?>
<h2><?php echo $themename; ?> Options</h2>
<form method="post" action="">
<table class="form-table">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
		case 'text':
		?>
		<tr valign="top">
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'branfordmagazine'); ?></label></th>
			<td>
				<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
				<?php echo __($value['desc'],'branfordmagazine'); ?>
			</td>
		</tr>
        <?php
		break;
		case 'textarea':
		$ta_options = $value['options'];
		?>
		<tr valign="top">
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'branfordmagazine'); ?></label></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])),'branfordmagazine');
					}else{
						echo __($value['std'],'branfordmagazine');
				}?></textarea><br /><?php echo __($value['desc'],'branfordmagazine'); ?></td>
		</tr>
        <?php
		break;
		case 'nothing':
		$ta_options = $value['options'];
		?>
		</table>
			<?php echo __($value['desc'],'branfordmagazine'); ?>
		<table class="form-table">
        <?php
		break;
		case 'radio':
		?>
		<tr valign="top">
			<th scope="row"><?php echo __($value['name'],'branfordmagazine'); ?></th>
			<td>
				<?php foreach ($value['options'] as $key=>$option) {
				$radio_setting = get_option($value['id']);
				if($radio_setting != ''){
					if ($key == get_option($value['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
				<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'] . $key; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><label for="<?php echo $value['id'] . $key; ?>"><?php echo $option; ?></label><br />
				<?php } ?>
			</td>
		</tr>
		<?php
		break;
		case 'checkbox':
		?>
		<tr valign="top">
			<th scope="row"><?php echo __($value['name'],'branfordmagazine'); ?></th>
			<td>
				<?php
					if(get_option($value['id'])){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				?>
				<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
				<label for="<?php echo $value['id']; ?>"><?php echo __($value['desc'],'branfordmagazine'); ?></label>
			</td>
		</tr>
        <?php
		break;
		default:
		break;
	}
}
?>
	</table>
	<p class="submit">
		<input name="save" type="submit" value="<?php _e('Save changes','branfordmagazine'); ?>" />
		<input type="hidden" name="action" value="save" />
	</p>
</form>
<form method="post" action="">
	<p class="submit">
		<input name="reset" type="submit" value="<?php _e('Reset','branfordmagazine'); ?>" />
		<input type="hidden" name="action" value="reset" />
	</p>
</form>
</div>
<?php
}
add_action('admin_menu' , 'mytheme_add_admin'); 
?>