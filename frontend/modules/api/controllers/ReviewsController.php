<?php

namespace frontend\modules\api\controllers;;

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