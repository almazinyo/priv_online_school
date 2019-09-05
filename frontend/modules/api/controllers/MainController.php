<?php

namespace frontend\modules\api\controllers;

;

use common\models\Menu;
use frontend\modules\api\components\Select;
use yii\base\Controller;
use yii\web\Response;

class MainController extends Controller
{
    /**
     * {@inheritDoc}
     */
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
        return [];
    }

    /**
     * @return string
     */
    public function actionMenu()
    {
        $model = Select::receiveAllData(new Menu());
        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}
