<?php

namespace frontend\modules\api\controllers;

use common\models\Blog;
use frontend\modules\api\components\Select;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BlogController extends Controller
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
        $model = Select::receiveAllData(new Blog());

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @return mixed[]
     * @throws NotFoundHttpException
     */
    public function actionDetails($slug)
    {
        $model = Select::receiveSpecificData(new Blog(), ['slug' => Html::encode($slug)]);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}