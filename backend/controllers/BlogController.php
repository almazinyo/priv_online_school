<?php

namespace backend\controllers;

use backend\components\ImageHelper;
use Yii;
use common\models\Blog;
use backend\models\BlogControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{

    public $enableCsrfValidation = false;

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
                        'actions' => ['index', 'create', 'update', 'view', 'upload-images', 'delete-file', 'delete'],
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
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
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
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();

        if ($model->load(Yii::$app->request->post())) {

            $imgFile = UploadedFile::getInstance($model, "img_name");

            if (!empty($imgFile)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias("@frontend") . "/web/images/blog/";
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
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImgName = $model->img_name;

        if ($model->load(Yii::$app->request->post())) {
            $imgFile = UploadedFile::getInstance($model, "img_name");

            if (!empty($imgFile)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias("@frontend") . "/web/images/blog/";
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

    public function actionUploadImages($id)
    {
        $model = $this->findModel($id);
        $imgFile = UploadedFile::getInstance($model, "img_name");

        if (!empty($imgFile)) {
            $image = new ImageHelper();

            $imgPath = Yii::getAlias("@frontend") . "/web/images/blog/";
            $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
            $imgFile->saveAs($imgPath . $imgName);

            $image->reSize($imgPath . $imgName, 800, 600);
            $image->reSize($imgPath . $imgName, 400, 300, sprintf('%ssmall/%s', $imgPath, $imgName));

            $model->img_name = $imgName;
            $model->save();
        }

        return true;
    }

    public function actionDeleteFile($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->img_name)) {
            $imgPath = sprintf('%s/web/images/blog/%s', Yii::getAlias('@frontend'), $model->img_name);
            $imgPathSmall = sprintf('%s/web/images/blog/small/%s', Yii::getAlias('@frontend'), $model->img_name);

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
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->img_name)) {
            $imgPath = sprintf('%s/web/images/blog/%s', Yii::getAlias('@frontend'), $model->img_name);
            $imgPathSmall = sprintf('%s/web/images/blog/small/%s', Yii::getAlias('@frontend'), $model->img_name);

            if (file_exists($imgPathSmall)) {
                unlink($imgPathSmall);
            }

            if (file_exists($imgPath)) {
                unlink($imgPath);

                $model->img_name = null;
                $model->save();
            }
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
