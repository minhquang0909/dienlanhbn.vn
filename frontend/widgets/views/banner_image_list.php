<?php
if(isset($items) && is_array($items) && count($items) > 0){?>
    <div class="images-list clearfix">
        <?php
        foreach ($items as $item){
            $img = $item->getImageUrl();
            if(isset($item->url) && trim($item->url)!="" && $item->url!="/"){
                $href = "href=".$item->url." target=\"_blank\"";
            }else{
                $href = "";
            }
            ?>
            <div class="item item-6">
                <a style="background-image: url('<?=$img?>');" <?=$href?> class="thumb">
                    <img src="<?=$img?>"/>
                </a>
            </div>
        <?php }
        ?>
    </div>
<?php }
?>