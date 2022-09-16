<?php
// Get variables from the foreach before the get_template_part
$args = wp_parse_args($args);
$movieID = $args['id'];
$movieImg = $args['poster'];
$movieTitle = $args['title'];
$movieGenreIDs = $args['genres'];
$character = (!empty($args['character'])) ? $args['character'] : null;
$movieReleaseDate = $args['release_date'];

global $moviesPageID;
?>

<div class="card">
    <a href="<?php echo get_the_permalink($moviesPageID) . $movieID; ?>" class="cardIn">
        <div class="head">
            <div class="imgBg" style="<?php if($movieImg) { ?>background-image: url('https://image.tmdb.org/t/p/w300<?php echo $movieImg; ?>');<?php } ?>"></div>
            <div class="shadow"></div>    
        </div>
        <div class="infos">

            <h2><?php echo $movieTitle; ?></h2>
            
            <?php if($character) { ?>
            <p class="character"><b>Character:</b> <?php echo $character; ?></p>
            <?php } ?>

            <p class="date"><b>Release date:</b> <?php echo str_replace('-','/',date("m-d-Y", strtotime($movieReleaseDate))); ?></p>

            <?php if( $movieGenreIDs ) { ?>
            <p class="genre"><b>Genre:</b> 
                <span class="wrap">
                    <?php foreach( $movieGenreIDs as $id ) { echo '<span class="genre">'.genreName($id).'</span>'; } // End foreach ?>
                </span>
            </p>
            <?php } // End IF ?>

        </div>
    </a>
</div>