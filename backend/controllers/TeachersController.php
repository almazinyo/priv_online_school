<?php

namespace backend\controllers;

use backend\components\ImageHelper;
use common\models\Blog;
use Yii;
use common\models\Teachers;
use backend\models\TeachersControl;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TeachersController implements the CRUD actions for Teachers model.
 */
class TeachersController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'upload-images', 'delete-file'],
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
     * Lists all Teachers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachersControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teachers model.
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
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Teachers();

        if ($model->load(Yii::$app->request->post())) {

            $imgFile = UploadedFile::getInstance($model, "img_name");

            if (!empty($imgFile)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias("@frontend") . "/web/images/teachers/";
                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $imgFile->saveAs($imgPath . $imgName);

                $image->reSize($imgPath . $imgName, 800, 600);
                $image->reSize($imgPath . $imgName, 400, 300, sprintf('%ssmall/%s', $imgPath, $imgName));

                $model->img_name = $imgName;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
        $oldImgName = $model->img_name;

        if ($model->load(Yii::$app->request->post())) {
            $imgFile = UploadedFile::getInstance($model, "img_name");

            if (!empty($imgFile)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias("@frontend") . "/web/images/teachers/";
                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $imgFile->saveAs($imgPath . $imgName);

                $image->reSize($imgPath . $imgName, 800, 600);
                $image->reSize($imgPath . $imgName, 400, 300, sprintf('%ssmall/%s', $imgPath, $imgName));
                $model->img_name = $imgName;
            } else {
                $model->img_name = $oldImgName;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return bool
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionUploadImages($id)
    {
        $model = $this->findModel($id);
        $imgFile = UploadedFile::getInstance($model, "img_name");

        if (!empty($imgFile)) {
            $image = new ImageHelper();

            $imgPath = Yii::getAlias("@frontend") . "/web/images/teachers/";
            $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
            $imgFile->saveAs($imgPath . $imgName);

            $image->reSize($imgPath . $imgName, 800, 600);
            $image->reSize($imgPath . $imgName, 400, 300, sprintf('%ssmall/%s', $imgPath, $imgName));

            $model->img_name = $imgName;
            $model->save();
        }

        return true;
    }

    /**
     * @param $id
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionDeleteFile($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->img_name)) {
            $imgPath = sprintf('%s/web/images/teachers/%s', Yii::getAlias('@frontend'), $model->img_name);
            $imgPathSmall = sprintf('%s/web/images/teachers/small/%s', Yii::getAlias('@frontend'), $model->img_name);

            if (file_exists($imgPathSmall)) {
                unlink($imgPathSmall);
            }

            if (file_exists($imgPath)) {
                unlink($imgPath);

                $model->img_name = null;
                $model->save();

                return true;
            }
        }

        return false;
    }

    /**
     * Deletes an existing Teachers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Teachers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teachers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teachers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
