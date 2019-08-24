<?php

namespace frontend\controllers;

use yii\base\Controller;

class MainController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}