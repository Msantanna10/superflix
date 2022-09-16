<?php
// Get variables before the get_template_part
$args = wp_parse_args($args);
$profile_path = $args['profile_path'];
$name = $args['name'];
$birthday = $args['birthday'];
$place_of_birth = $args['place_of_birth']; 
$deathday = $args['deathday']; 
$popularity = $args['popularity'];
$biography = $args['biography'];
$images = $args['images'];
$cast = $args['cast'];
?>

<div class="modal personImg">
    <div class="modalIn">
        <div class="container">
            <div class="content">
                <div class="body">
                <span class="close noSelect">X</span>
                <img src="" alt="Image">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pageDetails">
    <div class="container">
        <div class="content space">
            <div class="divisionLeft">
                <div class="in">
                    <div class="sticky">
                        <div class="bg" style="background-image: url('https://image.tmdb.org/t/p/w400<?php echo $profile_path; ?>')"></div>
                        <?php if($popularity) { ?><p id="popularity"><b>Popularity:</b> <span><?php echo round($popularity); ?> <img src="<?php bloginfo('template_url'); ?>/img/popularity.png" alt="Popularity" style="height: 17px;"></span></p><?php } ?>
                    </div>                    
                </div>
            </div>
            <div class="divisionRight">
                <div class="in">
                    <h1><?php echo $name; ?></h1>
                    <?php if($biography) { ?>
                    <div class="biography block">
                        <h3>Biography</h3>
                        <p><?php echo $biography; ?></p>
                    </div>
                    <?php } ?>
                    <?php if($birthday) { ?>
                    <div class="birthday block">
                        <h3>Birthday</h3>
                        <p><?php echo $birthday; ?></p>
                    </div>
                    <?php } ?>
                    <?php if($place_of_birth) { ?>
                    <div class="placeofbirth block">
                        <h3>Place of birth</h3>
                        <p><?php echo $place_of_birth; ?></p>
                    </div>
                    <?php } ?>
                    <?php if($deathday) { ?>
                    <div class="deathday block">
                        <h3>Death day</h3>
                        <p><?php echo $deathday; ?></p>
                    </div>
                    <?php } ?>
                    <?php if($images) { ?>
                    <div class="gallery block">
                        <h3>Gallery</h3>
                        <div class="all">
                            <?php foreach($images as $img) {
                            $imgSmall = get_bloginfo('template_url') . '/img/noimage.jpg';
                            $imgBig = get_bloginfo('template_url') . '/img/noimage.jpg';
                            if(!empty($img['file_path'])) { 
                                $imgSmall = 'https://image.tmdb.org/t/p/w200/'.$img['file_path'];
                                $imgBig = 'https://image.tmdb.org/t/p/w400/'.$img['file_path'];
                            }
                            ?>
                            <div class="single" style="background-image: url('https://image.tmdb.org/t/p/w200/<?php echo $imgSmall; ?>');">
                                <div class="in">
                                    <img data-image="<?php echo $imgBig; ?>" src="<?php bloginfo('template_url'); ?>/img/zoom.png" alt="Zoom">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if($cast) { ?>
        <div class="recommended spaceBottom">
            <h2>Movies</h2>
            <div class="wrapSlick">
                <div class="movieCards slick-movies slick-hide slick-shadow">
                    <?php
                    foreach($cast as $movie) {
                        // MOVIE INFO
                        // Pass variables to template part
                        $args = array(
                            'id'  => $movie['id'],
                            'poster'  => $movie['poster_path'],
                            'title' => $movie['title'],
                            'genres' => null, // $movie['genre_ids']
                            'character' => $movie['character'],
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