<?php

namespace frontend\controllers;

use yii\web\Controller;

class ReviewsController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}