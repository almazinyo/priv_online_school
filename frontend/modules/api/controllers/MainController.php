<?php

namespace frontend\modules\api\controllers;

;

use common\models\Menu;
use common\models\Options;
use frontend\modules\api\components\Select;
use yii\base\Controller;
use yii\web\Response;

class MainController extends Controller
{
    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge([
            [
                'class' => \yii\filters\Cors::className(),
                'cors' =>
                    [
                        'Origin' => ['*'],
                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                        'Access-Control-Request-Headers' => [
                            'Origin',
                            'X-Requested-With',
                            'Content-Type',
                            'accept',
                            /*'Authorization'*/
                        ],
                        'Access-Control-Expose-Headers' =>
                            [
                                'X-Pagination-Per-Page',
                                'X-Pagination-Total-Count',
                                'X-Pagination-Current-Page',
                                'X-Pagination-Page-Count',
                            ],
                    ],
            ],
        ],
            parent::behaviors()
        );
    }

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

    /**
     * @return string
     */
    public function actionOptions()
    {
        $model = Options::find()->asArray()->all();

        $optionsData = [];

        foreach ($model as $option) {
            $optionsData[$option['key']][] = \Opis\Closure\unserialize($option['value']);
        }

        return
            [
                'status' => 200,
                'data' => $optionsData,
            ];
    }
}
