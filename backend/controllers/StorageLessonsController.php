<?php

namespace backend\controllers;

use backend\components\ImageHelper;
use Yii;
use common\models\StorageLessons;
use backend\models\StorageLessonsControl;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StorageLessonsController implements the CRUD actions for StorageLessons model.
 */
class StorageLessonsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'upload-file', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StorageLessons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StorageLessonsControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StorageLessons model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StorageLessons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StorageLessons();

        if ($model->load(Yii::$app->request->post())) {
            $lessonId = $model->lesson_id;
            $status = $model->is_status;

            $lessons = UploadedFile::getInstances($model, 'name');

            if (!empty($lessons)) {
                foreach ($lessons as $file) {
                    $filePath = Yii::getAlias("@frontend") . "/web/images/lessons/";
                    $fileName = Yii::$app->security->generateRandomString() . '.' . $file->extension;
                    $file->saveAs($filePath . $fileName);
                    $model = new StorageLessons();
                    $model->name = $fileName;
                    $model->type = preg_replace('~\/.*~sui', '', $file->type ?? '');
                    $model->lesson_id = $lessonId;
                    $model->is_status = $status;
                    $model->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model,]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $lessonId = $model->lesson_id;
            $status = $model->is_status;

            $lessons = UploadedFile::getInstances($model, 'name');

            if (!empty($lessons)) {
                foreach ($lessons as $file) {
                    $filePath = Yii::getAlias("@frontend") . "/web/images/lessons/";
                    $fileName = Yii::$app->security->generateRandomString() . '.' . $file->extension;
                    $file->saveAs($filePath . $fileName);
                    $model = new StorageLessons();
                    $model->name = $fileName;
                    $model->type = preg_replace('~\/.*~sui', '', $file->type ?? '');
                    $model->lesson_id = $lessonId;
                    $model->is_status = $status;
                    $model->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @param bool $deleteFile
     * @return bool|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id, $isFormPage = false)
    {
        $model = $this->findModel($id);

        if (!empty($model->name)) {
            $imgPath = sprintf('%s/web/images/lessons/%s', Yii::getAlias('@frontend'), $model->name);

            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }

        $model->delete();

        if ($isFormPage) {
            return true;
        }

        return $this->redirect(['index']);
    }

    public function actionUploadFile($id)
    {
        $storage = $this->findModel($id);
        $model = new StorageLessons();

        $lessonId = $storage->lesson_id;
        $status = $storage->is_status;

        $lessons = UploadedFile::getInstances($model, 'name');

        if (!empty($lessons)) {
            foreach ($lessons as $file) {
                $filePath = Yii::getAlias("@frontend") . "/web/images/lessons/";
                $fileName = Yii::$app->security->generateRandomString() . '.' . $file->extension;
                $file->saveAs($filePath . $fileName);
                $model = new StorageLessons();
                $model->name = $fileName;
                $model->type = preg_replace('~\/.*~sui', '', $file->type ?? '');
                $model->lesson_id = $lessonId;
                $model->is_status = $status;
                $model->save();
            }
        }

        return true;
    }

    /**
     * Finds the StorageLessons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StorageLessons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StorageLessons::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
