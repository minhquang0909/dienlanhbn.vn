<?php
use common\components\CFunction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;

$total = 0;

?>

<div class="row row-main">
    <div class="large-12 col">
        <div class="col-inner">
            <div class="woocommerce cart-page">
                <?php
                if(is_array($products) && count($products) > 0){ ?>
                    <div class="woocommerce row row-large row-divided">
                        <div class="col large-7 pb-0 ">
                            <form id="frm_cart" class="woocommerce-cart-form" action="<?=Url::to(['product/cart'])?>" method="post">
                                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>" />
                                <div class="cart-wrapper sm-touch-scroll">
                                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th class="product-name" colspan="3">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tạm tính</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach ($products as $product){
                                                $url_detail = Url::toRoute(['product/detail', 'slug' => $product['slug']]);
                                                $price = $product['price'];
                                                if($product['price_discount'] && $product['price_discount'] < $product['price']){
                                                    $price = $product['price_discount'];
                                                }
                                                //
                                                $pro_quantity = $cart[$product['id']];
                                                $real_price = $pro_quantity * $price;
                                                $total+= $real_price;
                                                ?>
                                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                                    <td class="product-remove">
                                                        <a href="javascript:void(0);" class="remove btn-remove-product" aria-label="Xóa sản phẩm này" product-id="<?=$product['id']?>">×</a>
                                                    </td>
                                                    <td class="product-thumbnail">
                                                        <a href="<?=$url_detail?>">
                                                            <img src="<?php echo CFunction::buildThumbnail($product,120);?>"class="thumb">
                                                        </a>
                                                    </td>
                                                    <td class="product-name" data-title="Sản phẩm">
                                                        <a href="<?=$url_detail?>"><?=Html::encode($product['title'])?></a>
                                                        <div class="show-for-small mobile-product-price">
                                                            <span class="mobile-product-price__qty"><?=$pro_quantity?> x </span>
                                                            <span class="woocommerce-Price-amount amount">
                                                               <?=CFunction::number_format($price,0)?>đ
                                                            </span>
                                                        </div>
                                                        </td>
                                                        <td class="product-price" data-title="Giá">
                                                        <span class="woocommerce-Price-amount amount">
                                                          <?=CFunction::number_format($price,0)?>đ
                                                        </span>
                                                    </td>
                                                    <td class="product-quantity" data-title="Số lượng">
                                                        <div class="quantity buttons_added input-group-number">
                                                            <input type="button" value="-" data-field="quantity" class="minus button is-form button-minus">
                                                            <input type="number" product-id="<?=$product['id']?>" class="input-text qty text" min="1" max="99" name="quantity" value="<?=$pro_quantity?>" title="SL" placeholder="" inputmode="numeric">
                                                            <input type="button" value="+" data-field="quantity" class="plus button is-form button-plus"/>
                                                        </div>
                                                    </td>
                                                    <td class="product-subtotal" data-title="Tạm tính">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <?=CFunction::number_format($real_price,0)?>đ
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php }
                                        ?>
                                        <tr>
                                            <td colspan="6" class="actions clear">
                                                <div class="continue-shopping pull-left text-left">
                                                    <a class="button-continue-shopping button primary is-outline" href="<?=Url::to(['site/index'])?>"> ←&nbsp;Tiếp tục xem sản phẩm </a>
                                                </div>
                                                <button type="submit" class="button primary btn-update mt-0 pull-left small" name="update_cart" value="Cập nhật giỏ hàng">Cập nhật giỏ hàng
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="cart-collaterals large-5 col pb-0">
                            <div class="cart-sidebar col-inner ">
                                <div class="cart_totals ">
                                    <table cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th class="product-name" colspan="2" style="border-width:3px;">Cộng giỏ hàng</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <h2>Cộng giỏ hàng</h2>
                                    <table cellspacing="0" class="shop_table shop_table_responsive">
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Tạm tính</th>
                                            <td data-title="Tạm tính">
                                            <span class="woocommerce-Price-amount amount">
                                                <?=CFunction::number_format($total,0)?>đ
                                            </span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Tổng</th>
                                            <td data-title="Tổng">
                                                <strong>
                                                  <span class="woocommerce-Price-amount amount">
                                                    <?=CFunction::number_format($total,0)?>đ
                                                  </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="<?=Url::to(['product/order'])?>" class="checkout-button button alt wc-forward"> Tiến hành đặt hàng</a>
                                    </div>
                                </div>
                                <!--<form class="checkout_coupon mb-0" method="post">
                                    <div class="coupon">
                                        <h3 class="widget-title">
                                            <i class="icon-tag"></i> Phiếu ưu đãi
                                        </h3>
                                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Mã ưu đãi">
                                        <input type="submit" class="is-form expand" name="apply_coupon" value="Áp dụng">
                                    </div>
                                </form>-->
                                <div class="cart-sidebar-content relative"></div>
                            </div>
                        </div>
                    </div>
                <?php }else{
                        echo '<div class="text-center">';
                            echo '<p class="text-bold">Chưa có sản phẩm nào trong giỏ hàng.</p>';
                            echo '<p class="return-to-shop">
                                        <a style="color: #fff;" class="button primary wc-backward" href="'.Url::to(['site/index']).'">
                                            Tiếp tục mua hàng</a>
                                    </p>';
                        echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#frm_cart').submit(function(){
            $('.qty').each(function () {
                var product_id = $(this).attr('product-id');
                var val = parseInt($(this).val());
                $(this).append('<input type="hidden" value="'+val+'" name="cart['+product_id+']" />');
            });
            return true;
        });
        //
        $('body').on('click', '.btn-remove-product', function(e) {
            var product_id = $(this).attr('product-id');
            $.ajax({
                url: '<?=Url::to(['product/remove'])?>',
                type: "POST",
                dataType:'json',
                data: {
                    'id' : product_id,
                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
                },
                success: function(res)
                {
                    window.location.href = '<?=Url::to(['product/cart'])?>';
                },
                error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    Swal.fire({
                        icon: 'error',
                        text: ''+errorMessage+'',
                    });
                }
            });
        });
    });
</script>