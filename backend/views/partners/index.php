<?php

use common\grid\EnumColumn;
use common\models\ArticleCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Pjax;
use yii\helpers\Url;
use common\models\Partners;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PartnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use \common\components\CFunction;
$this->title = 'Đối tác';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="partners-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a id="btn_delete_partners" href="javascript:void(0);" class="btn btn-danger" title="Xóa nhiều đối tác"><i class="fa fa-trash"></i> Xóa</a>&nbsp;&nbsp;
        <?= Html::a(
            'Tạo mới đối tác',
            ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'partners-grid'
        ],

        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function($model) {

                        return ['value' => $model->id, 'class' => 'checkbox-row','id'=>'checkbox'];

                    }
            ],
           /* [
                'attribute' =>  'id',
                'contentOptions' => ['style' => 'width:100px'],
            ],*/
            'title',
            [
                'attribute' => 'thumbnail_path',
                'header' => Yii::t('common', 'Logo'),
                'format' => 'html',
                'value' => function ($model) {
                    return '<img class="img-thumb" src="'.CFunction::getDomain().$model->thumbnail_base_url.'/'.$model->thumbnail_path.'"/>';
                }
            ],           
            'website:url',
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
                'options' => ['style' => 'width: 10%'],
                'enum' => Partners::statuses(),
                'filter' => Partners::statuses(),
            ],
            //'published_at:datetime',
            //'created_at:datetime',
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
    <?php Pjax::end(); ?>
</div>

<input type="hidden" id="partners_id_delete" value=""/>
<script>
    $(document).ready(function(){
        $(document).on('change', '.select-on-check-all, .checkbox-row', function() {
            var keys = $('#partners-grid').yiiGridView('getSelectedRows');
            $('#partners_id_delete').val(keys);
        });
        //
        $('#btn_delete_partners').click(function () {
            var partners_id_delete = $('#partners_id_delete').val();
            if(partners_id_delete!=""){
                Swal.fire({
                    text: "Bạn có muốn xóa những đối tác này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //
                    if (result.isConfirmed) {
                        deletePartners(partners_id_delete);
                    };
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Vui lòng chọn đối tác cần xóa',
                });
            }
        });
    });
    var deletePartnersClick=0;
    function deletePartners(partners_id_string) {
        if(deletePartnersClick==0){
            deletePartnersClick++;
            $.ajax({
                url: '<?=Url::to(['partners/delete-multi'])?>',
                type: "POST",
                dataType:'json',
                data: {
                    'partners_id_string': partners_id_string,
                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
                },
                success: function(res)
                {
                    deletePartnersClick=0;
                    $('#partners_id_delete').val("");
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
