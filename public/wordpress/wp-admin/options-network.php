<?php
/**
 * Network settings administration panel.
 *
 * @since 3.0
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('./admin.php');

if ( ! is_super_admin() )
	wp_die(__('You do not have sufficient permissions to manage options for this blog.'));

$title = __('Network Settings');
$parent_file = 'options-network.php';

add_contextual_help($current_screen, __('<a href="http://codex.wordpress.org/Settings_Network_SubPanel" target="_blank">Network Settings</a>'));

include('./admin-header.php');
/*
This option panel does not save data to the options table.
It contains a multi-step process allowing the user to enable a network of WordPress sites.
*/

$dirs = array( substr( ABSPATH, 0, -1), ABSPATH . "wp-content" );
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2><?php echo esc_html( $title ); ?></h2>

<form method="post" action="options-network.php">
<?php
function filestats( $err ) {
?>
	<h2><?php esc_html_e('Server Summary'); ?></h2>
	<p><?php _e('If you post a message to the WordPress support forum at <a target="_blank" href="http://wordpress.org/support/">http://wordpress.org/support/</a> then copy and paste the following information into your message:'); ?></p>
	<blockquote style="background: #eee; border: 1px solid #333; padding: 5px;">
	<br /><strong><?php echo __('ERROR:') . " $err"; ?></strong><br />
<?php
	clearstatcache();
	$files = array( "htaccess.dist", ".htaccess" );
	
	$indent = '&nbsp;&nbsp;&nbsp;&nbsp;';
	foreach ( (array) $files as $val ) {
		$stats = @stat( $val );
		if( $stats ) {
?>
			<h2><?php echo esc_html( $val ); ?></h2>
			<?php echo $indent . sprintf( __('uid/gid: %1$s/%2$s'), $stats[ 'uid' ], $stats[ 'gid' ] ); ?><br />
			<?php echo $indent . sprintf( __('size: %s'), $stats['size'] ); ?><br/>
			<?php echo $indent . sprintf( __('perms: %s'), substr( sprintf('%o', fileperms( $val ) ), -4 ) ); ?><br/>
			<?php echo $indent . sprintf( __('readable: %s'), is_readable( $val ) ? __('yes') : __('no') ); ?><br/>
			<?php echo $indent . sprintf( __('writeable: %s'), is_writeable( $val ) ? __('yes') : __('no') ); ?><br/>
<?php
		} elseif( ! file_exists( $val ) ) {
?>
			<h2><?php echo esc_html( $val ); ?></h2>
			<?php echo $indent . sprintf( __('FILE NOT FOUND: %s'), $val ); ?><br/>
<?php
		}
	}
	echo "</blockquote>";
}

function step2_htaccess() {
	global $base;

	// remove ending slash from $base and $url
	$htaccess = '';
	if( substr($base, -1 ) == '/') {
		$base = substr($base, 0, -1);
	}
	$htaccess_sample = ABSPATH . 'wp-admin/includes/htaccess.ms';
	if ( !file_exists( $htaccess_sample ) )
		wp_die( sprintf( __('Sorry, I need a %s to work from. Please re-upload this file to your WordPress installation.'), $htaccess_sample ) );

	$htaccess_file = file( $htaccess_sample );
	$fp = @fopen( $htaccess_sample, "r" );
	if( $fp ) {
		while( !feof( $fp ) ) {
			$htaccess .= fgets( $fp, 4096 );
		}
		fclose( $fp );
		$htaccess_file = str_replace( "BASE", $base, $htaccess );
	} else {
		wp_die( sprintf( __('Sorry, I need to be able to read %s. Please check the permissions on this file.'), $htaccess_sample ) );
	}

	//@todo: check for super-cache in use
?>
			<li><p><?php _e('Replace the contents of your <code>.htaccess</code> with the following:'); ?></p>
				<textarea name="htaccess" cols="120" rows="20">
<?php echo $htaccess_file; ?>
				</textarea>
			</li>
<?php
}

