<?php
use common\models\Article;
use yii\helpers\Url;
use yii\helpers\VarDumper;

$lastest_news_list = Article::getArticles(0,10);
if(is_array($lastest_news_list) && count($lastest_news_list) > 0){ ?>
    <div class="row row-tin-tuc-slider">
        <div class="col cot1 small-12 large-12">
            <div class="col-inner">
                <div class="container section-title-container">
                    <h3 class="section-title section-title-normal"><b></b>
                        <span class="section-title-main htitle"><i class="icon-star"></i>Tin Tức</span><b></b>
                    </h3>
                    <div class="dl-home-news-list">
                        <div class="mgb-slide-button" id="mb_pro_home_news_slide_button">
                            <a href="javascript:void(0);" class="slide-icon slide-icon-left " title="Trang trước" aria-disabled="true" style="display: block;"></a>
                            <a href="javascript:void(0);" class="slide-icon slide-icon-right " title="Trang sau" aria-disabled="false" style="display: block;"></a>
                        </div>
                        <div class="dl-home-news">
                            <?php
                            foreach ($lastest_news_list as $news){
                                echo Yii::$app->controller->renderPartial('/article/_item_home_news',[
                                        'model' =>  $news
                                ]);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>

<script>
    $('.dl-home-news').slick({
        dots: false,
        prevArrow: $('#mb_pro_home_news_slide_button .slide-icon-left'),
        nextArrow: $('#mb_pro_home_news_slide_button .slide-icon-right'),
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    prevArrow:false,
                    nextArrow:false,
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    prevArrow:false,
                    nextArrow:false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
