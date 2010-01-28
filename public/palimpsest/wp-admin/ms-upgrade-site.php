<?php
require_once('admin.php');

if ( !is_multisite() )
	wp_die( __('Multisite support is not enabled.') );

require_once( ABSPATH . WPINC . '/http.php' );

$title = __('Upgrade Site');
$parent_file = 'ms-admin.php';
require_once('admin-header.php');

if ( !is_super_admin() )
	wp_die( __('You do not have permission to access this page.') );

echo '<div class="wrap">';
screen_icon();
echo '<h2>'.__('Upgrade Site').'</h2>';

$action = isset($_GET['action']) ? $_GET['action'] : 'show';

switch ( $action ) {
	case "upgrade":
		$n = ( isset($_GET['n']) ) ? intval($_GET['n']) : 0;

		if ( $n < 5 ) {
			global $wp_db_version;
			update_site_option( 'wpmu_upgrade_site', $wp_db_version );
		}

		$blogs = $wpdb->get_results( "SELECT * FROM {$wpdb->blogs} WHERE site_id = '{$wpdb->siteid}' AND spam = '0' AND deleted = '0' AND archived = '0' ORDER BY registered DESC LIMIT {$n}, 5", ARRAY_A );
		if ( is_array( $blogs ) ) {
			echo "<ul>";
			foreach ( (array) $blogs as $details ) {
				if ( $details['spam'] == 0 && $details['deleted'] == 0 && $details['archived'] == 0 ) {
					$blog_prefix = $wpdb->get_blog_prefix( $details[ 'blog_id' ] );
					$siteurl = $wpdb->get_var( "SELECT option_value from {$blog_prefix}options WHERE option_name = 'siteurl'" );
					echo "<li>$siteurl</li>";
					$response = wp_remote_get( trailingslashit( $siteurl ) . "wp-admin/upgrade.php?step=1", array( 'timeout' => 120, 'httpversion' => '1.1' ) );
					if ( is_wp_error( $response ) )
						wp_die( "<strong>Warning!</strong> Problem upgrading {$siteurl}. Your server may not be able to connect to blogs running on it.<br /> Error message: <em>" . $response->get_error_message() ."</em>" );
					do_action( 'after_mu_upgrade', $response );
					do_action( 'wpmu_upgrade_site', $details[ 'blog_id' ] );
				}
			}
			echo "</ul>";
			?><p><?php _e("If your browser doesn't start loading the next page automatically click this link:"); ?> <a class="button" href="ms-upgrade-site.php?action=upgrade&amp;n=<?php echo ($n + 5) ?>"><?php _e("Next Blogs"); ?></a></p>
			<script type='text/javascript'>
			<!--
			function nextpage() {
				location.href = "ms-upgrade-site.php?action=upgrade&n=<?php echo ($n + 5) ?>";
			}
			setTimeout( "nextpage()", 250 );
			//-->
			</script><?php
		} else {
			echo '<p>'.__('All Done!').'</p>';
		}
	break;
	case 'show':
	default:
		?><p><?php _e("You can upgrade all the blogs on your site through this page. It works by calling the upgrade script of each blog automatically. Hit the link below to upgrade."); ?></p>
		<p><a class="button" href="ms-upgrade-site.php?action=upgrade"><?php _e("Upgrade Site"); ?></a></p><?php
		do_action( 'wpmu_upgrade_page' );
	break;
}
?>
</div>

<?php include('admin-footer.php'); ?>
