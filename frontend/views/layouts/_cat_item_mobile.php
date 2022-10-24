<?php
/**
 * Created by PhpStorm.
 * User: phamv
 * Date: 3/23/2022
 * Time: 4:49 PM
 */
use common\models\ProductCategory;
use frontend\models\Product as FProduct;
use common\models\ServiceCategory;
use yii\helpers\Html;
use yii\helpers\VarDumper;
?>

<?php
if($type=='product'){
    $sub_categories = ProductCategory::getChildCategoryById($category['id']??0);
}else{
    $sub_categories = ServiceCategory::getChildCategoryById($category['id']??0);
}

if( (isset($category['has_level_2']) && $category['has_level_2']==ProductCategory::HAS_CHILD_LEVEL_2 ) || ( isset($has_child_level_2) && $has_child_level_2) ){
    if(is_array($sub_categories) && count($sub_categories) > 0){
        ?>
        <ul class="sub-menu nav-sidebar-ul children">
            <?php
            foreach ($sub_categories as $cat_level_1){
                $c_url_1 = FProduct::buildCategoryUrl($cat_level_1, $type);
                ?>
                <li id="menu-item-<?=$cat_level_1['id']?>" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-<?=$cat_level_1['id']?> nav-dropdown-col">
                    <a href="<?=$c_url_1?>"><?=Html::encode($cat_level_1['title'])?></a>
                    <?php
                    if($type=='product'){
                        $sub_categories_level_2 = ProductCategory::getChildCategoryById($cat_level_1['id']??0);
                    }else{
                        $sub_categories_level_2 = ServiceCategory::getChildCategoryById($cat_level_1['id']??0);
                    }
                    if(is_array($sub_categories_level_2) && count($sub_categories_level_2) > 0){ ?>
                        <ul class="sub-menu nav-sidebar-ul">
                            <?php
                            foreach ($sub_categories_level_2 as $cat_level_2){
                                $c_url_2 = FProduct::buildCategoryUrl($cat_level_2, $type);?>
                                <li id="menu-item-<?=$cat_level_2['id']?>" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-<?=$cat_level_2['id']?>">
                                    <a href="<?=$c_url_2?>"><?=Html::encode($cat_level_2['title'])?></a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    <?php }
                    ?>
                </li>
            <?php }
            ?>
        </ul>
    <?php }
    ?>
<?php }else{
    if(is_array($sub_categories) && count($sub_categories) > 0){ ?>
        <ul class="sub-menu nav-sidebar-ul children">
            <?php
            foreach ($sub_categories as $c){
                $c_url = FProduct::buildCategoryUrl($c, $type);
                ?>
                <li id="menu-item-<?=$c['id']?>" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-<?=$c['id']?>">
                    <a href="<?=$c_url?>"><?=Html::encode($c['title'])?></a>
                </li>
            <?php }
            ?>
        </ul>
    <?php }
    ?>
<?php }
?>

