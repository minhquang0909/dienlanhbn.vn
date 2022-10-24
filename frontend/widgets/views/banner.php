<?php
use common\components\CFunction;
use yii\helpers\Html;


if(isset($items) && is_array($items) && count($items) > 0){
    $banner_id = 'lxb_carousel_'.$key.'';
    $class_css = isset($options['class'])?$options['class']:'';
    ?>
    <div id="<?=$banner_id?>" key="<?=$key?>" class="lxb-carousel carousel <?=$class_css?>" data-ride="carousel">
        <!-- Indicators -->
        <?php
        if(isset($showIndicators) && $showIndicators && count($items) > 1){
            echo '<ol class="carousel-indicators">';
                $d=0;
                foreach ($items as $item){
                echo '<li data-target="#'.$banner_id.'" data-slide-to="'.$d.'" class="'.($d==0?'active':'').'"></li>';
                $d++;
                }
            echo '</ol>';
        }
        ?>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $d2=0;
            foreach ($items as $item){
                $img = $item->getImageUrl();
                $title = CFunction::getAttributeByLanguage($item,"title");
                $caption = CFunction::getAttributeByLanguage($item,"caption");
                ?>
                <div class="item <?=($d2==0?"active":"")?>" style="background-image: url('<?=$img?>');">
                    <!--<img src="<?/*=$img*/?>" alt="Los Angeles">-->
                    <div class="carousel-caption">
                        <?php
                        if(isset($title) && $title!=""){
                          echo '<h3>'.($title).'</h3>';
                        }
                        if(isset($caption) && $caption!=""){
                            echo '<p>'.Html::encode($caption).'</p>';
                        }
                        if(isset($item->url) && trim($item->url)!="" && $item->url!="/"){
                            echo '<a class="btn btn-link-detail" href="'.$item->url.'" target="_blank">'.Yii::t('frontend','View more').'</a>';
                        }
                        ?>
                    </div>
                </div>
            <?php
                $d2++;
            }
            ?>
        </div>
        <?php
        if(isset($controls) && $controls){?>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#<?=$banner_id?>" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#<?=$banner_id?>" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        <?php }
        ?>
    </div>
<?php }
?>