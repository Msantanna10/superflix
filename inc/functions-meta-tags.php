<?php
################### META TAGS
global $wp;
$url = home_url( $wp->request );

$width = '500';
$height = '500';
if(is_singular('post')) {
    $image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full' );
    if($image) {
      $image = str_replace(array('-150x150','-100x100'), '', $image);
      $image_id = attachment_url_to_postid( $image );
      $image = wp_get_attachment_image_src($image_id, 'full');
      $image = $image[0];

      list($width, $height) = getimagesize($image); 
    }
    else {
      $image = get_theme_file_uri() . '/img/ogimage.png';
    }

    $title = get_the_title();
    $content = wp_strip_all_tags(get_the_content());
    $content = (strlen($content) > 150) ? substr($content,0,150).'...' : $desc;
}
if(is_page()) {
    $title = get_the_title() . ' | ' . get_bloginfo('name');
}
if(is_home() || is_front_page()) {
    $title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
}

// If ogimage is empty
if(empty($image)) { $image = get_theme_file_uri() . '/img/ogimage.png'; }
if(empty($title)) { $title = 'Superflix'; }
if(empty($content)) { $content = 'Visit our website for more information!'; }
?>

<!-- WhatsApp/Facebook icons -->    
<meta property="og:locale" content="en_US" />
<meta property="og:image" content="<?php echo $image; ?>">
<meta property="og:image:secure_url" content="<?php echo $image; ?>" />
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $content; ?>">
<meta property="og:url" content="<?php echo $url; ?>">
<link rel="canonical" href="<?php echo $url; ?>" />
<!--<meta property="og:image:type" content="image/png">-->
<meta property="og:image:width" content="<?php echo $width; ?>">
<meta property="og:image:height" content="<?php echo $height; ?>">
<!-- End WhatsApp/Facebook icons -->