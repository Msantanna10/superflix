<?php
################### USER FIELDS
// Remove color scheme
if(is_admin()){
  remove_action("admin_color_scheme_picker", "admin_color_scheme_picker");
}

// Remove application password
add_filter('wp_is_application_passwords_available', '__return_false'); 

################### CUSTOM CSS FOR USER
add_action('admin_head', 'custom_user_css');
function custom_user_css() { ?>
<style>
table .user-rich-editing-wrap, 
table .user-syntax-highlighting-wrap, 
table .user-comment-shortcuts-wrap, 
table .show-admin-bar, 
table .user-nickname-wrap, 
table .user-display-name-wrap, 
table .user-url-wrap, 
table .user-profile-picture, 
table .user-admin-color-wrap,
#wpbody-content #application-passwords-section {display: none;}
</style>
<?php
}

################### CUSTOM FIELD FOR MOVIES IDS
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="movies"><?php _e("Movie IDs"); ?></label></th>
        <td>
            <input type="text" name="movies" id="movies" value="<?php echo esc_attr( get_the_author_meta( 'movies', $user->ID ) ); ?>" class="regular-text" readonly /><br />
            <span class="description"><?php _e("IDs separated by space"); ?></span>
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
function save_extra_user_profile_fields( $user_id ) {
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'movies', $_POST['movies'] );
}
?>