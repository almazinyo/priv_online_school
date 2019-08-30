<?php

namespace frontend\modules\api\controllers;

use common\models\SectionSubjects;
use common\models\Subjects;
use frontend\modules\api\components\Select;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SubjectsController extends Controller
{
    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

    /**
     * @return mixed[]
     */
    public function actionIndex()
    {
        $model = Select::receiveAllData(new Subjects());

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    public function actionSection()
    {
        $getRequest = \Yii::$app->request->get();

        $subjectId =
            Select::receiveId(
                new Subjects(),
                ['slug' => Html::encode($getRequest['slug'])]
            );

        if ($subjectId === -1) {
            throw new NotFoundHttpException();
        }

        $model = Select::receiveSpecificData(new SectionSubjects(), ['subject_id' => $subjectId]);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}