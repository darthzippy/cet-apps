<?php
/**
 * Used to setup and fix common variables and include
 * the WordPress procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see default-constants.php)
 *
 * @package WordPress
 */

/**
 * Stores the location of the WordPress directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
define( 'WPINC', 'wp-includes' );

// Include files required for initialization.
require( ABSPATH . WPINC . '/load.php' );
require( ABSPATH . WPINC . '/default-constants.php' );
require( ABSPATH . WPINC . '/version.php' );

// Set initial default constants including WP_MEMORY_LIMIT, WP_DEBUG, WP_CONTENT_DIR and WP_CACHE.
wp_default_constants( 'init' );

// Disable magic quotes at runtime. Magic quotes are added using wpdb later in wp-settings.php.
set_magic_quotes_runtime( 0 );
@ini_set( 'magic_quotes_sybase', 0 );

// Set default timezone in PHP 5.
if ( function_exists( 'date_default_timezone_set' ) )
	date_default_timezone_set( 'UTC' );

// Turn register_globals off.
wp_unregister_GLOBALS();

// Ensure these global variables do not exist so they do not interfere with WordPress.
unset( $wp_filter, $cache_lastcommentmodified, $cache_lastpostdate );

// Standardize $_SERVER variables across setups.
wp_fix_server_vars();

// Check for the required PHP version and for the MySQL extension or a database drop-in.
wp_check_php_mysql_versions();

// Check if we're in maintenance mode.
wp_maintenance();

// Start loading timer.
timer_start();

// Check if we're in WP_DEBUG mode.
wp_debug_mode();

// For an advanced caching plugin to use. Uses a static drop-in because you would only want one.
if ( WP_CACHE )
	@include WP_CONTENT_DIR . '/advanced-cache.php';

// Define WP_LANG_DIR if not set.
wp_set_lang_dir();

// Include early WordPress files.
require( ABSPATH . WPINC . '/compat.php' );
require( ABSPATH . WPINC . '/functions.php' );
require( ABSPATH . WPINC . '/classes.php' );

// Include the wpdb class, or a db.php database drop-in if present.
require_wp_db();

// Set the database table prefix and the format specifiers for database table columns.
wp_set_wpdb_vars();

// Start the WordPress object cache, or an external object cache if the drop-in is present.
wp_start_object_cache();

// Initialize multisite if enabled.
if ( is_multisite() )
	require( ABSPATH . WPINC . '/ms-load.php' );

// Load early WordPress files.
require( ABSPATH . WPINC . '/plugin.php' );
require( ABSPATH . WPINC . '/default-filters.php' );
include_once( ABSPATH . WPINC . '/pomo/mo.php' );

// Stop most of WordPress from being loaded if we just want the basics.
if ( SHORTINIT )
	return false;

// Load the l18n library.
require_once ( ABSPATH . WPINC . '/l10n.php' );

// Run the installer if WordPress is not installed.
wp_not_installed();

// Load most of WordPress.
require( ABSPATH . WPINC . '/formatting.php' );
require( ABSPATH . WPINC . '/capabilities.php' );
require( ABSPATH . WPINC . '/query.php' );
require( ABSPATH . WPINC . '/theme.php' );
require( ABSPATH . WPINC . '/user.php' );
require( ABSPATH . WPINC . '/meta.php' );
require( ABSPATH . WPINC . '/general-template.php' );
require( ABSPATH . WPINC . '/link-template.php' );
require( ABSPATH . WPINC . '/author-template.php' );
require( ABSPATH . WPINC . '/post.php' );
require( ABSPATH . WPINC . '/post-template.php' );
require( ABSPATH . WPINC . '/category.php' );
require( ABSPATH . WPINC . '/category-template.php' );
require( ABSPATH . WPINC . '/comment.php' );
require( ABSPATH . WPINC . '/comment-template.php' );
require( ABSPATH . WPINC . '/rewrite.php' );
require( ABSPATH . WPINC . '/feed.php' );
require( ABSPATH . WPINC . '/bookmark.php' );
require( ABSPATH . WPINC . '/bookmark-template.php' );
require( ABSPATH . WPINC . '/kses.php' );
require( ABSPATH . WPINC . '/cron.php' );
require( ABSPATH . WPINC . '/deprecated.php' );
require( ABSPATH . WPINC . '/script-loader.php' );
require( ABSPATH . WPINC . '/taxonomy.php' );
require( ABSPATH . WPINC . '/update.php' );
require( ABSPATH . WPINC . '/canonical.php' );
require( ABSPATH . WPINC . '/shortcodes.php' );
require( ABSPATH . WPINC . '/media.php' );
require( ABSPATH . WPINC . '/http.php' );
require( ABSPATH . WPINC . '/widgets.php' );

// Load multisite-specific files.
if ( is_multisite() ) {
	require_once( ABSPATH . WPINC . '/ms-functions.php' );
	require_once( ABSPATH . WPINC . '/ms-default-filters.php' );
	require_once( ABSPATH . WPINC . '/ms-deprecated.php' );
}

// Define constants that rely on the API to obtain the default value.
wp_default_constants( 'wp_included' );

// Set up multisite if enabled.
if ( is_multisite() )
	ms_network_settings();

// Define must-use plugin directory constants, which may be overridden in the sunrise.php drop-in.
wp_default_constants( 'ms_network_settings_loaded' );

// Load must-use plugins.
foreach( wp_muplugins_to_load() as $mu_plugin )
	include_once( $mu_plugin );
unset( $mu_plugin );

// Load network-wide plugins if multisite.
if ( is_multisite() ) {
	foreach ( ms_network_plugins() as $plugin_file )
		include_once( $plugin_file );
	unset( $plugin_file );
}

do_action( 'muplugins_loaded' );

// Check site status if multisite.
if ( is_multisite() ) {
	if ( true !== ( $file = ms_site_check() ) ) {
		require_once( $file );
		die();
	}
	ms_network_cookies();
}

// Define constants after multisite is loaded. Cookie-related constants may be overridden in ms_network_cookies().
wp_default_constants( 'ms_loaded' );

// Create common globals.
require( ABSPATH . WPINC . '/vars.php' );

// Make taxonomies available to plugins and themes.
// @plugin authors: warning: this gets registered again on the init hook.
create_initial_taxonomies();

// Load active plugins.
foreach( wp_plugins_to_load() as $plugin )
	include_once( $plugin );
unset( $plugin );

// Load pluggable functions.
require( ABSPATH . WPINC . '/pluggable.php' );

// Set internal encoding.
wp_set_internal_encoding();

// Run wp_cache_postload() if object cache is enabled and the function exists.
if ( WP_CACHE && function_exists( 'wp_cache_postload' ) )
	wp_cache_postload();

do_action( 'plugins_loaded' );

// Define WP_POST_REVISIONS if not already defined.
wp_default_constants( 'plugins_loaded' );

// Add magic quotes and set up $_REQUEST ( $_GET + $_POST )
wp_magic_quotes();

do_action( 'sanitize_comment_cookies' );

/**
 * WordPress Query object
 * @global object $wp_the_query
 * @since 2.0.0
 */
