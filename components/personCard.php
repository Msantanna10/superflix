<?php
// Get variables from the foreach before the get_template_part
$args = wp_parse_args($args);
$personID = $args['id'];
$personImg = $args['poster'];
$personName = $args['name'];
$personRole = $args['role'];

global $peoplePageID;
?>

<div class="card">
    <div class="cardIn">
        <a href="<?php echo get_the_permalink($peoplePageID) . $personID; ?>" class="head">
            <div class="imgBg" style="<?php if($personImg) { ?>background-image: url('https://image.tmdb.org/t/p/w300/<?php echo $personImg; ?>');<?php } ?>">
                <div class="shadow"></div>
            </div>
            <div class="meta">
                <h2><?php echo $personName; ?></h2>
                <span class="role"><?php echo $personRole; ?></span>
            </div>            
        </a>
    </div>
</div>