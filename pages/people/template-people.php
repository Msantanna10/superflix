<?php
/*
Template Name: People Listing
*/
get_header();

$personID = get_query_var('person_id');
global $apiKEY;

// RETRIEVES DATA
$currentPerson = wp_remote_get( 'https://api.themoviedb.org/3/person/'.$personID.'?api_key='.$apiKEY.'&language=en-US&append_to_response=movie_credits,images' ); // WP function for external APIs
$currentPerson = wp_remote_retrieve_body( $currentPerson ); // Gets body
$currentPerson = json_decode($currentPerson, true); // Array decode

// IF IT HAS A VALID NAME, IT'S A PERSON DETAILS PAGE
if(!empty($currentPerson['name'])) {
    // PERSON DETAILS: Pass variables to template part
    $args = array(
        'profile_path' => $currentPerson['profile_path'],
        'name' => $currentPerson['name'],
        'birthday' => $currentPerson['birthday'],
        'place_of_birth' => $currentPerson['place_of_birth'],
        'deathday' => $currentPerson['deathday'],
        'popularity' => $currentPerson['popularity'],
        'biography' => $currentPerson['biography'],
        'images' => array_slice($currentPerson['images']['profiles'], 0, 10), // Limit to 10 to avoid request limits
        'cast' => array_slice($currentPerson['movie_credits']['cast'], 0, 5), // Limit to 5 to avoid request limits
    );
    // Load content for people details
    get_template_part( 'pages/people/personDetails', null, $args );
}
// IF THERE'S NO PERSON ID ON THE URL, DISPLAY FULL PEOPLE LIST
else if(empty($personID)) {
    // Load content for people listing
    get_template_part( 'pages/people/peopleList' );
}
// INVALID PERSON ID
else {
    get_template_part( 'components/invalidPage' );
}

get_footer(); ?>