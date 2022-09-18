<?php
/*
Template Name: Movies Listing
*/
get_header();

$movieID = get_query_var('movie_id');
global $apiKEY, $globalCurrentMovie; // $globalCurrentMovie is the request from the header.php (variable to avoid double requests)

// IF IT HAS A VALID TITLE, IT'S A MOVIE DETAILS PAGE
if(!empty($globalCurrentMovie['title'])) {
    // MOVIE DETAILS: Pass variables to template part
    $args = array(
        'id' => $globalCurrentMovie['id'],
        'title' => $globalCurrentMovie['title'],
        'tagline' => $globalCurrentMovie['tagline'],
        'videos' => $globalCurrentMovie['videos']['results'],
        'poster' => $globalCurrentMovie['poster_path'],
        'genres' => $globalCurrentMovie['genres'],
        'alternativeTitles' => $globalCurrentMovie['alternative_titles']['titles'],
        'overview' => $globalCurrentMovie['overview'],
        'productionCompanies' => $globalCurrentMovie['production_companies'],
        'release' => $globalCurrentMovie['release_date'],
        'originalLang' => $globalCurrentMovie['original_language'],
        'cast' => array_slice($globalCurrentMovie['credits']['cast'], 0, 10), // Limit to 10 to avoid request limits
        'popularity' => $globalCurrentMovie['popularity'],
        'reviews' => $globalCurrentMovie['vote_average'],
        'similarMovies' => array_slice($globalCurrentMovie['similar']['results'], 0, 5), // Limit to 5 to avoid request limits
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