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
?>

<?php $this->registerCssFile("/css/fotorama.css"); ?>
<?php $this->registerJsFile("/js/fotorama.js"); ?>

<div class="page-title shop-page-title product-page-title product-detail">
    <div class="page-title-inner flex-row medium-flex-wrap container">
        <div class="flex-col flex-grow medium-text-center">
            <div class="is-small">
                <nav class="woocommerce-breadcrumb breadcrumbs uppercase">
                    <a href="<?=Url::to(['site/index'])?>">Trang chủ</a>
                    <span class="divider">/</span>
                    <a href="<?=Url::to(['product/index'])?>">Sản phẩm</a>
                    <span class="divider">/</span>
                    <?php
                    if($category){
                        echo '<a href="'.Url::to(['product/index','category_slug'=>$category['slug']]).'">'.Html::encode($category['title']).'</a>';
                    }
                    ?>

                    <span class="divider">/</span>
                    <span><?=Html::encode($model['title'])?></span>
                </nav>
            </div>
        </div>
        <div class="flex-col medium-text-center">
            <ul class="next-prev-thumbs is-small ">
                <?php
                if($pre_product){
                    $pre_url = Url::to(['product/detail', 'slug'=>$pre_product['slug']]);
                    ?>
                    <li class="prod-dropdown has-dropdown">
                            <a href="<?=$pre_url?>" rel="next" class="button icon is-outline circle">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <div class="nav-dropdown">
                                <a title="<?=$pre_product['title']?>" href="<?=$pre_url?>">
                                    <img width="100" height="100" src="<?=CFunction::buildThumbnail($pre_product,100,100)?>" class="lazy-load attachment-woocommerce_gallery_thumbnail size-woocommerce_gallery_thumbnail wp-post-image" alt="">
                                </a>
                            </div>
                </li>
                <?php }
                ?>
                <?php
                if($next_product){
                    $next_url = Url::to(['product/detail', 'slug'=>$next_product['slug']]);
                    ?>
                    <li class="prod-dropdown has-dropdown">
                        <a href="<?=$next_url?>" rel="next" class="button icon is-outline circle">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                        <div class="nav-dropdown">
                            <a title="<?=$next_product['title']?>" href="<?=$next_url?>">
                                <img width="100" height="100" src="<?=CFunction::buildThumbnail($next_product,100,100)?>" class="lazy-load attachment-woocommerce_gallery_thumbnail size-woocommerce_gallery_thumbnail wp-post-image" alt="" >
                            </a>
                        </div>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
</div>

<!--detail-->
<div class="shop-container product-detail">

    <div class="product-container">
        <div class="product-main">
            <div class="row content-row mb-0">
                <div class="product-gallery large-6 col">
                    <!--images-->
                    <div class="fotorama"  data-nav="thumbs">
                        <?php
                        if(is_array($images) && count($images) > 0){
                            foreach ($images as $img){ ?>
                                <a  href="<?=CFunction::buildThumbnail($img, 600)?>">
                                    <img src="<?=CFunction::buildThumbnail($img, 100)?>">
                                </a>
                            <?php }
                        }
                        ?>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('.fotorama').fotorama({
                                minheight: '400px',
                                maxheight: '500px',
                                nav: 'thumbs'
                            });
                        });
                    </script>

                    <!--End images-->
                </div>
                <div class="product-info summary col-fit col entry-summary product-summary">
                    <h1 class="product-title product_title entry-title"><?=Html::encode($model['title'])?></h1>
                    <div class="is-divider small"></div>
                    <div class="price-wrapper">
                        <?php
                        if($price_discount){ ?>
                            <p class="price product-page-price price-on-sale">
                                <del aria-hidden="true"><span class="woocommerce-Price-amount amount">
                                    <bdi><?=CFunction::number_format($model['price'],0)?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span>
                                </del> <ins><span class="woocommerce-Price-amount amount text-bold price-discount"><bdi>
                                            <?=CFunction::number_format($model['price_discount'],0)?>
                                        <span class="woocommerce-Price-currencySymbol">₫</span></bdi></span>
                                </ins>
                            </p>
                        <?php }else{?>
                            <p class="price product-page-price ">
                                <span class="woocommerce-Price-amount amount"><bdi class="text-bold"><?=CFunction::number_format($model['price'],0)?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></p>
                        <?php }
                        ?>
                    </div>
                    <div class="product-short-description">
                        <?=$model['features']?>
                        <p>&nbsp;</p>
                        <div class="pspct2"></div>
                    </div>

                    <div class="quantity buttons_added input-group-number">
                        <input type="button" value="-" data-field="quantity" class="minus button is-form button-minus">
                        <input type="number" id="prod_quantity" class="input-text qty text" min="1" max="99" name="quantity" value="1" title="SL" placeholder="" inputmode="numeric">
                        <input type="button" value="+" data-field="quantity" class="plus button is-form button-plus"/>
                        <button url="<?=Url::to(['product/add-to-cart'])?>" id="add_to_cart" name="add-to-cart" data-id="<?=$model['id']?>" class="single_add_to_cart_button button alt">Thêm vào giỏ hàng</button>
                    </div>
                    <div class="product_meta">
                    <span class="posted_in">Danh mục:
                        <?php
                        if($category_parent){
                            echo '<a href="'.Url::to(['product/index','category_slug'=>$category_parent['slug']]).'" rel="tag">'.Html::encode($category_parent['title']).'</a>,';
                        }
                        if($category){
                            echo '&nbsp;<a href="'.Url::to(['product/index','category_slug'=>$category['slug']]).'" rel="tag">'.Html::encode($category['title']).'</a>,';
                        }
                        if($air_type){
                            echo '&nbsp;<a href="'.Url::to(['product/types','category_slug'=>$air_type['slug']]).'" rel="tag">'.Html::encode($air_type['title']).'</a>';
                        }
                        ?>

                    </span>
                    </div>
                </div>
            </div>
        </div>
        <!--chi tiết sản phẩm-->
        <div class="product-footer">
            <div class="container">
                <div class="woocommerce-tabs wc-tabs-wrapper container tabbed-content">
                    <ul class="tabs wc-tabs product-tabs small-nav-collapse nav nav-uppercase nav-line nav-left" role="tablist">
                        <li class="description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
                            <a href="#tab-description"> Mô tả </a>
                        </li>
                    </ul>
                    <div class="tab-panels">
                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content product-description active" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="">
                            <?=$model['body']?>
                        </div>
                    </div>
                </div>
                <div class="related related-products-wrapper product-section">
                    <!--sản phẩm tương tự-->
                    <?php
                    if(is_array($relate_products) && count($relate_products) >0) {
                        echo '<h3 class="product-section-title container-width product-section-title-related pt-half pb-half uppercase"> Sản phẩm tương tự </h3>';
                        echo '<div class="row large-columns-5 medium-columns-3 small-columns-2 row-small">';
                            $d = 0;
                            foreach ($relate_products as $product) {
                                $d++;
                                echo Yii::$app->controller->renderPartial('/product/_item', [
                                    'count' => $d,
                                    'model' => $product,
                                ]);
                            }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function(){
        $('body').on('click', '#add_to_cart', function(e) {
            var quantity = parseInt($('#prod_quantity').val());
            var url = $(this).attr('url');
            var product_id = $(this).attr('data-id');
            addProductToCart(product_id, quantity, url)
        });
    });
</script>
