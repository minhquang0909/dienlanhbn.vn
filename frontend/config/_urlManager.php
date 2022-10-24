<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        // Pages
        ''                 =>  'site/index',
        'tin-tuc'          =>  'article/index',
        ['pattern'         =>'tin-tuc/<slug>', 'route'=>'article/detail'],

        ['pattern'=>'dich-vu/<category_slug>', 'route'=>'service/index'],
        ['pattern'=>'chi-tiet-dich-vu/<slug>', 'route'=>'service/detail'],
        ['pattern'=>'dich-vu', 'route'=>'service/index'],

        ['pattern'=>'san-pham/<category_slug>', 'route'=>'product/index'],
        ['pattern'=>'loai-dieu-hoa/<category_slug>', 'route'=>'product/types'],
        ['pattern'=>'chi-tiet-san-pham/<slug>', 'route'=>'product/detail'],
        ['pattern'=>'add-to-cart', 'route'=>'product/addToCart'],
        ['pattern'=>'san-pham', 'route'=>'product/index'],
        ['pattern'=>'gio-hang', 'route'=>'product/cart'],
        ['pattern'=>'dat-hang', 'route'=>'product/order'],
        ['pattern'=>'dat-hang-thanh-cong', 'route'=>'product/order-success'],
        //['pattern' => 'product/<slug>-c<id:\d+>', 'route' => 'product/category'],
        ['pattern'=>'search', 'route'=>'product/search'],

        'about'          =>  'site/about',
        'partners'          =>  'site/partners',
        'contact'          =>  'site/contact',
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],
        //sitemap
        ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
        //['pattern' => 'robots', 'route' => 'robotsTxt/web/index', 'suffix' => '.txt'],
    ]
];
