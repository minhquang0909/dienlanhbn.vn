<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\models\Partners;
use common\models\Country;
use common\components\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\query\Supplier */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Suppliers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a id="btn_delete_supplier" href="javascript:void(0);" class="btn btn-danger" title="Xóa nhiều nhà cung cấp"><i class="fa fa-trash"></i> Xóa</a>&nbsp;&nbsp;
        <?php echo Html::a(Yii::t('backend', 'Create supplier', [
    'modelClass' => 'Supplier',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin()?>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'supplier-grid'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function($model) {

                        return ['value' => $model->id, 'class' => 'checkbox-row','id'=>'checkbox'];

                    }
            ],
            'id',
            'name',
            [
                'attribute' => 'country_id',
                'header'  =>  'Quốc gia',
                'value' => function ($model) {
                    return $model->country_id ? $model->country->name : null;
                },
                'filter' => ArrayHelper::map(Country::find()->active()->all(), 'id', 'name')
            ],
            'email:email',
            'phone',
            //'address',
            // 'url:url',
            [
                'class' => EnumColumn::class,
                'attribute' => 'status',
                'options' => ['style' => 'width: 10%'],
                'enum' => Partners::statuses(),
                'filter' => Partners::statuses(),
            ],
             'sort',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ],
    ]); ?>
    <?php Pjax::end()?>
</div>

<input type="hidden" id="supplier_id_delete" value=""/>
<script>
    $(document).ready(function(){
        $(document).on('change', '.select-on-check-all, .checkbox-row', function() {
            var keys = $('#supplier-grid').yiiGridView('getSelectedRows');
            $('#supplier_id_delete').val(keys);
        });
        //
        $('#btn_delete_supplier').click(function () {
            var supplier_id_delete = $('#supplier_id_delete').val();
            if(supplier_id_delete!=""){
                Swal.fire({
                    text: "Bạn có muốn xóa những nhà cung cấp này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //
                    if (result.isConfirmed) {
                        deleteSuppliers(supplier_id_delete);
                    };
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Vui lòng chọn nhà cung cấp cần xóa',
                });
            }
        });
    });
    var deleteSuppliersClick=0;
    function deleteSuppliers(supllier_id_string) {
        if(deleteSuppliersClick==0){
            deleteSuppliersClick++;
            $.ajax({
                url: '<?=Url::to(['supplier/delete-multi'])?>',
                type: "POST",
                dataType:'json',
                data: {
                    'supplier_id_string': supllier_id_string,
                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
                },
                success: function(res)
                {
                    deleteSuppliersClick=0;
                    $('#supplier_id_delete').val("");
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
