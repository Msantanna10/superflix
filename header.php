<!DOCTYPE html>
<html lang="en-US">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Moacir Sant'anna">

    <?php
    ########## META TAGS FOR SEO (CUSTOM TITLE, IMAGE FOR SOCIAL MEDIA)
    global $apiKEY, $LoginPageID, $RegisterPageID, $FavoritesPageID, $moviesPageID, $peoplePageID, $SearchPageID;
    // IF IT'S A MOVIE DETAILS PAGE, REPLACES THE VARIABLES
    if(is_page($moviesPageID) && !empty(get_query_var('movie_id'))) {  
      $currentMovie = wp_remote_get( 'https://api.themoviedb.org/3/movie/'.get_query_var('movie_id').'?api_key='.$apiKEY.'&language=en-US&append_to_response=credits,alternative_titles,videos,similar' ); // WP function for external APIs
      $currentMovie = wp_remote_retrieve_body( $currentMovie ); // Gets body  
      global $globalCurrentMovie;
      $globalCurrentMovie = json_decode($currentMovie, true); // Array decode
      $title = $globalCurrentMovie['title'] . ' | Movie | Superflix';
      $args = array(
          'title'  => $globalCurrentMovie['title'],
          'content'  => (strlen($globalCurrentMovie['overview']) > 150) ? substr($globalCurrentMovie['overview'],0,150).'...' : $globalCurrentMovie['overview'],
          'image'  => 'https://image.tmdb.org/t/p/w500' . $globalCurrentMovie['poster_path'],
      );
    }
    // IF IT'S A PERSON DETAILS PAGE, REPLACES THE VARIABLES
    if(is_page($peoplePageID) && !empty(get_query_var('person_id'))) {  
      $currentPerson = wp_remote_get( 'https://api.themoviedb.org/3/person/'.get_query_var('person_id').'?api_key='.$apiKEY.'&language=en-US&append_to_response=movie_credits,images' ); // WP function for external APIs
      $currentPerson = wp_remote_retrieve_body( $currentPerson ); // Gets body  
      global $globalCurrentPerson;
      $globalCurrentPerson = json_decode($currentPerson, true); // Array decode
      $title = $globalCurrentPerson['name'] . ' | Person | Superflix';
      $args = array(
          'title'  => $globalCurrentPerson['name'],
          'content'  => (strlen($globalCurrentPerson['biography']) > 150) ? substr($globalCurrentPerson['biography'],0,150).'...' : $globalCurrentPerson['biography'],
          'image'  => 'https://image.tmdb.org/t/p/w500' . $globalCurrentPerson['profile_path'],
      );
    }
    get_template_part( 'inc/functions-meta-tags', null, $args );
    ########## END META TAGS FOR SEO
    ?>

    <title>
    <?php 
    ########## TAB TITLE
    $title = get_the_title() . ' | Superflix'; // Any other page
    if(is_home()) { $title = 'Superflix | Coolest movies ever'; } // Home
    if(is_page($moviesPageID) && empty(get_query_var('movie_id'))) { $title = 'Movies | Superflix'; } // Movies Listing Page
    elseif(is_page($moviesPageID) && !empty(get_query_var('movie_id'))) { $title = $args['title'] . ' | Movie | Superflix'; } // Movie Details Page
    if(is_page($peoplePageID) && empty(get_query_var('person_id'))) { $title = 'People | Superflix'; } // People Listing Page
    elseif(is_page($peoplePageID) && !empty(get_query_var('person_id'))) { $title = $args['title'] . ' | Person | Superflix'; } // Person Details Page
    // Shows the title based on the conditions above
    echo $title;
    ########## END TAB TITLE
    ?>
    </title>
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon.png">
 
    <link href="<?php bloginfo('template_url'); ?>/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">

    <?php
    wp_head();
    // Check if all pages were selected on the options page
    if(empty($LoginPageID) || empty($RegisterPageID) || empty($FavoritesPageID) || empty($moviesPageID) || empty($peoplePageID) || empty($SearchPageID)) {
      get_template_part( 'components/warning' );
    }
    ?>

  </head>

  <body <?php body_class(); ?>>

    <div class="navHeader"> 
      <div class="container">
        <div class="content">
          <div class="logo">
            <a href="<?php echo get_site_url(); ?>">
              <img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="Jobflix Logo">
            </a>
          </div>
          <div class="menuLinks">
            <div class="in">
              <ul>
                <li><a href="<?php the_permalink($moviesPageID); ?>">Movies</a></li>
                <li><a href="<?php the_permalink($peoplePageID); ?>">People</a></li>                
                <li><a href="<?php the_permalink($SearchPageID); ?>">Search</a></li>                
                <?php if(is_user_logged_in()) { ?>
                  <li><a href="<?php the_permalink($FavoritesPageID); ?>">Favorites</a></li>
                  <li class="red"><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
                <?php } ?>
                <?php if(!is_user_logged_in()) { ?>
                  <li class="red" id="signin"><a href="<?php the_permalink($LoginPageID); ?>">Login</a></li>
                  <li class="red" id="signup"><a href="<?php the_permalink($RegisterPageID); ?>">Register</a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="customBtn">
            <div class="in">
              <div id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mainContent">