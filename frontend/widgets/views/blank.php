<?php
if(isset($items) && is_array($items) && count($items) > 0){
    foreach ($items as $item) {
        $img = $item->getImageUrl();
        echo '<a href="'.($item->url!=""?$item->url:"#").'" target="_blank"><img src="'.$img.'" /></a>';
    }
}