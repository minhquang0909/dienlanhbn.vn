<?php
/**
 * Created by PhpStorm.
 * User: phamv
 * Date: 3/23/2022
 * Time: 4:49 PM
 */
use common\models\ProductCategory;
use common\models\ServiceCategory;
use frontend\models\Product as FProduct;
use common\models\Product;
use common\components\CFunction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;

$price_discount = false;
if($model['price_discount'] && $model['price_discount'] < $model['price']){
    $price_discount = $model['price_discount'];
}
$url_detail = Url::toRoute(['product/detail', 'slug' => $model['slug']]);
?>

<div class="product-small col has-hover product type-product post-3103 status-publish first instock product_cat-dieu-hoa product_cat-dieu-hoa-gree product_cat-dieu-hoa-tu-dung has-post-thumbnail shipping-taxable purchasable product-type-simple">
    <div class="col-inner">
        <div class="badge-container absolute left top z-1"></div>
        <div class="product-small box ">
            <div class="box-image">
                <div class="image-none">
                    <a href="<?=$url_detail ?>" aria-label="<?php echo $model['title']?>">
                        <img src="<?php echo CFunction::buildThumbnail($model,228,228);?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazy-load-active">
                    </a>
                </div>
                <div class="image-tools is-small top right show-on-hover"></div>
                <div class="image-tools is-small hide-for-small bottom left show-on-hover"></div>
                <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover"></div>
            </div>
            <div class="box-text box-text-products text-center grid-style-2">
                <div class="title-wrapper">
                    <p class="name product-title woocommerce-loop-product__title">
                        <a href="<?=$url_detail?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><?php echo $model['title']?></a>
                    </p>
                </div>
                <div class="price-wrapper">
                    <span class="price">
                        <?php
                        if($price_discount){ ?>
                            <del aria-hidden="true">
                                <span class="woocommerce-Price-amount amount">
                                    <bdi class="real-price"><?=CFunction::number_format($model['price'],0)?><span class="woocommerce-Price-currencySymbol">₫</span>
                                    </bdi></span></del>
                                                <ins>
                                    <span class="woocommerce-Price-amount amount">
                                        <bdi><?=CFunction::number_format($model['price_discount'],0)?><span class="woocommerce-Price-currencySymbol">₫</span></bdi>
                                    </span>
                            </ins>
                        <?php }else{ ?>
                            <span class="woocommerce-Price-amount amount"><bdi class="real-price"><?=CFunction::number_format($model['price'],0)?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span>
                        <?php }
                        ?>
                    </span>
                </div>
                <div class="add-to-cart-button">
                    <a href="javascript:void(0);" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" rel="nofollow">Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
