<?php

namespace frontend\modules\api\controllers;

use yii\rest\Controller;

class MapController extends Controller
{
    public function actionIndex()
    {
        $homeUrl = \Yii::$app->homeUrl;

        return [
            'GET' => [
                'Blog' => [
                    $homeUrl . 'api/blog',
                    $homeUrl . 'api/details/<slug>',
                ],
                'Menu' => [
                    $homeUrl . 'api/main/menu',
                ],

                'Options' => [
                    $homeUrl . '/api/main/options',
                ],

                'Subjects' => [
                    $homeUrl . 'api/subjects',
                    $homeUrl . 'api/subjects/menu',
                    $homeUrl . 'api/subjects/details/<slug>',
                    [
                        'Sections' => [
                            $homeUrl . 'api/subjects/sections',
                            $homeUrl . 'api/sections/details/<slug>',
                        ],
                        'Lessons' => [
                            $homeUrl . 'api/subjects/lessons',
                            $homeUrl . 'api/lessons/details/<slug>',

                        ],
                        'Teachers' => [
                            $homeUrl . 'api/subjects/teachers',
                            $homeUrl . 'api/subjects/teacher/<slug>',

                        ],
                    ],
                ],
            ],
        ];
    }
}
