<?php

namespace frontend\modules\api\controllers;

use common\models\User;
use frontend\modules\api\controllers\service\UsersService;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Session;
use yii;

class UsersController extends Controller
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
     * @var UsersService
     */
    private $userService;

    public function init()
    {
        $this->userService = new UsersService();
        Yii::$app->response->format = Response::FORMAT_JSON;

        parent::init();
    }

    public function actionCurrentUser($token)
    {
        $service = $this->userService;

        $user = $service->receiveUser($token);

        return
            [
                'status' => 200,
                'data' => [
                    'username' => $user->username,
                    'email' => $user->email,
                    'first_name' => $user->profiles->last_name,
                    'phone' => $user->profiles->phone,
                    'city' => $user->profiles->city,
                ],

            ];
    }
}
