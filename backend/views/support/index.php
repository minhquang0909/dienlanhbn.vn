<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Pjax;
use yii\helpers\Url;
use \common\components\CFunction;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SupportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Hỗ trợ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a id="btn_delete_support" href="javascript:void(0);" class="btn btn-danger" title="Xóa nhiều hỗ trợ"><i class="fa fa-trash"></i> Xóa</a>&nbsp;&nbsp;
        <?php echo Html::a(Yii::t('backend', 'Tạo mới hỗ trợ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'support-grid'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function($model) {

                        return ['value' => $model->id, 'class' => 'checkbox-row','id'=>'checkbox'];

                    }
            ],
            /*[
                'attribute' =>  'id',
                'contentOptions' => ['style' => 'width:100px'],
            ],*/
            [
                'attribute' => 'thumbnail_path',
                'header' => 'Ảnh đại diện',
                'format' => 'html',
                'value' => function ($model) {
                    return '<img class="img-thumb" src="'.CFunction::getDomain().$model->thumbnail_base_url.'/'.$model->thumbnail_path.'"/>';
                }
            ],
            'name',
            'phone',
            'email:email',
            //'thumbnail_base_url:url',
            // 'thumbnail_path',
            // 'status',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<input type="hidden" id="support_id_delete" value=""/>
<script>
    $(document).ready(function(){
        $(document).on('change', '.select-on-check-all, .checkbox-row', function() {
            var keys = $('#support-grid').yiiGridView('getSelectedRows');
            $('#support_id_delete').val(keys);
        });
        //
        $('#btn_delete_support').click(function () {
            var support_id_delete = $('#support_id_delete').val();
            if(support_id_delete!=""){
                Swal.fire({
                    text: "Bạn có muốn xóa những hỗ trợ này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //
                    if (result.isConfirmed) {
                        deleteSupports(support_id_delete);
                    };
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Vui lòng chọn hỗ trợ cần xóa',
                });
            }
        });
    });
    var deleteSupportsClick=0;
    function deleteSupports(support_id_string) {
        if(deleteSupportsClick==0){
            deleteSupportsClick++;
            $.ajax({
                url: '<?=Url::to(['support/delete-multi'])?>',
                type: "POST",
                dataType:'json',
                data: {
                    'support_id_string': support_id_string,
                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
                },
                success: function(res)
                {
                    deleteSupportsClick=0;
                    $('#support_id_delete').val("");
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
