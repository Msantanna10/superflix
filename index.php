<?php get_header();
global $moviesPageID, $peoplePageID;
?>

<div class="upComing spaceTop">
    <div class="container">
        <div class="content">
            <h1>Upcoming movies</h1>
            <div class="wrapSlick">
                <div class="movieCards slick-movies slick-hide slick-shadow">
                    <div id="loading">
                        <div class="bulletouter">
                            <div class="bulletinner"></div>
                            <div class="mask"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                </div>
                <div class="arrows">
                    <img src="<?php bloginfo('template_url'); ?>/img/arrow-left.png" alt="Arrow" id="prev">
                    <img src="<?php bloginfo('template_url'); ?>/img/arrow-right.png" alt="Arrow" id="next">
                </div>
            </div>
            <a href="<?php the_permalink($moviesPageID); ?>" class="mainBtn">See all movies</a>
        </div>
    </div>
</div>

<div class="popularActors space">
    <div class="container">
        <div class="content">
            <h1>Most popupar actors</h1>
            <div class="wrapSlick">
                <div class="actorCards slick-people slick-hide slick-shadow">
                    <div id="loading">
                        <div class="bulletouter">
                            <div class="bulletinner"></div>
                            <div class="mask"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                </div>
                <div class="arrows">
                    <img src="<?php bloginfo('template_url'); ?>/img/arrow-left.png" alt="Arrow" id="prev">
                    <img src="<?php bloginfo('template_url'); ?>/img/arrow-right.png" alt="Arrow" id="next">
                </div>
            </div>
            <a href="<?php the_permalink($peoplePageID); ?>" class="mainBtn">See all actors</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>