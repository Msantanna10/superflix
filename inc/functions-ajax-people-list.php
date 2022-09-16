<?php
################### AJAX PEOPLE LIST (Listing page)
add_action('wp_ajax_nopriv_people_list', 'people_list');
add_action('wp_ajax_people_list', 'people_list');
function people_list(){

    global $apiKEY;

    // VARIABLES FROM REQUEST
    $pagination = $_REQUEST['pagination']; if(!$pagination) { $pagination = 1; }

    // FILTER PARAMETERS (Starts with pagination only)
    $args = array(
        'page' => $pagination,
    );

    // APPEND MORE PARAMETER VALUES BEFORE THE REQUEST
    // if(!empty($sort_by)) { $args['sort_by'] = $sort_by; } // Sort by

    $allPeople = wp_remote_get( add_query_arg( $args, 'https://api.themoviedb.org/3/person/popular?api_key='.$apiKEY.'&language=en-US' ) ); // WP function for external APIs
    $allPeople = wp_remote_retrieve_body( $allPeople ); // Gets body
    $allPeople = json_decode($allPeople, true); // Array decode
    $allPeopleTotal = $allPeople['total_pages'];
    $allPeople = $allPeople['results'];

    ob_start();

    echo '<div class="allCards">';

    if( !empty( $allPeople ) ) {
        foreach( $allPeople as $person ) {
            
            // MOVIE INFO
            // Pass variables to template part
            $args = array(
            'id'  => $person['id'],
            'poster'  => $person['profile_path'],
            'name' => $person['name'],
            'role' => $person['known_for_department']
            );
            get_template_part( 'components/personCard', null, $args );

        } // End foreach
    } // End IF (not empty)

    echo '</div>';

    // Pagination
    if(function_exists("pagination")) { pagination( $allPeopleTotal, $pagination ); }

    $html = ob_get_clean();

    // If empty...
    if(empty($allPeople)) { $html = '<p class="error">Nothing found. Try a different search!</p>'; }
    
    echo $html;

exit();

} // End IF function
                
?>