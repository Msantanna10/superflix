<?php
// by year https://www.themoviedb.org/talk/5553f5e0c3a368208c0009cb
// gt: greater than greater than
// gte: greater than or equal or greater
// lt: less than less than
// lte: less than or equal or less
?>

<div class="pageList movieList">
    <div class="container">
        <div class="content space">
            <div class="divisionLeft">
                <div class="in">
                    <div class="filter">
                        <form>
                            <div class="columns">
                                <div class="field" id="keyword">
                                    <!-- People seem to complain about issues when using keywords -->
                                    <!-- https://api.themoviedb.org/3/search/keyword?api_key=3021016db8e9167219d287858c0f8d9f&query=elm -->
                                    <label>Type at least 3 characters:</label>
                                    <div class="wrap">
                                        <input type="text" name="keyword" placeholder="Keyword">
                                        <div class="options">
                                            <p class="loadText">Loading...</p>
                                        </div>
                                    </div>
                                    <span id="desc">Select a movie from the list</span>
                                </div>
                                <div id="dates" class="field noSelect">
                                    <label>Release date <span>(YYYY/MM/DD)</span>:</label>
                                    <div class="wrap">
                                        <div class="column">
                                            <input type="text" id="datepicker" name="date" placeholder="YYYY/MM/DD" onkeypress="return false;">
                                            <div class="toggle">
                                                <label>
                                                    <input type="checkbox" name="sortdate">
                                                    <div class="toggleBtn">
                                                        <div class="circle"></div>
                                                    </div>
                                                    <div class="options">
                                                        <span id="off">Before this date</span>
                                                        <span id="on">After this date</span>
                                                    </div>
                                                </label>
                                            </div>                                        
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                            <div class="field" id="genres">
                                <label>Genres:</label>
                                <div class="all noSelect">
                                    <?php
                                    global $apiKEY;
                                    $genres = wp_remote_get( 'https://api.themoviedb.org/3/genre/movie/list?api_key='.$apiKEY.'&language=en-US' ); // WP function for external APIs
                                    $genres = wp_remote_retrieve_body( $genres ); // Gets body
                                    $genres = json_decode($genres, true); // Array decode
                                    $genres = $genres['genres']; // List of genres
                                    foreach($genres as $genre) {
                                    ?>
                                    <label>
                                    <input type="checkbox" name="genre[]" value="<?php echo $genre['id']; ?>"> <span><?php echo $genre['name']; ?></span>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="divisionRight">
                <div class="in">
                    <div class="sortBy">
                        <p id="bold">Sort by:</p>
                        <select name="sortby">
                            <option value="popularity.desc">Popularity (More popular)</option>
                            <option value="popularity.asc">Popularity (Less popular)</option>
                            <option value="release_date.desc">Release (Newest to Oldest)</option>
                            <option value="release_date.asc">Release (Oldest to Newest)</option>
                            <option value="title.asc">Title (A-Z)</option>
                            <option value="title.desc">Title (Z-A)</option>
                            <option value="vote_average.desc">Reviews (Top to Lowest)</option>
                            <option value="vote_average.asc">Reviews (Lowest to Top)</option>
                        </select>
                    </div>
                    <div class="wrapMovies">
                        <div class="movieCards">
                            <div id="loading">
                                <div class="bulletouter">
                                    <div class="bulletinner"></div>
                                    <div class="mask"></div>
                                    <div class="dot"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>