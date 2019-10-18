<?php

namespace backend\modules\grid\controllers;

use Yii;
use backend\modules\grid\models\GridSort;
use backend\modules\grid\models\GridSortControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GridSortController implements the CRUD actions for GridSort model.
 */
class GridSortController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all GridSort models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GridSortControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Updates an existing GridSort model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->default_columns)) {
                $model->default_columns = json_encode($model->default_columns);
            }
            if (!empty($model->sort)) {
                $model->sort = json_encode($model->sort);
            }

            if ($model->save()) {
                return $this->redirect(['index',]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = GridSort::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
