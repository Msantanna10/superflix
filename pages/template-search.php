<?php
/* Template Name: Global Search (movies & actors) */

global $searchPageID, $apiKEY;

get_header();
?>

<div class="searchPage pageList">
    <div class="header">
        <div class="container spaceTop">
            <h1>Global search</h1>
        </div>
    </div>
    <div class="body spaceBottom">
        <div class="container">
            <div class="content">
                <div class="head">
                    <div class="field blockSearch">
                        <input type="text" placeholder="Movie or actor name" name="keyword">
                        <input type="submit" value="Find">
                    </div>
                    <span id="desc">Type at least 3 characters to enable the "Find" button</span>
                </div>
                <div class="results">
                    <div class="in">
                        <p class="error">Type a keyword and hit "Find"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<?php get_footer(); ?>