<?php
################### META TAGS (GENERATE CUSTOM TAB TITLE)
global $wp;
$url = home_url( $wp->request );

$width = '700';
$height = '700';
if(is_home()) { $title = 'Superflix | Coolest movies ever'; } else { $title = get_the_title() . ' | Superflix'; };
$content = 'Find your favorite movies!';
$image = get_theme_file_uri() . '/img/ogimage.png';

// Get variables from the header.php before the get_template_part
$args = wp_parse_args($args);
if($args) {
  if($args['title']) { $title = $args['title']; }
  if($args['content']) { $content = $args['content']; }
  if($args['image']) { $image = $args['image']; }
}
?>

<!-- WhatsApp/Facebook icons -->    
<meta property="og:locale" content="en_US" />
<meta property="og:image" content="<?php echo $image; ?>">
<meta property="og:image:secure_url" content="<?php echo $image; ?>" />
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo str_replace(array('"',"'"),'',$content); // Remove quotes ?>">
<meta property="og:url" content="<?php echo $url; ?>">
<link rel="canonical" href="<?php echo $url; ?>" />
<!--<meta property="og:image:type" content="image/png">-->
<meta property="og:image:width" content="<?php echo $width; ?>">
<meta property="og:image:height" content="<?php echo $height; ?>">
<!-- End WhatsApp/Facebook icons -->