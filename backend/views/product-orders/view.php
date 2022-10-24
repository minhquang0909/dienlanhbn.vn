<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ProductOrders;
use common\components\CFunction;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOrders */

$this->title = 'Chi tiết đơn hàng #'.$model['id'];
$this->params['breadcrumbs'][] = ['label' => 'Đơn hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fullname',
            'phone',
            'email:email',
            'address',
            'note',
            'quantity',
            [
                'attribute' => 'total_amount',
                'format' => 'raw',
                'value' => function ($model) {
                    return CFunction::number_format($model['total_amount'], 0).'đ';
                },
            ],
            'created_ip',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    $status = ProductOrders::statuses();
                    $statusText = !empty($status[$model->status]) ? $status[$model->status] : "";
                    return $statusText;
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    <hr>
    <h3>Danh sách sản phẩm:</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ID sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Giá khuyến mại</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $d=0;
            foreach ($model->products as $product){
                $d++;
                ?>
                <tr>
                    <td><?=$d?></td>
                    <td><?=$product['id']?></td>
                    <td><?=Html::encode($product['title'])?></td>
                    <td><?=Html::encode($product['quantity'])?></td>
                    <td><?=CFunction::number_format($product['price'],0)?></td>
                    <td><?=CFunction::number_format($product['discount_price'],0)?></td>
                </tr>
            <?php }
        ?>
        </tbody>
    </table>
</div>
