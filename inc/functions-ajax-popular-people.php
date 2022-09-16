<?php
################### AJAX POPULAR PEOPLE (Homepage)
add_action('wp_ajax_nopriv_popular_people', 'popular_people');
add_action('wp_ajax_popular_people', 'popular_people');
function popular_people(){

    global $apiKEY;
    $popularPeople = wp_remote_get( 'https://api.themoviedb.org/3/person/popular?api_key='.$apiKEY.'&language=en-US&page=1' ); // WP function for external APIs
    $popularPeople = wp_remote_retrieve_body( $popularPeople ); // Gets body
    $popularPeople = json_decode($popularPeople, true); // Array decode
    $popularPeople = array_slice($popularPeople['results'], 0, 10); // Limit to 10

    ob_start();

    if( !empty( $popularPeople ) ) {
        foreach( $popularPeople as $person ) {
            
            // PERSON INFO
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

    $html = ob_get_clean();
    echo $html;

exit();

} // End IF function
                
?>