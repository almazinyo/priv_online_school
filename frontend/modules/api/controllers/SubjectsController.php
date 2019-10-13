<?php

namespace frontend\modules\api\controllers;

use common\models\Lessons;
use common\models\SectionSubjects;
use common\models\StorageLessons;
use common\models\Subjects;
use common\models\Teachers;
use frontend\modules\api\components\Select;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SubjectsController extends Controller
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

    /**
     * @return mixed[]
     */
    public function actionIndex()
    {
        $model = Subjects::receiveAllData();

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @return mixed[]
     */
    public function actionMenu()
    {
        $model = Subjects::receiveMenu();

        return
            [
                'status' => 200,
                'data' => $model,
            ];
    }

    /**
     * @param $slug
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionDetails($slug)
    {
        $model = Subjects::receiveSpecificData(Html::encode($slug));

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @return array
     */
    public function actionSections()
    {
        return [
            'status' => 200,
            'data' => SectionSubjects::receiveAllData(),
        ];
    }

    /**
     * @return array
     */
    public function actionLessons()
    {
        return [
            'status' => 200,
            'data' => Lessons::receiveAllData(),
        ];
    }

    /**
     * @return array
     */
    public function actionStorage()
    {
        return [
            'status' => 200,
            'data' => Select::receiveAllData(new StorageLessons()),
        ];
    }

    /**
     * @return mixed[]
     */
    public function actionTeachers()
    {
        $model = Select::receiveAllData(new Teachers());

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @return mixed[]
     * @throws NotFoundHttpException
     */
    public function actionTeacher($slug)
    {
        $model = Select::receiveSpecificData(new Teachers(), ['slug' => Html::encode($slug)]);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}
