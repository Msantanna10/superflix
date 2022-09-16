<!DOCTYPE html>
<html lang="en-US">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Moacir Sant'anna | Wunderdogs">

    <?php get_template_part('inc/functions-meta-tags'); ?>

    <title>Superflix | Coolest movies ever</title>
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon.png">
 
    <link href="<?php bloginfo('template_url'); ?>/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">

    <?php
    wp_head();
    global $LoginPageID, $RegisterPageID, $FavoritesPageID, $moviesPageID, $peoplePageID;
    // Check if all pages have ID
    if(empty($LoginPageID) || empty($RegisterPageID) || empty($FavoritesPageID) || empty($moviesPageID) || empty($peoplePageID)) {
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