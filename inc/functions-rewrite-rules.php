<?php
################### (MOVIES) REWRITE RULES - QUERY VARS
// This is used to create custom friendly URL for SEO instead of Get parameters. Example: from /?movie=123 to /movie/123
add_filter('query_vars', 'add_movies_var', 0, 1);
function add_movies_var($vars){
    $vars[] = 'movie_id';
    $vars[] = 'person_id';
    return $vars;
}

global $moviesPageID, $peoplePageID;

if($moviesPageID && $peoplePageID) {

  $slug_movies_page = get_post($moviesPageID)->post_name; // Search page slug by ID
  $slug_people_page = get_post($peoplePageID)->post_name; // Search page slug by ID
  // ([^/]*) = accepts accents and spaces
  // ([a-z0-9-]+) = accepts only without accents or spaces
  // ([0-9]+) = numbers only
  // Get movie ID after slug on the page
  add_rewrite_rule('^'.$slug_movies_page.'/([0-9]+)/?$','index.php?page_id='.$moviesPageID.'&movie_id=$matches[1]','top');
  add_rewrite_rule('^'.$slug_people_page.'/([0-9]+)/?$','index.php?page_id='.$peoplePageID.'&person_id=$matches[1]','top');
  flush_rewrite_rules(); // Clears cache

}

?>