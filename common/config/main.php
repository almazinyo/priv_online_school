<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru',
    'sourceLanguage' => 'en',
    'components' => [

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'basePath' => '@common/messages',
                ],
            ],
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
                    'clientId' => '7200615',
                    'clientSecret' => 'instagram_client_secret',
                ],

            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
            'cache' => 'cache' //Включаем кеширование
        ],

    ],
];
