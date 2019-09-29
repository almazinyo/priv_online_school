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

                'Subjects' => [
                    $homeUrl . 'api/subjects',
                    [
                        'Sections' => [
                            $homeUrl . 'api/subjects/sections',
                            $homeUrl . 'api/subjects/details/<slug>',

                        ],
                        'Lessons' => [
                            $homeUrl . 'api/subjects/lessons',

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