<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
use yii\helpers\Html;
use common\components\CFunction;
use yii\helpers\Url;
$url_detail = Url::toRoute(['article/detail', 'slug' => $model['slug']]);
?>
<div class="col post-item">
    <div class="col-inner">
        <a href="<?php echo $url_detail;?>" class="plain">
            <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                <div class="box-image" style="width:40%;">
                    <div class="image-cover" style="padding-top:56%;">
                        <img src="<?php echo CFunction::buildThumbnail($model,350,263);?>" class="attachment-medium size-medium wp-post-image lazy-load-active" alt="<?=$model['title']?>">
                    </div>
                </div>
                <div class="box-text text-left">
                    <div class="box-text-inner blog-post-inner">
                        <h5 class="post-title is-large "><?php echo $model['title']?></h5>
                        <div class="is-divider"></div>
                        <p class="from_the_blog_excerpt "><?php echo CFunction::cut_string($model['description'], 300)?></p>
                    </div>
                </div>
                <div class="badge absolute top post-date badge-square">
                    <div class="badge-inner">
                        <span class="post-date-day"><?php echo date('d', $model['created_at']??time());?></span>
                        <br>
                        <span class="post-date-month is-xsmall">Th<?php echo str_replace("0","",date('m', $model['created_at']??time()));?></span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>