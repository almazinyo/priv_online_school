<?php

namespace frontend\modules\api\controllers;

use common\models\Lessons;
use common\models\SectionSubjects;
use common\models\StorageLessons;
use common\models\Subjects;
use common\models\Teachers;
use frontend\modules\api\components\Helpers;
use frontend\modules\api\components\Select;
use frontend\modules\api\controllers\service\SubjectsService;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use  yii;

class SubjectsController extends Controller
{
    /**
     * @var SubjectsService
     */
    private $subjectsService;

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
     * @SWG\Get(path="/api/subjects",
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
    public function actionIndex()
    {
        $model = Subjects::receiveAllData();

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $this->subjectsService = new SubjectsService();

        parent::init();
    }

    /**
     * @SWG\Get(path="/api/subjects/menu",
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
    public function actionMenu()
    {
        $model = Subjects::receiveMenu();

        return
            [
                'status' => 200,
                'data' => $model,
            ];
    }

    /**
     * @SWG\Get(path="/api/subjects/details{slug}",
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
    public function actionDetails()
    {
        $getRequest = \Yii::$app->request->get();

        $model = Subjects::receiveSpecificData(Html::encode($getRequest['slug']));

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @SWG\Get(path="/api/subjects/sections",
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
    public function actionSections()
    {
        return [
            'status' => 200,
            'data' => SectionSubjects::receiveAllData(),
        ];
    }

    /**
     * @SWG\Get(path="/api/subjects/lessons",
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
    public function actionLessons()
    {
        return [
            'status' => 200,
            'data' => Lessons::receiveAllData(),
        ];
    }

    /**
     * @SWG\Get(path="/api/subjects/storages",
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
    public function actionStorage()
    {
        return [
            'status' => 200,
            'data' => Select::receiveAllData(new StorageLessons()),
        ];
    }

    /**
     * @SWG\Get(path="/api/subjects/teachers",
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
    public function actionTeachers()
    {
        $model = Teachers::receiveAllData();

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @SWG\Post(path="/api/subjects/check-test",
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
    public function actionCheckTest()
    {

        $helpers = new Helpers();
        $postRequest = \Yii::$app->request->post();

        $answers = $helpers->decodePostRequest(Html::decode($postRequest['prBlock']));

        if (empty($answers['data'])) {
            return false;
        }

        return $this->subjectsService->checkTest($answers['data']);
    }

    /**
     * @SWG\Get(path="/api/subjects/teacher/{slug}",
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
    public function actionTeacher()
    {
        $getRequest = \Yii::$app->request->get();

        $model = Teachers::receiveSpecificData($getRequest['slug']);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}