$wp_the_query =& new WP_Query();

/**
 * Holds the reference to @see $wp_the_query
 * Use this global for WordPress queries
 * @global object $wp_query
 * @since 1.5.0
 */
$wp_query =& $wp_the_query;

/**
 * Holds the WordPress Rewrite object for creating pretty URLs
 * @global object $wp_rewrite
 * @since 1.5.0
 */
$wp_rewrite =& new WP_Rewrite();

/**
 * WordPress Object
 * @global object $wp
 * @since 2.0.0
 */
$wp =& new WP();

/**
 * WordPress Widget Factory Object
 * @global object $wp_widget_factory
 * @since 2.8.0
 */
$wp_widget_factory =& new WP_Widget_Factory();

do_action( 'setup_theme' );

// Define the TEMPLATEPATH and STYLESHEETPATH constants.
wp_default_constants( 'setup_theme' );

// Load the default text localization domain.
load_default_textdomain();

// Find the blog locale.
$locale = get_locale();
$locale_file = WP_LANG_DIR . "/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

// Pull in locale data after loading text domain.
require_once( ABSPATH . WPINC . '/locale.php' );

/**
 * WordPress Locale object for loading locale domain date and various strings.
 * @global object $wp_locale
 * @since 2.1.0
 */
$wp_locale =& new WP_Locale();

// Load the functions for the active theme, for both parent and child theme if applicable.
if ( TEMPLATEPATH !== STYLESHEETPATH && file_exists( STYLESHEETPATH . '/functions.php' ) )
	include( STYLESHEETPATH . '/functions.php' );
if ( file_exists( TEMPLATEPATH . '/functions.php' ) )
	include( TEMPLATEPATH . '/functions.php' );

// Load any template functions the theme supports.
require_if_theme_supports( 'post-thumbnails', ABSPATH . WPINC . '/post-thumbnail-template.php' );

register_shutdown_function( 'shutdown_action_hook' );

// Set up current user.
$wp->init();

// Everything is loaded and initialized.
do_action( 'init' );

?>