<?php

namespace frontend\modules\api\controllers;

use common\models\User;
use common\models\PromotionalCode;
use frontend\modules\api\components\Helpers;
use frontend\modules\api\controllers\service\UsersService;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\base\Controller;
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
                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD',],
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

    /**
     * @var Helpers
     */
    private $helpers;

    public function init()
    {
        $this->userService = new UsersService();
        $this->helpers = new Helpers();

        Yii::$app->response->format = Response::FORMAT_JSON;

        parent::init();
    }

    /**
     * @SWG\Post(path="api/users/current-user",
     *     tags={"user"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     *
     */
    public function actionCurrentUser()
    {
        $helpers = $this->helpers;
        $postRequest = Yii::$app->request->post();

        $data = $helpers->decodePostRequest($postRequest['prBlock']);

        $service = $this->userService;

        $user = $service->receiveUser($data['token']);

        return
            [
                'status' => 200,
                'data' => [
                    'vk_id' => $user->username,
                    'email' => $user->email,
                    'first_name' => $user->profiles->first_name,
                    'last_name' => $user->profiles->last_name,
                    'bonus_points' => $user->profiles->bonus_points,
                    'phone' => $user->profiles->phone,
                    'image' => preg_replace('~.*\/~sui', '', $user->profiles->image),
                    'date_birth' => $user->profiles->date_of_birth,
                    'city' => $user->profiles->city,
                ],

            ];
    }

    /**
     * @SWG\Post(path="api/users/profile-buy",
     *     tags={"user"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     *
     */
    public function actionProfileBuy()
    {
        $helpers = $this->helpers;
        $postRequest = Yii::$app->request->post();
        $service = $this->userService;

        $data = $helpers->decodePostRequest($postRequest['prBlock']);

        return
            [
                'status' => 200,
                'data' => $service->receiveOrderList($data['token']),
            ];
    }

    /**
     * @SWG\Post(path="api/users/save-prof-details",
     *     tags={"user"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     *
     */
    public function actionSaveProfileDetails()
    {
        $helpers = new Helpers();
        $postRequest = Yii::$app->request->post();

        $data = $helpers->decodePostRequest(Html::decode($postRequest['prBlock']));

        if (empty($data)) {
            return false;
        }

        $service = $this->userService;

        return $service->updateUserInfo($data);
    }

    /**
     * @SWG\post(path="/api/users/promo-code",
     *     tags={"user"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "token",
     *        description = " user  token",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     */
    public function actionPromoCode()
    {
        $helpers = new Helpers();
        $postRequest = Yii::$app->request->post();

        $data = $helpers->decodePostRequest(Html::decode($postRequest['prBlock']));

        if (empty($data)) {
            return false;
        }

        $service = $this->userService;
        $userId = $service->receiveUserId($data['token']);

        return PromotionalCode::findOne(['user_id' => $userId, 'is_status' => 1]);
    }

    /**
     * @SWG\Post(path="api/users/passing-lessons",
     *     tags={"user"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     *
     */
    public function actionPassingLessons()
    {
        $helpers = new Helpers();
        $postRequest = Yii::$app->request->post();

        $data = $helpers->decodePostRequest(Html::decode($postRequest['prBlock']));

        if (empty($data)) {
            throw new  yii\web\BadRequestHttpException();
        }

        $service = $this->userService;

        return
            [
                'status' => 200,
                'data' => $service->receivePassingLessons($data['token']),
            ];
    }

    /**
     * @SWG\Post(path="api/users/contact",
     *     tags={"user"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     *
     */
    public function actionContact()
    {
        $helpers = $this->helpers;
        $postRequest = Yii::$app->request->post();

        $data = $helpers->decodePostRequest(Html::decode($postRequest['prBlock']));
        $service = $this->userService;

        return
            [
                'status' => 200,
                'data' => $service->sendEmail($data),
            ];
    }

    /**
     * @SWG\Post(path="api/users/logout",
     *     tags={"user"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *       @SWG\Parameter(
     *        in = "formData",
     *        name = "token",
     *        description = "",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     *
     */
    public function actionLogout()
    {
        $helpers = $this->helpers;
        $postRequest = Yii::$app->request->post();

        $data = $helpers->decodePostRequest($postRequest['prBlock']);
        $service = $this->userService;

        $session = $service->receiveSessionCurrentUser($data['token']);
        Yii::$app->getSession()->destroy();
        $session->expire = time();

        return
            [
                'status' => 200,
                'data' => $session,
            ];
    }
}
