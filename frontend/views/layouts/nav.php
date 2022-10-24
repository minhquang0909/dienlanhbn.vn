<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\ProductCategory as FProductCategory;
use frontend\models\ServiceCategory as FServiceCategory;
use common\components\CFunction;
use common\models\WidgetCarouselItem;
use common\models\Banner;
use yii\helpers\VarDumper;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php');
$categories = FProductCategory::getRootCategory();
$service_categories = FServiceCategory::getRootCategory();
//
?>
<!--mobile menu-->
<div id="main-menu" class="mobile-sidebar no-scrollbar mfp-hide">
    <div class="sidebar-menu no-scrollbar text-center">
        <ul class="nav nav-sidebar nav-vertical nav-uppercase nav-anim">
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-4217">
                <a href="<?=Url::toRoute(['site/index'])?>">Trang chủ</a>
            </li>
            <!--End Category sản phẩm mobile-->
            <?php
            if(is_array($categories) && count($categories) > 0){
                foreach ($categories as $cat){
                    $url_cat = Url::to(['product/index', 'category_slug' => $cat['slug']]);
                    ?>
                    <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-<?=$cat['id']?> has-child" aria-expanded="false">
                        <a href="<?=$url_cat?>"><?=Html::encode($cat['title'])?></a>
                        <button class="toggle"><i class="button-nav-child fal fa-angle-down"></i></button>
                    
                        <?php
                        echo Yii::$app->controller->renderPartial('/layouts/_cat_item_mobile',[
                                'category'  =>  $cat,
                                'type'      =>  'product'
                        ]);
                        ?>
                    </li>
                <?php }
            }
            ?>
            <!--End Category sản phẩm mobile-->

            <!--Dịch vụ-->
            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2478 has-child" aria-expanded="false">
                <a href="<?=Url::to(['service/index'])?>">Dịch vụ</a>
                <button class="toggle"><i class="button-nav-child fal fa-angle-down"></i></button>
            
                <?php
                echo Yii::$app->controller->renderPartial('/layouts/_cat_item_mobile',[
                    'category'  =>  $service_categories,
                    'type'      =>  'service',
                    'has_child_level_2' =>  \common\models\ServiceCategory::HAS_CHILD_LEVEL_2,
                ]);
                ?>
            </li>            
            <!--End Dịch vụ-->
            <li class="menu-item menu-item-type-taxonomy menu-item-object-category current-menu-item menu-item-4643">
                <a href="<?php echo Url::to(['article/index']);?>" aria-current="page">Tin tức</a></li>
        </ul>
    </div>
