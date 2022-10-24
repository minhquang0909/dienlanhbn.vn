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

<div id="secondary" class="widget-area " role="complementary">
    <aside id="nav_menu-3" class="widget widget_nav_menu">
        <div class="menu-menu-chiller-container">
            <ul id="menu-menu-chiller" class="menu">
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
    </aside>
</div>