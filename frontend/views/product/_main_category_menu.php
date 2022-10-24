<?php
use common\models\AirConditionerTypes;
use common\models\ProductCategory;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\VarDumper;

$cat_types = AirConditionerTypes::getAllTypes();
$product_cat_limit = ProductCategory::MAX_LIMIT_FOR_CAT_MENU - count($cat_types);
$product_cat_list = ProductCategory::getAirCategoryList(0, $product_cat_limit);
?>


<ul class="nav header-nav header-bottom-nav nav-left  nav-divided nav-size-xlarge nav-spacing-xlarge nav-uppercase">
    <div id="mega-menu-wrap" class="ot-vm-hover">
        <div id="mega-menu-title"><i class="fa fa-bars"></i> Danh mục sản phẩm</div>        
        <ul id="mega_menu" class="sf-menu sf-vertical sf-js-enabled sf-arrows" style="touch-action: pan-y;">
            <?php
            if(is_array($cat_types) && count($cat_types) > 0){
                foreach ($cat_types as $ct){ ?>
                    <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-<?=$ct['id']?>">
                        <a href="<?=Url::to(['product/types', 'category_slug' => $ct['slug']])?>"><?=$ct['title']?></a>
                    </li>
                <?php }
            }
            ?>
            <?php
            if(is_array($product_cat_list) && count($product_cat_list) > 0){
                foreach ($product_cat_list as $c){ ?>
                    <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-<?=$c['id']?>">
                        <a href="<?=Url::to(['product/index', 'category_slug' => $c['slug']])?>"><?=$c['title']?></a>
                    </li>
                <?php }
            }
            ?>            
        </ul>            
    </div>
</ul>