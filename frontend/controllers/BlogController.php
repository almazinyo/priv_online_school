<?php

namespace frontend\controllers;

use yii\web\Controller;

class BlogController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionDetail()
    {
        return $this->render('detail');
    }
}