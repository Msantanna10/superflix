<?php
##################### SCRIPTS
function custom_script_frontend() {
    global $moviesPageID, $peoplePageID, $SearchPageID;

    // De-register the built in jQuery
    wp_deregister_script('jquery');
    // Register the CDN version
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), null, false); 
    // Load new jquery
    wp_enqueue_script( 'jquery' );
    // Register Slick
    wp_register_script('slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, false); 
    // Register Datepicker
    wp_register_script('date-picker', 'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js', array('jquery'), null, false); 
    // Extra scripts
    wp_enqueue_script('extra-scripts', get_template_directory_uri() .'/js/extra-scripts.js?' . date('l jS \of F Y h:i:s A'), array('jquery'), null, true);
    // If it's homepage
    if(is_home()) {    
        // Upcoming movies (Home)
        wp_enqueue_style( 'slick-slider-external', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, '1.0', 'all' );
        wp_enqueue_script( 'slick-slider' ); 
        wp_enqueue_script('upcoming-home', get_template_directory_uri() .'/js/home/upcoming-movies.js?' . date('l jS \of F Y h:i:s A'), array('jquery','slick-slider'), null, true);
        wp_localize_script('upcoming-home', 'objVars', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
        // Popular people (Home)
        wp_enqueue_script('popular-people-home', get_template_directory_uri() .'/js/home/popular-people.js?' . date('l jS \of F Y h:i:s A'), array('jquery'), null, true);
        wp_localize_script('popular-people-home', 'objVars', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }
    // If it's a movie details page
    if(is_page($moviesPageID) && get_query_var('movie_id')) {
        wp_enqueue_style( 'slick-slider-external', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, '1.0', 'all' );
        wp_enqueue_script( 'slick-slider' ); 
        wp_enqueue_script('single-movie-slick-slider', get_template_directory_uri() .'/js/movie-details/slick-slider.js', array('jquery','slick-slider'), null, true);
        wp_enqueue_script('actions-movie-page', get_template_directory_uri() .'/js/movie-details/actions.js', array('jquery'), null, true);
        wp_localize_script('actions-movie-page', 'objVars', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }
    // If it's the movies listing page
    if(is_page($moviesPageID) && !get_query_var('movie_id')) {
        wp_enqueue_script( 'date-picker' );
        wp_enqueue_style( 'date-picker-css', '//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css', false, '1.0', 'all' );
        wp_enqueue_script('movies-list', get_template_directory_uri() .'/js/movies-listing/filter.js?' . date('l jS \of F Y h:i:s A'), array('jquery'), null, true);
        wp_localize_script('movies-list', 'objVars', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }
    // If it's a person details page
    if(is_page($peoplePageID) && get_query_var('person_id')) {
        wp_enqueue_style( 'slick-slider-external', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, '1.0', 'all' );
        wp_enqueue_script( 'slick-slider' ); 
        wp_enqueue_script('single-person-slick-slider', get_template_directory_uri() .'/js/person-details/slick-slider.js', array('jquery','slick-slider'), null, true);
    }
    // If it's a people listing page
    if(is_page($peoplePageID) && !get_query_var('person_id')) {
        wp_enqueue_script('people-list', get_template_directory_uri() .'/js/people-listing/filter.js?' . date('l jS \of F Y h:i:s A'), array('jquery'), null, true);
        wp_localize_script('people-list', 'objVars', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }
    // If it's the global search page
    if(is_page($SearchPageID)) {
        wp_enqueue_script('global-search', get_template_directory_uri() .'/js/global-search/search.js?' . date('l jS \of F Y h:i:s A'), array('jquery'), null, true);
        wp_localize_script('global-search', 'objVars', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }
}
add_action( 'wp_enqueue_scripts', 'custom_script_frontend' );
?>