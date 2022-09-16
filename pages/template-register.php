<?php
/* Template Name: Register Page */

$success = false;

// If logged in, redirect to author page
if(is_user_logged_in()) { wp_redirect(home_url()); exit(); }

// Se formulário foi enviado - validação
if (isset( $_POST["user_login"] ) && wp_verify_nonce($_POST['register_nonce'], 'pippin-register-nonce')) {

    $user_login   = $_POST["user_login"];  
    $user_email   = $_POST["user_email"];
    $user_email_confirm   = $_POST["user_email_confirm"];
    $user_first   = $_POST["user_first"];
    $user_pass    = $_POST["user_pass"];
    $pass_confirm   = $_POST["user_pass_confirm"];

    $errors = false;

    if(username_exists($user_login)) {
        // Username already registered
        $user_login_warning = array();
        $user_login_warning[] = 'Username already taken';
        $errors = true;
    }
    if(!empty($user_login)) {
        if(strlen($user_login) <= 5) {
            // invalid username
            $user_login_warning[] = 'Choose a longer username';
            $errors = true;
        }
        if(!validate_username($user_login)) {
            // invalid username
            $user_login_warning[] = 'Choose a username without spaces or special characters';
            $errors = true;
        }
    }
    else {
        $user_login_warning[] = 'Type a username';
        $errors = true;
    }            
    if($user_first == '') {
        // empty name
        $user_first_warning = array();
        $user_first_warning[] = 'Type your name';
        $errors = true;
    }
    if(!is_email($user_email)) {
        //invalid email
        $user_email_warning = array();
        $user_email_warning[] = 'Invalid email';
        $errors = true;
    }
    if(email_exists($user_email)) {
        //Email address already registered
        $user_email_warning = array();
        $user_email_warning[] = 'Email already taken';
        $errors = true;
    }
    if($user_email_confirm == '') {
        // empty name
        $user_email_confirm_warning = array();
        $user_email_confirm_warning[] = 'Confirm your email';
        $errors = true;
    }
    if($user_email != $user_email_confirm) {
        // empty name
        $user_email_confirm_warning = array();
        $user_email_confirm_warning[] = 'Emails don\'t match';
        $errors = true;
    }
    if($user_pass == '') {
        // passwords do not match
        $user_pass_warning = array();
        $user_pass_warning[] = 'Digite uma senha';
        $errors = true;
    }                                
    if($user_pass != $pass_confirm) {
        // passwords do not match
        $pass_confirm_warning = array();
        $pass_confirm_warning[] = 'As senhas não combinam';
        $errors = true;
    } 
    
    // only create the user in if there are no errors
    if(!$errors) {

        $new_user_id = wp_insert_user(array(
            'user_login'    => $user_login,
            'user_pass'     => $user_pass,
            'user_email'    => $user_email,
            'first_name'    => ucfirst(strtolower($user_first)),
            'user_registered' => date('Y-m-d H:i:s'),
            'role'        => 'subscriber'
        )
        );

        if($new_user_id) {

            // log the new user in
            wp_setcookie($user_login, $user_pass, true);
            wp_set_current_user($new_user_id, $user_login); 
            do_action('wp_login', $user_login);

            $success = true;

        }

    }

} // End of validation

get_header();

global $LoginPageID;
?>

