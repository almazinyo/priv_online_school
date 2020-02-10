<?php

namespace frontend\modules\api\controllers;

use common\models\Lessons;
use common\models\OrderList;
use common\models\SectionSubjects;
use frontend\modules\api\components\Helpers;
use frontend\modules\api\controllers\service\LessonsService;
use frontend\modules\api\controllers\service\UsersService;
use yii\base\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SectionsController extends Controller
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
     * @SWG\Get(path="/api/sections/details/{slugSection}/{slugLesson}",
     *     tags={"sections"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     */
    public function actionDetails()
    {
        $getRequest = \Yii::$app->request->get();

        $slugSection = $getRequest['slugSection'] ?? '';
        $slugLesson = $getRequest['slugLesson'] ?? '';

        $model = SectionSubjects::receiveSpecificData($slugSection, $slugLesson);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        $model['allLessons'] = Lessons::receiveLessonsForSection($model['id']);

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @SWG\post(path="/api/sections/valid-lessons",
     *     tags={"sections"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "token",
     *        description = " user  token",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "slug_section",
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
    public function actionValidLessons()
    {
        $request = \Yii::$app->request;

        $data = (new Helpers())->decodePostRequest($request->post('prBlock'));
        $userId = (new UsersService())->receiveUserId($data['token']);
        $sectionId = SectionSubjects::findOne(['slug' => $data['slug_section']])->id;

        $orderListSection = OrderList::find()->where(['section_id' => $sectionId, 'user_id' => $userId]);
        $orderListLessons = OrderList::find()->where(['lesson_id' => $sectionId, 'user_id' => $userId]);
        $modelLessons = Lessons::receiveLessonsForSection($sectionId);

        $validLessons = [];

        foreach ($modelLessons as $index => $lesson) {
            $validLessons[$lesson['id']] =
                [
                    'name' => $lesson['name'],
                    'slug' => $lesson['slug'],
                    'price' => $lesson['price'],
                    'is_status' => $lesson['is_status'],
                    'is_bought' => false,
                ];
        }

        if (!empty($orderListSection)) {
            foreach ($validLessons as $index => $validLesson) {
                $validLessons[$index]['is_bought'] = true;
            }
        }

        if (empty($orderListSection) && !empty($orderListLessons)) {
            foreach ($orderListLessons as $index => $order) {
                $lessonId = $order['lesson_id'];
                $validLessons[$lessonId]['is_bought'] = true;
            }
        }

        return
            [
                'status' => 200,
                'data' => $validLessons,
            ];
    }
}
