<?php

namespace backend\controllers;

use backend\components\ImageHelper;
use backend\models\SubSectionsControl;
use common\models\Lessons;
use Yii;
use common\models\SectionSubjects;
use backend\models\SectionSubjectsControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * SectionSubjectsController implements the CRUD actions for Subjects model.
 */
class SectionSubjectsController extends Controller
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
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'view',
                            'delete',
                            'sub-sections',
                            'create-sub-section',
                            'upload-images',
                            'delete-file',
                            'duplicate',
                        ],
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
     * Lists all Subjects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SectionSubjectsControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubSections()
    {
        $searchModel = new SubSectionsControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('sub-sections', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subjects model.
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
     * Creates a new SectionSubjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SectionSubjects();

        if ($model->load(Yii::$app->request->post())) {
            $model->parent_id = 0;

            $imgFile = UploadedFile::getInstance($model, 'img_path');

            if (!empty($imgFile)) {
                $imgPath = Yii::getAlias('@frontend') . '/web/images/sections/';
                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $imgFile->saveAs($imgPath . $imgName);

                $model->img_path =
                    Url::to(
                        sprintf('http://%s/images/sections/%s', $_SERVER['HTTP_HOST'],  $imgName)
                    );
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateSubSection()
    {
        $model = new SectionSubjects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create-sub-section', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Subjects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImgPath = $model->img_path;

        if ($model->load(Yii::$app->request->post())) {
            $imgFile = UploadedFile::getInstance($model, 'img_path');

            if (!empty($imgFile)) {
                $imgPath = Yii::getAlias('@frontend') . '/web/images/sections/';
                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $imgFile->saveAs($imgPath . $imgName);

                $model->img_path =
                    Url::to(
                        sprintf('http://%s/images/sections/%s', $_SERVER['HTTP_HOST'],  $imgName)
                    );
            } else {
                $model->img_path = $oldImgPath;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUploadImages($id)
    {
        $model = $this->findModel($id);

        $imgFile = UploadedFile::getInstance($model, 'img_path');

        if (!empty($imgFile)) {
            $imgPath = Yii::getAlias('@frontend') . '/web/images/sections/';
            $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
            $imgFile->saveAs($imgPath . $imgName);

            $model->img_path =
                Url::to(
                    sprintf('http://%s/images/sections/%s', $_SERVER['HTTP_HOST'],  $imgName)
                );
            $model->save();
        }

        return true;
    }

    public function actionDeleteFile($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->img_path)) {
            $imageName = preg_replace('~.*\/~sui', '', $model->img_path);
            $imgPath = sprintf('%s/web/images/sections/%s', Yii::getAlias('@frontend'), $imageName);

            if (file_exists($imgPath)) {
                unlink($imgPath);

                $model->img_path = null;
                $model->save();

                return true;
            }
        }

        return false;
    }

    /**
     * Deletes an existing SectionSubjects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        $pathRedirect = 'index';

        if ($model->parent_id != 0) {
            $pathRedirect = 'sub-sections';
        }


        return $this->redirect([$pathRedirect]);
    }

    /**
     * Finds the Subjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SectionSubjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SectionSubjects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDuplicate($id)
    {
        $model = $this->findModel($id);
        $modelDuplicate = new  SectionSubjects();
        $modelDuplicate->attributes = $model->attributes;
        $modelDuplicate->save();

        $pathRedirect = 'index';

        if ($model->parent_id != 0) {
            $pathRedirect = 'sub-sections';
        }

        return $this->redirect([$pathRedirect]);
    }
}
