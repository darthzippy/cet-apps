<?php
/**
 * WordPress Administration Bootstrap
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * In WordPress Administration Panels
 *
 * @since unknown
 */
if ( !defined('WP_ADMIN') )
	define('WP_ADMIN', TRUE);

require_once(dirname(dirname(__FILE__)) . '/wp-load.php');

if ( get_option('db_upgraded') ) {
	$wp_rewrite->flush_rules();
	update_option( 'db_upgraded',  false );

	/**
	 * Runs on the next page load after successful upgrade
	 *
	 * @since 2.8
	 */
	do_action('after_db_upgrade');
} elseif ( get_option('db_version') != $wp_db_version ) {
	if ( !is_multisite() ) {
		wp_redirect(admin_url('upgrade.php?_wp_http_referer=' . urlencode(stripslashes($_SERVER['REQUEST_URI']))));
		exit;
	} elseif ( apply_filters( 'do_mu_upgrade', true ) ) {
		/**
		 * On really small MU installs run the upgrader every time,
		 * else run it less often to reduce load.
		 *
		 * @since 2.8.4b
		 */
		$c = get_blog_count();
		if ( $c <= 50 || ( $c > 50 && mt_rand( 0, (int)( $c / 50 ) ) == 1 ) ) {
			require_once( ABSPATH . WPINC . '/http.php' );
			$response = wp_remote_get( admin_url( 'upgrade.php?step=1' ), array( 'timeout' => 120, 'httpversion' => '1.1' ) );
			do_action( 'after_mu_upgrade', $response );
		}
	}
}

require_once(ABSPATH . 'wp-admin/includes/admin.php');

auth_redirect();

nocache_headers();

update_category_cache();

// Schedule trash collection
if ( !wp_next_scheduled('wp_scheduled_delete') && !defined('WP_INSTALLING') )
	wp_schedule_event(time(), 'daily', 'wp_scheduled_delete');

set_screen_options();

$date_format = get_option('date_format');
$time_format = get_option('time_format');

wp_reset_vars(array('profile', 'redirect', 'redirect_url', 'a', 'text', 'trackback', 'pingback'));

wp_admin_css_color('classic', __('Blue'), admin_url("css/colors-classic.css"), array('#073447', '#21759B', '#EAF3FA', '#BBD8E7'));
wp_admin_css_color('fresh', __('Gray'), admin_url("css/colors-fresh.css"), array('#464646', '#6D6D6D', '#F1F1F1', '#DFDFDF'));

wp_enqueue_script( 'common' );
wp_enqueue_script( 'jquery-color' );

$editing = false;

if (isset($_GET['page'])) {
	$plugin_page = stripslashes($_GET['page']);
	$plugin_page = plugin_basename($plugin_page);
}

require(ABSPATH . 'wp-admin/menu.php');

do_action('admin_init');

if (isset($plugin_page) ) {
	if ( ! $page_hook = get_plugin_page_hook($plugin_page, $pagenow) ) {
		$page_hook = get_plugin_page_hook($plugin_page, $plugin_page);
		// backwards compatibility for plugins using add_management_page
		if ( empty( $page_hook ) && 'edit.php' == $pagenow && '' != get_plugin_page_hook($plugin_page, 'tools.php') ) {
			// There could be plugin specific params on the URL, so we need the whole query string
			if ( !empty($_SERVER[ 'QUERY_STRING' ]) )
				$query_string = $_SERVER[ 'QUERY_STRING' ];
			else
				$query_string = 'page=' . $plugin_page;
			wp_redirect( 'tools.php?' . $query_string );
			exit;
		}
	}
}

$hook_suffix = '';
if ( isset($page_hook) )
	$hook_suffix = $page_hook;
else if ( isset($plugin_page) )
	$hook_suffix = $plugin_page;
else if ( isset($pagenow) )
	$hook_suffix = $pagenow;

if ( isset($_GET['post_type']) )
	$typenow = $_GET['post_type'];
else
	$typenow = '';
// @todo validate typenow against post types.

set_current_screen();

// Handle plugin admin pages.
if ( isset($plugin_page) ) {
	if ( $page_hook ) {
		do_action('load-' . $page_hook);
		if (! isset($_GET['noheader']))
			require_once(ABSPATH . 'wp-admin/admin-header.php');

		do_action($page_hook);
	} else {
		if ( validate_file($plugin_page) ) {
			wp_die(__('Invalid plugin page'));
		}

		if ( !( file_exists(WP_PLUGIN_DIR . "/$plugin_page") && is_file(WP_PLUGIN_DIR . "/$plugin_page") ) && !( file_exists(WPMU_PLUGIN_DIR . "/$plugin_page") && is_file(WPMU_PLUGIN_DIR . "/$plugin_page") ) )
			wp_die(sprintf(__('Cannot load %s.'), htmlentities($plugin_page)));

		do_action('load-' . $plugin_page);

		if (! isset($_GET['noheader']))
			require_once(ABSPATH . 'wp-admin/admin-header.php');

		if ( file_exists(WPMU_PLUGIN_DIR . "/$plugin_page") )
			include(WPMU_PLUGIN_DIR . "/$plugin_page");
		else
			include(ABSPATH . PLUGINDIR . "/$plugin_page");
	}

	include(ABSPATH . 'wp-admin/admin-footer.php');

	exit();
} else if (isset($_GET['import'])) {

	$importer = $_GET['import'];

	if ( ! current_user_can('import') )
		wp_die(__('You are not allowed to import.'));

	if ( validate_file($importer) ) {
		wp_die(__('Invalid importer.'));
	}

	// Allow plugins to define importers as well
	if ( !isset($wp_importers) || !isset($wp_importers[$importer]) || ! is_callable($wp_importers[$importer][2]))
	{
		if (! file_exists(ABSPATH . "wp-admin/import/$importer.php"))
		{
			wp_die(__('Cannot load importer.'));
		}
		include(ABSPATH . "wp-admin/import/$importer.php");
	}

	$parent_file = 'tools.php';
	$submenu_file = 'import.php';
	$title = __('Import');

	if (! isset($_GET['noheader']))
		require_once(ABSPATH . 'wp-admin/admin-header.php');

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	define('WP_IMPORTING', true);

	if ( is_multisite() )
		kses_init_filters();  // Always filter imported data with kses.

	call_user_func($wp_importers[$importer][2]);

	include(ABSPATH . 'wp-admin/admin-footer.php');

	// Make sure rules are flushed
	global $wp_rewrite;
	$wp_rewrite->flush_rules(false);

	exit();
} else {
	do_action("load-$pagenow");
}

if ( !empty($_REQUEST['action']) )
	do_action('admin_action_' . $_REQUEST['action']);

?>
