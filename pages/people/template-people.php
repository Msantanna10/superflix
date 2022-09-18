<?php
/*
Template Name: People Listing
*/
get_header();

$personID = get_query_var('person_id');
global $apiKEY, $globalCurrentPerson; // $globalCurrentPerson is the request from the header.php (variable to avoid double requests)

// IF IT HAS A VALID NAME, IT'S A PERSON DETAILS PAGE
if(!empty($globalCurrentPerson['name'])) {
    // PERSON DETAILS: Pass variables to template part
    $args = array(
        'profile_path' => $globalCurrentPerson['profile_path'],
        'name' => $globalCurrentPerson['name'],
        'birthday' => $globalCurrentPerson['birthday'],
        'place_of_birth' => $globalCurrentPerson['place_of_birth'],
        'deathday' => $globalCurrentPerson['deathday'],
        'popularity' => $globalCurrentPerson['popularity'],
        'biography' => $globalCurrentPerson['biography'],
        'images' => array_slice($globalCurrentPerson['images']['profiles'], 0, 10), // Limit to 10 to avoid request limits
        'cast' => array_slice($globalCurrentPerson['movie_credits']['cast'], 0, 5), // Limit to 5 to avoid request limits
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