<?php
// Get variables before the get_template_part
$args = wp_parse_args($args);
$movieID = $args['id'];
$title = $args['title'];
$tagline = $args['tagline'];
$videos = $args['videos'];
$poster = $args['poster']; 
$genres = $args['genres']; 
$alternativeTitles = $args['alternativeTitles'];
$overview = $args['overview'];
$productionCompanies = $args['productionCompanies'];
$release = $args['release'];
$originalLang = $args['originalLang'];
$cast = $args['cast'];
$popularity = $args['popularity'];
$reviews = $args['reviews'];
$similarMovies = $args['similarMovies'];
$favorites = explode(' ', get_user_meta(get_current_user_id(), 'movies', true)); // Turns String ID list into array
?>

<div class="modal">
    <div class="modalIn">
        <div class="container">
            <div class="content">
                <div class="body">
                <span class="close noSelect">X</span>
                <iframe src="" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pageDetails">
    <div class="container">
        <div class="content spaceTop">
            <div class="divisionLeft">
                <div class="in">
                    <div class="sticky">
                        <div class="bg" style="background-image: url('https://image.tmdb.org/t/p/w400/<?php echo $poster; ?>')"></div>
                        <?php if($release) { ?><p id="release"><b>Release date:</b> <span><?php echo str_replace('-','/',date("m-d-Y", strtotime($release))); ?> <img src="<?php bloginfo('template_url'); ?>/img/calendar.png" alt="Release"></span></p><?php } ?>
                        <?php if($popularity) { ?><p id="popularity"><b>Popularity:</b> <span><?php echo round($popularity); ?> <img src="<?php bloginfo('template_url'); ?>/img/popularity.png" alt="Popularity" style="height: 17px;"></span></p><?php } ?>
                        <?php if($originalLang) { ?><p id="lang"><b>Original language:</b> <span><?php echo strtoupper($originalLang); ?> <img src="<?php bloginfo('template_url'); ?>/img/language.png" alt="Language"></span></p><?php } ?>
                        <div class="favBar" data-action="<?php if(in_array($movieID, $favorites)) { echo 'remove'; } else { echo 'add'; } ?>" data-movie="<?php echo $movieID; ?>">
                            <img class="heart" src="<?php bloginfo('template_url'); ?>/img/heart.svg" alt="Heart"> <span><?php if(in_array($movieID, $favorites)) { echo 'Remove from favorites'; } else { echo 'Add to favorites'; } ?></span>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="divisionRight">
                <div class="in">
                    <h1><?php echo $title; ?></h1>
                    <h2><?php echo $tagline; ?></h2>
                    <div class="reviews">
                        <img src="<?php bloginfo('template_url'); ?>/img/star.png" alt="Star - Review"> <b><?php echo round($reviews); ?></b>
                    </div>
                    <div class="genres">
                        <?php
                        foreach($genres as $genre) { echo '<span>'.$genre['name'].'</span>'; }
                        ?>                        
                    </div>
                    <?php if($overview) { ?>
                    <div class="overview block">
                        <h3>Overview</h3>
                        <p><?php echo $overview; ?></p>
                    </div>
                    <?php } ?>
                    <?php if($alternativeTitles) { ?>
                    <div class="titles block <?php if(count($alternativeTitles) >= 6) { echo 'moreThan6'; } ?>">
                        <h3>Alternative titles</h3>
                        <div class="all">
                            <?php
                            foreach($alternativeTitles as $title) {
                            ?>
                            <p><?php echo $title['title']; ?></p>
                            <?php } ?>
                            <div class="shadow"></div>
                        </div>
                        <span id="show">Show all</span>
                    </div>
                    <?php } ?>
                    <?php if($productionCompanies) { ?>
                    <div class="production block">
                        <h3>Production companies</h3>
                        <div class="all">
                            <?php foreach($productionCompanies as $company) {
                                if($company['logo_path']) {
                            ?>
                                <div class="single">
                                    <div class="singleIn">
                                        <img id="logo" src="https://image.tmdb.org/t/p/w200/<?php echo $company['logo_path']; ?>" alt="Logo - <?php echo $company['name']; ?>">                                        
                                    </div>
                                </div>
                            <?php } // End foreach
                                } // End IF
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($cast) { ?>
                    <div class="cast block">
                        <h3>Cast</h3>
                        <div class="wrapSlick">
                            <div class="actorCards slick-cast slick-shadow slick-hide">
                                <?php
                                foreach($cast as $person) {
                                    // PERSON INFO
                                    // Pass variables to template part
                                    $args = array(
                                        'id'  => $person['id'],
                                        'poster'  => $person['profile_path'],
                                        'name' => $person['name'],
                                        'role' => $person['known_for_department']
                                    );
                                    get_template_part( 'components/personCard', null, $args );
                                } ?>
                            </div>
                            <div class="arrows">
                                <img src="<?php bloginfo('template_url'); ?>/img/arrow-left.png" alt="Arrow" id="prev">
                                <img src="<?php bloginfo('template_url'); ?>/img/arrow-right.png" alt="Arrow" id="next">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($videos) { ?>
                    <div class="videos block">
                        <h3>Trailers</h3>
                        <div class="wrapSlick">
                            <div class="videoCards slick-videos slick-shadow slick-hide">
                                <?php foreach($videos as $video) {
                                    if($video['type'] == 'Trailer') {
                                ?>
                                    <div class="videoCard" data-video="<?php echo $video['key']; ?>">
                                        <div class="cardIn">
                                            <div class="bg" style="background-image: url('https://img.youtube.com/vi/<?php echo $video['key']; ?>/mqdefault.jpg')">
                                                <div class="shadow">
                                                    <img src="<?php bloginfo('template_url'); ?>/img/player.png" alt="Player" class="player">
                                                </div>
                                            </div>
                                            <h4><?php echo $video['name']; ?></h4>
                                        </div>
                                    </div>
                                <?php } // End IF
                                    } // End foreach
                                ?>
                            </div>
                            <div class="arrows">
                                <img src="<?php bloginfo('template_url'); ?>/img/arrow-left.png" alt="Arrow" id="prev">
                                <img src="<?php bloginfo('template_url'); ?>/img/arrow-right.png" alt="Arrow" id="next">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if($similarMovies) { ?>
        <div class="recommended space">
            <h2>You may also like</h2>
            <div class="wrapSlick">
                <div class="movieCards slick-movies slick-hide slick-shadow">
                    <?php
                    foreach($similarMovies as $movie) {
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
                    } ?>
                </div>
                <div class="arrows">
                    <img src="<?php bloginfo('template_url'); ?>/img/arrow-left.png" alt="Arrow" id="prev">
                    <img src="<?php bloginfo('template_url'); ?>/img/arrow-right.png" alt="Arrow" id="next">
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>