function step1() {
	$rewrite_enabled = false;
	?>
	<h2><?php esc_html_e('Installing Network of WordPress Sites'); ?></h2>
	<p><?php _e('I will help you enable the features for creating a network of sites by asking you a few questions so that you can create configuration files and make a directory to store all your uploaded files.'); ?></p>
	
	<h2><?php esc_html_e('What do I need?'); ?></h2>
	<ul>
		<li><?php _e( 'Access to your server to change directory permissions. This can be done through ssh or ftp for example.' ); ?></li>
		<li><?php _e( 'A valid email where your password and administrative emails will be sent.' ); ?></li>
		<li><?php _e( "Wildcard dns records if you're going to use the virtual host (sub-domain) functionality. Check the <a href='http://trac.mu.wordpress.org/browser/trunk/README.txt'>README</a> for further details."); ?></li>
	</ul>
	<?php
	$mod_rewrite_msg = "\n<p>" . __( "If the <code>mod_rewrite</code> module is disabled ask your administrator to enable that module, or look at the <a href='http://httpd.apache.org/docs/mod/mod_rewrite.html'>Apache documentation</a> or <a href='http://www.google.com/search?q=apache+mod_rewrite'>elsewhere</a> for help setting it up." ) . '</p>';
	
	if ( function_exists( 'apache_get_modules' ) ) {
		$modules = apache_get_modules();
		if ( ! in_array( 'mod_rewrite', $modules ) )
			echo '<p>' . __('<strong>Warning!</strong> It looks like mod_rewrite is not installed.') . '</p>' . $mod_rewrite_msg;
		else
			$rewrite_enabled = true;
	} else {
		echo '<p>' . __( 'Please make sure <code>mod_rewrite</code> is installed as it will be activated at the end of this install.' ) . '</p>' . $mod_rewrite_msg;
	}
	return $rewrite_enabled;
}

function printstep1form( $rewrite_enabled = false ) {
	$weblog_title = sprintf( __('%s Sites'), ucfirst( get_option( 'blogname' ) ) );
	$email = get_option( 'admin_email' );
	$hostname = get_clean_basedomain();
	if( substr( $hostname, 0, 4 ) == 'www.' )
		$nowww = substr( $hostname, 4 );

	wp_nonce_field( 'install-network-1' );
	?>
		<input type='hidden' name='action' value='step2' />
		<h2><?php esc_html_e( 'Site Addresses' ); ?></h2>
		<p><?php _e( 'Please choose whether you would like sites in your WordPress install to use sub-domains or sub-directories. You cannot change this later.' ); ?></p>
		<?php if ( !$rewrite_enabled ) { ?>
		<p><?php _e( '<strong>Note</strong> It looks like <code>mod_rewrite</code> is not installed.'); ?></p>
		<?php } ?>
		<p class="blog-address">
			<label><input type='radio' name='vhost' value='yes'<?php if( $rewrite_enabled ) echo ' checked="checked"'; ?> /> <?php _e( 'Sub-domains (like <code>blog1.example.com</code>)' ); ?></label><br />
			<label><input type='radio' name='vhost' value='no'<?php if( !$rewrite_enabled ) echo ' checked="checked"'; ?> /> <?php _e( 'Sub-directories (like <code>example.com/blog1</code>) '); ?></label>
		</p>

		<h2><?php esc_html_e( 'Server Address' ); ?></h2>
		<?php if ( isset( $nowww ) ) { ?>
		<h3><?php printf( __( 'We recommend you change your siteurl to <code>%1$s</code> before enabling the network feature. It will still be possible to visit your site using the "www" prefix with an address like <code>%2$s</code> but any links will not have the "www" prefix.' ), $nowww, $hostname ); ?></h3>
		<?php } ?>
		<table class="form-table">  
			<tr> 
				<th scope='row'><?php esc_html_e( 'Server Address' ); ?></th> 
				<td>
					<p><?php printf( __( 'This will be the Internet address of your site: <strong><em>%s</em></strong>.' ), $hostname ); ?></p>
					<input type='hidden' name='basedomain' value='<?php echo esc_attr( $hostname ); ?>' />
					<p><?php _e( 'Do not use an IP address (like 127.0.0.1) or a single word hostname like <q>localhost</q> as your server address.' ); ?></p>
				</td> 
			</tr>
		</table>

		<h2><?php esc_html_e( 'Site Details' ); ?></h2>
		<table class="form-table">  
			<tr> 
				<th scope='row'><?php esc_html_e( 'Site&nbsp;Title' ); ?></th> 
				<td>
					<input name='weblog_title' type='text' size='45' value='<?php echo esc_attr( $weblog_title ); ?>' />
					<br /><?php _e( 'What would you like to call your site?' ); ?>
				</td> 
			</tr> 
			<tr> 
				<th scope='row'><?php esc_html_e( 'Email' ); ?></th> 
				<td>
					<input name='email' type='text' size='45' value='<?php echo esc_attr( $email ); ?>' /> 
					<br /><?php _e( 'Your email address.' ); ?>
				</td> 
			</tr> 
		</table> 
		<p class='submit'><input class="button" name='submit' type='submit' value='<?php esc_attr_e( 'Proceed' ); ?>' /></p>
	<?php
}

