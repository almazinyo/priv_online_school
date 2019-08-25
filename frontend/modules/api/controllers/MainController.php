<?php

namespace frontend\modules\api\controllers;;

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