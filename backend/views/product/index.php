<?php

use common\grid\EnumColumn;
use common\models\ProductCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use \common\components\CFunction;
$this->title = Yii::t('backend', 'Product');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="gallery-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!---<p>
        <a id="btn_delete_prod" href="javascript:void(0);" class="btn btn-danger" title="Xóa nhiều sản phẩm"><i class="fa fa-trash"></i> Xóa</a>&nbsp;&nbsp;
        -->
        <?= Html::a(
            Yii::t('backend', 'Create product'),
            ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'product-grid'
        ],
        'columns' => [
            /*[
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function($model) {

                        return ['value' => $model->id, 'class' => 'checkbox-row','id'=>'checkbox'];

                    }
            ],*/
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
            //'slug',
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
    <?php Pjax::end()?>
</div>
<input type="hidden" id="prod_id_delete" value=""/>
<script>
    $(document).ready(function(){
        $(document).on('change', '.select-on-check-all, .checkbox-row', function() {
            var keys = $('#product-grid').yiiGridView('getSelectedRows');
            $('#prod_id_delete').val(keys);
        });
        //
        $('#btn_delete_prod').click(function () {
            var prod_id_delete = $('#prod_id_delete').val();
            if(prod_id_delete!=""){
                Swal.fire({
                    text: "Bạn có muốn xóa những sản phẩm này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //
                    if (result.isConfirmed) {
                        deleteProducts(prod_id_delete);
                    };
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Vui lòng chọn sản phẩm cần xóa',
                });
            }
        });
    });
    var deleteProductsClick=0;
    function deleteProducts(prod_id_string) {
        if(deleteProductsClick==0){
            deleteProductsClick++;
            $.ajax({
                url: '<?=Url::to(['product/delete-products'])?>',
                type: "POST",
                dataType:'json',
                data: {
                    'prod_id_string': prod_id_string,
                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
                },
                success: function(res)
                {
                    deleteProductsClick=0;
                    $('#prod_id_delete').val("");
                    if(res.status==1) {
                        Swal.fire(
                            'Thành công!',
                            '' + res.message + '',
                            'success'
                        );
                        jQuery.pjax.reload({container:'#p0'});
                    }else{
                        Swal.fire({
                            icon: 'error',
                            text: ''+res.message+'',
                        });
                    }
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    Swal.fire({
                        icon: 'error',
                        text: ''+errorMessage+'',
                    });
                }
            });
        }
    }
</script>
