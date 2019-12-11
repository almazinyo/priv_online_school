<?php

namespace frontend\modules\api\controllers;

use common\models\Blog;
use frontend\modules\api\components\Select;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BlogController extends Controller
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

    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

    /**
     * @SWG\Get(path="/api/blog",
     *     tags={"blog"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *       @SWG\Parameter(
     *        in = "formData",
     *        name = "test",
     *        description = "",
     *        required = false,
     *        type = "string"
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "需要重新登陆",
     *         @SWG\Schema(ref="#/definitions/Error")
     *     )
     * )
     *
     */
    public function actionIndex()
    {
        $model = Blog::receiveAllData();

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @return mixed[]
     * @throws NotFoundHttpException
     */
    public function actionDetails($slug)
    {
        $model = Select::receiveSpecificData(new Blog(), ['slug' => Html::encode($slug)]);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}
