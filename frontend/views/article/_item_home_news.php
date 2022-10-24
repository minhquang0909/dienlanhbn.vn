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
<div class="post-item">
    <div class="col-inner">
        <a href="<?=$url_detail;?>" class="plain">
            <div class="box box-normal box-text-bottom box-blog-post has-hover">
                <div class="box-image" style="border-radius:3%;">
                    <div class="image-overlay-add image-cover" style="padding-top:65%;">
                        <img width="700" height="525" src="<?php echo CFunction::buildThumbnail($model,350,263);?>" class="attachment-medium size-medium wp-post-image lazy-load-active" alt="<?=$model['title']?>">
                        <div class="overlay" style="background-color: rgba(255, 124, 0, 0.31)"></div>
                    </div>
                </div>
                <div class="box-text text-left is-small">
                    <div class="box-text-inner blog-post-inner">
                        <h5 class="post-title is-large "><?=Html::encode($model['title'])?></h5>
                        <div class="post-meta is-small op-8"><?=date('d/m/Y',$model['created_at'])?></div>
                        <div class="is-divider"></div>
                        <p class="from_the_blog_excerpt "><?php echo strip_tags(CFunction::cut_string($model['body'], 100))?></p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>