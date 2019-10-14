<?php

namespace frontend\modules\api\controllers;

use common\models\SectionSubjects;
use yii\web\Controller;

class SectionsController extends Controller
{
    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge([
            [
                'class' => \yii\filters\Cors::className(),
                'cors' =>
                    [
                        'Origin' => ['*'],
                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                        'Access-Control-Request-Headers' => [
                            'Origin',
                            'X-Requested-With',
                            'Content-Type',
                            'accept',
                            /*'Authorization'*/
                        ],
                        'Access-Control-Expose-Headers' =>
                            [
                                'X-Pagination-Per-Page',
                                'X-Pagination-Total-Count',
                                'X-Pagination-Current-Page',
                                'X-Pagination-Page-Count',
                            ],
                    ],
            ],
        ],
            parent::behaviors()
        );
    }

    public function actionDetails($slug)
    {



        $model = SectionSubjects::receiveSpecificData($slug);
//
//        if (empty($model)) {
//            throw new NotFoundHttpException();
//        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}
