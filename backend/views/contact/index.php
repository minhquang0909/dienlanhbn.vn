<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\components\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\query\ContactQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Liên hệ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a id="btn_delete_contact" href="javascript:void(0);" class="btn btn-danger" title="Xóa nhiều liên hệ"><i class="fa fa-trash"></i> Xóa</a>&nbsp;&nbsp;
        <?php echo Html::a('Tạo mới liên hệ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'contact-grid'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function($model) {

                        return ['value' => $model->id, 'class' => 'checkbox-row','id'=>'checkbox'];

                    }
            ],
            //'id',
            'name',
            'email:email',
            'phone',
           [
                'attribute' => 'product_id',
                'value' => function ($model) {
                    return $model->product->title??"";
                },
                'filter' => ArrayHelper::map(Product::find()->active()->all(), 'id', 'title')
            ],
            // 'content',
            [
                'attribute' => 'created_time',
                'filter'    =>  false,
                'format'    =>  'datetime'
            ],
            // 'update_time:datetime',
            //'status',
            // 'access_token',
            // 'note:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>

<input type="hidden" id="contact_id_delete" value=""/>
<script>
    $(document).ready(function(){
        $(document).on('change', '.select-on-check-all, .checkbox-row', function() {
            var keys = $('#contact-grid').yiiGridView('getSelectedRows');
            $('#contact_id_delete').val(keys);
        });
        //
        $('#btn_delete_contact').click(function () {
            var contact_id_delete = $('#contact_id_delete').val();
            if(contact_id_delete!=""){
                Swal.fire({
                    text: "Bạn có muốn xóa những liên hệ này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //
                    if (result.isConfirmed) {
                        deleteContacts(contact_id_delete);
                    };
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Vui lòng chọn liên hệ cần xóa',
                });
            }
        });
    });
    var deleteContactClick=0;
    function deleteContacts(contact_id_string) {
        if(deleteContactClick==0){
            deleteContactClick++;
            $.ajax({
                url: '<?=Url::to(['contact/delete-multi'])?>',
                type: "POST",
                dataType:'json',
                data: {
                    'contact_id_string': contact_id_string,
                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
                },
                success: function(res)
                {
                    deleteContactClick=0;
                    $('#contact_id_delete').val("");
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
