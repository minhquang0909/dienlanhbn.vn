<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */
use common\components\CFunction;

//\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <!--<link rel="profile" href="https://gmpg.org/xfn/11">-->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Html::encode(Yii::$app->controller->pageTitle) ?></title>
    <meta http-equiv="Content-Language" content="vi" />
    <meta name="revisit-after" content="1 days" />
    <meta name="apple-mobile-web-app-title" content="<?=Yii::$app->controller->pageTitle?>" />
    <meta name="description" content="<?=Yii::$app->controller->pageDecription?>" />
    <meta name="keywords" content="<?=Yii::$app->controller->pageKeywords?>" />
    <meta name="robots" content="index,follow" />
    <link href="<?=Yii::$app->controller->pageUrl?>" rel="canonical" />
    <meta property="fb:app_id" content="<?=Yii::$app->controller->fb_app_id?>" />
    <meta property="og:type" content="<?=Yii::$app->controller->fb_content_type?>" />
    <meta property="og:image" itemprop="thumbnailUrl" content="<?=Yii::$app->controller->pageImage?>" />
    <meta property="og:url" content="<?=Yii::$app->controller->pageUrl?>" />
    <meta property="og:title" content="<?=Yii::$app->controller->pageTitle?>" />
    <meta property="og:description" content="<?=Yii::$app->controller->pageDecription?>" />
    <link rel="shortcut icon" href="<?=CFunction::getDomain()?>/favicon.png" type="image/x-icon">
    <?php $this->registerCssFile("/css/fontawesome.5.14.0/css/all.min.css"); ?>
    <?php $this->registerCssFile("/css/style.css"); ?>
    <link rel="stylesheet" id="flatsome-main-css" href="<?php echo \common\components\CFunction::registerCss('flatsome.css')?>" type="text/css" media="all">
    <link rel="stylesheet" id="flatsome-googlefonts-css" href="//fonts.googleapis.com/css?family=Roboto%3Aregular%2C700%2Cregular%7CRoboto+Condensed%3Aregular%2C700%7CDancing+Script%3Aregular%2C400&amp;display=swap&amp;ver=3.9" type="text/css" media="all">
    <?php $this->registerCssFile("/css/main.css"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?php $this->registerJsFile("/js/sweetalert2.min.js"); ?>
    <style>.bg{opacity: 0; transition: opacity 1s; -webkit-transition: opacity 1s;} .bg-loaded{opacity: 1;}
    </style>
    <style id="custom-css" type="text/css">:root {--primary-color: #00a65a;}
        .full-width .ubermenu-nav,
        .container,
        .row{max-width: 1250px}.row.row-collapse{max-width: 1220px}.row.row-small{max-width: 1242.5px}.row.row-large{max-width: 1280px}.header-main{height: 111px}#logo img{max-height: 111px}#logo{width:351px;}#logo a{max-width:500pxpx;}.header-bottom{min-height: 34px}.header-top{min-height: 30px}.transparent .header-main{height: 30px}.transparent #logo img{max-height: 30px}.has-transparent + .page-title:first-of-type,.has-transparent + #main > .page-title,.has-transparent + #main > div > .page-title,.has-transparent + #main .page-header-wrapper:first-of-type .page-title{padding-top: 80px;}.header.show-on-scroll,.stuck .header-main{height:54px!important}.stuck #logo img{max-height: 54px!important}.header-bg-color, .header-wrapper {background-color: rgba(255,255,255,0.9)}.header-bottom {background-color: #4999d4}.header-main .nav > li > a{line-height: 20px }.stuck .header-main .nav > li > a{line-height: 7px }.header-bottom-nav > li > a{line-height: 5px }@media (max-width: 549px) {.header-main{height: 70px}#logo img{max-height: 70px}}.nav-dropdown-has-arrow.nav-dropdown-has-border li.has-dropdown:before{border-bottom-color: #fcfcfc;}.nav .nav-dropdown{border-color: #fcfcfc }.nav-dropdown{font-size:96%}.nav-dropdown-has-arrow li.has-dropdown:after{border-bottom-color: #f9f9f9;}.nav .nav-dropdown{background-color: #f9f9f9}.header-top{background-color:#ffffff!important;}/* Color */.accordion-title.active, .has-icon-bg .icon .icon-inner,.logo a, .primary.is-underline, .primary.is-link, .badge-outline .badge-inner, .nav-outline > li.active> a,.nav-outline >li.active > a, .cart-icon strong,[data-color='primary'], .is-outline.primary{color: #4999d4;}/* Color !important */[data-text-color="primary"]{color: #4999d4!important;}/* Background Color */[data-text-bg="primary"]{background-color: #4999d4;}/* Background */.scroll-to-bullets a,.featured-title, .label-new.menu-item > a:after, .nav-pagination > li > .current,.nav-pagination > li > span:hover,.nav-pagination > li > a:hover,.has-hover:hover .badge-outline .badge-inner,button[type="submit"], .button.wc-forward:not(.checkout):not(.checkout-button), .button.submit-button, .button.primary:not(.is-outline),.featured-table .title,.is-outline:hover, .has-icon:hover .icon-label,.nav-dropdown-bold .nav-column li > a:hover, .nav-dropdown.nav-dropdown-bold > li > a:hover, .nav-dropdown-bold.dark .nav-column li > a:hover, .nav-dropdown.nav-dropdown-bold.dark > li > a:hover, .is-outline:hover, .tagcloud a:hover,.grid-tools a, input[type='submit']:not(.is-form), .box-badge:hover .box-text, input.button.alt,.nav-box > li > a:hover,.nav-box > li.active > a,.nav-pills > li.active > a ,.current-dropdown .cart-icon strong, .cart-icon:hover strong, .nav-line-bottom > li > a:before, .nav-line-grow > li > a:before, .nav-line > li > a:before,.banner, .header-top, .slider-nav-circle .flickity-prev-next-button:hover svg, .slider-nav-circle .flickity-prev-next-button:hover .arrow, .primary.is-outline:hover, .button.primary:not(.is-outline), input[type='submit'].primary, input[type='submit'].primary, input[type='reset'].button, input[type='button'].primary, .badge-inner{background-color: #4999d4;}/* Border */.nav-vertical.nav-tabs > li.active > a,.scroll-to-bullets a.active,.nav-pagination > li > .current,.nav-pagination > li > span:hover,.nav-pagination > li > a:hover,.has-hover:hover .badge-outline .badge-inner,.accordion-title.active,.featured-table,.is-outline:hover, .tagcloud a:hover,blockquote, .has-border, .cart-icon strong:after,.cart-icon strong,.blockUI:before, .processing:before,.loading-spin, .slider-nav-circle .flickity-prev-next-button:hover svg, .slider-nav-circle .flickity-prev-next-button:hover .arrow, .primary.is-outline:hover{border-color: #4999d4}.nav-tabs > li.active > a{border-top-color: #4999d4}.widget_shopping_cart_content .blockUI.blockOverlay:before { border-left-color: #4999d4 }.woocommerce-checkout-review-order .blockUI.blockOverlay:before { border-left-color: #4999d4 }/* Fill */.slider .flickity-prev-next-button:hover svg,.slider .flickity-prev-next-button:hover .arrow{fill: #4999d4;}/* Background Color */[data-icon-label]:after, .secondary.is-underline:hover,.secondary.is-outline:hover,.icon-label,.button.secondary:not(.is-outline),.button.alt:not(.is-outline), .badge-inner.on-sale, .button.checkout, .single_add_to_cart_button, .current .breadcrumb-step{ background-color:#0a0a0a; }[data-text-bg="secondary"]{background-color: #0a0a0a;}/* Color */.secondary.is-underline,.secondary.is-link, .secondary.is-outline,.stars a.active, .star-rating:before, .woocommerce-page .star-rating:before,.star-rating span:before, .color-secondary{color: #0a0a0a}/* Color !important */[data-text-color="secondary"]{color: #0a0a0a!important;}/* Border */.secondary.is-outline:hover{border-color:#0a0a0a}.success.is-underline:hover,.success.is-outline:hover,.success{background-color: #77b43a}.success-color, .success.is-link, .success.is-outline{color: #77b43a;}.success-border{border-color: #77b43a!important;}/* Color !important */[data-text-color="success"]{color: #77b43a!important;}/* Background Color */[data-text-bg="success"]{background-color: #77b43a;}body{font-size: 95%;}@media screen and (max-width: 549px){body{font-size: 100%;}}body{font-family:"Roboto", sans-serif}body{font-weight: 0}body{color: #0a0a0a}.nav > li > a {font-family:"Roboto Condensed", sans-serif;}.mobile-sidebar-levels-2 .nav > li > ul > li > a {font-family:"Roboto Condensed", sans-serif;}.nav > li > a {font-weight: 700;}.mobile-sidebar-levels-2 .nav > li > ul > li > a {font-weight: 700;}h1,h2,h3,h4,h5,h6,.heading-font, .off-canvas-center .nav-sidebar.nav-vertical > li > a{font-family: "Roboto", sans-serif;}h1,h2,h3,h4,h5,h6,.heading-font,.banner h1,.banner h2{font-weight: 700;}h1,h2,h3,h4,h5,h6,.heading-font{color: #0a0a0a;}.alt-font{font-family: "Dancing Script", sans-serif;}.alt-font{font-weight: 400!important;}.header:not(.transparent) .header-nav-main.nav > li > a {color: #0a0a0a;}.header:not(.transparent) .header-nav-main.nav > li > a:hover,.header:not(.transparent) .header-nav-main.nav > li.active > a,.header:not(.transparent) .header-nav-main.nav > li.current > a,.header:not(.transparent) .header-nav-main.nav > li > a.active,.header:not(.transparent) .header-nav-main.nav > li > a.current{color: #dd3333;}.header-nav-main.nav-line-bottom > li > a:before,.header-nav-main.nav-line-grow > li > a:before,.header-nav-main.nav-line > li > a:before,.header-nav-main.nav-box > li > a:hover,.header-nav-main.nav-box > li.active > a,.header-nav-main.nav-pills > li > a:hover,.header-nav-main.nav-pills > li.active > a{color:#FFF!important;background-color: #dd3333;}.header:not(.transparent) .header-bottom-nav.nav > li > a{color: #ffffff;}.header:not(.transparent) .header-bottom-nav.nav > li > a:hover,.header:not(.transparent) .header-bottom-nav.nav > li.active > a,.header:not(.transparent) .header-bottom-nav.nav > li.current > a,.header:not(.transparent) .header-bottom-nav.nav > li > a.active,.header:not(.transparent) .header-bottom-nav.nav > li > a.current{color: #000000;}.header-bottom-nav.nav-line-bottom > li > a:before,.header-bottom-nav.nav-line-grow > li > a:before,.header-bottom-nav.nav-line > li > a:before,.header-bottom-nav.nav-box > li > a:hover,.header-bottom-nav.nav-box > li.active > a,.header-bottom-nav.nav-pills > li > a:hover,.header-bottom-nav.nav-pills > li.active > a{color:#FFF!important;background-color: #000000;}a{color: #0a0a0a;}a:hover{color: #dd3333;}.tagcloud a:hover{border-color: #dd3333;background-color: #dd3333;}.shop-page-title.featured-title .title-overlay{background-color: #f2f2f2;}.has-equal-box-heights .box-image {padding-top: 100%;}@media screen and (min-width: 550px){.products .box-vertical .box-image{min-width: 247px!important;width: 247px!important;}}.absolute-footer, html{background-color: #0a0a0a}.page-title-small + main .product-container > .row{padding-top:0;}/* Custom CSS */.home .page-wrapper {padding:0px;}#mega-menu-wrap {background-color:#000}.label-new.menu-item > a:after{content:"New";}.label-hot.menu-item > a:after{content:"Hot";}.label-sale.menu-item > a:after{content:"Sale";}.label-popular.menu-item > a:after{content:"Popular";}
    </style>
    <style>
        .bootstrapiso .tooltip {
            font-size: 14px;
        }
        .bootstrapiso .tooltip-inner {
            max-width: 200px;
        }
    </style>
    <!-- -->
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
    <?php
    if(isset(Yii::$app->controller->config['header_extra']) && Yii::$app->controller->config['header_extra']!=""){
        echo Yii::$app->controller->config['header_extra'];
    }
    ?>
</head>
<?php
$controllerId = Yii::$app->controller->id;
$actionId = Yii::$app->controller->action->id;
$home_page_class = ($controllerId=='site' && $actionId=='index')?'home':'';
?>
<body data-rsssl=1 class="<?php echo $home_page_class;?> page-template-default page page-id-4216 theme-flatsome ot-vertical-menu ot-submenu-top ot-menu-show-home woocommerce-no-js header-shadow lightbox nav-dropdown-has-shadow nav-dropdown-has-border">
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
