<?php
use yii\helpers\Html;
use yii\helpers\Url;
if(isset($items) && is_array($items) && count($items) > 0){
?>
    <div class="lxb-slide-two-colunm">
    <div class="row row-wrapper">
        <div class="col-md-2 col-md-offset-2 left">
            <div class="info">
                <?php
                $d=0;
                foreach ($items as $item){
                    $d++;
                    if(isset($item->title) && $item->title!=""){?>
                        <div class="item <?=($d==1?'active':'')?>" data-index="<?=$d?>">
                            <div class="number"><?=$d?></div>
                            <div class="text"><?=Html::encode($item->title)?></div>
                        </div>
                    <?php }
                }
                ?>
                <div class="item no-hover">
                    <div class="text">
                        <a data-index="-1" href="<?=Url::to(['site/contact'])?>" class="btn btn-warning btn-view-detail">Đặt lịch ngay</a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-md-8 no-pad right">
            <div class="images-list">
                <?php
                $d2=0;
                foreach ($items as $item){
                    $d2++;
                    $img = $item->getImageUrl();
                    if(isset($item->url) && trim($item->url)!="" && $item->url!="/"){
                        $href = "href=".$item->url." target=\"_blank\"";
                    }else{
                        $href = "";
                    }
                    ?>
                    <div class="item <?=($d2==1?'active':'')?>" id="item_<?=$d2?>">
                        <a class="thumb" <?=$href?> style="background-image: url('<?=$img?>')">
                            <img src="<?=$img?>"/>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>