</div>
<?php
$controllerId = Yii::$app->controller->id;
$actionId = Yii::$app->controller->action->id;
if($controllerId=='site' && $actionId=='index'){
    $content_class = 'content-area';
}else if($controllerId='article'){
    $content_class = 'blog-wrapper blog-single';
}else{
    $content_class = 'content-area';
}
?>
<div id="wrapper">
    <header id="header" class="header has-sticky sticky-jump" style="">
        <div class="header-wrapper">
            <div id="masthead" class="header-main hide-for-sticky">
                <div class="header-inner flex-row container logo-left medium-logo-center" role="navigation">
                    <!-- Logo -->
                    <div id="logo" class="flex-col logo">
                        <!-- Header logo -->
                        <?php
                        $logo = WidgetCarouselItem::getBannerByPosition(Banner::LOGO, Banner::LIMIT_LOGO);
                        $logo = $logo[0]??false;
                        if($logo) {
                            $logo_img = CFunction::buildThumbnail([
                                'thumbnail_base_url' => $logo['base_url'],
                                'thumbnail_path' => $logo['path'],
                            ], 1000, 300);
                            ?>
                            <a href="<?=Url::toRoute('site/index')?>" title="<?=Yii::$app->controller->pageTitle?>" rel="home">
                                <img width="351" height="111" src="<?=$logo_img?>" class="header_logo header-logo" alt="<?=Yii::$app->name?>">
                            </a>
                        <?php }
                        ?>
                    </div>

                    <!-- Mobile Left Elements -->
                    <div class="flex-col show-for-medium flex-left">
                        <ul class="mobile-nav nav nav-left ">
                            <li class="nav-icon has-icon">
                                <div class="header-button">
                                    <a href="#" data-open="#main-menu" data-pos="center" data-bg="main-menu-overlay" data-color="" class="icon button circle is-outline is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Left Elements -->
                    <div class="flex-col hide-for-medium flex-left flex-grow">
                        <ul class="header-nav header-nav-main nav nav-left  nav-line-bottom nav-size-xlarge nav-spacing-xlarge nav-uppercase">
                        </ul>
                    </div>

                    <!-- Right Elements -->
                    <div class="flex-col hide-for-medium flex-right">
                        <ul class="header-nav header-nav-main nav nav-right  nav-line-bottom nav-size-xlarge nav-spacing-xlarge nav-uppercase">
                            <?php
                            $top_banner = WidgetCarouselItem::getBannerByPosition(Banner::TOP_BANNER, Banner::LIMIT_TOP_BANNER);
                            $top_banner = $top_banner[0]??false;
                            if($top_banner) {
                                $top_banner_img = CFunction::buildThumbnail([
                                    'thumbnail_base_url' => $top_banner['base_url'],
                                    'thumbnail_path' => $top_banner['path'],
                                ], 1000, 100);
                                ?>
                                <li class="html custom html_topbar_right">
                                    <img src="<?=$top_banner_img?>">
                                </li>
                            <?php }
                            ?>

                        </ul>
                    </div>

                    <!-- Mobile Right Elements -->
                    <div class="flex-col show-for-medium flex-right">
                        <ul class="mobile-nav nav nav-right ">
                            <li class="cart-item has-icon">
                                <div class="header-button">
                                    <a href="<?php echo Url::to(['product/cart']);?>" class="header-cart-link off-canvas-toggle nav-top-link icon primary button circle is-small" data-open2="#cart-popup" data-class2="off-canvas-cart" title="Giỏ hàng" data-pos="right">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                                <!-- Cart Sidebar Popup -->
                                <div id="cart-popup" class="mfp-hide widget_shopping_cart">
                                    <div class="cart-popup-inner inner-padding">
                                        <div class="cart-popup-title text-center">
                                            <h4 class="uppercase">Giỏ hàng</h4>
                                            <div class="is-divider"></div>
                                        </div>
                                        <div class="widget_shopping_cart_content">
                                            <p class="woocommerce-mini-cart__empty-message">Chưa có sản phẩm trong giỏ hàng.</p>
                                        </div>
                                        <div class="cart-sidebar-content relative"></div>  </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="wide-nav" class="header-bottom wide-nav flex-has-center hide-for-medium">
                <div class="flex-row container">
                    <div class="flex-col hide-for-medium flex-left">
                    <?php
                        echo Yii::$app->controller->renderPartial('/product/_main_category_menu',[

                        ]);
                        ?>                        
                    </div>
                    <!--PC menu-->
                    <div class="flex-col hide-for-medium flex-center">
                        <ul class="nav header-nav header-bottom-nav nav-center  nav-divided nav-size-xlarge nav-spacing-xlarge nav-uppercase">
                            <li id="menu-item-4217" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-4217 menu-item-design-default">
                                <a href="<?=Url::toRoute('site/index')?>" class="nav-top-link">Trang chủ</a>
                            </li>
                            <!--Category sản phẩm-->
                            <?php
                            if(is_array($categories) && count($categories) > 0){
                                foreach ($categories as $cat){
                                    $url_cat = Url::to(['product/index', 'category_slug' => $cat['slug']]);
                                    ?>
                                    <li id="menu-item-<?=$cat['id']?>" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-<?=$cat['id']?> menu-item-design-default has-dropdown">
                                        <a href="<?=$url_cat?>" class="nav-top-link"><?=Html::encode($cat['title'])?><i class="button-nav-child fal fa-angle-down"></i></a>
                                        <?php
                                        echo Yii::$app->controller->renderPartial('/layouts/_cat_item',[
                                                'category'  =>  $cat,
                                                'type'      =>  'product'
                                        ]);
                                        ?>
                                    </li>
                                <?php }
                            }
                            ?>
                            <!--End Category sản phẩm-->
                            <!--Category dịch vụ-->
                            <li id="menu-item-service" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-service menu-item-design-default has-dropdown">
                                <a href="<?=Url::to(['service/index'])?>" class="nav-top-link">Dịch vụ<i class="button-nav-child fal fa-angle-down"></i></a>
                                <?php
                                echo Yii::$app->controller->renderPartial('/layouts/_cat_item',[
                                    'category'  =>  $service_categories,
                                    'type'      =>  'service',
                                    'has_child_level_2' =>  \common\models\ServiceCategory::HAS_CHILD_LEVEL_2,
                                ]);
                                ?>
                            </li>
                            <!--End dịch vụ-->
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category current-menu-item menu-item-design-default">
                                <a href="<?php echo Url::to(['article/index']);?>" aria-current="page" class="nav-top-link">Tin tức</a>
                            </li>
                        </ul>
                    </div>
                    <!--END PC menu-->
                    <!--search box--->
                    <div class="flex-col hide-for-medium flex-right flex-grow">
                        <ul class="nav header-nav header-bottom-nav nav-right  nav-divided nav-size-xlarge nav-spacing-xlarge nav-uppercase">
                            <li class="header-search header-search-lightbox has-icon">
                                <div class="header-button">
                                    <a href="#search-lightbox" aria-label="Tìm kiếm" data-open="#search-lightbox" data-focus="input.search-field" class="icon primary button round is-small">
                                        <i class="fa fa-search" style="font-size:16px;"></i></a>
                                </div>

                                <div id="search-lightbox" class="mfp-hide dark text-center">
                                    <div class="searchform-wrapper ux-search-box relative form-flat is-large">
                                        <form role="search" method="get" class="searchform" action="<?=Url::to(['product/index'])?>">
                                            <div class="flex-row relative">
                                                <div class="flex-col flex-grow">
                                                    <label class="screen-reader-text" for="form-product-search-field">Tìm kiếm:</label>
                                                    <input type="search" id="form-product-search-field" class="search-field mb-0" placeholder="Bạn cần tìm gì..." value="" name="keyword">
                                                </div>
                                                <div class="flex-col">
                                                    <button type="submit" value="Tìm kiếm" class="ux-search-submit submit-button secondary button icon mb-0" aria-label="Submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="live-search-results text-left z-top"></div>
                                        </form>
                                    </div>	</div>
                            </li>
                        </ul>
                    </div>
                    <!--End search box--->
                </div>
            </div>

            <div class="header-bg-container fill"><div class="header-bg-image fill"></div><div class="header-bg-color fill"></div></div>		</div>
    </header>
    <div class="main" id="main">
        <div id="content" class="<?php echo $content_class; ?> page-wrapper">
            <?php echo $content ?>
        </div>
</div>

<!--End Mobile menu-->


<?php $this->endContent() ?>
