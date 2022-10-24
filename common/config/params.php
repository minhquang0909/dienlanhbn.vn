<?php
return [
    'adminEmail' => env('ADMIN_EMAIL'),
    'robotEmail' => env('ROBOT_EMAIL'),
    'availableLocales'=>[
        'en'=>'English',
        'ru-RU'=>'Русский (РФ)',
        'uk-UA'=>'Українська (Україна)',
        'es' => 'Español',
        'vi' => 'Tiếng Việt',
        'zh-CN' => '简体中文',
        'pl-PL' => 'Polski (PL)',
    ],
    'site'  =>  [
        'contact_fb_fanpage_name'    =>  'Nhựa Đức Thành',

    ],
    'email_reciver_new_contact' =>  'phamvannguyen.haui@gmail.com',
    'cache_time'    =>      env('CACHE_TIME',10), //10s
];