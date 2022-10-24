<?php

use common\grid\EnumColumn;
use common\models\ArticleCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use \common\components\CFunction;
$this->title = 'Tin tức';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="article-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            'Tạo mới tin tức',
            ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            [
                'attribute' =>  'id',
                'contentOptions' => ['style' => 'width:100px'],
            ],
            [
                'attribute' => 'thumbnail_path',
                'header' => 'Ảnh đại diện',
                'format' => 'html',
                'value' => function ($model) {
                    return '<img class="img-thumb" src="'.CFunction::getDomain().$model->thumbnail_base_url.'/'.$model->thumbnail_path.'"/>';
                }
            ],
            'title',
            'slug',
            /*[
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category ? $model->category->title : null;
                },
                'filter' => ArrayHelper::map(ArticleCategory::find()->all(), 'id', 'title')
            ],*/
            /*[
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->author->username;
                }
            ],*/
            [
                'class' => EnumColumn::class,
                'attribute' => 'status',
                'enum' => [
                    Yii::t('backend', 'Not Published'),
                    Yii::t('backend', 'Published')
                ]
            ],
            //'published_at:datetime',
            //'created_at:datetime',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d/m/Y H:i:s'],
                'filter' => false,

            ],
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
