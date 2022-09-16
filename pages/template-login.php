<?php
/* Template Name: Login Page */

// If logged in, redirect to author page
if(is_user_logged_in()) { wp_redirect(home_url()); exit(); }
  
// If login attempt
if($_POST) {
    
    global $wpdb;  
    
    //We shall SQL escape all inputs  
    $username = esc_sql($_REQUEST['username']);  
    $password = esc_sql($_REQUEST['password']);  
    $remember = esc_sql($_REQUEST['rememberme']);  
  
    if ( ! empty( $username ) && is_email( $username ) ) {
      if ( $user = get_user_by_email( $username ) ) {
        $username = $user->user_login;
      }
    }
    
    if($remember) $remember = "true";  
    else $remember = "false";  
    
    $login_data = array();  
    $login_data['user_login'] = $username;  
    $login_data['user_password'] = $password;  
    $login_data['remember'] = $remember;  
    
    $user_verify = wp_signon( $login_data, false );   
  
    $error = false;
    
    if ( is_wp_error($user_verify) ) {  
        $error = true;  
    }
    else { 
  
      wp_setcookie($username, $password, true);
      wp_set_current_user($user_verify->ID); 
      do_action('wp_login', $username);
  
      wp_redirect(home_url());
      exit();
      
    }  
               
}

get_header();

global $RegisterPageID;
?>

<div class="loginPage">
    <div class="header">
        <div class="container spaceTop">
            <h1>Login</h1>
        </div>
    </div>
    <div class="postForm">
        <div class="body space">
            <div class="container">
                <?php if($error == true) { echo '<p id="invalid">Invalid credentials! Please, try again.</p>'; } ?>
                    <form name="form" class="formDefault" action="" method="POST">  
                        <input id="username" type="text" placeholder="Username or email" name="username">  
                        <input id="password" type="password" placeholder="Password" name="password">  
                        <label><input id="rememberme" type="checkbox" name="rememberme" checked>Remember account</label>
                        <input id="submit" type="submit" name="submit" value="Login">  
                    </form>  

                    <ul class="links">
                        <li><a href="<?php the_permalink($RegisterPageID); ?>">Don't have an account? Sign up now.</a></li>
                        <li><a href="<?php echo wp_lostpassword_url(); ?>" target="_blank">Forgot your passoword?</a></li>
                    </ul>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>