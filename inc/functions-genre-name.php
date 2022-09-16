<?php
################### CUSTOM FUNCTION TO GET GENRE NAME BY ITS ID
// Since there's no endpoint for single genre IDs, we need to parse them all and get the one we want
// Source: https://www.themoviedb.org/talk/5f58b094befb0900355684a6
function genreName( $genreID ) {
  
  global $apiKEY;

  // Starts with cached genre names by default
  $genreNames = get_transient( 'wp_genre_names' );

  // IF Cached genre names dont exist, lets pull them from the API and add it to the cache (genre names only, not movies)
  if(!$genreNames) {
    $genres = wp_remote_get( 'https://api.themoviedb.org/3/genre/movie/list?api_key='.$apiKEY.'&language=en-US&page=1' ); // WP function for external APIs
    $genres = wp_remote_retrieve_body( $genres ); // Gets body
    $genres = json_decode($genres, true); // Array decode
    $genres = $genres['genres']; // List of genres
    $genreNames = array(); // Creates new array to add their names

    foreach ( $genres as $genre ) {
      // For each genre from the API, add it to the new array with its ID as KEY and its NAME as VALUE (to make it easier to get it on the frontend)
      $genreNames[$genre['id']] = $genre['name'];        
    }

    // Sets cache for least 5 minutes because they wont change often for each movie
    // It's not a local cache, once it expires it will be auto-generated again by any other user
    set_transient( 'wp_genre_names', $genreNames, 300 );        
  }

  // Returns the array with the names to the frontend (either from the cache or from a new request)
  return $genreNames[$genreID];

}
?>