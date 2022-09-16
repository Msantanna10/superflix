<?php
################### REWRITES PERMALINK SCRUCTURE
add_action( 'admin_init', function() {
    global $wp_rewrite;
     // Force pages to load with slug instead of ID
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
    $wp_rewrite->flush_rules();
    // For movie/person URL check the function-rewrite-rules.php file
} );              
?>