function step2() {
?>
		<h2><?php esc_html_e( 'Enabling WordPress Sites' ); ?></h2>
		<p><?php _e( 'Complete the following steps to enable the features for creating a network of sites. <strong>Note:</strong> We recommend you make a backup copy of your existing <code>wp-config.php</code> and <code>.htaccess</code> files.' ); ?></p>
		<ol>
			<li><?php _e( 'Create a <code>blogs.dir</code> directory in your <code>wp-content</code> directory. This directory is used to stored uploaded media for your additional sites and must be writeable by the web server.' ); ?></li>
<?php step2_config(); ?>
<?php step2_htaccess(); ?>
		</ol>
<?php
}

function step2_config() {
	global $base, $wpdb, $vhost;

	$vhost   = stripslashes($_POST['vhost' ]);
	$prefix  = $wpdb->base_prefix;

	$config_sample = ABSPATH . 'wp-admin/includes/wp-config.ms';
	if ( !file_exists( $config_sample ) )
		wp_die( sprintf( __( 'Sorry, I need a <code>%s</code> to work from. Please re-upload this file to your WordPress installation.' ), $config_sample ) );

	$wp_config_file = file( $config_sample );
?>
			<li><p><?php _e( 'Replace the contents of your <code>wp-config.php</code> with the following:' ); ?></p>
				<textarea name="wp-config" cols="120" rows="20">
<?php
	foreach ($wp_config_file as $line) {
		switch ( trim( substr($line,0,16) ) ) {
			case "define('DB_NAME'":
				$output = str_replace("wordpress", DB_NAME, $line);
				break;
			case "define('DB_USER'":
				$output = str_replace("username", DB_USER, $line);
				break;
			case "define('DB_PASSW":
				$output = str_replace("password", DB_PASSWORD, $line);
				break;
			case "define('DB_HOST'":
				$output = str_replace("localhost", DB_HOST, $line);
				break;
			case "define('VHOST',":
				$output = str_replace("VHOSTSETTING", $vhost, $line);
				break;
			case '$table_prefix  =':
				$output = str_replace('wp_', $prefix, $line);
				break;
			case '$base = \'BASE\';':
				$output = str_replace('BASE', $base, $line);
				break;
			case "define('DOMAIN_C":
				$domain = get_clean_basedomain();
				$output = str_replace("current_site_domain", $domain, $line);
				break;
			case "define('PATH_CUR":
				$output = str_replace("current_site_path", $base, $line);
				break;
			case "define('AUTH_KEY":
			case "define('AUTH_SAL":
			case "define('LOGGED_I":
			case "define('SECURE_A":
			case "define('NONCE_KE":
				$constant = substr( $line, 8, strpos( $line, "'", 9 ) - 8 );
				if ( defined( $constant ) )
					$hash = constant( $constant );
				else
					$hash = md5( mt_rand() ) . md5( mt_rand() );
				$output = str_replace('put your unique phrase here', $hash, $line);
				break;
			default:
				$output = $line;
				break;
		}
		echo $output;
	}
?>
				</textarea>
			</li>
<?php
}

function get_clean_basedomain() {
	global $wpdb;
	$domain = preg_replace( '|https?://|', '', get_option( 'siteurl') );
	if( strpos( $domain, '/' ) )
		$domain = substr( $domain, 0, strpos( $domain, '/' ) );
	return $domain;
}

$action = isset($_POST[ 'action' ]) ? $_POST[ 'action' ] : null; 
switch($action) {
	case "step2":
		check_admin_referer( 'install-network-1' );
		
		// Install!
		$base = stripslashes( dirname( dirname($_SERVER["SCRIPT_NAME"]) ) );
		if( $base != "/")
			$base .= "/";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		// create network tables
		$domain = get_clean_basedomain();
		install_network();
		populate_network( 1, $domain, sanitize_email( $_POST[ 'email' ] ), $_POST[ 'weblog_title' ], $base, $_POST[ 'vhost' ] );
		// create wp-config.php / htaccess
		step2();
	break;
	default:
		//@todo: give an informative screen instead
		if ( is_multisite() ) {
			_e('Network already enabled');
		} else {
			$rewrite_enabled = step1();
			printstep1form($rewrite_enabled);
		}
	break;
}
?>
</form>
</div>

<?php include('./admin-footer.php'); ?>
