<?php

namespace frontend\modules\api\controllers;

use yii\web\Controller;
use yii\web\Response;

class BlogController extends Controller
{
    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return
            [
                'status' => 'ok',
                'data' => 'test',
            ];
    }

    /**
     * @return string
     */
    public function actionDetail()
    {
        return $this->render('detail');
    }
}