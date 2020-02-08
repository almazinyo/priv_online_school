<?php

namespace frontend\modules\api\controllers;

;

use common\models\Reviews;
use frontend\modules\api\components\Helpers;
use frontend\modules\api\controllers\service\UsersService;
use yii\web\Controller;
use yii\web\Response;

class ReviewsController extends Controller
{
    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

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
     * @SWG\Get(path="/api/reviews",
     *     tags={"reviews"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     *
     */
    public function actionIndex()
    {
        $model = Reviews::receiveAllData();
        $data = [];

        foreach ($model as $index => $review) {
            $data[] = [
                'subject_name' => $review['subject_name'],
                'description' => $review['description'],
                'rating' => $review['rating'],
                'first_name' =>  $review['user']['profiles']['first_name'],
                'last_name' =>  $review['user']['profiles']['last_name'],
                'url_vk' => 'https://vk.com/id' . $review['user']['username'],
                'img' => 'http://api.examator.ru/images/users/' . $review['user']['profiles']['image'],
            ];
        }

        return [
            'status' => 200,
            'data' => $data
        ];
    }

    /**
     * @SWG\Post(path="/api/reviews/create",
     *     tags={"reviews"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *       @SWG\Parameter(
     *        in = "formData",
     *        name = "token",
     *        description = " user  token",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "rating",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *       @SWG\Parameter(
     *        in = "formData",
     *        name = "description",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *      @SWG\Parameter(
     *        in = "formData",
     *        name = "subject_id",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "section_id",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "",
     *         @SWG\Schema(ref="#/definitions/Error")
     *     )
     * )
     *
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $userService = new UsersService();

        $data = (new Helpers())->decodePostRequest($request->post('prBlock'));
        $userId = $userService->receiveUserId($data['token']);

        $model =
            new  Reviews(
                [
                    'user_id' => $userId,
                    'subjects_id' => $data['subject_id'],
                    'section_id' => $data['section_id'],
                    'rating' => $data['rating'],
                    'description' => $data['description'],
                    'is_status' => 1,
                ]
            );

        return [
            'status' => 200,
            'success' => $model->save(),
        ];
    }
}
