<?php
################### AJAX ADD TO FAVORITES
add_action('wp_ajax_add_favorites', 'add_favorites');
function add_favorites(){

    // VARIABLES FROM REQUEST
    $id = esc_sql($_REQUEST['id']);
    $action = esc_sql($_REQUEST['doIt']);

    $currentIDs = get_user_meta(get_current_user_id(), 'movies', true); // Current list

    // Check action
    if ($action == 'add') {
        $newIDs = $currentIDs . ' ' . $id; // Appends new ID with space
        $result = update_user_meta(get_current_user_id(), 'movies', ltrim($newIDs));
    }     
    if ($action == 'remove') {
        $newIDs = str_replace($id, '', $currentIDs); // Replaces ID with space to remove it
        $newIDs = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $newIDs); // Remove multiple spaces and keep only one as separator
        $result = update_user_meta(get_current_user_id(), 'movies', ltrim($newIDs));
    }

    echo $result;

exit();

} // End IF function
                
?>