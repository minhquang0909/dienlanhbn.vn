<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
use common\components\CFunction;
use yii\helpers\Url;
?>
<section class="dt-content-header">
    <div class="container">
        <h1 class="float-left"><?=Yii::t('frontend','Partners')?></h1>
        <ol class="float-right dt-breadcrumb">
            <li><a href="<?=Url::to(['site/index'])?>"><?=Yii::t('frontend','Home')?></a></li>
            <li class="active"><?=Yii::t('frontend','Partners')?></li>
        </ol>
        <div class="clearfix"></div>
    </div>
</section>
<div class="dt-partners">
    <div class="container">
        <?php
        if(isset($partners) && is_array($partners) && count($partners) > 0){ ?>
            <div class="dt-partners-list">
                <?php
                foreach ($partners as $item){
                    $link = 'javascript:void(0);';
                    $target = "";
                    if($item['website']!=''){
                        $link = $item['website'];
                        $target = "target=_blank";
                    }
                    if($item['thumbnail_path']!="" && Yii::$app->keyStorage->get('frontend.thumbnail')=='enable') {
                        $img_config = [
                            'glide/index',
                            'path' => $item['thumbnail_path'],
                            'w'     =>  250,
                            'h'     =>  250,
                        ];
                        $image = Yii::$app->glide->createSignedUrl($img_config, true);
                    }else{
                        $image = $item['thumbnail_base_url'].'/'.$item['thumbnail_path'];
                    }
                    ?>
                    <a href="<?=$link?>" <?=$target?> class="dt-partners-item">
                        <div class="dt-partners-item-inner">
                            <img class="dt-partners-item-image" src="<?=$image?>" />
                        </div>
                    </a>
                <?php }
                ?>
            </div>
            <?php
            $pager = CFunction::buildPagination(Url::to(['site/partners']), $total_page,$page,3);
            echo '<div class="text-center">'.$pager.'</div>';
            ?>
        <?php }else{
            echo '<div class="text-warning">'.Yii::t('frontend','No data').'</div>';
        }
        ?>
    </div>
</div>
