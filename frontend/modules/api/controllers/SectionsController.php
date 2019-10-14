<?php

namespace frontend\modules\api\controllers;

use common\models\SectionSubjects;
use yii\web\Controller;

class SectionsController extends Controller
{
    public function actionDetails($slug)
    {
     
        $model = SectionSubjects::receiveSpecificData($slug);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}
