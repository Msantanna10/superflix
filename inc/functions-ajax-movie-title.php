<?php
################### AJAX MOVIE TITLE
// GET UPCOMING MOVIES
add_action('wp_ajax_nopriv_movie_title', 'movie_title');
add_action('wp_ajax_movie_title', 'movie_title');
function movie_title(){

    global $apiKEY, $moviesPageID;

    // VARIABLES FROM REQUEST
    $title = $_REQUEST['title'];

    // APPEND PARAMETERS VALUES
    $args = array();
    if(!empty($title)) { $args['query'] = $title; } // Query

    $movieInfo = wp_remote_get( add_query_arg( $args, 'https://api.themoviedb.org/3/search/movie?api_key='.$apiKEY.'&language=en-US' ) ); // WP function for external APIs
    $movieInfo = wp_remote_retrieve_body( $movieInfo ); // Gets body
    $movieInfo = json_decode($movieInfo, true); // Array decode
    $movieInfo = array_slice($movieInfo['results'], 0, 10); // Limit to 10

    ob_start();

    foreach($movieInfo as $movie) { ?>
    <a href="<?php echo get_the_permalink($moviesPageID) . $movie['id']; ?>"><?php echo $movie['title']; ?></a>
    <?php }

    $html = ob_get_clean();

    // If empty...
    if(empty($movieInfo)) { $html = '<p class="loadText">Nothing found. Try again!</p>'; }
    
    echo $html;

exit();

} // End IF function
                
?>