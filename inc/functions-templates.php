<?php
################### PAGE TEMPLATES
// Extend templates to work from subfolders
add_filter('theme_page_templates', function($post_templates) {
    $directories = glob(get_template_directory() . '/pages/*' , GLOB_ONLYDIR);
    
    foreach ($directories as $dir) {
      $templates = glob($dir.'/*.php');
        
      foreach ($templates as $template) {
        if (preg_match('|Template'.' '.'Name: (.*)$|mi', file_get_contents($template), $name)) {
          $post_templates['/pages/'.basename($dir).'/'.basename($template)] = $name[1];
        }
      }
    }
  
    return $post_templates;

});
?>