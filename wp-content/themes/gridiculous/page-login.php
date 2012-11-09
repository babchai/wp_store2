<?php
/**
 * Template Name: Login
 *
 * A custom page template for Login.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Express
 * @since Express 1.0
 */
 ?>

<?php get_header(); ?>

	<div id="primary" class = "c12 centered" <?php //gridiculous_primary_attr(); ?>>

		<? if (!(current_user_can('level_0'))){ ?>
        
<h1 class="post-title">Login</h2><br />

<?php
  if($_GET["login"] == "failed")
  {
?>
<div style="background-color: #FFEBE8;border-color: #CC0000;margin:0px auto;width:300px; ">
    
     <strong> ERROR</strong>: Invalid username or password. <a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Lost your password?</a>

</div>
<br />
<?php }?>

<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
<div style="width:300px; height:200px; margin:0px auto; border:solid 1px; background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #E5E5E5; box-shadow: 0 4px 10px -1px rgba(200, 200, 200, 0.7);font-weight: normal;padding: 24px 24px 46px;" id="login">
<label style="color: #777777;font-size: 14px;">Username or Email</label><br />
<input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>"  style="color: #777777;font-size: 14px;"/><br />
<label style="color: #777777;font-size: 14px;">Password</label><br />
<input type="password" name="pwd" id="pwd"  style="color: #777777;font-size: 14px;" /><br />

<div style="float:left; margin-top:20px"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" style="width:auto;" /> Remember me<br />
  <a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Recover password</a><br />

<input type="submit" name="submit" value="Submit" class="button" style="margin-left:1px; width:auto; " /></div>
</div>
    
  
       <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
   

</form>

<?php 

} else { ?>
<?php
echo "Redirecting....";
echo '<script type="text/javascript">';
echo 'window.location = "'.get_option('home').'"';
echo '</script>';

?>
<h2>Logout</h2>
<a href="<?php echo wp_logout_url(urlencode($_SERVER['REQUEST_URI'])); ?>">logout</a><br />
<!-- <a href="http://XXX/wp-admin/">admin</a> -->
<?php }?>


	</div><!-- #primary.c8 -->

<?php get_footer(); ?>