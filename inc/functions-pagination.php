<?php
############# PAGINATION
function pagination($pages, $paged) {  

    $range = 5;

     $showitems = ($range * 2)+1;  
 
     if(empty($paged)) $paged = 1;
 
     if($pages == '') {
         $pages = $pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages) {  

        echo "<div class=\"pagination\">";

        // ARROWS BEFORE   
        $prev = $paged - 1;     
        if($paged > 1) echo '<span id="prev" class="arrow inactive" data-number="'.$prev.'"><img src="'.get_bloginfo('template_url').'/img/arrow-left.png" alt="Arrow"></span>';

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
               // $i_format = (strlen($i) == 1) ? '0'.$i : $i; // with zero
               echo ($paged == $i)? "<span class=\"current\" data-number=".$i.">".$i."</span>":"<span class=\"inactive\" data-number=".$i."><span class=\"number\">".$i."</span></span>";
            }
        }

        if($paged < $pages) { $next = $paged + 1; echo '<span id="next" class="arrow inactive" data-number="'.$next.'"><img src="'.get_bloginfo('template_url').'/img/arrow-right.png" alt="Arrow"></span>'; }        

        echo "</div>\n";
    }
}
?>