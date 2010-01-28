<?php
/*
Template Name: Contact Page
*/

get_header();
?>
<div id="content-wrap">
  <div id="content">
    <div class="gap">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <div class="post">

<?php
if ($_POST['nama'] && $_POST['email']) {
	if ($_SESSION['last_input'] != "" && $_SESSION['last_input'] < strtotime("-05 minutes"))
	{
	session_destroy();
	}
		
	if (!$_SESSION['sending']) {
		if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
			// Insert you code for processing the form here, e.g emailing the submission, entering it into a database.		
			function special($p) {
				$p = htmlentities($p, ENT_COMPAT,'UTF-8');
				$p = str_replace('--','-&minus;',$p);
				return $p;
			}
							
			$name = special($_POST['name']);
			$email = special($_POST['email']);
			$url = special($_POST['url']);
			$subject = special($_POST['subject']);
			$message = special($_POST['message']);
			
			$emaildata = $wpdb->get_row("SELECT `name`,`email` FROM `email` LIMIT 0,1");
			$sendto = $emaildata->email;
			
			$body = '
			A message from:
			Name : '.$name.'
			Email : '.$email.'
			Address : '.$url.'
			Message :
			'.$message.'
			
			Send from '.get_bloginfo('url');
			
			$header = 'From: '.$name.' <'.$email.'>';
			@mail($sendto, $subject, $body, $header);
			
			$_SESSION['sending'] = 1;
			$_SESSION['last_input'] = time();
			unset($_SESSION['security_code']);
			
		echo "<h2>";
		the_title();
		echo "</h2>";
			echo 'Thank you';
		} else {
		echo "<h2>";
		the_title();
		echo "</h2>";
			echo 'Wrong Security Code';
		}
	} else {
		echo "<h2>";
		the_title();
		echo "</h2>";
		echo 'Sorry, you can send an email 5 minute again';
	}
} else {
?>

        <h2 class="post-title">
          <?php the_title(); ?>
        </h2>
        <?php edit_post_link(); ?>
        <div class="post-content">
          <?php the_content("Continue Reading &#187;");
							?>
<div id="contactform">							
<form action="" method="post">
<ul>
<li><label for="name">Name<span class="mini">You Name Please</span></label><input type="text" name="nama" size="35"></li>
<li><label for="email">Email<span class="mini">You Email Please</span></label><input type="text" name="email" size="35"></li>
<li><label for="url">URL<span class="mini">You URL Please</span></label><input type="text" name="url" size="35"></li>
<li><label for="subject">Subject<span class="mini">You Subject Please</span></label><input type="text" name="subject" size="35"></li>
<li><label for="message">Message<span class="mini">You Message Please</span></label><textarea name="message" cols="40" rows="7"></textarea></li>
<li><label for="security_code">Captcha<span class="mini">Security Image</span></label><input type="text" name="security_code" size="15"><br />
		<img src="<?php bloginfo('template_url')?>/src/captcha.php?width=100&height=27&characters=5" align="absmiddle" /></li>
<li><label for="submit"></label><input type="submit" value="Contact Me" id="submit"></li>
</ul>
</form>
</div>
<?php
}
?>
      </div>

        <?php endwhile; ?>
      </div>
      <?php endif; ?>
    </div>    <!-- /gap -->
  </div>  <!-- /content -->
</div> <!-- /content-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>