<?php
$config = [
    'homeUrl'=>Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => ['maintenance'],
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
            //'shouldBeActivated' => true
        ],
        /*'api' => [
            'class' => 'frontend\modules\api\Module',
            'modules' => [
                'v1' => 'frontend\modules\api\v1\Module'
            ]
        ]*/
        'sitemap' => [
            'class' => 'enchikiben\sitemap\Sitemap',
            'controllerDirAlias' => '@frontend/controllers'
        ],
        /*
        'robotsTxt' => [
            'class' => 'execut\robotsTxt\Module',
            'components'    => [
                'generator' => [
                    'class' => \execut\robotsTxt\Generator::class,
                    'host' => \common\components\CFunction::getDomain(),
                    'sitemap' => 'sitemap.xml',
                    'userAgent' => [
                        '*' => [
                            'Disallow' => [
                                'noIndexedHtmlFile.html',
                                [
                                    'notIndexedModule/noIndexedController/noIndexedAction',
                                    'noIndexedActionParam' => 'noIndexedActionParamValue',
                                ]
                            ],
                            'Allow' => [
                                //..
                            ],
                        ],
                        'BingBot' => [
                            'Sitemap' => '/sitemapSpecialForBing.xml',
                            'Disallow' => [
                                //..
                            ],
                            'Allow' => [
                                //..
                            ],
                        ],
                    ],
                ],
            ],
        ]*/

    ],
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => env('GITHUB_CLIENT_ID'),
                    'clientSecret' => env('GITHUB_CLIENT_SECRET')
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => env('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => env('FACEBOOK_CLIENT_SECRET'),
                    'scope' => 'email,public_profile',
                    'attributeNames' => [
                        'name',
                        'email',
                        'first_name',
                        'last_name',
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'maintenance' => [
            'class' => 'common\components\maintenance\Maintenance',
            'enabled' => function ($app) {
                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
            }
        ],
        'request' => [
            'enableCsrfValidation' => env('ENABLE_CSRF'),
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY'),
            'baseUrl' => '',
            'csrfParam' => '_csrf_frontend',
            'csrfCookie' => [
                'httpOnly' => env('SESSION_COOKIE_HTTP_ONLY'),
                'secure' => env('SESSION_COOKIE_SECURE'),
            ],
        ],
        'session' => [
            //'class' => 'yii\web\DbSession',
            'timeout' => '900',
            'cookieParams' => [
                'httpOnly' => env('SESSION_COOKIE_HTTP_ONLY'),
                'secure' => env('SESSION_COOKIE_SECURE'),
            ],
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ],
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'crud'=>[
                'class'=>'yii\gii\generators\crud\Generator',
                'messageCategory'=>'frontend'
            ]
        ]
    ];
}

return $config;
