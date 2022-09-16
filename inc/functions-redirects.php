<?php
################### REDIRECT 404
add_action('template_redirect','redirect_404');
function redirect_404() {
    if(is_404() || is_author()) {
        wp_redirect(home_url());
    }
}

################### REDIRECT FROM ATTACHMENT PERMALINK
add_action( 'template_redirect', 'attachment_page_redirect', 10 );
function attachment_page_redirect() {
    if( is_attachment() ) {
        $url = wp_get_attachment_url( get_queried_object_id() );
        wp_redirect( home_url(), 301 );
    }
    return;
}

################### REDIRECT NON-ADMINS FROM THE DASHBOARD
function dashboard_block_redirect(){
if( is_admin() && !defined('DOING_AJAX') && ( !current_user_can('administrator') ) && is_user_logged_in() ){
    wp_redirect(home_url());
    exit;
}
}
add_action('init','dashboard_block_redirect');
?>