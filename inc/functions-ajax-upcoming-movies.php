<?php
################### AJAX UPCOMING MOVIES
// GET UPCOMING MOVIES
add_action('wp_ajax_nopriv_upcoming_movies', 'upcoming_movies');
add_action('wp_ajax_upcoming_movies', 'upcoming_movies');
function upcoming_movies(){

    global $apiKEY;
    $upcomingMovies = wp_remote_get( 'https://api.themoviedb.org/3/movie/upcoming?api_key='.$apiKEY.'&language=en-US&page=1' ); // WP function for external APIs
    $upcomingMovies = wp_remote_retrieve_body( $upcomingMovies ); // Gets body
    $upcomingMovies = json_decode($upcomingMovies, true); // Array decode
    $upcomingMovies = array_slice($upcomingMovies['results'], 0, 10); // Limit to 10

    ob_start();

    if( !empty( $upcomingMovies ) ) {
        foreach( $upcomingMovies as $movie ) {
            
            // MOVIE INFO
            // Pass variables to template part
            $args = array(
            'id'  => $movie['id'],
            'poster'  => $movie['poster_path'],
            'title' => $movie['title'],
            'genres' => $movie['genre_ids'],
            'release_date' => $movie['release_date'],
            );
            get_template_part( 'components/movieCard', null, $args );

        } // End foreach
    } // End IF (not empty)

    $html = ob_get_clean();
    echo $html;

exit();

} // End IF function
                
?>