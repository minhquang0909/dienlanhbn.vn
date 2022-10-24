<?php
/**
 * Created by PhpStorm.
 * User: phamv
 * Date: 3/23/2022
 * Time: 4:49 PM
 */
use common\models\AirConditionerTypes;
use common\models\Product;
use yii\helpers\Html;
$ari_conditioner_types = AirConditionerTypes::getAllTypes();
?>


<div class="dl-home-cat-products">
    <?php
    if(is_array($ari_conditioner_types) && count($ari_conditioner_types) >0){
        foreach ($ari_conditioner_types as $cat){
            $products = Product::getProducts(0,10,'date',null,$cat['id']);
            ?>

            <div class="row row-collapse">
                <div class="col cot2 small-12 large-12">
                    <div class="col-inner">
                        <div class="container section-title-container">
                            <h3 class="section-title section-title-normal">
                                <b></b>
                                <span class="section-title-main">
                                    <i class="fa fa-bars"></i><?=Html::encode($cat['title'])?></span>
                                <b></b>
                            </h3>
                        </div>
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
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
    }
    ?>
</div>