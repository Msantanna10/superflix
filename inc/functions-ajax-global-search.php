<?php
################### AJAX GLOBAL SEARCh
add_action('wp_ajax_nopriv_global_search', 'global_search');
add_action('wp_ajax_global_search', 'global_search');
function global_search(){

    global $apiKEY, $moviesPageID, $peoplePageID;

    // VARIABLES FROM REQUEST
    $keyword = $_REQUEST['keyword'];

    // APPEND PARAMETERS VALUES
    $args = array();
    if(!empty($keyword)) { $args['query'] = $keyword; } // Query

    // REQUESTS FOR MOVIES
    $movieInfo = wp_remote_get( add_query_arg( $args, 'https://api.themoviedb.org/3/search/movie?api_key='.$apiKEY.'&language=en-US' ) ); // WP function for external APIs
    $movieInfo = wp_remote_retrieve_body( $movieInfo ); // Gets body
    $movieInfo = json_decode($movieInfo, true); // Array decode
    $movieInfo = array_slice($movieInfo['results'], 0, 10); // Limit to 10 due to request limitations (sometimes it breaks with a higher value)
    $customMoviesOrder = array();
    $count = 0;
    foreach($movieInfo as $movie) {
        $today = new DateTime(date('Y-m-d'));
        $release_date = new DateTime($movie['release_date']);
        $days = $release_date->diff($today)->format('%a');
        $sortNumber = (round($movie['popularity']) * $movie['vote_count'] / $days); // Formula: Popularity * vote_count (views was not available) / days release (number of days from release date until now)
        $customMoviesOrder[$count] = array();
        $customMoviesOrder[$count]['id'] = $movie['id'];
        $customMoviesOrder[$count]['sort'] = (float) $sortNumber;
        $customMoviesOrder[$count]['days_from_today'] = $days;
        $customMoviesOrder[$count]['title'] = $movie['title'];
        $customMoviesOrder[$count]['poster_path'] = $movie['poster_path'];
        $customMoviesOrder[$count]['release_date'] = $movie['release_date'];
        $count++;
    }
    // SORT BY THE 'SORT' KEY VALUE
    $keys = array_column($customMoviesOrder, 'sort');
    array_multisort($keys, SORT_DESC, $customMoviesOrder);
    // print_r($customMoviesOrder);

    // REQUEST FOR PEOPLE
    $personInfo = wp_remote_get( add_query_arg( $args, 'https://api.themoviedb.org/3/search/person?api_key='.$apiKEY.'&language=en-US' ) ); // WP function for external APIs
    $personInfo = wp_remote_retrieve_body( $personInfo ); // Gets body
    $personInfo = json_decode($personInfo, true); // Array decode
    $personInfo = array_slice($personInfo['results'], 0, 10); // Limit to 10 due to request limitations (sometimes it breaks with a higher value)
    // print_r($personInfo);

    ob_start();

    echo '<div class="wrapper">';
        // MOVIES
        echo '<div class="singleWrapper" id="movies"><h2>Movies list <span>(10 results per search)</span></h2>';
            echo '<div class="searchCards">';
            if($customMoviesOrder) {
            foreach($customMoviesOrder as $movie) {
            $bg = get_bloginfo('template_url') . '/img/noposter.jpg';
            if(!empty($movie['poster_path'])) { $bg = 'https://image.tmdb.org/t/p/w300' . $movie['poster_path']; }
            ?>  
            <div class="card">
                <a class="in" href="<?php echo get_the_permalink($moviesPageID) . $movie['id']; ?>">
                    <div class="head">
                        <div class="imgBg" style="background-image: url('<?php echo $bg; ?>');"></div>
                        <div class="shadow"></div>    
                    </div>
                    <div class="infos">
                        <h2><?php echo $movie['title']; ?></h2>
                        <!--<p id="sort"><?php echo $movie['sort']; ?></p>-->
                        <span id="cta">More about this movie</span>
                    </div>
                </a>
            </div>
            <?php } // End foreach
            } // End IF
            else { echo '<p class="error">No movie was found! Try a different keyword.</p>'; }
            echo '</div>';
        echo '</div>';

        // PEOPLE
        echo '<div class="singleWrapper" id="people"><h2>People list <span>(10 results per search)</span></h2></h2>';
            echo '<div class="searchCards">';
            if($personInfo) {
            $genders = array(
                0 => 'person', // 'Not specified',
                1 => 'actress', // 'Female',
                2 => 'actor' // 'Male'
            );
            foreach($personInfo as $person) {
            $bg = get_bloginfo('template_url') . '/img/noimage.jpg';
            if(!empty($person['profile_path'])) { $bg = 'https://image.tmdb.org/t/p/w300' . $person['profile_path']; }
            ?>  
            <div class="card">
                <a class="in" href="<?php echo get_the_permalink($peoplePageID) . $person['id']; ?>">
                    <div class="head">
                        <div class="imgBg" style="background-image: url('<?php echo $bg; ?>');"></div>
                        <div class="shadow"></div>    
                    </div>
                    <div class="infos">
                        <h2><?php echo $person['name']; ?></h2>
                        <p id="popularity"><b>Popularity</b> <?php echo round($person['popularity']); ?></p>
                        <span id="cta">More about this <?php echo $genders[$person['gender']]; ?></span>
                    </div>
                </a>
            </div>
            <?php } // End foreach
            } // End IF
            else { echo '<p class="error">No person was found! Try a different keyword.</p>'; }
            echo '</div>';
        echo '</div>';

    echo '</div>'; // .wrapper
    
    $html = ob_get_clean();
    
    echo $html;

exit();

} // End IF function
                
?>