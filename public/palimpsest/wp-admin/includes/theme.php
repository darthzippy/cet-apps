<?php
/**
 * WordPress Theme Administration API
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * {@internal Missing Short Description}}
 *
 * @since unknown
 *
 * @return unknown
 */
function current_theme_info() {
	$themes = get_themes();
	$current_theme = get_current_theme();
	$ct->name = $current_theme;
	$ct->title = $themes[$current_theme]['Title'];
	$ct->version = $themes[$current_theme]['Version'];
	$ct->parent_theme = $themes[$current_theme]['Parent Theme'];
	$ct->template_dir = $themes[$current_theme]['Template Dir'];
	$ct->stylesheet_dir = $themes[$current_theme]['Stylesheet Dir'];
	$ct->template = $themes[$current_theme]['Template'];
	$ct->stylesheet = $themes[$current_theme]['Stylesheet'];
	$ct->screenshot = $themes[$current_theme]['Screenshot'];
	$ct->description = $themes[$current_theme]['Description'];
	$ct->author = $themes[$current_theme]['Author'];
	$ct->tags = $themes[$current_theme]['Tags'];
	$ct->theme_root = $themes[$current_theme]['Theme Root'];
	$ct->theme_root_uri = $themes[$current_theme]['Theme Root URI'];
	return $ct;
}

/**
 * Remove a theme
 *
 * @since 2.8.0
 *
 * @param string $template Template directory of the theme to delete
 * @return mixed
 */
function delete_theme($template) {
	global $wp_filesystem;

	if ( empty($template) )
		return false;

	ob_start();
	$url = wp_nonce_url('themes.php?action=delete&template=' . $template, 'delete-theme_' . $template);
	if ( false === ($credentials = request_filesystem_credentials($url)) ) {
		$data = ob_get_contents();
		ob_end_clean();
		if ( ! empty($data) ){
			include_once( ABSPATH . 'wp-admin/admin-header.php');
			echo $data;
			include( ABSPATH . 'wp-admin/admin-footer.php');
			exit;
		}
		return;
	}

	if ( ! WP_Filesystem($credentials) ) {
		request_filesystem_credentials($url, '', true); // Failed to connect, Error and request again
		$data = ob_get_contents();
		ob_end_clean();
		if ( ! empty($data) ) {
			include_once( ABSPATH . 'wp-admin/admin-header.php');
			echo $data;
			include( ABSPATH . 'wp-admin/admin-footer.php');
			exit;
		}
		return;
	}


	if ( ! is_object($wp_filesystem) )
		return new WP_Error('fs_unavailable', __('Could not access filesystem.'));

	if ( is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code() )
		return new WP_Error('fs_error', __('Filesystem error.'), $wp_filesystem->errors);

	//Get the base plugin folder
	$themes_dir = $wp_filesystem->wp_themes_dir();
	if ( empty($themes_dir) )
		return new WP_Error('fs_no_themes_dir', __('Unable to locate WordPress theme directory.'));

	$themes_dir = trailingslashit( $themes_dir );

	$errors = array();

	$theme_dir = trailingslashit($themes_dir . $template);
	$deleted = $wp_filesystem->delete($theme_dir, true);

	if ( ! $deleted )
		return new WP_Error('could_not_remove_theme', sprintf(__('Could not fully remove the theme %s.'), $template) );

	// Force refresh of theme update information
	delete_site_transient('update_themes');

	return true;
}

/**
 * {@internal Missing Short Description}}
 *
 * @since unknown
 *
 * @return unknown
 */
function get_broken_themes() {
	global $wp_broken_themes;

	get_themes();
	return $wp_broken_themes;
}

/**
 * Get the allowed themes for the current blog.
 *
 * @since 3.0
 *
 * @uses get_themes()
 * @uses current_theme_info()
 * @uses get_site_allowed_themes()
 * @uses wpmu_get_blog_allowedthemes
 *
 * @return array $themes Array of allowed themes.
 */
function get_allowed_themes() {
	if ( !is_multisite() )
		return get_themes();

	$themes = get_themes();
	$ct = current_theme_info();
	$allowed_themes = apply_filters("allowed_themes", get_site_allowed_themes() );
	if ( $allowed_themes == false )
		$allowed_themes = array();

	$blog_allowed_themes = wpmu_get_blog_allowedthemes();
	if ( is_array( $blog_allowed_themes ) )
		$allowed_themes = array_merge( $allowed_themes, $blog_allowed_themes );

	if ( isset( $allowed_themes[ wp_specialchars( $ct->stylesheet ) ] ) == false )
		$allowed_themes[ wp_specialchars( $ct->stylesheet ) ] = true;

	reset( $themes );
	foreach ( $themes as $key => $theme ) {
		if ( isset( $allowed_themes[ wp_specialchars( $theme[ 'Stylesheet' ] ) ] ) == false )
			unset( $themes[ $key ] );
	}
	reset( $themes );
	
	return $themes;
}

/**
 * Get the Page Templates available in this theme
 *
 * @since unknown
 *
 * @return array Key is template name, Value is template name
 */
function get_page_templates() {
	$themes = get_themes();
	$theme = get_current_theme();
	$templates = $themes[$theme]['Template Files'];
	$page_templates = array();

	if ( is_array( $templates ) ) {
		$base = array( trailingslashit(get_template_directory()), trailingslashit(get_stylesheet_directory()) );

		foreach ( $templates as $template ) {
			$basename = str_replace($base, '', $template);

			// don't allow template files in subdirectories
			if ( false !== strpos($basename, '/') )
				continue;

			$template_data = implode( '', file( $template ));

			$name = '';
			if ( preg_match( '|Template Name:(.*)$|mi', $template_data, $name ) )
				$name = _cleanup_header_comment($name[1]);

			if ( !empty( $name ) ) {
				$page_templates[trim( $name )] = $basename;
			}
		}
	}

	return $page_templates;
}

/**
 * Tidies a filename for url display by the theme editor.
 *
 * @since 2.9.0
 * @private
 *
 * @param string $fullpath Full path to the theme file
 * @param string $containingfolder Path of the theme parent folder
 * @return string
 */
function _get_template_edit_filename($fullpath, $containingfolder) {
	return str_replace(dirname(dirname( $containingfolder )) , '', $fullpath);
}

?>
