<?php
/*
Template Name: Movies Listing
*/
get_header();

$movieID = get_query_var('movie_id');
global $apiKEY;

// RETRIEVES DATA
$currentMovie = wp_remote_get( 'https://api.themoviedb.org/3/movie/'.$movieID.'?api_key='.$apiKEY.'&language=en-US&append_to_response=credits,alternative_titles,videos,similar' ); // WP function for external APIs
$currentMovie = wp_remote_retrieve_body( $currentMovie ); // Gets body
$currentMovie = json_decode($currentMovie, true); // Array decode

// IF IT HAS A VALID TITLE, IT'S A MOVIE DETAILS PAGE
if(!empty($currentMovie['title'])) {
    // MOVIE DETAILS: Pass variables to template part
    $args = array(
        'id' => $currentMovie['id'],
        'title' => $currentMovie['title'],
        'tagline' => $currentMovie['tagline'],
        'videos' => $currentMovie['videos']['results'],
        'poster' => $currentMovie['poster_path'],
        'genres' => $currentMovie['genres'],
        'alternativeTitles' => $currentMovie['alternative_titles']['titles'],
        'overview' => $currentMovie['overview'],
        'productionCompanies' => $currentMovie['production_companies'],
        'release' => $currentMovie['release_date'],
        'originalLang' => $currentMovie['original_language'],
        'cast' => array_slice($currentMovie['credits']['cast'], 0, 10), // Limit to 10 to avoid request limits
        'popularity' => $currentMovie['popularity'],
        'reviews' => $currentMovie['vote_average'],
        'similarMovies' => array_slice($currentMovie['similar']['results'], 0, 5), // Limit to 5 to avoid request limits
    );
    // Load content for movie details
    get_template_part( 'pages/movies/movieDetails', null, $args );
}
// IF THERE'S NO MOVIE ID ON THE URL, DISPLAY FULL MOVIE LIST
else if(empty($movieID)) {
    // Load content for movies listing
    get_template_part( 'pages/movies/moviesList' );
}
// INVALID MOVIE ID
else {
    get_template_part( 'components/invalidPage' );
}

get_footer(); ?>