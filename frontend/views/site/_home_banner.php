<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\CFunction;
use common\models\WidgetCarouselItem;
use common\models\Banner;
use yii\helpers\VarDumper;

$home_banner = WidgetCarouselItem::getBannerByPosition(Banner::HOME_TOP_BANNER, Banner::LIMIT_HOME_TOP_BANNER);
?>

<div class="dl-home-banner">
    <div class="mgb-slide-button" id="mb_pro_home_news_slide_button">
        <a href="javascript:void(0);" class="slide-icon slide-icon-right " title="Trang sau" aria-disabled="false" style="display: block;"></a>
    </div>
    <div class="dl-home-banner-list">
        <?php
        if(is_array($home_banner) && count($home_banner) > 0){
            foreach ($home_banner as $banner){
                $banner_img = CFunction::buildThumbnail([
                    'thumbnail_base_url' => $banner['base_url'],
                    'thumbnail_path' => $banner['path'],
                ], 950, 380);
                ?>
                <div class="dl-item-banner">
                    <?php
                    if($banner['url']!=""){
                        echo '<a target="_blank" href="'.$banner['url'].'"><img src="'.$banner_img.'"/></a>';
                    }else{
                        echo '<img src="'.$banner_img.'"/>';
                    }
                    ?>

                </div>
            <?php }
        }
        ?>
    </div>
</div>
<script>
    $('.dl-home-banner-list').slick({
        dots: false,
        nextArrow: $('.dl-home-banner .slide-icon-right'),
        infinite: true,
        autoplay:true,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
</script>