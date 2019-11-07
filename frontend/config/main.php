<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'defaultRoute' => 'main/index',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module',
        ],
    ],
    'components' => [
//        'vk' => [
//            'class' => 'jumper423\VK',
//            'clientId' => '7200615',
//            'clientSecret' => 'LMdG6Z403NdoknGG7PY1',
//            'delay' => 0.7, // Минимальная задержка между запросами
//            'delayExecute' => 120, // Задержка между группами инструкций в очереди
//            'limitExecute' => 1, // Количество инструкций на одно выполнении в очереди
//            'captcha' => 'captcha', // Компонент по распознованию капчи
//        ],
//        'captcha' => [
//            'class' => 'jumper423\Captcha',
//            'pathTmp' => '@imagescache/captcha',
//            'apiKey' => '42eab4119020dbc729f657',
//        ],
//        'authClientCollection' => [
//            'class' => 'yii\authclient\Collection',
//            'clients' => [
//                'vkontakte' => [
//                    'class' => 'jumper423\VK',
//                    'clientId' => '7200615',
//                    'clientSecret' => 'LMdG6Z403NdoknGG7PY1',
//                    'delay' => 0.7,
//                    'delayExecute' => 120,
//                    'limitExecute' => 1,
//                    'captcha' => 'captcha',
//                    'scope' => 'friends,photos,pages,wall,groups,email,stats,ads,offline,notifications', //,messages,nohttps
//                    'title' => 'ВКонтакте'
//                ],
//            ],
//        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
//        'response' => [
//            'format' => yii\web\Response::FORMAT_JSON,
//            'charset' => 'UTF-8',
//
//            // ...
//        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'api/map/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
                'api/subjects/details/<slug>' => 'api/subjects/details/',
                'api/lessons/details/<slug>' => 'api/lessons/details/',
                'api/blog/details/<slug>' => 'api/blog/details/',
                'api/sections/details/<slugSection>/<slugLesson>' => 'api/sections/details/',
                'api/sections/details/<slugSection>' => 'api/sections/details/',
                'api/subjects/teacher/<slug>' => 'api/subjects/teacher/',
            ],
        ],
    ],
    'params' => $params,
];
