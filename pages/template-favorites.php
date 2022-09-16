<?php
/* Template Name: Favorites */

global $moviesPageID, $LoginPageID, $apiKEY;

// If Not logged in, redirect to author page
if(!is_user_logged_in()) { wp_redirect(get_the_permalink($LoginPageID)); exit(); }

get_header();

$favorites = explode(' ', get_user_meta(get_current_user_id(), 'movies', true)); // Turns String ID list into array
$favorites = array_filter($favorites); // Empty array removed

?>

<div class="favoritesPage">
    <div class="header">
        <div class="container spaceTop">
            <h1>My favorites</h1>
        </div>
    </div>
    <div class="body">
        <div class="container">
            <div class="content">
                <div class="movieCards">
                    <?php
                    if($favorites) {
                        foreach($favorites as $id) {

                            // RETRIEVES DATA
                            $movieInfo = wp_remote_get( 'https://api.themoviedb.org/3/movie/'.$id.'?api_key='.$apiKEY.'&language=en-US' ); // WP function for external APIs
                            $movieInfo = wp_remote_retrieve_body( $movieInfo ); // Gets body
                            $movieInfo = json_decode($movieInfo, true); // Array decode
                            $genres = array();

                            // GENERATE ID LIST
                            foreach($movieInfo['genres'] as $genre) {
                                $genres[] = $genre['id'];
                            }

                            // MOVIE INFO
                            // Pass variables to template part
                            $args = array(
                                'id'  => $movieInfo['id'],
                                'poster'  => $movieInfo['poster_path'],
                                'title' => $movieInfo['title'],
                                'genres' => $genres,
                                'release_date' => $movieInfo['release_date'],
                            );
                            get_template_part( 'components/movieCard', null, $args );

                        }
                    }
                    else { ?>

                    <p class="error">No favorites at the moment.</p>
                    <a href="<?php the_permalink($moviesPageID); ?>" class="mainBtn">See all movies</a>

                    <?php } ?>                    
                </div>
            </div>
        </div>
    </div>    
</div>

<?php get_footer(); ?>