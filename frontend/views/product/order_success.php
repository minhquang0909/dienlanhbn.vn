<?php
/**
 * Created by PhpStorm.
 * User: nguyenpv
 * Date: 03/04/2022
 * Time: 18:04
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row row-main order-success">
    <div class="large-12 col">
        <div class="col-inner alert alert-success">
            <h1>Đặt hàng thành công!</h1>
            <p>Cám ơn: <span class="text-bold"><?=Html::encode($model['fullname'])?></span> đã đặt hàng!</p>
            <p>Chúng tôi sẽ liên hệ với bạn sớm nhất có thể. Trân trọng cảm sự tin tưởng của bạn!</p>
            <p class="return-to-shop">
                <a style="color: #fff;" class="button primary wc-backward" href="<?=Url::to(['site/index'])?>">
                    Tiếp tục mua hàng</a>
            </p>
        </div>
    </div>
</div>
