<?php

namespace frontend\modules\api\controllers;

use common\models\Lessons;
use common\models\SectionSubjects;
use frontend\modules\api\components\Helpers;
use frontend\modules\api\controllers\service\LessonsService;
use yii\web\Controller;
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
     * @SWG\Get(path="/api/sections/{slugSection}{slugLesson}",
     *     tags={"sections"},
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
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "slug_section",
     *        description = " user  token",
     *        required = true,
     *        type = "string"
     *     ),
     *
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     */
    public function actionDetails($slugSection, $slugLesson = '')
    {

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
     * @SWG\Get(path="/api/sections/valid-lessons(",
     *     tags={"sections"},
     *     summary="summary",
     *     description="description",
     *     produces={"application/json"},
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     ),
     * )
     */
    public function actionValidLessons()
    {
        $request = Yii::$app->request;
        $lessonsService = new LessonsService();

        $data = (new Helpers())->decodePostRequest($request->post('prBlock'));
        $sectionId = SectionSubjects::findOne(['slug'=>$data['slug']])->id;


      $lessons =   Lessons::receiveLessonsForSection($sectionId);

        return [
            'status' => 200,
            'data' => [],
        ];
    }
}
