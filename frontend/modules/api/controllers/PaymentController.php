<?php

namespace frontend\modules\api\controllers;

use common\models\Lessons;
use common\models\OrderList;
use common\models\Profile;
use common\models\SectionSubjects;
use common\models\Subjects;
use frontend\models\Auth;
use yii\base\Controller;
use yii\web\BadRequestHttpException;

class PaymentController extends Controller
{
    public function actionCheckYandexPayment()
    {
        $postRequest = \Yii::$app->request->post();

        if (empty($postRequest)) {
            throw new  BadRequestHttpException();
        }
        $label = $postRequest['label'];
        $userId = Auth::findOne(['source_id' => preg_replace('~\-.*~sui', '', $label)])->user_id;
        $slug = preg_replace('~^\d+\-~sui', '', $label);
        $sectionId = SectionSubjects::findOne(['slug' => $slug])->id ?? '';
        $lessonId = Lessons::findOne(['slug' => $slug])->id ?? '';
        $subjectId = Subjects::findOne(['slug' => $slug])->id ?? '';
        $profile = Profile::findOne(['user_id' => $userId]);
        $fulName = sprintf('%s %s', $profile->first_name, $profile->last_name);

        $hash =
            sha1(
                sprintf(
                    '%s&%s&%s&%s&%s&%s&%s&%s&%s',
                    $postRequest['notification_type'],
                    $postRequest['operation_id'],
                    $postRequest['amount'],
                    $postRequest['currency'],
                    $postRequest['datetime'],
                    $postRequest['sender'],
                    $postRequest['codepro'],
                    'jqXwc7iLRUieLv+teR+OhQl0',
                    $label
                )
            );

        $model = new OrderList();
        $model->user_id = $userId;
        $model->section_id = $sectionId;
        $model->lesson_id = $lessonId;
        $model->subjects_id = $subjectId;
        $model->name = $fulName;
        $model->price = $postRequest['amount'];
        $model->sender = $postRequest['sender'];
        $model->datetime = $postRequest['datetime'];
        $model->email = $postRequest['email'];
        $model->operation_id = $postRequest['operation_id'];
        $model->operation_label = $postRequest['operation_label'];
        $model->notification_type = $postRequest['notification_type'];
        $model->is_status = 0;

        file_put_contents('test.json', json_encode($_POST));


        if ($postRequest['sha1_hash'] == $hash || $postRequest['codepro'] === false || $postRequest['unaccepted'] === false) {
            $model->is_status = 1;
            file_put_contents('test.json', json_encode($_POST));
        }

        if ($model->save(false)) {
            return ['status' => 200];
        }

        throw new  BadRequestHttpException();
    }
}
