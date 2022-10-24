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
$step = ($page * $limit);
$step = ($step < $total_product)?$step:$total_product;
?>

<div class="shop-page-title category-page-title page-title ">
    <div class="page-title-inner flex-row  medium-flex-wrap container">
        <div class="flex-col flex-grow medium-text-center">
            <?php
            if($keyword!=''){
                echo '<h1 class="shop-page-title is-xlarge">Kết quả tìm kiếm: "'.Html::encode($keyword).'"</h1>';
            }else{
                if(is_array($category) && count($category) > 0){
                    echo '<h1 class="shop-page-title is-xlarge">'.$category['title'].'</h1>';
                }else{
                    echo '<h1 class="shop-page-title is-xlarge">Sản phẩm</h1>';
                }
            }
            ?>
            <div class="is-small">
                <nav class="woocommerce-breadcrumb breadcrumbs uppercase">
                    <a href="<?=Url::to(['site/index'])?>">Trang chủ</a> <span class="divider">/</span>
                    <a href="<?=Url::to(['product/index'])?>">Sản phẩm</a>
                    <?php
                    if($keyword!=''){
                        echo '<span class="divider">/</span>'.Html::encode($keyword).'</nav>';
                    }else{
                        if(is_array($category) && count($category) > 0){
                            echo '<span class="divider">/</span>'.$category['title'].'</nav>';
                        }
                    }
                    ?>
            </div>
        </div>
        <div class="flex-col medium-text-center">
            <p class="woocommerce-result-count hide-for-medium">
                Hiển thị <?=($offset+1)?>–<?=$step?> của <?=CFunction::number_format($total_product,0)?> kết quả
            </p>
            <select name="product_sort_by" class="product_sort_by" onchange="sortProduct(this);">
                <option <?=($sort=='date'?'selected':'')?> value="<?=Url::to(['product/index','keyword'=>$keyword,'category_slug'=>$category_slug,'sort'=>'date'])?>">Mới nhất</option>
                <option <?=($sort=='price'?'selected':'')?> value="<?=Url::to(['product/index','keyword'=>$keyword,'category_slug'=>$category_slug,'sort'=>'price'])?>">Giá thấp</option>
                <option <?=($sort=='price-desc'?'selected':'')?> value="<?=Url::to(['product/index','keyword'=>$keyword,'category_slug'=>$category_slug,'sort'=>'price-desc'])?>">Giá cao</option>
            </select>
        </div>
    </div>
</div>
<!--products-->
<div class="dl-home-cat-products">
    <div class="row row-collapse">
        <div class="col cot2 small-12 large-12">
            <div class="col-inner">
                <div class="row large-columns-5 medium-columns-3 small-columns-2 row-small">
                    <?php
                    if(is_array($products) && count($products) >0){
                        $d=0;
                        foreach ($products as $product){
                            $d++;
                            echo Yii::$app->controller->renderPartial('/product/_item', [
                                'count' => $d,
                                'model' => $product,
                            ]);
                            ?>
                        <?php }
                    }else{
                        echo '<div class="alert alert-warning">Chưa có sản phẩm nào.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="text-center"><?php echo $pagination; ?></div>
    </div>
</div>

<script>
    function sortProduct(e) {
        window.location.href = e.value;
    }
</script>