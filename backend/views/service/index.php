    <?php

use common\grid\EnumColumn;
use common\models\ProductCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use \common\components\CFunction;
$this->title = Yii::t('backend', 'Dịch vụ');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="gallery-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t('backend', 'Tạo mới dịch vụ'),
            ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'service-grid'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function($model) {

                        return ['value' => $model->id, 'class' => 'checkbox-row','id'=>'checkbox'];

                    }
            ],
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
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category ? $model->category->title : null;
                },
                'filter'    =>  false,
                //'filter' => ArrayHelper::map(ProductCategory::find()->all(), 'id', 'title')
            ],
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
            /*[
                'attribute' => 'created_at',
                'format' => ['date', 'php:d/m/Y H:i:s'],
                'filter' => false,

            ],*/
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ]
    ]); ?>
    <?php Pjax::end()?>
</div>
