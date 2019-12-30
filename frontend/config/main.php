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
    'defaultRoute' => 'site/doc',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module',
        ],
    ],
    'components' => [
        'ym' => [
            'class' => 'betsuno\yii2yandexMoney\YMComponent',
            'client_id' => '3D5B0CC4FEE00E201B331D31F8406F8AF42F7EA7DFC2294F9D074AC7249BA304',
            'code' => '......',
            'redirect_uri' => 'http://examator.ru',
            'client_secret' => 'C1D13A47613CC5E0DF9B961C0DBE84DE73A10B1B627AA6897ECF0A0FB54E07200654359D751C1A1DF6376B3D0CF5B9EF6FD957F4292AB84EEE9BBF683DFB467E'
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '7200615',
                    'clientSecret' => 'LMdG6Z403NdoknGG7PY1',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => 'google_client_id',
                    'clientSecret' => 'google_client_secret',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
                'instagram' => [
                    'class' => 'kotchuprik\authclient\Instagram',
                    'clientId' => 'instagram_client_id',
                    'clientSecret' => 'instagram_client_secret',
                ],

            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
//            'enableCookieValidation' => false,
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
//        'response' => [
//            'format' => yii\web\Response::FORMAT_JSON,
//            'charset' => 'UTF-8',
//
//            // ...
//        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableSession' => true,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],

        'session' => [
//            'class' => 'yii\web\DbSession',
//            'writeCallback' => function ($session) {
//                return [
//                    'user_id' => Yii::$app->user->id,
//                    'status' => 1,
//                    'token' => Yii::$app->security->generateRandomString(),
//                ];
//            }
            'name' => 'advanced-frontend',

            // 'db' => 'mydb',  // the application component ID of the DB connection. Defaults to 'db'.
            // 'sessionTable' => 'my_session', // session table name. Defaults to 'session'.
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [

                '' => 'site/doc',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
                'api/subjects/details/<slug>' => 'api/subjects/details/',
                'api/lessons/details/<slug>' => 'api/lessons/details/',
                'api/blog/details/<slug>' => 'api/blog/details/',
                'api/sections/details/<slugSection>/<slugLesson>' => 'api/sections/details/',
                'api/sections/details/<slugSection>' => 'api/sections/details/',
                'api/subjects/teachers' => 'api/subjects/teachers/',
                'api/subjects/teacher/<slug>' => 'api/subjects/teacher/',
            ],
        ],
    ],
    'params' => $params,
];
