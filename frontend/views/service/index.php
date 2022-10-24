<?php
/* @var $this yii\web\View */
$this->title = Yii::t('frontend', 'Promotion');
?>
<style>
    .home .page-wrapper{
        padding: 30px 0 !important;
    }
</style>
<div id="content" class="blog-wrapper blog-archive page-wrapper">
    <div class="row row-large ">
        <div class="large-9 col">
            <div class="row large-columns-1 medium-columns- small-columns-1">
                <div class="bg-color lxb-news-index">
                    <div class="lxb-news-list">
                        <?php
                        if(isset($services) && is_array($services) && count($services) > 0 ){
                            $d=0;
                            foreach ($services as $service) {
                                $d++;
                                echo Yii::$app->controller->renderPartial('_item', [
                                    'count' => $d,
                                    'page' => $page,
                                    'limit' => $limit,
                                    'offset' => $offset,
                                    'total_page' => $total_page,
                                    'model' => $service,
                                ]);
                            }
                        }else{
                            echo '<div class="alert alert-warning">Chưa có dịch vụ nào</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="text-center"><?php echo $pagination; ?></div>
        </div>
        <div class="post-sidebar large-3 col cat-menu">
            <?php
            echo Yii::$app->controller->renderPartial('/product/_cat_menu',[

            ]);
            ?>
        </div>
    </div>

</div>

