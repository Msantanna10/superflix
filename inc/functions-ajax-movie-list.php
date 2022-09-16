<?php
################### AJAX MOVIES LIST
add_action('wp_ajax_nopriv_movies_list', 'movies_list');
add_action('wp_ajax_movies_list', 'movies_list');
function movies_list(){

    global $apiKEY;

    // VARIABLES FROM REQUEST
    $pagination = $_REQUEST['pagination']; if(!$pagination) { $pagination = 1; }
    $sort_by = $_REQUEST['sort_by'];
    $genres = $_REQUEST['genres'];
    $date = $_REQUEST['date'];
    $datesort = $_REQUEST['datesort'];

    // FILTER PARAMETERS (Starts with pagination only)
    $args = array(
        'page' => $pagination,
    );

    // APPEND MORE PARAMETER VALUES BEFORE THE REQUEST
    if(!empty($sort_by)) { $args['sort_by'] = $sort_by; } // Sort by
    if(!empty($genres)) { $args['with_genres'] = $genres; } // Genres
    if(!empty($date)) { $args['primary_release_date'.$datesort] = $date; } // Date + Sort

    // UNCOMMEND TO DISPLAY THE ENDPOINT ABOVE THE CARDS ON THE MOVIES LIST PAGE
    // print_r(add_query_arg( $args, 'https://api.themoviedb.org/3/discover/movie?api_key='.$apiKEY.'&language=en-US' ));

    $allMovies = wp_remote_get( add_query_arg( $args, 'https://api.themoviedb.org/3/discover/movie?api_key='.$apiKEY.'&language=en-US' ) ); // WP function for external APIs
    $allMovies = wp_remote_retrieve_body( $allMovies ); // Gets body
    $allMovies = json_decode($allMovies, true); // Array decode
    $allMoviesTotal = $allMovies['total_pages'];
    $allMovies = $allMovies['results'];

    ob_start();

    echo '<div class="allCards">';

    if( !empty( $allMovies ) ) {
        foreach( $allMovies as $movie ) {
            
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

    echo '</div>';

    // Pagination
    if(function_exists("pagination")) { pagination( $allMoviesTotal, $pagination ); }

    $html = ob_get_clean();

    // If empty...
    if(empty($allMovies)) { $html = '<p class="error">Nothing found. Try a different search!</p>'; }
    
    echo $html;

exit();

} // End IF function
                
?>