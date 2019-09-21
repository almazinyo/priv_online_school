<?php

namespace frontend\modules\api\controllers;

use common\models\Lessons;
use common\models\SectionSubjects;
use common\models\StorageLessons;
use common\models\Subjects;
use common\models\Teachers;
use frontend\modules\api\components\Select;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SubjectsController extends Controller
{

    /**
     * @return mixed[]
     */
    public function actionIndex()
    {
        $model = Subjects::receiveAllData();

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @param $slug
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionDetails($slug)
    {
        $subjectId =
            Select::receiveId(
                new Subjects(),
                ['slug' => Html::encode($slug)]
            );

        if ($subjectId === -1) {
            throw new NotFoundHttpException();
        }

        $model = Select::receiveSpecificData(new SectionSubjects(), ['subject_id' => $subjectId]);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @return array
     */
    public function actionSections()
    {
        return [
            'status' => 200,
            'data' =>  SectionSubjects::receiveAllData(),
        ];
    }

    /**
     * @return array
     */
    public function actionLessons()
    {
        return [
            'status' => 200,
            'data' =>  Lessons::receiveAllData(),
        ];
    }

    /**
     * @return array
     */
    public function actionStorage()
    {
        return [
            'status' => 200,
            'data' =>  Select::receiveAllData(new StorageLessons()),
        ];
    }

    /**
     * @return mixed[]
     */
    public function actionTeachers()
    {
        $model = Select::receiveAllData(new Teachers());

        return [
            'status' => 200,
            'data' => $model,
        ];
    }

    /**
     * @return mixed[]
     * @throws NotFoundHttpException
     */
    public function actionTeacher($slug)
    {
        $model = Select::receiveSpecificData(new Teachers(), ['slug' => Html::encode($slug)]);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        return [
            'status' => 200,
            'data' => $model,
        ];
    }
}
