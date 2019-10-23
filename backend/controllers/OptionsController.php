<?php

namespace backend\controllers;

use backend\components\ImageHelper;
use Yii;
use common\models\Options;
use backend\models\OptionsControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OptionsController implements the CRUD actions for Options model.
 */
class OptionsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Options models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OptionsControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Options model.
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
     * Creates a new Options model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Options();
        $optionsData = [];
        $optionsData['img_name'] = '';

        if ($model->load(Yii::$app->request->post())) {
            $imgFile = UploadedFile::getInstance($model, "img_name");

            if (!empty($imgFile)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias("@frontend") . "/web/images/options/";
                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $imgFile->saveAs($imgPath . $imgName);

                $image->reSize($imgPath . $imgName, 800, 600);

                $optionsData['img_name'] = $imgName;
            }

            $optionsData['name'] = $model->name;
            $optionsData['description'] = $model->description;

            $model->value = \Opis\Closure\serialize($optionsData);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Options model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $optionsData = \Opis\Closure\unserialize($model->value);
        $model->name = $optionsData['name'];
        $model->description = $optionsData['description'];
        $model->img_name = $optionsData['img_name'];

        if ($model->load(Yii::$app->request->post())) {
            $imgFile = UploadedFile::getInstance($model, "img_name");

            if (!empty($imgFile)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias("@frontend") . "/web/images/options/";
                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
                $imgFile->saveAs($imgPath . $imgName);

                $image->reSize($imgPath . $imgName, 800, 600);
                $optionsData['img_name'] = $imgName;
            }

            $optionsData['name'] = $model->name;
            $optionsData['description'] = $model->description;

            $model->value = \Opis\Closure\serialize($optionsData);

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

            $imgPath = Yii::getAlias("@frontend") . "/web/images/options/";
            $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
            $imgFile->saveAs($imgPath . $imgName);

            $image->reSize($imgPath . $imgName, 800, 600);

            $model->img_name = $imgName;
            $model->save();
        }

        return true;
    }

    public function actionDeleteFile($id)
    {
        $model = $this->findModel($id);
        $optionsData = \Opis\Closure\unserialize($model->value);

        if (!empty($optionsData['img_name'])) {
            $imgPath = sprintf('%s/web/images/options/%s', Yii::getAlias('@frontend'), $optionsData['img_name']);

            if (file_exists($imgPath)) {
                unlink($imgPath);

                $optionsData['img_name'] = null;
                $model->value = \Opis\Closure\serialize($optionsData);
                $model->save();

                return true;
            }
        }

        return false;
    }

    /**
     * Deletes an existing Options model.
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
     * Finds the Options model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Options the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Options::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
