<?php
use common\components\CFunction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\bootstrap\ActiveForm;
$total = 0;

?>

<div class="row row-main">
    <div class="large-12 col">
        <div class="col-inner">

            <div class="woocommerce"><div class="woocommerce-notices-wrapper"></div><div class="woocommerce-form-login-toggle">
                    <?php $form = ActiveForm::begin(); ?>
                    <?php echo $form->errorSummary($orderForm); ?>
                    <div class="row pt-0 ">
                        <div class="large-6 col">
                            <h1>Thông tin đặt hàng</h1>
                            <?php echo $form->field($orderForm, 'fullname')->textInput(['maxlength' => true]) ?>
                            <?php echo $form->field($orderForm, 'phone')->textInput(['maxlength' => true]) ?>
                            <?php echo $form->field($orderForm, 'email')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($orderForm, 'address')->textarea(['rows' => '2']) ?>
                            <?= $form->field($orderForm, 'note')->textarea(['rows' => '2','placeholder'=>'Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn.']) ?>
                        </div>

                        <div class="large-6 col">

                            <div class="col-inner has-border">
                                <div class="checkout-sidebar sm-touch-scroll">

                                    <h3 id="order_review_heading">Đơn hàng của bạn</h3>
                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                            <tr>
                                                <th class="product-name">Sản phẩm</th>
                                                <th class="product-total">Tạm tính</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($products as $product) {
                                                $url_detail = Url::toRoute(['product/detail', 'slug' => $product['slug']]);
                                                $price = $product['price'];
                                                if ($product['price_discount'] && $product['price_discount'] < $product['price']) {
                                                    $price = $product['price_discount'];
                                                }
                                                //
                                                $pro_quantity = $cart[$product['id']]??0;
                                                $real_price = $pro_quantity * $price;
                                                $total += $real_price;
                                                ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <?=Html::encode($product['title'])?>
                                                        <strong class="product-quantity">×&nbsp;<?=$pro_quantity?></strong>
                                                    </td>
                                                    <td class="product-total">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <?=CFunction::number_format($price,0)?>đ
                                                    </span>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>

                                            <tr class="cart-subtotal">
                                                <th>Tạm tính</th>
                                                <td>
                                                    <span class="woocommerce-Price-amount amount text-bold"><?=CFunction::number_format($total,0)?>đ</span>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Tổng</th>
                                                <td><span class="woocommerce-Price-amount amount text-bold"><bdi><?=CFunction::number_format($total,0)?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                                            </tr>
                                            </tfoot>
                                        </table>

                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <div class="form-row place-order">
                                                <noscript>
                                                    Trình duyệt của bạn không hỗ trợ JavaScript, hoặc nó bị vô hiệu hóa, hãy đảm bảo bạn nhấp vào <em>Cập nhật giỏ hàng</em> trước khi bạn thanh toán. Bạn có thể phải trả nhiều hơn số tiền đã nói ở trên, nếu bạn không làm như vậy.			<br/>
                                                    <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Cập nhật tổng">Cập nhật tổng</button>
                                                </noscript>

                                                <div class="woocommerce-terms-and-conditions-wrapper">
                                                    <?= $form->field($orderForm, 'accept_policy', ['template'=>'
                                                        {input}
                                                        Tôi đã đọc và đồng ý với <a target="_blank" href="'.Url::to(['page/view','slug'=>'returns-policy']).'" class="woocommerce-terms-and-conditions-link" target="_blank">điều khoản và điều kiện</a> của website
                                                    '])->textInput(['class'=>"text-bold",'type'=>'checkbox', 'checked' => true])?>
                                                </div>

                                                <div class="form-group">
                                                    <?php echo Html::submitButton(
                                                        'Đặt hàng',
                                                        ['class' => 'button alt']) ?>
                                                </div>

                                            </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>