<?php

use common\grid\EnumColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\Pjax;
use common\components\CFunction;
use common\models\ProductOrders;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductOrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Đơn hàng';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="gallery-index">
    <?php /*Pjax::begin()*/?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'product-grid'
        ],
        'columns' => [
            [
                'attribute' =>  'id',
                'contentOptions' => ['style' => 'width:100px'],
            ],
            'fullname',
            'phone',
            'quantity',
            [
                'attribute' => 'total_amount',
                'value' => function ($model) {
                    return CFunction::number_format($model->total_amount,0).'đ';
                }

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
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    $status = ProductOrders::statuses();
                    $statusText = !empty($status[$model->status]) ? $status[$model->status] : "";
                    $html = "<a href=\"#\" data-toggle=\"modal\" onclick=\"showModal(this)\" data-id = \"" . $model->id . "\" class=\"edit-status\"  id=\"edit-status-$model->id\" data-status = \"" . $model->status . "\">$statusText <i class=\"fa fa-edit\"></i></a>";
                    return $html;
                },
                'filter' => ProductOrders::statuses(),
                //'contentOptions' => ['style' => 'width:200px; text-align: center;'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ]
        ]
    ]); ?>
    <?php /*Pjax::end()*/?>
    <div id="modal-change-status" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="max-width: 400px; margin: auto;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align-last: center">Chuyển đổi trạng thái</h4>
                </div>
                <?php $statusModal = ProductOrders::statuses(); ?>
                <div class="modal-body">
                    <select class="form-control" name="status-change" id="status-change">
                        <?php foreach ($statusModal as $value => $text) { ?>
                            <option value="<?= $value ?>"><?= $text ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="product-orders-id" value="">
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="btn btn-success" id="change-status-submit" onclick="changeStatus()">Đổi trạng thái</button>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .edit-status i {
        margin-left: 5px;
        cursor: pointer;
    }

    .select-edit-status {
        display: none;
    }
</style>

<script>
    function showModal(e) {
        var id = $(e).attr('data-id');
        var status = $(e).attr('data-status');
        $('#modal-change-status').find('#product-orders-id').val(id);
        $('#modal-change-status').find('#status-change').val(status).trigger('change');
        $('#modal-change-status').modal('show');
    }

    function changeStatus(){
        let status = $('#status-change').val();
        let id = $('#product-orders-id').val();
        $.ajax({
            url: '<?=Url::to(['product-orders/change-status'])?>',
            type: "POST",
            dataType:'json',
            data: {
                'id': id,
                'status': status,
                '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
            },
            success: function(res)
            {
                var id_element_change = 'edit-status-' + id;
                $('#'+id_element_change).attr('data-status', status);
                $('#' + id_element_change).html(res.message + '<i class="fa fa-edit"></i>');
                $('#modal-change-status').modal('hide');
                if(res.status==1) {
                    Swal.fire(
                        'Thành công!',
                        '' + res.message + '',
                        'success'
                    );
                    jQuery.pjax.reload({container: '#p0', async: false});
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
</script>