<?php

namespace frontend\modules\api\controllers;

use common\models\SectionSubjects;
use common\models\Subjects;
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
        $model = Subjects::receiveSubjects();

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    public function actionSection()
    {
        $getRequest = \Yii::$app->request->get();
        $subjectId = Subjects::receiveId($getRequest['slug']);

        if ($subjectId === -1) {
            throw new NotFoundHttpException();
        }

        $model = SectionSubjects::receiveSectionSubjects($subjectId);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}