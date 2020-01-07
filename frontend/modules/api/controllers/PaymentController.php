<?php

namespace frontend\modules\api\controllers;

use common\models\OrderList;
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
                    'Du9j+ADcTDWjPbB24I4Mm3BP',
                    $postRequest['label']
                )
            );

        $model = new OrderList();
        $model->price = $postRequest['amount'];
        $model->sender = $postRequest['sender'];
        $model->datetime = $postRequest['datetime'];
        $model->name = $postRequest['name'];
        $model->email = $postRequest['email'];
        $model->operation_id = $postRequest['operation_id'];
        $model->operation_label = $postRequest['operation_label'];
        $model->notification_type = $postRequest['notification_type'];
        $model->is_status = 0;

        if ($postRequest['sha1_hash'] == $hash || $postRequest['codepro'] === false || $postRequest['unaccepted'] === false) {
            $model->is_status = 1;
        }

        if ($model->save(false)) {
            return ['status' => 200];
        }

        throw new  BadRequestHttpException();
    }
}
