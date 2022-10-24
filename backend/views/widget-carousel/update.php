<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarousel */

$this->title = Yii::t('backend', 'Update banner') . ': ' . Html::encode($model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Banner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="widget-carousel-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Thêm ảnh cho banner'), ['/widget-carousel-item/create', 'carousel_id'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <h4><b>Danh sách ảnh trong banner</b></h4>
    <?php echo GridView::widget([
        'dataProvider' => $carouselItemsProvider,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            [
                'attribute' => 'path',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->path ? Html::img($model->getImageUrl(), ['class'=>'img-banner']) : null;
                }
            ],
            'order',
            'title',
            //'url:url',
            'title_en',
            //'url_en:url',
            /*[
                'format' => 'html',
                'attribute' => 'caption',
            ],*/
            [
                'class'=>\common\grid\EnumColumn::className(),
                'attribute'=>'status',
                'enum'=>[
                    Yii::t('backend', 'Disabled'),
                    Yii::t('backend', 'Enabled')
                ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => '/widget-carousel-item',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