<div class="registerPage">
    <div class="header">
        <div class="container spaceTop">
            <h1>Register</h1>
        </div>
    </div>
    <div class="postForm">
        <div class="body space">
            <div class="container">
                <?php if($success) { ?>
                <div class="success">
                    <p>Account created successfully! <a href="<?php echo get_site_url(); ?>">Click here</a> to go back to the homepage.</p>
                </div>
                <?php } else { ?>
                <form class="formDefault" action="" method="POST">
                    <fieldset>
                        <div class="row">
                            <div class="smaller">
                                <label for="user_Login">Username</label>
                            </div>
                            <div class="bigger">
                                <input value="<?php echo $user_login; ?>" name="user_login" class="<?php if($user_login_warning) { echo 'invalid'; } ?>" type="text"/>
                                <span id="desc">It will be used to sign in</span>
                                <?php if(!empty($user_login_warning)) { ?>
                                <p id="all">
                                    <?php
                                    foreach($user_login_warning as $message) {
                                    echo '<span>'.$message.'</span>';
                                    }
                                    ?>
                                </p>                          
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">                   
                            <div class="smaller">
                                <label >Email</label>
                            </div>
                            <div class="bigger">
                                <input value="<?php if(!empty($user_email)) { echo $user_email; } ?>" name="user_email" class="<?php if($user_email_warning) { echo 'invalid'; } ?>" type="email"/>
                                <span id="desc">It can also be used to login or recover your password</span>
                                <?php if(!empty($user_email_warning)) { ?>
                                <p id="all">
                                    <?php
                                    foreach($user_email_warning as $message) {
                                    echo '<span>'.$message.'</span>';
                                    }
                                    ?>
                                </p>                          
                                <?php } ?>
                            </div>                    
                        </div>
                        <div class="row">                   
                            <div class="smaller">
                                <label>E-mail (confirmation)</label>
                            </div>
                            <div class="bigger">
                                <input value="<?php if(!empty($user_email_confirm)) { echo $user_email_confirm; } ?>" name="user_email_confirm" class="<?php if($user_email_confirm_warning) { echo 'invalid'; } ?>" type="email"/>
                                <?php if(!empty($user_email_confirm_warning)) { ?>
                                <p id="all">
                                    <?php
                                    foreach($user_email_confirm_warning as $message) {
                                    echo '<span>'.$message.'</span>';
                                    }
                                    ?>
                                </p>                          
                                <?php } ?>
                            </div>                    
                        </div>
                        <div class="row">                   
                            <div class="smaller">
                                <label>Name</label>
                            </div>
                            <div class="bigger">
                                <input value="<?php if(!empty($user_first)) { echo $user_first; } ?>" name="user_first" class="<?php if($user_first_warning) { echo 'invalid'; } ?>" maxlength="15" type="text"/>
                                <?php if(!empty($user_first_warning)) { ?>
                                <p id="all">
                                    <?php
                                    foreach($user_first_warning as $message) {
                                    echo '<span>'.$message.'</span>';
                                    }
                                    ?>
                                </p>                          
                            <?php } ?>
                            </div>                    
                        </div>                        
                        <div class="row">                   
                            <div class="smaller">
                                <label>Password</label>
                            </div>
                            <div class="bigger">
                                <input name="user_pass" class="<?php if(!empty($user_pass_warning)) { echo 'invalid'; } ?>" type="password"/>
                                <?php if(!empty($user_pass_warning)) { ?>
                                <p id="all">
                                    <?php
                                    foreach($user_pass_warning as $message) {
                                    echo '<span>'.$message.'</span>';
                                    }
                                    ?>
                                </p>
                                <?php } ?>
                            </div>                    
                        </div>
                        <div class="row">                   
                            <div class="smaller">
                                <label>Password (confirmation)</label>
                            </div>
                            <div class="bigger">
                                <input name="user_pass_confirm" class="<?php if($user_pass_warning || $pass_confirm_warning) { echo 'invalid'; } ?>" type="password"/>
                                <?php if(!empty($pass_confirm_warning)) { ?>
                                <p id="all">
                                <?php
                                foreach($pass_confirm_warning as $message) {
                                    echo '<span>'.$message.'</span>';
                                }
                                ?>
                                </p>                            
                                <?php } ?>
                            </div>                    
                        </div>
                        <div class="row">                   
                            <div class="smaller" id="left">
                                <input type="hidden" name="register_nonce" value="<?php echo wp_create_nonce('pippin-register-nonce'); ?>"/>
                            </div>
                        <div class="bigger">
                            <input type="submit" value="Create an account"/>
                        </div>                    
                    </fieldset>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>