<?php

namespace backend\controllers;

use backend\components\ImageHelper;
use Yii;
use common\models\Quiz;
use backend\models\QuizControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * QuizController implements the CRUD actions for Quiz model.
 */
class QuizController extends Controller
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
     * Lists all Quiz models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuizControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quiz model.
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
     * Creates a new Quiz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Quiz();

        if ($model->load(Yii::$app->request->post())) {

            $question = UploadedFile::getInstance($model, 'question');
            $hint = UploadedFile::getInstance($model, 'hint');

            if (!empty($question)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias('@frontend') . '/web/images/question/';
                $imgName = Yii::$app->security->generateRandomString() . '.' . $question->extension;
                $question->saveAs($imgPath . $imgName);
                $model->question = $imgName;
            }

            if (!empty($hint)) {
                $image = new ImageHelper();
                $imgPath = Yii::getAlias('@frontend') . '/web/images/question/hint/';
                $imgName = Yii::$app->security->generateRandomString() . '.' . $hint->extension;
                $hint->saveAs($imgPath . $imgName);
                $model->hint = $imgName;
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
     * Updates an existing Quiz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUploadQuestion($id)
    {
        $model = $this->findModel($id);
        $imgFile = UploadedFile::getInstance($model, 'question');
        $oldImageName = $model->question;

        if (!empty($imgFile)) {
            if (!empty($oldImageName)) {
                $imgPath = sprintf('%s/web/images/question/%s', Yii::getAlias('@frontend'), $oldImageName);

                if (file_exists($imgPath)) {
                    unlink($imgPath);
                }
            }

            $image = new ImageHelper();
            $imgPath = Yii::getAlias('@frontend') . '/web/images/question/';
            $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
            $imgFile->saveAs($imgPath . $imgName);

            $model->question = $imgName;
            $model->save();
        }

        return true;
    }
    public function actionUploadHint($id)
    {
        $model = $this->findModel($id);
        $imgFile = UploadedFile::getInstance($model, 'hint');
        $oldImageName = $model->hint;

        if (!empty($imgFile)) {
            if (!empty($oldImageName)) {
                $imgPath = sprintf('%s/web/images/question/hint/%s', Yii::getAlias('@frontend'), $oldImageName);

                if (file_exists($imgPath)) {
                    unlink($imgPath);
                }
            }

            $image = new ImageHelper();
            $imgPath = Yii::getAlias('@frontend') . '/web/images/question/hint/';
            $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;
            $imgFile->saveAs($imgPath . $imgName);

            $model->hint = $imgName;
            $model->save();
        }

        return true;
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->question)) {
            $imgPath = sprintf('%s/web/images/question/%s', Yii::getAlias('@frontend'), $model->question);

            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }

        if (!empty($model->hint)) {
            $imgPath = sprintf('%s/web/images/question/hint/%s', Yii::getAlias('@frontend'), $model->hint);

            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteQuestion($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->question)) {
            $imgPath = sprintf('%s/web/images/question/%s', Yii::getAlias('@frontend'), $model->question);

            if (file_exists($imgPath)) {
                unlink($imgPath);

                $model->question = null;
                $model->save();

                return true;
            }
        }

        return false;
    }

    public function actionDeleteHint($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->hint)) {
            $imgPath = sprintf('%s/web/images/question/hint/%s', Yii::getAlias('@frontend'), $model->hint);

            if (file_exists($imgPath)) {
                unlink($imgPath);

                $model->hint = null;
                $model->save();

                return true;
            }
        }

        return false;
    }

    /**
     * Finds the Quiz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quiz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quiz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
